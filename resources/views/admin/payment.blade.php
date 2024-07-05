@extends('layouts.admin')

@section('content')
<div class="bootstrap-basic">
    <form class="needs-validation" novalidate="">
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="cc-name">Cardholder Name</label>
                <div class="form-control" id="cc-name"></div>
                    <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                </div>
  
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <div class="form-control" id="cc-number"></div>
                    <div class="invalid-feedback">
                        Credit card number is required
                    </div>
                </div>
        <div class="col-sm-3 mb-3">
          <label for="cc-expiration">Expiration</label>
          <div class="form-control" id="cc-expiration"></div>
          <div class="invalid-feedback">
            Expiration date required
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <label for="cc-expiration">CVV</label>
          <div class="form-control" id="cc-cvv"></div>
          <div class="invalid-feedback">
            Security code required
          </div>
        </div>
      </div>
  
      <hr class="mb-4">
      <div class="text-center">
      <button class="btn btn-primary btn-lg" type="submit">Pay with <span id="card-brand">Card</span></button>
      </div>
    </form>
  </div>
  <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-header">
      <strong class="mr-auto">Success!</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Next, submit the payment method nonce to your server.
    </div>
  </div>
  </div>
@endsection

  

  
  
