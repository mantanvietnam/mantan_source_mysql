<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - Review Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0 form-label">Nhận xét từ các KOL, KOC</h5>
            </div>
            <div class="card-body row ">
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">id album tícktok</label>
                  <input type="number" class="form-control" name="id_album" value="<?php echo @$setting['id_album'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Sản phẩm 1</label>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">tên sản phẩn  </label>
                  <input type="text" class="form-control" name="name_product1" value="<?php echo @$setting['name_product1'];?>" />
                </div>
                  
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Tên video 1 </label>
                  <input type="text" class="form-control" name="name_video_11" value="<?php echo @$setting['name_video_11'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 1</label>
                   <?php showUploadFile('imagevideo11','imagevideo11', @$setting['imagevideo11'],11);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 1</label>
                  <textarea  class="form-control"  name="embedded11"><?php echo @$setting['embedded11']; ?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 1</label>
                  <input type="text" class="form-control" name="youtube_11" value="<?php echo @$setting['youtube_11'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Tên video 2 </label>
                  <input type="text" class="form-control" name="name_video_12" value="<?php echo @$setting['name_video_12'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 2</label>
                   <?php showUploadFile('imagevideo12','imagevideo12', @$setting['imagevideo12'],12);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 2</label>
                  <textarea  class="form-control"  name="embedded12"><?php echo @$setting['embedded12']; ?></textarea>
                </div> <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 2</label>
                  <input type="text" class="form-control" name="youtube_12" value="<?php echo @$setting['youtube_12'];?>" />
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Sản phẩm 2</label>
                </div>
                
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">tên sản phẩn 2 </label>
                  <input type="text" class="form-control" name="name_product2" value="<?php echo @$setting['name_product2'];?>" />
                </div>
                  
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Tên video 1 </label>
                  <input type="text" class="form-control" name="name_video_21" value="<?php echo @$setting['name_video_21'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 1</label>
                   <?php showUploadFile('imagevideo21','imagevideo21', @$setting['imagevideo21'],21);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 1</label>
                  <textarea  class="form-control"  name="embedded21"><?php echo @$setting['embedded21']; ?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 1</label>
                  <input type="text" class="form-control" name="youtube_21" value="<?php echo @$setting['youtube_21'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Tên video 2 </label>
                  <input type="text" class="form-control" name="name_video_22" value="<?php echo @$setting['name_video_22'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 2</label>
                   <?php showUploadFile('imagevideo22','imagevideo22', @$setting['imagevideo22'],22);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 2</label>
                  <textarea  class="form-control"  name="embedded22"><?php echo @$setting['embedded22']; ?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 2</label>
                  <input type="text" class="form-control" name="youtube_22" value="<?php echo @$setting['youtube_22'];?>" />
                </div>

                 <!--  -->
                 <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Sản phẩm 3</label>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">tên sản phẩn  </label>
                  <input type="text" class="form-control" name="name_product3" value="<?php echo @$setting['name_product3'];?>" />
                </div>
                  
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Tên video 1 </label>
                  <input type="text" class="form-control" name="name_video_31" value="<?php echo @$setting['name_video_31'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 1</label>
                   <?php showUploadFile('imagevideo31','imagevideo31', @$setting['imagevideo31'],31);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 1</label>
                  <textarea  class="form-control"  name="embedded31"><?php echo @$setting['embedded31']; ?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 1</label>
                  <input type="text" class="form-control" name="youtube_31" value="<?php echo @$setting['youtube_31'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Tên video 2 </label>
                  <input type="text" class="form-control" name="name_video_32" value="<?php echo @$setting['name_video_32'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 2</label>
                   <?php showUploadFile('imagevideo32','imagevideo32', @$setting['imagevideo32'],32);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 2</label>
                  <textarea  class="form-control"  name="embedded32"><?php echo @$setting['embedded32']; ?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 2</label>
                  <input type="text" class="form-control" name="youtube_32" value="<?php echo @$setting['youtube_32'];?>" />
                </div>
                <!--  -->
                 <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Sản phẩm 4</label>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">tên sản phẩn  </label>
                  <input type="text" class="form-control" name="name_product4" value="<?php echo @$setting['name_product4'];?>" />
                </div>
                  
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Tên video 1 </label>
                  <input type="text" class="form-control" name="name_video_41" value="<?php echo @$setting['name_video_41'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 1</label>
                   <?php showUploadFile('imagevideo41','imagevideo41', @$setting['imagevideo41'],41);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 1</label>
                  <textarea  class="form-control"  name="embedded41"><?php echo @$setting['embedded41']; ?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 1</label>
                  <input type="text" class="form-control" name="youtube_41" value="<?php echo @$setting['youtube_41'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Tên video 2 </label>
                  <input type="text" class="form-control" name="name_video_42" value="<?php echo @$setting['name_video_42'];?>" />
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Ảnh video 2</label>
                   <?php showUploadFile('imagevideo42','imagevideo42', @$setting['imagevideo42'],42);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-">
                  <label class="form-label" for="basic-default-fullname">Mã nhúng tích tiktok 2</label>
                  <textarea  class="form-control"  name="embedded42"><?php echo @$setting['embedded42']; ?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                  <label class="form-label" for="basic-default-fullname">Mã youtube 2</label>
                  <input type="text" class="form-control" name="youtube_42" value="<?php echo @$setting['youtube_42'];?>" />
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