<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class CreateReview extends Component
{
    use WithFileUploads;

    public $avatar;
    public $name;
    public $rating = null; 
    public $content;

    protected $rules = [
        'avatar' => 'required|image|max:2048',
        'name' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
        'content' => 'required|string',
    ];

    public function save()
    {
        $validated = $this->validate();
        
        $validated['avatar'] = $this->avatar->store('reviews', 'public');
        $validated['year'] = Carbon::now()->year;

        Review::create($validated);

        session()->flash('success', 'Ulasan berhasil dikirim!');
        
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.create-review');
    }
}