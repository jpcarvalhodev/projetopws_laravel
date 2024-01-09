<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class Loan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'issue_date',
        'return_date',
    ];

    public function students()
    {
        return $this->belongsTo(Student::class)->withTimestamps();
    }

    public function books()
    {
        return $this->belongsTo(Book::class)->withTimestamps();
    }

    public static function rules($id = null)
    {
        return [
            'issue_date' => 'required|date_format:d/m/Y',
            'return_date' => 'required|date_format:d/m/Y|after:issue_date',
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
        ];
    }
}
