<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContentPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_section_id',
        'source_path',
        'title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'is_homepage',
        'html',
    ];

    protected $casts = [
        'is_homepage' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(ContentSection::class, 'content_section_id');
    }

    public function routes(): HasMany
    {
        return $this->hasMany(ContentPageRoute::class);
    }

    public function primaryRoute(): HasOne
    {
        return $this->hasOne(ContentPageRoute::class)->where('is_primary', true);
    }
}
