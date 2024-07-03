<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'email',
        'object',
        'name',
        'description'
    ];

    public function associateUser($user){
        $this->user_id = $user->id;
        $this->email = $user->email;
    }

    public function apartments() {
        return $this->belongsTo(Apartment::class);
    }
}
