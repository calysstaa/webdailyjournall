<?php
include "koneksi.php";

$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$query = "SELECT * FROM article WHERE judul LIKE '%$search%' ORDER BY tanggal DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="img/<?php echo $row['gambar']; ?>" class="card-img-top" alt="Image">
                <div class="card-body text-start">
                    <h5 class="card-title"><?php echo $row['judul']; ?></h5>
                    <p class="card-text text-muted"><?php echo substr($row['isi'], 0, 100); ?>...</p>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <small class="text-body-secondary">Diposting: <?php echo $row['tanggal']; ?></small>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p class='text-center'>Tidak ada artikel ditemukan.</p>";
}
?>
