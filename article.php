<?php
include "koneksi.php";
$search = isset($_POST['search']) ? $_POST['search'] : '';
$query = "SELECT * FROM article WHERE judul LIKE '%$search%' ORDER BY tanggal DESC";
$result = $conn->query($query);

while($row = $result->fetch_assoc()){
    ?>
    <div class="col">
        <div class="card h-100">
            <img src="img/<?= $row['gambar'] ?>" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><?= $row['judul'] ?></h5>
                <p class="card-text"><?= $row['isi'] ?></p>
            </div>
        </div>
    </div>
    <?php
}
?>
