@extends('layouts.admin')

@section('content')

    @if ($apartments->count() > 0)
        <div class="rounded overflow-hidden">
            <table class="table">
                <tr>
                    <th class="d-none d-sm-table-cell">Id</th>
                    <th>Titolo</th>
                    <th class="d-none d-sm-table-cell">Sponsor</th>
                    <th>Indirizzo</th>
                    <th>Azioni</th>
                </tr>
                
                @foreach ($apartments as $apartment)
                <tr class="tr-table">
                    <td class="d-none d-sm-table-cell align-middle">{{$apartment->id}}</td>
                    <td class="align-middle">{{$apartment->title}}</td>
                    <td class="align-middle">
                        <span class="text-center">{{ $apartment->visibility == 1 ? 'SI' : 'NO' }}</span>
                    </td>
                    <td class="align-middle">{{$apartment->address}}</td>
                    <td class="align-middle">
                        <div class="row justify-content-center">
                            <div class="col-6 col-lg-4 d-flex justify-content-center">
                                <a class="btn btn-dark border-none" href="{{ route('admin.apartments.show', ['apartment' => $apartment->slug]) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                            
                            <div class="d-none d-lg-block col-lg-4 d-flex justify-content-center">
                                <a class="btn btn-dark border-none" href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </div>
                            
                            <div class="d-none d-lg-block col-lg-4 d-flex justify-content-center">
                                <form action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn my-btn-primary text-white js-delete-btn" data-apartment-title="{{ $apartment->title }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @else
    <div class="d-flex flex-column align-items-center text-center">
        <img src="{{ Vite::asset("resources/images/login.png") }}" alt="" class="w-100" >
        <h4 class="fw-bold mt-4">Metti la tua prima casa in <span class="primary-color">affitto</span></h4>
        <p>Clicca sul bottone qui sotto, compila il form di inserimento ed inizia subito a guadagnare con Boolbnb</p>
        
        <a class="btn my-btn-primary text-white w-50 mt-3 mb-5" href="{{ route('admin.apartments.create') }}">
            Aggiungi <i class="fa-solid fa-house-medical ms-3"></i>
        </a>
    </div>
    @endif
    
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
    </div>

@endsection
