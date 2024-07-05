<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function index()
    {
        return view('payment.index');
    }

    public function checkout(Request $request)
    {
        $nonce = $request->payment_method_nonce;

        // Effettua il pagamento utilizzando Braintree Gateway
        $result = $this->gateway->transaction()->sale([
            'amount' => '10.00',  // Sostituisci con l'importo effettivo da addebitare
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // Salvare il record della transazione nel database
            $transaction = $result->transaction;
            
            return redirect()->back()->with('success', 'Pagamento effettuato con successo!');
        } else {
            $errorString = "";
            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            
            return redirect()->back()->with('error', 'Errore durante il pagamento: '.$errorString);
        }
    }
}

