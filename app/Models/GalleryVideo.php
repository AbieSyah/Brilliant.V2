<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryVideo extends Model
{
    use LogsActivity;

    protected $fillable = [
        'type',
        'video_path',
        'video_url'
    ];
    protected static $logAttributes = ['type', 'video_path', 'video_url'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($video) {
            if ($video->type === 'file') {
                Storage::disk('public')->delete($video->video_path);
            }
        });
    }
}