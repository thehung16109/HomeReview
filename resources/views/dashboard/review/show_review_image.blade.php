<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Ảnh của bài viết</h3>
        <div class="x_panel">
            <div class="x_content">
                <span class="section">Danh sách ảnh</span>
                <div class="row">
                    <div class="col-sm-5">
                        <form class="form-inline">
                            <button type="submit" class="btn btn-sm btn-primary ml-2 mt-1">Xóa những dòng được chọn</button>
                        </form>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="input-group col-sm-3">
                        <input type="text" class="form-control form-control-sm" placeholder="Tìm kiếm...">
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
                                <th>Tiêu đề bài viết</th>
                                <th>Ảnh</th>
                                <th style="width:40px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review_images as $key => $image)
                                <tr>
                                    <td>
                                        <label class="i-checks">
                                            <input type="checkbox" id="checkItem"><i></i>
                                        </label>
                                    </td>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $review_title }}</td>
                                    <td><img src="../uploads/ReviewImage/{{$image}}" height="100" width="100">
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa hình ảnh này?')" href="{{URL::to('/delete-review-image/'.$image.'/'.$review_id)}}">
                                          <i class="fa fa-times text-danger text" style="font-size: 20px"></i>
                                      </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- End Phượng -->