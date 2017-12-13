@extends('layouts.app')

@section('content')

    <div class="container">

        <ul class="mb-4 list-group pt-4">
            @foreach($dates as $date => $enquiries)
                <a href="/enquiries/analytics?start-date={{ $date }}&end-date={{ \Carbon\Carbon::parse($date)->addDay()->format('Y-m-d') }}" class="list-group-item list-group-item-action list-group-item-secondary">{{ $date }}</a>
                @foreach ($enquiries as $enquiry)
                    <li class="list-group-item">{{ $enquiry->full_name }} | {{ $enquiry->email }} | £{{ number_format($enquiry->total_cost, 2) }} | {{ str_before($enquiry->job_type, '|') }} | {{ str_before($enquiry->job_value, '|') }}</li>
                @endforeach
            @endforeach
        </ul>

    </div>

@stop