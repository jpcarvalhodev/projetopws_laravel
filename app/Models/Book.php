<?php

namespace App\Models;

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

    public function loans()
    {
        return $this->hasMany(Loan::class)->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsTo(Genre::class)->withTimestamps();
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
