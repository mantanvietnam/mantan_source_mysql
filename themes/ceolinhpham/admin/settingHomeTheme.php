<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">   Theme - Home Setting</h4>

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
                         KHỐI GIỚI THIỆU
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                         CÁC SỰ KIỆN
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                          TRUYỀN THÔNG VÀ BÁO CHÍ
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-evaluate" aria-controls="navs-top-image" aria-selected="false">
                          LIÊN HỆ
                        </button>
                      </li>
                    </ul>
            <div class="card-body tab-content ">
                <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                    <div class="row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                            <input class="form-control" type="text" name="titleNav" value="<?php echo @$data['titleNav'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Slogan đầu tiên</label>
                            <input class="form-control" type="text" name="sloganNav" value="<?php echo @$data['sloganNav'];?>" />
                        </div>
                        
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh nền của banner</label>
                            <?php showUploadFile('videoBanner','videoBanner',@$data['videoBanner'],19);?>
                        </div>
                         <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Slogan 1</label>
                            <input class="form-control" type="text" name="sloganBanner1" value="<?php echo @$data['sloganBanner1'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Slogan 2</label>
                            <input class="form-control" type="text" name="sloganBanner2" value="<?php echo @$data['sloganBanner2'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Icon</label>
                            <input class="form-control" type="text" name="iconBanner" value="<?php echo @$data['iconBanner'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Slogan 3</label>
                            <input class="form-control" type="text" name="sloganBanner3" value="<?php echo @$data['sloganBanner3'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Link chi tiết</label>
                            <input class="form-control" type="text" name="linkBanner" value="<?php echo @$data['linkBanner'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh banner</label>
                            <?php showUploadFile('imageBanner','imageBanner',@$data['imageBanner'],18);?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
                    <div class="row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh chân dung</label>
                            <?php showUploadFile('imageIntro','imageIntro',@$data['imageIntro'],17);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Họ tên</label>
                            <input class="form-control" type="text" name="fullName" value="<?php echo @$data['fullName'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Link Facebook</label>
                            <input class="form-control" type="text" name="facebook" value="<?php echo @$data['facebook'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                            <label class="form-label" for="basic-default-fullname">Giới thiệu bản thân</label>
                            <?php showEditorInput('contentIntro','contentIntro',@$data['contentIntro'],1);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Link Youtube</label>
                            <input class="form-control" type="text" name="youtube" value="<?php echo @$data['youtube'];?>" />
                            <label class="form-label" for="basic-default-fullname">Link Instagram</label>
                            <input class="form-control" type="text" name="instagram" value="<?php echo @$data['instagram'];?>" />
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                    <div class="row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh nền của sự kiện</label>
                            <?php showUploadFile('imageBgEvent','imageBgEvent',@$data['imageBgEvent'],16);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8"></div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa sự kiện 1</label>
                            <?php showUploadFile('imageEvent1','imageEvent1',@$data['imageEvent1'],12);?>
                            <label class="form-label" for="basic-default-fullname">Tiêu đề sự kiện 1</label>
                            <input class="form-control" type="text" name="titleEvent1" value="<?php echo @$data['titleEvent1'];?>" />
                            <label class="form-label" for="basic-default-fullname">Icon sự kiện 1</label>
                            <input class="form-control" type="text" name="iconEvent1" value="<?php echo @$data['iconEvent1'];?>" />
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa sự kiện 1 khi chỉ vào</label>
                            <?php showUploadFile('imageEventHover1','imageEventHover1',@$data['imageEventHover1'],13);?>
                            <label class="form-label" for="basic-default-fullname">Link chi tiết bài viết sự kiện 1</label>
                            <input class="form-control" type="text" name="linkEvent1" value="<?php echo @$data['linkEvent1'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa sự kiện 2</label>
                            <?php    showUploadFile('imageEvent2','imageEvent2',@$data['imageEvent2'],14);?>
                            <label class="form-label" for="basic-default-fullname">Tiêu đề sự kiện 2</label>
                            <input class="form-control" type="text" name="titleEvent2" value="<?php echo @$data['titleEvent2'];?>" />
                            <label class="form-label" for="basic-default-fullname">Icon sự kiện 2</label>
                            <input class="form-control" type="text" name="iconEvent2" value="<?php echo @$data['iconEvent2'];?>" />
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa sự kiện 2 khi chỉ vào</label>
                            <?php                    
                                showUploadFile('imageEventHover2','imageEventHover2',@$data['imageEventHover2'],11);
                            ?>
                            <label class="form-label" for="basic-default-fullname">Link chi tiết bài viết sự kiện 2</label>
                            <input class="form-control" type="text" name="linkEvent2" value="<?php echo @$data['linkEvent2'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa sự kiện 3</label>
                            <?php showUploadFile('imageEvent3','imageEvent3',@$data['imageEvent3'],15);?>
                            <label class="form-label" for="basic-default-fullname">Tiêu đề sự kiện 3</label>
                            <input class="form-control" type="text" name="titleEvent3" value="<?php echo @$data['titleEvent3'];?>" />
                            <label class="form-label" for="basic-default-fullname">Icon sự kiện 3</label>
                            <input class="form-control" type="text" name="iconEvent3" value="<?php echo @$data['iconEvent3'];?>" />
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa sự kiện 3 khi chỉ vào</label>
                            <?php showUploadFile('imageEventHover3','imageEventHover3',@$data['imageEventHover3'],10); ?>
                            <label class="form-label" for="basic-default-fullname">Link chi tiết bài viết sự kiện 3</label>
                            <input class="form-control" type="text" name="linkEvent3" value="<?php echo @$data['linkEvent3'];?>" />
                         </div>
                    </div>
                </div>
            <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                <div class="row">
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Ảnh nền của báo chí</label>
                        <?php showUploadFile('imageBgNewpaper','imageBgNewpaper',@$data['imageBgNewpaper'],1); ?>
                     </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8"></div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Ảnh minh họa báo chí 1</label>
                        <?php showUploadFile('imageNewspaper1','imageNewspaper1',@$data['imageNewspaper1'],3);?>
                        <label class="form-label" for="basic-default-fullname">Tiêu đề báo chí 1</label>
                        <input class="form-control" type="text" name="titleNewspaper1" value="<?php echo @$data['titleNewspaper1'];?>" />
                        <label class="form-label" for="basic-default-fullname">Mô tả báo chí 1</label>
                        <input class="form-control" type="text" name="textNewspaper1" value="<?php echo @$data['textNewspaper1'];?>" />
                        <label class="form-label" for="basic-default-fullname">Link bài báo 1</label>
                        <input class="form-control" type="text" name="linkNewspaper1" value="<?php echo @$data['linkNewspaper1'];?>" />
                   </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Ảnh minh họa báo chí 2</label>
                        <?php showUploadFile('imageNewspaper2','imageNewspaper2',@$data['imageNewspaper2'],4);?>
                        <label class="form-label" for="basic-default-fullname">Tiêu đề báo chí 2</label>
                        <input class="form-control" type="text" name="titleNewspaper2" value="<?php echo @$data['titleNewspaper2'];?>" />
                        <label class="form-label" for="basic-default-fullname">Mô tả báo chí 2</label>
                        <input class="form-control" type="text" name="textNewspaper2" value="<?php echo @$data['textNewspaper2'];?>" />
                        <label class="form-label" for="basic-default-fullname">Link bài báo 2</label>
                        <input class="form-control" type="text" name="linkNewspaper2" value="<?php echo @$data['linkNewspaper2'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Ảnh minh họa báo chí 3</label>
                        <?php  showUploadFile('imageNewspaper3','imageNewspaper3',@$data['imageNewspaper3'],5);?>
                        <label class="form-label" for="basic-default-fullname">Tiêu đề báo chí 3</label>
                        <input class="form-control" type="text" name="titleNewspaper3" value="<?php echo @$data['titleNewspaper3'];?>" />
                        <label class="form-label" for="basic-default-fullname">Mô tả báo chí 3</label>
                        <input class="form-control" type="text" name="textNewspaper3" value="<?php echo @$data['textNewspaper3'];?>" />
                        <label class="form-label" for="basic-default-fullname">Link bài báo 3</label>
                        <input class="form-control" type="text" name="linkNewspaper3" value="<?php echo @$data['linkNewspaper3'];?>" />
                    </div>
                </div>
            </div>
            <div class="tab-pane fade row" id="navs-top-evaluate" role="tabpanel">
                <div class="row">
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Mã nhúng bản đồ</label>
                        <textarea class="form-control" style="width: 100%;" rows="5" name="map"><?php echo @htmlspecialchars_decode($data['map']);?></textarea>
                     </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Mã nhúng Messenger Facebook</label>
                        <textarea class="form-control" style="width: 100%;" rows="5" name="messenger"><?php echo @htmlspecialchars_decode($data['messenger']);?></textarea>
                    </div>
                   
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Điện thoại CSKH</label>
                        <input class="form-control" name="hotline" value="<?php echo @$data['hotline'];?>"data-jscolor="">
                    
                        <label class="form-label" for="basic-default-fullname">Email CSKH</label>
                        <input class="form-control"  name="linkMail" value="<?php echo @$data['linkMail'];?>"data-jscolor="">
                     </div>
                      <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">SPA</label>
                        <input class="form-control"  name="nameThamMy" value="<?php echo @$data['nameThamMy'];?>"data-jscolor="">
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                        <input class="form-control"  name="address" value="<?php echo @$data['address'];?>"data-jscolor="">
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