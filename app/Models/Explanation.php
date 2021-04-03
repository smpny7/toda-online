<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Explanation
 *
 * @property int $id
 * @property string $class_key
 * @property string $chapter_key
 * @property string|null $data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Explanation newModelQuery()
 * @method static Builder|Explanation newQuery()
 * @method static Builder|Explanation query()
 * @method static Builder|Explanation whereChapterKey($value)
 * @method static Builder|Explanation whereClassKey($value)
 * @method static Builder|Explanation whereCreatedAt($value)
 * @method static Builder|Explanation whereData($value)
 * @method static Builder|Explanation whereId($value)
 * @method static Builder|Explanation whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Explanation extends Model
{
    use HasFactory;

    protected $table = 'explanations';

    protected $fillable = [
        'class_key', 'chapter_key', 'explanation', 'created_at', 'updated_at'
    ];
}
