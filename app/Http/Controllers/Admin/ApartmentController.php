<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
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
        $request->validate([
            'title' => 'required|string|max:255',
            'via' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'citta' => 'required|string|max:255',
            'cap' => 'required|string|max:10',
            'thumb' => 'required|image|mimes:jpeg,png|max:2048',
            'cover_images' => 'image|mimes:jpeg,png|max:2048',
            'price' => 'required|numeric|min:0',
            'square_meters' => 'required|numeric|min:0',
            'number_of_room' => 'required|integer|min:1|max:8',
            'number_of_bed' => 'required|integer|min:1|max:8',
            'number_of_bath' => 'required|integer|min:1|max:8',
            'description' => 'required|string|max:1000',
        ]);
        $formData = $request->all();

        if($request->hasFile('thumb')) {
            $img_path = Storage::disk('public')->put('apartment_image', $formData['thumb']);
            $formData['thumb'] = $img_path;  
        }
        
        $newApartment = new Apartment();
        $newApartment->fill($formData);
        $newApartment->address = $request->via . ' ' . $request->numero . ', ' . $request->citta . ' ' . $request->cap;
        $newApartment->latitude = 41.902782;
        $newApartment->longitude = 12.496366;
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

        $request->validate([
            'title' => 'required|string|max:255',
            'via' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'citta' => 'required|string|max:255',
            'cap' => 'required|string|max:10',
            'thumb' => 'nullable|image|mimes:jpeg,png|max:2048',
            'cover_images' => 'nullable|image|mimes:jpeg,png|max:2048',
            'price' => 'required|numeric|min:0',
            'square_meters' => 'required|numeric|min:0',
            'number_of_room' => 'required|integer|min:1|max:8',
            'number_of_bed' => 'required|integer|min:1|max:8',
            'number_of_bath' => 'required|integer|min:1|max:8',
            'description' => 'required|string|max:1000',
        ]);

        $formData = $request->all();

        if ($request->hasFile('thumb')) {
            // Lo elimina se è stato inserito
            if ($apartment->thumb) {
                Storage::disk('public')->delete($apartment->thumb);
            }
            // Salva la nuova copertina
            $thumb_path = Storage::disk('public')->put('apartment_image', $request->file('thumb'));
            $formData['thumb'] = $thumb_path;
        }

        $formData['address'] = $request->via . ' ' . $request->numero . ', ' . $request->citta . ' ' . $request->cap;
        $formData['latitude'] = 41.902782;
        $formData['longitude'] = 12.496366;

        $apartment->update($formData);

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
