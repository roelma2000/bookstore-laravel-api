<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = [
        'address1', 'address2', 'city', 'province','country', ' zip'
    ];
}
