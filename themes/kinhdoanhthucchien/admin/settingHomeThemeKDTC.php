<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">KDTC Theme - Cài đặt trang chủ</h4>

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
                  <label class="form-label" for="basic-default-fullname">Hình nền của khối</label>
                  <?php showUploadFile('image_bg_1','image_bg_1', @$setting['image_bg_1'],200);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hình ảnh chuyên gia đào tạo</label>
                  <?php showUploadFile('image_speaker','image_speaker', @$setting['image_speaker'],1);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên chương trình đào tạo</label>
                  <input type="text" class="form-control" name="name_project" value="<?php echo @$setting['name_project'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Lịch học</label>
                  <input type="text" class="form-control" name="time_learning" value="<?php echo @$setting['time_learning'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Cam kết đào tạo</label>
                  <input type="text" class="form-control" name="commit" value="<?php echo @$setting['commit'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung đào tạo (mỗi nội dung 1 dòng)</label>
                  <textarea name="content_training" class="form-control" rows="6"><?php echo @$setting['content_training'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link đăng ký</label>
                  <input type="text" class="form-control" name="link_reg" value="<?php echo @$setting['link_reg'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Những điều bạn sẽ học -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Những điều bạn sẽ học</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 1</label>
                  <input type="text" class="form-control" name="learn1" value="<?php echo @$setting['learn1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 2</label>
                  <input type="text" class="form-control" name="learn2" value="<?php echo @$setting['learn2'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 3</label>
                  <input type="text" class="form-control" name="learn3" value="<?php echo @$setting['learn3'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 4</label>
                  <input type="text" class="form-control" name="learn4" value="<?php echo @$setting['learn4'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 5</label>
                  <input type="text" class="form-control" name="learn5" value="<?php echo @$setting['learn5'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 6</label>
                  <input type="text" class="form-control" name="learn6" value="<?php echo @$setting['learn6'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 7</label>
                  <input type="text" class="form-control" name="learn7" value="<?php echo @$setting['learn7'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điều 8</label>
                  <input type="text" class="form-control" name="learn8" value="<?php echo @$setting['learn8'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- gợi ý nhu cầu -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Gợi ý nhu cầu</h5>
            </div>
            <div class="card-body">
              <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                  <input type="text" class="form-control" name="title_demand" value="<?php echo @$setting['title_demand'];?>" />
              </div>

              <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả khối</label>
                  <input type="text" class="form-control" name="des_demand" value="<?php echo @$setting['des_demand'];?>" />
              </div>

              <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Danh sách các nhu cầu</label>
                  <textarea name="content_demand" class="form-control" rows="5"><?php echo @$setting['content_demand'];?></textarea>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Khối giới thiệu -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối giới thiệu</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung giới thiệu</label>
                  <textarea name="introduce" class="form-control" rows="5"><?php echo @$setting['introduce'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung kêu gọi đăng ký</label>
                  <input type="text" class="form-control" name="call_registration" value="<?php echo @$setting['call_registration'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng video</label>
                  <textarea name="video_introduce" class="form-control"><?php echo @$setting['video_introduce'];?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Thông tin người chia sẻ -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Thông tin người chia sẻ</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                  <input type="text" class="form-control" name="title_info_speaker" value="<?php echo @$setting['title_info_speaker'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên diễn giả</label>
                  <input type="text" class="form-control" name="name_speaker" value="<?php echo @$setting['name_speaker'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hình ảnh diễn giả</label>
                  <?php showUploadFile('image_speaker2','image_speaker2', @$setting['image_speaker2'],2);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung giới thiệu</label>
                  <textarea name="info_speaker_introduce" class="form-control" rows="5"><?php echo @$setting['info_speaker_introduce'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hình nền của khối</label>
                  <?php showUploadFile('image_bg_2','image_bg_2', @$setting['image_bg_2'],202);?>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Lý do tham gia -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Lý do tham gia</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                  <input type="text" class="form-control" name="title_reason_join" value="<?php echo @$setting['title_reason_join'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hình ảnh diễn giả</label>
                  <?php showUploadFile('image_speaker3','image_speaker3', @$setting['image_speaker3'],3);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Lý do tham gia chương trình</label>
                  <textarea name="info_reason_join" class="form-control" rows="8"><?php echo @$setting['info_reason_join'];?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Kết quả nhận được -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Kết quả nhận được</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                  <input type="text" class="form-control" name="title_return" value="<?php echo @$setting['title_return'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ghi chú khối</label>
                  <input type="text" class="form-control" name="note_return" value="<?php echo @$setting['note_return'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Kết quả 1</label>
                  <input type="text" class="form-control" name="return_1" value="<?php echo @$setting['return_1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Kết quả 2</label>
                  <input type="text" class="form-control" name="return_2" value="<?php echo @$setting['return_2'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Kết quả 3</label>
                  <input type="text" class="form-control" name="return_3" value="<?php echo @$setting['return_3'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Kết quả 4</label>
                  <input type="text" class="form-control" name="return_4" value="<?php echo @$setting['return_4'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Kết quả 5</label>
                  <input type="text" class="form-control" name="return_5" value="<?php echo @$setting['return_5'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Kết quả 6</label>
                  <input type="text" class="form-control" name="return_6" value="<?php echo @$setting['return_6'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Đối tượng tham gia khóa học -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Đối tượng tham gia khóa học</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Đối tượng nên tham gia (mỗi đối tượng 1 dòng)</label>
                  <textarea name="should_join" class="form-control" rows="8"><?php echo @$setting['should_join'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Đối tượng không nên tham gia (mỗi đối tượng 1 dòng)</label>
                  <textarea name="not_should_join" class="form-control" rows="8"><?php echo @$setting['not_should_join'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hình nền của khối</label>
                  <?php showUploadFile('image_bg_3','image_bg_3', @$setting['image_bg_3'],203);?>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Đăng ký giữ chỗ -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Kêu gọi đăng ký giữ chỗ ngay</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                    <input type="text" class="form-control" name="title_keep_place" value="<?php echo @$setting['title_keep_place'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả khối</label>
                    <input type="text" class="form-control" name="des_keep_place" value="<?php echo @$setting['des_keep_place'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Loại vé 1 -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Loại vé 1</h5>
            </div>
            <div class="card-body">
              <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên gói 1</label>
                  <input type="text" class="form-control" name="title_price_1" value="<?php echo @$setting['title_price_1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giá gốc gói 1</label>
                  <input type="text" class="form-control" name="price_old_1" value="<?php echo @$setting['price_old_1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giá bán gói 1</label>
                  <input type="text" class="form-control" name="price_sell_1" value="<?php echo @$setting['price_sell_1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Quyền lợi gói 1</label>
                  <textarea name="benefit_1" class="form-control" rows="6"><?php echo @$setting['benefit_1'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link đăng ký gói 1</label>
                  <input type="text" class="form-control" name="link_reg_1" value="<?php echo @$setting['link_reg_1'];?>" />
                </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Loại vé 2 -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Loại vé 2</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên gói 2</label>
                  <input type="text" class="form-control" name="title_price_2" value="<?php echo @$setting['title_price_2'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giá gốc gói 2</label>
                  <input type="text" class="form-control" name="price_old_2" value="<?php echo @$setting['price_old_2'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giá bán gói 2</label>
                  <input type="text" class="form-control" name="price_sell_2" value="<?php echo @$setting['price_sell_2'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Quyền lợi gói 2</label>
                  <textarea name="benefit_2" class="form-control" rows="6"><?php echo @$setting['benefit_2'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link đăng ký gói 2</label>
                  <input type="text" class="form-control" name="link_reg_2" value="<?php echo @$setting['link_reg_2'];?>" />
                </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Quà tặng tham gia khóa học -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Quà tặng tham gia khóa học</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                  <input type="text" class="form-control" name="title_gift" value="<?php echo @$setting['title_gift'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Danh sách quà tặng (mỗi phần quà 1 dòng)</label>
                  <textarea name="list_gift" class="form-control" rows="8"><?php echo @$setting['list_gift'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tổng giá trị quà tặng</label>
                  <input type="text" class="form-control" name="price_gift" value="<?php echo @$setting['price_gift'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hình nền của khối</label>
                  <?php showUploadFile('image_bg_4','image_bg_4', @$setting['image_bg_4'],204);?>
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

        <!-- Cài đặt chung -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Cài đặt chung</h5>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">ID album hình ảnh khóa học cũ</label>
                <input type="text" class="form-control" name="id_album_course" value="<?php echo @$setting['id_album_course'];?>" />
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Tên công ty</label>
                <input type="text" class="form-control" name="company" value="<?php echo @$setting['company'];?>" />
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