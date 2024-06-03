<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login CMS Sekolah</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons-wind.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div id="app">
        <section class="section">
            
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="m-3 p-4">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('img/stisla-fill.svg') }}" alt="logo" width="80"
                            class="shadow-light rounded-circle mb-5 mt-2">
                        </div>
                        
                        <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">CMS
                            Sekolah</span>
                        </h4>
                        @if ($errors->any())
                            @foreach ($errors->all() as $e)
                                <script type="text/javascript">
                                    Swal.fire({
                                        title: "Error",
                                        text: "{{ $e }}",
                                        icon: "error"
                                    });
                                </script>
                            @endforeach
                        @endif
                        <p class="text-muted">
                        </p>
                        <form method="POST" action="{{ url('/login') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input id="Username" type="text" class="form-control" name="username" tabindex="1"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your Username
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your Password
                                </div>
                            </div>


                            <div class="form-group text-right">
                                <a href="auth-forgot-password.html" class="float-left mt-3">
                                    Forgot Password?
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>

                        </form>

                        <div class="text-small mt-5 text-center">
                            Copyright &copy; Your Company. Made with 💙 by CMS Sekolah
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    {{-- data-background="{{ asset('img/unsplash/login-bg.jpg') }}"> --}} data-background="https://source.unsplash.com/100x300">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="display-4 font-weight-bold mb-2">
                                    @if ((int) date('H:i:s') < 12)
                                        Good Morning <span class="wi wi-day-sunny"></span>
                                    @elseif((int) date('H:i:s') < 17)
                                        Good Afternoon <span class="wi wi-day-haze"></span>
                                    @elseif((int) date('H:i:s') < 24 || date()->now() < 12)
                                        Good Evening <span class="wi wi-night-clear"></span>
                                    @endif
                                </h1>
                                <h5 class="font-weight-normal text-muted-transparent">Indonesia</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
