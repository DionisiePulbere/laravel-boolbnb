<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;
use App\Services\BraintreeService;
use Illuminate\Support\Carbon;

class PaymentController extends Controller{
    protected $gateway;
    protected $sponsorshipOptions;
    protected $braintree; 

    public function __construct(BraintreeService $braintree){
        $this->braintree = $braintree->getGateway();
    }

    public function index(Apartment $apartment){
        $user = Auth::user();
        $clientToken = $this->braintree->clientToken()->generate();
        $sponsorshipOptions = $this->sponsorshipOptions;
        $sponsorships = Sponsorship::all();

        return view('admin.payment.index', compact('apartment', 'sponsorships', 'clientToken', 'user'));
    }

    public function checkout(Request $request){
        $apartment = Apartment::find($request->apartment_id);

        if (!$apartment) {
            return redirect()->back()->with('error', 'Appartamento non trovato.');
        }

        // Annullamento delle sponsorizzazioni se necessario
        if ($request->has('cancel_sponsorship') && $request->cancel_sponsorship === 'yes') {
            $apartment->sponsorships()->detach();
            $apartment->visibility = 0;
            $apartment->save();
            return redirect()->back()->with('success', 'Sponsorizzazione annullata con successo.');
        }

        $sponsorship_id = $request->sponsorships; // ID dell'opzione di sponsorizzazione selezionata

        // Trova l'opzione di sponsorizzazione corrispondente
        $selectedOption = Sponsorship::find($sponsorship_id);

        if (!$selectedOption) {
            return redirect()->back()->with('error', 'Opzione di sponsorizzazione non valida.');
        }

        // Ottieni l'importo dal prezzo dell'opzione selezionata
        $price = $selectedOption->price;

        try {
            $result = $this->braintree->transaction()->sale([
                'amount' => $price,
                'paymentMethodNonce' => 'fake-valid-nonce',
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
        
            if ($result->success) {
                // Gestione delle sponsorizzazioni
                $now = Carbon::now();
                $duration = $selectedOption->duration;
                $durationParts = explode(':', $duration);
                $hours = (int) $durationParts[0];
                $minutes = (int) $durationParts[1];
                $seconds = (int) $durationParts[2];
                $expireDate = $now->copy()->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);


                // Salva la sponsorizzazione per l'appartamento
                $apartment->sponsorships()->syncWithoutDetaching([
                    $selectedOption->id => [
                        'start_date' => $now,
                        'expire_date' => $expireDate,
                    ]
                ]);

                $apartment->visibility = 1;
                $apartment->save();

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


/* 'fake-valid-nonce' */