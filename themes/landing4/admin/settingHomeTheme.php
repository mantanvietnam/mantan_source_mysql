<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

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
                KHỐI ĐẦU
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                 GIỚI THIỆU
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                 DỊCH VỤ
              </button>
            </li>
             <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                 THƯ VIỆN
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                 ĐỘI NGŨ
              </button>
            </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contac" aria-controls="navs-top-image" aria-selected="false">
              MẠNG XÃ HỘI
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
                <label class="form-label" for="basic-default-fullname">Tiêu đề nhỏ</label>
                <input type="text" class="form-control" name="title_top_nho" value="<?php echo @$data['title_top_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề to</label>
                <input type="text" class="form-control" name="title_top_to" value="<?php echo @$data['title_top_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung chữ nhỏ</label>
                <input type="text" class="form-control" name="content_top" value="<?php echo @$data['content_top'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Link đăng ký </label>
                <input type="text" class="form-control" name="link_top" value="<?php echo @$data['link_top'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh Đại diện</label>
                <?php showUploadFile('image_avatar','image_avatar', @$data['image_avatar'],3);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                <input type="text" class="form-control" name="title_2" value="<?php echo @$data['title_2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <textarea class="form-control" name="content_1"><?php echo @$data['content_1'];?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon mục nhỏ 1</label>
                <input type="text" class="form-control" name="icon_mn_1" value="<?php echo @$data['icon_mn_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề mục nhỏ 1</label>
                <input type="text" class="form-control" name="title_mn_1" value="<?php echo @$data['title_mn_1'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung mục nhỏ 1</label>
                <input type="text" class="form-control" name="content_mn_1" value="<?php echo @$data['content_mn_1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon mục nhỏ 2</label>
                <input type="text" class="form-control" name="icon_mn_2" value="<?php echo @$data['icon_mn_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề mục nhỏ 2</label>
                <input type="text" class="form-control" name="title_mn_2" value="<?php echo @$data['title_mn_2'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung mục nhỏ 2</label>
                <input type="text" class="form-control" name="content_mn_2" value="<?php echo @$data['content_mn_2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon mục nhỏ 3</label>
                <input type="text" class="form-control" name="icon_mn_3" value="<?php echo @$data['icon_mn_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề mục nhỏ 3</label>
                <input type="text" class="form-control" name="title_mn_3" value="<?php echo @$data['title_mn_3'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung mục nhỏ 3</label>
                <input type="text" class="form-control" name="content_mn_3" value="<?php echo @$data['content_mn_3'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                <input type="text" class="form-control" name="title_dichvu" value="<?php echo @$data['title_dichvu'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 1</label>
                <input type="text" class="form-control" name="icon_dichvu_1" value="<?php echo @$data['icon_dichvu_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 1</label>
                <input type="text" class="form-control" name="title_dichvu_1" value="<?php echo @$data['title_dichvu_1'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 1</label>
                <input type="text" class="form-control" name="content_dichvu_1" value="<?php echo @$data['content_dichvu_1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 2</label>
                <input type="text" class="form-control" name="icon_dichvu_2" value="<?php echo @$data['icon_dichvu_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 2</label>
                <input type="text" class="form-control" name="title_dichvu_2" value="<?php echo @$data['title_dichvu_2'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 2</label>
                <input type="text" class="form-control" name="content_dichvu_2" value="<?php echo @$data['content_dichvu_2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 3</label>
                <input type="text" class="form-control" name="icon_dichvu_3" value="<?php echo @$data['icon_dichvu_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 3</label>
                <input type="text" class="form-control" name="title_dichvu_3" value="<?php echo @$data['title_dichvu_3'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 3</label>
                <input type="text" class="form-control" name="content_dichvu_3" value="<?php echo @$data['content_dichvu_3'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 4</label>
                <input type="text" class="form-control" name="icon_dichvu_4" value="<?php echo @$data['icon_dichvu_4'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 4</label>
                <input type="text" class="form-control" name="title_dichvu_4" value="<?php echo @$data['title_dichvu_4'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 4</label>
                <input type="text" class="form-control" name="content_dichvu_4" value="<?php echo @$data['content_dichvu_4'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 5</label>
                <input type="text" class="form-control" name="icon_dichvu_5" value="<?php echo @$data['icon_dichvu_5'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 5</label>
                <input type="text" class="form-control" name="title_dichvu_5" value="<?php echo @$data['title_dichvu_5'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 5</label>
                <input type="text" class="form-control" name="content_dichvu_5" value="<?php echo @$data['content_dichvu_5'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 6</label>
                <input type="text" class="form-control" name="icon_dichvu_6" value="<?php echo @$data['icon_dichvu_6'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 6</label>
                <input type="text" class="form-control" name="title_dichvu_6" value="<?php echo @$data['title_dichvu_6'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 6</label>
                <input type="text" class="form-control" name="content_dichvu_6" value="<?php echo @$data['content_dichvu_6'];?>" />
              </div>

            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                <input type="text" class="form-control" name="title_album" value="<?php echo @$data['title_album'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ID album</label>
                <input type="text" class="form-control" name="id_album" value="<?php echo @$data['id_album'];?>" />
              </div>
            </div>
          </div>    
          <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                <input type="text" class="form-control" name="title_doingu" value="<?php echo @$data['title_doingu'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh Đại diện 1</label>
                <?php showUploadFile('image_avatar_1','image_avatar_1', @$data['image_avatar_1'],4);?>
                <label class="form-label" for="basic-default-fullname">Tên 1</label>
                <input type="text" class="form-control" name="fullname_1" value="<?php echo @$data['fullname_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Lĩnh vực 1</label>
                <input type="text" class="form-control" name="field_1" value="<?php echo @$data['field_1'];?>" />
                <label class="form-label" for="basic-default-fullname">link facebook 1</label>
                <input type="text" class="form-control" name="facebook_1" value="<?php echo @$data['facebook_1'];?>" />
                <label class="form-label" for="basic-default-fullname">link twitter 1</label>
                <input type="text" class="form-control" name="twitter_1" value="<?php echo @$data['twitter_1'];?>" />
                <label class="form-label" for="basic-default-fullname">link instagram 1</label>
                <input type="text" class="form-control" name="instagram_1" value="<?php echo @$data['instagram_1'];?>" />
              </div>
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh Đại diện 2</label>
                <?php showUploadFile('image_avatar_2','image_avatar_2', @$data['image_avatar_2'],5);?>
                <label class="form-label" for="basic-default-fullname">Tên 2</label>
                <input type="text" class="form-control" name="fullname_2" value="<?php echo @$data['fullname_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Lĩnh vực 2</label>
                <input type="text" class="form-control" name="field_2" value="<?php echo @$data['field_2'];?>" />
                <label class="form-label" for="basic-default-fullname">link facebook 2</label>
                <input type="text" class="form-control" name="facebook_2" value="<?php echo @$data['facebook_2'];?>" />
                <label class="form-label" for="basic-default-fullname">link twitter 2</label>
                <input type="text" class="form-control" name="twitter_2" value="<?php echo @$data['twitter_2'];?>" />
                <label class="form-label" for="basic-default-fullname">link instagram 2</label>
                <input type="text" class="form-control" name="instagram_2" value="<?php echo @$data['instagram_2'];?>" />
              </div>
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh Đại diện 3</label>
                <?php showUploadFile('image_avatar_3','image_avatar_3', @$data['image_avatar_3'],6);?>
                <label class="form-label" for="basic-default-fullname">Tên 3</label>
                <input type="text" class="form-control" name="fullname_3" value="<?php echo @$data['fullname_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Lĩnh vực 3</label>
                <input type="text" class="form-control" name="field_3" value="<?php echo @$data['field_3'];?>" />
                <label class="form-label" for="basic-default-fullname">link facebook 3</label>
                <input type="text" class="form-control" name="facebook_3" value="<?php echo @$data['facebook_3'];?>" />
                <label class="form-label" for="basic-default-fullname">link twitter 3</label>
                <input type="text" class="form-control" name="twitter_3" value="<?php echo @$data['twitter_3'];?>" />
                <label class="form-label" for="basic-default-fullname">link instagram 3</label>
                <input type="text" class="form-control" name="instagram_3" value="<?php echo @$data['instagram_3'];?>" />
              </div>
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh Đại diện 4</label>
                <?php showUploadFile('image_avatar_4','image_avatar_4', @$data['image_avatar_4'],7);?>
                <label class="form-label" for="basic-default-fullname">Tên 4</label>
                <input type="text" class="form-control" name="fullname_4" value="<?php echo @$data['fullname_4'];?>" />
                <label class="form-label" for="basic-default-fullname">Lĩnh vực 4</label>
                <input type="text" class="form-control" name="field_4" value="<?php echo @$data['field_4'];?>" />
                <label class="form-label" for="basic-default-fullname">link facebook 4</label>
                <input type="text" class="form-control" name="facebook_4" value="<?php echo @$data['facebook_4'];?>" />
                <label class="form-label" for="basic-default-fullname">link twitter 4</label>
                <input type="text" class="form-control" name="twitter_4" value="<?php echo @$data['twitter_4'];?>" />
                <label class="form-label" for="basic-default-fullname">link instagram 4</label>
                <input type="text" class="form-control" name="instagram_4" value="<?php echo @$data['instagram_4'];?>" />
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="navs-top-contac" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon 1</label>
                <input type="text" class="form-control" name="icon_lh_1" value="<?php echo @$data['icon_lh_1'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề 1</label>
                <input type="text" class="form-control" name="title_lh_1" value="<?php echo @$data['title_lh_1'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung 1</label>
                <input type="text" class="form-control" name="content_lh_1" value="<?php echo @$data['content_lh_1'];?>" /> 
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon 2</label>
                <input type="text" class="form-control" name="icon_lh_2" value="<?php echo @$data['icon_lh_2'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề 2</label>
                <input type="text" class="form-control" name="title_lh_2" value="<?php echo @$data['title_lh_2'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung 2</label>
                <input type="text" class="form-control" name="content_lh_2" value="<?php echo @$data['content_lh_2'];?>" /> 
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon 3</label>
                <input type="text" class="form-control" name="icon_lh_3" value="<?php echo @$data['icon_lh_3'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề 3</label>
                <input type="text" class="form-control" name="title_lh_3" value="<?php echo @$data['title_lh_3'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung 3</label>
                <input type="text" class="form-control" name="content_lh_3" value="<?php echo @$data['content_lh_3'];?>" /> 
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh nền form đăng ký </label>
                <?php showUploadFile('background_4','background_4', @$data['background_4'],8);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">facebook</label>
                <input type="text" class="form-control" name="facebook" value="<?php echo @$data['facebook'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">instagram</label>
                <input type="text" class="form-control" name="instagram" value="<?php echo @$data['instagram'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiktok</label>
                <input type="text" class="form-control" name="tiktok" value="<?php echo @$data['tiktok'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">youtube</label>
                <input type="text" class="form-control" name="youtube" value="<?php echo @$data['youtube'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">linkedin</label>
                <input type="text" class="form-control" name="linkedin" value="<?php echo @$data['linkedin'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">twitter</label>
                <input type="text" class="form-control" name="twitter" value="<?php echo @$data['twitter'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">chữ dưới cùng </label>
                <input type="text" class="form-control" name="textfooter" value="<?php echo @$data['textfooter'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh ở bên phải tin tức </label>
                <?php showUploadFile('image_Port','image_Port', @$data['image_Port'],9);?>
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

</div>
<?= $this->Form->end() ?>
</div>
