<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\BraintreeService;

class PaymentController extends Controller
{
    protected $gateway;
    protected $sponsorshipOptions;
    protected $braintree; 

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree->getGateway();
        $this->sponsorshipOptions = [
            ['hours' => 24, 'price' => ' 2.99 €', 'show' => '1 giorno - 2.99 €'],
            ['hours' => 72, 'price' => ' 5.99 €', 'show' => '3 giorni - 5.99 €'],
            ['hours' => 144, 'price' => '9.99 €', 'show' => '6 giorni - 9.99 €'],
        ];
    }

    public function index()
    {
        $user = Auth::user();
        $clientToken = $this->braintree->clientToken()->generate();
        $sponsorshipOptions = $this->sponsorshipOptions;
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

        // Converti il prezzo in float, rimuovendo il simbolo della valuta e qualsiasi carattere non numerico o decimale
        $amount = (float) preg_replace('/[^0-9.,]/', '', $price);

        try {
            $result = $this->braintree->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => 'fake-valid-nonce',
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

