<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_pembelian = $_GET['id'];

    // Hapus data pembelian
    $koneksi->query("DELETE FROM pembelian WHERE id_pembelian = '$id_pembelian'");

    // Hapus data pembelian_produk terkait
    $koneksi->query("DELETE FROM pembelian_produk WHERE id_pembelian = '$id_pembelian'");

    echo "<script>alert('Data pembelian telah dihapus');</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>
