<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $title ?? 'POS App' ?> - Aplikasi POS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
body { background: #f0f2f5; }
.sidebar { width: 240px; min-height: 100vh; background: #1e3a5f; position: fixed; left: 0; top: 0; z-index: 100; }
.sidebar .brand { padding: 20px 16px; border-bottom: 1px solid #2d5288; }
.sidebar .brand h5 { color: #fff; font-weight: 700; margin: 0; font-size: 1.1rem; }
.sidebar .brand small { color: #8ab4e8; font-size: .75rem; }
.sidebar .nav-link { color: #c5d8f0; padding: 10px 16px; border-radius: 6px; margin: 2px 8px; font-size: .9rem; text-decoration: none; display: block; }
.sidebar .nav-link:hover, .sidebar .nav-link.active { background: #2d5288; color: #fff; }
.sidebar .nav-link i { margin-right: 8px; }
.sidebar .nav-section { color: #5a82b4; font-size: .7rem; text-transform: uppercase; letter-spacing: 1px; padding: 12px 24px 4px; font-weight: 600; }
.main-content { margin-left: 240px; padding: 24px; }
.topbar { background: #fff; border-radius: 10px; padding: 12px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 4px rgba(0,0,0,.06); }
.topbar h6 { margin: 0; font-weight: 600; color: #1e3a5f; }
.card { border: none; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,.06); }
.card-header { background: #fff; border-bottom: 1px solid #eef0f4; border-radius: 12px 12px 0 0 !important; font-weight: 600; color: #1e3a5f; }
.btn-primary { background: #1e3a5f; border-color: #1e3a5f; }
.btn-primary:hover { background: #2d5288; border-color: #2d5288; }
.table th { font-weight: 600; font-size: .82rem; color: #6b7280; text-transform: uppercase; letter-spacing: .5px; background: #f8f9fb; }
</style>
</head>
<body>
<div class="sidebar">
    <div class="brand">
        <h5><i class="bi bi-shop me-2"></i>POS App</h5>
        <small>Point of Sale CI4</small>
    </div>
    <nav class="mt-2">
        <div class="nav-section">Menu Utama</div>
        <a href="/dashboard" class="nav-link <?= (uri_string() == 'dashboard') ? 'active' : '' ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="/transaksi" class="nav-link <?= (str_starts_with(uri_string(), 'transaksi')) ? 'active' : '' ?>"><i class="bi bi-cart3"></i> Transaksi</a>
        <?php if(session()->get('role') == 'admin'): ?>
        <div class="nav-section">Manajemen</div>
        <a href="/produk" class="nav-link <?= (str_starts_with(uri_string(), 'produk')) ? 'active' : '' ?>"><i class="bi bi-box-seam"></i> Produk</a>
        <a href="/kategori" class="nav-link <?= (str_starts_with(uri_string(), 'kategori')) ? 'active' : '' ?>"><i class="bi bi-tags"></i> Kategori</a>
        <a href="/laporan" class="nav-link <?= (str_starts_with(uri_string(), 'laporan')) ? 'active' : '' ?>"><i class="bi bi-bar-chart-line"></i> Laporan</a>
        <?php endif; ?>
        <div class="nav-section">Akun</div>
        <a href="/transaksi/riwayat" class="nav-link"><i class="bi bi-clock-history"></i> Riwayat</a>
        <a href="/logout" class="nav-link" onclick="return confirm('Yakin logout?')"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </nav>
</div>
<div class="main-content">
    <div class="topbar">
        <h6><i class="bi bi-chevron-right me-1"></i><?= $title ?? '' ?></h6>
        <div class="d-flex align-items-center gap-2">
            <span class="badge px-3 py-2" style="background:<?= session()->get('role') == 'admin' ? '#dbeafe;color:#1e40af' : '#d1fae5;color:#065f46' ?>">
                <?= ucfirst(session()->get('role')) ?>
            </span>
            <small class="text-muted"><?= session()->get('nama') ?></small>
        </div>
    </div>
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show"><i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
