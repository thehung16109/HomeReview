@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Tổng quan</h3>
        <div class="x_panel">
            <div class="x_content">
                <div class="row mt-3">
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="card border-success mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-success">Tổng khách hàng</div>
                            <div class="card-body text-success">
                                <h1 class="card-title">{{ $number_customer }}</h1>
                            </div>
                            <div class="card-footer bg-transparent border-success" style="color:blue; font-weight:bold">
                                Khách hàng mới trong
                                ngày: <span>{{ $number_new_customer }}</span></div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="card border-success mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-success">Tổng bài viết</div>
                            <div class="card-body text-success">
                                <h1 class="card-title">{{ $number_review }}</h1>
                            </div>
                            <div class="card-footer bg-transparent border-success" style="color:blue; font-weight:bold">Bài
                                viết mới trong
                                ngày: <span>{{ $number_new_review }}</span></div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="card border-success mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-success">Tổng tin tức</div>
                            <div class="card-body text-success">
                                <h1 class="card-title">{{ $number_news }}</h1>
                            </div>
                            <div class="card-footer bg-transparent border-success" style="color:blue; font-weight:bold">Tin
                                tức mới trong
                                ngày: <span>{{ $number_new_news }}</span></div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="card border-success mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-success">Tổng bình luận</div>
                            <div class="card-body text-success">
                                <h1 class="card-title">{{ $number_comment }}</h1>
                            </div>
                            <div class="card-footer bg-transparent border-success" style="color:blue; font-weight:bold">Bình
                                luận mới trong
                                ngày: <span>{{ $number_new_comment }}</span></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="text-align: center">
                        <h1>Bình luận mới</h1>
                        @foreach($comment as $key => $com)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="media">
                                    @if ($com->customer->customer_avatar == "no_avatar35.png")
                                    <img class="d-flex mr-3 rounded-circle" src="../server/images/no_avatar35.png" height="50px" width="50px">
                                    @else 
                                    <img class="d-flex mr-3 rounded-circle" src="../uploads/CustomerAvatar/{{ $com->customer->customer_avatar }}" height="50px" width="50px">
                                    @endif
                                    <div class="media-body" style="text-align: left">
                                        <h6 class="mt-0">{!! $com->customer->customer_last_name . ' ' . $com->customer->customer_first_name !!}</h6>
                                        <p>{{$com->comment_content}}</p>
                                        <span style="font-weight: bold">{{$com->review->review_title}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="text-align: center">
                        <h1>Bài viết mới</h1>
                        @foreach($review as $key => $rev)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="media">
                                    <img src="../uploads/ReviewImage/{{ explode("|", $rev->review_images)[0]}}" width="100">
                                    <div class="media-body ml-2" style="text-align: left">
                                        <h6 class="mt-0" style="font-weight: bold">{{$rev->review_title}}</h6>
                                        <p>Đăng bởi: {!! $rev->admin->admin_last_name . ' ' . $rev->admin->admin_first_name !!}</p>
                                        <span style="font-weight: bold">Số lượt thích:</span>{{$rev->like_count}}
                                        <span style="font-weight: bold">Tổng lượt view:</span>{{$rev->view_count}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


