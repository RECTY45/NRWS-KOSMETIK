<?php

session_start();
//koneksi ke database
include 'koneksi.php';
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
	</style>
	<title>NRWS KOSMETIK | SHOP</title>
</head>

<body>

	<!-- Start Header/Navigation -->
	<?php include 'includes/navbar.php'; ?>
	<!-- End Header/Navigation -->

	<!-- Start Hero Section -->
	<?php include 'includes/hero-shop.php'; ?>
	<!-- End Hero Section -->

	<div class="untree_co-section product-section before-footer-section">
		<div class="container">
			<div class="row">
				<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
				<?php while ($perproduk = $ambil->fetch_assoc()) { ?>
					<!-- Start Column 1 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5 d-flex align-items-stretch">
						<div class="product-item">
							<a href="#">
								<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" class="img-fluid product-thumbnail">
								<h3 class="product-title"><?php echo $perproduk['nama_produk']; ?></h3>
								<strong class="product-price">Rp. <?php echo number_format($perproduk['harga_produk']); ?></strong>
							</a>
							<div class="mt-auto">
								<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
								<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-secondary">Detail</a>
							</div>
						</div>
					</div>
					<!-- End Column 1 -->
				<?php } ?>
			</div>
		</div>
	</div>


	<!-- Start Footer Section -->
	<?php include 'includes/footer.php'; ?>
	<!-- End Footer Section -->


	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/tiny-slider.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>