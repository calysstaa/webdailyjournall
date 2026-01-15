<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['username'])) {
    header("location:admin.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = md5($_POST['pass']); 

    $query = "SELECT * FROM user WHERE username=? AND password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("location:admin.php");
    } else {
        echo "<script>alert('Username atau Password Salah!'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
</head>
<body class="bg-danger-subtle">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg border-0 mt-5">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="bi bi-person-circle display-1 text-danger"></i>
                            <h3 class="fw-bold mt-2">Admin Login</h3>
                            <p class="text-muted">Silakan masuk ke akun Anda</p>
                        </div>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" name="user" class="form-control form-control-lg" placeholder="Masukkan Username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" name="pass" class="form-control form-control-lg" placeholder="Masukkan Password" required>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" name="login" class="btn btn-danger btn-lg fw-bold">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="index.php" class="text-decoration-none text-danger"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
