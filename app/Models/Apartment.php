<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function images() {
        return $this->belongsTo(Image::class);
    }

    public function messages() {
        return $this->belongsTo(Message::class);
    }

    public function views() {
        return $this->belongsTo(Views::class);
    }

    public function sponsorships() {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }
}
