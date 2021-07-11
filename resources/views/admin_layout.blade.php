<!-- Phượng -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>HomeStay Review</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />

    <link rel="icon" href="server/images/2.ico" type="image/ico" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link href="../server/Others/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap tags -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="../server/Others/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- NProgress -->
    <link href="../server/Others/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Dropzone.js -->
    <link href="../server/Others/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../server/CSS/custom.min.css" rel="stylesheet">
    <link href="../server/CSS/dashboard.css" rel="stylesheet">


</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="./index.html" class="site_title"><img src="../server/images/logo.png" alt=""></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="../uploads/AdminAvatar/<?php
                            $avatar = Session::get('admin_avatar');
                            if ($avatar) {
                                echo $avatar;
                            }
                            ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Xin chào,</span>
                            <h2><?php
                                $name = Session::get('admin_first_name');
                                if ($name) {
                                echo $name;
                                }
                                ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="{{ URL::to('/trang-chu') }}"><i class="fa fa-home"></i>Trang chủ </a>
                                </li>
                                <li><a href="{{ URL::to('/dashboard') }}"><i class="fa fa-flag" aria-hidden="true"></i> Tổng quan</a>
                                </li>
                                <li><a><i class="fas fa-user-cog"></i> Admin<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ URL::to('/add-admin') }}">Thêm admin</a></li>
                                        <li><a href="{{ URL::to('/all-admin') }}">Danh sách admin</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ URL::to('/all-customer') }}"><i class="fas fa-user"></i> Khách
                                        hàng</a>
                                </li>
                                <li><a><i class="fa fa-map-marker"></i>Địa điểm<span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ URL::to('/add-location') }}">Thêm địa điểm</a></li>
                                        <li><a href="{{ URL::to('/all-location') }}">Danh sách điạ điểm</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-list-alt"></i>Danh mục<span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ URL::to('/add-category') }}">Thêm danh mục</a></li>
                                        <li><a href="{{ URL::to('/all-category') }}">Danh sách danh mục</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i>Bài viết<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ URL::to('/add-review') }}">Thêm bài viết</a></li>
                                        <li><a href="{{ URL::to('/all-review') }}">Danh sách bài viết</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-newspaper-o"></i>Tin tức<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ URL::to('/add-news') }}">Thêm tin tức</a></li>
                                        <li><a href="{{ URL::to('/all-news') }}">Danh sách tin tức</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ URL::to('/all-comment') }}"><i class="fa fa-comment"></i> Bình luận</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Logout"
                            href="{{ URL::to('/logout-admin') }}">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="../uploads/AdminAvatar/<?php
                                    $avatar = Session::get('admin_avatar');
                                    if ($avatar) {
                                        echo $avatar;
                                    }
                                    ?>" alt="">
                                    <span>
                                        <?php
                                        $name = Session::get('admin_first_name');
                                        if ($name) {
                                        echo $name;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:;">Hồ sơ</a>
                                    <a class="dropdown-item" href="{{ URL::to('/logout-admin') }}"><i
                                            class="fa fa-sign-out pull-right"></i>Đăng xuất</a>
                                </div>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">1</span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="../server/images/1.jpg"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>Khu Ngai</span>
                                                <span class="time">3 phút trước</span>
                                            </span>
                                            <span class="message">
                                                Tôi rất thích Web này, mong các bạn sẽ phát triển thêm...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="text-center">
                                            <a class="dropdown-item">
                                                <strong>Xem tất cả thông báo</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <div class="right_col" role="main">
                @yield('admin_content')
            </div>


            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Review Homestay
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <!-- jQuery -->
    <script src="../server/Others/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="../server/Others/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FastClick -->
    <script src="../server/Others/vendors/fastclick/lib/fastclick.js"></script>

    <!-- NProgress -->
    <script src="../server/Others/vendors/nprogress/nprogress.js"></script>

    <!-- Dropzone.js -->
    <script src="../server/Others/vendors/dropzone/dist/min/dropzone.min.js"></script>

    <!--Bootstrap tags -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    {{-- <script href="../server/JS/bootstrap-tagsinput.min.js"></script> --}}
    <!-- Custom Theme Scripts -->
    <script src="../server/JS/custom.min.js"></script>

    <!-- Custom JS -->
    <script src="../server/JS/dashboard.js"></script>

    <!-- Ckeditor -->
    <script src="../server/Others/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('review_content');
        CKEDITOR.replace('news_content');
    </script>

    <!-- Ajax Tìm kiếm admin -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        $('body').on('keyup', '#search-admin', function() {
            var $value = $(this).val();
            if ($value == '') {
                $('#result-admin').html('');
                $('#result-admin').hide();
                $('#content-admin').show();
            } else {
                var _token = $('input[name="_token"]').val();
                console.log(_token);
                $.ajax({
                method: 'POST',
                url: "{{ url('/search-admin') }}",
                data: JSON.stringify({
                        'search': $value,
                    }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    // console.log(data);
                    $('#content-admin').hide();
                    $('#result-admin').show();
                    var result = '';
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        result +=`
                        <tr>
                            <td>
                                <label class="i-checks">
                                    <input type="checkbox" id="checkItem" value="`+data[i].admin_id+`"><i></i>
                                </label>
                            </td>
                            <td>`+(i+1)+`</td>
                            <td>`+data[i].admin_last_name+``+data[i].admin_first_name+`</td>
                            <td>`+data[i].admin_email+`</td>
                            <td>`+data[i].admin_phone+`</td>
                            <td>
                                <img src="../uploads/AdminAvatar/`+data[i].admin_avatar+`" height="100" width="100">
                            </td>
                            <td>
                                <a href="{{ URL::to('/edit-admin/`+data[i].admin_id+`') }}">
                                    <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                </a>
                                <a onclick="return confirm('Bạn chắc chắn muốn xóa tài khoản này?')" href="{{ URL::to('/delete-admin/`+data[i].admin_id+`') }}">
                                    <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                </a>
                            </td>
                        </tr>`;
                    }
                    $('#result-admin').html(result);
                }
            });

            }
        });
    </script>

    <!-- Ajax Tìm kiếm customer -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        $('body').on('keyup', '#search-customer', function() {
            var $value = $(this).val();
            if ($value == '') {
                $('#result-customer').html('');
                $('#result-customer').hide();
                $('#content-customer').show();
            } else {
                var _token = $('input[name="_token"]').val();
                console.log(_token);
                $.ajax({
                method: 'POST',
                url: "{{ url('/search-customer') }}",
                data: JSON.stringify({
                        'search': $value,
                    }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    // console.log(data);
                    $('#content-customer').hide();
                    $('#result-customer').show();
                    var result = '';
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        result +=`
                        <tr>
                            <td>
                                <label class="i-checks">
                                    <input type="checkbox" id="checkItem" value="`+data[i].customer_id+`"><i></i>
                                </label>
                            </td>
                            <td>`+(i+1)+`</td>
                            <td>`+data[i].customer_last_name+``+data[i].customer_first_name+`</td>
                            <td>`+data[i].customer_email+`</td>
                            <td>
                
                                <img src="../uploads/CustomerAvatar/`+data[i].customer_avatar+`" height="100" width="100">
                     
                            </td>
                            <td>
                                <a href="{{ URL::to('/edit-customer/`+data[i].customer_id+`') }}">
                                    <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                </a>
                                <a onclick="return confirm('Bạn chắc chắn muốn xóa tài khoản này?')" href="{{ URL::to('/delete-customer/`+data[i].customer_id+`') }}">
                                    <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                </a>
                            </td>
                        </tr>`;
                    }
                    $('#result-customer').html(result);
                }
            });

            }
        });
    </script>

    <!-- Ajax Tìm kiếm location -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        $('body').on('keyup', '#search-location', function() {
            var $value = $(this).val();
            if ($value == '') {
                $('#result-location').html('');
                $('#result-location').hide();
                $('#content-location').show();
            } else {
                var _token = $('input[name="_token"]').val();
                console.log(_token);
                $.ajax({
                method: 'POST',
                url: "{{ url('/search-location') }}",
                data: JSON.stringify({
                        'search': $value,
                    }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    // console.log(data);
                    $('#content-location').hide();
                    $('#result-location').show();
                    var result = '';
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        result +=`
                        <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>`+(i+1)+`</td>
                                    <td>`+data[i].location_name+`</td>
                                    <td>`+data[i].region_name+`</td>
                                    <td>
                                        <?php if (`+data[i].location_status+` == `1`) { ?>
                                            <a href="{{URL::to('/unactive-location/`+data[i].location_id+`')}}"><span class="fa-eye-style fa fa-eye"></span></a>
                                        <?php } else { ?>
                                        
                                        <a href="{{URL::to('/active-location/`+data[i].location_id+`')}}"><span class="fa-eye-slash-style fa fa-eye-slash"></span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-location/`+data[i].location_id+`')}}">
                                            <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa địa điểm này?')" href="{{URL::to('/delete-location/`+data[i].location_id+`')}}">
                                          <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                      </a>
                                    </td>
                                </tr>`;
                    }
                    $('#result-location').html(result);
                }
            });

            }
        });
    </script>
    <!-- Ajax Tìm kiếm category -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        $('body').on('keyup', '#search-category', function() {
            var $value = $(this).val();
            if ($value == '') {
                $('#result-category').html('');
                $('#result-category').hide();
                $('#content-category').show();
            } else {
                var _token = $('input[name="_token"]').val();
                console.log(_token);
                $.ajax({
                method: 'POST',
                url: "{{ url('/search-category') }}",
                data: JSON.stringify({
                        'search': $value,
                    }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    // console.log(data);
                    $('#content-category').hide();
                    $('#result-category').show();
                    var result = '';
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        result +=`
                        <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>`+(i+1)+`</td>
                                    <td>`+data[i].category_name+`</td>
                                    <td>
                                        <?php if (`+data[i].category_status+` == `1`) { ?>
                                        <a href="{{URL::to('/unactive-category/`+data[i].category_id+`')}}"><span class="fa-eye-style fa fa-eye"></span></a>
                                        <?php } else { ?>
                                        <a href="{{URL::to('/active-category/`+data[i].category_id+`')}}"><span class="fa-eye-slash-style fa fa-eye-slash"></span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-category/`+data[i].category_id+`')}}">
                                            <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa địa điểm này?')" href="{{URL::to('/delete-category/`+data[i].category_id+`')}}">
                                          <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                      </a>
                                    </td>
                                </tr>`;
                    }
                    $('#result-category').html(result);
                }
            });

            }
        });
    </script>

    <!-- Ajax Tìm kiếm bài viết -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        $('body').on('keyup', '#search-review', function() {
            var $value = $(this).val();
            if ($value == '') {
                $('#result-review').html('');
                $('#result-review').hide();
                $('#content-review').show();
            } else {
                var _token = $('input[name="_token"]').val();
                console.log(_token);
                $.ajax({
                method: 'POST',
                url: "{{ url('/search-review') }}",
                data: JSON.stringify({
                        'search': $value,
                    }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    // console.log(data);
                    $('#content-review').hide();
                    $('#result-review').show();
                    var result = '';
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        result +=`
                        <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>`+(i+1)+`</td>
                                    <td>`+data[i].review_title+`</td>
                                    <td><img src="../uploads/ReviewImage/`+data[i].review_images.split('|')[0]+`" height="100" width="100">
                                        <a class="show_images" href="{{URL::to('/show-review-images/`+data[i].review_slug+`')}}">Xem thêm...</a>
                                    </td>
                                    <td>`+data[i].review_slug+`</td>
                                    <td>`+data[i].review_desc+`</td>
                                    <td>`+data[i].tags+`</td>
                                    <td>`+data[i].category_name+`</td>
                                    <td>`+data[i].location_name+`</td>
                                    <td>`+data[i].admin_first_name+`</td>
                                    <td>`+data[i].view_count+`</td>
                                    <td>`+data[i].like_count+`</td>
                                    <td>`+data[i].comment_count+`</td>
                                    <td>
                                        <?php if (`+data[i].review_status.isEqual(0)+`) { ?>
                                        <a href="{{URL::to('/active-review/`+data[i].review_id+`')}}"><span class="fa-eye-slash-style fa fa-eye-slash"></span></a>
                                        <?php } else { ?>
                                        <a href="{{URL::to('/unactive-review/`+data[i].review_id+`')}}"><span class="fa-eye-style fa fa-eye"></span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-review/`+data[i].review_id+`')}}">
                                            <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa bài viết này?')" href="{{URL::to('/delete-review/`+data[i].review_id+`')}}">
                                          <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                      </a>
                                    </td>
                                </tr>`;
                    }
                    $('#result-review').html(result);
                }
            });

            }
        });
    </script>

    <!-- Ajax Tìm kiếm tin tức -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        $('body').on('keyup', '#search-news', function() {
            var $value = $(this).val();
            if ($value == '') {
                $('#result-news').html('');
                $('#result-news').hide();
                $('#content-news').show();
            } else {
                var _token = $('input[name="_token"]').val();
                console.log(_token);
                $.ajax({
                method: 'POST',
                url: "{{ url('/search-news') }}",
                data: JSON.stringify({
                        'search': $value,
                    }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    // console.log(data);
                    $('#content-news').hide();
                    $('#result-news').show();
                    var result = '';
                    data = JSON.parse(data);
                    for (let i = 0; i < data.length; i++) {
                        result +=`
                        <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>`+(i+1)+`</td>
                                    <td>`+data[i].news_title+`</td>
                                    <td><img src="../uploads/NewsImage/`+data[i].news_images.split('|')[0]+`" height="100" width="100">
                                        <a class="show_images" href="{{URL::to('/show-news-images/`+data[i].news_slug+`')}}">Xem thêm...</a>
                                    </td>
                                    <td>`+data[i].news_slug+`</td>
                                    <td>`+data[i].news_desc+`</td>
                                    <td>`+data[i].news_tags+`</td>
                                    <td>`+data[i].admin_first_name+`</td>
                                    <td>`+data[i].view_count+`</td>
                                    <td>`+data[i].like_count+`</td>
                                    <td>
                                        <?php if (`+data[i].news_status.isEqual(0)+`) { ?>
                                        <a href="{{URL::to('/active-news/`+data[i].news_id+`')}}"><span class="fa-eye-slash-style fa fa-eye-slash"></span></a>
                                        <?php } else { ?>
                                        <a href="{{URL::to('/unactive-news/`+data[i].news_id+`')}}"><span class="fa-eye-style fa fa-eye"></span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-news/`+data[i].news_id+`')}}">
                                            <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa bài viết này?')" href="{{URL::to('/delete-news/`+data[i].news_id+`')}}">
                                          <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                      </a>
                                    </td>
                                </tr>`;
                    }
                    $('#result-news').html(result);
                }
            });

            }
        });
    </script>
</body> 

</html>

<!-- End Phượng -->
