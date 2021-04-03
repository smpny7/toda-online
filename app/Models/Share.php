<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
