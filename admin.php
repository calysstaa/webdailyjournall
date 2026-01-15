<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username'])) { header("location:login.php"); }

if (isset($_POST['simpan'])) {
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM article WHERE id='$id'");
}
?>
