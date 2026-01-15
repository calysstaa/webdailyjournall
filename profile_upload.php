<?php
session_start();
include "koneksi.php";

if (isset($_POST['simpan_profile'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $foto_baru = $_FILES['foto']['name'];

    if (!empty($password)) {
        $password_fix = md5($password);
        $conn->query("UPDATE user SET password = '$password_fix' WHERE username = '$username'");
    }

    if ($foto_baru != "") {
        $ext = pathinfo($foto_baru, PATHINFO_EXTENSION);
        $nama_file = $username . "_" . time() . "." . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $nama_file);
        $conn->query("UPDATE user SET foto = '$nama_file' WHERE username = '$username'");
    }

    echo "<script>alert('Profil berhasil diperbarui!'); window.location='admin.php?page=profile';</script>";
}
?>
