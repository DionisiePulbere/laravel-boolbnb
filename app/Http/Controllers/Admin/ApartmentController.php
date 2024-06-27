<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser= Auth::user();
        
        
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
        return view('admin.apartments.create', compact('apartment'));
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
        $messages = [
            'title.required' => 'Il campo Nome dell\'immobile è obbligatorio.',
            'thumb.required' => 'Il campo Immagine di copertina è obbligatorio.',
            'cover_image.required' => 'Il campo Altri immagini è obbligatorio.',
            'price.required' => 'Il campo Prezzo è obbligatorio.',
            'square_meters.required' => 'Il campo Metri quadrati è obbligatorio.',
            'description.required' => 'Il campo Descrizione è obbligatorio.',
            'address.required' => 'Il campo Indirizzo è obbligatorio.',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'thumb' => 'required|image|mimes:jpeg,png|max:2048',
            'address' => 'required|min:5|string',
            'cover_image' => 'required|image|mimes:jpeg,png|max:2048',
            'price' => 'required|numeric|min:0',
            'square_meters' => 'required|numeric|min:0',
            'number_of_room' => 'required|integer|min:1|max:8',
            'number_of_bed' => 'required|integer|min:1|max:8',
            'number_of_bath' => 'required|integer|min:1|max:8',
            'description' => 'required|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude'=> 'required|numeric'
        ], $messages);

        $formData = $request->all();

        if($request->hasFile('thumb')) {
            $img_path = Storage::disk('public')->put('apartment_image', $formData['thumb']);
            $formData['thumb'] = $img_path;  
        }
        
        if ($request->hasFile('cover_image')) {
            $cover_path = Storage::disk('public')->put('apartment_image', $formData['cover_image']);
            $formData['cover_image'] = $cover_path;
        }

        $newApartment = new Apartment();
        $newApartment->fill($formData);
        //aggiungo l'id dell utente --Monsterman
        $newApartment->user_id = $currentUser->id;
        $newApartment->save();
        return redirect()->route('admin.apartments.show',['apartment' => $newApartment->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('admin.apartments.edit', compact('apartment'));
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

        $messages = [
            'title.required' => 'Il campo Nome dell\'immobile è obbligatorio.',
            'price.required' => 'Il campo Prezzo è obbligatorio.',
            'square_meters.required' => 'Il campo Metri quadrati è obbligatorio.',
            'description.required' => 'Il campo Descrizione è obbligatorio.',
            'address.required' => 'Il campo Indirizzo è obbligatorio.',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|min:5|string',
            'thumb' => 'nullable|image|mimes:jpeg,png|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'price' => 'required|numeric|min:0',
            'square_meters' => 'required|numeric|min:0',
            'number_of_room' => 'required|integer|min:1|max:8',
            'number_of_bed' => 'required|integer|min:1|max:8',
            'number_of_bath' => 'required|integer|min:1|max:8',
            'description' => 'required|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude'=> 'required|numeric'

        ], $messages);

        $formData = $request->all();

        if ($request->hasFile('thumb')) {
            if ($apartment->thumb) {
                Storage::disk('public')->delete($apartment->thumb);
            }
            $thumb_path = Storage::disk('public')->put('apartment_image', $request->file('thumb'));
            $formData['thumb'] = $thumb_path;
        }

        if ($request->hasFile('cover_image')) {
            if ($apartment->cover_image) {
                Storage::disk('public')->delete($apartment->cover_image);
            }
            $cover_path = Storage::disk('public')->put('apartment_image', $request->file('cover_image'));
            $formData['cover_image'] = $cover_path;
        }


        $apartment->update($formData);
        $apartment->fill($formData);
        $apartment->save();

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->id]);

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
}
