<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Loan;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Book extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'author',
        'published_date'
    ];

    public function genre()
    {
        return $this->hasOne(Genre::class)->withTimestamps();
    }

    public function loan()
    {
        return $this->belongsToMany(Loan::class)->withTimestamps();
    }

    public function student()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public static function rules($id = null)
    {
        return [
            'title' => 'required|string|min:1|max:80',
            'author' => 'required|string|min:1|max:80',
            'published_date' => 'required|date_format:d/m/Y',
        ];
    }
}
