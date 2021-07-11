# HomeReview
  <h1>Project "Phát triển ứng dụng web" - UIT</h1>
<h3>Thành viên tham gia</h3>
<ul>
    <li>Phùng Thế Hùng : 18520808</li>
    <li>  Nguyễn Thị Bích Phượng : 17520926</li>
    <li>Nguyễn Văn Lực : 19521811</li>
    <li>Lê Quang Khải : 19521656</li>
</ul>
<h3>Hướng dẫn cài trên localhost</h3>
<b>Chuẩn bị</b>
<ul>
    <li>Composer</li>
    <li>NodeJS (dùng để cài đặt gói)</li>
    <li>Apache Http Server (có thể dùng Wamp, Xamp hoặc Laragon)</li>
</ul>
<b>Tiến hành các bước</b> </br>
<b>Bước 1: Git clone dự án về máy, sau đó cd tới đường dẫn của bạn</b> </br>
<b>Bước 2: Cài các gói composer</b>
<p>Bạn vào cmd, gõ câu lệnh sau: <code>composer install</code> và chờ các gói được cài đặt xong</p>
<b>Bước 3: Cài các gói npm</b>
<p>Gõ câu lệnh sau: <code>npm install</code> và chờ các gói được cài đặt xong</p>
<b>Bước 4: Tạo key</b>
<p>Gõ câu lệnh sau <code>php artisan key:generate</code></p>
<b>Bước 5: Tạo database</b>
<p>Gõ <code>php artisan migrate</code>để laravel đồng bộ với db và tạo sẵn table</p>
<b>Bước 6: Chạy</b>
<p>Trước khi chạy, cần phải mở WAMP, XAMP hoặc gì đó để bật Apache server, sau đó gõ php artisan serve. Web sẽ nằm trên localhost:8000.</p>
