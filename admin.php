<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username'])) { header("location:login.php"); }

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambar = $_FILES['gambar']['name'];
    
    if ($gambar != "") {
        move_uploaded_file($_FILES['gambar']['tmp_name'], "img/".$gambar);
    }
    
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $conn->query("UPDATE article SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id='$id'");
    } else {
        $conn->query("INSERT INTO article (judul, isi, gambar, tanggal) VALUES ('$judul', '$isi', '$gambar', NOW())");
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM article WHERE id='$id'");
}
?>
