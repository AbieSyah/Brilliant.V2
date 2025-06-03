<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brilliant</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="{{ asset('/landing-page/css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon"href="{{ asset('landing-page/assets/img/b_camp.png') }}" type="image/x-icon">
    @livewireStyles
</head>

<body>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="hero-section" id="Beranda">
        <div class="container">
            <div class="hero-content">
                <h1>
                    <span class="highlight">Booking Camp <br>Pilihan Kamu Di</span><br> <span
                        class="camp-name">Brilliant Camp</span>
                </h1>
                <button class="hero-button" onclick="window.location.href='#fasilitas'">Selengkapnya</button>
                <p class="hero-subtext">By Brilliant English Course</p>
            </div>
        </div>
        <!-- Wave Transisi -->
        <div class="custom-shape-divider-bottom-1713946800">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,83.29C906.27,105.61,822.82,123,739.52,123c-77.87,0-154.6-15.94-231.49-29.9C432.61,78.37,346.26,63.67,263.1,52.06,183.81,41.24,101.58,33.49,20,35.64V0H1200V27.35C1112.79,50.24,1044.06,60.68,985.66,83.29Z"
                    opacity=".25" class="shape-fill"></path>
                <path
                    d="M985.66,94.78C906.27,117.1,822.82,134.5,739.52,134.5c-77.87,0-154.6-15.94-231.49-29.9C432.61,89.86,346.26,75.16,263.1,63.55,183.81,52.73,101.58,44.98,20,47.13V0H1200V38.84C1112.79,61.73,1044.06,72.17,985.66,94.78Z"
                    opacity=".5" class="shape-fill"></path>
                <path
                    d="M985.66,105.6C906.27,127.92,822.82,145.31,739.52,145.31c-77.87,0-154.6-15.94-231.49-29.9C432.61,100.69,346.26,86,263.1,74.39,183.81,63.57,101.58,55.82,20,57.97V0H1200V50.66C1112.79,73.55,1044.06,84,985.66,105.6Z"
                    class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <nav class="navbar navbar-expand-lg fixed-top bg-transparent">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('/landing-page/assets/img/logos/B_camp.png') }}" alt="Logo" width="200" height="40"
                    class="me-2" style="object-fit: contain; max-width: 200px; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#Beranda">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#galeri">Galeri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#fasilitas">Fasilitas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#chat">Ulasan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <style>
        .gallery-heading {
            font-family: 'Segoe UI', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #3f5c4c;
            margin-bottom: 0.5rem;
        }

        .gallery-desc {
            font-size: 1.05rem;
            color: #4e4e4e;
            line-height: 1.6;
        }

        .gallery-img,
        .gallery-video iframe {
            border-radius: 20px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-img:hover,
        .gallery-video iframe:hover {
            transform: scale(1.02);
        }

        @media (max-width: 768px) {
            .gallery-heading {
                font-size: 1.3rem;
                text-align: center;
            }

            .gallery-desc {
                text-align: center;
            }
        }

        .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            font-size: 30px;
            color: #ddd;
            padding: 5px;
        }

        .rating input:checked~label {
            color: #ffd700;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #ffd700;
        }

        .rating span {
            font-size: 20px;
            line-height: 1;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            margin-top: 0.25rem;
        }

        .text-danger {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        .alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            min-width: 300px;
        }
    </style>

    <!-- Gallery Section -->
    <section id="galeri" class="py-5" style="background-color: #f3f8f4;">
        <div class="container" style="max-width: 1100px;">
            <h2 class="text-center fw-bold mb-5" style="color: #519259; font-size: 2.8rem;">Galeri <span
                    style="color:#000;">B-Camp</span></h2>

            @if(count($gallery) > 0)
                @foreach($gallery as $index => $item)
                    @if($item['type'] === 'photo')
                        <!-- Photo Item -->
                        <div class="row align-items-center {{ $index % 2 == 0 ? '' : 'flex-md-row-reverse' }} mb-5">
                            <div class="col-md-6">
                                <img src="{{ Storage::url($item['item']->image) }}" class="img-fluid rounded-4 shadow gallery-img" 
                                    alt="{{ $item['item']->title }}">
                            </div>
                            <div class="col-md-6 {{ $index % 2 == 0 ? 'ps-md-4' : 'pe-md-4' }} pt-4 pt-md-0">
                                <h3 class="gallery-heading">{{ $item['item']->title }}</h3>
                                <p class="gallery-desc">{{ $item['item']->description }}</p>
                            </div>
                        </div>
                    @else
                        <!-- Video Item -->
                        <div class="row align-items-center {{ $index % 2 == 0 ? '' : 'flex-md-row-reverse' }} mb-5">
                            <div class="col-md-6">
                                <div class="ratio ratio-16x9 rounded-4 shadow gallery-video">
                                    @if($item['item']->type === 'file')
                                        <video controls>
                                            <source src="{{ Storage::url($item['item']->video_path) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @else
                                        <iframe 
                                            src="{{ $item['item']->video_embed_url }}" 
                                            title="{{ $item['item']->title }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 {{ $index % 2 == 0 ? 'ps-md-4' : 'pe-md-4' }} pt-4 pt-md-0">
                                <h3 class="gallery-heading">{{ $item['item']->title }}</h3>
                                <p class="gallery-desc">{{ $item['item']->description }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center py-5">
                    <img src="{{ asset('/landing-page/assets/img/no-data.png') }}" alt="No Gallery Items" style="max-width: 200px;">
                    <h4 class="mt-3">Belum ada konten galeri</h4>
                    <p class="text-muted">Silakan cek kembali nanti</p>
                </div>
            @endif
        </div>
    </section>

    <section class="fasilitas-section" id="fasilitas">
        <div class="container text-center">
            <!-- Section Header -->
            <div class="text-center">
                <h2
                    style="font-family: 'Montserrat', sans-serif; font-weight: 800; color: #4E6C50; font-size: 2.5rem; margin-bottom: 10px;">
                    Fasilitas
                </h2>
                <p
                    style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #000000; font-size: 1.1rem; margin: 0;">
                    Jelajahi Asrama dan Fasilitas lainnya di B-Camp!
                </p>
            </div>

            <!-- Brilliant Facilities -->
            <div class="brilliant-section mt-5">
                <h2 class="text-center mb-4">Brilliant</h2>
                @if($brilliantFacilities->count() > 0)
                    <div class="cards">
                        @foreach($brilliantFacilities as $facility)
                            <div class="card">
                                <img src="{{ asset('/landing-page/assets/img/logos/C' . ($loop->iteration % 3 == 0 ? 3 : $loop->iteration % 3) . '.png') }}"
                                    alt="Logo {{ $facility->tipe_kamar }}" class="card-logo">
                                <h3>{{ $facility->nama_kamar }}</h3>
                                <div class="image-container">
                                    <img src="{{ Storage::url($facility->image) }}" alt="{{ $facility->nama_kamar }}">
                                    <button class="detail-button" 
                                        data-facility="{{ json_encode([
                                            'title' => $facility->nama_kamar,
                                            'description' => $facility->deskripsi,
                                            'image' => Storage::url($facility->image)
                                        ]) }}" 
                                        onclick="openPopup(this)">Detail</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <img src="{{ asset('/landing-page/assets/img/no-data.png') }}" alt="No Facilities"
                            style="max-width: 200px;">
                        <h4 class="mt-3">Belum ada kamar tersedia di Brilliant</h4>
                        <p class="text-muted">Silakan cek kembali nanti</p>
                    </div>
                @endif
            </div>

            <!-- BiePlus Facilities -->
            <div class="bieplus-section mt-5">
                <h2 class="text-center mb-4">BiePlus</h2>
                @if($bieplusFacilities->count() > 0)
                    <div class="cards">
                        @foreach($bieplusFacilities as $facility)
                            <div class="card">
                                <img src="{{ asset('/landing-page/assets/img/logos/C' . ($loop->iteration % 3 == 0 ? 3 : $loop->iteration % 3) . '.png') }}"
                                    alt="Logo {{ $facility->tipe_kamar }}" class="card-logo">
                                <h3>{{ $facility->nama_kamar }}</h3>
                                <div class="image-container">
                                    <img src="{{ Storage::url($facility->image) }}" alt="{{ $facility->nama_kamar }}">
                                    <button class="detail-button" 
                                        data-facility="{{ json_encode([
                                            'title' => $facility->nama_kamar,
                                            'description' => $facility->deskripsi,
                                            'image' => Storage::url($facility->image)
                                        ]) }}" 
                                        onclick="openPopup(this)">Detail</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <img src="{{ asset('/landing-page/assets/img/no-data.png') }}" alt="No Facilities"
                            style="max-width: 200px;">
                        <h4 class="mt-3">Belum ada kamar tersedia di BiePlus</h4>
                        <p class="text-muted">Silakan cek kembali nanti</p>
                    </div>
                @endif
            </div>

            <!-- Facility Detail Popup - DIPERBARUI DENGAN ZOOM -->
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close-btn" onclick="closePopup()">&times;</span>
                    <div id="popup-image-container" style="text-align: center; margin-bottom: 20px; position: relative;">
                        <img id="popup-image" src="" alt="" 
                            style="max-width: 100%; max-height: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); cursor: zoom-in; transition: transform 0.3s ease;"
                            onclick="zoomImage(this)">
                        <div class="zoom-hint" style="position: absolute; bottom: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">
                            Klik untuk zoom
                        </div>
                    </div>
                    <h3 id="popup-title" style="margin-bottom: 15px; color: #4E6C50; font-weight: 600;"></h3>
                    <p id="popup-description" style="white-space: pre-line; line-height: 1.6; color: #333;"></p>
                </div>
            </div>

            <!-- Image Zoom Modal -->
            <div id="zoom-modal" class="zoom-modal">
                <div class="zoom-modal-content">
                    <span class="zoom-close" onclick="closeZoom()">&times;</span>
                    <img id="zoom-image" src="" alt="">
                    <div class="zoom-controls">
                        <button onclick="zoomIn()">+</button>
                        <button onclick="zoomOut()">-</button>
                        <button onclick="resetZoom()">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ulasan-section">
        <div class="container text-center">
            <h2 style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 2rem; margin-top: -350px;">
                <span style="color: #AE9518;">Gimana sih B-Camp</span><span style="color: #000000;"> menurut
                    mereka?</span>
            </h2>
            <div class="container my-5">
                <h3 class="text-center mb-4" style="font-size: 18px; margin-bottom: 100px;">Kamu bisa lihat pengalaman
                    para pengguna B-Camp
                    sebelumnya disini!</h3>
                <div class="carousel-container" style="margin-bottom: -400px;">
                    <button class="arrow-btn left" id="leftArrow" onclick="scrollCarousel(-300)">‹</button>
                    <div class="comment-carousel" id="commentCarousel">
                        @if($reviews->count() > 0)
                            @foreach($reviews as $review)
                                <div class="comment-card card">
                                    <div class="card-body text-center">
                                        <img src="{{ Storage::url($review->avatar) }}" class="rounded-circle mb-3" alt="User"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                        <h5 class="card-title">{{ $review->name }}</h5>
                                        <p class="card-text">{{ $review->year }}</p>
                                        <p class="card-text">{{ $review->content }}</p>
                                        <div class="rating d-flex justify-content-center">
                                            <span>{{ str_repeat('⭐', $review->rating) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="comment-card card">
                                <div class="card-body text-center">
                                    <img src="{{ asset('/landing-page/assets/img/no-data.png') }}" class="mb-3"
                                        alt="No Reviews" style="max-width: 150px;">
                                    <h5 class="card-title">Belum Ada Ulasan</h5>
                                    <p class="card-text">Jadilah yang pertama memberikan ulasan!</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button class="arrow-btn right" id="rightArrow" onclick="scrollCarousel(300)">›</button>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="add-feedback text-center my-5" id="chat" style="margin-bottom: auto">
            <img src="{{ asset('/landing-page/assets/img/logos/pesan.png') }}" alt="Tambah Pesan Icon"
                class="feedback-icon">
            <span class="feedback-text">Berikan Ulasan Anda disini...</span>
            <button type="button" class="feedback-btn" data-bs-toggle="modal" data-bs-target="#reviewModal">
                Ulasan
            </button>
        </div>
    </section>
    <a href="https://wa.me/6281234567890?text=Halo%20saya%20butuh%20bantuan%20tentang%20B-Camp"
        class="wa-float d-flex align-items-center" target="_blank">
        <div class="wa-text">Butuh bantuan? Chat disini..</div>
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Icon" class="wa-icon">
    </a>
    <style>
        .wa-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ffffff;
            color: #000;
            border-radius: 30px;
            padding: 8px 14px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            transition: all 0.3s ease-in-out;
        }

        .wa-float:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        .wa-text {
            margin-right: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .wa-icon {
            width: 30px;
            height: 30px;
        }

        /* POPUP STYLES - DIPERBARUI */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .close-btn {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 28px;
            cursor: pointer;
            color: #666;
            transition: color 0.3s ease;
            z-index: 1001;
        }

        .close-btn:hover {
            color: #333;
        }

        /* ZOOM MODAL STYLES */
        .zoom-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .zoom-modal-content {
            position: relative;
            max-width: 95%;
            max-height: 95%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .zoom-close {
            position: absolute;
            top: -40px;
            right: 0;
            font-size: 36px;
            color: white;
            cursor: pointer;
            z-index: 2001;
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .zoom-close:hover {
            background: rgba(0,0,0,0.8);
        }

        #zoom-image {
            max-width: 100%;
            max-height: 85vh;
            object-fit: contain;
            transition: transform 0.3s ease;
            cursor: grab;
        }

        #zoom-image:active {
            cursor: grabbing;
        }

        .zoom-controls {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .zoom-controls button {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .zoom-controls button:hover {
            background: rgba(255,255,255,0.3);
        }

        .zoom-hint {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #popup-image-container:hover .zoom-hint {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .zoom-close {
                top: -30px;
                font-size: 28px;
                width: 30px;
                height: 30px;
            }
            
            .zoom-controls button {
                padding: 6px 12px;
                font-size: 14px;
            }
        }
    </style>

    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Berikan Ulasan Untuk Brilliant Camp !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="alert-container"></div>
                    <livewire:create-review />
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', function () {
        const logo = document.querySelector('.pesan-logo');
        if (window.scrollY > 50) {
            logo.classList.add('scrolled');
        } else {
            logo.classList.remove('scrolled');
        }
    });
</script>
<script>
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
</script>
<script>
    // POPUP DAN ZOOM FUNCTIONS - DIPERBARUI
    let currentZoom = 1;
    let isDragging = false;
    let startX, startY, translateX = 0, translateY = 0;

    function openPopup(button) {
        const facility = JSON.parse(button.dataset.facility);
        
        // Set gambar
        document.getElementById('popup-image').src = facility.image;
        document.getElementById('popup-image').alt = facility.title;
        
        // Set judul
        document.getElementById('popup-title').textContent = facility.title;
        
        // Set deskripsi
        document.getElementById('popup-description').textContent = facility.description;
        
        // Tampilkan popup
        document.getElementById('popup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    function zoomImage(img) {
        const zoomModal = document.getElementById('zoom-modal');
        const zoomImage = document.getElementById('zoom-image');
        
        zoomImage.src = img.src;
        zoomImage.alt = img.alt;
        zoomModal.style.display = 'flex';
        
        // Reset zoom dan posisi
        currentZoom = 1;
        translateX = 0;
        translateY = 0;
        updateImageTransform();
    }

    function closeZoom() {
        document.getElementById('zoom-modal').style.display = 'none';
    }

    function zoomIn() {
        currentZoom = Math.min(currentZoom * 1.2, 5);
        updateImageTransform();
    }

    function zoomOut() {
        currentZoom = Math.max(currentZoom / 1.2, 0.5);
        updateImageTransform();
    }

    function resetZoom() {
        currentZoom = 1;
        translateX = 0;
        translateY = 0;
        updateImageTransform();
    }

    function updateImageTransform() {
        const zoomImage = document.getElementById('zoom-image');
        zoomImage.style.transform = `scale(${currentZoom}) translate(${translateX}px, ${translateY}px)`;
    }

    // Drag functionality untuk zoom image
    document.getElementById('zoom-image').addEventListener('mousedown', (e) => {
        if (currentZoom > 1) {
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            e.preventDefault();
        }
    });

    document.addEventListener('mousemove', (e) => {
        if (isDragging && currentZoom > 1) {
            translateX = e.clientX - startX;
            translateY = e.clientY - startY;
            updateImageTransform();
        }
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
    });

    // Touch events untuk mobile
    let touchStartX, touchStartY;

    document.getElementById('zoom-image').addEventListener('touchstart', (e) => {
        if (currentZoom > 1) {
            touchStartX = e.touches[0].clientX - translateX;
            touchStartY = e.touches[0].clientY - translateY;
        }
    });

    document.getElementById('zoom-image').addEventListener('touchmove', (e) => {
        if (currentZoom > 1) {
            e.preventDefault();
            translateX = e.touches[0].clientX - touchStartX;
            translateY = e.touches[0].clientY - touchStartY;
            updateImageTransform();
        }
    });

    // Mouse wheel zoom
    document.getElementById('zoom-image').addEventListener('wheel', (e) => {
        e.preventDefault();
        if (e.deltaY < 0) {
            zoomIn();
        } else {
            zoomOut();
        }
    });

    // Close popup when clicking outside
    window.onclick = function (event) {
        const popup = document.getElementById('popup');
        const zoomModal = document.getElementById('zoom-modal');
        
        if (event.target == popup) {
            closePopup();
        }
        if (event.target == zoomModal) {
            closeZoom();
        }
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        const zoomModal = document.getElementById('zoom-modal');
        if (zoomModal.style.display === 'flex') {
            switch(e.key) {
                case 'Escape':
                    closeZoom();
                    break;
                case '+':
                case '=':
                    zoomIn();
                    break;
                case '-':
                    zoomOut();
                    break;
                case '0':
                    resetZoom();
                    break;
            }
        }
    });
</script>
<script>
    const carousel = document.getElementById('commentCarousel');
    const leftArrow = document.getElementById('leftArrow');
    const rightArrow = document.getElementById('rightArrow');
    const cards = document.querySelectorAll('.comment-card');

    function scrollCarousel(distance) {
        carousel.scrollBy({ left: distance, behavior: 'smooth' });
    }

    function updateArrows() {
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        const scrollPosition = carousel.scrollLeft;

        // Tampilkan tombol kiri jika sudah discroll ke kanan
        if (scrollPosition > 0) {
            leftArrow.classList.add('visible');
        } else {
            leftArrow.classList.remove('visible');
        }

        // Tampilkan tombol kanan jika masih ada konten yang bisa discroll
        if (scrollPosition < maxScroll - 1) {
            rightArrow.classList.add('visible');
        } else {
            rightArrow.classList.remove('visible');
        }
    }

    function updateCenterCard() {
        const carouselRect = carousel.getBoundingClientRect();
        const carouselCenter = carouselRect.left + (carouselRect.width / 2);

        cards.forEach(card => {
            const cardRect = card.getBoundingClientRect();
            const cardCenter = cardRect.left + (cardRect.width / 2);

            if (Math.abs(cardCenter - carouselCenter) < cardRect.width / 2) {
                card.classList.add('center');
            } else {
                card.classList.remove('center');
            }
        });
    }

    function scrollToCenter() {
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        carousel.scrollTo({ left: maxScroll / 2, behavior: 'smooth' });
    }

    carousel.addEventListener('scroll', () => {
        updateCenterCard();
        updateArrows();
    });
    window.addEventListener('resize', () => {
        updateCenterCard();
        updateArrows();
    });

    // Scroll ke tengah saat halaman dimuat
    window.addEventListener('load', () => {
        scrollToCenter();
        updateCenterCard();
        updateArrows();
    });

    // Initial check
    updateCenterCard();
    updateArrows();
</script>
<script>
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', function () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Scroll ke bawah -> sembunyikan navbar
            navbar.style.top = "-100px"; // sembunyikan di atas
        } else {
            // Scroll ke atas -> tampilkan navbar
            navbar.style.top = "0";
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // untuk iOS
    });
</script>
<script>
    const campDetails = {
        @foreach($brilliantFacilities->concat($bieplusFacilities) as $facility)
            '{{ $facility->id }}': {
                title: '{{ $facility->nama_kamar }}',
                description: 'Tipe: {{ $facility->tipe_kamar }}\n' +
                    'Gender: {{ $facility->gender }}\n' +
                    'Harga: Rp {{ number_format($facility->harga, 0, ',', '.') }}\n' +
                    '{{ $facility->deskripsi }}'
            },
        @endforeach
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('reviewModal');
        modal.addEventListener('show.bs.modal', function (e) {
            console.log('Modal is opening');
        });
    });
</script>
<script>
    // Auto close alert after 3 seconds
    document.addEventListener('DOMContentLoaded', function () {
        let alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(function () {
                alert.remove();
            }, 3000);
        }
    });
</script>

<!-- Footer -->
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .footer {
        background: linear-gradient(135deg, #4E6C50 0%, #395144 100%);
        color: #fff;
        padding: 60px 20px 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 -10px 30px rgba(0,0,0,0.1);
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #9DC08B, #609966, #9DC08B);
    }

    .footer-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        position: relative;
        z-index: 1;
    }

    .footer-logo {
        flex: 1 1 300px;
        margin-bottom: 30px;
        padding-right: 40px;
    }

    .footer-logo img {
        max-width: 150px;
        margin-bottom: 20px;
        filter: brightness(1.2);
        transition: transform 0.3s ease;
    }

    .footer-logo img:hover {
        transform: scale(1.05);
    }

    .footer-desc {
        font-size: 15px;
        line-height: 1.6;
        color: #E5F0EA;
        text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
    }

    .footer-contact {
        flex: 1 1 300px;
        margin-bottom: 20px;
        background: rgba(255,255,255,0.05);
        padding: 25px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 12px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.03);
    }

    .contact-item:hover {
        background: rgba(255,255,255,0.1);
        transform: translateX(5px);
    }

    .contact-item span {
        margin-left: 15px;
        font-size: 14px;
        color: #E5F0EA;
    }

    .contact-icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        fill: currentColor;
    }

    .footer-bottom {
        text-align: center;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px;
        margin-top: 30px;
        font-size: 14px;
        color: #9DC08B;
    }

    .footer-bottom strong {
        color: #fff;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .footer {
            padding: 40px 20px 30px;
        }
        
        .footer-logo, .footer-contact {
            flex: 1 1 100%;
            padding-right: 0;
        }

        .contact-item {
            padding: 8px;
        }
    }
</style>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="{{ asset('/landing-page/assets/img/b_camp.png') }}" alt="Brilliant English Course">
            <div class="footer-desc">
                Lembaga Kursus Bahasa Inggris Terbesar, Ternyaman dan Paling Fun di Kampung Inggris Pare – Kediri
            </div>
        </div>
        <div class="footer-contact">
            <div class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24">
                    <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02c-.37-1.11-.56-2.3-.56-3.53c0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99C3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/>
                </svg>
                <span>0821-4148-6171</span>
            </div>
            <div class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24">
                    <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                </svg>
                <span>0821-4148-6171</span>
            </div>
            <div class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24">
                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
                <span>info@kursusbrilliant.com</span>
            </div>
            <div class="contact-item">
                <svg class="contact-icon" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                <span>Jl. Flamboyan No.127B, Tulungrejo, Kec. Pare Kediri, Jawa Timur – INDONESIA</span>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        © 2025 <strong>Brilliant English Course</strong>. All rights reserved
    </div>
</footer>
</body>

</html>