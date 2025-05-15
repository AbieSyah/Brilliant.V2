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

        return view('home', compact('brilliantFacilities', 'bieplusFacilities', 'reviews'));
    }
}
