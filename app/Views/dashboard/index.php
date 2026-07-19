<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div style="background:#1e3a5f;border-radius:12px;padding:20px;color:#fff">
            <div class="d-flex justify-content-between align-items-center">
                <div><div style="font-size:.75rem;opacity:.7;text-transform:uppercase;letter-spacing:1px">Total Produk</div>
                <div style="font-size:2rem;font-weight:700"><?= $total_produk ?></div></div>
                <i class="bi bi-box-seam" style="font-size:2rem;opacity:.8"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background:#0f6e56;border-radius:12px;padding:20px;color:#fff">
            <div class="d-flex justify-content-between align-items-center">
                <div><div style="font-size:.75rem;opacity:.7;text-transform:uppercase;letter-spacing:1px">Total Transaksi</div>
                <div style="font-size:2rem;font-weight:700"><?= $total_transaksi ?></div></div>
                <i class="bi bi-cart-check" style="font-size:2rem;opacity:.8"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background:#854f0b;border-radius:12px;padding:20px;color:#fff">
            <div class="d-flex justify-content-between align-items-center">
                <div><div style="font-size:.75rem;opacity:.7;text-transform:uppercase;letter-spacing:1px">Pendapatan Hari Ini</div>
                <div style="font-size:1.1rem;font-weight:700">Rp <?= number_format($pendapatan_hari,0,',','.') ?></div></div>
                <i class="bi bi-cash-coin" style="font-size:2rem;opacity:.8"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background:#4a1b0c;border-radius:12px;padding:20px;color:#fff">
            <div class="d-flex justify-content-between align-items-center">
                <div><div style="font-size:.75rem;opacity:.7;text-transform:uppercase;letter-spacing:1px">Total Pengguna</div>
                <div style="font-size:2rem;font-weight:700"><?= $total_user ?></div></div>
                <i class="bi bi-people" style="font-size:2rem;opacity:.8"></i>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header py-3"><i class="bi bi-clock-history me-2"></i>Transaksi Terakhir</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th class="px-4">Kode Transaksi</th><th>Kasir</th><th>Total</th><th>Waktu</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if(!empty($transaksi_terakhir)): ?>
                <?php foreach($transaksi_terakhir as $t): ?>
                <tr>
                    <td class="px-4"><code><?= $t['kode_transaksi'] ?></code></td>
                    <td><?= $t['nama_kasir'] ?></td>
                    <td><strong>Rp <?= number_format($t['total_harga'],0,',','.') ?></strong></td>
                    <td><small class="text-muted"><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?></small></td>
                    <td><a href="/transaksi/struk/<?= $t['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-receipt"></i></a></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada transaksi</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
