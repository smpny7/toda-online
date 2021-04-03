<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\History
 *
 * @property int $id
 * @property int $user_id
 * @property int $video_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read Video $video
 * @method static Builder|History newModelQuery()
 * @method static Builder|History newQuery()
 * @method static Builder|History query()
 * @method static Builder|History whereCreatedAt($value)
 * @method static Builder|History whereId($value)
 * @method static Builder|History whereUpdatedAt($value)
 * @method static Builder|History whereUserId($value)
 * @method static Builder|History whereVideoId($value)
 * @mixin Eloquent
 */
class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'user_id', 'video_id', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
