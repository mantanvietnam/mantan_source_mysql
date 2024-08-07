<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
        <div class="nav-align-top mb-4">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                KHỐI ĐẦU
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                CHỌN CHÚNG TÔI
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                ID LIÊN KẾT TRANG CHỦ
              </button>
            </li>
            
             <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                 KINH DOANH MỸ PHẨM
              </button>
            </li>
            
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-footer" aria-controls="navs-top-Post" aria-selected="false">
                CHÂN TRANG
             </button>
           </li>
        </ul>
        <div class="card-body tab-content ">
          <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Logo</label>
                <?php showUploadFile('image_logo','image_logo', @$setting['image_logo'],1);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tên công ty</label>
                <input type="text" class="form-control" name="compan_name" value="<?php echo @$setting['compan_name'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="<?php echo @$setting['address'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo @$setting['email'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Số điện thọai</label>
                <input type="text" class="form-control" name="phone" value="<?php echo @$setting['phone'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Id ảnh slide</label>
                <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
            <div class="card-body row ">     
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">icon 1</label>
                <input type="text" class="form-control" name="icon1" value="<?php echo @$setting['icon1'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề 1</label>
                <input type="text" class="form-control" name="titel1" value="<?php echo @$setting['titel1'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung  1</label>
                <input type="text" class="form-control" name="content1" value="<?php echo @$setting['content1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">icon 2</label>
                <input type="text" class="form-control" name="icon2" value="<?php echo @$setting['icon2'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề 2</label>
                <input type="text" class="form-control" name="titel2" value="<?php echo @$setting['titel2'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung  2</label>
                <input type="text" class="form-control" name="content2" value="<?php echo @$setting['content2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">icon 3</label>
                <input type="text" class="form-control" name="icon3" value="<?php echo @$setting['icon3'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề 3</label>
                <input type="text" class="form-control" name="titel3" value="<?php echo @$setting['titel3'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung  3</label>
                <input type="text" class="form-control" name="content3" value="<?php echo @$setting['content3'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">icon 4</label>
                <input type="text" class="form-control" name="icon4" value="<?php echo @$setting['icon4'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề 4</label>
                <input type="text" class="form-control" name="titel4" value="<?php echo @$setting['titel4'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung  4</label>
                <input type="text" class="form-control" name="content4" value="<?php echo @$setting['content4'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ID danh Mục thư viên ảnh</label>
                <input type="text" class="form-control" name="id_album" value="<?php echo @$setting['id_album'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ID danh Mục video</label>
                <input type="text" class="form-control" name="id_video" value="<?php echo @$setting['id_video'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ID danh mục sản phẩn 1</label>
                <input type="text" class="form-control" name="id_category_product1" value="<?php echo @$setting['id_category_product1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ID danh mục sản phẩn 2</label>
                <input type="text" class="form-control" name="id_category_product2" value="<?php echo @$setting['id_category_product2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu để danh mục sản phẩn 1</label>
                <input type="text" class="form-control" name="titel_category_product1" value="<?php echo @$setting['titel_category_product1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu để danh mục sản phẩn 2</label>
                <input type="text" class="form-control" name="titel_category_product2" value="<?php echo @$setting['titel_category_product2'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
            <div class="card-body row ">
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                <input type="text" class="form-control" name="titel6" value="<?php echo @$setting['titel6'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">chữ nhỏ</label>
                <input type="text" class="form-control" name="content6" value="<?php echo @$setting['content6'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Link</label>
                <input type="text" class="form-control" name="link1" value="<?php echo @$setting['link1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname"> ID Hình ảnh điều trị</label>
                <input type="text" class="form-control" name="id_albumdt" value="<?php echo @$setting['id_albumdt'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-footer" role="tabpanel">
            <div class="card-body row ">    
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chân trang trái</label>
                <input type="text" class="form-control" name="title_footer_left" value="<?php echo @$setting['title_footer_left'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chân trang phải</label>
                <input type="text" class="form-control" name="title_footer_right" value="<?php echo @$setting['title_footer_right'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ xanh</label>
                <input type="text" class="form-control" name="title_footer_green" value="<?php echo @$setting['title_footer_green'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                <input type="text" class="form-control" name="address_footer" value="<?php echo @$setting['address_footer'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Điện thoại</label>
                <input type="text" class="form-control" name="phone_footer" value="<?php echo @$setting['phone_footer'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Email</label>
                <input type="text" class="form-control" name="email_footer" value="<?php echo @$setting['email_footer'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Web</label>
                <input type="text" class="form-control" name="web_footer" value="<?php echo @$setting['web_footer'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tên page</label>
                <input type="text" class="form-control" name="page_footer" value="<?php echo @$setting['page_footer'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">link page</label>
                <input type="text" class="form-control" name="link_page" value="<?php echo @$setting['link_page'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Giấy chứng nhận kinh doanh</label>
                <input type="text" class="form-control" name="business_certificates" value="<?php echo @$setting['business_certificates'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">người đại điện</label>
                <input type="text" class="form-control" name="represent" value="<?php echo @$setting['represent'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh quảng cáo trang sản phẩn</label>
                <?php showUploadFile('image_qc','image_qc', @$setting['image_qc'],2);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">text chân trang</label>
                <input type="text" class="form-control" name="textfooter" value="<?php echo @$setting['textfooter'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">link zalo</label>
                <input type="text" class="form-control" name="insta" value="<?php echo @$setting['insta'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">link youtube</label>
                <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">link tiktok</label>
                <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok'];?>" />
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

