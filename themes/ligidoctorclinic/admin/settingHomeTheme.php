<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">   Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class=" mb-4">
            <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                         PHẦN ĐẦU
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          PHẦN GIỚI TIỆU
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                          PHẦN DỊCH VỤ
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                        PHẦN CHÂN TRANH
                        </button>
                      </li>
                      
                    </ul>

            <div class="card-body tab-content ">
              <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                <div class="card-body row ">
                  
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Logo</label>
                    <?php showUploadFile('image_logo','image_logo', @$setting['image_logo'],1);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">hotline</label>
                    <input type="text" class="form-control" name="hotline" value="<?php echo @$setting['hotline'];?>" />
                  </div>

                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">banner đầu</label>
                    <?php showUploadFile('banner1','banner1', @$setting['banner1'],2);?>
                  </div>
                </div>
              </div> 

              <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                <div class="card-body row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title1" value="<?php echo @$setting['title1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">link xem thêm</label>
                    <input type="text" class="form-control" name="link1" value="<?php echo @$setting['link1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                    <textarea class="form-control" name="content1"><?php echo @$setting['content1'];?></textarea>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">ảnh </label>
                    <?php showUploadFile('image1','image1', @$setting['image1'],3);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">id album ảnh dưới</label>
                    <input type="text" class="form-control" name="id_album" value="<?php echo @$setting['id_album'];?>" />
                  </div>
                </div>
              </div> 

              <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title2" value="<?php echo @$setting['title2'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Id danh mục bài viết dịch vụ</label>
                    <input type="text" class="form-control" name="id_service" value="<?php echo @$setting['id_service'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung dưới tiêu đề</label>
                    <textarea class="form-control" name="content2"><?php echo @$setting['content2'];?></textarea>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">banner 2</label>
                    <?php showUploadFile('banner2','banner2', @$setting['banner2'],4);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">banner 3</label>
                    <?php showUploadFile('banner3','banner3', @$setting['banner3'],5);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề tin tức</label>
                    <input type="text" class="form-control" name="title3" value="<?php echo @$setting['title3'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Id danh mục bài viết tin tức</label>
                    <input type="text" class="form-control" name="id_post" value="<?php echo @$setting['id_post'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">chữ nhỏ</label>
                    <input type="text" class="form-control" name="content3" value="<?php echo @$setting['content3'];?>" />
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">tên công ty</label>
                    <input type="text" class="form-control" name="company" value="<?php echo @$setting['company'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="<?php echo @$setting['address'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo @$setting['email'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">page Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">link Facebook</label>
                    <input type="text" class="form-control" name="link_facebook" value="<?php echo @$setting['link_facebook'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">id danh mục link liên kết</label>
                    <input type="text" class="form-control" name="id_linkweb" value="<?php echo @$setting['id_linkweb'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">chữ cuối trang</label>
                    <input type="text" class="form-control" name="textfooter" value="<?php echo @$setting['textfooter'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Mã nhúng map</label>
                    <textarea class="form-control" name="map"><?php echo @$setting['map'];?></textarea>
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
    <?= $this->Form->end() ?>
</div>

