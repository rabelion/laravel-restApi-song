<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index()
    {
        //get Genres
        $genres = Genre::all();

        //return collection of Genres as a resource
        return response()->json($genres);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'genre'     => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $genre = Genre::create([
            'genre'     => $request->genre
        ]);

        //return response
        return response()->json([
            'data' => $genre
        ]);
    }

    public function show($id)
    {
        $genre=Genre::findOrFail($id);

        //return single post as a resource
        return response()->json([
            'data' => $genre
        ]);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'genre'     => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $genre=Genre::findOrFail($id);

        //update Genre
        $genre->update([
            'genre'     => $request->genre
        ]);

        //return response
        return response()->json([
            'data' => $genre
        ]);
    }

    public function destroy($id)
    {
        $genre=Genre::findOrFail($id);

        //delete post
        $genre->delete();

        //return response
        return response()->json([
            'message' => 'Data updated successfully'
        ]);
    }
}
