@extends('pages_layout')
@section('content')
    {{-- Breadcrumb --}}
    <section>
        <div class="container px-0 mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-light" href="{{ URL::to('/trang-chu') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a class="text-light"
                            href="{{ URL::to('/category/' . $review->category->category_slug) }}">{{ $review->category->category_name }}</a>
                    </li>
                    <li class="breadcrumb-item"><a class="text-light"
                            href="{{ URL::to('/region/' . $region_slug) }}">{{ $region_name }}</a>
                    </li>
                    <li class="breadcrumb-item"><a class="text-light"
                            href="{{ URL::to('/location/' . $review->location->location_slug) }}">{{ $review->location->location_name }}</a>
                    </li>
                    <li class="breadcrumb-item"><a class="text-light"
                            href="{{ URL::to('/author/' . $review->admin->admin_id) }}">{{ $review->admin->admin_last_name . ' ' . $review->admin->admin_first_name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-light"
                            style="font-weight:bolder">{{ $review->review_title }}</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section id="main mx-0 ">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-xl-8 mx-auto mt-3">
                    <article id="post-1">
                        <div id="demo" class="carousel slide" data-ride="carousel" data-interval="1500">
                            <ul class="carousel-indicators">
                                @foreach (explode('|', $review->review_images) as $key => $review_image)
                                    <li data-target="#demo" data-slide-to={{ $key }}
                                        class={{ $key == 0 ? 'active' : '' }}></li>
                                @endforeach
                            </ul>
                            <div class="carousel-inner">
                                @foreach (explode('|', $review->review_images) as $key => $review_image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" id="review_content">
                                 
                                            <img src="../uploads/ReviewImage/{{ $review_image }}" height="200"
                                                width="500">
                                  
                                    </div>
                                @endforeach
                                <div class="carousel-caption d-none d-md-block">
                                    <h1>{{ $review->review_title }}</h1>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>

                        <div class="author_date mt-4">
                            <span>Đăng bởi <a
                                    href="{{ URL::to('/author/' . $review->admin->admin_id) }}"><b>{{ $review->admin->admin_first_name }}
                                        &nbsp &nbsp </b></a></span>
                            <span>Vào ngày <b>{{ $review->created_at }}</b></span>
                        </div>

                        <div class="share mt-5">
                            <a class="btn-share"><i class="fa fa-share-alt" aria-hidden="true">&nbsp</i><span
                                    class="sr-only">(current)</span><b class="text">Chia sẻ bài viết</b></a>
                            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                                data-layout="button" data-size="small"><a target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                    class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                        </div>

                        <!-- Phần nội dung bài post -->
                        <div class="content mt-4">
                            {!! $review->review_content !!}
                            <div class="post-tags mt-5">
                                <span><i class="fa fa-tags"></i>&nbsp;</span>
                                @foreach (explode(',', $review->tags) as $key => $tag)
                                    <a href="{{ URL::to('/tag/' . $tag) }}"" rel=" tag">{{ $tag }}</a>
                                    <span> | </span>
                                @endforeach
                            </div>

                            <!-- Phần share vs like -->
                            <form>
                                @csrf
                            <div class="mt-5 like">
                            </div>
                            <div id="notify_like"></div>
                        </form>
                            <div class="share mt-3">
                                <a class="btn-share"><i class="fa fa-share-alt" aria-hidden="true">&nbsp</i><span
                                        class="sr-only">(current)</span><b class="text">Chia sẻ bài viết</b></a>
                                <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                                    data-layout="button" data-size="small">
                                    <a target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                        class="fb-xfbml-parse-ignore">Chia sẻ</a>
                                </div>                                     
                            </div>
                        </div>

                    <!-- Next and Prev post -->
                    <section class="next-prev-post">
                        <div class="prev-post">
                            <p class="pre-title"><i class="fa fa-arrow-left"></i> Bài tiếp theo</p>
                            <p class="title"><a href="{{ URL::to('/review/' . $review_prev->review_slug) }}" rel="prev"
                                    style="font-weight: bold;">{{ $review_prev->review_title }}&nbsp;</a></p>
                        </div>
                        <div class="next-post">
                            <p class="pre-title">Bài tiếp theo <i class="fa fa-arrow-right"></i></p>
                            <p class="title"><a href="{{ URL::to('/review/' . $review_prev->review_slug) }}" rel="next"
                                    style="font-weight: bold;">{{ $review_next->review_title }}</a></p>
                        </div>
                    </section>

                    <!-- Comment -->
                    <section class="comment">
                        
                        <div class="card">
                            <h5 class="card-header">Bình luận</h5>
                            <div class="card-body">
                                <form>
                                    <input type="hidden" name="customer_id" class="customer_id" 
                                    value=<?php
                                    echo Session::get('customer_id');?>>
                                    <div class="form-group"><textarea id="comment_content" name="comment_content" class="form-control"
                                            rows="3"></textarea></div>
                                    <button class="submit btn-comment send-comment" type="submit">Đăng bình
                                        luận</button>
                                    <div id="notify_comment">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form>
                            @csrf
                            <input type="hidden" name="comment_review_id" class="comment_review_id"
                                    value="{{ $review->review_id }}">
                            <div id="comment_show">
                                
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Bài viết gần đây -->
                <div class="col-md-4 col-lg-4 col-xl-4 homestay-right">
                    <h2 class="mb-5">Bài viết gần đây</h2>
                    @foreach ($lastest_review as $key => $lastest)
                        <div class="ht-right-item">
                            <div class="row " style="padding: 0 16px;">
                                <a href="{{ URL::to('/review/' . $lastest->review_slug) }}">
                             
                                        <img class="myimg"
                                            src="../uploads/ReviewImage/{{ explode('|', $lastest->review_images)[0] }}">
                         
                                </a>
                                <a class="review-title" href="{{ URL::to('/review/' . $lastest->review_slug) }}">
                                    <h4>{{ $lastest->review_title }}</h4>
                                </a>
                                <p>{{ $lastest->review_desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- Sử dụng Ajax  --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });

        $(document).ready(function() {
            load_comment();
            load_like_status();

            function load_comment() {
                var review_id = $('.comment_review_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/load-comment') }}",
                    method: "POST",
                    data: {
                        review_id: review_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
                return false;
            }

            $('.send-comment').click(function() {
                var review_id = $('.comment_review_id').val();
                var comment_content = $('#comment_content').val();
                var customer_id = $('.customer_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/send-comment') }}",
                    method: "POST",
                    data: {
                        review_id: review_id,
                        comment_content: comment_content,
                        customer_id: customer_id,
                        _token: _token
                    },
                    success: function(data) {
                        load_comment();
                        $('#notify_comment').html(data);
                    }
                });
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

        load_like_status();

        function load_like_status() {
            var review_id = $('.comment_review_id').val();
            var customer_id = $('.customer_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/load-like-status') }}",
                method: "POST",
                data: {
                    review_id: review_id,
                    customer_id: customer_id,
                    _token: _token
                },
                success: function(data) {
                    $('.like').html(data);
                }
            });
            return false;
        }  

        $(document).on('click', '#send-not-like', function(){
            var review_id = $('.comment_review_id').val();
            var customer_id = $('.customer_id').val(); 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/not-like-review') }}",
                method: "POST",
                data: {
                    review_id: review_id,
                    customer_id: customer_id,
                    _token: _token
                },
                success: function(data) {
                    load_like_status();
                    $('#notify_like').html(data);
                }
            });
            return false;
        });

        $(document).on('click', '#send-like', function(){
            var review_id = $('.comment_review_id').val();
            var customer_id = $('.customer_id').val(); 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/like-review') }}",
                method: "POST",
                data: {
                    review_id: review_id,
                    customer_id: customer_id,
                    _token: _token
                },
                success: function(data) {
                    load_like_status();
                    $('#notify_like').html(data);
                }
            });
            return false;
        });
    </script>
    {{-- End Sử dụng Ajax  --}}

@endsection
