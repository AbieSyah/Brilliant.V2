<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class ReviewCrud extends Component
{
    use WithFileUploads;

    public $review;
    public $modalMode = 'create';
    public $tempAvatar;
    public $avatarType = 'local';
    public $dropboxUrl;

    protected function rules()
    {
        return [
            'review.name' => 'required|string|max:255',
            'review.year' => 'required|digits:4',
            'review.content' => 'required|string',
            'review.rating' => 'required|integer|min:1|max:5',
            'tempAvatar' => $this->avatarType === 'local' ? 'nullable|image|max:1024' : '',
            'dropboxUrl' => $this->avatarType === 'dropbox' ? 'required|url' : '',
        ];
    }

    public function mount()
    {
        $this->resetForm();
    }

    public function updatedAvatarType()
    {
        $this->tempAvatar = null;
        $this->dropboxUrl = null;
    }

    public function create()
    {
        $this->validate();

        try {
            $review = new Review();
            $review->name = $this->review['name'];
            $review->year = $this->review['year'];
            $review->content = $this->review['content'];
            $review->rating = $this->review['rating'];

            if ($this->avatarType === 'local' && $this->tempAvatar) {
                $path = $this->tempAvatar->store('avatars', 'public');
                $review->avatar = $path;
                $review->avatar_type = 'local';
            } elseif ($this->avatarType === 'dropbox' && $this->dropboxUrl) {
                $review->avatar = $this->dropboxUrl;
                $review->avatar_type = 'dropbox';
            }

            $review->save();
            session()->flash('message', 'Review berhasil dibuat.');
            $this->resetForm();
            $this->emit('closeModal');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    private function resetForm()
    {
        $this->review = [
            'name' => '',
            'year' => '',
            'content' => '',
            'rating' => '',
        ];
        $this->tempAvatar = null;
        $this->dropboxUrl = null;
        $this->avatarType = 'local';
        $this->modalMode = 'create';
    }

    public function render()
    {
        return view('livewire.review-crud', [
            'reviews' => Review::latest()->paginate(10)
        ]);
    }
}