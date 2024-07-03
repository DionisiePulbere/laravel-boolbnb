<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request){

        $validateData = $request->validate([
            'email' => 'required|email',
            'object' => 'nullable|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'apartment_id' => 'required|exists:apartments,id'
        ]);

        $message = new Message([
            'apartment_id' => $validateData['apartment_id'],
            'email' => $validateData['email'],
            'object' => $validateData['object'],
            'name' => $validateData['name'],
            'description' => $validateData['description']
        ]);

        if (auth()->check()) {
            $message->associateUser(auth()->user());
        } else {
            $message->email = $validateData['email'];
        }
        
        $message->save();

        return response()->json(['message' => 'Messaggio inviato con successo!']);
    }
}
