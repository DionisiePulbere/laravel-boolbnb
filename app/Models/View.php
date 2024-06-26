<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'address_ip',
        'date_visit',
    ];

    public function apartments() {
        return $this->belongsTo(Apartment::class);
    }
}
