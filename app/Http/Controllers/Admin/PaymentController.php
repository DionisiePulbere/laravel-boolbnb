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

class PaymentController extends Controller
{
    protected $gateway;
    protected $sponsorshipOptions;
    protected $braintree; 

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree->getGateway();
    }

    public function index(Apartment $apartment)
    {
        $user = Auth::user();
        $clientToken = $this->braintree->clientToken()->generate();
        $sponsorships = Sponsorship::all();

        return view('admin.payment.index', compact('apartment', 'sponsorships', 'clientToken', 'user'));
    }

    public function checkout(Request $request)
    {
        $messages = $this->getPayValidationMessages();
        $apartment = Apartment::find($request->apartment_id); // Aggiungi questa linea per ottenere l'oggetto Apartment

        if (!$apartment) {
            return redirect()->back()->with('error', 'Appartamento non trovato.');
        }

        $request->validate($this->getPayValidationRules($apartment), $messages); // Aggiungi $apartment come parametro

        // Annullamento delle sponsorizzazioni se necessario
        if ($request->has('cancel_sponsorship') && $request->cancel_sponsorship === 'yes') {
            $apartment->sponsorships()->detach();
            $apartment->visibility = 0;
            $apartment->save();
            return redirect()->route('admin.payment.index', ['apartment' => $apartment->slug])->with('success', 'Sponsorizzazione annullata con successo.');
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
                'paymentMethodNonce' => 'fake-valid-nonce', // Sostituire con il nonce reale ottenuto da Braintree
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

                return redirect()->route('admin.payment.index', ['apartment' => $apartment->slug])->with('success', 'Pagamento effettuato con successo!');
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

    private function getPayValidationRules(Apartment $apartment)
    {
        if ($apartment->visibility === 0) {
            return [
                'card_number' => 'required|regex:/^\d{4} \d{4} \d{4} \d{4}$/',
                'expiration_date' => 'required',
                'cvv' => 'required|digits:3',
                'apartment_name' => 'required|string|max:255',
                'apartment_id' => 'required|exists:apartments,id',
                'sponsorships' => 'required|exists:sponsorships,id',
            ];
        } else if ($apartment->visibility === 1) {
            return [
                'cancel_sponsorship' => 'required|in:yes',
                'apartment_name' => 'required|string|max:255',
                'apartment_id' => 'required|exists:apartments,id',
            ];
        }
    }

    private function getPayValidationMessages()
{
    return [
        'card_number.required' => 'Il numero della carta di credito è obbligatorio.',
        'card_number.regex' => 'Il formato del numero di carta di credito non è valido. Assicurati di inserire il numero nel formato "XXXX XXXX XXXX XXXX".',
        'expiration_date.required' => 'La data di scadenza è obbligatoria.',
        'cvv.required' => 'Il CVV è obbligatorio.',
        'cvv.digits' => 'Il CVV deve essere composto da 3 cifre.',
        'apartment_name.required' => 'Il nome dell\'appartamento è obbligatorio.',
        'apartment_name.string' => 'Il nome dell\'appartamento deve essere una stringa.',
        'apartment_name.max' => 'Il nome dell\'appartamento non può superare i 255 caratteri.',
        'apartment_id.required' => 'L\'ID dell\'appartamento è obbligatorio.',
        'apartment_id.exists' => 'L\'ID dell\'appartamento non è valido.',
        'sponsorships.required' => 'La selezione della sponsorizzazione è obbligatoria.',
        'sponsorships.exists' => 'L\'ID della sponsorizzazione non è valido.',
        'cancel_sponsorship.required' => 'Il campo per annullare la sponsorizzazione è obbligatorio.',
        'cancel_sponsorship.in' => 'Il valore del campo per annullare la sponsorizzazione deve essere "yes".',
    ];
}
}




/* 'fake-valid-nonce' */