<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Bình luận</h3>
        <div class="x_panel">
            <div class="x_content">
                <span class="section">Danh sách bình luận</span>
                <div class="row">
                    <div class="col-sm-5">
                        <form class="form-inline">
                            <button type="submit" class="btn btn-sm btn-primary ml-2 mt-1">Xóa những dòng được chọn</button>
                        </form>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="input-group col-sm-3">
                        <input id="search-comment" type="text" class="form-control form-control-sm" placeholder="Tìm kiếm...">
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
                                <th>Khách hàng</th>
                                <th>Bài viết</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th>                                
                                <th style="width:40px;"></th>
                            </tr>
                        </thead>
                        <tbody id="result-comment" style="display: none"></tbody>
                        <tbody id="content-comment">
                            @csrf
                            @foreach ($all_comment as $key => $comment)
                                <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>{{ ++$key }}</td>
                                    <td>{!! $comment->customer->customer_last_name . ' ' . $comment->customer->customer_first_name !!}</td>
                                    <td>{{ $comment->review->review_title }}</td>
                                    <td>{{ $comment->comment_content }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <?php if ($comment->comment_status == 0) { ?>
                                        <a href="{{URL::to('/active-comment/'.$comment->comment_id)}}"><span class="fa-eye-slash-style fa fa-eye-slash"></span></a>
                                        <?php } else { ?>
                                        <a href="{{URL::to('/unactive-comment/'.$comment->comment_id)}}"><span class="fa-eye-style fa fa-eye"></span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa bình luận này?')" href="{{URL::to('/delete-comment/'.$comment->comment_id)}}">
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
                        <small>Hiển thị {!!$all_comment->count()!!} bình luận trong số {!!$all_comment->total()!!} bình luận.</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination justify-content-end">
                            {!!$all_comment->links()!!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- End Phượng -->