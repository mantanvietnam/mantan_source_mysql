<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin">Bối cảnh</a> /</span>
    Thông tin bối cảnh
  </h4>
  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class=" mb-12">
        <div class="card-body">
          <p><?php echo $mess;?></p>
          <?= $this->Form->create(); ?>
          <div class="mb-4">
            <div class="nav-align-top mb-4">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                    THÔNG TIN CHUNG
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                    VIỆT
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                    ANH
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                   TRUNG
                 </button>
               </li>
          </ul>

          <div class="card-body tab-content ">
            <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Mã cảch (*)</label>
                  <input required type="text" class="form-control phone-mask" name="code" id="code" value='<?php echo @$data->code;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Ảnh Đại diện</label>
                  <?php showUploadFile('image','image', @$data['image'],2);?>
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">lat</label>
                  <input  type="text" class="form-control phone-mask" name="lat" id="lat" value='<?php echo @$data->lat;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">lng</label>
                  <input  type="text" class="form-control phone-mask" name="lng" id="lng" value='<?php echo @$data->lng;?>' />
                </div>
                 <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">hlookat</label>
                  <input  type="text" class="form-control phone-mask" name="hlookat" id="hlookat" value='<?php echo @$data->hlookat;?>' />
                </div>
                 <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">vlookat</label>
                  <input  type="text" class="form-control phone-mask" name="vlookat" id="vlookat" value='<?php echo @$data->vlookat;?>' />
                </div>
                 <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">fovtype</label>
                  <input  type="text" class="form-control phone-mask" name="fovtype" id="fovtype" value='<?php echo @$data->fovtype;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">fov</label>
                  <input  type="text" class="form-control phone-mask" name="fov" id="fov" value='<?php echo @$data->fov;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">maxpixelzoom</label>
                  <input  type="text" class="form-control phone-mask" name="maxpixelzoom" id="maxpixelzoom" value='<?php echo @$data->maxpixelzoom;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">fovmin</label>
                  <input  type="text" class="form-control phone-mask" name="fovmin" id="fovmin" value='<?php echo @$data->fovmin;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">fovmax</label>
                  <input  type="text" class="form-control phone-mask" name="fovmax" id="fovmax" value='<?php echo @$data->fovmax;?>' />
                </div>
                 <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Trạng thái:</label>&ensp;
                            <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                            <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                        </div>
              </div>
              
            </div>

            <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Tiêu đề Việt Nam(*)</label>
                  <input required type="text" class="form-control phone-mask" name="title_vi" id="title_vi" value='<?php echo @$data->title_vi;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Audio tiếng Việt Nam</label>
                  <?php showUploadFile('audio_vi','audio_vi', @$data['audio_vi'],3);?>
                </div>
                <div class="mb-3 col-md-12">
                  <label class="form-label" for="basic-default-phone">bài viết việt Nam</label>
                  <?php showEditorInput('info_vn','info_vn',@$data['info_vn'],1); ?> 
                </div>
              
              </div>
              
            </div>

            <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Tiêu đề Anh</label>
                  <input type="text" class="form-control phone-mask" name="title_en" id="title_en" value='<?php echo @$data->title_en;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Audio tiếng Anh</label>
                  <?php showUploadFile('audio_en','audio_en', @$data['audio_en'],4);?>
                </div>
                <div class="mb-3 col-md-12">
                  <label class="form-label" for="basic-default-phone">bài viết Anh</label>
                  <?php showEditorInput('info_en','info_en',@$data['info_en'],2); ?> 
                </div>
              
              </div>
              
            </div>

            <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Tiêu đề Trung Quốc</label>
                  <input  type="text" class="form-control phone-mask" name="title_cn" id="title_cn" value='<?php echo @$data->title_cn;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Audio Trung Quốc</label>
                  <?php showUploadFile('audio_cn','audio_cn', @$data['audio_cn'],1);?>
                </div>
                <div class="mb-3 col-md-12">
                  <label class="form-label" for="basic-default-phone">bài viết Trung Quốc</label>
                  <?php showEditorInput('info_cn','info_cn',@$data['info_cn'],1); ?> 
                </div>
              
              </div>
              
            </div>

          <button type="submit" class="btn btn-primary">Lưu</button>
          </div>
         
        </div>
      </div>
       <?= $this->Form->end() ?>
    </div>
  </div>

</div>
</div>
</div>
<script>
  $(function(){
    $( ".datepicker" ).datepicker({
      dateFormat: "dd/mm/yy"
    });
  } );
</script>