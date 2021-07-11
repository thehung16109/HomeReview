<!-- Phượng -->
@extends('admin_layout')
@section('admin_content')
    <div>
        <h3 class="title">Tin tức</h3>
        <div class="x_panel">
            <div class="x_content">
                <form action="{{ URL::to('/update-news/' . $edit_news->news_id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <span class="section">Cập nhật tin tức</span>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-1 col-sm-1 label-align">Tiêu đề<span>*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" value="{{ $edit_news->news_title }}" name="news_title"
                                onkeyup="ChangeToSlug();" id="slug" required />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-1 col-sm-1  label-align">Slug</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="news_slug" id="convert_slug"
                                value="{{ $edit_news->news_slug }}" readonly />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-1 col-sm-1  label-align">Mô tả tóm tắt<span>*</span></label>
                        <div class="col-md-11 col-sm-11">
                            <textarea style="resize: none" rows="2" class="form-control" name="news_desc"
                                required>{{ $edit_news->news_desc }}</textarea>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-1 col-sm-1  label-align">Nội dung<span>*</span></label>
                        <div class="col-md-11 col-sm-11">
                            <textarea style="resize: none" rows="5" class="form-control" name="news_content"
                                required>{{ $edit_news->news_content }}</textarea>
                        </div>
                    </div>
                    
                    <div class="field item form-group">
                        <label class="col-form-label col-md-1 col-sm-1 label-align">Loạt hình mới</label>
                        <div class="col-md-3 col-sm-3 input-group">
                            <input type="file" class="form-control-file" name="news_images[]" multiple />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-1 col-sm-1 label-align">Tags bài viết</label>
                        <div class="col-md-11 col-sm-11">
                            <input type="text" data-role="tagsinput" class="form-control" name="news_tags"
                                value="{{ $edit_news->news_tags }}" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <div class="form-check col-md-2 col-sm-2 label-align mt-2">
                            <input class="form-check-input" type="checkbox" name="news_status" 
                            {{ $edit_news->news_status == 1 ? 'checked' : '' }} value="1" />
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
                    <div class="col-md-6 offset-md-1 mt-2">
                        <button type="submit" name="update_news" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<!-- End Phượng -->
