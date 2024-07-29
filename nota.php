<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nota-header, .nota-footer {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
        .nota-body {
            padding: 20px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .text-center-custom {
            text-align: center;
        }
        .nota-table {
            margin-top: 20px;
        }
        .nota-footer p {
            margin-bottom: 0;
        }
        .table th, .table td {
            padding: 10px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="nota-header text-center mb-4">
        <h2>Nota Pembelian</h2>
    </div>

    <?php
    // Cek apakah id_pembelian ada di URL
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("ID pembelian tidak ditemukan!");
    }

    // Ambil detail pembelian berdasarkan id_pembelian dari URL
    $id_pembelian = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$id_pembelian'");

    if (!$ambil) {
        die("Query gagal: " . $koneksi->error);
    }

    $detail = $ambil->fetch_assoc();

    if (!$detail) {
        die("Detail pembelian tidak ditemukan untuk ID: $id_pembelian");
    }
    ?>

    <div class="nota-body">
        <table class="table table-borderless">
            <tr>
                <th class="text-start">Nama Pelanggan</th>
                <td class="text-end"><?php echo htmlspecialchars($detail['nama_pelanggan']); ?></td>
            </tr>
            <tr>
                <th class="text-start">Telepon</th>
                <td class="text-end"><?php echo htmlspecialchars($detail['telepon_pelanggan']); ?></td>
            </tr>
            <tr>
                <th class="text-start">Email</th>
                <td class="text-end"><?php echo htmlspecialchars($detail['email_pelanggan']); ?></td>
            </tr>
            <tr>
                <th class="text-start">Tanggal Pembelian</th>
                <td class="text-end"><?php echo htmlspecialchars($detail['tanggal_pembelian']); ?></td>
            </tr>
            <tr>
                <th class="text-start">Total Pembelian</th>
                <td class="text-end">Rp. <?php echo number_format($detail['total_pembelian']); ?></td>
            </tr>
        </table>
    </div>

    <table class="table table-bordered nota-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Produk</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php
            // Ambil data produk yang dibeli berdasarkan id_pembelian
            $query_produk = "SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk WHERE pembelian_produk.id_pembelian = '$id_pembelian'";
            $ambil_produk = $koneksi->query($query_produk);

            if (!$ambil_produk) {
                die("Query produk gagal: " . $koneksi->error);
            }

            while ($pecah = $ambil_produk->fetch_assoc()) {
            ?>
            <tr>
                <td class="text-center"><?php echo $nomor; ?></td>
                <td><?php echo htmlspecialchars($pecah['nama_produk']); ?></td>
                <td class="text-end">Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($pecah['jumlah']); ?></td>
                <td class="text-end">Rp. <?php echo number_format($pecah['harga_produk'] * $pecah['jumlah']); ?></td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>

    <div class="nota-footer text-center mt-4">
        <p>Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke</p>
        <p><strong>BANK BRI 088 786 211 . <?php echo htmlspecialchars($detail['nama_pelanggan']); ?></strong></p>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
