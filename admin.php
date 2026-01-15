<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username'])) { header("location:login.php"); }

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="admin.php">My Daily Journal</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="admin.php?page=profile">Profile</a></li> <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 bg-white p-4 rounded shadow-sm">
        <?php
        if ($page == "profile") {
            $username = $_SESSION['username'];
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            ?>
            <h1 class="fw-bold display-4 pb-3 border-bottom">profile</h1>
            <form action="profile_upload.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" readonly> </div>
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
                    <img src="img/<?= $row['foto'] ?>" class="rounded-circle" width="100">
                </div>
                <button type="submit" name="simpan_profile" class="btn btn-primary">simpan</button>
            </form>
            <?php
        } else {
            echo "<h3>Selamat Datang, " . $_SESSION['username'] . "</h3>";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
