<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>M-Tech Application</title>
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="images/favicon.ico" /> --}}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
</head>

<body>

    <!-- Sign in Start -->
    <section class="sign-in-page bg-white">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 align-self-center">
                    <div class="sign-in-from">
                        <h1 class="mb-0">Sign in</h1>
                        <p>Enter your email address and password to access admin panel.</p>
                        <form class="mt-4" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <a href="#" class="float-right">Forgot password?</a>
                                <input type="password" name="password" class="form-control mb-0"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="d-inline-block w-100">
                                <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Sign in</button>
                            </div>
                            {{-- <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">Don't have an account? <a href="#">Sign up</a></span>
                                    <ul class="iq-social-media">
                                        <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div> --}}
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="sign-in-detail text-white"
                        style="background: url(images/login/2.jpg) no-repeat 0 0; background-size: cover;width:100%;height:100%">
                        {{-- <a class="sign-in-logo mb-5" href="#"><img src="images/logo-white.png" class="img-fluid" alt="logo"></a> --}}
                        <a href="#" class="text-white">
                            <h1 class="text-white">M-Tech</h1>
                        </a>
                        {{-- <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0"> --}}
                        <div class="item">
                            <img src="{{ asset('images/m-tech-logo.png') }}" class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content.
                            </p>
                        </div>

                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sign in END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    @if (Session::get('errors'))
        <div class="alert alert-alert">
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Please provide a valid credential",
                })
            </script>
        </div>
    @endif

</body>

</html>
