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
                Khối banner
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                Giá trị cỗt lõi
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
               Những con số ấn tượng
             </button>
           </li>

         </ul>
         <div class="card-body tab-content ">
          <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh banner</label>
                <?php showUploadFile('image_banner','image_banner', @$setting['image_banner'],1);?>
              </div>

              <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-14 col-lg-14 col-xl-12">
                <label class="form-label" for="basic-default-fullname">CÂU CHUYỆN BUMAS</label>
                <textarea class="form-control" name="content" rows="5"><?php echo @$setting['content'] ?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ảnh nội dung trái</label>
                <?php showUploadFile('image_left','image_left', @$setting['image_left'],2);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">nội dung phải</label>
                <textarea class="form-control" name="content_right" rows="5"><?php echo @$setting['content_right'] ?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">nội dung trái</label>
                <textarea class="form-control" name="content_left" rows="5"><?php echo @$setting['content_left'] ?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ảnh nội dung phải</label>
                <?php showUploadFile('image_right','image_right', @$setting['image_right'],3);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ảnh SỨ MỆNH màng hình máy tính </label>
                <!-- <textarea class="form-control" name="mission" rows="5"><?php echo @$setting['mission'] ?></textarea> -->
                <?php showUploadFile('image_mission1','image_mission1', @$setting['image_mission1'],15);?>

              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ảnh SỨ MỆNH màng hình mobile</label>
                <?php showUploadFile('image_mission2','image_mission2', @$setting['image_mission2'],16);?>

              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 1</label>
                <?php showUploadFile('image_core1','image_core1', @$setting['image_core1'],4);?>
                <label class="form-label" for="basic-default-fullname">Giá trị cốt lõi 1</label>
                <input type="text" class="form-control" name="name_core1" value="<?php echo @$setting['name_core1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 2</label>
                <?php showUploadFile('image_core2','image_core2', @$setting['image_core2'],5);?>
                <label class="form-label" for="basic-default-fullname">Giá trị cốt lõi 2</label>
                <input type="text" class="form-control" name="name_core2" value="<?php echo @$setting['name_core2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 3</label>
                <?php showUploadFile('image_core3','image_core3', @$setting['image_core3'],6);?>
                <label class="form-label" for="basic-default-fullname">Giá trị cốt lõi 3</label>
                <input type="text" class="form-control" name="name_core3" value="<?php echo @$setting['name_core3'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 4</label>
                <?php showUploadFile('image_core4','image_core4', @$setting['image_core4'],7);?>
                <label class="form-label" for="basic-default-fullname">Giá trị cốt lõi 4</label>
                <input type="text" class="form-control" name="name_core4" value="<?php echo @$setting['name_core4'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 5</label>
                <?php showUploadFile('image_core5','image_core5', @$setting['image_core5'],8);?>
                <label class="form-label" for="basic-default-fullname">Giá trị cốt lõi 5</label>
                <input type="text" class="form-control" name="name_core5" value="<?php echo @$setting['name_core5'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
            <div class="card-body row ">

              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 1</label>
                <?php showUploadFile('image_impression1','image_impression1', @$setting['image_impression1'],9);?>
                <label class="form-label" for="basic-default-fullname">Con số ấn tượng 1</label>
                <input type="text" class="form-control" name="name_impression1" value="<?php echo @$setting['name_impression1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 2</label>
                <?php showUploadFile('image_impression2','image_impression2', @$setting['image_impression2'],10);?>
                <label class="form-label" for="basic-default-fullname">Con số ấn tượng 2</label>
                <input type="text" class="form-control" name="name_impression2" value="<?php echo @$setting['name_impression2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 3</label>
                <?php showUploadFile('image_impression3','image_impression3', @$setting['image_impression3'],11);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 4</label>
                <?php showUploadFile('image_impression4','image_impression4', @$setting['image_impression4'],12);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <label class="form-label" for="basic-default-fullname">Ảnh 5</label>
                <?php showUploadFile('image_impression5','image_impression5', @$setting['image_impression5'],13);?>
              </div>

              <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 row">
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Ảnh tập thể nhân viên</label>
                  <?php showUploadFile('image','image', @$setting['image'],14);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Nội dung dưới cùng </label>
                  <textarea class="form-control" name="content_below" rows="5"><?php echo @$setting['content_below'] ?></textarea>
                </div>
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