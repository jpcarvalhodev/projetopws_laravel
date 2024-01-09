<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();

        return response()->json($genres, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        try {
            $genre = new Genre();

            $genre->name = $request->name;

            $genre->save();

        }catch(\Exception $error){

            return response()->json([
                "status" => false,
                "message" => 'Ocorreu um erro no servidor',
                "data" => [$error]
            ],500);
        }

        return response()->json($genre,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $genre = Genre::where('id', $id)->get()->first();

        if (!$genre) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o gênero",
                "data" => [],
            ], 400);
        }

        return response()->json($genre,200);
    }

    public function getGenres(Request $request)
    {
        $genres = Genre::when($request->filled('name'), function ($query) use ($request){
            return $query->where(
            \DB::raw('LOWER(name)'),
            'like',
            '%' . strtolower($request->input('name')) . '%'
            );
        })
        ->get();

        return response()->json($genres, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, $id)
    {
        $doesGenreExists = Genre::where('id', $id)->exists();

        if (!$doesGenreExists) {
            return response()->json([
                "status" => false,
                "message" => 'O gênero não existe',
                "data" => [$doesGenreExists],
            ], 400);
        }

        $genre = Genre::where('id','=', $id)->first();

        $genre->name = $request->name;

        $genre->save();

        return response()->json($genre, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $doesGenreExists = Genre::where('id', $id)->exists();

        if (!$doesGenreExists) {
            return response()->json([
                "status" => false,
                "message" => 'O gênero não existe',
                "data" => [$doesGenreExists],
            ], 400);
        }

        $genre = Genre::where('id','=', $id)->first();

        $genre->delete();

        return response()->json([
            "status" => true,
            "message" => 'O gênero foi deletado com sucesso',
            "data" => [$genre],
        ], 200);
    }
}
