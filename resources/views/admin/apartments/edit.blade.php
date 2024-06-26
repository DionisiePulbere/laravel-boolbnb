@extends('layouts.admin')

@section('content')
    <div class="container pb-5 mb-5">
        <div class="d-flex align-items-center mb-4 show-header pb-2">
            <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}" class="my-arrow-left text-dark"><i class="fa-solid fa-chevron-left"></i></a>
            <h2 class="fw-bold ms-3 mb-0">Modifica casa</h2>
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

        <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Include this for the PUT request -->

            <div class="mb-3">
                <label for="title" class="form-label">Nome dell'immobile</label>
                <input type="text" placeholder="Inserisci il nome della tua casa" class="form-control" id="title" name="title" value="{{ old('title', $apartment->title) }}">
            </div>

            {{--  INFO PER LA GEOCALIZZAZIONE --}}
            <div class="mb-3">
                <label for="via" class="form-label">Via</label>
                <input type="text" placeholder="es. Via Roma" class="form-control" id="via" name="via" value="{{ old('via', $apartment->via) }}">
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Numero</label>
                <input type="text" placeholder="Inserisci il numero civico" class="form-control" id="numero" name="numero" value="{{ old('numero', $apartment->numero) }}">
            </div>
            <div class="mb-3">
                <label for="citta" class="form-label">Città</label>
                <input type="text" placeholder="Inserisci la città" class="form-control" id="citta" name="citta" value="{{ old('citta', $apartment->citta) }}">
            </div>
            <div class="mb-3">
                <label for="cap" class="form-label">Cap</label>
                <input type="text" placeholder="Inserisci il cap" class="form-control" id="cap" name="cap" value="{{ old('cap', $apartment->cap) }}">
            </div>
            {{-- FINE INFO PER LA GEOCALIZZAZIONE --}}

            <div class="mb-3">
                <label for="thumb" class="form-label">Immagine di copertina (min.1)</label>
                @if ($apartment->thumb)
                    <div class="mb-3">
                        {{-- <img src="{{ asset('storage/' . $apartment->thumb) }}" style="max-width: 100px;"> --}}
                        <div class="overflow-hidden" style="border-radius: 12px;max-width:300px">
                            <img src="https://a0.muscache.com/im/pictures/84e3c5a5-ae64-4909-8791-7ea562302b4a.jpg?im_w=1200" alt="" class="w-100" >
                        </div>
                    </div>
                @endif
                <input class="form-control" type="file" id="thumb" name="thumb">
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Altri immagini (min.3)</label>
                {{-- @if ($apartment->cover_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $apartment->cover_image) }}" style="max-width: 100px;">
                    </div>
                @endif --}}
                <input class="form-control" type="file" id="cover_image" name="cover_image">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="text" placeholder="Prezzo per una notte" class="form-control" id="price" name="price" value="{{ old('price', $apartment->price) }}">
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri quadrati</label>
                <input type="text" placeholder="Inserisci i metri quadrati" class="form-control" id="square_meters" name="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
            </div>

            <div class="mb-3">
                <label for="number_of_room" class="form-label">Numero di stanze</label>
                <select class="form-select" id="number_of_room" name="number_of_room">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if (old('number_of_room', $apartment->number_of_room) == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="number_of_bed" class="form-label">Numero di letti</label>
                <select class="form-select" id="number_of_bed" name="number_of_bed">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if (old('number_of_bed', $apartment->number_of_bed) == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="number_of_bath" class="form-label">Numero di bagni</label>
                <select class="form-select" id="number_of_bath" name="number_of_bath">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" @if (old('number_of_bath', $apartment->number_of_bath) == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" placeholder="Descrivi dettagliatamente la tua casa..." id="description" rows="10" name="description">{{ old('description', $apartment->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-dark mt-3">Modifica<i class="fa-solid fa-pen ms-3"></i></button>
        </form>
    </div>
@endsection
