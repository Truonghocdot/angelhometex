<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'mime_type',
        'content',
    ];
}
