<?php
include "koneksi.php";
if (isset($_POST["daftar"])) {

	$nama = $_POST["nama"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$alamat = $_POST["alamat"];
	$telepon = $_POST["telepon"];

	$ambil = $koneksi->query("SELECT * FROM pelanggan 
								WHERE email_pelanggan='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
		echo "<script>location = 'daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat') ");
		echo "<script>alert('Pendaftaran sukses, silahkan login');</script>";
		echo "<script>location = 'login.php';</script>";
	}
}

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />
	<link rel="shortcut icon" href="favicon.png">
	<style>
		.card {
			max-width: 500px;
			/* Mengatur lebar maksimum card */
			margin: auto;
			/* Memusatkan card */
		}

		.form-control {
			font-size: 0.875rem;
			/* Mengatur ukuran font input */
			padding: 0.375rem 0.75rem;
			/* Mengatur padding input */
			border-radius: 0.25rem;
			/* Mengatur border-radius input */
		}

		.btn-primary {
			padding: 0.375rem 0.75rem;
			/* Mengatur padding tombol */
			font-size: 0.875rem;
			/* Mengatur ukuran font tombol */
		}

		.form-group label {
			font-size: 0.875rem;
			/* Mengatur ukuran font label */
		}
	</style>
	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<title>Daftar Pelanggan</title>
</head>

<body>
	<!-- Start Header/Navigation -->
	<?php include "includes/navbar.php" ?>
	<!-- End Header/Navigation -->

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card mt-5 mb-5">
					<div class="card-header">
						<h3 class="card-title">Daftar Pelanggan</h3>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group mb-3">
								<label for="nama">Nama</label>
								<input type="text" class="form-control" id="nama" name="nama" required>
							</div>
							<div class="form-group mb-3">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email" required>
							</div>
							<div class="form-group mb-3">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" required>
							</div>
							<div class="form-group mb-3">
								<label for="alamat">Alamat</label>
								<textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
							</div>
							<div class="form-group mb-3">
								<label for="telepon">Telp/Hp</label>
								<input type="text" class="form-control" id="telepon" name="telepon" required>
							</div>
							<button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include "includes/footer.php" ?>

	<!-- Start Footer Section -->
	<!-- End Footer Section -->

	<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>