<?php
include "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $gambar = $_GET['gambar'];
    
    if ($gambar != "" && file_exists("img/" . $gambar)) {
        unlink("img/" . $gambar);
    }
    
    $query = $conn->query("DELETE FROM gallery WHERE id = '$id'");
    if ($query) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location='admin.php?page=gallery';</script>";
    }
}

if (isset($_POST['simpan'])) {
    $deskripsi = $_POST['deskripsi'];
    $user = $_SESSION['username'];
    $nama_gambar = $_FILES['gambar']['name'];

    if ($nama_gambar != "") {
        $ext = pathinfo($nama_gambar, PATHINFO_EXTENSION);
        $gambar_final = "gallery_" . time() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "img/" . $gambar_final);
        
        if (!empty($_POST['id']) && !empty($_POST['gambar_lama'])) {
            unlink("img/" . $_POST['gambar_lama']);
        }
    } else {
        $gambar_final = $_POST['gambar_lama'] ?? '';
    }

    if (isset($_POST['id']) && $_POST['id'] != "") {
        $id = $_POST['id'];
        $conn->query("UPDATE gallery SET deskripsi='$deskripsi', gambar='$gambar_final', user='$user' WHERE id='$id'");
    } else {
        // Log
