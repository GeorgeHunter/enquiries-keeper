<?php

namespace App\Http\Controllers;

use App\Enquiry;
use App\ExcludeList;
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
//        $this->enquiries = Enquiry::when(request('start-date') && request('end-date'), function($query) {
//            $query->whereBetween('created_at', [request('start-date'), request('end-date')]);
//        })->when(request('filter') === "true", function ($query) {
//            $query->get()->reject(function($date) {
//                return ExcludeList::all()->pluck('exclusion')->contains(function($value, $key) use ($date) {
//                    return strpos($date->email, $value);
//                });
//        })->get();

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
        });

        $heard_about = $this->enquiries->groupBy('heard_about')->mapWithKeys(function($enquiry, $key) {
            return [
                $key => $enquiry->count()
            ];
        });

        $enquiries = $this->enquiries->groupBy('job_type')->mapWithKeys(function($enquiry, $key) {
            return [
                str_before($key, '|') => $enquiry->count()
            ];
        });


        return view('enquiries.analytics.index', compact('enquiries', 'dates', 'heard_about'));
    }
}
