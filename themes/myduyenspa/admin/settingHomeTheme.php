<!-- Helpers -->

<style type="text/css">
    .card-header h3{
        color: red;
        font-size: 16px;
    }
</style>
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
                          KHỐI KHÓA ĐÀO TẠO
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                         CHƯƠNG TRÌNH ĐÃ TỔ CHỨC
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                          SỐ LIỆU THỐNG KÊ
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-evaluate" aria-controls="navs-top-image" aria-selected="false">
                          LIÊN HỆ
                        </button>
                      </li>
                    </ul>
            <!-- <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="mb-0 form-label">Khối đầu</h3>
            </div> -->
            <div class="card-body tab-content ">
              <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                <div class="row">
                
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Logo</label>
                     <?php showUploadFile('logo','logo',@$data['logo'],0);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh nều khối đầu</label>
                     <?php showUploadFile('video','video', @$data['video'],2);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label class="form-label" for="basic-default-fullname">Nội dung tiêu đề </label>
                    <?php showEditorInput('textSlide', 'textSlide', @$data['textSlide']);?>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                <div class="row">
                  
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh chân dung </label>
                    <?php   showUploadFile('avatar','avatar',@$data['avatar'],2);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Họ tên</label>
                    <input class="form-control" type="text" name="fullName" value="<?php echo @$data['fullName'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Slogan dưới tên</label>
                    <input class="form-control" type="text" name="slogan" value="<?php echo @$data['slogan'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                    <label class="form-label" for="basic-default-fullname">Giới thiệu bản thân</label>
                    <?php showEditorInput('personIntroduction','personIntroduction',@$data['personIntroduction'],1);?>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">facebook</label>
                    <input class="form-control" type="text" name="facebook" value="<?php echo @$data['facebook'];?>" />
                    <label class="form-label" for="basic-default-fullname">Youtube</label>
                    <input class="form-control" type="text" name="youtube" value="<?php echo @$data['youtube'];?>" />
                    <label class="form-label" for="basic-default-fullname">instagram</label>
                    <input class="form-control" type="text" name="instagram" value="<?php echo @$data['instagram'];?>" />
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
                <div class="row">
                  
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh minh họa khóa 1</label>
                    <?php showUploadFile('imageLearn1','imageLearn1',@$data['imageLearn1'],3);?>
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khóa 1</label>
                    <input class="form-control" type="text" name="titleLearn1" value="<?php echo @$data['titleLearn1'];?>" />
                    <label class="form-label" for="basic-default-fullname">Mô tả khóa 1</label>
                    <input class="form-control" type="text" name="decsLearn1" value="<?php echo @$data['decsLearn1'];?>" />
                    <label class="form-label" for="basic-default-fullname">Link Mô tả khóa 1</label>
                    <input class="form-control" type="text" name="Link_kh1" value="<?php echo @$data['Link_kh1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh minh họa khóa 2</label>
                    <?php showUploadFile('imageLearn2','imageLearn2',@$data['imageLearn2'],4);?>
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khóa 2</label>
                    <input class="form-control" type="text" name="titleLearn2" value="<?php echo @$data['titleLearn2'];?>" />
                    <label class="form-label" for="basic-default-fullname">Mô tả khóa 2</label>
                    <input class="form-control" type="text" name="decsLearn2" value="<?php echo @$data['decsLearn2'];?>" />
                     <label class="form-label" for="basic-default-fullname">Link Mô tả khóa 2</label>
                    <input class="form-control" type="text" name="Link_kh2" value="<?php echo @$data['Link_kh2'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh minh họa khóa 3</label>
                    <?php showUploadFile('imageLearn3','imageLearn3',@$data['imageLearn3'],5);?>
                    <label class="form-label" for="basic-default-fullname">Tiêu đề khóa 3</label>
                    <input class="form-control" type="text" name="titleLearn3" value="<?php echo @$data['titleLearn3'];?>" />
                    <label class="form-label" for="basic-default-fullname">Mô tả khóa 1</label>
                    <input class="form-control" type="text" name="decsLearn1" value="<?php echo @$data['decsLearn1'];?>" />
                     <label class="form-label" for="basic-default-fullname">Link Mô tả khóa 3</label>
                    <input class="form-control" type="text" name="Link_kh3" value="<?php echo @$data['Link_kh3'];?>" />
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                <div class="row">
                  
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh minh họa chương trình 1</label>
                    <?php showUploadFile('imageProgram1','imageProgram1',@$data['imageProgram1'],6);?>
                    <label class="form-label" for="basic-default-fullname">Thời gian chương trình 1</label>
                    <input class="form-control" type="text" name="timeProgram1" value="<?php echo @$data['timeProgram1'];?>" />
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chương trình 1</label>
                      <input class="form-control" type="text" name="titleProgram1" value="<?php echo @$data['titleProgram1'];?>" />
                      <label class="form-label" for="basic-default-fullname">Mô tả chương trình 1</label>
                      <input class="form-control" type="text" name="decsProgram1" value="<?php echo @$data['decsProgram1'];?>" />

                      <label class="form-label" for="basic-default-fullname">Link Mô chương trình 1</label>
                      <input class="form-control" type="text" name="Link_ct1" value="<?php echo @$data['Link_ct1'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh minh họa chương trình 2</label>
                    <?php showUploadFile('imageProgram2','imageProgram2',@$data['imageProgram2'],7);?>
                    <label class="form-label" for="basic-default-fullname">Thời gian chương trình 1</label>
                    <input class="form-control" type="text" name="timeProgram2" value="<?php echo @$data['timeProgram2'];?>" />
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chương trình 2</label>
                      <input class="form-control" type="text" name="titleProgram2" value="<?php echo @$data['titleProgram2'];?>" />
                      <label class="form-label" for="basic-default-fullname">Mô tả chương trình 1</label>
                      <input class="form-control" type="text" name="decsProgram2" value="<?php echo @$data['decsProgram2'];?>" />
                      <label class="form-label" for="basic-default-fullname">Link Mô chương trình 2</label>
                      <input class="form-control" type="text" name="Link_ct2" value="<?php echo @$data['Link_ct2'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <label class="form-label" for="basic-default-fullname">Ảnh minh họa chương trình 3</label>
                    <?php showUploadFile('imageProgram3','imageProgram3',@$data['imageProgram3'],8);?>
                    <label class="form-label" for="basic-default-fullname">Thời gian chương trình 3</label>
                    <input class="form-control" type="text" name="timeProgram3" value="<?php echo @$data['timeProgram3'];?>" />
                    <label class="form-label" for="basic-default-fullname">Tiêu đề chương trình 3</label>
                      <input class="form-control" type="text" name="titleProgram3" value="<?php echo @$data['titleProgram3'];?>" />
                      <label class="form-label" for="basic-default-fullname">Mô tả chương trình 3</label>
                      <input class="form-control" type="text" name="decsProgram3" value="<?php echo @$data['decsProgram3'];?>" />
                      <label class="form-label" for="basic-default-fullname">Link Mô chương trình 3</label>
                      <input class="form-control" type="text" name="Link_ct3" value="<?php echo @$data['Link_ct3'];?>" />
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                <div class="row">
                  
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                       <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                      <?php showUploadFile('imageStatic','imageStatic',@$data['imageStatic'],9);?>
                  </div>
                   <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Nội dung thống kê 1</label>
                      <input class="form-control" type="text" name="nameStatic1" value="<?php echo @$data['nameStatic1'];?>" />
                      <label class="form-label" for="basic-default-fullname">Số lượng thống kê 1</label>
                      <input class="form-control" type="text" name="numberStatic1" value="<?php echo @$data['numberStatic1'];?>" />
                  </div>
                   <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Nội dung thống kê 2</label>
                      <input class="form-control" type="text" name="nameStatic2" value="<?php echo @$data['nameStatic2'];?>" />
                      <label class="form-label" for="basic-default-fullname">Số lượng thống kê 2</label>
                      <input class="form-control" type="text" name="numberStatic2" value="<?php echo @$data['numberStatic2'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Nội dung thống kê 3</label>
                      <input class="form-control" type="text" name="nameStatic3" value="<?php echo @$data['nameStatic3'];?>" />
                      <label class="form-label" for="basic-default-fullname">Số lượng thống kê 3</label>
                      <input class="form-control" type="text" name="numberStatic3" value="<?php echo @$data['numberStatic3'];?>" />
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Nội dung thống kê 4</label>
                      <input class="form-control" type="text" name="nameStatic4" value="<?php echo @$data['nameStatic4'];?>" />
                      <label class="form-label" for="basic-default-fullname">Số lượng thống kê 4</label>
                      <input class="form-control" type="text" name="numberStatic4" value="<?php echo @$data['numberStatic4'];?>" />
                  </div>
                </div>
              </div>
              <div class="tab-pane fade row" id="navs-top-evaluate" role="tabpanel">
                <div class="row">
                  
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Mã nhúng bản đồ</label>
                      <textarea style="width: 100%;" rows="5" name="map"><?php echo @htmlspecialchars_decode($data['map']);?></textarea>
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Mã nhúng Messenger Facebook</label>
                      <textarea style="width: 100%;" rows="5" name="messenger"><?php echo @htmlspecialchars_decode($data['messenger']);?></textarea>
                  </div>
                      <!-- <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                          <label class="form-label" for="basic-default-fullname">Mã nhúng màu header và footer</label>
                          <input class="form-control"  name="color" value="<?php echo @htmlspecialchars_decode($data['color']);?>"data-jscolor="">
                      </div> -->
                  <!-- <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Mã nhúng màu logo</label>
                      <input class="form-control"  name="color1" value="<?php echo @htmlspecialchars_decode($data['color1']);?>"data-jscolor="">
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Mã nhúng màu chữ vs số</label>
                      <input class="form-control"  name="color2" value="<?php echo @htmlspecialchars_decode($data['color2']);?>"data-jscolor="">
                  </div>  -->
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Cơ sở</label>
                      <input class="form-control"  name="nameThamMy" value="<?php echo @$data['nameThamMy'];?>"data-jscolor="">
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Điện thoại CSKH</label>
                      <input class="form-control"  name="hotline" value="<?php echo @$data['hotline'];?>"data-jscolor="">
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Email CSKH</label>
                      <input class="form-control"  name="linkMail" value="<?php echo @$data['linkMail'];?>"data-jscolor="">
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                      <input class="form-control"  name="address" value="<?php echo @$data['address'];?>"data-jscolor="">
                  </div>
                  <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                      <label class="form-label" for="basic-default-fullname">Text chân trang</label>
                      <input class="form-control"  name="textfooter" value="<?php echo @$data['textfooter'];?>"data-jscolor="">
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


