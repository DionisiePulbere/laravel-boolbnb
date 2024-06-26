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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'primary_image' => 'required|image|mimes:jpeg,png|max:2048',
            'cover_images' => 'image|mimes:jpeg,png|max:2048',
            'price' => 'required|numeric|min:0',
            'square_meters' => 'required|numeric|min:0',
            'number_of_rooms' => 'required|integer|min:1|max:8',
            'number_of_beds' => 'required|integer|min:1|max:8',
            'number_of_bathrooms' => 'required|integer|min:1|max:8',
            'summary' => 'required|string|max:1000',
        ]);
        $formData = $request->all();

        if($request->hasFile('cover_image')) {
            $img_path = Storage::disk('public')->put('post_images', $formData['cover_image']);
            $formData['cover_image'] = $img_path;
        }
        $newApartment = new Apartment();
        $newApartment->fill($formData);
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
        //
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
