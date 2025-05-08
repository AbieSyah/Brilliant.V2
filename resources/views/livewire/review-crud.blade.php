<!DOCTYPE html>
<html>

<head>
    <!-- ...existing code... -->
    @livewireStyles
</head>

<body>
    <!-- ...existing code... -->
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Create Review Button -->
        <div class="mb-4">
            <button wire:click="resetReview" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#reviewModal">
                Tambah Review
            </button>
        </div>

        <!-- Reviews Table -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tahun</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                        <th>Avatar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->name }}</td>
                            <td>{{ $review->year }}</td>
                            <td>{{ Str::limit($review->content, 50) }}</td>
                            <td>{{ $review->rating }}/5</td>
                            <td>
                                @if($review->avatar)
                                    <img src="{{ Storage::url($review->avatar) }}" alt="Avatar" class="rounded-circle"
                                        width="50">
                                @endif
                            </td>
                            <td>
                                <button wire:click="edit({{ $review->id }})" class="btn btn-sm btn-info"
                                    data-bs-toggle="modal" data-bs-target="#reviewModal">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $review->id }})" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus review ini?')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $reviews->links() }}
    </div>
    </div>