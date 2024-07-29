<?php
include "../koneksi.php";
global $koneksi;
$sql = "SELECT * FROM produk ORDER BY id_produk DESC";
$result = mysqli_query($koneksi, $sql);
$items = [];
if ($result) {
   while ($row = mysqli_fetch_assoc($result)) {
      $items[] = $row;
   }
   // Hitung jumlah data yang diperoleh
   $totalProduk = mysqli_num_rows($result);
}