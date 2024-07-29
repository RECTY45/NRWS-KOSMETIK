<?php
include "../koneksi.php";
global $koneksi;
$sql = "SELECT * FROM pembelian ORDER BY id_pembelian DESC";
$result = mysqli_query($koneksi, $sql);
$items = [];
if ($result) {
   while ($row = mysqli_fetch_assoc($result)) {
      $items[] = $row;
   }
   // Hitung jumlah data yang diperoleh
   $totalPembelian = mysqli_num_rows($result);
}