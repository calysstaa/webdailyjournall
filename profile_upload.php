<?php
session_start();
include "koneksi.php";

if (isset($_POST['simpan_profile'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (!empty($password)) {
        $password_fix = md5($password);
        $conn->query("UPDATE user SET password = '$password_fix' WHERE username = '$username'");
    }

    if ($_FILES['foto']['name'] != "") {
        $nama_foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $nama_foto);
        $conn->query("UPDATE user SET foto = '$nama_foto' WHERE username = '$username'");
    }

    echo "<script>alert('Profil Berhasil Diperbarui'); window.location='admin.php?page=profile';</script>";
}
?>
