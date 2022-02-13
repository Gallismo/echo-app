<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class category extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        'name',
        'image',
        'description',
        'slug',
        '_lft',
        '_rgt',
        'parent_id'
    ];
}
