@extends('layouts.admin')

@section('content')
    <div class="container pb-5 mb-5">
        <div class="d-flex align-items-center mb-4 show-header pb-2">
            <a href="{{ route('admin.apartments.index') }}" class="my-arrow-left text-dark"><i class="fa-solid fa-chevron-left"></i></a>
            <h2 class="fw-bold ms-3 ">Aggiungi una casa</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.apartments.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Nome dell'immobile</label>
                <input type="text" placeholder="Inserisci il nome della tua casa" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            {{--  INFO PER LA GEOCALIZAZZIONE --}}
            <div class="mb-3">
                <label for="via" class="form-label">Via</label>
                <input type="text" placeholder="es. Via Roma" class="form-control" id="via" name="via" value="{{ old('via') }}">
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Numero</label>
                <input type="text" placeholder="Inserisci il numero civico" class="form-control" id="numero" name="numero" value="{{ old('numero') }}">
            </div>
            <div class="mb-3">
                <label for="citta" class="form-label">Città</label>
                <input type="text" placeholder="Inserisci la città" class="form-control" id="citta" name="citta" value="{{ old('citta') }}">
            </div>
            <div class="mb-3">
                <label for="cap" class="form-label">Cap</label>
                <input type="text" placeholder="Inserisci il cap" class="form-control" id="cap" name="cap" value="{{ old('cap') }}">
            </div>
            {{-- FINE INFO PER LA GEOCALIZAZZIONE --}}
            <div class="mb-3">
                <label for="thumb" class="form-label">Immagine di copertina (min.1)</label>
                <input class="form-control" type="file" id="thumb" name="thumb">
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Altri immagini (min.3)</label>
                <input class="form-control" type="file" id="cover_image" name="cover_image">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="text" placeholder="Prezzo per una notte"  class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>
            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri quadrati</label>
                <input type="text" placeholder="Inserisci i metri quadrati" class="form-control" id="square_meters" name="square_meters" value="{{ old('square_meters') }}">
            </div>
            <div class="mb-3">
                <label for="number_of_room" class="form-label">Numero di stanze</label>
                <select class="form-select" id="number_of_room" name="number_of_room">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if(old('number_of_room', $apartment->number ?? '') == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>     
            <div class="mb-3">
                <label for="number_of_bed" class="form-label">Numero di letti</label>
                <select class="form-select" id="number_of_bed" name="number_of_bed">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if(old('number_of_bed', $apartment->number ?? '') == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>   
            <div class="mb-3">
                <label for="number_of_bath" class="form-label">Numero di bagni</label>
                <select class="form-select" id="number_of_bath" name="number_of_bath">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if(old('number_of_bath', $apartment->number ?? '') == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>  
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" placeholder="Descrivi dettagliatamente la tua casa..."  id="description" rows="10" name="description">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn my-btn-primary text-white mt-3">Salva <i class="fa-solid fa-plus ms-2"></i></button>
        </form>  
    </div>
@endsection
