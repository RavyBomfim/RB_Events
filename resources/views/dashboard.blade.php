@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offser-md-1 dashboard-title-container">
    <h1>Meus eventos</h1>
</div>

<div class="col-md-10 offser-md-1 dashboard-events-container">
    @if(count($events) > 0)
        <p></p>
    @else
        <p>Vocâ ainda não possui eventos, <a href="/events/create">criar evento.</a></p>
    @endif
</div>

@endsection