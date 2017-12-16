@extends('layouts.report')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    <div class="container">

        <h1 class="mb-3">Your report for {{ \Carbon\Carbon::now()->format('F') }}</h1>

        <div class="mb-5">
            <p>In total there were {{ $enquiries->sum() }} enquiries made in {{ \Carbon\Carbon::now()->format('F') }}. This is
            {{ $enquiries->sum() > $last_month->sum() ? 'an increase over' : 'a decrease from' }} last month, when you generated
            {{ $last_month->sum() }} enquiries. The total value of the enquiries generated was £{{ number_format($total_value->sum(), 2) }}.</p>

            <p>The majority of your enquiries discovered you through {{ $heard_about->keys()->first() ? $heard_about->keys()->first() : 'an unknown source' }}.
            The most common page for an enquiry to be made on the website was {{ $page_submitted->keys()->first() }}. The majority of your enquiries were for {{ str_plural($enquiries->keys()->first()) }},
            with a total of {{ $enquiries->first() }} enquiries being made.</p>

        </div>

        <div class="row">
            <div class="col-6">
                <div style="width: 500px; height: 500px;">
                    <pie-chart data="{{ $heard_about }}" title="Heard about" name="heardAbout"></pie-chart>
                </div>
            </div>
            <div class="col-6">
                <div style="width: 500px; height: 500px;">
                    <pie-chart data="{{ $enquiries }}" title="Jobs by type" name="byType"></pie-chart>
                </div>
            </div>
        </div>



    </div>

    <script>


    </script>

@stop