<?php

namespace App\Http\Controllers\Api;

use App\Models\Song;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    public function index()
    {
        //get Genres
        $songs = Song::all();

        //return collection of Genres as a resource
        return response()->json($songs);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'singer'    => 'required',
            'release'   => 'required',
            'genre_id'  => 'required|exists:genres,id'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $song = Song::create([
            'title'     => $request->title,
            'singer'    => $request->singer,
            'release'   => $request->release,
            'genre_id'  => $request->genre_id
        ]);

        //return response
        return response()->json([
            'data' => $song
        ]);
    }

    public function show($id)
    {
        $song=Song::findOrFail($id);

        //return single post as a resource
        return response()->json([
            'data' => $song
        ]);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'singer'    => 'required',
            'release'   => 'required',
            'genre_id'  => 'required|exists:genres,id'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $song=Song::findOrFail($id);

        //update Genre
        $song->update([
            'title'     => $request->title,
            'singer'    => $request->singer,
            'release'   => $request->release,
            'genre_id'  => $request->genre_id
        ]);

        //return response
        return response()->json([
            'data' => $song
        ]);
    }

    public function destroy($id)
    {
        $song=Song::findOrFail($id);

        //delete post
        $song->delete();

        //return response
        return response()->json([
            'message' => 'Data updated successfully'
        ]);
    }
}
