<?php  
session_start();
include 'koneksi.php';

// Jika tidak ada session pelanggan (belum login), redirect ke login.php
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit; // Hentikan eksekusi script setelah redirect
}

// Cek apakah keranjang belanja kosong, jika kosong redirect ke halaman produk
if (!isset($_SESSION["keranjang"]) || empty($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang belanja Anda kosong.');</script>";
    echo "<script>location='produk.php';</script>";
    exit; // Hentikan eksekusi script setelah redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Checkout</title>
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
        .table tbody td, .table tfoot th {
            text-align: center;
        }
        .btn-custom {
            margin-top: 10px;
        }
        .text-danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
   <!-- Start Header/Navigation -->
		<?php include "includes/navbar.php" ?>
		<!-- End Header/Navigation -->

    <section class="untree_co-section before-footer-section">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th class="product-thumbnail">No</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                    <?php  
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                    $pecah = $ambil->fetch_assoc();
                    $subharga = $pecah["harga_produk"] * $jumlah;
                    ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah["nama_produk"]; ?></td>
                        <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja += $subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja); ?></th>
                    </tr>
                </tfoot>
            </table>

            <?php
            $error_message = '';

            if (isset($_POST["checkout"])) {
                if (empty($_POST["id_ongkir"])) {
                    $error_message = 'Pilih ongkos kirim terlebih dahulu.';
                } else {
                    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                    $id_ongkir = $_POST["id_ongkir"];
                    $tanggal_pembelian = date("Y-m-d");
                    $alamat_pengiriman = $_POST['alamat_pengiriman'];

                    $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                    $arrayongkir = $ambil->fetch_assoc();
                    $nama_kota = $arrayongkir['nama_kota'];
                    $tarif = $arrayongkir['tarif'];

                    $total_pembelian = $totalbelanja + $tarif;

                    // 1. menyimpan data ke tabel pembelian
                    $koneksi->query("INSERT INTO pembelian (
                        id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman
                    ) VALUES (
                        '$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman'
                    )");

                    // mendapatkan id_pembelian barusan terjadi
                    $id_pembelian_barusan = $koneksi->insert_id;

                    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                        // mendapatkan data produk berdasarkan id_produk
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $perproduk = $ambil->fetch_assoc();

                        $nama = $perproduk['nama_produk'];
                        $harga = $perproduk['harga_produk'];
                        $berat = $perproduk['berat_produk'];

                        $subberat = $perproduk['berat_produk'] * $jumlah;
                        $subharga = $perproduk['harga_produk'] * $jumlah;
                        $koneksi->query("INSERT INTO pembelian_produk (
                            id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah
                        ) VALUES (
                            '$id_pembelian_barusan', '$id_produk', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah'
                        )");
                    }

                    // mengosongkan keranjang belanja
                    unset($_SESSION["keranjang"]);

                    // tampilan dialihkan ke halaman nota, nota dari pembelian yang id_pembelian barusan
                    echo "<script>alert('Pembelian sukses');</script>";
                    echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
                }
            }
            ?>

            <!-- Display error message if any -->
            <?php if ($error_message): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="row mb-5">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" name="id_ongkir">
                                <option value="">Pilih Ongkos Kirim</option>
                                <?php
                                $ambil = $koneksi->query("SELECT * FROM ongkir");
                                while ($perongkir = $ambil->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $perongkir["id_ongkir"] ?>">
                                    <?php echo $perongkir['nama_kota'] ?> - Rp. <?php echo number_format($perongkir['tarif']) ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap Pengiriman</label>
                    <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap pengiriman (termasuk kode pos)"></textarea>
                </div>
                <button class="btn btn-primary btn-lg mt-2" name="checkout">Checkout</button>
            </form>
        </div>
    </section>
		<!-- Start Footer Section -->
		<?php include "includes/footer.php" ?>
		<!-- End Footer Section -->	
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
