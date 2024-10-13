<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'company',
        'image',
        'title',
        'link',
        'date',
        'content',
        'status',
        'writer',
        'editor',

    ];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'writer', 'id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company', 'id');
    }
}
