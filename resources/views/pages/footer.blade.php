<footer class="footer text-white pt-5 pb-4 mt-4">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
            <div class="col-md-4 col-lg-4 col-xl-4">
                <h3 class="mb-5">About us</h3>
                <p>Chuyên trang Review & đánh giá các homestay - hostel - resort mới nhất, có view đẹp nhất với chi
                    phí phải chăng....</p>
                {{-- <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tìm kiếm...">
                    <div class="input-group-append">
                        <span class="input-group-text">Tìm kiếm</span>
                    </div>
                </div> --}}
                <div class="chinhanh">
                    <span>Chi nhánh: </span>
                    <a href="#">Đà Lạt</a>
                    <a href="#">Hà Nội</a>
                    <a href="#">Sài Gòn</a>
                </div>
                <a class="lienhe" href="#">Liên hệ truyền thông quảng cáo: 0999999999</a>
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4">
                <a class="review-title-footer" href="{{ URL::to('/region/' . 'mien-bac') }}">
                    <h3 class="mb-5">Home stay Miền Bắc</h3>
                </a>
                @foreach ($all_review_bac as $key => $review_bac)
                    <div class="row footer-item">
                        <div class="col-md-3">
                            <a href="{{ URL::to('/review/' . $review_bac->review_slug) }}">
                                    <img src="../uploads/ReviewImage/{{ explode('|', $review_bac->review_images)[0] }}"
                                        height="100" width="100">
                            </a>
                        </div>
                        <div class="col-md-9 col-lg-9 col-xl-9">
                            <a class="review-title-footer"
                                href="{{ URL::to('/review/' . $review_bac->review_slug) }}">
                                <h5>{{ $review_bac->review_title }}</h5>
                            </a>
                            <p>{{ $review_bac->created_at }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4">
                <a class="review-title-footer" href="{{ URL::to('/region/' . 'mien-nam') }}">
                    <h3 class="mb-5">Home stay Miền Nam</h3>
                </a>
                @foreach ($all_review_nam as $key => $review_nam)
                    <div class="row footer-item">
                        <div class="col-md-3">
                            <a href="{{ URL::to('/review/' . $review_nam->review_slug) }}">

                                    <img src="../uploads/ReviewImage/{{ explode('|', $review_nam->review_images)[0] }}"
                                        height="100" width="100">
                            </a>
                        </div>
                        <div class="col-md-9 col-lg-9 col-xl-9">
                            <a class="review-title-footer"
                                href="{{ URL::to('/review/' . $review_nam->review_slug) }}">
                                <h5>{{ $review_nam->review_title }}</h5>
                            </a>
                            <p>{{ $review_nam->created_at }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid final-footer">
        <div class="container d-flex justify-content-between">
            <p>© 2017 - All Rights Reserved.</p>
            <p>Website Design: <a href="{{ URL::to('/trang-chu') }}">Homestay Review</a></p>
        </div>
    </div>
    </div>
</footer>