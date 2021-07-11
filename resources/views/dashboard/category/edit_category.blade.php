<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Danh mục</h3>
        <div class="x_panel">
            <div class="x_content">
                <form class="" action="{{ URL::to('/update-category/'.$edit_category->category_id) }}" method="post">
                    {{ csrf_field() }}
                    <span class="section">Cập nhật danh mục</span>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4 label-align">Tên danh mục<span></span></label>
                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" value="{{$edit_category->category_name}}" name="category_name" onkeyup="ChangeToSlug();" id="slug" required/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-4 col-sm-4 label-align">Slug</label>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="category_slug" id="convert_slug" value="{{$edit_category->category_slug}}" readonly/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <div class="form-check col-md-3 col-sm-3 offset-md-4 mt-2">
                            <input class="form-check-input" type="checkbox" name="category_status"
                                {{ $edit_category->category_status == 1 ? 'checked' : '' }} value="1" />
                            <label class="form-check-label" for="invalidCheck2" style="font-size: 110%;">
                                Kích hoạt
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-4 mb-2">
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                        echo '<span style="color:red; font-weight: bold;">' . $message . '</span>';
                        Session::put('message', null);
                        }
                        ?>
                    </div>
                    <div class="col-md-3 offset-md-4">
                        <button type="submit" name="update_category" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<!-- End Phượng -->