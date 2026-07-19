<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
    <div class="card-header py-3 text-center">
        <i class="bi bi-receipt me-2"></i>Struk Transaksi
    </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <h5 class="fw-bold mb-1">TOKO POS</h5>
            <small class="text-muted">Aplikasi Point of Sale CI4</small>
            <hr>
        </div>
        <div class="row mb-2">
            <div class="col-6"><small class="text-muted">Kode Transaksi</small><br><code><?= $transaksi['kode_transaksi'] ?></code></div>
            <div class="col-6 text-end"><small class="text-muted">Kasir</small><br><?= $transaksi['nama_kasir'] ?></div>
        </div>
        <div class="mb-3"><small class="text-muted"><?= date('d/m/Y H:i:s', strtotime($transaksi['created_at'])) ?></small></div>
        <hr>
        <table class="table table-sm">
            <tbody>
            <?php foreach($detail as $d): ?>
            <tr>
                <td><?= $d['nama_produk'] ?><br><small class="text-muted"><?= $d['jumlah'] ?> x Rp <?= number_format($d['harga_satuan'],0,',','.') ?></small></td>
                <td class="text-end">Rp <?= number_format($d['subtotal'],0,',','.') ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <div class="d-flex justify-content-between"><span>Total</span><strong>Rp <?= number_format($transaksi['total_harga'],0,',','.') ?></strong></div>
        <div class="d-flex justify-content-between text-muted"><span>Bayar</span><span>Rp <?= number_format($transaksi['bayar'],0,',','.') ?></span></div>
        <div class="d-flex justify-content-between text-success fw-bold"><span>Kembalian</span><span>Rp <?= number_format($transaksi['kembalian'],0,',','.') ?></span></div>
        <hr>
        <div class="text-center"><small class="text-muted">Terima kasih telah berbelanja!</small></div>
        <div class="d-flex gap-2 mt-3">
            <button class="btn btn-outline-secondary btn-sm" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
            <a href="/transaksi" class="btn btn-primary btn-sm flex-fill"><i class="bi bi-plus-lg me-1"></i>Transaksi Baru</a>
        </div>
    </div>
</div>
</div>
</div>
<?= $this->endSection() ?>
