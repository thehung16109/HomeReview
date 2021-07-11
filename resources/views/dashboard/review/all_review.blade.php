<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Bài viết</h3>
        <div class="x_panel">
            <div class="x_content">
                <span class="section">Danh sách bài viết</span>
                <div class="row">
                    <div class="col-sm-5">
                        <form class="form-inline">
                            <button type="submit" class="btn btn-sm btn-primary ml-2 mt-1">Xóa những dòng được chọn</button>
                        </form>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="input-group col-sm-3">
                        <input id="search-review" type="text" class="form-control form-control-sm" placeholder="Tìm kiếm...">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3 mb-3">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                    echo '<span style="color:red; font-weight: bold;">' . $message . '</span>';
                    Session::put('message', null);
                    }
                    ?>
                </div>
                <div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:30px;">
                                    <label class="i-checks">
                                        <input type="checkbox" id="checkAll"><i></i>
                                    </label>
                                </th>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Ảnh</th>
                                <th>Slug</th>
                                <th>Mô tả ngắn</th>
                                <th>Tags</th>
                                <th>Danh mục</th>
                                <th>Địa điểm</th>
                                <th>Đăng bởi</th>
                                <th>Số lượt xem</th>
                                <th>Bình luận</th>
                                <th>Thích</th>
                                <th>Trạng thái</th>                                
                                <th style="width:65px;"></th>
                            </tr>
                        </thead>
                        <tbody id="result-review" style="display: none"></tbody>
                        <tbody id="content-review">
                            @csrf
                            @foreach ($all_review as $key => $review)
                                <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $review->review_title }}</td>
                                    <td>
                                        @if ($review->review_images == "no_image23.png")
                                            <img src="../uploads/ReviewImage/no_image23.png" height="100" width="100">
                                        @else
                                            <img src="../uploads/ReviewImage/{{ explode("|", $review->review_images)[0]}}" height="100" width="100">
                                            <a class="show_images" href="{{URL::to('/show-review-images/'.$review->review_id)}}">Xem thêm...</a>
                                        @endif
                                    </td>
                                    <td>{{ $review->review_slug }}</td>
                                    <td>{{ $review->review_desc }}</td>
                                    <td>{{ $review->tags }}</td>
                                    <td>{{ $review->category->category_name }}</td>
                                    <td>{{ $review->location->location_name }}</td>
                                    <td>{{ $review->admin->admin_first_name }}</td>
                                    <td>{{ $review->view_count }}</td>
                                    <td>{{ $review->like_count }}</td>
                                    <td>{{ $review->comment_count }}</td>
                                    <td>
                                        <?php if ($review->review_status == 0) { ?>
                                        <a href="{{URL::to('/active-review/'.$review->review_id)}}"><span class="fa-eye-slash-style fa fa-eye-slash"></span></a>
                                        <?php } else { ?>
                                        <a href="{{URL::to('/unactive-review/'.$review->review_id)}}"><span class="fa-eye-style fa fa-eye"></span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-review/'.$review->review_id)}}">
                                            <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa bài viết này?')" href="{{URL::to('/delete-review/'.$review->review_id)}}">
                                          <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                      </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <small>Hiển thị {!!$all_review->count()!!} bài viết trong số {!!$all_review->total()!!} bài viết</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination justify-content-end">
                            {!!$all_review->links()!!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- End Phượng -->