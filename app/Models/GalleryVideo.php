<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryVideo extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title',
        'description',
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

    public function getVideoEmbedUrlAttribute()
    {
        if ($this->type === 'url' && $this->video_url) {
            // Konversi URL YouTube ke format embed
            $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
            preg_match($pattern, $this->video_url, $matches);
            
            if (isset($matches[1])) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
        }
        return null;
    }
}