<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/infoClass">Lớp học</a> /</span>
    Thông tin lớp
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin lớp <?php echo $infoClass->name;?></h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <p class="text-danger">Chú ý: mọi dữ liệu hình ảnh, video, thông tin được nhập lên đồng nghĩa với việc bạn đã cho phép nhà trường được sử dụng cho mục đích truyền thông của trường. Link xem phòng truyền thống: <a href="<?php global $urlHomes; echo $urlHomes;?>" target="_blank"><?php echo $urlHomes;?></a></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin chung
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Giới thiệu chi tiết
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                          Hình ảnh
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tên lớp học (*)</label>
                              <input disabled type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$infoClass->name;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Niên khóa (*)</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="id_year" id="id_year" disabled>
                                  <option value="">Chọn niên khóa</option>
                                  <?php 
                                  if(!empty($years)){
                                    foreach ($years as $key => $item) {
                                      if(empty($infoClass->id_year) || $infoClass->id_year!=$item->id){
                                        echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                      }else{
                                        echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                      }
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Trạng thái</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="status" id="status" disabled>
                                  <option value="active" <?php if(!empty($infoClass->status) && $infoClass->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                                  <option value="lock" <?php if(!empty($infoClass->status) && $infoClass->status=='lock') echo 'selected'; ?> >Khóa</option>
                                </select>
                              </div>
                            </div>

                            
                            
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Link youtube video giới thiệu lớp</label>
                              <input type="text" class="form-control phone-mask" name="video" id="video" value="<?php echo @$infoClass->video;?>" />

                              <?php 
                                if(!empty($infoClass->video)){
                                  $codeYoutube = '';

                                  if(!empty($infoClass->video)){
                                    $codeYoutube = explode('v=', $infoClass->video);

                                    if(!empty($codeYoutube[1])){
                                      $codeYoutube = explode('&', $codeYoutube[1]);

                                      $codeYoutube = $codeYoutube[0];
                                    }else{
                                      $codeYoutube = '';
                                    }
                                  }

                                  echo '  <br/>
                                          <iframe width="360" height="215" src="https://www.youtube.com/embed/'.$codeYoutube.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> ';
                                }
                              ?>
                            </div>

                            

                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Giới thiệu chi tiết về lớp học</label>
                              <textarea name="info" rows="20" class="form-control"><?php echo @$infoClass->info;?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">

                            <div class="mb-3">
                              <label class="form-label">Hình minh họa</label>
                              <?php 
                                showUploadFile('image','image',@$infoClass->image,0);

                                if(!empty($infoClass->image)){
                                  echo '<br/><img src="'.$infoClass->image.'" width="100" />';
                                }
                              ?>
                            </div>
                          </div>
                          
                          <?php 
                            for($i=1; $i<=20; $i++){
                              $stt = 1000 + $i;
                              echo '<div class="col-md-4">
                                      <div class="mb-3">
                                        <label class="form-label">Hình '.$i.'</label>';
                                        showUploadFile('image'.$i,'images['.$i.']',@$infoClass->images[$i],$i);

                                        if(!empty($infoClass->images[$i])){
                                          echo '<br/><img src="'.$infoClass->images[$i].'" width="100" />';
                                        }
                              echo    '</div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="mb-3">
                                        <label class="form-label">Nội dung hình '.$i.'</label>
                                        <input type="text" class="form-control phone-mask" name="des_image['.$i.']"  value="'.@$infoClass->des_image[$i].'" />
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="mb-3">
                                        <label class="form-label">Audio hình '.$i.'</label>';
                                        showUploadFile('audio_image'.$i,'audio_image['.$i.']',@$infoClass->audio_image[$i],$stt);
                              echo      '</div>
                                    </div>';
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>