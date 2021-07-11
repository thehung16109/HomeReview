<!-- Phượng -->
<!-- Author: Nguyen Thi Bich Phuong, 17520926 -->
<!-- Author: Phung The Hung, 18520808 -->

<!doctype html>
<html lang="en">

<head>
    <title>HomeStay Review</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{ csrf_token() }}" />

    <link rel="icon" href="server/images/2.ico" type="image/ico" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- wowJS -->
    <link rel="stylesheet" href="../client/Others/lib/WOW-master/css/libs/animate.css">

    <!-- Slick -->
    <link rel="stylesheet" href="../client/Others/lib/slick/slick-1.8.1/slick/slick.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>

    <!-- Main css -->
    <link rel="stylesheet" href="../client/CSS/home.css">
    <link rel="stylesheet" href="../client/CSS/homestay.css">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA=="
        crossorigin="anonymous" />

</head>

<body>
    <!-- Header -->
    @include('pages.header')

    <!-- Nội dung Search -->
    <div id="search-result p-0 " class="row m-0 mt-4 container" style="display:none">
    </div>

    <!--  Nội dung trang -->
    <div id="content">
        @yield('content')
    </div>
 
    <!--  Footer -->
    @include('pages.footer')


    <button onclick="topFunction()" id="myBtn"><i class="fa fa-arrow-up"></i></button>

    <!-- Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <!-- My js -->
    <script src="../client/JS/pages_layout.js"></script>

    <!-- Wowjs -->
    <script src="../client/Others/lib/WOW-master/wow/wow.min.js"></script>
    <script>
        wow = new WOW({
            boxClass: 'wow', // default

        })
        wow.init();
    </script>

    <!-- Slick -->
    <script src="../client/Others/lib/slick/slick-1.8.1/slick/slick.min.js"></script>
    <script>
        $(".slider-nav").slick({
            autoplay: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            prevArrow: '<i class="fa fa-angle-left left"></i>',
            nextArrow: '<i class="fa fa-angle-right right"></i>'
        });
    </script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0"
        nonce="hPPiJDos"></script>

    <!-- Ajax Tìm kiếm -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $('#search-input').on('keyup', function() {
            var $value = $(this).val();
            if ($value == '') {
                $('#search-result').html('');
                $('#search-result').hide();
                $('#content').show();
            } else {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    method: 'POST',
                    url: "{{ url('/search') }}",
                    data: JSON.stringify({
                        'search': $value,
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    success: function(data) {
                        // console.log(data);
                        // $('#content').html(data);
                        var result = '';
                        data = JSON.parse(data);
                        $('#search-result').show();
                        $('#content').hide();
                        for (let i = 0; i < data.length; i++) {
                            result += 
                            `<div class="col-md-4 col-lg-4 col-xl-4" style="text-align: center">
                                <a href={{ URL::to('/review/`+data[i].review_slug+`')}}>
                                    <img class="myimg" src="../uploads/ReviewImage/`+data[i].review_images.split('|')[0]+`">
                                                             </a>
                                <a class="titleimg mt-5" href="{{ URL::to('/review/`+data[i].review_slug+`')}}">`+data[i].review_title+`</a>
                            </div>`
                        }
                        $('#search-result').html(result);
                    }
                });
            }
        });

        $('#cancel').on('click', function() {
            $('#search-result').hide();
            $('#content').show();
            $('#search-result').html('');
        });
    </script>
</body>

</html>
<!-- End Phượng -->
