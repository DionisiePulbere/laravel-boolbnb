@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column mb-5">
        <div class="d-flex align-items-center mb-5 show-header pb-2">
            <a href="{{ route('admin.apartments.index') }}" class="my-arrow-left text-dark"><i class="fa-solid fa-chevron-left"></i></a>
            <h2 class="fw-bold ms-3 mb-0">Torna alle case</h2>
        </div>
        <div class="overflow-hidden" style="border-radius: 12px;width:75%">
            <img src="https://a0.muscache.com/im/pictures/84e3c5a5-ae64-4909-8791-7ea562302b4a.jpg?im_w=1200" alt="" class="w-100" >
        </div>
        <div class="mb-3 mt-3">
            @if ($apartment->visibility === 1)
                <button class="btn my-register-btn px-3" >Sponsorizzato <i class="fa-solid fa-crown"></i></button>
                {{-- Magari poi lo riportiamo alla show della sponsorizzazione --}}
            @elseif ($apartment->visibility === 0)
                <button class="btn my-btn-primary text-white">
                    Sponsorizza questa casa<i class="fa-solid fa-ranking-star ms-3"></i>
                </button>
            @endif
        </div>
        <h2 class="fw-bold mt-4">{{$apartment->title}}</h2>
        <p class="dashboard-p"><span class="price-bold">Indirizzo: </span>{{$apartment->address}}</p>
        <p class="dashboard-p"><span class="price-bold">{{$apartment->price}} €</span> a notte.</p>
        <p class="dashboard-p">
            @if ($apartment->number_of_room < 2)
                {{$apartment->number_of_room}} camera da letto &#183;
            @elseif ($apartment->number_of_room >= 2)
                {{$apartment->number_of_room}} camere da letto &#183;
            @endif

            @if ($apartment->number_of_bed < 2)
                {{$apartment->number_of_bed}} letti &#183;
            @elseif ($apartment->number_of_bed >= 2)
                {{$apartment->number_of_bed}} letti &#183;
            @endif

            @if ($apartment->number_of_bath < 2)
                {{$apartment->number_of_bath}} bagno &#183;
            @elseif ($apartment->number_of_bath >= 2)
                {{$apartment->number_of_bath}} bagni &#183;
            @endif

            {{$apartment->square_meters}} m<sup>2</sup>
        </p>
        <p class="dashboard-p">
            
            @if (count($apartment->services) > 0)
            @foreach ($apartment->services as $service)
                <i class="{{ $service->icon }}"></i> {{ $service->name }}@if (!$loop->last),@endif
            @endforeach
            @else
                nessun servizio offerto
            @endif
        </p>
        <p class="dashboard-p">{{$apartment->description}}</p>
        <div class="d-flex mt-4">
            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}" class="btn btn-outline-dark">
                Modifica casa<i class="fa-solid fa-pen ms-3"></i>
            </a>
            <form action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->slug]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn my-btn-primary text-white ms-5 js-delete-btn" data-apartment-title="{{ $apartment->title }}">
                Elimina casa<i class="fa-solid fa-trash ms-3"></i>
                </button>
            </form>  
        </div>
    </div>
    <!-- modale -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmDeleteModal">Conferma Eliminazione</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" id="confirm-deletion" class="btn my-btn-primary text-white">Cancella</button>
            </div>
        </div>
    </div>
@endsection