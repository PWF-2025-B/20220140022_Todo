<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'is_done',
    ];

    /**
     * Relasi ke user (pemilik todo)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Aksesor untuk label status
     */
    public function getStatusLabelAttribute()
    {
        return $this->is_done ? 'Done' : 'On Going';
    }
}
