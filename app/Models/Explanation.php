<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explanation extends Model
{
    use HasFactory;

    protected $table = 'explanations';

    protected $fillable = [
        'class_key', 'chapter_key', 'explanation', 'created_at', 'updated_at'
    ];
}
