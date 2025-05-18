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
                <button class="hero-button" onclick="window.location.href='#booking'">Selengkapnya</button>
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
                <img src="{{ asset('/landing-page/assets/img/logos/logo.svg') }}" alt="Logo" width="250" height="50"
                    class="me-2">
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
                            <a class="nav-link" href="#status-kamar">Status Kamar</a>
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
        .room-grid {
            margin-bottom: 2rem;
        }

        .room-card {
            background: #fff;
            border-radius: 8px;
            padding: 0.75rem;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: transform 0.2s;
            margin: 4px;
            width: 60px;
            height: 60px;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .room-card:hover {
            transform: translateY(-2px);
        }

        .room-card.available {
            border: 1px solid #4CAF50;
        }

        .room-card.occupied {
            border: 1px solid #f44336;
            background-color: #ffebee;
        }

        .room-number {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2px;
            color: #333;
        }

        .room-status {
            font-size: 0.65rem;
            color: #666;
        }

        .room-section {
            background: #ffffff;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.06);
            border: 1px solid rgba(81, 146, 89, 0.1);
            transition: transform 0.3s ease;
        }

        .room-section:hover {
            transform: translateY(-5px);
        }

        .room-type-title {
            color: #519259;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .room-type-title::before {
            content: '';
            display: block;
            width: 30px;
            height: 3px;
            background: #519259;
            border-radius: 2px;
        }

        .room-card {
            background: #fff;
            border-radius: 10px;
            padding: 0.75rem;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin: 4px;
            width: 65px;
            height: 65px;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .room-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #519259;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .room-card:hover::before {
            transform: scaleX(1);
        }

        .room-card.available {
            border: 1.5px solid #4CAF50;
            background: linear-gradient(145deg, #ffffff, #f8fff8);
        }

        .room-card.occupied {
            border: 1.5px solid #f44336;
            background: linear-gradient(145deg, #fff5f5, #ffebee);
        }

        .room-number {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 3px;
            color: #2c3e50;
        }

        .room-status {
            font-size: 0.65rem;
            font-weight: 500;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .rooms-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .legend-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            padding: 1rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: #f8f9fa;
            transition: transform 0.2s ease;
        }

        .legend-item:hover {
            transform: translateY(-2px);
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 4px;
        }

        .legend-color.available {
            background: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        .legend-color.occupied {
            background: #f44336;
            box-shadow: 0 0 10px rgba(244, 67, 54, 0.3);
        }

        .legend-text {
            font-size: 0.9rem;
            font-weight: 500;
            color: #2c3e50;
        }
    </style>

    <section id="status-kamar" class="py-5" style="background-color: #f8f9fa;">
        <div class="container" style="max-width: 900px;">
            <h2 class="text-center fw-bold mb-4" style="color: #519259; font-size: 2rem;">Status <span
                    style="color:#000;">Kamar</span></h2>

            <!-- Brilliant Rooms -->
            <div class="room-section">
                <div class="room-type-title">Brilliant - 30 Kamar</div>
                <div class="rooms-container">
                    @php
                        $brilliantRooms = 30;
                        $brilliantOccupied = [1, 5, 10, 15];
                    @endphp

                    @for ($i = 1; $i <= $brilliantRooms; $i++)
                        <div class="room-card {{ in_array($i, $brilliantOccupied) ? 'occupied' : 'available' }}">
                            <div class="room-number">{{ $i }}</div>
                            <div class="room-status">
                                {{ in_array($i, $brilliantOccupied) ? 'Terisi' : 'Kosong' }}
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- BiePlus Rooms -->
            <div class="room-section">
                <div class="room-type-title">BiePlus - 50 Kamar</div>
                <div class="rooms-container">
                    @php
                        $biePlusRooms = 50;
                        $biePlusOccupied = [2, 7, 12, 20, 25];
                    @endphp

                    @for ($i = 1; $i <= $biePlusRooms; $i++)
                        <div class="room-card {{ in_array($i, $biePlusOccupied) ? 'occupied' : 'available' }}">
                            <div class="room-number">{{ $i }}</div>
                            <div class="room-status">
                                {{ in_array($i, $biePlusOccupied) ? 'Terisi' : 'Kosong' }}
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Legend -->
            <div class="text-center mt-3">
                <div class="legend-item">
                    <span class="legend-color available"></span>
                    <span class="legend-text">Kosong</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color occupied"></span>
                    <span class="legend-text">Terisi</span>
                </div>
            </div>
        </div>
    </section>

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

    <section id="galeri-bcamp" class="py-5" style="background-color: #f3f8f4;">
        <div class="container" style="max-width: 1100px;">
            <h2 class="text-center fw-bold mb-5" style="color: #519259; font-size: 2.8rem;">Galeri <span
                    style="color:#000;">B-Camp</span></h2>
            <div class="container" style="max-width: 1100px;">
                <!-- Item 1 - Gambar Kiri -->
                <div class="row align-items-center mb-5">
                    <div class="col-md-6">
                        <img src="{{ asset('/landing-page/assets/img/g1.jpg') }}"
                            class="img-fluid rounded-4 shadow gallery-img" alt="Foto 1">
                    </div>
                    <div class="col-md-6 ps-md-4 pt-4 pt-md-0">
                        <h3 class="gallery-heading">📸 Keseruan Hari Pertama!</h3>
                        <p class="gallery-desc">Lihat bagaimana para peserta saling berkenalan dan langsung akrab dalam
                            suasana yang hangat dan fun!</p>
                    </div>
                </div>

                <!-- Item 2 - Video Kanan -->
                <div class="row align-items-center flex-md-row-reverse mb-5">
                    <div class="col-md-6">
                        <div class="ratio ratio-16x9 rounded-4 shadow gallery-video">
                            <iframe src="https://www.youtube.com/embed/zBR5A-fGPqk" title="Video Kegiatan"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-md-6 pe-md-4 pt-4 pt-md-0">
                        <h3 class="gallery-heading">🎬 Dokumentasi Seru Banget!</h3>
                        <p class="gallery-desc">Tonton cuplikan kegiatan outdoor yang bikin ngakak tapi juga penuh
                            pembelajaran kerjasama!</p>
                    </div>
                </div>

                <!-- Item 3 - Gambar Kiri -->
                <div class="row align-items-center mb-5">
                    <div class="col-md-6">
                        <img src="{{ asset('/landing-page/assets/img/g2.jpg') }}"
                            class="img-fluid rounded-4 shadow gallery-img" alt="Foto 2">
                    </div>
                    <div class="col-md-6 ps-md-4 pt-4 pt-md-0">
                        <h3 class="gallery-heading">👭 Kebersamaan di Asrama</h3>
                        <p class="gallery-desc">Waktu malam hari di asrama jadi tempat paling seru buat saling cerita
                            dan
                            berbagi pengalaman.</p>
                    </div>
                </div>

                <!-- Item 4 - Gambar Kanan -->
                <div class="row align-items-center flex-md-row-reverse mb-5">
                    <div class="col-md-6">
                        <img src="{{ asset('/landing-page/assets/img/g3.jpg') }}"
                            class="img-fluid rounded-4 shadow gallery-img" alt="Foto 3">
                    </div>
                    <div class="col-md-6 pe-md-4 pt-4 pt-md-0">
                        <h3 class="gallery-heading">📖 Belajar Sambil Ketawa</h3>
                        <p class="gallery-desc">Belajar di B-Camp nggak bikin bosan. Suasananya cair dan instruktur
                            ramah
                            banget!</p>
                    </div>
                </div>

                <!-- Item 5 - Video Kiri -->
                <div class="row align-items-center mb-5">
                    <div class="col-md-6">
                        <div class="ratio ratio-16x9 rounded-4 shadow gallery-video">
                            <iframe src="https://www.youtube.com/embed/IZaShdlFUVI" title="Video Kegiatan 2"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-md-6 ps-md-4 pt-4 pt-md-0">
                        <h3 class="gallery-heading">🏃‍♂️ Games Team Building</h3>
                        <p class="gallery-desc">Challenge teamwork di lapangan! Semuanya semangat, saling support, dan
                            ketawa bareng!</p>
                    </div>
                </div>

                <!-- Item 6 - Gambar Kanan -->
                <div class="row align-items-center flex-md-row-reverse mb-5">
                    <div class="col-md-6">
                        <img src="{{ asset('/landing-page/assets/img/g4.jpg') }}"
                            class="img-fluid rounded-4 shadow gallery-img" alt="Foto 4">
                    </div>
                    <div class="col-md-6 pe-md-4 pt-4 pt-md-0">
                        <h3 class="gallery-heading">📖 Belajar Sambil Ketawa</h3>
                        <p class="gallery-desc">Belajar di B-Camp nggak bikin bosan. Suasananya cair dan instruktur
                            ramah
                            banget!</p>
                    </div>
                </div>
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
                                                <button class="detail-button" data-facility="{{ json_encode([
                                'title' => $facility->nama_kamar,
                                'description' => $facility->deskripsi
                            ]) }}" onclick="openPopup(this)">Detail</button>
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
                                                <button class="detail-button" data-facility="{{ json_encode([
                                'title' => $facility->nama_kamar,
                                'description' => $facility->deskripsi
                            ]) }}" onclick="openPopup(this)">Detail</button>
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

            <!-- Facility Detail Popup -->
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close-btn" onclick="closePopup()">&times;</span>
                    <p id="popup-description" style="white-space: pre-line; margin-top: 20px;"></p>
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
            <span class="feedback-text">Butuh bantuan? Chat disini...</span>
            <button type="button" class="feedback-btn" data-bs-toggle="modal" data-bs-target="#reviewModal">
                Chat
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
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;
            width: 90%;
            position: relative;
        }

        .close-btn {
            position: absolute;
            right: 10px;
            top: 5px;
            font-size: 24px;
            cursor: pointer;
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
    function openPopup(button) {
        const facility = JSON.parse(button.dataset.facility);
        document.getElementById('popup-description').textContent = facility.description;
        document.getElementById('popup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    // Close popup when clicking outside
    window.onclick = function (event) {
        const popup = document.getElementById('popup');
        if (event.target == popup) {
            closePopup();
        }
    }
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
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('commentCarousel');
        const carouselItems = carousel.querySelector('.carousel-items');
        const cards = document.querySelectorAll('.comment-card');

        // Clone cards for infinite effect
        cards.forEach(card => {
            const clone = card.cloneNode(true);
            carouselItems.appendChild(clone);
        });

        let isScrolling = false;
        let startX;
        let scrollLeft;

        // Track scrolling position
        carouselItems.addEventListener('scroll', () => {
            if (!isScrolling) {
                window.requestAnimationFrame(() => {
                    const totalWidth = carouselItems.scrollWidth / 2;
                    const currentScroll = carouselItems.scrollLeft;

                    if (currentScroll >= totalWidth) {
                        carouselItems.scrollLeft = 0;
                    } else if (currentScroll <= 0) {
                        carouselItems.scrollLeft = totalWidth;
                    }
                    isScrolling = false;
                });
            }
            isScrolling = true;
        });

        // Update arrow buttons
        function updateArrows() {
            const scrollPosition = carouselItems.scrollLeft;
            leftArrow.style.display = 'flex';
            rightArrow.style.display = 'flex';
        }

        // Scroll functions
        function scrollCarousel(distance) { }
        const currentScroll = carouselItems.scrollLeft;
        const targetScroll = currentScroll + distance;

        carouselItems.scrollTo({
            left: targetScroll,
            behavior: 'smooth'
        });
    }

        // Arrow click handlers
        document.getElementById('leftArrow').addEventListener('click', () => { }
            scrollCarousel(-300);
        });

    document.getElementById('rightArrow').addEventListener('click', () => { }
            scrollCarousel(300);
        });

    // Touch events for mobile
    carouselItems.addEventListener('touchstart', (e) => {
        startX = e.touches[0].pageX - carouselItems.offsetLeft;
        scrollLeft = carouselItems.scrollLeft;
    });

    carouselItems.addEventListener('touchmove', (e) => { }
            if (!startX) return;
    const x = e.touches[0].pageX - carouselItems.offsetLeft;
    const walk = (x - startX) * 2;
    carouselItems.scrollLeft = scrollLeft - walk;
        });

    carouselItems.addEventListener('touchend', () => {
        startX = null;
    });

    // Initialize
    updateArrows();
    window.addEventListener('resize', updateArrows);
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