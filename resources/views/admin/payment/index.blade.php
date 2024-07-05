@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Effettua il pagamento</div>

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
                              <label for="amount">Seleziona il tipo di sponsorizzazione:</label>
                              <select name="sponsorship_type" id="sponsorship_type" class="form-select" required>
                                  @foreach($sponsorshipOptions as $option)
                                      <option value="{{ $option['hours'] }}">{{ $option['price'] }}</option>
                                  @endforeach
                              </select>
                          </div>

                            <div class="form-group mb-3">
                                <label for="cardholder-name">Nome del titolare della carta</label>
                                <input type="text" id="cardholder-name" name="cardholder_name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="card-number">Numero della carta di credito</label>
                                <input type="text" id="card-number" name="card_number" class="form-control" placeholder="Inserisci il numero della carta di credito" required>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="expiration-date">Scadenza</label>
                                    <input type="text" id="expiration-date" name="expiration_date" class="form-control" placeholder="MM/AA" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="CVV" required>
                                </div>
                            </div>

                            <div id="bt-dropin"></div>
                              <input type="hidden" id="nonce" name="payment_method_nonce">

                              <button type="submit" class="btn btn-primary">Paga adesso</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.braintreegateway.com/web/3.79.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.79.1/js/hosted-fields.min.js"></script>
    <script>
        const form = document.querySelector('#payment-form');
        const clientToken = "{{ $clientToken }}";

        braintree.client.create({
            authorization: clientToken
        }, function (clientErr, clientInstance) {
            if (clientErr) {
                console.error(clientErr);
                return;
            }

            braintree.hostedFields.create({
                client: clientInstance,
                styles: {
                    input: {
                        'font-size': '14px',
                        'font-family': 'helvetica, tahoma, calibri, sans-serif',
                        'color': '#3a3a3a'
                    },
                    ':focus': {
                        'color': 'black'
                    }
                },
                fields: {
                    cardholderName: {
                        selector: '#cardholder-name',
                        placeholder: 'Nome del titolare'
                    },
                    number: {
                        selector: '#card-number',
                        placeholder: 'Numero della carta'
                    },
                    expirationDate: {
                        selector: '#expiration-date',
                        placeholder: 'MM/AA'
                    },
                    cvv: {
                        selector: '#cvv',
                        placeholder: 'CVV'
                    }
                }
            }, function (hostedFieldsErr, hostedFieldsInstance) {
                if (hostedFieldsErr) {
                    console.error(hostedFieldsErr);
                    return;
                }

                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                        if (tokenizeErr) {
                            console.error(tokenizeErr);
                            return;
                        }

                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();
                    });
                });
            });
        });
    </script>
@endsection



{{-- @extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Effettua il pagamento</div>

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

                            <div class="form-group">
                                <label for="amount">Importo da addebitare:</label>
                                <input type="text" id="amount" name="amount" class="form-control" value="10.00" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nonce">Nonce di pagamento:</label>
                                <input type="hidden" id="nonce" name="payment_method_nonce">
                                <div id="bt-dropin"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Paga adesso</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>
    <script>
        const form = document.querySelector('#payment-form');
        const clientToken = "{{ $clientToken }}";

        braintree.dropin.create({
            authorization: client_token,
            container: '#bt-dropin'
        }, function (createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection --}}


