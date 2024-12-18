<?php include(__DIR__.'/../header.php'); ?>
<section class="showcase ">
            <div class="overlay">
                <div class="assistant-aiva container-fluid">
                    <div class="assistant-header">
                        <p><img src="/plugins/phoenix_ai/view/home/asset/img/assistant.svg" alt="">Trợ lý AI Tự động</p>
                        <h5>chạy tự động các tác vụ và giúp bạn tăng hiệu quả công việc gấp 5 lần chỉ với 1 click chuột!</h5>
                    </div>
                </div>
                <div class="container my-4">
                    <div class="row">
                        <!-- Sidebar bên trái -->
                        <div class="col-md-3 left-setting">
                            <div class="search-bar my-3 d-flex align-items-center">
                                <input type="text" class="form-control me-2" placeholder="Tìm kiếm trợ lý" aria-label="Tìm kiếm trợ lý">
                                <button class="btn btn-primary" type="button">Tìm</button>
                            </div>
                            <p class="category">Danh mục</p>
                            <ul class="nav flex-column nav-pills" id="componentTab" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="true">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/vl.png" alt=""> Viết lách
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="order-history-tab" data-bs-toggle="pill" data-bs-target="#order-history"
                                        type="button" role="tab" aria-controls="order-history" aria-selected="false">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/ptbt.png" alt=""> Phát triển bản thân
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="rewards-tab" data-bs-toggle="pill" data-bs-target="#rewards"
                                        type="button" role="tab" aria-controls="rewards" aria-selected="false">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/gd.png" alt=""> Giáo dục
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="tiktok-tab" data-bs-toggle="pill" data-bs-target="#tiktok"
                                        type="button" role="tab" aria-controls="tiktok" aria-selected="false">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/tiktok.png" alt="">Tik Tok
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="marketting-tab" data-bs-toggle="pill" data-bs-target="#marketting"
                                        type="button" role="tab" aria-controls="marketting" aria-selected="false">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/mkt.png" alt=""> Marketing
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="cells-tab" data-bs-toggle="pill" data-bs-target="#cells"
                                        type="button" role="tab" aria-controls="rewards" aria-selected="false">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/bh.png" alt=""> Bán hàng
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="business-tab" data-bs-toggle="pill" data-bs-target="#business"
                                        type="button" role="tab" aria-controls="rewards" aria-selected="false">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/kd.png" alt=""> Kinh doanh
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="lists-tab" data-bs-toggle="pill" data-bs-target="#lists"
                                        type="button" role="tab" aria-controls="rewards" aria-selected="false">
                                        <img src="/plugins/phoenix_ai/view/home/asset/img/dstl.svg" alt=""> Danh sách trợ lý
                                    </button>
                                </li>
                            </ul>
                        </div>
                
                        <!-- Nội dung chính bên phải -->
                        <div class="col-md-9">
                            <div class="tab-content" id="componentContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="container bg-white py-4">
                                        <div class="row align-items-start">
                                            <!-- Cột 1: Avatar, Tên và Nhiệm vụ -->
                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                <div class="profile-section text-center px-3">
                                                    <img src="<?php echo $bostAi['avatar'] ?>" alt="Avatar" class=" mb-2" style="width: 100px; height: 100px;">
                                                    <h5 class="mb-1"><?php echo $bostAi['name'] ?></h5>
                                                    <span class="badge bg-primary px-3 py-1"><?php echo $bostAi['boot'] ?></span>
                                                    <div class="tasks mt-4">
                                                        <div class="d-flex justify-content-between align-items-center mb-3 mission">
                                                            <span class="fw-bold ">Nhiệm vụ hoàn thành</span>
                                                            <span class="badge bg-secondary">0</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center mission">
                                                            <span class="fw-bold">Tiết kiệm giờ làm việc</span>
                                                            <span class="badge bg-secondary">0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <!-- Đường kẻ dọc giữa các cột -->
                                            <div class="col-auto d-none d-lg-block border-start"></div>
                                    
                                            <!-- Cột 2: Text, Nút Thực hiện và Video -->
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="content-section px-3">
                                                    <h4 class="mb-2 mission-text"><?php echo $bostAi['title'] ?></h4>
                                                    <p class="mb-3"><?php echo $bostAi['district'] ?></p>
                                                    <button class="btn btn-primary mb-3 btn-mission"><img src="/plugins/phoenix_ai/view/home/asset/img/kd.png" alt=""> Thực hiện</button>
                                                    <div class="video-container">
                                                        <iframe width="100%" height="240" src="https://www.youtube.com/embed/example" frameborder="0" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <!-- Đường kẻ dọc giữa các cột -->
                                            <div class="col-auto d-none d-lg-block border-start"></div>
                                    
                                            <!-- Cột 3: Plug-in, Nút "Xem lịch sử" và Biểu tượng tương tác -->
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                <div class="plugin-section px-3">
                                                    <h6 class="fw-bold mb-3"><img src="/plugins/phoenix_ai/view/home/asset/img/robot.svg" alt="" style="width: 40px;"> AIVA</h6>
                                                    <ul class="list-unstyled mb-4">
                                                        <li class="d-flex align-items-center mb-2">
                                                            <img src="/plugins/phoenix_ai/view/home/asset/img/driver.svg" alt="" style="width:20px;"> Drive
                                                        </li>
                                                        <li class="d-flex align-items-center">
                                                            <img src="/plugins/phoenix_ai/view/home/asset/img/AI.svg" alt="" style="width:20px;"> AI Tools
                                                        </li>
                                                    </ul>
                                                    <button class="btn btn-light mb-4 w-100 btn-history">Xem lịch sử</button>
                                                    <div class="interaction text-center d-flex">
                                                        <button class="btn btn-light me-2 icon-mission"><i class="fa-regular fa-thumbs-up"></i> 4</button>
                                                        <button class="btn btn-light me-2 icon-mission"><i class="fa-regular fa-comment"></i> 0</button>
                                                        <button class="btn btn-light icon-mission"><i class="fa-solid fa-share"></i> Chia sẻ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                
            </div>
        </section>

<?php include(__DIR__.'/../footer.php'); ?>