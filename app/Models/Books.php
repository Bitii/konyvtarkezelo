<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Books extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        'author',
        'genre',
        'release_date',
        'keywords',
        'cover_image'
    ];

    public function translations(): HasMany{
        return $this->hasMany(Translations::class, 'book_id', 'id');
    }
}
