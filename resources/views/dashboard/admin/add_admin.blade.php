<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Admin</h3>
        <div class="x_panel">
            <div class="x_content">
                <form action="{{ URL::to('/save-admin') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <span class="section">Thêm admin</span>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Họ<span>*</span></label>
                        <div class="col-md-3 col-sm-3 custom-file">
                            <input type="text" class="form-control" name="admin_last_name" required/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Tên<span>*</span></label>
                        <div class="col-md-2 col-sm-2">
                            <input type="text" class="form-control" name="admin_first_name" required/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Địa chỉ email<span>*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="admin_email" aria-describedby="emailHelp" required/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Mật khẩu<span>*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="password" class="form-control" name="admin_password" required/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Số điện thoại</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="admin_phone"/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Hình đại điện</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="file" class="form-control-file" name="admin_avatar"/>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3 mb-2">
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                        echo '<span style="color:red; font-weight: bold;">' . $message . '</span>';
                        Session::put('message', null);
                        }
                        ?>
                    </div> 

                    <div class="col-md-6 offset-md-3">
                        <button type="submit" name="add_admin" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
<!-- End Phượng -->