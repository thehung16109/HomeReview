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
            <h1 style="color:#f68a39; font-weight:bold !important; text-align: center">KHÁCH HÀNG ĐĂNG KÝ</h1>
            <?php
            $message = Session::get('message');
            if ($message) {
            echo '<span class="text-alert">' . $message . '</span>';
            Session::put('message', null);
            }
            ?>
            <form action="{{route('dangky')}}" method="post" enctype="multipart/form-data">
                {{-- @csrf --}}
                {{ csrf_field() }}
                @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                                @endif
                                @if (Session::has('fail'))
                                <div class="alert alert-danger">
                                    {{Session::get('fail')}}
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
                                <div class="form-group registerform">
                                    <label class="label" for="exampleInputEmail1">Họ</label>
                                    <input name="customer_last_name" type="text" class="form-control input-register"  placeholder="Nhập họ người dùng">
                                  </div>    
                                  <div class="form-group">
                                    <label class="label" for="exampleInputEmail1">Tên</label>
                                    <input  name="customer_first_name" type="text" class="form-control input-register"  placeholder="Nhập họ người dùng">
                                  </div>             
                                <div class="form-group">
                                <label class="label" for="exampleInputEmail1">Email address</label>
                                <input name="customer_email" type="email" class="form-control input-register" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                <label class="label" for="exampleInputPassword1">Password</label>
                                <input name="customer_password" type="text" class="form-control input-register" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div  class="form-group">
                                    <label class="label" for="exampleInputPassword1">Nhập lại Password</label>
                                    <input name="customer_passwordAgain" type="text" class="form-control input-register" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                {{-- <div class="form-group form-check">
                                </div> --}}
                                <div class="form-group">
                                    <label class="label">Hình đại điện</label>
                                    <input style="margin:auto; text-align:center" type="file" class="form-control-file" name="customer_avatar"/>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary dangky">Đăng Ký</button>
                                <a href="{{URL::to('login')}}" class="btn btn-success dangky">Đăng nhập</a>
                                </div>
                                
                            </form>

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


