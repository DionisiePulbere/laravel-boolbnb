<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;


class ApartmentController extends Controller
{
    public function index (){
        $apartments = Apartment::with('user')->get();
    
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

    public function show($slug){
        $apartment= Apartment::where('slug' ,'=', $slug)->with('images','user')->first();
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
