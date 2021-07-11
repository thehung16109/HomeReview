<!-- Phượng -->
<!DOCTYPE html>

<head>
    <title>Customer Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- bootstrap-css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="server/CSS/style.css" rel='stylesheet' type='text/css' />
    <link href="server/CSS/style-responsive.css" rel="stylesheet" />

    {{-- <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> --}}
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA=="
        crossorigin="anonymous" />
    <!-- //font-awesome icons -->
    {{-- <script src="js/jquery2.0.3.min.js"></script> --}}
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <div style="text-align: center">
                <img style="background-color: white;
            display: block;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            border-radius: 20px" src="{{ asset('client/images/logo.png') }}" alt="">
            </div>
            <div class="mt-5" style="text-align: center">
                <h1 style="color:#f68a39; font-weight:bold !important">KHÁCH HÀNG ĐĂNG NHẬP</h1>
            </div>
            <div class="mt-2" style="text-align: center">
                <?php
                $message = Session::get('message');
                if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
                }
                ?>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                    @php
                        Session::forget('fail');
                    @endphp
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="text-align: center">
                <form action="{{ URL::to('/pagehome') }}" method="post">
                    {{ csrf_field() }}
                    @foreach ($errors->all() as $val)
                        <ul>
                            <li>{{ $val }}</li>
                        </ul>
                    @endforeach
                    <input type="text" class="ggg" name="customer_email" placeholder="Email" required>
                    <input type="password" class="ggg" name="customer_password" placeholder="Password" required>


                    <span style="font-size:15px"><input style="margin-left: 0" type="checkbox" />Nhớ đăng nhập</span>

                    <h6><a href="{{ URL::to('sendemail') }}">Quên mật khẩu</a></h6>


                    <div class="clearfix"></div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex row justify-content-between">
                            <div class="col-md-6 col-lg-6 col-xl-6 mt-5">
                                <input style="margin:auto" type="submit" value="Đăng nhập" name="login">
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 mt-5">
                                <a href="{{ URL::to('dangky') }}" class="btn dangky" style="margin:auto">Đăng ký</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    {{-- <script src="{{asset('/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script> --}}
    {{-- <script src="{{asset('/backend/js/scripts.js')}}"></script>
<script src="{{asset('/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('/backend/js/jquery.nicescroll.js')}}"></script> --}}
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    {{-- <script src="{{asset('/backend/js/jquery.scrollTo.js')}}"></script> --}}
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
</body>

</html>

<!-- End Phượng -->
