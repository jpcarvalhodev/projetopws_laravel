<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Genre extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name'
    ];

    public function books()
    {
        return $this->hasMany(Book::class)->withTimestamps();
    }

    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|min:1|max:80',
        ];
    }
}
