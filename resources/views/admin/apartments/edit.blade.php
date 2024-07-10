@extends('layouts.admin')

@section('content')
    <div class="container pb-5 mb-5">
        <div class="d-flex align-items-center mb-4 show-header pb-2">
            <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->slug]) }}" class="my-arrow-left text-dark"><i class="fa-solid fa-chevron-left"></i></a>
            <h2 class="fw-bold ms-3 mb-0">Modifica casa</h2>
        </div>
            

            <div class="mb-3 input-control">
                <label for="title" class="form-label">Nome dell'immobile</label>
                <input type="text" placeholder="Inserisci il nome della tua casa" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $apartment->title) }}">
                <div class="error"></div>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 input-control">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" placeholder="es. Via Roma, 58, Roma" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $apartment->address) }}">
                <div class="error"></div>
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
                <label for="thumb" class="form-label @error('thumb') is-invalid @enderror">Immagine di copertina (min.1)</label>
                @if ($apartment->thumb)
                    <div class="mb-3 ms-image-container">
                        @if (filter_var($apartment->thumb, FILTER_VALIDATE_URL))
                            <img src="{{ $apartment->thumb }}" alt="{{ $apartment->title }}" class="ms-img">
                        @else
                            <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->title }}" class="ms-img">
                        @endif
                    </div>
                @endif
                <input class="form-control @error('thumb') is-invalid @enderror" type="file" id="thumb" name="thumb">
                @error('thumb')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label for="image" class="form-label">Altri immagini (min.3)</label>
            <div class="row m-0 mb-3 ">
                @foreach ($apartment->images as $image)
                    @if ($image->image)
                        @if (filter_var($image->image, FILTER_VALIDATE_URL))
                            <div class="ms-img-container col-6 col-lg-3  mb-3">
                                <div class="position-relative">
                                    <img src="{{ $image->image }}" alt="{{ $apartment->title }}" class="ms-img">
                                    <button class="delete-image-btn btn btn-danger btn-sm position-absolute top-0 end-0" data-image-id="{{ $image->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="ms-img-container col-md-6 col-3 mb-3 position-relative">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $apartment->title }}" class="ms-img">
                                <button class="delete-image-btn btn btn-danger btn-sm position-absolute top-0 end-0" data-image-id="{{ $image->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        @endif
                    @endif
                @endforeach
                <input class="form-control" type="file" id="image" name="image[]" multiple>
            </div>

            <div class="mb-3 input-control">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" placeholder="Prezzo per una notte" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $apartment->price) }}">
                <div class="error"></div>
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="mb-3 input-control">
                    <label for="square_meters" class="form-label">Metri quadrati</label>
                    <input type="number" placeholder="Inserisci i metri quadrati" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
                    <div class="error"></div>
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

            <div class="mb-3 input-control">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Descrivi dettagliatamente la tua casa..." id="description" rows="10" name="description">{{ old('description', $apartment->description) }}</textarea>
                <div class="error"></div>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" id="editSubmit" class="btn btn-dark mt-3">Modifica <i class="fa-solid fa-pen ms-3"></i></button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-image-btn');

            if (deleteButtons.length > 0) {
                deleteButtons.forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        
                        const imageId = this.getAttribute('data-image-id');
                        const imageContainer = this.parentElement;

                        fetch(`/admin/apartments/${imageId}/delete`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => {
                            imageContainer.remove();
                        })
                    });
                });
            } else {
                console.error('Nessun pulsante di eliminazione trovato.');
            }
        });
    </script>
    <script src="{{ asset('js/edit.js') }}" ></script>
@endsection
