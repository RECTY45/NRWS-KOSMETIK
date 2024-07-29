<?php
// Koneksi database
include '../koneksi.php'; // Gantilah dengan file koneksi Anda

// Cek jika parameter id ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger mt-3'>ID pengguna tidak ditemukan.</div>";
    exit;
}

$id_admin = $_GET['id'];

// Ambil data pengguna berdasarkan id
$result = $koneksi->query("SELECT * FROM admin WHERE id_admin = '$id_admin'");
if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger mt-3'>Pengguna tidak ditemukan.</div>";
    exit;
}

$pengguna = $result->fetch_assoc();

if (isset($_POST['save'])) {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];

    // Enkripsi password hanya jika diubah
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE admin SET username = '$username', password = '$password_hash', nama_lengkap = '$nama_lengkap' WHERE id_admin = '$id_admin'";
    } else {
        // Jangan ubah password jika tidak ada perubahan
        $query = "UPDATE admin SET username = '$username', nama_lengkap = '$nama_lengkap' WHERE id_admin = '$id_admin'";
    }

    if ($koneksi->query($query)) {
        echo "<div class='alert alert-info mt-3'>Data pengguna diperbarui</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pengguna'>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }
}
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Edit Pengguna</h2>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($pengguna['nama_lengkap']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($pengguna['username']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                <a href="index.php?halaman=pengguna" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>

