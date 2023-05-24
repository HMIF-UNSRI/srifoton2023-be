<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Admin</title>
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                <img style="height:75px; width:fit-content"
                                    src="{{ asset('images/dashboard/LOGO SRIFOTON 2023.png') }}">
                            </div>
                            <h3 class="text-center">Welcome Admin Srifoton</h3>
                            <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger mt-4 text-center" role="alert">
                                    {{ session('loginError') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('login') }}" class="pt-3">
                                @csrf

                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control form-control-lg @error('email')
                                        is-invalid
                                    @enderror"
                                        id="exampleInputEmail1" placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg @error('email')
                                    is-invalid
                                @enderror"
                                        id="exampleInputPassword1" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn w-100"
                                        href="../../index.html">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js"></script') }}"></script>
    <!-- endinject -->
</body>

</html>
