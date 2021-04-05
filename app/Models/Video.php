<?php

namespace App\Models;

use App\Utils\FileSizeConversion;
use App\Utils\TimeConversion;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

/**
 * App\Models\Video
 *
 * @property int $id
 * @property string $class
 * @property string $chapter
 * @property string $section
 * @property string $title
 * @property int $video_id
 * @property int $active
 * @property string $file_path
 * @property string $class_key
 * @property int $chapter_id
 * @property string $chapter_key
 * @property int $section_id
 * @property string $section_key
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Video newModelQuery()
 * @method static Builder|Video newQuery()
 * @method static Builder|Video query()
 * @method static Builder|Video whereActive($value)
 * @method static Builder|Video whereChapter($value)
 * @method static Builder|Video whereChapterId($value)
 * @method static Builder|Video whereChapterKey($value)
 * @method static Builder|Video whereClass($value)
 * @method static Builder|Video whereClassKey($value)
 * @method static Builder|Video whereCreatedAt($value)
 * @method static Builder|Video whereId($value)
 * @method static Builder|Video wherePath($value)
 * @method static Builder|Video whereSection($value)
 * @method static Builder|Video whereSectionId($value)
 * @method static Builder|Video whereSectionKey($value)
 * @method static Builder|Video whereTitle($value)
 * @method static Builder|Video whereUpdatedAt($value)
 * @method static Builder|Video whereVideoId($value)
 * @mixin Eloquent
 */
class Video extends Model
{
    use HasFactory;

    /**
     * Returns the path to the video file
     */
    public function getVideoPath(): string
    {
        return Storage::disk('local')->url($this->file_path);
    }

    /**
     * Returns the path to the thumbnail file
     */
    public function getThumbnailPath(): string
    {
        return Storage::disk('local')->url('thumbnail/' . self::getQueueableId() . '.jpg');
    }

    /**
     * Returns the number of comments
     */
    public function getNumberOfComment(): int
    {
        return $this->hasMany(Comment::class)->where('user_id', Auth::id())->where('disabled', false)->count();
    }

    /**
     * Returns the file size of the video
     */
    public function getFileSize(): string
    {
        return FileSizeConversion::formatBytes(Storage::disk('local')->size('public/' . $this->file_path));
    }

    /**
     * Returns the time of the video
     */
    public function getVideoDuration(): string
    {
        return TimeConversion::fromSecondsToMinutes(FFMpeg::fromDisk('local')->open('public/' . $this->file_path)->getDurationInSeconds());
    }

    /**
     * Returns whether the video is bookmarked
     */
    public function isBookmarked(): bool
    {
        return $this->hasMany(Bookmark::class)->where('user_id', Auth::id())->exists();
    }

    /**
     * Returns whether the video is watched
     */
    public function isWatched(): bool
    {
        return $this->hasMany(History::class)->where('user_id', Auth::id())->exists();
    }
}
