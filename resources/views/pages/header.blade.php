<section class="header">
    <div class="container mt-4 px-0">
        <img src="/client/images/logo.png" alt="">
    </div>

    <div class="container mt-4 p-0">
        <nav class="navbar navbar-expand-lg container navbar-header p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars"></i>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ URL::to('/trang-chu') }}" style="color:black;">Trang chủ
                            <span class="sr-only">(current)</span></a>
                    </li>
                    @foreach ($all_category as $key => $category)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ URL::to('/category/' . $category->category_slug) }}">{{ $category->category_name }}<span
                                    class="sr-only">(current)</span></a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/news/') }}">Tin tức<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($all_location as $key => $location)
                                <a class="dropdown-item"
                                    href="{{ URL::to('/location/' . $location->location_slug) }}">{{ $location->location_name }}</a>

                            @endforeach
                        </div>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Địa điểm
                        </a>

                    </li>

                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <div class="search-box">
                                <input id="search-input" type="text" placeholder="Nhập từ cần tìm...">
                                <div id="search" class="search-btn">
                                    <a class="nav-link"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                                <div id="cancel" class="cancel-btn">
                                    <a class="nav-link"><i class="fas fa-times" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
                        @if (Session::get('customer_id'))
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <img src="../<?php
                                    $avatar_cust = Session::get('customer_avatar');
                                    if ($avatar_cust) {
                
                                            echo 'uploads/CustomerAvatar/';
                                            echo $avatar_cust;
                                    } else {
                                        echo 'server/images/no_login.jpg';
                                    }
                                    ?>">
                                    <span style="font-weight:bold; color:black">Xin chào,
                                        <?php
                                        $name_cust = Session::get('customer_first_name');
                                        $cust_id = Session::get('customer_id');
                                        if ($name_cust) {
                                        echo $name_cust;
                                        } else {
                                        echo 'Đăng nhập';
                                        }
                                        ?>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ URL::to('/profile/' . $cust_id) }}">Hồ sơ</a>
                                    <a class="dropdown-item" href="{{ URL::to('/logout') }}"><i
                                            class="fa fa-sign-out pull-right"></i>Đăng xuất</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="user-profile" href="{{ URL::to('/login') }}"><img
                                        src="../server/images/no_login.jpg"></a>
                                <a class="button-login" href="{{ URL::to('/login') }}" role="button">Đăng nhập</a>
                            </li>
                        @endif
                    </ul>
                </form>
            </div>
        </nav>
    </div>
</section>


