<?php

namespace App\Models;

use App\Utils\FileSizeConversion;
use App\Utils\TimeConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

/**
 * @property string path
 */
class Video extends Model
{
    use HasFactory;

    /**
     * Returns the path to the video file
     */
    public function getVideoPath(): string
    {
        return Storage::disk('local')->url($this->path);
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
        return FileSizeConversion::formatBytes(Storage::disk('local')->size('public/' . $this->path));
    }

    /**
     * Returns the time of the video
     */
    public function getVideoDuration(): string
    {
        return TimeConversion::fromSecondsToMinutes(FFMpeg::fromDisk('local')->open('public/' . $this->path)->getDurationInSeconds());
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
