@extends('layouts.app')

@section('content')

    <div class="container pt-4">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="total-number-tab" data-toggle="tab" href="#total-number" role="tab" aria-controls="total-number" aria-selected="true">Total Number</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="by-job-tab" data-toggle="tab" href="#by-job" role="tab" aria-controls="by-job" aria-selected="false">By Job</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="total-value-tab" data-toggle="tab" href="#total-value" role="tab" aria-controls="total-value" aria-selected="false">Total Value</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="heard-about-tab" data-toggle="tab" href="#heard-about" role="tab" aria-controls="heard-about" aria-selected="false">Heard about</a>
            </li>
        </ul>
        <div class="tab-content pt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="total-number" role="tabpanel" aria-labelledby="total-number-tab">
                <total-enquiries enquiries="{{ $dates }}"></total-enquiries>
            </div>
            <div class="tab-pane fade" id="by-job" role="tabpanel" aria-labelledby="by-job-tab">
                <pie-chart data="{{ $enquiries }}" title="Jobs by type" name="byType"></pie-chart>
            </div>
            <div class="tab-pane fade" id="total-value" role="tabpanel" aria-labelledby="total-value-tab">
            </div>
            <div class="tab-pane fade" id="heard-about" role="tabpanel" aria-labelledby="heard-about-tab">
                <pie-chart data="{{ $heard_about }}" title="Jobs by type" name="heardAbout"></pie-chart>
            </div>
        </div>



    </div>

@stop