<?php 
session_start(); 
include "koneksi.php"; 
$id_produk = $_GET["id"]; 
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); 
$detail = $ambil->fetch_assoc(); 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .product-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            background: #f8f9fa;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .product-thumbnail {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .product-thumbnail:hover {
            transform: scale(1.05);
        }

        .product-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 15px;
        }

        .product-item a.btn {
            margin-bottom: 10px;
        }

        .product-detail {
            background: #fff;
            border: 1px solid #dee2e6;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-detail img {
            max-width: 100%;
            width: 100%;
            max-height: 300px; /* Membuat gambar lebih kecil */
            height: auto;
            border-radius: 5px;
        }

        .product-detail h2 {
            margin-top: 20px;
        }

        .product-detail .btn {
            margin-top: 20px;
        }

        .input-group {
            max-width: 200px;
            margin-top: 10px;
        }

        .input-group input {
            text-align: center;
        }

        .input-group-append {
            display: flex;
            align-items: center;
        }

        .input-group-append .btn {
            margin: 0; /* Menghilangkan margin */
        }

        .product-description {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
            margin-top: 20px;
            font-family: 'Arial', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .product-description:hover {
            background: #e9ecef;
        }

        .product-description h4 {
            font-weight: bold;
            margin-bottom: 15px;
            color: #007bff;
        }

        .product-description p {
            margin: 0;
        }
    </style>
    <title>NRWS KOSMETIK | SHOP</title>
</head>
<body>
    <!-- Start Header/Navigation -->
    <?php include 'includes/navbar.php'; ?>
    <!-- End Header/Navigation -->

    <section class="content">
        <div class="container">
            <div class="row mt-5 pb-5">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="product-detail">
                        <img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="Gambar Produk" class="img-responsive" />
                        <h2><?php echo $detail["nama_produk"]; ?></h2>
                        <h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
                        <form method="post">
                            <div class="form-group">
                                <div class="input-group gap-2">
                                    <input type="number" min="1" class="form-control" name="jumlah">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" name="beli">Beli</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST["beli"])) {
                            $jumlah = $_POST["jumlah"];
                            $_SESSION["keranjang"][$id_produk] = $jumlah;
                            echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
                            echo "<script>location = 'keranjang.php';</script>";
                        }
                        ?>

                        <div class="product-description">
                            <h4>Deskripsi Produk</h4>
                            <p><?php echo $detail["deskripsi_produk"]; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Footer Section -->
    <?php include 'includes/footer-shop.php'; ?>
    <!-- End Footer Section -->

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
