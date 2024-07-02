<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;


class ApartmentController extends Controller
{
    public function index (){
        $apartments = Apartment::all();
        
        
        return response()->json([
            'success'=> true,
            'results'=> $apartments
        ]);
    }

    public function show($slug){
        $apartment= Apartment::where('slug' ,'=', $slug)->with('images')->first();
        if($apartment){
            return response()->json([
                'success' => true,
                'results' => $apartment
            ]);

        } else{
            return response()->json([
                'success' => false,
                'error' => 'No Apartment found'
            ]);
        }
        
    }

    public function search(Request $request)
    {
        $latitude = 40.423335;
        $longitude = -3.694239;
        $distance = 20000;

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
