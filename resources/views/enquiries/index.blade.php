@extends('layouts.app')

@section('content')

    <div class="container">

        @foreach($enquiries as $enquiry)
            <div class="mb-4">
                {{ $enquiry->full_name }}
                {{ $enquiry->email }}
                {{ $enquiry->phone_number }}
                {{ $enquiry->heard_about }}
                {{ $enquiry->postcode }}
                {{ $enquiry->total_cost }}
                {{ $enquiry->job_type }}
                {{ $enquiry->job_value }}
                {{ $enquiry->job_age }}
            </div>
        @endforeach

    </div>

@stop