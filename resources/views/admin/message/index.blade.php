@extends('layouts.admin')

@section('content')
    <h2>Messaggi Ricevuti</h2>
    @if($messages->isEmpty())
        <p>Non hai ricevuto nessun messaggio.</p>
    @else
        <ul class="list-group">
            @foreach($messages as $message)
                <li class="list-group-item">
                    <p><strong>Nome:</strong> {{ $message->name }}</p>
                    <p><strong>Email:</strong> {{ $message->email }}</p>
                    <p><strong>Oggetto:</strong> {{ $message->object }}</p>
                    <p><strong>Messaggio:</strong> {{ $message->description }}</p>
                    <hr>
                </li>
            @endforeach
        </ul>
    @endif
@endsection