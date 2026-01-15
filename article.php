<?php
include "koneksi.php";
$search = $_POST['search'] ?? '';
$query = "SELECT * FROM article WHERE judul LIKE '%$search%' ORDER BY tanggal DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="img/'.$row['gambar'].'" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">'.$row['judul'].'</h5>
              <p class="card-text">'.substr($row['isi'], 0, 100).'...</p>
            </div>
            <div class="card-footer small text-muted">'.$row['tanggal'].'</div>
          </div>
        </div>';
    }
} else {
    echo "<p class='text-center w-100'>Data tidak ditemukan.</p>";
}
?>
