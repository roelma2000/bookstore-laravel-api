<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
   /*
    │───────────────────────────────────
    │Take Note!
    │───────────────────────────────────
    │ This tells Laravel not to expect the created_at and updated_at columns and not to automatically update these fields.
    │   public $timestamps = false;
    │
    */
    //public $timestamps = false;

     // Fillable fields for mass assignment
     protected $fillable = [
        'title', 'author', 'isbn', 'categoryid',
        'description', 'price', 'stockQuantity',
        'publisher', 'publishedDate', 'coverImageUrl'
    ];

    // If you have a Category model and relation
    public function category() {
        return $this->belongsTo(Category::class, 'categoryid');
    }
}
