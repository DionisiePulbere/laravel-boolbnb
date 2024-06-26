@extends('layouts.admin')

@section('content')
    @if ($apartments->count() > 0)
        <table class="table table-striped table-hover">
            <tr>
                <th>Id</th>
                <th>titolo</th>
                <th>Visibilità</th>
                <th>Prezzo</th>
                <th>Stanze</th>
                <th>Letti</th>
                <th>Bagni</th>
                <th>m<sup>2</sup></th>
                <th>Indirizzo</th>
                <th>Azioni</th>
                
                
            </tr>
            
            @foreach ($apartments as $apartment)
            <tr>
                <td>{{$apartment->id}}</td>
                <td>{{$apartment->title}}</td>
                <td>{{$apartment->visibility}}</td>
                <td>{{$apartment->price}}</td>
                <td>{{$apartment->rooms}}</td>
                <td>{{$apartment->number_of_bed}}</td>
                <td>{{$apartment->number_of_bath}}</td>
                <td>{{$apartment->square_meters}}</td>
                <td>{{$apartment->address}}</td>
                <td>
                    <div class="row justify-content-around">
                        <div class="col-4">
                            <a class="btn btn-primary" href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary" href="#"><i class="fa-solid fa-newspaper"></i></a>
                        </div>
                        <div class="col-4">

                            <form action="" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    
                </td>
            </tr>
            @endforeach
        </table>
    @else
    <div class="d-flex flex-column align-items-center text-center">
        <img src="{{ Vite::asset("resources/images/login.png") }}" alt="" class="w-100" >
        <h4 class="fw-bold mt-4">Metti la tua prima casa in <span class="primary-color">affitto</span></h4>
        <p>Clicca sul bottone qui sotto, compila il form di inserimento ed inizia subito a guadagnare con Boolbnb</p>
        
        <a class="btn my-btn-primary text-white w-50 mt-3 mb-5" href="{{ route('password.request') }}">
            Aggiungi <i class="fa-solid fa-house-medical ms-3"></i>
        </a>
    </div>
    @endif
    


@endsection