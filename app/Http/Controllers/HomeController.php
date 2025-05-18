<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Facility;

class HomeController extends Controller
{
    public function index()
    {
        $brilliantFacilities = Facility::where('kategori', 'brilliant')->get();
        $bieplusFacilities = Facility::where('kategori', 'bieplus')->get();
        $reviews = Review::latest()->get();

        // Get all gallery items ordered by oldest first
        $photos = \App\Models\GalleryPhoto::oldest()->get();
        $videos = \App\Models\GalleryVideo::oldest()->get();

        // Combine all items and sort by created_at ascending (oldest first)
        $allItems = collect();
        foreach ($photos as $photo) {
            $allItems->push(['type' => 'photo', 'item' => $photo, 'created_at' => $photo->created_at]);
        }
        foreach ($videos as $video) {
            $allItems->push(['type' => 'video', 'item' => $video, 'created_at' => $video->created_at]);
        }

        // Sort by created_at ascending
        $sortedItems = $allItems->sortBy('created_at');

        // Arrange items in the pattern while maintaining chronological order
        $gallery = [];
        $tempPhotos = $sortedItems->filter(fn($item) => $item['type'] === 'photo');
        $tempVideos = $sortedItems->filter(fn($item) => $item['type'] === 'video');
        
        while ($tempPhotos->count() > 0 || $tempVideos->count() > 0) {
            // Add first photo if available
            if ($tempPhotos->count() > 0) {
                $gallery[] = $tempPhotos->shift();
            }
            
            // Add first video if available
            if ($tempVideos->count() > 0) {
                $gallery[] = $tempVideos->shift();
            }
            
            // Add two more photos if available
            for ($i = 0; $i < 2; $i++) {
                if ($tempPhotos->count() > 0) {
                    $gallery[] = $tempPhotos->shift();
                }
            }
            
            // Add another video if available
            if ($tempVideos->count() > 0) {
                $gallery[] = $tempVideos->shift();
            }
        }

        return view('home', compact('gallery', 'brilliantFacilities', 'bieplusFacilities', 'reviews'));
    }
}
