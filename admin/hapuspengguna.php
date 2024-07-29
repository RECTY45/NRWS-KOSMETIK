<?php
include "../koneksi.php";
$ambil = $koneksi->query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
var_dump($ambil);
	$koneksi->query("DELETE FROM admin WHERE id_admin='$_GET[id]'");
	echo "<script>alert('Data Pengguna Berhasil di hapus');</script>";
	echo "<script>location='index.php?halaman=pengguna';</script>";
