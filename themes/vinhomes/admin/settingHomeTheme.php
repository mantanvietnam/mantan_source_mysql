<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess; ?></p>
    <?= $this->Form->create(); ?>

    <!-- Khối banner -->
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Khối banner</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tên thương hiệu</label>
                        <input type="text" class="form-control" name="text_logo" value="<?php echo @$setting['text_logo']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Logo</label>
                        <?php showUploadFile('image_logo', 'image_logo', @$setting['image_logo'], 1); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Background</label>
                        <?php showUploadFile('background_image', 'background_image', @$setting['background_image']); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>

        <!-- Khối chân trang -->
        <div class="col-12 col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Chân trang</h5>
                </div>
                <div class="card-body row">
                    <!-- Cột trái -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                            <input type="text" class="form-control" name="title_footer" value="<?php echo @$setting['title_footer']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Cơ quan chủ quản</label>
                            <input type="text" class="form-control" name="agency" value="<?php echo @$setting['agency']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="<?php echo @$setting['address']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo @$setting['phone']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo @$setting['email']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Instagram</label>
                            <input type="text" class="form-control" name="zalo" value="<?php echo @$setting['zalo']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Facebook</label>
                            <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook']; ?>" />
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Điện thoại</label>
                            <input type="text" class="form-control" name="responsibilityphone" value="<?php echo @$setting['responsibilityphone']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input type="text" class="form-control" name="responsibilityemail" value="<?php echo @$setting['responsibilityemail']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Theo dõi chúng tôi qua</label>
                            <input type="text" class="form-control" name="follow" value="<?php echo @$setting['follow']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Id nhóm link liên kết chân trang</label>
                            <input type="text" class="form-control" name="idlink" value="<?php echo @$setting['idlink']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Youtube</label>
                            <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiktok</label>
                            <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok']; ?>" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
            </div>
        </div>
    </div>

    <!-- Khối giới thiệu -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Khối giới thiệu</h5>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề khối dòng 1</label>
                            <input type="text" class="form-control" name="title_introduce_1" value="<?php echo @$setting['title_introduce_1']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề khối dòng 2</label>
                            <input type="text" class="form-control" name="title_introduce_2" value="<?php echo @$setting['title_introduce_2']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Logo khối</label>
                            <?php showUploadFile('logo_introduce', 'logo_introduce', @$setting['logo_introduce'], 1); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Ảnh khối</label>
                            <?php showUploadFile('image_introduce', 'image_introduce', @$setting['image_introduce'], 1); ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nội dung dòng 1</label>
                            <input type="text" class="form-control" name="content1_introduce" value="<?php echo @$setting['content1_introduce']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nội dung dòng 2</label>
                            <input type="text" class="form-control" name="content2_introduce" value="<?php echo @$setting['content2_introduce']; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nội dung dòng 3</label>
                            <input type="text" class="form-control" name="content3_introduce" value="<?php echo @$setting['content3_introduce']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Khối lý do chọn -->
    <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Khối lý do chọn</h5>
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="title_why_choose">Tiêu đề khối</label>
                        <input type="text" class="form-control" name="title_why_choose" value="<?php echo @$setting['title_why_choose']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content1_why_choose">Nội dung mục 1</label>
                        <input type="text" class="form-control" name="content1_why_choose" value="<?php echo @$setting['content1_why_choose']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content2_why_choose">Nội dung mục 2</label>
                        <input type="text" class="form-control" name="content2_why_choose" value="<?php echo @$setting['content2_why_choose']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content3_why_choose">Nội dung mục 3</label>
                        <input type="text" class="form-control" name="content3_why_choose" value="<?php echo @$setting['content3_why_choose']; ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="content4_why_choose">Nội dung mục 4</label>
                        <input type="text" class="form-control" name="content4_why_choose" value="<?php echo @$setting['content4_why_choose']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content5_why_choose">Nội dung mục 5</label>
                        <input type="text" class="form-control" name="content5_why_choose" value="<?php echo @$setting['content5_why_choose']; ?>" />
                    </div>
                    <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 1</label>
                    <?php showUploadFile('image1_news_hot','image1_news_hot', @$setting['image1_news_hot'],15);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh mục 2</label>
                    <?php showUploadFile('image2_news_hot','image2_news_hot', @$setting['image2_news_hot'],15);?>
                  </div>
                </div>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div>


    <?= $this->Form->end(); ?>
</div>
