<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Facility extends Model
{
    use LogsActivity;

    protected $fillable = [
        'nama_kamar',
        'deskripsi',
        'tipe_kamar',
        'kategori',
        'gender',
        'harga',
        'image'
    ];

    protected static $logAttributes = [
        'nama_kamar',
        'tipe_kamar',
        'kategori',
        'gender',
        'harga',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($facility) {
            if ($facility->isDirty('image') && $facility->getOriginal('image')) {
                Storage::disk('public')->delete($facility->getOriginal('image'));
            }
        });

        static::deleting(function ($facility) {
            if ($facility->image) {
                Storage::disk('public')->delete($facility->image);
            }
        });
    }
}