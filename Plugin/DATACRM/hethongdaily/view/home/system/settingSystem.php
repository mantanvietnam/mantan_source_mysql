<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/settingSystem">Hệ thống</a> /</span>
    Đổi thông tin
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Đổi thông tin</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-12">
                  <div class=" mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Quy định điểm
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tên hệ thống (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>"/>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Logo (*)</label>
                              <?php showUploadFile('image','image',@$data->image,0);?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Yêu cầu xác thực OTP</label>
                              <select class="form-select color-dropdown" name="keyword" id="keyword">
                                <option value="">Cần xác thực</option>
                                <option value="1" <?php if(!empty($data->keyword)) echo 'selected';?> >Không xác thực</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Đổi điểm hạng thành viên <span style=" font-family: sans-serif; text-transform: lowercase; ">(Bao nhiêu tiền thì đổi được 1 điểm tích luỹ?)</span> </label>
                              <input  type="text" class="form-control phone-mask" name="convertPoint" id="convertPoint" value="<?php echo @$data->convertPoint;?>"/>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Số lượng bản xuất file Mật mã thành công tối đa cho cả hệ thống </label>
                              <input  type="text" disabled="" class="form-control phone-mask" name="maxExport" id="maxExport" value="<?php echo @$maxExport;?>"/>
                            </div>
                          </div> 
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Số lượng bản xuất file Mật mã thành công cả hệ thống đã xuất</label>
                              <input  type="text" disabled="" class="form-control phone-mask" name="numberExport" id="numberExport" value="<?php echo @$numberExport;?>"/>
                            </div>
                          </div> 
                      
                         <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Số lượng bản xuất file Mật mã thành công tối đa cho từng khách hàng</label>
                              <input  type="text" class="form-control phone-mask" name="max_export_mmtc" id="max_export_mmtc" value="<?php echo @$data->max_export_mmtc;?>"/>
                            </div>
                          </div> 
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Giá xuất file Mật mã thành công </label>
                              <input  type="number" class="form-control phone-mask" name="price_export_mmtc" id="price_mmtc" value="<?php echo @$data->price_export_mmtc;?>"/>
                            </div>
                          </div> 
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Giới thiệu người dùng mới</label>
                            <input type="text" class="form-control phone-mask" name="point_introduce_user" id="point_introduce_user" value="<?php echo @$data->point_introduce_user;?>"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Đăng bài lên mxh</label>
                            <input type="text" class="form-control phone-mask" name="point_wall_post" id="point_wall_post" value="<?php echo @$data->point_wall_post;?>"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Ý kiến phản hồi</label>
                            <input type="text" class="form-control phone-mask" name="point_feedback" id="point_feedback" value="<?php echo @$data->point_feedback;?>"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Xuất thần số học cho người khác</label>
                            <input type="text" class="form-control phone-mask" name="point_expor_numerology" id="point_expor_numerology" value="<?php echo @$data->point_expor_numerology;?>"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Nạp tiền thành công</label>
                            <input type="text" class="form-control phone-mask" name="point_deposit_money" id="point_deposit_money" value="<?php echo @$data->point_deposit_money;?>"/>
                          </div>
                           <div class="mb-3 col-md-6">
                            <label class="form-label">Hoàn thành bài thi trắc nghiệm</label>
                            <input type="text" class="form-control phone-mask" name="point_complete_quiz" id="point_complete_quiz" value="<?php echo @$data->point_complete_quiz;?>"/>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>v

<?php include(__DIR__.'/../footer.php'); ?>