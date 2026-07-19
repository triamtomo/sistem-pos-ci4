<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center"><div class="col-md-7">
<div class="card">
    <div class="card-header py-3"><?= $title ?></div>
    <div class="card-body">
        <form action="<?= $produk ? '/produk/update/'.$produk['id'] : '/produk/simpan' ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Kode Produk *</label>
                    <input type="text" name="kode_produk" class="form-control" value="<?= old('kode_produk', $produk['kode_produk'] ?? '') ?>" <?= $produk ? 'readonly' : 'required' ?>>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kategori *</label>
                    <select name="id_kategori" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach($kategori as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= old('id_kategori',$produk['id_kategori'] ?? '') == $k['id'] ? 'selected' : '' ?>><?= $k['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Nama Produk *</label>
                    <input type="text" name="nama_produk" class="form-control" value="<?= old('nama_produk',$produk['nama_produk'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga (Rp) *</label>
                    <input type="number" name="harga" class="form-control" value="<?= old('harga',$produk['harga'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stok *</label>
                    <input type="number" name="stok" class="form-control" value="<?= old('stok',$produk['stok'] ?? 0) ?>" required>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="/produk" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div></div>
<?= $this->endSection() ?>
