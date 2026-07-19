<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Aplikasi POS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
body { background: linear-gradient(135deg, #1e3a5f 0%, #2d5288 100%); min-height: 100vh; display: flex; align-items: center; }
.login-card { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.3); overflow: hidden; }
.login-header { background: #1e3a5f; color: #fff; padding: 32px; text-align: center; }
.form-control:focus { border-color: #1e3a5f; box-shadow: 0 0 0 3px rgba(30,58,95,.15); }
</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <div class="login-header">
                    <div style="font-size:3rem"><i class="bi bi-shop"></i></div>
                    <h4 class="fw-bold mb-1">POS Application</h4>
                    <p class="mb-0 opacity-75" style="font-size:.9rem">Point of Sale berbasis CI4</p>
                </div>
                <div class="card-body p-4">
                    <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger py-2">
                        <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                    </div>
                    <?php endif; ?>
                    <form action="/login" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background:#1e3a5f;border-color:#1e3a5f">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <small class="text-muted">Default password: <code>password</code></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
