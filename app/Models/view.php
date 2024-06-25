<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'address_ip',
        'date_visit',
    ];
    
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
