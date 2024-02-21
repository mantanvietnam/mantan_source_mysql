<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="mb-4">
            <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          KHỐI ĐẦU
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          KHỐI GIỚI THIỆU
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                          DỊCH VỤ
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                         HÌNH ẢNH CÁ NHÂN
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                         PHẢN HỒI
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-evaluate" aria-controls="navs-top-image" aria-selected="false">
                          KHÓA HỌC
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contac" aria-controls="navs-top-image" aria-selected="false">
                          LIÊN HỆ
                        </button>
                      </li>
                    </ul>
       
            <div class="card-body tab-content ">
              <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                <div class="card-body row ">
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                   <?php showUploadFile('logo','logo', @$data['logo'],1);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Ảnh nều khối đầu</label>
                   <?php showUploadFile('background_top','background_top', @$data['background_top'],2);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                   <input type="text" class="form-control" name="full_name" value="<?php echo @$data['full_name'];?>" />
                </div>
                <!-- <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                  <label class="form-label" for="basic-default-fullname">Nội dung top </label>
                  <?php showEditorInput('content_top', 'content_top', @$data['content_top']);?>
                </div> -->
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Nội dung 1 </label>
                   <input type="text" class="form-control" name="content_top1" value="<?php echo @$data['content_top1'];?>" />
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Nội dung 2 </label>
                   <input type="text" class="form-control" name="content_top2" value="<?php echo @$data['content_top2'];?>" />
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Ảnh chân dung</label>
                   <?php showUploadFile('image_Portrait','image_Portrait', @$data['image_Portrait'],3);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Mã video youtube</label>
                   <input type="text" class="form-control" name="code_videoyoutube" value="<?php echo @$data['code_videoyoutube'];?>" />
                </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                <div class="row">
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Tên diễn giả</label>
                  <input type="text" class="form-control" name="speaker_name" value="<?php echo @$data['speaker_name'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Ảnh chân dung</label>
                  <?php showUploadFile('image_Portrait2','image_Portrait2', @$data['image_Portrait2'],4);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                  <?php showUploadFile('background_2','background_2', @$data['background_2'],5);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Giới thiệu</label>
                  <textarea class="form-control" name="content_2"><?php echo @$data['content_2'];?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Emall</label>
                  <input type="text" class="form-control" name="email" value="<?php echo @$data['email'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Số điện thoại</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo @$data['phone'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                  <input type="text" class="form-control" name="address" value="<?php echo @$data['address'];?>" />
                </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
                <div class="row">
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Icon 1 </label>
                  <input type="text" class="form-control" name="icon1" value="<?php echo @$data['icon1'];?>" />
                  <label class="form-label" for="basic-default-fullname">DỊCH vụ 1 </label>
                  <input type="text" class="form-control" name="service1" value="<?php echo @$data['service1'];?>" />
                  <label class="form-label" for="basic-default-fullname">Nội dung 1 </label>
                  <input type="text" class="form-control" name="content_service1" value="<?php echo @$data['content_service1'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Icon 2 </label>
                  <input type="text" class="form-control" name="icon2" value="<?php echo @$data['icon2'];?>" />
                  <label class="form-label" for="basic-default-fullname">DỊCH vụ 2 </label>
                  <input type="text" class="form-control" name="service2" value="<?php echo @$data['service2'];?>" />
                  <label class="form-label" for="basic-default-fullname">Nội dung 2 </label>
                  <input type="text" class="form-control" name="content_service2" value="<?php echo @$data['content_service2'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Icon 3 </label>
                  <input type="text" class="form-control" name="icon3" value="<?php echo @$data['icon3'];?>" />
                  <label class="form-label" for="basic-default-fullname">DỊCH vụ 3 </label>
                  <input type="text" class="form-control" name="service3" value="<?php echo @$data['service3'];?>" />
                  <label class="form-label" for="basic-default-fullname">Nội dung 3 </label>
                  <input type="text" class="form-control" name="content_service3" value="<?php echo @$data['content_service3'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Icon 4 </label>
                  <input type="text" class="form-control" name="icon4" value="<?php echo @$data['icon4'];?>" />
                  <label class="form-label" for="basic-default-fullname">DỊCH vụ 4 </label>
                  <input type="text" class="form-control" name="service4" value="<?php echo @$data['service4'];?>" />
                  <label class="form-label" for="basic-default-fullname">Nội dung 4 </label>
                  <input type="text" class="form-control" name="content_service4" value="<?php echo @$data['content_service4'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Icon 5 </label>
                  <input type="text" class="form-control" name="icon5" value="<?php echo @$data['icon5'];?>" />
                  <label class="form-label" for="basic-default-fullname">DỊCH vụ 5 </label>
                  <input type="text" class="form-control" name="service5" value="<?php echo @$data['service5'];?>" />
                  <label class="form-label" for="basic-default-fullname">Nội dung 5 </label>
                  <input type="text" class="form-control" name="content_service5" value="<?php echo @$data['content_service5'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Icon 6 </label>
                  <input type="text" class="form-control" name="icon6" value="<?php echo @$data['icon6'];?>" />
                  <label class="form-label" for="basic-default-fullname">DỊCH vụ 6 </label>
                  <input type="text" class="form-control" name="service6" value="<?php echo @$data['service6'];?>" />
                  <label class="form-label" for="basic-default-fullname">Nội dung 6 </label>
                  <input type="text" class="form-control" name="content_service6" value="<?php echo @$data['content_service6'];?>" />
                </div>
                
               
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Id album ảnh trên</label>
                    <input type="text" class="form-control" name="id_album1" value="<?php echo @$data['id_album1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <label class="form-label" for="basic-default-fullname">ảnh Nền trên</label>
                      <?php showUploadFile('background_3','background_3', @$data['background_3'],4);?>
                    </div>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Id album ảnh dước</label>
                    <input type="text" class="form-control" name="id_album2" value="<?php echo @$data['id_album2'];?>" />
                  </div>
              </div>
              <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">chữ đỏ</label>
                    <input type="text" class="form-control" name="textred" value="<?php echo @$data['textred'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <label class="form-label" for="basic-default-fullname">ảnh Nền trên</label>
                      <?php showUploadFile('background_4','background_4', @$data['background_4'],5);?>
                    </div>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">chữ trắng</label>
                    <input type="text" class="form-control" name="textwhite" value="<?php echo @$data['textwhite'];?>" />
                  </div>
              </div>
              <div class="tab-pane fade" id="navs-top-evaluate" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">id bàn vết</label>
                    <input type="text" class="form-control" name="id_post" value="<?php echo @$data['id_post'];?>" />
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-contac" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">ảnh Nền trên</label>
                   <?php showUploadFile('background_5','background_5', @$data['background_5'],6);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">ảnh chân dung</label>
                   <?php showUploadFile('image_cd','image_cd', @$data['image_cd'],7);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">facebook</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo @$data['facebook'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">twitter</label>
                    <input type="text" class="form-control" name="twitter" value="<?php echo @$data['twitter'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">instagram</label>
                    <input type="text" class="form-control" name="instagram" value="<?php echo @$data['instagram'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">id bàn vết</label>
                    <input type="text" class="form-control" name="behance" value="<?php echo @$data['behance'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">dribbble</label>
                    <input type="text" class="form-control" name="dribbble" value="<?php echo @$data['dribbble'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">chữ chân trang</label>
                    <input type="text" class="form-control" name="textfooter" value="<?php echo @$data['textfooter'];?>" />
                  </div>
                </div>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary" style="width:75px; height: 35px;">Lưu</button>
              </div>
            </div>
          </div>
        </div>
        </div>

        
      </div>
    <?= $this->Form->end() ?>
</div>

  text-welcome