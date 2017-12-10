@extends('layouts.app')

@section('content')

    <div class="container">

        <total-enquiries enquiries="{{ $dates }}"></total-enquiries>

        <ul class="mb-4 list-group pt-4">
            @foreach($dates as $date => $enquiries)
                {{ $date }}
                @foreach ($enquiries as $enquiry)
                    <li class="list-group-item">{{ $enquiry->full_name }} | {{ $enquiry->email }} | £{{ number_format($enquiry->total_cost, 2) }} | {{ str_before($enquiry->job_type, '|') }} | {{ str_before($enquiry->job_value, '|') }}</li>
                @endforeach
            @endforeach
        </ul>

    </div>

@stop