<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translations extends Model
{
    protected $table = 'translations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'language',
        'translated_title',
        'translated_description',
        'translated_genre',
        'translated_keywords'
    ];

    public function book():BelongsTo{
        return $this->belongsTo(Books::class, 'book_id');
    }
}
