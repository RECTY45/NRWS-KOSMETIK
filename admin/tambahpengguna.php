<?php
if (isset($_POST['save'])) {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];

    // Query untuk menyimpan data pengguna ke database
    $query = "INSERT INTO admin (username, password, nama_lengkap) VALUES ('$username', '$password', '$nama_lengkap')";
    
    if ($koneksi->query($query)) {
        echo "<div class='alert alert-info mt-3'>Data pengguna tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pengguna'>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Tambah Pengguna</h2>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                <a href="index.php?halaman=pengguna" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
    