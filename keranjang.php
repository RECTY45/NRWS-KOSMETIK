<?php
session_start();
include	"koneksi.php";

if (empty($_SESSION["keranjang"]) || !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kosong, Silahkan belanja');</script>";
    echo "<script>location = 'index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Keranjang Belanja</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .container {
            max-width: 1200px;
            margin-top: 20px;
        }
        .table thead th {
            background-color: #f8f9fa;
            text-align: center;
        }
        .table tbody td {
            text-align: center;
        }
        .btn-custom {
            margin-top: 10px;
        }
        .btn-danger.btn-sm {
            font-size: 0.875rem;
            padding: 0.25rem 0.5rem;
        }
        .quantity-container .form-control {
            max-width: 60px;
            text-align: center;
        }
        .product-thumbnail img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Start Header/Navigation -->
    <?php include 'includes/navbar.php'; ?>
    <!-- End Header/Navigation -->

    <section class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Gambar</th>
                                    <th class="product-name">Produk</th>
                                    <th class="product-price">Harga</th>
                                    <th class="product-quantity">Jumlah</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                                <?php
                                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                $pecah = $ambil->fetch_assoc();
                                $subharga = $pecah["harga_produk"] * $jumlah;
                                ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="foto_produk/<?php echo $pecah['foto_produk']; ?>" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black"><?php echo $pecah["nama_produk"]; ?></h2>
                                    </td>
                                    <td class="product-price">Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                                    <td class="product-quantity">
                                      <h5> <?php echo $jumlah; ?></h5>
                                    </td>
                                    <td class="product-total">Rp. <?php echo number_format($subharga); ?></td>
                                    <td class="product-remove">
                                        <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-sm">X</a>
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-outline-black btn-sm btn-block">Lanjutkan Belanja</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Total Keranjang</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp. <?php echo number_format(array_sum(array_map(function($id_produk, $jumlah) use ($koneksi) {
                                        $ambil = $koneksi->query("SELECT harga_produk FROM produk WHERE id_produk='$id_produk'");
                                        $pecah = $ambil->fetch_assoc();
                                        return $pecah['harga_produk'] * $jumlah;
                                    }, array_keys($_SESSION['keranjang']), $_SESSION['keranjang']))); ?></strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp. <?php echo number_format(array_sum(array_map(function($id_produk, $jumlah) use ($koneksi) {
                                        $ambil = $koneksi->query("SELECT harga_produk FROM produk WHERE id_produk='$id_produk'");
                                        $pecah = $ambil->fetch_assoc();
                                        return $pecah['harga_produk'] * $jumlah;
                                    }, array_keys($_SESSION['keranjang']), $_SESSION['keranjang']))); ?></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Lanjutkan ke pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
