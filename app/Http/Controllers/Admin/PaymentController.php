<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $gateway;
    protected $sponsorshipOptions;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        // Inizializzazione delle opzioni di sponsorizzazione
        $this->sponsorshipOptions = [
            ['hours' => 24, 'price' => '1 giorno - 2.99 €'],
            ['hours' => 72, 'price' => '3 giorni - 5.99 €'],
            ['hours' => 144, 'price' => '6 giorni - 9.99 €'],
        ];
    }

    public function index()
    {
        $user = Auth::user();

        $sponsorshipOptions = [
            ['hours' => 24, 'price' => '1 giorno - 2.99 €'],
            ['hours' => 72, 'price' => '3 giorni - 5.99 €'],
            ['hours' => 144, 'price' => '6 giorni - 9.99 €'],
        ];
        $clientToken = $this->gateway->clientToken()->generate();
        return view('admin.payment.index', compact('clientToken', 'sponsorshipOptions', 'user'));
    }
    public function checkout(Request $request)
    {
        $nonce = $request->payment_method_nonce;
        $sponsorship_type = $request->sponsorship_type;

        // Trova l'opzione di sponsorizzazione corrispondente
        $selectedOption = collect($this->sponsorshipOptions)->where('hours', $sponsorship_type)->first();

        if (!$selectedOption) {
            return redirect()->back()->with('error', 'Opzione di sponsorizzazione non valida.');
        }

        // Ottieni l'importo dal prezzo dell'opzione selezionata
        $price = $selectedOption['price'];

        // Rimuovi il simbolo della valuta e converti in float (ad esempio, '3.99 €' diventa 3.99)
        $amount = (float) preg_replace('/[^0-9.]/', '', $price);

        try {
            $result = $this->gateway->transaction()->sale([
                'amount' => $amount,
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Errore durante il pagamento: ' . $e->getMessage());
        }
    }
}

