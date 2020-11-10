<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
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
        return Author::all();
    }

    public function show($id){
        $Authors = Author::find($id);
        if(! $Authors) {
            return response() ->json([
                'message' => 'Author not found'
            ],404);
        }

        return $Authors;
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'gender'=>'required',
            'biography'=>'required'
        ]);

        $author = Author::create(
            $request->only(['name', 'gender', 'biography'])
        );

        return response()->json([
            'created' => true,
            'data' => $author
        ], 201);
    }

    public function update(Request $request, $id){
        try{
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e){
            return response() -> json([
                'message' => 'author not found'
            ], 404);
        }

        $author->fill(
            $request->only(['name', 'gender', 'biography'])
        );

        $author->save();

        return response()->json([
            'updated' => true,
            'data' => $author
        ],200);
    }

    public function destroy($id){
        try{
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e){
            return response() -> json([
                'message' => 'author not found'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'deleted' => true,
        ],200);
    }



    //
}
