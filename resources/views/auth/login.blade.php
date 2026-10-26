<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TimeWise</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Auth Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}?v=3.9">
</head>
<body>

    <div class="container-fluid p-0 vh-100">
        <div class="row g-0 h-100">
            
            <!-- Left Branding Column -->
            <div class="col-lg-6 hero-panel d-none d-lg-flex flex-column justify-content-between p-5">
                
                <!-- Top Left Mini Logo -->
                <div>
                    <span class="mini-logo">Tw<span class="accent-dot">.</span></span>
                </div>

                <!-- Center Main Copy -->
                <div class="my-auto pe-lg-4">
                    <h1 class="brand-title text-uppercase mb-3">TimeWise</h1>
                    <p class="brand-tagline text-uppercase mb-0">
                        Less time managing,<br>more time becoming
                    </p>
                </div>

                <!-- Bottom Copyright Footer -->
                <div class="hero-footer">
                    &copy; {{ date('Y') }} TimeWise. All rights reserved.
                </div>

            </div>

            <!-- Right Login Form Panel -->
            <div class="col-lg-6 form-panel d-flex align-items-center justify-content-center p-4 p-sm-5">
                <div class="w-100" style="max-width: 420px;">
                    <div class="card border-0 auth-card">
                        <div class="card-body p-4 p-sm-5">
                            <h3 class="fw-bold mb-4 text-espresso">Login</h3>

                            <!-- Top-Aligned Exclamation Icon Error Box -->
                            @if($errors->any())
                                <div class="alert alert-danger mb-4 py-2 px-3 small rounded-3 d-flex align-items-start">
                                    <i class="bi bi-exclamation-circle-fill me-2 flex-shrink-0 mt-1"></i>
                                    <div class="w-100">
                                        @foreach($errors->all() as $error)
                                            <div class="py-1">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="login" class="form-label text-taupe fw-semibold small text-uppercase">Username / Email</label>
                                    <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}" required autofocus>
                                </div>
                                
                                <!-- Seamless Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label text-taupe fw-semibold small text-uppercase">Password</label>
                                    <div class="input-group-seamless">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <button class="btn-toggle-eye" type="button" onclick="togglePasswordVisibility('password', 'toggleIcon')">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label text-taupe small" for="remember">Remember me</label>
                                </div>

                                <button type="submit" class="btn btn-espresso w-100 py-2 fw-semibold text-uppercase">Sign In</button>
                            </form>

                            <div class="mt-4 text-center auth-footer-text small">
                                Need an account? <a href="{{ route('register') }}" class="auth-action-link">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Registration Success Pop-up Panel (Modal) -->
    @if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 auth-card p-2 text-center">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill display-4" style="color: var(--espresso);"></i>
                    </div>
                    <h4 class="fw-bold text-espresso mb-2">Account Created!</h4>
                    <p class="text-taupe mb-4 small fs-6">{{ session('success') }}</p>
                    <button type="button" class="btn btn-espresso w-100 py-2 text-uppercase fw-semibold" data-bs-dismiss="modal">Proceed to Login</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }

        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function () {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        @endif
    </script>
</body>
</html>