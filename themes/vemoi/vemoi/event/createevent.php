<?php 
    getHeader();
    global $session;
    $info = $session->read('infoUser');
?>

<main>
        <div class="register">
            <div class="container d-flex align-items-center">
                <div class="back d-flex">
                    <a href="./event.html"><i class="fa-solid fa-chevron-left"></i></a>
                    <p>Tạo sự kiện</p>
                </div>
            </div>
        </div>

        <section class="form-section__create-event">
            <div class="form-container">
                <form method="POST" id="eventForm" action="" enctype="multipart/form-data">
                    <?php echo $mess;?>
                    <!-- Event Information -->
                    <div class="form-section">
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                        <?php if(!empty($info['id'])) :?>
                            <input type="hidden" value="<?php echo $info['id'];?>" name="id_member">
                        <?php endif?>
                        <input type="hidden" value="active" name="status">
                        <label for="event-name" class="form-label" >Tên sự kiện*</label>
                        <input type="text" name="name" id="event-name" class="form-control" placeholder="Nhập tên sự kiện" required>
                    </div>
            
                    <div class="form-section">
                        <div class="upload-wrapper">
                            <label for="event-image">Ảnh sự kiện</label>
                            <div class="upload-container">
                                <input type="file" class="form-control phone-mask" name="banner" id="image" value="" required />
                            </div>
                        </div>
                    </div>
<!--        
                    <div class="container my-4">
                        <div class="row gx-3 d-flex justify-content-between">
               
                            <div class="col-lg-6 d-flex">
                                <div class="event-card p-3 d-flex flex-column align-items-start position-relative w-100">
                                    <input type="radio" id="live-event" name="address" checked class="radio-input">
                                    <label for="live-event" class="d-flex flex-column w-100">
                                        <i class="fas fa-user-circle event-icon mb-2"></i>
                                        <div class="">
                                            <span class="d-block event-title">Tổ chức sự kiện trực tiếp</span>
                                            <small class="text-muted">Lorem ipsum dolor sit amet. Quo mollitia illo ea galisum esse cum temporibus voluptates et nobis numquam.</small>
                                        </div>
                                 
                                        <div class="radio-circle"></div>
                                    </label>
                                </div>
                            </div>
                  
                            <div class="col-lg-6 d-flex">
                                <div class="event-card p-3 d-flex flex-column align-items-start position-relative w-100">
                                    <input type="radio" id="online-event" name="address" class="radio-input">
                                    <label for="online-event" class="d-flex flex-column w-100">
                                        <i class="fas fa-wifi event-icon mb-2"></i>
                                        <div class="">
                                            <span class="d-block event-title">Tổ chức sự kiện trực tuyến qua ZOOM, MEET</span>
                                            <small class="text-muted">Lorem ipsum dolor sit amet. Quo mollitia illo ea galisum esse cum temporibus voluptates et nobis numquam.</small>
                                        </div>
                                    
                                        <div class="radio-circle"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
-->
                     <p class="information">Thông tin sự kiện</p>
                    <div class="form-section mb-4">
                        <label for="event-description" class="form-label">Giới thiệu chung</label>
                        <textarea id="event-description" class="form-control" name="info" rows="2" placeholder="Thêm ghi chú của sự kiện"></textarea>
                    </div>
                    <div class="form-section mb-4">
                        <label for="event-description" class="form-label" required>Địa chỉ</label>
                        <input id="event-description" name="address" class="form-control" placeholder="địa chỉ"></input>
                    </div>
                    <div class="form-section mb-4">
                        <label for="event-description" class="form-label">Thời gian bắt đầu</label>
                        <input id="event-description" type="datetime-local" name="time_start" class="form-control" required>
                    </div>
                    <div class="form-section mb-4">
                        <label for="event-notes" class="form-label">Thông tin lưu ý</label>
                        <textarea id="event-notes" class="form-control" rows="2" placeholder="Thông tin lưu ý"></textarea>
                    </div>

                    <label for="sponsor" class="form-label">Nhà tài trợ sự kiện*</label>
                    <div class="form-section d-flex gap-4">
                        <div class="col-lg-9">
                            <input type="text" id="sponsor" class="form-control" >
                        </div>
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-danger">+ Thêm tổ chức</button>
                        </div>
                    </div>
            
                    <!-- Invitation Details -->
                    <div class="container my-5">
                        <div class="card p-4">
                            <h2 class="mb-4">Thông tin vé mời</h2>
                            
                            <!-- Invitation Details -->
                            <div class="mb-3">
                                <label for="invite-title" class="form-label">Tên vé mời</label>
                                <input type="text" id="invite-title" class="form-control" value="Thiệp 1">
                            </div>
                
                            <div class="mb-3">
                                <label for="invite-url" class="form-label">Đây là đường link của vé mời</label>
                                <input type="text" id="invite-url" class="form-control" value="https://www.example.com/invite">
                            </div>
                
                            <!-- Mẫu vé mời label on its own row -->    
                            <div class="mb-3">
                                <label for="invite-img" class="form-label">Mẫu vé mời</label>
                            </div>
                
                            <!-- Input and Buttons on the same row -->
                            <div class="form-wrapper">
                                <h2>Mẫu vé mời *</h2>
                                <div class="file-input">
                                    <input type="text" class="form-control" value="Vemoi1.jpg" readonly>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-danger" type="button">Tải vé mời</button>
                                    <button class="btn btn-primary" type="button">Xem trước vé mời</button>
                                </div>
                            </div>
                        
                
                            <!-- Event Date Details (2 columns) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="event-start-date" class="form-label">Ngày diễn ra sự kiện</label>
                                    <input type="date" id="event-start-date" class="form-control" value="2023-03-23">
                                </div>
                                <div class="col-md-6">
                                    <label for="event-end-date" class="form-label">Ngày kết thúc sự kiện</label>
                                    <input type="date" id="event-end-date" class="form-control" value="2023-03-23">
                                </div>
                            </div>
                
                            <!-- Event Location (2 columns) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="event-location" class="form-label">Tên tòa nhà tổ chức sự kiện</label>
                                    <input type="text" id="event-location" class="form-control" value="0789373568">
                                </div>
                                <div class="col-md-6">
                                    <label for="event-address" class="form-label">Địa chỉ cụ thể</label>
                                    <input type="text" id="event-address" class="form-control" value="0789373568">
                                </div>
                            </div>
                
                            <!-- Notes (full width) -->
                            <div class="mb-3">
                                <label for="event-notes" class="form-label">Ghi chú khác</label>
                                <input type="text" id="event-notes" class="form-control" placeholder="Thêm ghi chú của sự kiện">
                            </div>
                        </div>
                    </div>
                
                
                    <!-- Action Buttons -->
                    <div class="form-section">
                        <div class="d-flex justify-content-center gap-4">
                            <button type="button" class="btn btn-outline-danger btn-huy">Hủy tạo</button>
                            <button type="submit" class="taosukien" id="submitBtn">Tạo sự kiện</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <div class="modal fade" id="modelshow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="top: 28%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <img src="<?php echo $urlThemeActive; ?>/asset/image/Illustration.jpg" alt="Illustration">
                    </div>
                    <div class="modal-body">
                        <p id="popupMessage"><?= isset($mess) ? $mess : ''; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Chi tiết vé mời</button>
                        <button type="button" style="border: 1px solid black;" class="btn bg-light" data-bs-dismiss="modal" onclick="window.history.back();">Để sau</button>
                    </div>
                </div>
            </div>
        </div>


    </main>
 <script>
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    // Kiểm tra xem có tham số error=create_done không
    if (urlParams.get('error') === 'create_done') {
        // Hiển thị modal với thông báo thành công
        document.getElementById('popupMessage').innerHTML = 'Bạn đã tạo sự kiện và vé mời thành công. Hãy cùng chia sẻ sự kiện đến với mọi người.';
        var myModal = new bootstrap.Modal(document.getElementById('modelshow'));
        myModal.show();
    }

    // Kiểm tra nếu có tham số error=create_failed (lỗi khi gửi dữ liệu)
    if (urlParams.get('error') === 'create_failed') {
        // Hiển thị modal với thông báo lỗi
        document.getElementById('popupMessage').innerHTML = 'Gửi thiếu dữ liệu. Vui lòng thử lại.';
        var myModal = new bootstrap.Modal(document.getElementById('modelshow'));
        myModal.show();
    }
};




 </script>
<script>
document.getElementById('file-upload').addEventListener('change', function() {
    const fileName = this.files[0] ? this.files[0].name : '';
    if (fileName) {
        document.getElementById('event-image').value = fileName;
    }
});
</script>

<?php getFooter();?>