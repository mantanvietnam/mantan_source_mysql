<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Icham CRM Theme - Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <!-- Khối banner -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối banner</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                  <?php showUploadFile('logo','logo', @$setting['logo'],1);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link đăng ký tư vấn</label>
                  <input type="text" class="form-control" name="link_contact" value="<?php echo @$setting['link_contact'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID slide trang chủ</label>
                  <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID chuyên mục dịch vụ</label>
                  <input type="text" class="form-control" name="id_blog_service" value="<?php echo @$setting['id_blog_service'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID slide đối tác</label>
                  <input type="text" class="form-control" name="id_slide_partner" value="<?php echo @$setting['id_slide_partner'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Tài khoản mạng xã hội -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Tài khoản mạng xã hội</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Youtube</label>
                  <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">TikTok</label>
                  <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Instagram</label>
                  <input type="text" class="form-control" name="instagram" value="<?php echo @$setting['instagram'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">LinkedIn</label>
                  <input type="text" class="form-control" name="linkedIn" value="<?php echo @$setting['linkedIn'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Twitter</label>
                  <input type="text" class="form-control" name="twitter" value="<?php echo @$setting['twitter'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Khối lý do chọn -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối giới thiệu</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tên thương hiệu</label>
                    <input type="text" class="form-control" name="name_brand" value="<?php echo @$setting['name_brand'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title_about" value="<?php echo @$setting['title_about'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung giới thiệu</label>
                    <textarea class="form-control" name="content_about"><?php echo @$setting['content_about'];?></textarea>
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Link chi tiết bài giới thiệu</label>
                    <input type="text" class="form-control" name="link_about" value="<?php echo @$setting['link_about'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối sản phẩm tiêu biểu -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối sản phẩm tiêu biểu</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                    <input type="text" class="form-control" name="title_product_best" value="<?php echo @$setting['title_product_best'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả khối</label>
                    <textarea class="form-control" name="des_product_best"><?php echo @$setting['des_product_best'];?></textarea>
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 1</b></label>
                    <?php showUploadFile('image1_product_best','image1_product_best', @$setting['image1_product_best'],5);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                    <input type="text" class="form-control" name="title1_product_best" value="<?php echo @$setting['title1_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1</label>
                    <input type="text" class="form-control" name="content1_product_best" value="<?php echo @$setting['content1_product_best'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 2</b></label>
                    <?php showUploadFile('image2_product_best','image2_product_best', @$setting['image2_product_best'],6);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                    <input type="text" class="form-control" name="title2_product_best" value="<?php echo @$setting['title2_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 2</label>
                    <input type="text" class="form-control" name="content2_product_best" value="<?php echo @$setting['content2_product_best'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 3</b></label>
                    <?php showUploadFile('image3_product_best','image3_product_best', @$setting['image3_product_best'],7);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 3</label>
                    <input type="text" class="form-control" name="title3_product_best" value="<?php echo @$setting['title3_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 3</label>
                    <input type="text" class="form-control" name="content3_product_best" value="<?php echo @$setting['content3_product_best'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 4</b></label>
                    <?php showUploadFile('image4_product_best','image4_product_best', @$setting['image4_product_best'],8);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 4</label>
                    <input type="text" class="form-control" name="title4_product_best" value="<?php echo @$setting['title4_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 4</label>
                    <input type="text" class="form-control" name="content4_product_best" value="<?php echo @$setting['content4_product_best'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 5</b></label>
                    <?php showUploadFile('image5_product_best','image5_product_best', @$setting['image5_product_best'],9);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 5</label>
                    <input type="text" class="form-control" name="title5_product_best" value="<?php echo @$setting['title5_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 5</label>
                    <input type="text" class="form-control" name="content5_product_best" value="<?php echo @$setting['content5_product_best'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 6</b></label>
                    <?php showUploadFile('image6_product_best','image6_product_best', @$setting['image6_product_best'],10);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 6</label>
                    <input type="text" class="form-control" name="title6_product_best" value="<?php echo @$setting['title6_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 6</label>
                    <input type="text" class="form-control" name="content6_product_best" value="<?php echo @$setting['content6_product_best'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối Khối chân trang -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối chân trang</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giới thiệu ngắn về công ty</label>
                  <textarea class="form-control" rows="3" name="content1_footer"><?php echo @$setting['content1_footer'];?></textarea>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID menu chân trang</label>
                  <input type="text" class="form-control" name="id_menu_footer" value="<?php echo @$setting['id_menu_footer'];?>" />
                </div>
              </div>
                
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>


      </div>
    <?= $this->Form->end() ?>
  </div>