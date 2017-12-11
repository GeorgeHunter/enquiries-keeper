<?php

namespace App\Http\Controllers;

use App\Enquiry;
use Illuminate\Http\Request;

class EnquiriesAnalyticsController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::get()->groupBy('job_type')->mapWithKeys(function($enquiry, $key) {
            return [
                str_before($key, '|') => $enquiry->count()
            ];
        });

        $dates = Enquiry::when(request('start-date') && request('end-date'), function($query) {
            $query->whereBetween('created_at', [request('start-date'), request('end-date')]);
        })->get();

        if (request('filter') === "true") {
            $dates = $dates->reject(function($date) {
                return ExcludeList::all()->pluck('exclusion')->contains(function($value, $key) use ($date) {
                    return strpos($date->email, $value);
                });
            });
        }

        $dates = $dates->groupBy(function($enq) {
            return $enq->created_at->format('Y-m-d');
        });

        $heard_about = Enquiry::get()->groupBy('heard_about')->mapWithKeys(function($enquiry, $key) {
            return [
                $key => $enquiry->count()
            ];
        });


        return view('enquiries.analytics.index', compact('enquiries', 'dates', 'heard_about'));
    }
}
