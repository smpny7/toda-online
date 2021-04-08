<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Attendance
 *
 * @property int $user_id
 * @property int $math1
 * @property int $math2
 * @property int $math3
 * @property int $mathA
 * @property int $mathB
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Attendance newModelQuery()
 * @method static Builder|Attendance newQuery()
 * @method static Builder|Attendance query()
 * @method static Builder|Attendance whereCreatedAt($value)
 * @method static Builder|Attendance whereMath1($value)
 * @method static Builder|Attendance whereMath2($value)
 * @method static Builder|Attendance whereMath3($value)
 * @method static Builder|Attendance whereMathA($value)
 * @method static Builder|Attendance whereMathB($value)
 * @method static Builder|Attendance whereUpdatedAt($value)
 * @method static Builder|Attendance whereUserId($value)
 * @mixin Eloquent
 */
class Attendance extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'math1',
        'math2',
        'math3',
        'mathA',
        'mathB',
    ];
}
