<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wemis - Login</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <style>
        :root {
            --primary-color: #260950;
            --secondary-color: #4a1fb8;
            --accent-color: #6c4dda;
            --light-gray: #f8f9fa;
            --text-dark: #212529;
            --text-light: #6c757d;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-form-transparent {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem !important;
            max-width: 450px;
            width: 100%;
        }

        .brand-logo img {
            max-height: 60px;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(108, 77, 218, 0.2);
        }

        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            display: block;
        }

        .password-container {
            position: relative;
        }

        .password-container i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.2s;
        }

        .password-container i:hover {
            color: var(--primary-color);
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(38, 9, 80, 0.3);
        }

        .auth-link {
            color: var(--primary-color) !important;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .auth-link:hover {
            color: var(--accent-color) !important;
            text-decoration: underline;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            color: var(--text-light);
        }

        .login-half-bg {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            position: relative;
            overflow: hidden;
        }

        .login-half-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('../../images/auth-bg-pattern.png') center/cover no-repeat;
            opacity: 0.1;
        }

        .copyright {
            position: absolute;
            bottom: 20px;
            width: 100%;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        @media (max-width: 991.98px) {
            .login-half-bg {
                display: none;
            }

            .col-lg-6 {
                max-width: 100%;
                flex: 0 0 100%;
            }

            .auth-form-transparent {
                margin: 1rem;
                padding: 2rem !important;
            }
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .input-with-icon {
            padding-left: 45px !important;
        }

        .welcome-message h4 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .welcome-message h6 {
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .divider-text {
            padding: 0 1rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="d-flex align-items-stretch content-wrapper auth auth-img-bg">
                <div class="flex-grow row">
                    <div class="d-flex align-items-center justify-content-center col-lg-6">
                        <div class="p-3 text-left auth-form-transparent">
                            <div class="text-center brand-logo">
                                <img src="../../images/wemis.png" alt="Wemis Logo">
                            </div>
                            <div class="text-center welcome-message">
                                <h4>Welcome back!</h4>
                                <h6 class="font-weight-light">Happy to see you again!</h6>
                            </div>
                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="btn-close btn" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form class="pt-1" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <div class="position-relative">
                                        <i class="mdi-email-outline mdi input-icon"></i>
                                        <input id="email" type="email"
                                            class="form-control form-control-lg input-with-icon @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                                            placeholder="your@email.com">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="position-relative password-container">
                                        <i class="mdi-lock-outline mdi input-icon"></i>
                                        <input type="password" name="password"
                                            class="form-control form-control-lg input-with-icon" id="password"
                                            placeholder="••••••••">
                                        <i class="fa-solid fa-eye" id="togglePassword"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-3">
                                    <a href="#" class="auth-link">Forgot password?</a>
                                </div>
                                <div class="my-4">
                                    <button class="btn-block font-weight-medium text-white btn btn-sm btn-login"
                                        type="submit">
                                        LOGIN
                                    </button>
                                </div>
                                <!-- Uncomment if you want social login options
                                <div class="divider">
                                    <span class="divider-text">OR</span>
                                </div>
                                <div class="my-3 text-center">
                                    <button type="button" class="mr-2 btn-outline-secondary btn btn-icon-text">
                                        <i class="mdi mdi-google"></i> Google
                                    </button>
                                    <button type="button" class="btn-outline-secondary btn btn-icon-text">
                                        <i class="mdi mdi-microsoft"></i> Microsoft
                                    </button>
                                </div>
                                -->
                                {{-- <div class="mt-4 text-center">
                                    <span class="text-muted">Don't have an account?</span>
                                    <a href="#" class="ml-2 auth-link">Sign up</a>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                    <div class="d-flex flex-row col-lg-6 login-half-bg">
                        <div class="d-flex flex-column align-items-center justify-content-center w-100 text-center">
                            {{-- <h2 class="mb-4" style="font-weight: 600;color:#f06508">Wemis Management System</h2>
                            <p class="mb-5 text-white" style="max-width: 80%; opacity: 0.9;">
                                Streamline your workflow with our comprehensive management solution.
                            </p> --}}
                            {{-- <img src="../../images/auth-illustration.svg" alt="Auth Illustration"
                                style="max-width: 70%;"> --}}
                        </div>
                        <p class="font-weight-medium text-white text-center copyright">
                            Copyright &copy; 2025 All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // Toggle eye icon
            if (type === "password") {
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            } else {
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            }
        });


        document.querySelectorAll('.btn-close').forEach(button => {
            button.addEventListener('click', function () {
                const alert = button.closest('.alert');
                if (alert) {
                    alert.remove(); // This removes the alert from the DOM
                }
            });
        });

    </script>
</body>

</html>