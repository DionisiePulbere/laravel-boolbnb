@extends('layouts.admin')

@section('content')

    @if ($apartment->visibility === 0)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white text-center" style="background-color: #FF5A5F">Effettua il pagamento</div>
    
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
    
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
    
                        <form method="post" id="payment-form" action="{{ route('admin.payment.checkout') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="sponsorships" class="form-label">Sponsorizza</label>
                                <select class="form-select" name="sponsorships" id="sponsorships">
                                    <option value="" selected>Seleziona la sponsor per il tuo appartamento</option>
                                    @foreach ($sponsorships as $sponsor)
                                        @php
                                              $duration = '';
                                                if ($sponsor->type === 'One day') {
                                                    $duration = '1 giorno';
                                                } elseif ($sponsor->type === 'Three days') {
                                                    $duration = '3 giorni';
                                                } elseif ($sponsor->type === 'Six days') {
                                                    $duration = '6 giorni';
                                                }
                                        @endphp
                                        <option value="{{ $sponsor->id }}">{{ $duration }} - {{ $sponsor->price }} €</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="cardholder-name">Nome del titolare della carta</label>
                                    <input type="text" id="cardholder-name" name="cardholder_name" value="{{ Auth::user()->name . " " . Auth::user()->surname }}" class="form-control" readonly required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="apartment-name">Nome appartamento</label>
                                    <input type="text" name="apartment_name" value="{{ $apartment->title }}" class="form-control" readonly required>
                                    <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                                </div>
                            </div>
    
                            <div class="form-group mb-3">
                                <label for="card-number">Numero della carta di credito</label>
                                <input type="text" id="card-number" name="card_number"  value="4111 1111 1111 1111" class="form-control" placeholder="Inserisci il numero della carta di credito" required>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="expiration-date">Scadenza</label>
                                    <input type="text" id="expiration-date" name="expiration_date" value="04/25" class="form-control" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/\d{2}$" maxlength="5" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" class="form-control" value="123" placeholder="CVV" required>
                                </div>
                            </div>
    
                            <!-- Elemento per il drop-in UI di Braintree -->
                            <div id="bt-dropin"></div>
    
                            <div class="d-flex justify-content-center">
                                <!-- Campo nascosto per il nonce generato da Braintree -->
                                <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
                                <button type="submit" class="btn dashboard-logout px-3 py-2 text-white" id="submit-button" style="background-color: #FF5A5F">Paga adesso</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif ($apartment->visibility === 1)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-white text-center" style="background-color: #FF5A5F">Annulla la sponsorizzazione</div>
                        <form method="post" id="payment-form" action="{{ route('admin.payment.checkout') }}">
                            @csrf
                            <div class="form-group my-3 mx-5">
                                <label for="cardholder-name">Nome appartamento</label>
                                <input type="text" name="{{$apartment->title}}" value="{{$apartment->title}}" class="form-control" readonly required>
                                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                            </div>
                            <div class="form-group my-3 mx-5">
                                <label for="cancel_sponsorship" class="form-label">Vuoi annullare la sponsorizzazione?</label>
                                <select class="form-select" name="cancel_sponsorship" id="cancel_sponsorship">
                                    <option value="no" selected>No</option>
                                    <option value="yes">Sì</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn dashboard-logout px-3 py-2 my-3 text-white" id="submit-button" style="background-color: #FF5A5F">Modifica</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

