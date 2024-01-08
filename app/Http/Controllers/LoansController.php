<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Student;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::all();

        return response()->json($loans, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        try {
            $loan = new Loan();

            $loan->issue_date = $request->issue_date;
            $loan->return_date = $request->return_date;
            $loan->student_id = $request->student_id;
            $loan->book_id = $request->book_id;

            $loan->save();

        } catch (\Exception $error) {
            return response()->json([
                "status" => false,
                "message" => 'Ocorreu um erro no servidor',
                "data" => [$error]
            ], 500);
        }

        return response()->json($loan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $unit = Loan::where('id', $id)->get()->first();

        if (!$unit) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o empréstimo",
                "data" => [$unit],
            ], 400);
        }

        return response()->json($unit,200);
    }

    public function count()
    {
        $loansCount = Loan::count();

        return response()->json($loansCount, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, $id)
    {
        $doesLoanExists = Loan::where('id', $id)->exists();

        if (!$doesLoanExists) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o empréstimo",
                "data" => [$doesLoanExists],
            ], 400);
        }

        $loan = Loan::where('id','=', $id)->first();

        $loan->issue_date = $request->issue_date;
        $loan->return_date = $request->return_date;
        $loan->book_id = $request->book_id;
        $loan->student_id = $request->student_id;

        $loan->save();

        return response()->json($loan,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $doesLoanExists = Loan::where('id', $id)->exists();

        if (!$doesLoanExists) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o empréstimo",
                "data" => [$doesLoanExists],
            ], 400);
        }

        $loan = Loan::where('id','=', $id)->first();

        $loan->delete();

        return response()->json([
            "status" => true,
            "message" => "Empréstimo removido com sucesso",
            "data" => [$loan],
        ], 200);
    }
}
