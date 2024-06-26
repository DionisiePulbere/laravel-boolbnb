@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold">Benvenuto {{ Auth::user()->name . " " .Auth::user()->surname }}</h1>
@endsection