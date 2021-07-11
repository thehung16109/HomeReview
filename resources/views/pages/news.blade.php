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
                            href="{{ URL::to('/author/' . $news->admin->admin_id) }}">{{ $news->admin->admin_last_name . ' ' . $news->admin->admin_first_name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-light"
                            style="font-weight:bolder">{{ $news->news_title }}</a></li>
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
                                @foreach (explode('|', $news->news_images) as $key => $news_image)
                                    <li data-target="#demo" data-slide-to={{ $key }}
                                        class={{ $key == 0 ? 'active' : '' }}></li>
                                @endforeach
                            </ul>
                            <div class="carousel-inner">
                                @foreach (explode('|', $news->news_images) as $key => $news_image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" id="news_content">
                             
                                            <img src="../uploads/NewsImage/{{ $news_image }}" height="200"
                                                width="500">
                     
                                    </div>
                                @endforeach
                                <div class="carousel-caption d-none d-md-block">
                                    <h1>{{ $news->news_title }}</h1>
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
                                    href="{{ URL::to('/author/' . $news->admin->admin_id) }}"><b>{{ $news->admin->admin_first_name }}
                                        &nbsp &nbsp </b></a></span>
                            <span>Vào ngày <b>{{ $news->created_at }}</b></span>
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
                            {!! $news->news_content !!}
                            <div class="post-tags mt-5">
                                <span><i class="fa fa-tags"></i>&nbsp;</span>
                                @foreach (explode(',', $news->tags) as $key => $tag)
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
                            <p class="title"><a href="{{ URL::to('/news/' . $news_prev->news_slug) }}" rel="prev"
                                    style="font-weight: bold;">{{ $news_prev->news_title }}&nbsp;</a></p>
                        </div>
                        <div class="next-post">
                            <p class="pre-title">Bài tiếp theo <i class="fa fa-arrow-right"></i></p>
                            <p class="title"><a href="{{ URL::to('/news/' . $news_prev->news_slug) }}" rel="next"
                                    style="font-weight: bold;">{{ $news_next->news_title }}</a></p>
                        </div>
                    </section>

                    
                </div>

                <!-- Tin tức gần đây -->
                <div class="col-md-4 col-lg-4 col-xl-4 homestay-right">
                    <h2 class="mb-5">Tin tức mới nhất</h2>
                    @foreach ($lastest_news as $key => $lastest)
                        <div class="ht-right-item">
                            <div class="row " style="padding: 0 16px;">
                                <a href="{{ URL::to('/news/' . $lastest->news_slug) }}">
              
                                        <img class="myimg"
                                            src="../uploads/NewsImage/{{ explode('|', $lastest->news_images)[0] }}">
                                 
                                </a>
                                <a class="news-title" href="{{ URL::to('/news/' . $lastest->news_slug) }}">
                                    <h4>{{ $lastest->news_title }}</h4>
                                </a>
                                <p>{{ $lastest->news_desc }}</p>
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
            load_like_status();
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
            var news_id = $('.comment_news_id').val();
            var customer_id = $('.customer_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/load-like-status-news') }}",
                method: "POST",
                data: {
                    news_id: news_id,
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
            var news_id = $('.comment_news_id').val();
            var customer_id = $('.customer_id').val(); 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/not-like-news-news') }}",
                method: "POST",
                data: {
                    news_id: news_id,
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
            var news_id = $('.comment_news_id').val();
            var customer_id = $('.customer_id').val(); 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/like-news-news') }}",
                method: "POST",
                data: {
                    news_id: news_id,
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
