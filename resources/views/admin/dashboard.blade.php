@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold ms-3">Ciao {{ Auth::user()->name . " " .Auth::user()->surname }} 👋🏼</h2>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header text-white" style="background-color: #FF5A5F">Appartmenti totali</div>
                        <h1 class="py-1">{{ $apartmentData['total_apartments'] }}</h1>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header text-white" style="background-color: #FF5A5F">Sponsorizzazioni attive</div>
                        <h1 class="py-1">{{ $apartmentData['total_sponsors'] }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-11">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th class="pt-1 ps-2"><h4>Nome appartamento</h4></th>
                            <th class="pt-1 text-center"> <h4>Visualizzaizoni</h4></th>
                            <th class="pt-1 text-center"><h4>Messaggi</h4></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartmentStats as $apartment)
                            <tr>
                                <td class="ps-2">{{ $apartment['title'] }}</td>
                                <td class="text-center">{{ $apartment['total_views'] }}</td>
                                <td class="text-center">{{ $apartment['total_messages'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
@endsection
