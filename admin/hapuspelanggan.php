<?php
include "../koneksi.php";
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

	$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
	echo "<script>alert('pelanggan Berhasil di hapus');</script>";
	echo "<script>location='index.php?halaman=pelanggan';</script>";
