<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Turismo Bolivia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f4f6f9; display:flex; align-items:center; min-height:100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header text-center py-4" style="background:#1F4E79;">
                    <h4 class="text-white mb-0 fw-bold">
                        <i class="bi bi-map-fill me-2"></i>Turismo Bolivia
                    </h4>
                    <small class="text-white-50">Panel Administrativo</small>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-500">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-500">Contrasena</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold"
                                style="background:#1F4E79; border-color:#1F4E79;">
                            Ingresar
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-muted small">
                    ← Volver al sitio web
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>