<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Review extends Model
{
    protected $fillable = [
        'name',
        'year',
        'content',
        'rating',
        'avatar',
        'avatar_type'
    ];

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return null;
        }

        if ($this->avatar_type === 'dropbox') {
            return $this->avatar;
        }

        return Storage::disk('public')->url($this->avatar);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->avatar) {
            return null;
        }

        if ($this->avatar_type === 'dropbox') {
            return $this->avatar;
        }

        return Storage::disk('public')->url($this->avatar);
    }
}
