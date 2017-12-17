<?php

namespace App\Http\Controllers;

use App\Enquiry;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function store()
    {
        Excel::load(base_path('storage/app/get-a-quote-2017-12-17.csv'), function($reader) {
            $results = collect($reader->get([
                'full_name',
                'email',
                'where_did_you_hear_about_us',
                'your_phone_number',
                'postcode',
                'total_cost',
                'survey_type',
                'price_band',
                'property_age',
                'source_url',
//                'user_agent',
                'entry_date'
            ]));

            foreach ($results as $result) {
                Enquiry::create([
                    'full_name' => $result['full_name'],
                    'email' => $result['email'],
                    'phone_number' => $result['your_phone_number'],
                    'heard_about' => $result['where_did_you_hear_about_us'],
                    'postcode' => $result['postcode'],
                    'total_cost' => $result['total_cost'],
                    'job_type' => $result['survey_type'],
                    'job_value' => $result['price_band'],
                    'job_age' => $result['property_age'],
                    'website_page' => $result['source_url'],
//                    'user_agent' => $result['user_agent'],
                    'created_at' => $result['entry_date']
                ]);
            }
        });
    }
}
