<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Galeri B-Camp</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #f0f4f8, #d9e7f1); /* Gradasi latar belakang lembut */
      margin: 0;
      padding: 2rem;
      color: #333;
      overflow-y: auto;
    }

    h1 {
      text-align: center;
      font-size: 2.5rem;
      color: #2d3e50; /* Warna teks judul */
      margin-bottom: 1rem;
    }

    p {
      text-align: center;
      font-size: 1.1rem;
      color: #2d3e50;
      margin-bottom: 2rem;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 24px;
      max-width: 1300px;
      margin: 0 auto;
      padding-top: 2rem;
    }

    .gallery-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .gallery-item img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 12px 12px 0 0;
      transition: transform 0.3s ease;
    }

    .gallery-item img:hover {
      transform: scale(1.05);
    }

    .description {
      margin-top: 12px;
      font-size: 15px;
      text-align: center;
      color: #555;
      padding: 10px;
      width: 90%;
      background-color: #f1f1f1;
      border-radius: 0 0 12px 12px;
    }

    /* Tombol Kembali ke Beranda */
    .back-button {
      position: fixed;
      right: 20px;
      bottom: 30px;
      background-color: #2d3e50;
      color: #fff;
      padding: 15px 30px;
      border-radius: 50px;
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .back-button:hover {
      background-color: #34495e;
      transform: scale(1.1);
    }

    .back-button:active {
      background-color: #1c2b36;
    }   
  </style>
</head>
<body>
  <h1>Galeri B-Camp</h1>
  <p>Selamat datang di halaman galeri B-Camp! Berikut adalah beberapa foto dari kegiatan kami:</p>

  <div class="gallery">
    <div class="gallery-item">
      <img src="path/to/image1.jpg" alt="Kegiatan 1" />
      <div class="description">Peserta memulai kegiatan pagi dengan senam bersama.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image2.jpg" alt="Kegiatan 2" />
      <div class="description">Permainan kelompok untuk mempererat kerja sama.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image3.jpg" alt="Kegiatan 3" />
      <div class="description">Outbond menyusuri hutan sekitar lokasi camp.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image4.jpg" alt="Kegiatan 4" />
      <div class="description">Workshop kreativitas: membuat kerajinan dari alam.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image5.jpg" alt="Kegiatan 5" />
      <div class="description">Makan siang bersama dengan menu khas pedesaan.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image6.jpg" alt="Kegiatan 6" />
      <div class="description">Sesi sharing motivasi dan pengembangan diri.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image7.jpg" alt="Kegiatan 7" />
      <div class="description">Peserta bermain permainan strategi di lapangan.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image8.jpg" alt="Kegiatan 8" />
      <div class="description">Api unggun malam hari dengan pentas seni.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image9.jpg" alt="Kegiatan 9" />
      <div class="description">Jelajah alam dan foto bersama di puncak bukit.</div>
    </div>
    <div class="gallery-item">
      <img src="path/to/image10.jpg" alt="Kegiatan 10" />
      <div class="description">Penutupan dan pembagian sertifikat peserta.</div>
    </div>
  </div>

  <!-- Tombol Kembali ke Beranda -->
  <button class="back-button" onclick="window.location.href='{{ route('home') }}'">Kembali ke Beranda</button></body>
</html>
