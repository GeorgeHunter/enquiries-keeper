@extends('layouts.app')

@section('content')

    <div class="container">

        <enquiry-type-pie data="{{ $enquiries }}" title="Jobs by type"></enquiry-type-pie>

    </div>

@stop