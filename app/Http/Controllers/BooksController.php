<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return Book::all();
    }

    public function show($id){
        $Books = Book::find($id);
        if(! $Books) {
            return response() ->json([
                'message' => 'Book not found'
            ],404);
        }

        return $Books;
    }

    //
}
