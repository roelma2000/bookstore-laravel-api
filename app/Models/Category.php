<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*
│───────────────────────────────────
│Take Note!
│───────────────────────────────────
│Laravel assumes that the table name is 'categories'
│   because the model name is 'Category' (singular form).
│
│Fillable fields for mass assignment
│───────────────────────────────────
│Mass Assignment is a feature in Eloquent that allows you to
│create a new model and fill it with an array of attributes in a single line of code.
│
│ Example: Suppose you have a Book model, and you receive a request to create a new book.
│          You might get an array of data ($data) containing keys like 'title', 'author', 'isbn', etc.
│          With mass assignment, you can simply do Book::create($data) to create a new book with all those attributes.
│Fillable Fields:
│   The fillable Property: To protect against mass assignment vulnerabilities (where an attacker could potentially pass
│   unexpected data in the request and change columns you didn't intend to expose), Eloquent uses the fillable property.
│Purpose: This property explicitly defines which attributes of the model are allowed to be mass-assigned.
│          Only the fields listed in the fillable array can be assigned in bulk.
│Example: In your Book model, you might have:
│         protected $fillable = ['title', 'author', 'isbn'];
│   This means only the title, author, and isbn attributes can be mass-assigned.
│   If someone tries to pass in another attribute, like user_id, it will be ignored.
*/
protected $fillable = [
    'categoryname', // Add other fields as necessary
];
}
