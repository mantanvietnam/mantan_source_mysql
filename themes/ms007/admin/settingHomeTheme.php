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
                          PHẦN ĐẦU
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          PHẦN HƯỚNG DẪN
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                          PHẦN GIỚI THIỆU
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                         PHẦN DỊCH VỤ
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                         PHẦN TIN TỨC
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contac" aria-controls="navs-top-image" aria-selected="false">
                          PHẦN LIÊN HỆ
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
                  <label class="form-label" for="basic-default-fullname">Tiêu đề chữ trắng</label>
                   <input type="text" class="form-control" name="title_top" value="<?php echo @$data['title_top'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề chữ vàng</label>
                   <input type="text" class="form-control" name="full_name" value="<?php echo @$data['full_name'];?>" />
                </div>
               
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Nội dung 1 </label>
                   <input type="text" class="form-control" name="content_top1" value="<?php echo @$data['content_top1'];?>" />
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">link đăng ký </label>
                   <input type="text" class="form-control" name="link1" value="<?php echo @$data['link1'];?>" />
                </div>
                 
               
                </div>
              </div>

              <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh NỀN 1</label>
                    <?php showUploadFile('image_hd1','image_hd1', @$data['image_hd1'],4);?>
                    <label class="form-label" for="basic-default-fullname">tiêu đề chú tráng 1</label>
                    <input type="text" class="form-control" name="title_hd1" value="<?php echo @$data['title_hd1'];?>" />
                    <label class="form-label" for="basic-default-fullname">tiêu đề váng 1</label>
                    <input type="text" class="form-control" name="title_hdv1" value="<?php echo @$data['title_hdv1'];?>" />
                    <label class="form-label" for="basic-default-fullname">nội dung 2</label>
                    <input type="text" class="form-control" name="content_hd1" value="<?php echo @$data['content_hd1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh NỀN 2</label>
                    <?php showUploadFile('image_hd2','image_hd2', @$data['image_hd2'],5);?>
                    <label class="form-label" for="basic-default-fullname">tiêu đề chú tráng 2</label>
                    <input type="text" class="form-control" name="title_hd2" value="<?php echo @$data['title_hd2'];?>" />
                    <label class="form-label" for="basic-default-fullname">tiêu đề váng 2</label>
                    <input type="text" class="form-control" name="title_hdv2" value="<?php echo @$data['title_hdv2'];?>" />
                    <label class="form-label" for="basic-default-fullname">nội dung 2</label>
                    <input type="text" class="form-control" name="content_hd2" value="<?php echo @$data['content_hd2'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh NỀN 3</label>
                    <?php showUploadFile('image_hd3','image_hd3', @$data['image_hd3'],6);?>
                    <label class="form-label" for="basic-default-fullname">tiêu đề chú tráng 1</label>
                    <input type="text" class="form-control" name="title_hd3" value="<?php echo @$data['title_hd3'];?>" />
                    <label class="form-label" for="basic-default-fullname">tiêu đề váng 3</label>
                    <input type="text" class="form-control" name="title_hdv3" value="<?php echo @$data['title_hdv3'];?>" />
                    <label class="form-label" for="basic-default-fullname">nội dung 3</label>
                    <input type="text" class="form-control" name="content_hd3" value="<?php echo @$data['content_hd3'];?>" />
                  </div>

                </div>
              </div>

              <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ vàng</label>
                    <input type="text" class="form-control" name="title_gt1" value="<?php echo @$data['title_gt1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ đen</label>
                    <input type="text" class="form-control" name="title_gt2" value="<?php echo @$data['title_gt2'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                    <!-- <textarea class="form-control" name="content2" rows="5"><?php echo @$setting['content2'] ?></textarea> -->
                    <?php showEditorInput('content2', 'content2', @$data['content2']);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Ảnh châm dung</label>
                     <?php showUploadFile('image_portrait1','image_portrait1', @$data['image_portrait1'],7);?>
                     <label class="form-label" for="basic-default-fullname">phần bên dưới giới thiệu</label><br>
                     <label class="form-label" for="basic-default-fullname">Tiêu đề chữ đen</label>
                    <input type="text" class="form-control" name="title_bd1" value="<?php echo @$data['title_bd1'];?>" />
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ vàng</label>
                    <input type="text" class="form-control" name="title_bd2" value="<?php echo @$data['title_bd2'];?>" />
                    <label class="form-label" for="basic-default-fullname">nội dung</label>
                    <input type="text" class="form-control" name="content_bd" value="<?php echo @$data['content_bd'];?>" />
                    <label class="form-label" for="basic-default-fullname">Link đăng liên hệ</label>
                    <input type="text" class="form-control" name="link2" value="<?php echo @$data['link2'];?>" />
                    <label class="form-label" for="basic-default-fullname">Link đăng ký</label>
                    <input type="text" class="form-control" name="link3" value="<?php echo @$data['link3'];?>" />
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ trắng</label>
                   <input type="text" class="form-control" name="title_dv1" value="<?php echo @$data['title_dv1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ vàng</label>
                   <input type="text" class="form-control" name="title_dvv1" value="<?php echo @$data['title_dvv1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">nội dung dưới</label>
                   <input type="text" class="form-control" name="content_dv" value="<?php echo @$data['content_dv'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">tiêu đề dịch vụ 1</label>
                    <input type="text" class="form-control" name="service1" value="<?php echo @$data['service1'];?>" />
                    <label class="form-label" for="basic-default-fullname">nội dung 1</label>
                    <textarea class="form-control" name="content_dv1"><?php echo @$data['content_dv1'];?></textarea>
                    <label class="form-label" for="basic-default-fullname">Link đăng ký 1</label>
                    <input type="text" class="form-control" name="linkdv1" value="<?php echo @$data['linkdv1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">tiêu đề dịch vụ 2</label>
                    <input type="text" class="form-control" name="service2" value="<?php echo @$data['service2'];?>" />
                    <label class="form-label" for="basic-default-fullname">nội dung 2</label>
                    <textarea class="form-control" name="content_dv2"><?php echo @$data['content_dv2'];?></textarea>
                    <label class="form-label" for="basic-default-fullname">Link đăng ký 2</label>
                    <input type="text" class="form-control" name="linkdv2" value="<?php echo @$data['linkdv2'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">tiêu đề dịch vụ 3</label>
                    <input type="text" class="form-control" name="service3" value="<?php echo @$data['service3'];?>" />
                    <label class="form-label" for="basic-default-fullname">nội dung 3</label>
                    <textarea class="form-control" name="content_dv3"><?php echo @$data['content_dv3'];?></textarea>
                    <label class="form-label" for="basic-default-fullname">Link đăng ký 1</label>
                    <input type="text" class="form-control" name="linkdv3" value="<?php echo @$data['linkdv3'];?>" />
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ đen</label>
                   <input type="text" class="form-control" name="title_tt1" value="<?php echo @$data['title_tt1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ vàng</label>
                   <input type="text" class="form-control" name="title_ttv1" value="<?php echo @$data['title_ttv1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                   <input type="text" class="form-control" name="content_tt" value="<?php echo @$data['content_tt'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Id danh mục bài viết</label>
                   <input type="text" class="form-control" name="id_post" value="<?php echo @$data['id_post'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">ảnh trang bài viết</label>
                   <?php showUploadFile('image_post','image_post', @$data['image_post'],8);?>
                  </div>
                </div>
              </div>
              
              <div class="tab-pane fade" id="navs-top-contac" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">ảnh bên phải</label>
                   <?php showUploadFile('image_contac','image_contac', @$data['image_contac'],9);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ trăng</label>
                   <input type="text" class="form-control" name="title_lh" value="<?php echo @$data['title_lh'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chữ vàng</label>
                   <input type="text" class="form-control" name="title_lhv" value="<?php echo @$data['title_lhv'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung chữ trắng</label>
                   <input type="text" class="form-control" name="content_lh" value="<?php echo @$data['content_lh'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung chữ vàng</label>
                   <input type="text" class="form-control" name="content_lhv" value="<?php echo @$data['content_lhv'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">ảnh nên chân trang</label>
                    <?php showUploadFile('banner4','banner4', @$data['banner4'],10);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">facebook</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo @$data['facebook'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">messenger</label>
                    <input type="text" class="form-control" name="messenger" value="<?php echo @$data['messenger'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung chữ trắng</label>
                    <input type="text" class="form-control" name="tiktok" value="<?php echo @$data['tiktok'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">youtube</label>
                    <input type="text" class="form-control" name="youtube" value="<?php echo @$data['youtube'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label" for="basic-default-fullname">zalo</label>
                    <input type="text" class="form-control" name="zalo" value="<?php echo @$data['zalo'];?>" />
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

