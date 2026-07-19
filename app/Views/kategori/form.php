<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center"><div class="col-md-6">
<div class="card">
    <div class="card-header py-3"><?= $title ?></div>
    <div class="card-body">
        <form action="<?= $kategori ? '/kategori/update/'.$kategori['id'] : '/kategori/simpan' ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Nama Kategori *</label>
                <input type="text" name="nama_kategori" class="form-control"
                    value="<?= old('nama_kategori', $kategori['nama_kategori'] ?? '') ?>" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="/kategori" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div></div>
<?= $this->endSection() ?>
