<?php
include "../koneksi.php";
global $koneksi;
$sql = "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC";
$result = mysqli_query($koneksi, $sql);
$items = [];
if ($result) {
   while ($row = mysqli_fetch_assoc($result)) {
      $items[] = $row;
   }
   // Hitung jumlah data yang diperoleh
   $totalPelanggan = mysqli_num_rows($result);
}