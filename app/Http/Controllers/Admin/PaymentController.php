<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'), 
        ]);
    }

    public function index()
    {
        $sponsorshipOptions = [
            ['hours' => 24, 'price' => '2.99 € per 24 ore'],
            ['hours' => 72, 'price' => '5.99 € per 72 ore'],
            ['hours' => 144, 'price' => '9.99 € per 144 ore'],
        ];
        $clientToken = $this->gateway->clientToken()->generate();
        return view('admin.payment.index', compact('clientToken', 'sponsorshipOptions'));
    }

    public function checkout(Request $request)
    {
        $nonce = $request->payment_method_nonce;

        $result = $this->gateway->transaction()->sale([
            'amount' => '10.00', // Modifica l'importo secondo necessità
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return redirect()->back()->with('success', 'Pagamento effettuato con successo!');
        } else {
            $errorString = "";
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return redirect()->back()->with('error', 'Errore durante il pagamento: ' . $errorString);
        }
    }
}

