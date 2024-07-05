@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold">Benvenuto/a {{ Auth::user()->name . " " .Auth::user()->surname }} 👋🏼</h1>

        <div class="container mt-5">
            <div class="card text-bg-danger mb-3" style="background-color: #FF5A5F">
                <div class="card-header fs-3 text-center">Statistiche</div>
                <div class="card-body">
                    <h5>Il numero delle sponsorizzazioni fatte è stato: {{ $totalSponsors }}</h5>
                    <h5>Il numero delle visite totali è: {{ $totalViews }}</h5>
                    <h5>Il numero dei messaggi totali ricevuti è: {{ $totalMessages }}</h5>
                </div>
            </div>
        </div>
        

@endsection

<style>
#uno{
    width: 400px;
    height: 400px;
    border: 1px solid blue;
}
#due{
    width: 400px;
    height: 400px;
    border: 1px solid black;
}
#tre{
    width: 400px;
    height: 400px;
    border: 1px solid rgb(43, 255, 0);
}
#quattro{
    width: 400px;
    height: 400px;
    border: 1px solid rgb(255, 0, 0);
}
</style>