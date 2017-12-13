<?php

namespace App\Http\Controllers;

use App\Enquiry;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class ReportsController extends Controller
{
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
            });

        $total_value = $this->enquiries->groupBy(function($enq) {
            return $enq->created_at->format('Y-m-d');
        })->map(function($item) {
            return $item->sum('total_cost');
        });

//        $total_value = $this->enquiries->pluck('total_value', 'created_at');

//        dd($total_value);

        $enquiries = $this->enquiries->groupBy('job_type')
            ->mapWithKeys(function($enquiry, $key) {
                return [
                    str_before($key, '|') => $enquiry->count()
                ];
            });

//        return view('enquiries.analytics.index', compact('dates', 'heard_about', 'total_value', 'enquiries'));
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('images', true);
//        $pdf->setOption('javascript-delay', 13500);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
//        $pdf->loadView('test', compact('dates', 'heard_about', 'total_value', 'enquiries'));
        $pdf->loadView('test', compact('dates', 'heard_about', 'total_value', 'enquiries'));
        return $pdf->inline();
    }
}