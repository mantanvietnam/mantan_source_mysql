<?php 
    getheader();
    
?>
          
    <div class="aiva-home container-fluid">
        <div class="home-banner">
            <img src="<?= $urlThemeActive?>/asset/img/bgr-home.jpg" alt="">
            <div class="text-home-banner">
                <p>Hôm nay tôi có thể giúp gì cho bạn ?</p>
                <div class="search-container">
                    <div class="search-wrapper">
                        <form id="searchForm" class="search-form">
                            <div class="input-wrapper">
                                <input 
                                    type="text" 
                                    class="search-input" 
                                    placeholder="Tìm kiếm trợ lý hoặc bấm / để chat với Aiva"
                                    id="searchInput"
                                >
                                <div class="search-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container-fluid">
                <!-- Tab links -->
                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="assistant-tab" data-bs-toggle="tab" data-bs-target="#assistant" type="button">Trợ lý Aiva</button>
                    </li>
                </ul>
            </div>
        </nav>
    
        <!-- Tab contents -->
        <div class="tab-content" id="myTabContent">
            <!-- Trợ lý Aiva content -->
            <div class="tab-pane fade show active" id="assistant" role="tabpanel">
                <!-- Category navigation -->
                <div class="container-fluid mt-3">
                    <div class="d-flex align-items-center gap-3 category-nav">
                        <a href="#" class="category-link">Viết lách</a>
                        <a href="#" class="category-link">Marketing</a>
                        <a href="#" class="category-link">Bán hàng</a>
                        <a href="#" class="category-link">Kinh doanh</a>
                        <a href="#" class="category-link">Phát triển bản thân</a>
                        <a href="#" class="category-link">Tiện ích</a>
                        <a href="#" class="category-link">Học tập</a>
                        <a href="#" class="category-link">HR</a>
                        <a href="#" class="category-link">Giáo dục</a>
                    </div>
                </div>

                <div class="container-fluid mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="heading">Trợ lý Aiva</h1>
                        <button class="btn btn-light rounded-pill view-all">Xem tất cả</button>
                    </div>
                    <div class="card-ai row d-flex justify-content-evenly">
                        <div class="card col-lg-5">
                            <div class="info">
                                <img src="<?= $urlThemeActive?>/asset/img/avatar.jpg" alt="Profile Picture">
                                <p>Andy</p>
                                <span>SEO Expert</span>
                            </div>
                            <div class="card-content mx-2">
                                <h3>Viết bài blog dựa trên nội dung/tiêu đề</h3>
                                <p>Viết bài blog từ A-Z chuẩn SEO 3000 từ</p>
                                <div class="buttons">
                                    <button class="like">👍 7</button>
                                    <button class="play"><i class="fa-regular fa-circle-play"></i> Thực hiện</button>
                                </div>
                            </div>
                        </div>
                        <div class="card col-lg-5">
                            <div class="info">
                                <img src="<?= $urlThemeActive?>/asset/img/avatar.jpg" alt="Profile Picture">
                                <p>Andy</p>
                                <span>SEO Expert</span>
                            </div>
                            <div class="card-content mx-2">
                                <h3>Viết bài blog dựa trên nội dung/tiêu đề</h3>
                                <p>Viết bài blog từ A-Z chuẩn SEO 3000 từ</p>
                                <div class="buttons">
                                    <button class="like">👍 7</button>
                                    <button class="play"><i class="fa-regular fa-circle-play"></i> Thực hiện</button>
                                </div>
                            </div>
                        </div>
                        <div class="card col-lg-5">
                            <div class="info">
                                <img src="<?= $urlThemeActive?>/asset/img/avatar.jpg" alt="Profile Picture">
                                <p>Andy</p>
                                <span>SEO Expert</span>
                            </div>
                            <div class="card-content mx-2">
                                <h3>Viết bài blog dựa trên nội dung/tiêu đề</h3>
                                <p>Viết bài blog từ A-Z chuẩn SEO 3000 từ</p>
                                <div class="buttons">
                                    <button class="like">👍 7</button>
                                    <button class="play"><i class="fa-regular fa-circle-play"></i> Thực hiện</button>
                                </div>
                            </div>
                        </div>
                        <div class="card col-lg-5">
                            <div class="info">
                                <img src="<?= $urlThemeActive?>/asset/img/avatar.jpg" alt="Profile Picture">
                                <p>Andy</p>
                                <span>SEO Expert</span>
                            </div>
                            <div class="card-content mx-2">
                                <h3>Viết bài blog dựa trên nội dung/tiêu đề</h3>
                                <p>Viết bài blog từ A-Z chuẩn SEO 3000 từ</p>
                                <div class="buttons">
                                    <button class="like">👍 7</button>
                                    <button class="play"><i class="fa-regular fa-circle-play"></i> Thực hiện</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


<?php 
    getFooter();
?>