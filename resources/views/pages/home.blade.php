<!-- Phượng -->
@extends('pages_layout')
@section('content')

    <section>
        <div id="demo" class="carousel slide mt-5 ml-5 mr-5 mb-5" data-ride="carousel" data-interval="1500">
            <ul class="carousel-indicators">
                @foreach ($lastest_review as $key => $lastest_rev)
                    <li data-target="#demo" data-slide-to={{ $key }} class={{ $key == 0 ? 'active' : '' }}></li>
                @endforeach
            </ul>

            <div class="carousel-inner container px-0">
                @foreach ($lastest_review as $key => $lastest_rev)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <a href="{{ URL::to('/review/' . $lastest_rev->review_slug) }}">
                            <img src="../uploads/ReviewImage/{{ explode('|', $lastest_rev->review_images)[0] }}"
                                    height="200" width="500"/>
                        </a>
                        <div class="carousel-caption">
                            <a style="color: black" href="{{ URL::to('/review/' . $lastest_rev->review_slug) }}">
                                <h1>{{ $lastest_rev->review_title }}</h1>
                            </a>
                        </div>
                        
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </section>

    <section class="list-most-view-post pt-4 body_style">
        <div class="container px-0">
            <div class="tag-heading">
                <a href="">NHIỀU NGƯỜI QUAN TÂM</a>
            </div>
            <div class="row mt-3">
                @foreach ($mostview_review_1 as $key => $mostview1)
                    <div class="col-md-4 col-lg-4 col-xl-4 wow bounceInLeft" style="text-align: center">
                        <a href="{{ URL::to('/review/' . $mostview1->review_slug) }}">
                                <img class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostview1->review_images)[0] }}">
                        </a>
                        <a class="titleimg mt-5"
                            href="{{ URL::to('/review/' . $mostview1->review_slug) }}">{{ $mostview1->review_title }}</a>
                    </div>
                @endforeach
            </div>
            <div class="row mt-2">
                @foreach ($mostview_review_2 as $key => $mostview2)
                    <div class="col-md-4 col-lg-4 col-xl-4 wow bounceInRight" style="text-align: center">
                        <a href="{{ URL::to('/review/' . $mostview2->review_slug) }}">
             
                                <img class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostview2->review_images)[0] }}">
                        </a>
                        <a class="titleimg mt-5"
                            href="{{ URL::to('/review/' . $mostview2->review_slug) }}">{{ $mostview2->review_title }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="list-popular-post mt-5">
        <div class="container">
            <div class="tag-heading">
                <a href="">BÀI VIẾT ĐANG NỔI</a>
            </div>

            <div class="row mt-3">
                <div class="col-md-3 col-lg-3 col-xl-3 wow bounceInLeft" style="text-align: center">
                    <div class="row">
                        <a href="{{ URL::to('/review/' . $mostlike_review[2]->review_slug) }}">
                     
                                <img class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostlike_review[2]->review_images)[0] }}">
     
                        </a>
                        <a class="titleimg mt-1"
                            href="{{ URL::to('/review/' . $mostlike_review[2]->review_slug) }}">{{ $mostlike_review[2]->review_title }}</a>
                    </div>
                    <div class="row mt-2">
                        <a href="{{ URL::to('/review/' . $mostlike_review[3]->review_slug) }}">
                   
                                <img class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostlike_review[3]->review_images)[0] }}">
                   
                        </a>
                        <a class="titleimg mt-1"
                            href="{{ URL::to('/review/' . $mostlike_review[3]->review_slug) }}">{{ $mostlike_review[3]->review_title }}</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 wow bounceInDown">
                    <div class="row" style="text-align: center; vertical-align:center; ">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                        <a href="{{ URL::to('/review/' . $mostlike_review[2]->review_slug) }}">
                           
                                <img height="50%" class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostlike_review[0]->review_images)[0] }}">
   
                        </a>
                        <a class="titleimg"
                            href="{{ URL::to('/review/' . $mostlike_review[0]->review_slug) }}">{{ $mostlike_review[0]->review_title }}</a>
                    </div>
                    </div>
                    <div class="row" style="text-align: center; vertical-align:center;margin-top:39px">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                        <a href="{{ URL::to('/review/' . $mostlike_review[1]->review_slug) }}">
                                <img height="100%" class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostlike_review[1]->review_images)[0] }}">
                        </a>
                        <a class="titleimg"
                            href="{{ URL::to('/review/' . $mostlike_review[1]->review_slug) }}">{{ $mostlike_review[1]->review_title }}</a>
                    </div>
                    </div>

                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 bounceInRight" style="text-align: center">
                    <div class="row">
                        <a href="{{ URL::to('/review/' . $mostlike_review[4]->review_slug) }}">
                                <img class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostlike_review[4]->review_images)[0] }}">
                        </a>
                        <a class="titleimg mt-1"
                            href="{{ URL::to('/review/' . $mostlike_review[4]->review_slug) }}">{{ $mostlike_review[4]->review_title }}</a>
                    </div>
                    <div class="row mt-2">
                        <a href="{{ URL::to('/review/' . $mostlike_review[5]->review_slug) }}">
                                <img class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $mostlike_review[5]->review_images)[0] }}">
                        </a>
                        <a class="titleimg mt-1"
                            href="{{ URL::to('/review/' . $mostlike_review[5]->review_slug) }}">{{ $mostlike_review[5]->review_title }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="list-lastest-post mt-5">
        <div class="container px-0">
            <div class="tag-heading">
                <a href="">TIN TỨC MỚI NHẤT</a>
            </div>
            <div class="row mt-3 bounceInRight">
                @foreach ($lastest_news_1 as $key => $lastest1)
                    <div class="col-md-4 col-lg-4 col-xl-4" style="text-align: center">
                        <a href="{{ URL::to('/news/' . $lastest1->news_slug) }}">
             
                            <img class="myimg"
                                src="../uploads/NewsImage/{{ explode('|', $lastest1->news_images)[0] }}">
                    </a>
                        {{-- <a href="">
                                <img class="myimg"
                                    src="../uploads/ReviewImage/{{ explode('|', $lastest1->review_images)[0] }}"/>
                        </a> --}}
                        <a class="titleimg mt-5" href="">{{ $lastest1->news_title }}</a>
                    </div>
                @endforeach
            </div>
            <div class="row mt-2 bounceInRight">
                @foreach ($lastest_news_2 as $key => $lastest2)
                    <div class="col-md-4 col-lg-4 col-xl-4" style="text-align: center">
                        <a href="{{ URL::to('/news/' . $lastest2->news_slug) }}">
                                <img class="myimg"
                                    src="../uploads/NewsImage/{{ explode('|', $lastest2->news_images)[0] }}">
                        </a>
                        <a class="titleimg mt-5" href="">{{ $lastest2->news_title }}</a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection

<!-- End Phượng -->
