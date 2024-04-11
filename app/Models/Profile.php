<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     // Fillable fields for mass assignment
     protected $fillable = [
        'userId', 'lastname', 'firstname', 'addressId',
        'phoneNumber'
    ];

    // If you have a User model and relation
    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function address() {
        return $this->belongsTo(Address::class, 'addressId');
    }
}
