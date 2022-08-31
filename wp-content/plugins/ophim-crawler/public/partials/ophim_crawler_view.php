<?php
foreach (get_plugins() as $key=>$value){
    if($value['Name']=='OPhim Crawler'){
        $thisversion= $value['Version'];
    }
}

$plugin_path = plugin_dir_url( __DIR__ );
?>

<div class="crawl_main">
    <div class="crawl_page">
        <div class="postbox">
            <div class="inside">
                Ophim.TV là website dữ liệu phim miễn phí vĩnh viễn. Cập nhật nhanh, chất lượng cao, ổn định và lâu dài. Tốc độ phát cực nhanh với đường truyền băng thông cao, đảm bảo đáp ứng được lượng xem phim trực tuyến lớn. Đồng thời giúp nhà phát triển website phim giảm thiểu chi phí của các dịch vụ lưu trữ và stream. <br />
                - Hàng ngày chạy tools tầm 10 đến 20 pages đầu (tùy số lượng phim được cập nhật trong ngày) để update tập mới hoặc thêm phim mới!<br />
                - Trộn link vài lần để thay đổi thứ tự crawl & update. Giúp tránh việc quá giống nhau về content của các website!<br />
                - API được cung cấp miễn phí: <a href="https://ophim.tv/api-document" target="_blank">https://ophim.tv/api-document</a> <br />
                - Tham gia trao đổi tại: <a href="https://t.me/+FPSDDbRPRuozNjZl" target="_blank">https://t.me/+FPSDDbRPRuozNjZl</a> <br />
            </div>
        </div>
    </div>
    <div class="crawl_page">
        Page Crawl: From <input type="number" name="page_from" value="491">
        To <input type="number" name="page_to" value="1">
        <div id="get_list_movies" class="primary">Get List Movies</div>
    </div>
    <div class="crawl_page">
        <div style="display: none" id="msg" class="notice notice-success">
            <p id="msg_text"></p>
        </div>
        <textarea rows="10" id="result_list_movies" class="list_movies"></textarea>
        <div id="roll_movies" class="roll">Trộn Link</div>
        <div id="crawl_movies" class="primary">Crawl Movies</div>

        <div style="display: none;" id="result_success" class="notice notice-success">
            <p>Crawl Thành Công</p>
            <textarea rows="10" id="list_crawl_success"></textarea>
        </div>

        <div style="display: none;" id="result_error" class="notice notice-error">
            <p>Crawl Lỗi</p>
            <textarea rows="10" id="list_crawl_error"></textarea>
        </div>
    </div>
</div>