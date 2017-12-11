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

        return view('enquiries.analytics.index', compact('enquiries'));
    }
}
