<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-workout-listWorkout">Bài luyện tập </a> / <a href="/plugins/admin/colennao-view-admin-workout-listExerciseWorkout/?id_workout=<?php echo @$_GET['id_workout'] ?>"><?php echo $dataWorkout->title; ?></a> / <a href="/plugins/admin/colennao-view-admin-workout-listChildExerciseWorkout/?id_workout=<?php echo @$_GET['id_workout'] ?>&id_exercise=<?php echo @$_GET['id_exercise']?>"><?php echo $dataExercise->title; ?></a> /</span>
    Thông tin động tác tập 
  </h4>

  <!-- Basic Layout nav-align-top-->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-body">
            <p><?php echo @$mess; ?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-12">
                  <div class=" mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin động tác tập
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Thiết bị
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-vn" aria-controls="navs-top-image" aria-selected="false">
                          Nội dung tập tiếng Việt
                        </button>
                      </li>
                       <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-en" aria-controls="navs-top-image" aria-selected="false">
                          Nội dung tập tiếng Anh
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề tiếng Việt</label>
                              <input required type="text" class="form-control phone-mask" placeholder="Tiêu đề tiếng Việt" name="title" id="title" value="<?php echo @$data->title;?>" />
                            </div>
                             <div class="mb-3">
                              <label class="form-label">Tiêu đề tiếng Anh</label>
                              <input required type="text" class="form-control phone-mask" placeholder="Tiêu đề tiếng Anh" name="title_en" id="title_en" value="<?php echo @$data->title_en;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Mã Youtube(*)</label>
                              <input type="text" class="form-control phone-mask" name="youtube_code" id="youtube_code" value="<?php echo @$data->youtube_code;?>" required />
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Thời gian tính thành giây</label>
                              <input type="number" class="form-control phone-mask" name="time" id="time" value="<?php echo @$data->time;?>" required placeholder="thời gian tính thành giây"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Hình minh họa (*)</label>
                               <input type="file" class="form-control phone-mask" name="image" id="image" value=""/>
                              <?php
                              if(!empty($data->image)){
                                echo '<br/><img src="'.$data->image.'" width="80" />';
                              }
                              ?>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Nhóm tập(*)</label>
                              <select class="form-select" name="id_group" id="id_group" >
                                <option value="">Chọn khu vực</option>
                                <?php 
                                if(!empty($dataExercise->group_exercise)){
                                  foreach ($dataExercise->group_exercise as $key => $item) {
                                    if(empty($data->id_group) || $data->id_group!=$item['id']){
                                      echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                                    }else{
                                      echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
                                    }
                                  }
                                }
                                ?>
                              </select>
                            </div>
                             <div class="mb-3">
                              <label class="form-label">Mô tả ngắn tiếng Việt</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn tiếng Anh</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description_en" id="description"><?php echo @$data->description_en;?></textarea>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                          <div class="row">
                           <?php if(!empty($listdevice)){
                                foreach($listdevice as $key => $item){
                                    $checks = '';
                                     if(!empty($dataExercise->device) && in_array($item->id, @$dataExercise->device)){
                                    
                                      if(!empty($data->device) && in_array($item->id, @$data->device)){
                                              $checks = 'checked';
                                            }
                                    
                                    
                                    echo '<div class="mb-3 col-md-3"><input type="checkbox" '.$checks.' name="device[]" value="'.$item->id.'"> <label class="form-label">'.$item->name.'</label></br>
                                            <img src="' . $item->image . '" width="60" />';

                                echo '</div>';
                              }
                                }
                            } ?>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-vn" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                             <label class="form-label">Nội dung tập tiếng Việt</label>
                            <?php showEditorInput('content', 'content', @$data->content);?>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-en" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                             <label class="form-label">Nội dung tập tiếng Anh</label>
                            <?php showEditorInput('content_en', 'content_en', @$data->content_en);?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>
