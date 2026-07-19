<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi</span>
        <a href="/transaksi" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Transaksi Baru</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th class="px-4">No</th><th>Kode</th><th>Kasir</th><th>Total</th><th>Bayar</th><th>Kembalian</th><th>Waktu</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach($transaksi as $i => $t): ?>
            <tr>
                <td class="px-4"><?= $i+1 ?></td>
                <td><code><?= $t['kode_transaksi'] ?></code></td>
                <td><?= $t['nama_kasir'] ?></td>
                <td><strong>Rp <?= number_format($t['total_harga'],0,',','.') ?></strong></td>
                <td>Rp <?= number_format($t['bayar'],0,',','.') ?></td>
                <td class="text-success">Rp <?= number_format($t['kembalian'],0,',','.') ?></td>
                <td><small class="text-muted"><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?></small></td>
                <td><a href="/transaksi/struk/<?= $t['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-receipt"></i></a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
