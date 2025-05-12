<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getModelNameAttribute()
    {
        return match ($this->model_type) {
            'App\Models\GalleryPhoto' => 'Foto Galeri',
            'App\Models\GalleryVideo' => 'Video Galeri',
            'App\Models\Facility' => 'Fasilitas',
            default => class_basename($this->model_type),
        };
    }

    public function getActionLabelAttribute()
    {
        return match ($this->action) {
            'created' => 'Menambahkan',
            'updated' => 'Mengubah',
            'deleted' => 'Menghapus',
            default => $this->action,
        };
    }
}
