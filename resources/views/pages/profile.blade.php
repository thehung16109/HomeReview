@extends('pages_layout')
@section('content')
    <section>
        <div class="container p-0">
            <h1 class="mt-5" style="text-align:center; color:#f68a39">Hồ sơ của bạn</h1>
            <div class="row mt-5">

                <div class="col-md-6 col-lg-6 col-xl-6">
                    
                        <div class="row">
                            <input type="hidden" name="customer_id" class="customer_id" value={{ $profile->customer_id }}>
                            <input type="hidden" name="customer_id" class="customer_first_name"
                                value={{ $profile->customer_first_name }}>
                            <input type="hidden" name="customer_id" class="customer_last_name"
                                value={{ $profile->customer_last_name }}>
                            <input type="hidden" name="customer_id" class="customer_email"
                                value={{ $profile->customer_email }}>
                            <input type="hidden" name="customer_id" class="customer_password"
                                value={{ $profile->customer_password }}>
                            <div class="col-md-5 col-lg-5 col-xl-5" style="text-align: center">
                                    <img class="d-flex mr-3 rounded-circle profile-img"
                                        src="../uploads/CustomerAvatar/{{ $profile->customer_avatar }}"
                                        style="    width: 300px;
                                        height: 272px;">
                                <div class="mt-3">
                                    <form action="{{ URL::to('/change-customer-avatar/' . $profile->customer_id) }}" enctype="multipart/form-data"
                                        method="post">
                                        {{ csrf_field() }}
                                        <div style="text-align: center">
                                            <input type="file" class="form-control-file mt-2" name="customer_avatar"
                                                id="file" />
                                        </div>
                                        
                                            {{ csrf_field() }}
                                            <div id="load-button-commit">
                                                <button type="submit" class="submit btn-comment change-avatar mt-2" style="text-align:center">Xác nhận</button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-7 col-xl-7">
                                <form>
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                          </tr>
                                         
                                        </thead>
                                        <tbody >
                                          <tr>
                                            <th style="font-size:20px" scope="row">Tên:</th>
                                            <td style="font-size:20px" >{!! $profile->customer_last_name . ' ' . $profile->customer_first_name !!}</td>
                                          </tr>
                                          
                                          <tr>
                                            <th style="font-size:20px" scope="row">Email</th>
                                            <td style="font-size:20px" >{{ $profile->customer_email }}</td>
                                          </tr>
                                        </tbody>
                                      </table>
                            </form>
                                <form> 
                                <div style="text-align:center">
                                    @csrf
                                    <button type="submit" class="submit btn-update-profile edit-profile">Cập nhật thông
                                        tin</button>
                                </div>
                            </form>
                            </div>
                        </div>

                    <div class="row mt-3" id="show-edit-profile">
                        <form enctype="multipart/form-data">@csrf
                        </form>
                    </div>
                    <div class="row mt-3" id="show-update-status">
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 col-lg-12 col-xl-12 homestay-left ">
                            <div class="col-md-12 col-lg-12 col-xl-12" style="text-align:center">
                                <h2 class="mb-5" style="vertical-align: center;">Bình luận của bạn</h2>
                            </div>
                            @foreach ($commented as $key => $com)
                                <div class="row mb-4 wow bounceInLeft hs-item">
                                    <div class="col-md-5 col-lg-5 col-xl-5 left-img-profile review-liked-img">
                                        <a href="{{ URL::to('/review/' . $com->review->review_slug) }}">
                            
                                                <img class="myimg"
                                                    src="../uploads/ReviewImage/{{ explode('|', $com->review->review_images)[0] }}" height="20" width="20">
                             
                                        </a>
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-7">
                                        <a class="review-title"
                                            href="{{ URL::to('/review/' . $com->review->review_slug) }}">
                                            <h4>{{ $com->review->review_title }}</h4>
                                        </a>
                                        <p>{{ $com->comment_content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 review-liked">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12" style="text-align:center">
                            <h2 class="mb-5" style="vertical-align: center;">Bài viết bạn đã thích</h2>
                        </div>
                    </div>
                    @foreach ($review_liked as $key => $review)
                        <div class="row mb-4 wow bounceInLeft hs-item">
                            <div class="col-md-5 col-lg-5 col-xl-5 review-liked-img">
                                <a href="{{ URL::to('/review/' . $review->review_slug) }}">
                              
                                        <img class="myimg"
                                            src="../uploads/ReviewImage/{{ explode('|', $review->review_images)[0] }}"
                                            height="20px" width="20px">
                         
                                </a>
                            </div>
                            <div class="col-md-7 col-lg-7 col-xl-7">
                                <a class="review-title" href="{{ URL::to('/review/' . $review->review_slug) }}">
                                    <h4>{{ $review->review_title }}</h4>
                                </a>
                                <p>{{ $review->review_desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        var clicked = 0;
        $(document).ready(function() {

            load_profile();
            function load_edit_profile() {
                var click_status = clicked;
                var customer_last_name = $('.customer_last_name').val();
                var customer_first_name = $('.customer_first_name').val();
                var customer_email = $('.customer_email').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/edit-profile') }}",
                    method: "POST",
                    data: {
                        click_status: click_status,
                        customer_last_name: customer_last_name,
                        customer_first_name: customer_first_name,
                        customer_email: customer_email,
                        _token: _token
                    },
                    success: function(data) {
                        $('#show-edit-profile').html(data);
                    }
                });
                return false;
            }

            function load_profile() {
                var customer_id = $('.customer_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/load-profile') }}",
                    method: "POST",
                    data: {
                        customer_id: customer_id ,
                        _token: _token
                    },
                    success: function(data) {
                        $('#profile_show').html(data);
                    }
                });
                return false;
            }

            $('.edit-profile').click(function() {
                if (clicked == 0) {
                    clicked = 1;
                    load_edit_profile();
                    load_profile();
                } else {
                    clicked = 0;
                    load_edit_profile();
                    load_profile();
                }
                return false;
            });

        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $(document).on('click', '.update-profile', function() {
            var customer_id = $('.customer_id').val();
            var customer_last_name = $('.last-name-new').val();
            var customer_first_name = $('.first-name-new').val();
            var customer_email = $('.email-new').val();
            var customer_password = $('.pass-new').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/update-profile') }}",
                method: "POST",
                data: {
                    customer_id: customer_id,
                    customer_last_name: customer_last_name,
                    customer_first_name: customer_first_name,
                    customer_email: customer_email,
                    customer_password: customer_password,
                    _token: _token
                },
                success: function(data) {
                    $('#show-update-status').html(data);
                }
            });
            return false;
        });
    </script>

@endsection
