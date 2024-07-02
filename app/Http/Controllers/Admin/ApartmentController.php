<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Image;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //utente autenticato
        $currentUser= Auth::user();
        
        //filtro gli appartamenti prendendo  solo quelli appartenti all user autenticato
        $apartments = Apartment::where('user_id','=', $currentUser->id)->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        $services = Service::all();

        $data = [
            'services' => $services
        ];

        return view('admin.apartments.create', $data, compact('apartment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //vengo in pace
        $currentUser= Auth::user();
        
        $messages = $this->getValidationMessages();

        $request->validate($this->getStoreValidationRules(), $messages);

        $formData = $request->all();

        if($request->hasFile('thumb')) {
            $img_path = Storage::disk('public')->put('apartment_image', $formData['thumb']);
            $formData['thumb'] = $img_path;  
        }
        

        $newApartment = new Apartment();
        $newApartment->fill($formData);

        //aggiungo l'id dell utente --Monsterman
        $newApartment->user_id = $currentUser->id;
        $newApartment->slug = Str::slug($newApartment->title, '-');

        $newApartment->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {             
                $imagePath = Storage::disk('public')->put('apartment_image', $image);
                $apartmentImage = new Image();
                $apartmentImage-> image = $imagePath;
                $apartmentImage->apartment_id = $newApartment->id;
                $apartmentImage->save();
        }}



        // "Aggiungo i servizi scelti dall'utente al post creato
        if($request->has('services')) {
            $newApartment->services()->attach($formData['services']);
        }

        return redirect()->route('admin.apartments.show',['apartment' => $newApartment->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $sponsorships = Sponsorship::all();

        $data = [
            'sponsorships' => $sponsorships
        ];

        return view('admin.apartments.show', $data ,compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {  
        $images=Image::all();
        $services = Service::all();
        $sponsorships = Sponsorship::all();

        $data = [
            'services' => $services,
            'sponsorships'=>$sponsorships,
            'images'=>$images
        ];

        return view('admin.apartments.edit', $data, compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);

        $messages = $this->getValidationMessages();

        $request->validate($this->getUpdateValidationRules(), $messages);

        $formData = $request->all();

        if ($request->hasFile('thumb')) {
            if ($apartment->thumb) {
                Storage::disk('public')->delete($apartment->thumb);
            }
            $thumb_path = Storage::disk('public')->put('apartment_image', $request->file('thumb'));
            $formData['thumb'] = $thumb_path;
        }

        
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {             
                $imagePath = Storage::disk('public')->put('apartment_image', $image);
                $apartmentImage = new Image();
                $apartmentImage-> image = $imagePath;
                $apartmentImage->apartment_id = $apartment->id;
                $apartmentImage->save();
        }}

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = Image::findOrFail($imageId);
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }
        }

        $apartment->update($formData);

        if($request->has('services')){
            $apartment->services()->sync($formData['services']);
        }
        else {
            $apartment->services()->detach();
        }

        // Gestione delle sponsorizzazioni
        $now = Carbon::now(); // Ottieni la data e l'ora corrente
        $activeSponsorshipExists = false; // Flag per verificare se esiste una sponsorizzazione attiva

        if (isset($formData['sponsorships'])) {
            foreach ($formData['sponsorships'] as $sponsor) {
                $sponsorship = Sponsorship::find($sponsor);

                if ($sponsorship) {
                    // Calcola l'expire_date in base alla durata della sponsorizzazione
                    $duration = $sponsorship->duration;
                    $durationParts = explode(':', $duration); // Divide la durata in ore, minuti, secondi
                    $hours = (int) $durationParts[0];
                    $minutes = (int) $durationParts[1];
                    $seconds = (int) $durationParts[2];

                    // Calcola l'expire_date aggiungendo ore, minuti, secondi alla data corrente
                    $expireDate = $now->copy()->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);

                    // Sincronizzazione della tabella pivot con start_date e expire_date
                    $apartment->sponsorships()->syncWithoutDetaching([
                        $sponsor => [
                            'start_date' => $now,
                            'expire_date' => $expireDate,
                        ]
                    ]);

                    // Imposta il flag se almeno una sponsorizzazione è attiva
                    $activeSponsorshipExists = true;
                }
            }
        }

        // Annullamento delle sponsorizzazioni
        if ($request->input('cancel_sponsorship') === 'yes') {
            $apartment->sponsorships()->detach();
            $activeSponsorshipExists = false;
        }

        // Aggiornamento della visibilità dell'appartamento in base alla sponsorizzazione
        $apartment->visibility = $activeSponsorshipExists ? 1 : 0;
        $apartment->save();


        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->slug]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }

    public function deleteImage($imageId)
    {
        $image = Image::findOrFail($imageId);
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return redirect()->back()->with('success', 'Immagine eliminata con successo');
    }


    private function getStoreValidationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'thumb' => 'required|image|mimes:jpeg,png|max:2048',
            // 'cover_image' => 'required|image|mimes:jpeg,png|max:2048',
            'address' => 'required|min:5|string',
            'price' => 'required|numeric|min:0',
            'square_meters' => 'required|numeric|min:0',
            'number_of_room' => 'required|integer|min:1|max:8',
            'number_of_bed' => 'required|integer|min:1|max:8',
            'number_of_bath' => 'required|integer|min:1|max:8',
            'description' => 'required|string|max:8000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ];
    }

    private function getUpdateValidationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'thumb' => 'nullable|image|mimes:jpeg,png|max:2048',
            // 'cover_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'address' => 'required|min:5|string',
            'price' => 'required|numeric|min:0',
            'square_meters' => 'required|numeric|min:0',
            'number_of_room' => 'required|integer|min:1|max:8',
            'number_of_bed' => 'required|integer|min:1|max:8',
            'number_of_bath' => 'required|integer|min:1|max:8',
            'description' => 'required|string|max:8000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ];
    }

    private function getValidationMessages()
    {
        return [
            'title.required' => 'Il campo Nome dell\'immobile è obbligatorio.',
            'title.string' => 'Il campo Nome dell\'immobile deve essere una stringa',
            'title.max' => 'Il campo Nome dell\'immobile non deve contenere più di 255 caratteri',
            'thumb.required' => 'Il campo Immagine di copertina è obbligatorio.',
            'thumb.image' => 'Il campo Immagine di copertina deve essere un\'immagine.',
            'thumb.mimes' => 'Il campo Immagine di copertina deve essere un file di tipo: jpeg, png.',
            'thumb.max' => 'Il campo Immagine di copertina non può essere più grande di 2048 KB.',
            'image.required' => 'Il campo Altri immagini è obbligatorio.',
            'image.image' => 'Il campo Altri immagini deve essere un\'immagine.',
            'image.mimes' => 'Il campo Altri immagini deve essere un file di tipo: jpeg, png.',
            'image.max' => 'Il campo Altri immagini non può essere più grande di 2048 KB.',
            'address.required' => 'Il campo Indirizzo è obbligatorio.',
            'price.required' => 'Il campo Prezzo è obbligatorio.',
            'price.numeric' => 'Il campo Prezzo deve essere un numero.',
            'price.min' => 'Il campo Prezzo deve essere almeno 0.',
            'square_meters.required' => 'Il campo Metri quadrati è obbligatorio.',
            'square_meters.numeric' => 'Il campo Metri quadrati deve essere un numero.',
            'square_meters.min' => 'Il campo Metri quadrati deve essere almeno 0.',
            'description.required' => 'Il campo Descrizione è obbligatorio.',
            'description.string' => 'Il campo Descrizione deve essere scritto in caratteri.',
            'description.max' => 'Il campo Descrizione non può essere più lungo di 8000 caratteri.',
        ];
    }
}

