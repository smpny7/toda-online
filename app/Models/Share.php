<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Share
 *
 * @property int $id
 * @property int $video_id
 * @property string $title
 * @property int $views
 * @property string $url
 * @property string $started_at
 * @property string $ended_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Video $video
 * @method static Builder|Share newModelQuery()
 * @method static Builder|Share newQuery()
 * @method static Builder|Share query()
 * @method static Builder|Share whereCreatedAt($value)
 * @method static Builder|Share whereEndedAt($value)
 * @method static Builder|Share whereId($value)
 * @method static Builder|Share whereStartedAt($value)
 * @method static Builder|Share whereTitle($value)
 * @method static Builder|Share whereUpdatedAt($value)
 * @method static Builder|Share whereUrl($value)
 * @method static Builder|Share whereVideoId($value)
 * @method static Builder|Share whereViews($value)
 * @mixin Eloquent
 */
class Share extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'email', 'password'];

    /**
     * Get the attendance record associated with the user.
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
