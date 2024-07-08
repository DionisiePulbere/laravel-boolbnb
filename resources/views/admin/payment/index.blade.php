@extends('layouts.admin')

@section('content')
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
                            <label for="sponsorship_type">Seleziona il tipo di sponsorizzazione:</label>
                            <select name="sponsorship_type" id="sponsorship_type" class="form-select" required>
                                <option value="" selected>Seleziona..</option>
                                @foreach($sponsorshipOptions as $option)
                                    <option value="{{ $option['hours'] }}">{{ $option['show'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cardholder-name">Nome del titolare della carta</label>
                            <input type="text" id="cardholder-name" name="cardholder_name" value="{{ Auth::user()->name . " " .Auth::user()->surname }}" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="card-number">Numero della carta di credito</label>
                            <input type="text" id="card-number" name="card_number" value="4111 1111 1111 1111" class="form-control" placeholder="Inserisci il numero della carta di credito" required>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="expiration-date">Scadenza</label>
                                <input type="text" id="expiration-date" value="06/25" name="expiration_date" class="form-control" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/\d{2}$" maxlength="5" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" value="123" class="form-control" placeholder="CVV" required>
                            </div>
                        </div>

                        <!-- Elemento per il drop-in UI di Braintree -->
                        <div id="bt-dropin"></div>

                        <div class="d-flex justify-content-center">
                            <!-- Campo nascosto per il nonce generato da Braintree -->
                            <input type="hidden" id="nonce" name="payment_method_nonce">
                            <button type="submit" class="btn dashboard-logout px-3 py-2 text-white" id="submit-button" style="background-color: #FF5A5F">Paga adesso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

