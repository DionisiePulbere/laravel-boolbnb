@extends('layouts.admin')

@section('content')
    <h2>Messaggi Eliminati</h2>
    @if($messages->isEmpty())
        <p>Non hai messaggi nel cestino.</p>
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
                    <form action="{{ route('admin.message.restore', $message->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning">Ripristina</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection