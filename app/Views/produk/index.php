<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <span><i class="bi bi-box-seam me-2"></i>Data Produk</span>
        <a href="/produk/tambah" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th class="px-4">No</th><th>Kode</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach($produk as $i => $p): ?>
            <tr>
                <td class="px-4"><?= $i+1 ?></td>
                <td><code><?= $p['kode_produk'] ?></code></td>
                <td><?= $p['nama_produk'] ?></td>
                <td><span class="badge bg-light text-dark"><?= $p['nama_kategori'] ?></span></td>
                <td>Rp <?= number_format($p['harga'],0,',','.') ?></td>
                <td><span class="badge <?= $p['stok'] <= 5 ? 'bg-danger' : 'bg-success' ?>"><?= $p['stok'] ?></span></td>
                <td>
                    <a href="/produk/edit/<?= $p['id'] ?>" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
                    <a href="/produk/hapus/<?= $p['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
