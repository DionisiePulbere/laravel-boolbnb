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
        $apartment= Apartment::where('slug' ,'=', $slug)->first();
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
}
