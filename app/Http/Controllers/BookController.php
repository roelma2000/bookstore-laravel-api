<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;

class BookController extends Controller
{
    // Display the welcome page
    public function index(){
        return view('welcome');
    }

    // Get all books
    public function getBooks()
    {
        $books = Book::all();
        return response()->json($books);
    }

    // Create a new book
    public function createBook(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    // Get a book by ID
    public function getBookById($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    // Update a book
    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->update($request->all());
        return response()->json($book);
    }

    // Update selected fields of a book
    public function patchBook(Request $request)
    {
        // handles the validation internally and automatically returns an error response if the validation fails.
        // This is one of the features that makes Laravel's request validation convenient and efficient.
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

         // Find the book by ID
         $book = Book::find($request->id);

        // Check if the book exists
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404); // Return a 404 error if the book is not found
        }

        // Update the book fields
        $book->fill($request->only([
            'title', 'author', 'isbn', 'categoryid',
            'description', 'price', 'stockQuantity',
            'publisher', 'publishedDate', 'coverImageUrl'
        ]));

        $book->save();

        return response()->json(['message' => "Book {$book->id} updated successfully"]);
    }

   // Delete a book
    public function deleteBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}
