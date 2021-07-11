<!-- Phượng -->
@extends('pages_layout')
@section('content')
    {{-- Breadcrumb --}}
    <section>
        <div class="container px-0 mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-light" href="{{ URL::to('/trang-chu') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><a class="text-light tag-bread">Tag</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-light"
                            style="font-weight:bolder">{{ $tag }}</a></li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Slide --}}
    <section>
        <div id="demo" class="carousel slide mt-5 ml-5 mr-5 mb-5" data-ride="carousel" data-interval="1500">
            <ul class="carousel-indicators">
                @foreach ($review_most_like as $key => $most_like)
                    <li data-target="#demo" data-slide-to={{ $key }} class={{ $key == 0 ? 'active' : '' }}></li>
                @endforeach
            </ul>

            <div class="carousel-inner">
                @foreach ($review_most_like as $key => $most_like)
                    <a href="{{ URL::to('/review/' . $most_like->review_slug) }}">
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                   
                                <img src="../uploads/ReviewImage/{{ explode('|', $most_like->review_images)[0] }}"
                                    height="200" width="500">
                    
                            <div class="carousel-caption d-none d-md-block">
                                <a href="{{ URL::to('/review/' . $most_like->review_slug) }}"><h1>{{ $most_like->review_title }}</h1></a>
                            </div>
                        </div>
                    </a>
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

    <section class="homestay mt-5">
        <div class="container p-0">
            <h1 class="mt-5">{{ $tag }}</h1>
            <div class="row mt-5">
                <div class="col-md-8 col-lg-8 col-xl-8 homestay-left ">
                    @foreach ($all_review_tag as $key => $review_tag)
                        <div class="row mb-4 wow bounceInLeft hs-item">
                            <div class="col-md-5 col-lg-5 col-xl-5 left-img">
                                <a href="{{ URL::to('/review/' . $review_tag->review_slug) }}">
                           
                                        <img class="myimg"
                                            src="../uploads/ReviewImage/{{ explode('|', $review_tag->review_images)[0] }}">
                           
                                    <div class="homestay-overlay">
                                        <a class="location-tag"
                                            href="{{ URL::to('/location/' . $review_tag->location->location_slug) }}">
                                            <h6>{{ $review_tag->location->location_name }}</h6>
                                        </a>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-7 col-lg-7 col-xl-7">
                                {{-- <a href=""> --}}
                                    <a class="review-title"
                                        href="{{ URL::to('/review/' . $review_tag->review_slug) }}">
                                        <h4>{{ $review_tag->review_title }}</h4>
                                    </a>
                                {{-- </a> --}}
                                <p>{{ $review_tag->review_desc }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 homestay-right">
                    <h4 class="mb-5">Bài viết gần đây</h4>
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

@endsection

<!-- End Phượng -->
