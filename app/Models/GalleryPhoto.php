<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryPhoto extends Model
{
    use LogsActivity;

    protected $fillable = ['image'];
    protected static $logAttributes = ['image'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            Storage::disk('public')->delete($photo->image);
        });
    }
}