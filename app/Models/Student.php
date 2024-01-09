<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'birthdate',
        'nif'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class)->withTimestamps();
    }

    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|min:1|max:80',
            'email' => 'required|min:1|max:30|email|unique:students,email,',
            'birthdate' => 'required|date_format:d/m/Y',
            'nif' => 'required|digits_between:1,9|integer|unique:students,nif,',
        ];
    }
}
