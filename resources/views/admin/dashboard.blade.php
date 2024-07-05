@extends('layouts.admin')

@section('content')
    <h1 class="fw-bold">Ciao {{ Auth::user()->name . " " .Auth::user()->surname }} 👋🏼</h1>

        <div class="container mt-5">  
            <div class="d-flex justify-content-between">

                <div class="apartments text-center rounded">
                    <div class="top rounded-top">
                        <h4 class="pt-2">Appartamenti</h4>
                    </div>
                    <div class="bottom">
                        <h1 class="pt-1">{{ $userData['total_apartments'] }}</h1>
                    </div>
                </div>
                <div class="sponsors text-center rounded">
                    <div class="top rounded-top">
                        <h4 class="pt-2">Sponsorizzazioni</h4>
                    </div>
                    <div class="bottom">
                        <h1 class="pt-1">{{ $userData['total_sponsors'] }}</h1>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="views text-center rounded">
                    <div class="top rounded-top">
                        <h4 class="pt-2">Visite</h4>
                    </div>
                    <div class="bottom">
                        <h1 class="pt-1">{{ $userData['total_views'] }}</h1>
                    </div>
                </div>
                <div class="messages text-center rounded">
                    <div class="top rounded-top">
                        <h4 class="pt-2">Messaggi</h4>
                    </div>
                    <div class="bottom">
                        <h1 class="pt-1">{{ $userData['total_messages'] }}</h1>
                    </div>
                </div>
            </div>
        </div>
        

@endsection

<style>
 .views , .messages , .sponsors, .apartments{
    width: 48%;
    background-color:#FFE5E6;
    margin-bottom: 34px;
 }

 .top{
    background-color:#FF5A5F;
    padding-bottom: 2px;
 }
</style>