@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex align-items-center mb-5 show-header">
            <a href="{{ route('admin.apartments.index') }}" class="my-arrow-left text-dark"><i class="fa-solid fa-chevron-left"></i></a>
            <h2 class="fw-bold ms-3 mb-0">Torna indietro</h2>
        </div>
        <div class="overflow-hidden" style="border-radius: 12px;width:75%">
            <img src="https://a0.muscache.com/im/pictures/84e3c5a5-ae64-4909-8791-7ea562302b4a.jpg?im_w=1200" alt="" class="w-100" >
        </div>
        <div class="mb-3 mt-3">
            @if ($apartment->visibility = 1)
                <button class="btn my-register-btn px-3" >Sponsorizzato <i class="fa-solid fa-crown"></i></button>
                {{-- Magari poi lo riportiamo alla show della sponsorizzazione --}}
            @elseif ($apartment->visibility = 0)
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
        <p class="dashboard-p">{{$apartment->description}}</p>
    </div>
@endsection