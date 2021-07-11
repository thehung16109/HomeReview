<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Tin tức</h3>
        <div class="x_panel">
            <div class="x_content">
                <span class="section">Danh sách tin tức</span>
                <div class="row">
                    <div class="col-sm-5">
                        <form class="form-inline">
                            <button type="submit" class="btn btn-sm btn-primary ml-2 mt-1">Xóa những dòng được chọn</button>
                        </form>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="input-group col-sm-3">
                        <input id="search-news" type="text" class="form-control form-control-sm" placeholder="Tìm kiếm...">
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
                                <th>Đăng bởi</th>
                                <th>Số lượt xem</th>
                                <th>Thích</th>
                                <th>Trạng thái</th>                                
                                <th style="width:65px;"></th>
                            </tr>
                        </thead>
                        <tbody id="result-news" style="display: none"></tbody>
                        <tbody id="content-news">
                            @csrf
                            @foreach ($all_news as $key => $news)
                                <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $news->news_title }}</td>
                                    <td>
                                        @if ($news->news_images == "no_image23.png")
                                            <img src="../uploads/NewsImage/no_image23.png" height="100" width="100">
                                        @else
                                            <img src="../uploads/NewsImage/{{ explode("|", $news->news_images)[0]}}" height="100" width="100">
                                            <a class="show_images" href="{{URL::to('/show-news-images/'.$news->news_id)}}">Xem thêm...</a>
                                        @endif
                                    </td>
                                    <td>{{ $news->news_slug }}</td>
                                    <td>{{ $news->news_desc }}</td>
                                    <td>{{ $news->news_tags }}</td>
                                    <td>{{ $news->admin->admin_first_name }}</td>
                                    <td>{{ $news->view_count }}</td>
                                    <td>{{ $news->like_count }}</td>
                                    <td>
                                        <?php if ($news->news_status == 0) { ?>
                                        <a href="{{URL::to('/active-news/'.$news->news_id)}}"><span class="fa-eye-slash-style fa fa-eye-slash"></span></a>
                                        <?php } else { ?>
                                        <a href="{{URL::to('/unactive-news/'.$news->news_id)}}"><span class="fa-eye-style fa fa-eye"></span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-news/'.$news->news_id)}}">
                                            <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 20px"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa bài viết này?')" href="{{URL::to('/delete-news/'.$news->news_id)}}">
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
                        <small>Hiển thị {!!$all_news->count()!!} tin tức trong số {!!$all_news->total()!!} tin tức</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination justify-content-end">
                            {!!$all_news->links()!!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- End Phượng -->