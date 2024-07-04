<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\View;


class ApartmentController extends Controller
{
    public function index (){
         $apartments = Apartment::with('user')->get();
    
    return response()->json([
        'success' => true,
        'results' => $apartments
    ]);
    }

    public function show($slug, Request $request){
        $visitorIp = $request->ip();
        $apartment = Apartment::where('slug', $slug)->with('images', 'services')->first();

        if ($apartment) {
            // Salva l'indirizzo IP visitatore nel database
            View::create([
                'apartment_id' => $apartment->id,
                'address_ip' => $visitorIp,
                'date_visit' => now() // Data corrente
            ]);
    
            // Restituisci la risposta JSON con i dettagli dell'appartamento
            return response()->json([
                'success' => true,
                'results' => $apartment
            ]);
        } else {
            // Se non viene trovato alcun appartamento
            return response()->json([
                'success' => false,
                'error' => 'No Apartment found'
            ]);
        }

    }

    public function search(Request $request)
    {
        
    if($request->latitude){
        $latitude= $request->latitude;
    } else{
        $latitude = '';
    }

    if($request->longitude){
        $longitude= $request->longitude;
    }else{
        $longitude='';
    }
    if($request->distance){
        $distance= $request->distance;
    }else{
        $distance='5000';
    }
    

        $apartments = Apartment::findNearby($latitude, $longitude, $distance);
        if (count($apartments) < 1) {
            return response()->json([
                'result' => false,
            ]);
        }

        return response()->json([
            'result'=> true,
            'apartments'=> $apartments
        ]);
    }
}
