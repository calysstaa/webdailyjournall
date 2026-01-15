<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <style>
        .accordion-button:not(.collapsed) { background-color: #da6a73; color: white; }
        #hero { min-height: 50vh; }
        .carousel-item img { height: 500px; object-fit: cover; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-lg-3" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero" class="text-center bg-danger-subtle p-5 text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/banner.jpg" class="img-fluid" width="300" />
                <div>
                    <h1 class="fw-bold display-4">Create Memories, Save Memories, Everyday</h1>
                    <h4 class="lead">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</h4>
                    <div class="mt-4 p-3 bg-white d-inline-block rounded shadow-sm">
                        <i class="bi bi-calendar-event"></i> <span id="tanggal"></span> | 
                        <i class="bi bi-clock"></i> <span id="jam"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Article</h1>
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <input type="text" id="search_input" class="form-control" placeholder="Cari artikel...">
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4" id="article_content">
                </div>
        </div>
    </section>

    <section id="gallery" class="bg-danger-subtle text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Gallery</h1>
            <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <?php
                  include "koneksi.php";
                  $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                  $result = $conn->query($sql);
                  $first = true;
                
                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                          $active = $first ? "active" : "";
                          echo '<div class="carousel-item ' . $active . '">
                                  <img src="img/' . $row['gambar'] . '" class="d-block w-100" alt="..." style="height: 500px; object-fit: cover;">
                                  <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                                    <p>' . $row['deskripsi'] . '</p>
                                    <small>Oleh: ' . $row['user'] . '</small>
                                  </div>
                                </div>';
                          $first = false;
                      }
                  } else {
                      echo '<div class="carousel-item active"><img src="img/default.jpg" class="d-block w-100"><div class="carousel-caption"><h5>Belum ada data gallery</h5></div></div>';
                  }
                  ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <footer class="text-center p-5 border-top">
        <p>Aprilyani Nur Safitri &copy; 2023</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('tanggal').innerText = now.toLocaleDateString('id-ID', options);
            document.getElementById('jam').innerText = now.toLocaleTimeString('id-ID');
        }
        setInterval(updateClock, 1000);
        updateClock();

        $(document).ready(function() {
            load_data();
            function load_data(search = '') {
                $.ajax({
                    url: "article.php",
                    method: "POST",
                    data: { search: search },
                    success: function(data) { $('#article_content').html(data); }
                });
            }
            $('#search_input').keyup(function() { load_data($(this).val()); });
        });
    </script>
</body>
</html>
