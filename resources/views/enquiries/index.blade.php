@extends('layouts.app')

@section('content')

    <div class="container">

        <form class="pt-4">
            <div class="form-inline mb-2">

                <label class="sr-only" for="start-date">Start Date</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"><i class="far fa-calendar-alt"></i></div>
                    <input type="date" class="form-control" id="start-date" name="start-date" placeholder="Username" value="{{ request('start-date') }}">
                </div>

                <div class="mx-2">to</div>

                <label class="sr-only" for="end-date">End Date</label>
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <div class="input-group-addon"><i class="far fa-calendar-alt"></i></div>
                    <input type="date" class="form-control" id="end-date" name="end-date" placeholder="Username" value="{{ request('end-date') }}">
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input name="filter" value="true" type="checkbox" class="form-check-input" {{ request('filter') == "true" ? 'checked' : '' }}>
                        Use exclude list
                    </label>
                </div>
            </div>
            <button class="btn btn-primary btn-outline-primary" type="submit">Filter</button>
        </form>

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