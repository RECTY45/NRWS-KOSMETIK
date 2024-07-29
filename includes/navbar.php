<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="">NRWS<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

                <div class="collapse navbar-collapse" id="navbarsFurni">
    <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li><a class="nav-link" href="produk.php">Shop</a></li>

        <?php if (isset($_SESSION["pelanggan"])): ?>
            <!-- Menu yang ditampilkan jika sudah login -->
            <li><a class="nav-link" href="checkout.php">Checkout</a></li>
            <li><a class="nav-link" href="keranjang.php">Cart</a></li>
        <?php endif; ?>
    </ul>
    <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
        <?php if (!isset($_SESSION["pelanggan"])): ?>
            <!-- Menu yang ditampilkan jika belum login -->
            <li><a class="nav-link" href="login.php">Login</a></li>
            <li><a class="nav-link" href="daftar.php">Daftar</a></li>
        <?php else: ?>
            <!-- Menu tambahan jika sudah login (misalnya Logout) -->
            <li><a class="nav-link" href="logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>
</div>

			</div>
				
		</nav>