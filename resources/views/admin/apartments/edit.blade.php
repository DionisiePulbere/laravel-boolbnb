@extends('layouts.admin')

@section('content')
    <div class="container pb-5 mb-5">
        <div class="d-flex align-items-center mb-4 show-header pb-2">
            <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->slug]) }}" class="my-arrow-left text-dark"><i class="fa-solid fa-chevron-left"></i></a>
            <h2 class="fw-bold ms-3 mb-0">Modifica casa</h2>
        </div>

        <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Include this for the PUT request -->

            @if ($apartment->visibility === 0)
                <div class="mb-3">
                    <label for="sponsorships" class="form-label">Sposorizza</label>
                    <select class="form-select" name="sponsorships[]" id="sponsorships">
                        <option value="" selected>Seleziona la sponsor per il tuo appartamento</option>
                        @foreach ($sponsorships as $sponsor)
                            @php
                                // Supponiamo che $sponsor->duration contenga "24:00:00"
                                $duration = $sponsor->duration;
                                // Estrai le ore
                                $hours = (int)explode(':', $duration)[0];
                            @endphp
                        <option @selected($sponsor->id == old('sponsor_id', $apartment->sponsor_id)) {{ in_array($sponsor->id, $apartment->sponsorships->pluck('id')->toArray()) ? 'selected' : '' }} value="{{ $sponsor->id }}">{{$sponsor->type}} ({{$hours}}h) - {{$sponsor->price}}€</option>
                        @endforeach
                      </select>
                    @error('sponsorships')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @else
                <div class="mb-3">
                    <label for="sponsorships" class="form-label">Vuoi annullare la sponsorizzazione?</label>
                    <select name="" id="">
                        <option value="">si</option>
                        <option value="">no</option>
                    </select>
                </div>
            @endif
            

            <div class="mb-3">
                <label for="title" class="form-label">Nome dell'immobile</label>
                <input type="text" placeholder="Inserisci il nome della tua casa" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $apartment->title) }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" placeholder="es. Via Roma, 58, Roma" class="form-control" id="address" name="address" value="{{ old('address', $apartment->address) }}">
                <ul id="suggestions"></ul>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="hidden" id="latitude" name="latitude" value="{{old('longitude', $apartment->latitude)}}">
                <input type="hidden" id="longitude" name="longitude" value="{{old('latitude', $apartment->longitude)}}">
            </div>
            <div class="mb-3">
                <label for="thumb" class="form-label">Immagine di copertina (min.1)</label>
                @if ($apartment->thumb)
                    <div class="mb-3">
                        @if ($apartment->thumb)
                            <img src="{{ asset('storage/' . $apartment->thumb) }}" style="max-width: 100px;">
                        @else
                            <div class="overflow-hidden" style="border-radius: 12px;max-width:300px">
                                <img src="https://a0.muscache.com/im/pictures/84e3c5a5-ae64-4909-8791-7ea562302b4a.jpg?im_w=1200" alt="" class="w-100" > 
                            </div>
                        @endif
                    </div>
                @endif
                <input class="form-control" type="file" id="thumb" name="thumb">
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Altri immagini (min.3)</label>
                @if ($apartment->cover_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $apartment->cover_image) }}" style="max-width: 100px;">
                    </div>
                @endif
                <input class="form-control" type="file" id="cover_image" name="cover_image" multiple>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" placeholder="Prezzo per una notte" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $apartment->price) }}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri quadrati</label>
                <input type="number" placeholder="Inserisci i metri quadrati" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
                @error('square_meters')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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

            @php
            $zone = $services->chunk(ceil($services->count() / 2));
            @endphp
            <div>
                <h5>Servizi:</h5>
                <div class="mb-3 d-flex">
                    @foreach ($zone as $zona)
                    <div style="flex: 1;">
                        @foreach ($zona as $service)
                        <div class="form-check p-10">
                            @if ($errors->any())
                                {{-- Se ci sono errori di validazione vuol dire che l'utente ha gia inviato il form quindi controllo l'old --}}
                                <input class="form-check-input" @checked(in_array($service->id, old('services', []))) type="checkbox" name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}">
                            @else
                                {{-- Altrimenti vuol dire che stiamo caricando la pagina per la prima volta quindi controlliamo la presenza dei servizi nella collection che ci arriva dal db --}}
                                <input class="form-check-input" @checked($apartment->services->contains($service)) type="checkbox" name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}">
                            @endif
                                <label for="service-{{ $service->id }}"><i class="{{ $service->icon }} me-2"></i>{{ $service->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Descrivi dettagliatamente la tua casa..." id="description" rows="10" name="description">{{ old('description', $apartment->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-dark mt-3">Modifica <i class="fa-solid fa-pen ms-3"></i></button>
        </form>
    </div>
@endsection
