<?php 
    getHeader();
    global $session;
    $info = $session->read('infoUser');
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                        <textarea id="event-description" class="form-control" name="info" rows="5" placeholder="Thêm ghi chú của sự kiện"></textarea>
                    </div>
                    <div class="form-section mb-4">
                        <label for="event-description" class="form-label" required>Địa chỉ</label>
                        <input id="event-description" name="address" class="form-control" placeholder="địa chỉ"></input>
                    </div>
                    <div class="form-section mb-4">
                        <label for="datetime-picker" class="form-label">Thời gian bắt đầu</label>
                        <input type="text" id="datetime-picker" class="form-control" placeholder="Chọn ngày và giờ">
                    </div>
                    <div class="form-section mb-4">
                        <label for="event-description" class="form-label">Lịch trình</label>
                        <textarea id="event-description" class="form-control" name="plan" rows="5" placeholder="Thêm lịch trình sự kiện"></textarea>
                    </div>
                    <div class="form-section mb-4">
                        <label for="event-description" class="form-label">Quy định tham dự</label>
                        <textarea id="event-description" class="form-control" name="rule" rows="5" placeholder="Thêm ghi chú quy định"></textarea>
                    </div>
                    <div class="form-section mb-4">
                        <label for="event-description" class="form-label">Trang phục</label>
                        <textarea id="event-description" class="form-control" name="outfits" rows="5" placeholder="Thêm ghi chú trang phục"></textarea>
                    </div>
                
                     <div class="container my-5">
                        <div class="card p-4">
                            <h2 class="mb-4">Thông tin tạo vé vé mời của Ezpics</h2>
                            
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Id ảnh in hàng hoạt EZPICS </label>
                              <input type="text" class="form-control phone-mask" name="id_ezpics" id="id_ezpics" value=""/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Tên biến họ và tên khách hàng</label>
                              <input type="text" class="form-control phone-mask" name="value_name" id="value_name" value=""/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Tên biến avatar khách hàng</label>
                              <input type="text" class="form-control phone-mask" name="value_avatar" id="value_avatar" value=""/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Tên biến điện thoại khách hàng</label>
                              <input type="text" class="form-control phone-mask" name="value_phone" id="value_phone" value=""/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Tên biến mã check in</label>
                              <input type="text" class="form-control phone-mask" name="value_code" id="value_code" value=""/>
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
    $(document).ready(function() {
      $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',  // Định dạng ngày tháng
        todayHighlight: true, // Đánh dấu ngày hiện tại
        autoclose: true       // Tự động đóng Datepicker sau khi chọn ngày
      });

      $('.datetimepicker').datetimepicker({
        format:'H:i d/m/Y'
      });
    });
    </script>

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