<?php
include "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $gambar = $_GET['gambar'];
    if ($gambar != "" && file_exists("img/" . $gambar)) {
        unlink("img/" . $gambar);
    }
    $conn->query("DELETE FROM article WHERE id = '$id'");
    echo "<script>window.location='admin.php?page=article';</script>";
}

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $nama_gambar = $_FILES['gambar']['name'];

    if ($nama_gambar != "") {
        $gambar_final = time() . "_" . $nama_gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "img/" . $gambar_final);
        if (!empty($_POST['gambar_lama'])) { unlink("img/" . $_POST['gambar_lama']); }
    } else {
        $gambar_final = $_POST['gambar_lama'] ?? '';
    }

    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $conn->query("UPDATE article SET judul='$judul', isi='$isi', gambar='$gambar_final' WHERE id='$id'");
    } else {
        $conn->query("INSERT INTO article (judul, isi, gambar, tanggal) VALUES ('$judul', '$isi', '$gambar_final', NOW())");
    }
    echo "<script>window.location='admin.php?page=article';</script>";
}
?>

<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">article</h4>
        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahArt">
            <i class="bi bi-plus-lg"></i> Tambah Article
        </button>
    </div>

    <table class="table table-hover border">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $res = $conn->query("SELECT * FROM article ORDER BY tanggal DESC");
            while ($row = $res->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <strong><?= $row['judul'] ?></strong><br>
                        <small class="text-muted"><?= $row['tanggal'] ?></small>
                    </td>
                    <td><img src="img/<?= $row['gambar'] ?>" width="100"></td>
                    <td>
                        <a href="admin.php?page=article&hapus=<?= $row['id'] ?>&gambar=<?= $row['gambar'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
