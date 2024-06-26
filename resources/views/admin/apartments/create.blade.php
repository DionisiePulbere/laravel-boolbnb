@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Aggiungi il tuo appartamento</h1>
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
                <label for="name" class="form-label">Nome dell'immobile</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            {{--  INFO PER LA GEOCALIZAZZIONE --}}
            <div class="mb-3">
                <label for="via" class="form-label">Via</label>
                <input type="text" class="form-control" id="via" name="via" value="{{ old('via') }}">
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Numero</label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}">
            </div>
            <div class="mb-3">
                <label for="citta" class="form-label">Città</label>
                <input type="text" class="form-control" id="citta" name="citta" value="{{ old('citta') }}">
            </div>
            <div class="mb-3">
                <label for="cap" class="form-label">Cap</label>
                <input type="text" class="form-control" id="cap" name="cap" value="{{ old('cap') }}">
            </div>
            {{-- FINE INFO PER LA GEOCALIZAZZIONE --}}
            <div class="mb-3">
                <label for="primary_image" class="form-label">Immagine di copertina (min.1)</label>
                <input class="form-control" type="file" id="primary_image" name="primary_image">
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Altri immagini (min.3)</label>
                <input class="form-control" type="file" id="cover_image" name="cover_image">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>
            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri quadrati</label>
                <input type="text" class="form-control" id="square_meters" name="square_meters" value="{{ old('square_meters') }}">
            </div>
            <div class="mb-3">
                <label for="number_of_rooms" class="form-label">Numero di stanze</label>
                <select class="form-select" id="number_of_rooms" name="number_of_rooms">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if(old('number_of_rooms', $apartment->number ?? '') == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>     
            <div class="mb-3">
                <label for="number_of_beds" class="form-label">Numero di letti</label>
                <select class="form-select" id="number_of_beds" name="number_of_beds">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if(old('number_of_beds', $apartment->number ?? '') == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>   
            <div class="mb-3">
                <label for="number_of_bathrooms" class="form-label">Numero di bagni</label>
                <select class="form-select" id="number_of_bathrooms" name="number_of_bathrooms">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if(old('number_of_bathrooms', $apartment->number ?? '') == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>  
            <div class="mb-3">
                <label for="summary" class="form-label">Descrizione</label>
                <textarea class="form-control" id="summary" rows="10" name="summary">{{ old('summary') }}</textarea>
            </div>
            <button type="submit" class="btn my-btn-primary text-white">Salva</button>
        </form>  
    </div>
@endsection
