<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'image',
        'github_link',
        'project_link'
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/projects/' . $image),
        );
    }
}
