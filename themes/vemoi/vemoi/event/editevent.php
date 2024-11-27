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
                    <form method="POST"  action="" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                                <!-- Content Section -->
                                <div class="container my-5">
                                    <!-- Event Section -->
                                    <div id="event-section">
                                        
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
                                                            <input type="file" class="form-control" name="banner" id="banner"  />
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
                                                    <div class="mb-3">  
                                                        <label for="generalInfo" class="form-label">Giới thiệu chung</label>
                                                        <textarea class="form-control" name="info" id="generalInfo" rows="10"><?php echo $data->info?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="event-description" class="form-label">Lịch trình</label>
                                                        <textarea id="event-description" class="form-control" name="plan" rows="5" placeholder="Thêm lịch trình sự kiện"><?php echo $data->plan?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="event-description" class="form-label">Quy định tham dự</label>
                                                        <textarea id="event-description" class="form-control" name="rule" rows="5" placeholder="Thêm ghi chú quy định"><?php echo $data->rule?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="event-description" class="form-label">Trang phục</label>
                                                        <textarea id="event-description" class="form-control" name="outfits" rows="5" placeholder="Thêm ghi chú trang phục"><?php echo $data->outfits?></textarea>
                                                    </div>
                                                </div>
                                                <!-- Sponsor Information -->
                                                <div class="mb-3">
                                                  
                                                    <div class="row-fn d-flex ">
                                                   

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
                                                <!-- <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="startDate" class="form-label">Ngày diễn ra sự kiện</label>
                                                        <input type="date" class="form-control" id="startDate" value="2023-03-25">
                                                    </div>
                                                    <div class="col">
                                                        <label for="endDate" class="form-label">Ngày kết thúc sự kiện</label>
                                                        <input type="date" class="form-control" id="endDate" value="2023-03-25">
                                                    </div>
                                                </div> -->

                                                <!-- Contact Information -->
                                                <!-- <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="contactName" class="form-label">Tên tổ chức nhà tài trợ</label>
                                                        <input type="text" class="form-control" id="contactName" value="07987937568">
                                                    </div>
                                                    <div class="col">
                                                        <label for="contactPhone" class="form-label">Địa chỉ liên hệ</label>
                                                        <input type="text" class="form-control" id="contactPhone" value="07987937568">
                                                    </div>
                                                </div> -->

                                                <!-- Notes -->
                                                <!-- <div class="mb-3">
                                                    <label for="additionalNotes" class="form-label">Ghi chú khác</label>
                                                    <textarea class="form-control" id="additionalNotes" rows="3">Thêm ghi chú của sự kiện</textarea>
                                                </div> -->

                                                <!-- Buttons -->
                                                <div class="btn d-flex">
                                                    <button type="submit">Xóa sự kiện</button>
                                                    <button type="submit">lưu chỉnh sửa</button>
                                                </div>
                                        
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
                                             <div class="container my-5">
                                                <div class="card p-4">
                                                    <h2 class="mb-4">Thông tin tạo vé vé mời của Ezpics</h2>
                                                    
                                                    <div class="mb-3">
                                                      <label class="form-label" for="basic-default-phone">Id ảnh in hàng hoạt EZPICS </label>
                                                      <input type="text" class="form-control phone-mask" name="id_ezpics" id="id_ezpics" value="<?php echo @$data->id_ezpics;?>"/>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label class="form-label" for="basic-default-phone">Tên biến họ và tên khách hàng</label>
                                                      <input type="text" class="form-control phone-mask" name="value_name" id="value_name" value="<?php echo @$data->value_name;?>"/>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label class="form-label" for="basic-default-phone">Tên biến avatar khách hàng</label>
                                                      <input type="text" class="form-control phone-mask" name="value_avatar" id="value_avatar" value="<?php echo @$data->value_avatar;?>"/>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label class="form-label" for="basic-default-phone">Tên biến điện thoại khách hàng</label>
                                                      <input type="text" class="form-control phone-mask" name="value_phone" id="value_phone" value="<?php echo @$data->value_phone;?>"/>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label class="form-label" for="basic-default-phone">Tên biến mã check in</label>
                                                      <input type="text" class="form-control phone-mask" name="value_code" id="value_code" value="<?php echo @$data->value_code;?>"/>
                                                    </div>
                                        
                                                    <div class="btn d-flex">
                                                        <button type="submit">lưu chỉnh sửa</button>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
        
         
    </main>
        
<?php getFooter();?>