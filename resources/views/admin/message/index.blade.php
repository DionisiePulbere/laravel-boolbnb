@extends('layouts.admin')

@section('content')
    <h2>Messaggi Ricevuti</h2>
    @if($messages->isEmpty())
        <p>Non hai ricevuto nessun messaggio.</p>
    @else
        <ul class="list-group">
            @foreach($messages as $message)
                <li class="list-group-item">
                    <p><strong>Appartamento:</strong> {{ $message->apartment->title }}</p> 
                    <p><strong>Indirizzo:</strong> {{ $message->apartment->address }}</p> 
                    <p><strong>Nome:</strong> {{ $message->name }}</p>
                    <p><strong>Email:</strong> {{ $message->email }}</p>
                    <p><strong>Oggetto:</strong> {{ $message->object }}</p>
                    <p><strong>Messaggio:</strong> {{ $message->description }}</p>
                    <hr>
                    <form action="{{ route('admin.message.destroy', $message->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection