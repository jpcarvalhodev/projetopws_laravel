<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $book = new Book();

            $book->title = $request->title;
            $book->author = $request->author;
            $book->published_date = $request->published_date;

            $book->save();

        }catch(\Exception $error){

            return response()->json([
                "status" => false,
                "message" => 'Ocorreu um erro no servidor',
                "data" => [$error]
            ],500);
        }

        return response()->json($book,201);
    }

    public function count()
    {
        $booksCount = Book::count();

        return response()->json($booksCount, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $unit = Book::where('id',$id)->get()->first();

        if (!$unit) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o livro",
                "data" => [],
            ], 400);
        }

        return response()->json($unit,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $doesBookExists = Book::where('id', $id)->exists();

        if (!$doesBookExists) {

            return response()->json([
                "status" => false,
                "message" => 'O livro não existe',
                "data" => [$doesBookExists],
            ], 400);
        }

        $book = Book::where('id','=',$id)->first();

        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_date = $request->published_date;

        $book->save();

        return response()->json([
            'status' => true,
            'message' => 'Registo atualizado com sucesso',
            'data' => [$book],
        ],202);
    }

    public function delete($id)
    {
        $doesBookExists = Book::where('id', $id)->exists();

        if (!$doesBookExists) {
            return response()->json([
                "status" => false,
                "message" => 'O livro não existe',
                "data" => [$doesBookExists],
            ], 400);
        }

        $book = Book::where('id','=', $id)->first();

        $book->delete();

        return response()->json([
            "status" => true,
            "message" => 'O livro foi deletado com sucesso',
            "data" => [$book],
        ], 200);
    }
}
