<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'address',
        'thumb',
        'price',
        'address',
        'square_meters',
        'number_of_room',
        'number_of_bed',
        'number_of_bath',
        'description',
        'latitude',
        'longitude'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }

    public function sponsorships() {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }
}
