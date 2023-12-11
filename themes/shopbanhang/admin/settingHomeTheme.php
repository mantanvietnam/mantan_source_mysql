<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0 form-label">Khối banner</h5>
            </div>
            <div class="card-body row ">
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                   <?php showUploadFile('image_logo','image_logo', @$setting['image_logo'],1);?>
                </div>

                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Thay đổi text menu khuyến mãi</label>
                  <input type="text" class="form-control" name="menu" value="<?php echo @$setting['menu'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">id ảnh slide</label>
                  <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Thời gian Flash Sale </label>
                  <input type="text" name="targetTime" class="form-control hasDatepicker datetimepicker" id="targetTime" value="<?php echo (!empty($setting['targetTime']))?  date("H:i d/m/Y", @$setting['targetTime']) : " " ?>">
                </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Khối ảnh banner nhỏ</label>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Ảnh 1</label>
                   <?php showUploadFile('image1','image1', @$setting['image1'],2);?>
                   <label class="form-label" for="basic-default-fullname">link ảnh 1</label>
                  <input type="text" class="form-control" name="link_nho1" value="<?php echo @$setting['link_nho1'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Ảnh 2</label>
                   <?php showUploadFile('image2','image2', @$setting['image2'],3);?>
                   <label class="form-label" for="basic-default-fullname">link ảnh 2</label>
                  <input type="text" class="form-control" name="link_nho2" value="<?php echo @$setting['link_nho2'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">ảnh 3</label>
                   <?php showUploadFile('image3','image3', @$setting['image3'],4);?>
                   <label class="form-label" for="basic-default-fullname">link ảnh 3</label>
                  <input type="text" class="form-control" name="link_nho3" value="<?php echo @$setting['link_nho3'];?>" />
                </div>

                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Khối ảnh banner chuyên mục sản phẩm</label>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Ảnh 1</label>
                   <?php showUploadFile('image4','image4', @$setting['image4'],5);?>
                   <label class="form-label" for="basic-default-fullname">Ảnh 1 - Mobile</label>
                   <?php showUploadFile('image-mobile','image-mobile', @$setting['image-mobile'],20);?>
                   <label class="form-label" for="basic-default-fullname">link ảnh 1</label>
                  <input type="text" class="form-control" name="link_image1" value="<?php echo @$setting['link_image1'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Ảnh 2</label>
                   <?php showUploadFile('image5','image5', @$setting['image5'],6);?>
                   <label class="form-label" for="basic-default-fullname">link ảnh 2</label>
                  <input type="text" class="form-control" name="link_image2" value="<?php echo @$setting['link_image2'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">ảnh 3</label>
                   <?php showUploadFile('image6','image6', @$setting['image6'],7);?>
                   <label class="form-label" for="basic-default-fullname">link ảnh 3</label>
                  <input type="text" class="form-control" name="link_image3" value="<?php echo @$setting['link_image3'];?>" />
                </div>
                <!-- <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">ảnh 4</label>
                   <?php showUploadFile('image7','image7', @$setting['image7'],8);?>
                   <label class="form-label" for="basic-default-fullname">link ảnh 4</label>
                  <input type="text" class="form-control" name="link_image4" value="<?php echo @$setting['link_image4'];?>" />
                </div> -->
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">id ảnh báo chí</label>
                  <input type="text" class="form-control" name="id_bc" value="<?php echo @$setting['id_bc'];?>" />
                </div>

                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Chân trang</label>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Công ty</label>
                  <input type="text" class="form-control" name="company" value="<?php echo @$setting['company'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                  <input type="text" class="form-control" name="address" value="<?php echo @$setting['address'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Điện thoại</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo @$setting['phone'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Fax</label>
                  <input type="text" class="form-control" name="fax" value="<?php echo @$setting['fax'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Số đăng ký doanh nghiệp</label>
                  <input type="text" class="form-control" name="business" value="<?php echo @$setting['business'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Sở Kế hoạch </label>
                  <input type="text" class="form-control" name="side_plan" value="<?php echo @$setting['side_plan'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Gọi mua</label>
                  <input type="text" class="form-control" name="call_buy" value="<?php echo @$setting['call_buy'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Khiếu nại</label>
                  <input type="text" class="form-control" name="complain" value="<?php echo @$setting['complain'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">id danh mục</label>
                  <input type="text" class="form-control" name="id_category" value="<?php echo @$setting['id_category'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">id dịch vụ</label>
                  <input type="text" class="form-control" name="id_service" value="<?php echo @$setting['id_service'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Youtube</label>
                  <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">instagram</label>
                  <input type="text" class="form-control" name="instagram" value="<?php echo @$setting['instagram'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Tiktok</label>
                  <input type="text" class="form-control" name="email" value="<?php echo @$setting['email'];?>" />
                </div>

                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Link điện thoại</label>
                  <input type="text" class="form-control" name="contact-phone-link" value="<?php echo @$setting['contact-phone-link'];?>" />
                </div>  
                
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Link Zalo</label>
                  <input type="text" class="form-control" name="contact-zalo-link" value="<?php echo @$setting['contact-zalo-link'];?>" />
                </div>   


                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">phần ẢNh combo menu</label>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">ảnh 1 </label>
                  <?php showUploadFile('menu_image1','menu_image1', @$setting['menu_image1'],9);?>
                  <label class="form-label" for="basic-default-fullname">tiên đề 1 </label>
                  <input type="text" class="form-control" name="menu_title1" value="<?php echo @$setting['menu_title1'];?>" />
                  <label class="form-label" for="basic-default-fullname">link 1</label>
                  <input type="text" class="form-control" name="menu_link1" value="<?php echo @$setting['menu_link1'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">ảnh 2 </label>
                  <?php showUploadFile('menu_image2','menu_image2', @$setting['menu_image2'],110);?>
                  <label class="form-label" for="basic-default-fullname">tiên đề 2 </label>
                  <input type="text" class="form-control" name="menu_title2" value="<?php echo @$setting['menu_title2'];?>" />
                  <label class="form-label" for="basic-default-fullname">link 2</label>
                  <input type="text" class="form-control" name="menu_link2" value="<?php echo @$setting['menu_link2'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">ảnh 3 </label>
                  <?php showUploadFile('menuimage3','menu_image3', @$setting['menu_image3'],11);?>
                  <label class="form-label" for="basic-default-fullname">tiên đề 3 </label>
                  <input type="text" class="form-control" name="menu_title3" value="<?php echo @$setting['menu_title3'];?>" />
                  <label class="form-label" for="basic-default-fullname">link 3</label>
                  <input type="text" class="form-control" name="menu_link3" value="<?php echo @$setting['menu_link3'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">ảnh 4 </label>
                  <?php showUploadFile('menu_image4','menu_image4', @$setting['menu_image4'],12);?>
                  <label class="form-label" for="basic-default-fullname">tiên đề 4 </label>
                  <input type="text" class="form-control" name="menu_title4" value="<?php echo @$setting['menu_title4'];?>" />
                  <label class="form-label" for="basic-default-fullname">link 4</label>
                  <input type="text" class="form-control" name="menu_link4" value="<?php echo @$setting['menu_link4'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Khuyến mãi </label>
                </div>
                
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Tiêu để 1</label>
                  <input type="text" class="form-control" name="sela_title1" value="<?php echo @$setting['sela_title1'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 2 </label>
                  <input type="text" class="form-control" name="sela_title2" value="<?php echo @$setting['sela_title2'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                   <label class="form-label" for="basic-default-fullname">Tiêu đề 3 </label>
                  <input type="text" class="form-control" name="sela_title3" value="<?php echo @$setting['sela_title3'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Banner khuyến mại</label>
                   <?php showUploadFile('baner_sele','baner_sele', @$setting['baner_sele'],14);?></div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname" >background khuyến mại</label>
                   <?php showUploadFile('background_sele','background_sele', @$setting['background_sele'],15);?>
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Banner trang sản phẩm</label>
                   <?php showUploadFile('baner_product','baner_product', @$setting['baner_product'],15);?></div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname" >text header mobile</label>
                   <input type="text" class="form-control" name="text_mobile" value="<?php echo @$setting['text_mobile'];?>" />
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

  text-welcome