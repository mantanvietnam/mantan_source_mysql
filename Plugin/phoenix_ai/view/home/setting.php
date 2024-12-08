<?php include('header.php'); ?>
                    <?php 
                        global $session;
                        $info = $session->read('infoUser');
                     
                    ?>
    <div class="setting-home container-fluid">
        <p><img src="/plugins/phoenix_ai/view/home/assets/img/setting.svg" alt="">Cài Đặt</p>
        <div class="container mt-4">
            <div class="row">
       
                <!-- Sidebar bên trái -->
                <div class="col-md-3 left-setting" style="height: fit-content;">
                    <ul class="nav flex-column nav-pills my-3" id="componentTab" role="tablist">
                        <div class="user-info d-flex my-4">
                            <img src="/plugins/phoenix_ai/view/home/assets/img/avatar.jpg" alt="Avatar">
                            <div class="contact-info mx-2">
                                <div class="name"><?=$info->name?></div>
                                <div class="email"><?=$info->email?></div>
                                <a class="my-4" href="#">Lưu</a>
                            </div>
                        </div>
                        <li class="nav-item">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                                <img src="/plugins/phoenix_ai/view/home/assets/img/home.svg" alt=""> Chỉnh sửa hồ sơ
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="slide-tab" data-bs-toggle="pill" data-bs-target="#slide" type="button" role="tab" aria-controls="slide" aria-selected="false">
                                <img src="/plugins/phoenix_ai/view/home/assets/img/lsmh.svg" alt=""> Lịch sử đơn hàng
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="slide-tab" data-bs-toggle="pill" data-bs-target="#brand-voice" type="button" role="tab" aria-controls="slide" aria-selected="false">
                                <img src="/plugins/phoenix_ai/view/home/assets/img/huychuong.svg" alt=""> Điểm thưởng
                            </button>
                        </li>
                    </ul>
                </div>
    
                <!-- Nội dung bên phải -->
                <div class="col-md-9">
                    <div class="tab-content" id="componentContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="form-section container-fluid">
                                <h3 class="text-primary mb-4">Chỉnh sửa hồ sơ</h3>
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="first-name" class="form-label">Tên*</label>
                                            <input type="text" id="first-name" class="form-control" placeholder="Nhập Tên" readonly value="<?=$info->name?>">
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label for="last-name" class="form-label">Họ*</label>
                                            <input type="text" id="last-name" class="form-control" placeholder="Nhập họ" readonly>
                                        </div> -->
                                    </div>
                                    <div class="row mb-3">
                                        <!-- <div class="col-md-6">
                                            <label for="user-id" class="form-label">Mã người dùng*</label>
                                            <input type="text" id="user-id" class="form-control" placeholder="Mã người dùng" readonly>
                                        </div> -->
                                        <div class="col-md-6">
                                            <label for="phone-number" class="form-label">Số điện thoại*</label>
                                            <input type="tel" id="phone-number" class="form-control" placeholder="Nhập số điện thoại" value="<?=$info->phone?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Email*</label>
                                            <input type="email" id="email" class="form-control" placeholder="Nhập email" value="<?=$info->email?>" readonly>
                                        </div>
                                    </div>
                                    <!-- <h5 class="text-primary mt-4">GPT model</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="ai-model" class="form-label">Chọn mô hình AI ưa thích của bạn</label>
                                            <select id="ai-model" class="form-select">
                                                <option>GPT-4o-Mini</option>
                                                <option>GPT-3.5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ai-language" class="form-label">Chọn ngôn ngữ AI của bạn</label>
                                            <select id="ai-language" class="form-select">
                                                <option>Tiếng Việt</option>
                                                <option>English</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="slide" role="tabpanel" aria-labelledby="upgrade-tab">
                            <div class="container" style="height: 550px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center align-middle my-4">
                                        <thead>
                                            <tr>
                                                <th scope="col">Mã đơn hàng</th>
                                                <th scope="col">Gói mua</th>
                                                <th scope="col">Loại giao dịch</th>
                                                <th scope="col">Hình thức thanh toán</th>
                                                <th scope="col">Hạn sử dụng</th>
                                                <th scope="col">Tổng thanh toán</th>
                                                <th scope="col">Ngày mua</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <img src="/plugins/phoenix_ai/view/home/asset/img/robot.svg" alt="No Data" class="no-data-img">
                                    <p class="mt-3">Không có dữ liệu</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="brand-voice" role="tabpanel" aria-labelledby="brand-voice-tab">  
                            <div class="container">
                                <div class="row">
                                    <div class="card-rewar">
                                        <div class="card-header">
                                            <h4>Danh sách nhiệm vụ</h4>
                                            <div class="credit">0 <span>Credit</span></div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                    <th>Nhiệm vụ</th>
                                                    <th>Số điểm thưởng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <td>Sử dụng Workflow lần đầu tiên</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Tạo Aiva lần liên tiếp lần đầu tiên</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Sử dụng Aiva hình ảnh lần đầu tiên</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Cài đặt giọng điệu thường hiệu</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Tạo mới dự liệu mẫu</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Yêu thích 1 trợ lý lần đầu tiên</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Chia sẻ 1 lượng chat Aiva lần đầu tiên</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Chia sẻ 1 nội dung trên Aiva chat lần đầu tiên</td>
                                                    <td>+2</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Nâng cấp gói credit</td>
                                                    <td>+5</td>
                                                    </tr>
                                                    <tr>
                                                    <td>Sử dụng một trợ lý/ngày</td>
                                                    <td>+1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
<?php include('footer.php'); ?>