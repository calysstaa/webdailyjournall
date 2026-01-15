<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="icon" href="img/logo.png" />
    <style>
      .accordion-button:not(.collapsed) {
        background-color: #da6a73;
        color: white;
      }
      #hero { min-height: 50vh; }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">My Daily Journal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
            <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
            <li class="nav-item"><a class="nav-link" href="#aboutme">About Me</a></li>
            <li class="nav-item"><a class="nav-link btn btn-outline-danger ms-lg-2" href="login.php">Login</a></li>
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
            <h4 class="lead display-6">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</h4>
            <h6 class="mt-4">
              <i class="bi bi-calendar-event"></i> <span id="tanggal"></span> 
              <span class="mx-2">|</span>
              <i class="bi bi-clock"></i> <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Article</h1>
        
        <div class="row justify-content-center mb-4">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input type="text" id="search_input" class="form-control" placeholder="Cari judul artikel...">
            </div>
          </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center" id="article_content">
           </div>
      </div>
    </section>
    <footer class="text-center p-5 border-top">
      <div>
        <i class="h2 bi bi-instagram p-2"></i>
        <i class="h2 bi bi-twitter p-2"></i>
        <i class="h2 bi bi-whatsapp p-2"></i>
      </div>
      <div><p>Aprilyani Nur Safitri &copy; 2023</p></div>
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
        // Load data awal
        load_data();

        function load_data(search = '') {
          $.ajax({
            url: "article.php",
            method: "POST",
            data: { search: search },
            success: function(data) {
              $('#article_content').html(data);
            }
          });
        }

        $('#search_input').keyup(function() {
          let search = $(this).val();
          load_data(search);
        });
      });
    </script>
  </body>
</html>
