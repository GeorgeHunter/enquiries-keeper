<?php

namespace App\Http\Controllers;

use App\Enquiry;
use App\ExcludeList;
use function foo\func;
use Illuminate\Http\Request;

class EnquiriesAnalyticsController extends Controller
{

    /**
     * @var
     */
    private $enquiries;

    function __construct()
    {
        $this->enquiries = Enquiry::select();
    }

    public function index()
    {

        $this->enquiries = $this->enquiries->when(request('start-date') && request('end-date'), function($query) {
            $query->whereBetween('created_at', [request('start-date'), request('end-date')]);
        })->get();

        if (request('filter') === "true") {
            $this->enquiries = $this->enquiries->reject(function($date) {
                return ExcludeList::all()->pluck('exclusion')->contains(function($value, $key) use ($date) {
                    return strpos($date->email, $value);
                });
            });
        }

        $dates = $this->enquiries->groupBy(function($enq) {
            return $enq->created_at->format('Y-m-d');
        })->mapWithKeys(function($enquiry, $key) {
            return [
                $key => $enquiry->count()
            ];
        });

        $heard_about = $this->enquiries->groupBy('heard_about')
            ->mapWithKeys(function($enquiry, $key) {
                return [
                    $key => $enquiry->count()
                ];
            })->sortBy(function($value, $key) {
                return $value;
            })->reverse();

        $total_value = $this->enquiries->groupBy(function($enq) {
            return $enq->created_at->format('Y-m-d');
        })->map(function($item) {
            return $item->sum('total_cost');
        });

        // this is a bad idea and will get extracted somewhere else at some point
        $tld = config('app.env') === "production" ? '.co.uk' : '.dev';

        $page_submitted = $this->enquiries->groupBy('website_page')
            ->mapWithKeys(function($enquiry, $key) use ($tld) {
                return [
                    str_after($key, $tld) => $enquiry->count()
                ];
            })->reject(function($value, $key) {
                return $key === "";
            });

        $enquiries = $this->enquiries->groupBy('job_type')
            ->mapWithKeys(function($enquiry, $key) {
                return [
                    str_before($key, '|') => $enquiry->count()
                ];
            });


        return view('enquiries.analytics.index', compact('enquiries', 'dates', 'heard_about', 'total_value', 'page_submitted'));
    }
}
