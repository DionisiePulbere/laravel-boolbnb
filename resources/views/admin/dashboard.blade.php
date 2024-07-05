@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold">Benvenuto/a {{ Auth::user()->name . " " .Auth::user()->surname }} 👋🏼</h1>

    <div class="container mt-5">
        <div class="d-flex">
            <div id="uno" class="row flex-column me-5">
                <div class="col">
                    <h1 class="text-center">Appartamenti</h1>
                    <div class="container-fluid">
                        <div></div>
                    </div>
                </div>
            </div>
            <div id="due" class="row flex-column">
                <div class="col">
                    <h1 class="text-center">Messaggi</h1>
                </div>
            </div>
        </div>
        <div class="d-flex my-5">
            <div id="tre" class="row flex-column me-5">
                <div class="col">
                    <h1 class="text-center">Sponsor</h1>
                </div>
            </div>
            <div id="quattro" class="row flex-column pd-2">
                <div class="col">
                    <h1 class="text-center">Statistiche</h1>
                </div>
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