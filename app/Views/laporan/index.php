<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card mb-3">
    <div class="card-header py-3"><i class="bi bi-funnel me-2"></i>Filter Laporan</div>
    <div class="card-body">
        <form action="/laporan/filter" method="POST" class="row g-3 align-items-end">
            <?= csrf_field() ?>
            <div class="col-md-4">
                <label class="form-label">Tanggal Awal</label>
                <input type="date" name="tgl_awal" class="form-control" value="<?= $tgl_awal ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" class="form-control" value="<?= $tgl_akhir ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i>Tampilkan</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-3" style="background:#1e3a5f;color:#fff">
    <div class="card-body py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div style="font-size:.8rem;opacity:.7">Total Pendapatan (<?= $tgl_awal ?> s/d <?= $tgl_akhir ?>)</div>
                <div style="font-size:1.8rem;font-weight:700">Rp <?= number_format($total,0,',','.') ?></div>
            </div>
            <div style="font-size:.9rem;opacity:.8"><?= count($transaksi) ?> transaksi</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header py-3"><i class="bi bi-bar-chart-line me-2"></i>Detail Laporan</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th class="px-4">No</th><th>Kode</th><th>Kasir</th><th>Total</th><th>Waktu</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if(!empty($transaksi)): ?>
                <?php foreach($transaksi as $i => $t): ?>
                <tr>
                    <td class="px-4"><?= $i+1 ?></td>
                    <td><code><?= $t['kode_transaksi'] ?></code></td>
                    <td><?= $t['nama_kasir'] ?></td>
                    <td><strong>Rp <?= number_format($t['total_harga'],0,',','.') ?></strong></td>
                    <td><small class="text-muted"><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?></small></td>
                    <td><a href="/transaksi/struk/<?= $t['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-receipt"></i></a></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data pada periode ini</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
