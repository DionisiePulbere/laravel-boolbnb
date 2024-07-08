@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold ms-3">Ciao {{ Auth::user()->name . " " .Auth::user()->surname }} 👋🏼</h2>
        <div class="container">
            <div class="d-flex justify-content-around mt-4">
                <div class="col-5 text-center">
                    <table class="dashboard-table text-center">
                        <thead>
                            <tr>
                                <th>
                                    <h4 class="pt-2">Appartamenti totali</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h1>{{ $apartmentData['total_apartments'] }}</h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-5 text-center">
                    <table class="dashboard-table text-center">
                        <thead>
                            <tr>
                                <th>
                                    <h4 class="pt-2">Sponsorizzazioni attive</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h1>{{ $apartmentData['total_sponsors'] }}</h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <div class="col-11 ">
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
