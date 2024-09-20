<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-challenge-listChallenge">Thách thức </a> /</span>
    Thông tin sản phẩm
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
                          Thông tin bài tập
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Thiết bị
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-image" aria-selected="false">
                          nhóm tập
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề</label>
                              <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Mã Youtube(*)</label>
                              <input type="text" class="form-control phone-mask" name="youtube_code" id="youtube_code" value="<?php echo @$data->youtube_code;?>" required />
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
                              <label class="form-label">Thời gian</label>
                              <input type="number" class="form-control phone-mask" name="time" id="time" value="<?php echo @$data->time;?>" required />
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
                              <label class="form-label">Cấp độ (*)</label>
                              <select class="form-select" name="level" id="level" >
                                <option value="">Chọn Cấp độ</option>
                                <?php 
                                global $listLevel;

                                  foreach ($listLevel as $key => $item) {
                                    if(empty($data->level) || $data->level!=$item){
                                      echo '<option value="'.$item.'">'.$item.'</option>';
                                    }else{
                                      echo '<option selected value="'.$item.'">'.$item.'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Khu vực (*)</label>
                              <select class="form-select" name="area" id="area" >
                                <option value="">Chọn khu vực</option>
                                <?php 
                                global $listArea;

                                  foreach ($listArea as $key => $item) {
                                    if(empty($data->area) || $data->level!=$area){
                                      echo '<option value="'.$item.'">'.$item.'</option>';
                                    }else{
                                      echo '<option selected value="'.$item.'">'.$item.'</option>';
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                             <div class="mb-3">
                              <label class="form-label">đối cháy kcal</label>
                              <input type="number" class="form-control phone-mask" name="kcal" id="kcal" value="<?php echo @$data->kcal;?>" required />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Hình minh họa khu vực  (*)</label>
                               <input type="file" class="form-control phone-mask" name="area_image" id="area_image" value=""/>
                              <?php
                              if(!empty($data->area_image)){
                                echo '<br/><img src="'.$data->area_image.'" width="80" />';
                              }
                              ?>
                            </div>
                           
                           

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                          <div class="row">
                           <?php if(!empty($listdevice)){
                                foreach($listdevice as $key => $item){
                                    $checks = '';
                                    if(in_array($item->id, $data->device)){
                                              $checks = 'checked';
                                            }
                                    echo '<div class="mb-3 col-md-3"><input type="checkbox" '.$checks.' name="device[]" value="'.$item->id.'"> <label class="form-label">'.$item->name.'</label></br>
                                            <img src="' . $item->image . '" width="60" />';

                                echo '</div>';
                                }
                            } ?>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                            <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                             <thead>
                              <tr>
                                <th>Tên nhóm tập</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodyfeedback">  
                              <?php
                              $y= 0;
                              if(!empty($data->group_exercise)){
                                foreach($data->group_exercise as $key => $item){
                                  $y++;
                                 
                                    $delete= '<a onclick="deletefeedbackTr('.$y.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                  
                                  ?>
                                  <tr class="gradeX" id="trfeedback-<?php echo $y ?>">
                                    <td>
                                        <input type="text" class="form-control phone-mask" name="group_exercise[<?php echo $y ?>]" id="group_exercise<?php echo $y ?>" value="<?php echo $item ?>"/>
                                    </td>
                                    
                                    <td align="center" class="actions"><?php echo $delete ?></td>
                                  </tr>
                                <?php }}else{
                                  $y++;
                                  ?>
                                  <tr class="gradeX" id="trfeedback-<?php echo $y ?>">
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="group_exercise[<?php echo $y ?>]"  value=""/>
                                    </td>
                                    <td align="center" class="actions"></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table> 

                            <div class="form-group mb-3 col-md-12">
                              <button type="button" class="btn btn-danger" onclick="return addRowFeedback();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm nhóm</button>
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
<script type="text/javascript">

     var f= <?php echo $y ;?>;
   function addRowFeedback()
    {

        f++;
        $('#tbodyfeedback tr:last').after('<tr class="gradeX" id="trfeedback-'+f+'">\
          <td>\
          <input type="text" class="form-control phone-mask" name="group_exercise['+f+']"  value=""/>\
          </td>\
          <td align="center" class="actions"><a onclick="deletefeedbackTr('+f+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td>\
          </tr>');
    }

    function deletefeedbackTr(i)
    {
        f--;
        $('#trfeedback-'+i).remove();
       
    }
</script>