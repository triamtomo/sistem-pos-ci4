<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <span><i class="bi bi-tags me-2"></i>Data Kategori</span>
        <a href="/kategori/tambah" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th class="px-4">No</th><th>Nama Kategori</th><th>Dibuat</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach($kategori as $i => $k): ?>
            <tr>
                <td class="px-4"><?= $i+1 ?></td>
                <td><?= $k['nama_kategori'] ?></td>
                <td><small class="text-muted"><?= date('d/m/Y', strtotime($k['created_at'])) ?></small></td>
                <td>
                    <a href="/kategori/edit/<?= $k['id'] ?>" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
                    <a href="/kategori/hapus/<?= $k['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
