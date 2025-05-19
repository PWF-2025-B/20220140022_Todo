<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
    ];

    /**
     * Relasi: satu kategori memiliki banyak todo.
     */
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    /**
     * Relasi: kategori dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
