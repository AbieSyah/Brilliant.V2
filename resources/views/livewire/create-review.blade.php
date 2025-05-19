<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" class="form-control" wire:model="avatar" accept="image/*">
            @error('avatar') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" wire:model="name">
            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" id="star{{ $i }}" wire:model="rating" value="{{ $i }}">
                    <label for="star{{ $i }}">&#9733;</label>
                @endfor
            </div>
            @error('rating') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tulis Ulasan Anda Disini</label>
            <textarea class="form-control" wire:model="content" rows="4"></textarea>
            @error('content') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>