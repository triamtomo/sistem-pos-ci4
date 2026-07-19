<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row g-3">
    <!-- Daftar Produk -->
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header py-3">
                <i class="bi bi-box-seam me-2"></i>Pilih Produk
                <input type="text" id="searchProduk" class="form-control form-control-sm d-inline-block w-auto ms-3" placeholder="Cari produk...">
            </div>
            <div class="card-body p-0" style="max-height:500px;overflow-y:auto">
                <table class="table table-hover mb-0" id="tableProduk">
                    <thead class="sticky-top"><tr>
                        <th class="px-3">Nama Produk</th><th>Harga</th><th>Stok</th><th>Aksi</th>
                    </tr></thead>
                    <tbody>
                    <?php foreach($produk as $p): ?>
                    <tr>
                        <td class="px-3">
                            <div class="fw-500"><?= $p['nama_produk'] ?></div>
                            <small class="text-muted"><?= $p['nama_kategori'] ?></small>
                        </td>
                        <td>Rp <?= number_format($p['harga'],0,',','.') ?></td>
                        <td><span class="badge <?= $p['stok'] <= 5 ? 'bg-danger' : 'bg-success' ?>"><?= $p['stok'] ?></span></td>
                        <td>
                            <?php if($p['stok'] > 0): ?>
                            <button class="btn btn-sm btn-primary" onclick="tambahItem(<?= $p['id'] ?>, '<?= addslashes($p['nama_produk']) ?>', <?= $p['harga'] ?>, <?= $p['stok'] ?>)">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                            <?php else: ?>
                            <span class="badge bg-secondary">Habis</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Keranjang -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header py-3"><i class="bi bi-cart3 me-2"></i>Keranjang Belanja</div>
            <div class="card-body p-0">
                <div style="max-height:280px;overflow-y:auto">
                    <table class="table table-sm mb-0" id="tabelKeranjang">
                        <thead><tr><th class="px-3">Produk</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
                        <tbody id="keranjangBody">
                            <tr id="emptyRow"><td colspan="4" class="text-center text-muted py-3">Keranjang kosong</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-3 border-top">
                    <div class="d-flex justify-content-between fw-bold mb-2">
                        <span>Total:</span>
                        <span id="totalHarga">Rp 0</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Uang Bayar (Rp)</label>
                        <input type="number" id="bayar" class="form-control" placeholder="Masukkan nominal" oninput="hitungKembalian()">
                        <div class="mt-1 d-flex justify-content-between">
                            <small class="text-muted">Kembalian:</small>
                            <small class="fw-bold text-success" id="kembalian">Rp 0</small>
                        </div>
                    </div>
                    <form id="formTransaksi" action="/transaksi/proses" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="items" id="itemsInput">
                        <input type="hidden" name="bayar" id="bayarInput">
                        <button type="button" class="btn btn-success w-100 fw-bold" onclick="prosesTransaksi()">
                            <i class="bi bi-check-circle me-2"></i>Proses Transaksi
                        </button>
                    </form>
                    <button class="btn btn-outline-danger w-100 mt-2 btn-sm" onclick="clearKeranjang()">
                        <i class="bi bi-trash me-1"></i>Kosongkan Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let keranjang = [];
let total = 0;

function tambahItem(id, nama, harga, maxStok) {
    const idx = keranjang.findIndex(i => i.id === id);
    if (idx >= 0) {
        if (keranjang[idx].jumlah >= maxStok) {
            alert('Stok tidak mencukupi!'); return;
        }
        keranjang[idx].jumlah++;
    } else {
        keranjang.push({id, nama, harga, jumlah: 1, maxStok});
    }
    renderKeranjang();
}

function ubahJumlah(id, delta) {
    const idx = keranjang.findIndex(i => i.id === id);
    if (idx < 0) return;
    keranjang[idx].jumlah += delta;
    if (keranjang[idx].jumlah <= 0) keranjang.splice(idx, 1);
    renderKeranjang();
}

function hapusItem(id) {
    keranjang = keranjang.filter(i => i.id !== id);
    renderKeranjang();
}

function clearKeranjang() {
    if (keranjang.length === 0) return;
    if (confirm('Kosongkan keranjang?')) { keranjang = []; renderKeranjang(); }
}

function renderKeranjang() {
    total = keranjang.reduce((s, i) => s + i.harga * i.jumlah, 0);
    const tbody = document.getElementById('keranjangBody');
    const emptyRow = document.getElementById('emptyRow');
    if (keranjang.length === 0) {
        tbody.innerHTML = '<tr id="emptyRow"><td colspan="4" class="text-center text-muted py-3">Keranjang kosong</td></tr>';
    } else {
        tbody.innerHTML = keranjang.map(i => `
        <tr>
            <td class="px-3"><div style="font-size:.85rem">${i.nama}</div><small class="text-muted">@Rp ${fmt(i.harga)}</small></td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="ubahJumlah(${i.id},-1)">-</button>
                    <span class="fw-bold">${i.jumlah}</span>
                    <button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="ubahJumlah(${i.id},1)">+</button>
                </div>
            </td>
            <td style="font-size:.85rem">Rp ${fmt(i.harga * i.jumlah)}</td>
            <td><button class="btn btn-sm btn-outline-danger py-0 px-1" onclick="hapusItem(${i.id})"><i class="bi bi-x"></i></button></td>
        </tr>`).join('');
    }
    document.getElementById('totalHarga').textContent = 'Rp ' + fmt(total);
    hitungKembalian();
}

function fmt(n) { return n.toLocaleString('id-ID'); }

function hitungKembalian() {
    const bayar = parseInt(document.getElementById('bayar').value) || 0;
    const kemb = bayar - total;
    const el = document.getElementById('kembalian');
    el.textContent = 'Rp ' + fmt(kemb < 0 ? 0 : kemb);
    el.className = kemb < 0 ? 'fw-bold text-danger small' : 'fw-bold text-success small';
}

function prosesTransaksi() {
    if (keranjang.length === 0) { alert('Keranjang masih kosong!'); return; }
    const bayar = parseInt(document.getElementById('bayar').value) || 0;
    if (bayar < total) { alert('Uang bayar kurang dari total!'); return; }
    document.getElementById('itemsInput').value = JSON.stringify(keranjang);
    document.getElementById('bayarInput').value = bayar;
    document.getElementById('formTransaksi').submit();
}

// Search produk
document.getElementById('searchProduk').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tableProduk tbody tr').forEach(tr => {
        tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
<?= $this->endSection() ?>
