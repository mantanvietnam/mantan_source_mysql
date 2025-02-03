<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-workout-listWorkout">Chủ đề luyện tập </a> /</span>
    Thông tin chủ đề luyện tập
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
                          Thông tin chủ luyện tập
                        </button>
                      </li>
                       <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-area" aria-controls="navs-top-area" aria-selected="false">
                          cài đặt phần tìm kiếm
                        </button>
                      </li>
                      
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đê tiếng Việt (*)</label>
                              <input required type="text" class="form-control phone-mask" name="title" placeholder="Tiêu đề tiếng Việt" id="title" value="<?php echo @$data->title;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tiêu đê tiếng Anh (*)</label>
                              <input required type="text" class="form-control phone-mask" name="title_en" placeholder="Tiêu đề tiếng Anh" id="title_en" value="<?php echo @$data->title_en;?>" />
                            </div>
                          <div class="mb-3">
                              <label class="form-label">Trạng thái</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="status" id="status">
                                  <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                                  <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                                </select>
                              </div>
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
                           <!--  <div class="mb-3">
                              <label class="form-label">mã youtube</label>
                              <input type="text"  class="form-control phone-mask" name="youtube_code" id="youtube_code" value="<?php echo @$data->youtube_code;?>" />
                            </div> -->
                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn tiếng Vệt </label>
                              <textarea maxlength="160" rows="5" class="form-control" placeholder="Mô tả ngắn tiếng Vệt" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>
                              <div class="mb-3">
                              <label class="form-label">Mô tả ngắn tiếng Anh </label>
                              <textarea maxlength="160" rows="5" class="form-control" placeholder="Mô tả ngắn tiếng Anh" name="description_en" id="description_en"><?php echo @$data->description_en;?></textarea>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="navs-top-area" role="tabpanel">
                       <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">chọn tìm khiếm theo thời gian</label>
                               <div class="row">
                              <?php if(!empty($searchtime)){
                                 $time = array();
                                 if(!empty($data->search['time'])){
                                  $time = json_decode($data->search['time'], true);
                                  }
                                foreach($searchtime as $key => $item){
                                    $checks = '';
                                    if(!empty($data->search['time'])){
                                      if(!empty($time) && in_array($item['id'],  @$time)){
                                              $checks = 'checked';
                                            }
                                    }
                                    
                                    echo '<div class="mb-3 col-md-3 col-md-6"><input type="checkbox" '.$checks.' name="time[]" value="'.$item['id'].'"> <label class="form-label">'.$item['title'].'</label>';

                                echo '</div>';
                                }
                            } ?>
                          </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">chọn tìm khiếm theo khu vự tập</label>
                               <div class="row">
                              <?php if(!empty($listarea)){
                                 $area = array();
                                 if(!empty($data->search['area'])){
                                  $area = json_decode($data->search['area'], true);
                                  }
                                foreach($listarea as $key => $item){
                                    $checks = '';
                                    if(!empty($data->search['area'])){
                                      if(!empty($area) && in_array(@$item->id,  @$area)){
                                              $checks = 'checked';
                                            }
                                    }
                                    
                                    echo '<div class="mb-3 col-md-3 col-md-6"><input type="checkbox" '.$checks.' name="area[]" value="'.$item->id.'"> <label class="form-label">'.$item->name.'</label>';

                                echo '</div>';
                                }
                            } ?>
                            </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">chọn tìm khiếm theo cấp đột tập </label>
                               <div class="row">
                              <?php if(!empty($listLevel)){
                                 $level = array();
                                 if(!empty($data->search['level'])){
                                  $level = json_decode($data->search['level'], true);
                                  }
                                foreach($listLevel as $key => $item){
                                    $checks = '';
                                    if(!empty($data->search['level'])){
                                     if(!empty(@$level) && in_array(@$item['id'],  @$level)){
                                              $checks = 'checked';
                                            }
                                    }
                                    
                                    echo '<div class="mb-3 col-md-3 col-md-6"><input type="checkbox" '.$checks.' name="level[]" value="'.$item['id'].'"> <label class="form-label">'.$item['name'].'</label>';

                                echo '</div>';
                                }
                            } ?>
                            </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">chọn tìm khiếm theo cấp đột tập </label>
                               <div class="row">
                              <?php if(!empty($listdevice)){
                                 $device = array();
                                 if(!empty($data->search['device'])){
                                  $device = json_decode($data->search['device'], true);
                                  }
                                foreach($listdevice as $key => $item){
                                    $checks = '';
                                    if(!empty($data->search['device'])){
                                      if(!empty(@$device) && in_array($item['id'],  @$device)){
                                              $checks = 'checked';
                                            }
                                    }
                                    
                                    echo '<div class="mb-3 col-md-3 col-md-6"><input type="checkbox" '.$checks.' name="device[]" value="'.$item['id'].'"> <label class="form-label">'.$item['name'].'</label>';

                                echo '</div>';
                                }
                            } ?>
                            </div>
                            </div>
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