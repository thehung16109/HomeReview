<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Khách hàng</h3>
        <div class="x_panel">
            <div class="x_content">
                <span class="section">Danh sách khách hàng</span>
                    <div class="row">
                        <div class="col-sm-5">
                            <form class="form-inline">
                                <button type="submit" class="btn btn-sm btn-primary ml-2 mt-1">Xóa những dòng được chọn</button>
                            </form>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="input-group col-sm-3">
                            <input id="search-customer" type="text" class="form-control form-control-sm" placeholder="Tìm kiếm...">
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
                                    <th>Họ và tên</th>
                                    <th>Địa chỉ email</th>
                                    <th>Avatar</th>
                                    <th style="width:65px;"></th>
                                </tr>
                            </thead>
                            <tbody id="result-customer" style="display: none"></tbody>
                            <tbody id="content-customer">
                                @csrf
                                @foreach ($all_customer as $key => $customer)
                                    <tr>
                                        <td>
                                            <label class="i-checks">
                                                <input type="checkbox" id="checkItem"
                                                    value="{{$customer->customer_id}}"><i></i>
                                            </label>
                                        </td>
                                        <td>{{ ++$key }}</td>
                                        <td>{!! $customer->customer_last_name . ' ' . $customer->customer_first_name !!}</td>
                                        <td>{{ $customer->customer_email }}</td>
                                        <td><img src="../uploads/CustomerAvatar/{{ $customer->customer_avatar }}" height="100" width="100">
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/edit-customer/' . $customer->customer_id) }}">
                                                <i class="fa fa-pencil-square-o text-success text-active"
                                                    style="font-size: 20px"></i>
                                            </a>
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa tài khoản này?')"
                                                href="{{ URL::to('/delete-customer/' . $customer->customer_id) }}">
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
                        <small>Hiển thị {!! $all_customer->count() !!} khách hàng trong số {!! $all_customer->total() !!} khách hàng.</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination justify-content-end">
                            {!! $all_customer->links() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- End Phượng -->
