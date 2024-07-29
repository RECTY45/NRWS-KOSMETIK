<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Tambah Produk</h2>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>

                <div class="mb-3">
                    <label for="berat" class="form-label">Berat (Gr)</label>
                    <input type="number" class="form-control" id="berat" name="berat" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
                </div>

                <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                <a href="index.php?halaman=produk" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
