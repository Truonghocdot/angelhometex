<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentPageRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_page_id',
        'path',
        'is_primary',
    ];

    protected $attributes = [
        'is_primary' => false,
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $route): void {
            $route->path = self::normalizePath((string) $route->path);
        });

        static::saved(function (self $route): void {
            if (! $route->is_primary) {
                return;
            }

            self::query()
                ->where('content_page_id', $route->content_page_id)
                ->whereKeyNot($route->getKey())
                ->where('is_primary', true)
                ->update(['is_primary' => false]);
        });
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(ContentPage::class, 'content_page_id');
    }

    public function scopePrimary(Builder $query): Builder
    {
        return $query->where('is_primary', true);
    }

    public static function normalizePath(string $path): string
    {
        $clean = '/'.trim($path, '/');
        $clean = preg_replace('#/+#', '/', $clean) ?? $clean;

        return $clean === '/' ? '/' : rtrim($clean, '/');
    }
}
