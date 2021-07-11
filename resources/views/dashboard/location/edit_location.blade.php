<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Địa điểm</h3>
        <div class="x_panel">
            <div class="x_content">
                <form class="" action="{{ URL::to('/update-location/' . $edit_location->location_id) }}" method="post">
                    {{ csrf_field() }}
                    <span class="section">Cập nhật địa điểm</span>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Tên địa điểm<span></span></label>
                        <div class="col-md-3 col-sm-3">
                            <input class="form-control" value="{{ $edit_location->location_name }}" name="location_name"
                                onkeyup="ChangeToSlug();" id="slug" required />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Slug</label>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="location_slug" id="convert_slug"
                                value="{{ $edit_location->location_slug }}" readonly/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Vùng miền</label>
                        <div class="col-md-3 col-sm-3">
                            <select class="form-control input-sm" name="region_id">
                                @foreach ($all_region as $key => $region)
                                    <option {{ $edit_location->region_id == $region->region_id ? 'selected' : '' }}
                                        value="{{ $region->region_id }}">{{ $region->region_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <div class="form-check col-md-4 col-sm-4 label-align mt-2">
                            <input class="form-check-input" type="checkbox" name="location_status"
                                {{ $edit_location->location_status == 1 ? 'checked' : '' }} value="1" />
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
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" name="update_location" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<!-- End Phượng -->
