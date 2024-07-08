@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold ms-3">Ciao {{ Auth::user()->name . " " .Auth::user()->surname }} 👋🏼</h2>
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-white text-center" style="background-color: #FF5A5F">Totali appartamenti</div>
                            <div class="form-group my-3 mx-5 text-center">
                                <label class="pt-1 ">
                                    <h1 >{{ $userData['total_apartments'] }}</h1>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-white text-center" style="background-color: #FF5A5F">Totale sponsorizzazioni</div>
                                <div class="form-group my-3 mx-5 text-center">
                                    <label class="pt-1 ">
                                        <h1 >{{ $userData['total_sponsors'] }}</h1>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-white text-center" style="background-color: #FF5A5F">Totali views</div>
                                    <div class="form-group my-3 mx-5 text-center">
                                        <label class="pt-1 ">
                                            <h1 >{{ $userData['total_views'] }}</h1>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header text-white text-center" style="background-color: #FF5A5F">Totale messaggi</div>
                                        <div class="form-group my-3 mx-5 text-center">
                                            <label class="pt-1 ">
                                                <h1 >{{ $userData['total_messages'] }}</h1>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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