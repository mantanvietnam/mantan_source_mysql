<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Thành Gia Theme - Cài đặt trang chủ</h4>

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
                  <label class="form-label" for="basic-default-fullname">Tên thương hiệu</label>
                  <input type="text" class="form-control" name="name_web" value="<?php echo @$setting['name_web'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Thời gian mở cửa</label>
                  <input type="text" class="form-control" name="time_open" value="<?php echo @$setting['time_open'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID album slide</label>
                  <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
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
              <h5 class="mb-0">Khối lý do chọn</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                    <input type="text" class="form-control" name="title_why_choose" value="<?php echo @$setting['title_why_choose'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 1</label>
                    <?php showUploadFile('image1_why_choose','image1_why_choose', @$setting['image1_why_choose'],1);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                    <input type="text" class="form-control" name="title1_why_choose" value="<?php echo @$setting['title1_why_choose'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1</label>
                    <input type="text" class="form-control" name="content1_why_choose" value="<?php echo @$setting['content1_why_choose'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 2</label>
                    <?php showUploadFile('image2_why_choose','image2_why_choose', @$setting['image2_why_choose'],2);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                    <input type="text" class="form-control" name="title2_why_choose" value="<?php echo @$setting['title2_why_choose'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 2</label>
                    <input type="text" class="form-control" name="content2_why_choose" value="<?php echo @$setting['content2_why_choose'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 3</label>
                    <?php showUploadFile('image3_why_choose','image3_why_choose', @$setting['image3_why_choose'],3);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 3</label>
                    <input type="text" class="form-control" name="title3_why_choose" value="<?php echo @$setting['title3_why_choose'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 3</label>
                    <input type="text" class="form-control" name="content3_why_choose" value="<?php echo @$setting['content3_why_choose'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 4</label>
                    <?php showUploadFile('image4_why_choose','image4_why_choose', @$setting['image4_why_choose'],4);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 4</label>
                    <input type="text" class="form-control" name="title4_why_choose" value="<?php echo @$setting['title4_why_choose'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 4</label>
                    <input type="text" class="form-control" name="content4_why_choose" value="<?php echo @$setting['content4_why_choose'];?>" />
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
                    <label class="form-label" for="basic-default-fullname">Ảnh sản phẩm tiêu biểu</label>
                    <?php showUploadFile('image_product_best','image_product_best', @$setting['image_product_best'],13);?>
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

                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 7</b></label>
                    <?php showUploadFile('image7_product_best','image7_product_best', @$setting['image7_product_best'],11);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 7</label>
                    <input type="text" class="form-control" name="title7_product_best" value="<?php echo @$setting['title7_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 7</label>
                    <input type="text" class="form-control" name="content7_product_best" value="<?php echo @$setting['content7_product_best'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Ảnh mục 8</b></label>
                    <?php showUploadFile('image8_product_best','image8_product_best', @$setting['image8_product_best'],12);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 8</label>
                    <input type="text" class="form-control" name="title8_product_best" value="<?php echo @$setting['title8_product_best'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 8</label>
                    <input type="text" class="form-control" name="content8_product_best" value="<?php echo @$setting['content8_product_best'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối tin khuyến mại -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối tin khuyến mại</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                    <input type="text" class="form-control" name="title_news_hot" value="<?php echo @$setting['title_news_hot'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 1</label>
                    <?php showUploadFile('image1_news_hot','image1_news_hot', @$setting['image1_news_hot'],14);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                    <input type="text" class="form-control" name="title1_news_hot" value="<?php echo @$setting['title1_news_hot'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1</label>
                    <input type="text" class="form-control" name="content1_news_hot" value="<?php echo @$setting['content1_news_hot'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Link liên kết mục 1</label>
                    <input type="text" class="form-control" name="link1_news_hot" value="<?php echo @$setting['link1_news_hot'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 2</label>
                    <?php showUploadFile('image2_news_hot','image2_news_hot', @$setting['image2_news_hot'],15);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                    <input type="text" class="form-control" name="title2_news_hot" value="<?php echo @$setting['title2_news_hot'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 2</label>
                    <input type="text" class="form-control" name="content2_news_hot" value="<?php echo @$setting['content2_news_hot'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Link liên kết mục 2</label>
                    <input type="text" class="form-control" name="link2_news_hot" value="<?php echo @$setting['link2_news_hot'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối tiêu chí làm việc -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối tiêu chí làm việc</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                    <input type="text" class="form-control" name="title_working" value="<?php echo @$setting['title_working'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh minh họa khối</label>
                    <?php showUploadFile('image_working','image_working', @$setting['image_working'],16);?>
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                    <input type="text" class="form-control" name="title1_working" value="<?php echo @$setting['title1_working'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1</label>
                    <input type="text" class="form-control" name="content1_working" value="<?php echo @$setting['content1_working'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                    <input type="text" class="form-control" name="title2_working" value="<?php echo @$setting['title2_working'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 2</label>
                    <input type="text" class="form-control" name="content2_working" value="<?php echo @$setting['content2_working'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 3</label>
                    <input type="text" class="form-control" name="title3_working" value="<?php echo @$setting['title3_working'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 3</label>
                    <input type="text" class="form-control" name="content3_working" value="<?php echo @$setting['content3_working'];?>" />
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
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                  <input type="text" class="form-control" name="title1_footer" value="<?php echo @$setting['title1_footer'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung mục 1</label>
                  <textarea class="form-control" rows="3" name="content1_footer"><?php echo @$setting['content1_footer'];?></textarea>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                  <input type="text" class="form-control" name="title2_footer" value="<?php echo @$setting['title2_footer'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID menu liên kết mục 2</label>
                  <input type="text" class="form-control" name="idMenu2_footer" value="<?php echo @$setting['idMenu2_footer'];?>" />
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