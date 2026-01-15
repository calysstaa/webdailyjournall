<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) { 
    header("location:login.php"); 
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        #content { min-height: 80vh; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="admin.php">My Daily Journal</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="admin.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin.php?page=article">Article</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin.php?page=gallery">Gallery</a></li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" data-bs-toggle="dropdown">
                            admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="admin.php?page=profile">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="content" class="p-5">
        <div class="container bg-white p-4 rounded shadow-sm">
            <?php
            if ($page == "dashboard") {
                $username = $_SESSION['username'];
                $res_user = $conn->query("SELECT * FROM user WHERE username = '$username'");
                $data_user = $res_user->fetch_assoc();
                
                $res_art = $conn->query("SELECT * FROM article");
                $total_art = $res_art->num_rows;
                
                $res_gal = $conn->query("SELECT * FROM gallery");
                $total_gal = $res_gal->num_rows;
                ?>
                <h1 class="border-bottom pb-2">dashboard</h1>
                <div class="text-center mt-4">
                    <h5>Selamat Datang,</h5>
                    <h2 class="text-danger fw-bold"><?= $username ?></h2>
                    <img src="img/<?= $data_user['foto'] ?>" class="rounded-circle border my-3" width="150" height="150" style="object-fit: cover;">
                    <div class="row justify-content-center mt-4 g-3">
                        <div class="col-md-3">
                            <div class="card p-3 shadow-sm border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-newspaper"></i> Article</span>
                                    <span class="badge bg-danger rounded-pill fs-5"><?= $total_art ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 shadow-sm border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-images"></i> Gallery</span>
                                    <span class="badge bg-danger rounded-pill fs-5"><?= $total_gal ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($page == "profile") {
                $username = $_SESSION['username'];
                $res = $conn->query("SELECT * FROM user WHERE username = '$username'");
                $row = $res->fetch_assoc();
                ?>
                <h1 class="border-bottom pb-2">profile</h1>
                <form action="profile_upload.php" method="post" enctype="multipart/form-data" class="mt-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ganti Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ganti Foto Profil</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block fw-bold">Foto Profil Saat Ini</label>
                        <img src="img/<?= $row['foto'] ?>" class="rounded border shadow-sm" width="100">
                    </div>
                    <button type="submit" name="simpan_profile" class="btn btn-primary px-4">simpan</button>
                </form>
            <?php
            } else if ($page == "gallery") {
                include "admin_gallery.php"; 
            } else if ($page == "article") {
                include "admin_article.php";
            }
            ?>
        </div>
    </section>

    <footer class="text-center p-4 border-top bg-white">
        <div>
            <i class="bi bi-instagram p-2"></i>
            <i class="bi bi-twitter p-2"></i>
            <i class="bi bi-whatsapp p-2"></i>
        </div>
        <p class="mt-2">Aprilyani Nur Safitri &copy; 2023</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
