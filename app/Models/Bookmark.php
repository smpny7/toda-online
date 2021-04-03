<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Bookmark
 *
 * @property int $id
 * @property int $user_id
 * @property int $video_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read Video $video
 * @method static Builder|Bookmark newModelQuery()
 * @method static Builder|Bookmark newQuery()
 * @method static Builder|Bookmark query()
 * @method static Builder|Bookmark whereCreatedAt($value)
 * @method static Builder|Bookmark whereId($value)
 * @method static Builder|Bookmark whereUpdatedAt($value)
 * @method static Builder|Bookmark whereUserId($value)
 * @method static Builder|Bookmark whereVideoId($value)
 * @mixin Eloquent
 */
class Bookmark extends Model
{
    use HasFactory;

    protected $table = 'bookmarks';

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
