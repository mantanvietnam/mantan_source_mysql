<?php 
    getHeader();
    global $settingThemes;
?>
<main>
        <div class="register">
            <div class="container d-flex align-items-center">
                <div class="col-lg-6">
                    <div class="back d-flex">
                        <a href="./event.html"><i class="fa-solid fa-chevron-left"></i></a>
                        <p>Chỉnh sửa sự kiện</p>
                    </div>
                </div>
            </div>
        </div>

        <section class="edit-event__edit">
            <div class="container">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home">Sự Kiện</a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#menu1">Vé mời</a>
                    </li>
                </ul>
                
                <div class="container">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active" id="home">
                            <!-- Content Section -->
                            <div class="container my-5">
                                <!-- Event Section -->
                                <div id="event-section">
                                    <form method="POST"  action="" enctype="multipart/form-data">
                                        <p><?php echo $mess?></p>
                                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                        <?php if(!empty($data->id_member)) :?>
                                            <input type="hidden" value="<?php echo $data->id_member;?>" name="id_member">
                                        <?php endif?>
                                            <div class="mb-3">
                                                <label for="eventName" class="form-label">Tên sự kiện</label>
                                                <input type="hidden" name="status" class="form-control"  value="<?php echo @$data->status?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="eventName" class="form-label">Tên sự kiện</label>
                                                <input type="text" name="name" class="form-control" id="eventName" value="<?php echo @$data->name?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="eventName" class="form-label">Địa chỉ</label>
                                                <input type="text" name="address" class="form-control" value="<?php echo @$data->address?>">
                                            </div>
                                            <div class="form-section mb-4">
                                                <label for="event-description" class="form-label">Thời gian bắt đầu</label>
                                                <input id="event-description" type="datetime-local" name="time_start" class="form-control" value="<?= isset($data->time_start) ? date('Y-m-d\TH:i', $data->time_start) : date('Y-m-d\TH:i'); ?>">
                                            </div>
                                            <div class="form-section">
                                                <div class="upload-wrapper">
                                                    <label for="banner">Ảnh sự kiện</label>
                                                    <div class="upload-container">
                                                        <input type="file" class="form-control" name="banner" id="banner" required />
                                                    </div>
                                                    <?php if (!empty($data->banner)): ?>
                                                        <div class="mt-2">
                                                            <img src="<?= htmlspecialchars($data->banner) ?>" alt="Ảnh sự kiện" class="img-thumbnail" style="max-width: 200px;">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="puliik">
                                                <p>Thông tin sự kiện</p>
                                                <div class="mb-3 ">  
                                                    <label for="generalInfo" class="form-label">Giới thiệu chung</label>
                                                    <textarea class="form-control" name="info" id="generalInfo" rows="10"><?php echo $data->info?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="details" class="form-label">Thông tin lưu ý</label>
                                                    <textarea class="form-control" id="details" rows="3">Thêm lưu ý cho sự kiện</textarea>
                                                </div>
                                            </div>
                                            <!-- Sponsor Information -->
                                            <div class="mb-3">
                                                <label for="sponsor" class="form-label">Nhà tài trợ của sự kiện</label>
                                                <div class="row-fn d-flex ">
                                                    <input type="text" class="form-control col-lg-9" id="sponsor">
                                                    <a href="" class="col-lg-3 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm tổ chức</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                ...
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Date and Contact -->
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="startDate" class="form-label">Ngày diễn ra sự kiện</label>
                                                    <input type="date" class="form-control" id="startDate" value="2023-03-25">
                                                </div>
                                                <div class="col">
                                                    <label for="endDate" class="form-label">Ngày kết thúc sự kiện</label>
                                                    <input type="date" class="form-control" id="endDate" value="2023-03-25">
                                                </div>
                                            </div>

                                            <!-- Contact Information -->
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="contactName" class="form-label">Tên tổ chức nhà tài trợ</label>
                                                    <input type="text" class="form-control" id="contactName" value="07987937568">
                                                </div>
                                                <div class="col">
                                                    <label for="contactPhone" class="form-label">Địa chỉ liên hệ</label>
                                                    <input type="text" class="form-control" id="contactPhone" value="07987937568">
                                                </div>
                                            </div>

                                            <!-- Notes -->
                                            <div class="mb-3">
                                                <label for="additionalNotes" class="form-label">Ghi chú khác</label>
                                                <textarea class="form-control" id="additionalNotes" rows="3">Thêm ghi chú của sự kiện</textarea>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="btn d-flex">
                                                <button type="submit">Xóa sự kiện</button>
                                                <button type="submit">lưu chỉnh sửa</button>
                                            </div>
                                    </form>
                                </div>

                                <!-- Ticket Section (hidden by default) -->
                                <div id="ticket-section" style="display: none;">
                                    <h2>Thông tin Vé mới</h2>
                                    <p>Chức năng thêm vé mới hiện đang được phát triển...</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu1">
                            <section>
                                <div class="container mt-5">
                                    <div class="cardd">
                                        <!-- Wrapper for "Thông tin vé mời" -->
                                        <div class="mb-4">
                                            <h5 class="card-title">Thông tin vé mời</h5>
                            
                                            <!-- Form Row for Tên vé mời with Toggle -->
                                            <div class="row mb-3 align-items-center">
                                                <div class="col-lg-8">
                                                    <div class="btn-img mb-4">
                                                        <div class="upload-container">
                                                            <input type="text" id="event-image" value="Sukien1.jpg" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 d-flex align-items-center">
                                                    <!-- Toggle Switch -->
                                                    <label class="form-check-label me-2" for="toggleSwitch">Kích hoạt</label>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="toggleSwitch">
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <!-- Form Group for Mẫu and Link -->
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label for="eventLink" class="form-label">Đây là đường link của vé mời:</label>
                                                    <input type="text" class="form-control" id="eventLink" value="https://www.vemoi.net/share/tao-theme/thiep-1/">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label for="eventSample" class="form-label">Mẫu vé mời</label>
                                                    <input type="text" class="form-control" id="eventSample" value="Vemoi1.jpg">
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="d-grid mb-4">
                                            <a href="#" class="btn btn-danger">Tải vé mời</a>
                                        </div>
                            
                                        <!-- Image Section with two columns -->
                                        <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#image" role="tab" aria-controls="image" aria-selected="true">Ảnh đại diện</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#text1" role="tab" aria-controls="text1" aria-selected="false">Text chữ 1</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#text2" role="tab" aria-controls="text2" aria-selected="false">Text chữ 2</a>
                                            </li>
                                        </ul>
                            
                                        <div class="tab-content mt-3" id="myTabContent">
                                            <!-- Image Upload Tab -->
                                            <div class="tab-pane fade show active" id="image" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <!-- Left Column (Image Upload and Adjustment) -->
                                                    <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <div class="btn-img mb-4">
                                                            <div class="upload-container">
                                                                <input type="file" id="upload-input" accept="image/*" />
                                                                <label class="upload-button" for="upload-input">Tải ảnh</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="d-grid">
                                                            <a href="#" class="btn btn-primary">Tải ảnh khách hàng</a>
                                                        </div>
                                                        <!-- Image Size Adjustment Section -->
                                                        <div class="image-size-adjust mt-4">
                                                            <div class="columnn">
                                                                <div class="size-control mb-3">
                                                                    <label for="horizontalRange" class="form-label">Chiều ngang</label>
                                                                    <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                </div>
                                                                <div class="size-control mb-3">
                                                                    <label for="verticalRange" class="form-label">Chiều dọc</label>
                                                                    <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                </div>
                                                                <div class="size-control mb-3">
                                                                    <label for="zoomRange" class="form-label">Zoom</label>
                                                                    <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                </div>
                                                                <div class="size-control">
                                                                    <label for="aspectRatioRange" class="form-label">Tỷ lệ ảnh</label>
                                                                    <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                            
                                                    <!-- Right Column (Image Preview) -->
                                                    <div class="col-lg-6">
                                                        <div class="mt-3">
                                                            <img src="../asset/image/anhdep.jpg" class="img-fluid" id="previewImage" alt="Image Preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <!-- Text Tabs (Text1, Text2) -->
                                            <div class="tab-pane fade" id="text1" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="container my-5">
                                                    <div class="row">
                                                        <!-- Form Section -->
                                                        <div class="col-md-6">
                                                            <div class="form-section">
                                                                <h5 class="mb-3">Text 1</h5>
                                                                <!-- Text Input -->
                                                                <div class="mb-3">
                                                                    <label for="customerName" class="form-label">Tên khách hàng</label>
                                                                    <input type="text" id="customerName" class="form-control" value="VŨ TUYẾN HOÀNG">
                                                                </div>
                                                
                                                                <!-- Font Selection and Font Size in one row -->
                                                                <div class="d-flex mb-3">
                                                                    <div class="me-2 w-50">
                                                                        <label for="fontSelect" class="form-label">Font chữ</label>
                                                                        <select id="fontSelect" class="form-select">
                                                                            <option value="SVN-Gotham Bold" selected>SVN-Gotham Bold</option>
                                                                            <option value="Arial">Arial</option>
                                                                            <option value="Times New Roman">Times New Roman</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="w-50">
                                                                        <label for="fontSize" class="form-label">Cỡ chữ</label>
                                                                        <select id="fontSize" class="form-select">
                                                                            <option value="14" selected>14</option>
                                                                            <option value="16">16</option>
                                                                            <option value="18">18</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                
                                                                <!-- Font Color and Opacity (độ đậm nhạt) in one row -->
                                                                <div class="d-flex mb-3">
                                                                    <div class="me-2 w-50">
                                                                        <label for="fontColor" class="form-label">Màu chữ</label>
                                                                        <input type="color" id="fontColor" class="form-control form-control-color" value="#111827">
                                                                    </div>
                                                                    <div class="d-block w-50">
                                                                        <label for="fontOpacity" class="form-label">Độ đậm/nhạt</label>
                                                                        <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                    </div>
                                                                </div>
                                                
                                                                <!-- Text Alignment (Căn lề) Radio Buttons in one row -->
                                                                <div class="d-flex mb-3 align-items-center justify-content-between">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="textAlign" id="leftAlign" value="left" checked>
                                                                        <label class="form-check-label" for="leftAlign">Căn lề</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="textAlign" id="leftAlign" value="left" checked>
                                                                        <label class="form-check-label" for="leftAlign">Căn trái</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="textAlign" id="rightAlign" value="right">
                                                                        <label class="form-check-label" for="rightAlign">Căn phải</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="textAlign" id="centerAlign" value="center">
                                                                        <label class="form-check-label" for="centerAlign">Căn giữa</label>
                                                                    </div>
                                                                </div>
                                                
                                                                <!-- Chiều ngang (Horizontal Scale) and Input together in one row -->
                                                                <div class="mb-3">
                                                                    <div class="columnn">
                                                                        <div class="d-flex justify-content-between me-2 w-100">
                                                                            <label for="horizontalScale" class="form-label">Chiều ngang</label>
                                                                            <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                        </div>
                                                                        <div class="d-flex justify-content-between w-100">
                                                                            <label for="verticalScale" class="form-label">Chiều dọc</label>
                                                                            <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                
                                                            </div>
                                                        </div>
                                                
                                                        <!-- Preview Section -->
                                                        <div class="col-md-6">
                                                            <div class="preview-box">
                                                                <img class="w-100" src="../asset/image/brg-vt.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="tab-pane fade" id="text2" role="tabpanel" aria-labelledby="contact-tab">
                                                <div class="tab-pane fade" id="text1" role="tabpanel" aria-labelledby="profile-tab">
                                                    <div class="container my-5">
                                                        <div class="row">
                                                            <!-- Form Section -->
                                                            <div class="col-md-6">
                                                                <div class="form-section">
                                                                    <h5 class="mb-3">Text 1</h5>
                                                                    <!-- Text Input -->
                                                                    <div class="mb-3">
                                                                        <label for="customerName" class="form-label">Tên khách hàng</label>
                                                                        <input type="text" id="customerName" class="form-control" value="VŨ TUYẾN HOÀNG">
                                                                    </div>
                                                    
                                                                    <!-- Font Selection and Font Size in one row -->
                                                                    <div class="d-flex mb-3">
                                                                        <div class="me-2 w-50">
                                                                            <label for="fontSelect" class="form-label">Font chữ</label>
                                                                            <select id="fontSelect" class="form-select">
                                                                                <option value="SVN-Gotham Bold" selected>SVN-Gotham Bold</option>
                                                                                <option value="Arial">Arial</option>
                                                                                <option value="Times New Roman">Times New Roman</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="w-50">
                                                                            <label for="fontSize" class="form-label">Cỡ chữ</label>
                                                                            <select id="fontSize" class="form-select">
                                                                                <option value="14" selected>14</option>
                                                                                <option value="16">16</option>
                                                                                <option value="18">18</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                    
                                                                    <!-- Font Color and Opacity (độ đậm nhạt) in one row -->
                                                                    <div class="d-flex mb-3">
                                                                        <div class="me-2 w-50">
                                                                            <label for="fontColor" class="form-label">Màu chữ</label>
                                                                            <input type="color" id="fontColor" class="form-control form-control-color" value="#111827">
                                                                        </div>
                                                                        <div class="d-block w-50">
                                                                            <label for="fontOpacity" class="form-label">Độ đậm/nhạt</label>
                                                                            <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                        </div>
                                                                    </div>
                                                    
                                                                    <!-- Text Alignment (Căn lề) Radio Buttons in one row -->
                                                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="textAlign" id="leftAlign" value="left" checked>
                                                                            <label class="form-check-label" for="leftAlign">Căn lề</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="textAlign" id="leftAlign" value="left" checked>
                                                                            <label class="form-check-label" for="leftAlign">Căn trái</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="textAlign" id="rightAlign" value="right">
                                                                            <label class="form-check-label" for="rightAlign">Căn phải</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="textAlign" id="centerAlign" value="center">
                                                                            <label class="form-check-label" for="centerAlign">Căn giữa</label>
                                                                        </div>
                                                                    </div>
                                                    
                                                                    <!-- Chiều ngang (Horizontal Scale) and Input together in one row -->
                                                                    <div class="mb-3">
                                                                        <div class="columnn">
                                                                            <div class="d-flex justify-content-between me-2 w-100">
                                                                                <label for="horizontalScale" class="form-label">Chiều ngang</label>
                                                                                <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                            </div>
                                                                            <div class="d-flex justify-content-between w-100">
                                                                                <label for="verticalScale" class="form-label">Chiều dọc</label>
                                                                                <input type="range" id="widthRange" min="0" max="100" value="50">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                    
                                                                </div>
                                                            </div>
                                                    
                                                            <!-- Preview Section -->
                                                            <div class="col-md-6">
                                                                <div class="preview-box">
                                                                    <img class="w-100" src="../asset/image/brg-vt.jpg" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="d-flex justify-content-between custom-btn-container mt-4">
                                            <!-- Nút Trở lại -->
                                            <a href="#" class="btn btn-secondary">Trở lại</a>
                                            <!-- Nút Lưu chỉnh sửa -->
                                            <a href="#" class="btn btn-success">Lưu chỉnh sửa</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
         
    </main>
        
<?php getFooter();?>