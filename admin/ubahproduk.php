<div class="container mt-5">
    <h2 class="mb-4">Kelola Data Produk</h2>

    <?php
    // Pastikan ada ID produk di parameter GET
    if (isset($_GET['id'])) {
        // Gunakan prepared statement untuk mencegah SQL Injection
        $stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $pecah = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    } else {
        die("ID produk tidak ditemukan.");
    }
    ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Edit Produk</h2>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo htmlspecialchars($pecah['nama_produk']); ?>">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" name="harga" id="harga" value="<?php echo htmlspecialchars($pecah['harga_produk']); ?>">
                </div>

                <div class="mb-3">
                    <label for="berat" class="form-label">Berat (Gr)</label>
                    <input type="number" class="form-control" name="berat" id="berat" value="<?php echo htmlspecialchars($pecah['berat_produk']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Produk Saat Ini</label>
                    <div>
                        <img src="../foto_produk/<?php echo htmlspecialchars($pecah['foto_produk']); ?>" class="img-fluid" alt="Foto Produk" width="200">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Ganti Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5"><?php echo htmlspecialchars($pecah['deskripsi_produk']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" name="ubah">Edit</button>
                <a href="index.php?halaman=produk" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>

    <?php
    if (isset($_POST['ubah'])) {
		if (!empty($_FILES['foto']['tmp_name'])) {
			$namafoto = $_FILES['foto']['name'];
			$lokasifoto = $_FILES['foto']['tmp_name'];
			if (move_uploaded_file($lokasifoto, "../foto_produk/$namafoto")) {
				$foto_baru = true;
			} else {
				echo "<div class='alert alert-danger mt-3'>Gagal mengupload foto produk.</div>";
			}
		}
	
		if ($foto_baru) {
			$stmt = $koneksi->prepare("UPDATE produk SET nama_produk = ?, harga_produk = ?, berat_produk = ?, foto_produk = ?, deskripsi_produk = ? WHERE id_produk = ?");
			$stmt->bind_param("sssssi", $_POST['nama'], $_POST['harga'], $_POST['berat'], $namafoto, $_POST['deskripsi'], $_GET['id']);
		} else {
			$stmt = $koneksi->prepare("UPDATE produk SET nama_produk = ?, harga_produk = ?, berat_produk = ?, deskripsi_produk = ? WHERE id_produk = ?");
			$stmt->bind_param("ssssi", $_POST['nama'], $_POST['harga'], $_POST['berat'], $_POST['deskripsi'], $_GET['id']);
		}
	
		if ($stmt->execute()) {
			echo "<div class='alert alert-success mt-3'>Data produk telah diubah</div>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
		} else {
			echo "<div class='alert alert-danger mt-3'>Terjadi kesalahan saat mengubah data produk.</div>";
		}
		$stmt->close();
	}
	
    ?>

</div>
