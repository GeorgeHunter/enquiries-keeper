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
            $this->enquiries = $this->enquiries->reject(function($enquiry) {
                return ExcludeList::all()->pluck('exclusion')->contains(function($value, $key) use ($enquiry) {
                    return strpos($enquiry->email, $value);
                });
            });
        }

//        dd($this->enquiries->pluck('email'));

        $dates = $this->enquiries->groupBy(function($enq) {
            return $enq->created_at->format('Y-m-d');
        })->mapWithKeys(function($enquiry, $key) {
            return [
                $key => $enquiry->count()
            ];
        })->sortBy(function($value, $key) {
            return $key;
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

        $page_submitted = $this->enquiries->groupBy('website_page')
            ->mapWithKeys(function($enquiry, $key) {
                return [
                    $key => $enquiry->count()
                ];
            })->reject(function($value, $key) {
                return $key === "";
            });


        $job_type = $this->enquiries->groupBy('job_type')
            ->mapWithKeys(function($enquiry, $key) {
                return [
                    str_before($key, '|') => $enquiry->count()
                ];
            });

        return view('enquiries.analytics.index', compact('job_type', 'dates', 'heard_about', 'total_value', 'page_submitted'));
    }
}
