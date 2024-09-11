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
                          Thông tin thách thức
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          kết quả đạt được 
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-image" aria-selected="false">
                          feedback
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-tip" aria-controls="navs-top-image" aria-selected="false">
                          Thử thánh nỗi ngày 
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đền</label>
                              <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Số ngày  (*)</label>
                              <input type="number" class="form-control phone-mask" name="day" id="day" value="<?php echo @$data->day;?>" required />
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
                            <div class="mb-3">
                              <label class="form-label">Giá mới (*)</label>
                              <input type="text" required class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Giá bán cũ</label>
                              <input type="text" class="form-control phone-mask" name="price_old" id="price_old" value="<?php echo @$data->price_old;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Huấn Luyện viên (*)</label>
                              <select class="form-select" name="id_coach" id="id_coach" >
                                <option value="">Chọn huấn Luyện viên</option>
                                <?php 
                                  foreach ($coach as $key => $item) {
                                    if(empty($data->id_coach) || $data->id_coach!=$item->id){
                                      echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                    }else{
                                      echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                    }
                                  }
                                ?>
                              </select>
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
                          <div class="col-md-12"> 
                            <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                             <thead>
                              <tr>
                                <th>Tiêu đề</th>
                                <th>Mô tả ngắn </th>
                                <th>ảnh  </th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodyresult">  
                              <?php
                              $i= 0;
                              if(!empty($listResult)){
                                foreach($listResult as $key => $value){
                                  $i++;
                                    $delete= '<a onclick="deleteResultTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                  
                                  ?>
                                  <tr class="gradeX" id="trResult-<?php echo $i ?>">
                                    <td>
                                        <input type="text" class="form-control phone-mask" name="title_reult[<?php echo $i ?>]" id="title_reult<?php echo $i ?>" value="<?php echo $value->title ?>"/>
                                        <input type="hidden" class="form-control phone-mask" name="id_result[<?php echo $i ?>]" id="id_result<?php echo $i ?>" value="<?php echo $value->id ?>"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" placeholder="" name="description_result[<?php echo $i ?>]" id="description_result<?php echo $i ?>" value="<?php echo $value->description ?>" />
                                    </td>
                                    <td>
                                      <input type="file" class="form-control phone-mask" name="image_result<?php echo $i ?>" id="image_result<?php echo $i ?>" value=""/>
                                      <input type="hidden" class="form-control phone-mask" name="image_result_cu[<?php echo $i ?>]" id="image_result_cu<?php echo $i ?>" value="<?php echo @$value->image; ?>"/>
                                      <p><img src="<?php echo @$value->image; ?>" width="80" /></p>
                                    </td>
                                    <td align="center" class="actions"><?php echo $delete ?></td>
                                  </tr>
                                <?php }}else{
                                  $i++;
                                  ?>
                                  <tr class="gradeX" id="trResult-<?php echo $i ?>">
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="title_reult[<?php echo $i ?>]"  value=""/>
                                       <input type="hidden" class="form-control phone-mask" name="id_result[<?php echo $i ?>]" id="id_result<?php echo $i ?>" value=""/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="description_result[<?php echo $i ?>]"  value=""/>
                                    </td>
                                    <td>
                                      <input type="file" class="form-control phone-mask" name="image_result<?php echo $i ?>" id="image_result<?php echo $i ?>" value=""/>
                                      <input type="hidden" class="form-control phone-mask" name="image_result_cu[<?php echo $i ?>]" id="image_result_cu<?php echo $i ?>" value=""/>
                                    </td>
                                    <td align="center" class="actions"></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table> 

                            <div class="form-group mb-3 col-md-12">
                              <button type="button" class="btn btn-danger" onclick="return addRowResult();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm kết quả </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                            <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                             <thead>
                              <tr>
                                <th>Họ và tên</th>
                                <th>feedback </th>
                                <th>cân nặng</th>
                                <th>ảnh</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodyfeedback">  
                              <?php
                              $y= 0;
                              if(!empty($listFeedback)){
                                foreach($listFeedback as $key => $item){
                                  $y++;
                                 
                                    $delete= '<a onclick="deletefeedbackTr('.$y.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                  
                                  ?>
                                  <tr class="gradeX" id="trfeedback-<?php echo $y ?>">
                                    <td>
                                        <input type="text" class="form-control phone-mask" name="full_name[<?php echo $y ?>]" id="full_name<?php echo $y ?>" value="<?php echo $item->full_name ?>"/>
                                        <input type="hidden" class="form-control phone-mask" name="id_feedback[<?php echo $y ?>]" id="id_feedback<?php echo $y ?>" value="<?php echo $item->id ?>"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" placeholder="" name="feedback[<?php echo $y ?>]" id="feedback<?php echo $y ?>" value="<?php echo $item->feedback ?>" />
                                    </td>
                                    <td>
                                      <input type="number" class="form-control" placeholder="" name="weight[<?php echo $y ?>]" id="weight<?php echo $y ?>" value="<?php echo $item->weight ?>" />
                                    </td>
                                    <td>
                                       <input type="file" class="form-control phone-mask" name="image_feedback<?php echo $y ?>" id="image_feedback<?php echo $i ?>" value=""/>
                                      <input type="hidden" class="form-control phone-mask" name="image_feedback_cu[<?php echo $y ?>]" id="image_feedback_cu<?php echo $i ?>" value="<?php echo @$item->image; ?>"/>
                                      <p><img src="<?php echo @$item->image; ?>" width="80" /></p> 
                                    </td>
                                    <td align="center" class="actions"><?php echo $delete ?></td>
                                  </tr>
                                <?php }}else{
                                  $y++;
                                  ?>
                                  <tr class="gradeX" id="trfeedback-<?php echo $y ?>">
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="full_name[<?php echo $y ?>]"  value=""/>
                                       <input type="hidden" class="form-control phone-mask" name="id_feedback[<?php echo $y ?>]" id="id_feedback<?php echo $y ?>" value=""/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="feedback[<?php echo $y ?>]"  value=""/>
                                    </td>
                                    <td>
                                      <input type="number" class="form-control phone-mask" name="weight[<?php echo $y ?>]"  value=""/>
                                    </td>
                                     <td>
                                       <input type="file" class="form-control phone-mask" name="image_feedback<?php echo $y ?>" id="image_feedback<?php echo $y ?>" value=""/>
                                      <input type="hidden" class="form-control phone-mask" name="image_feedback_cu[<?php echo $y ?>]" id="image_feedback_cu<?php echo $y ?>" value=""/>
                                    </td>
                                    <td align="center" class="actions"></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table> 

                            <div class="form-group mb-3 col-md-12">
                              <button type="button" class="btn btn-danger" onclick="return addRowFeedback();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm Feedback</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-tip" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                            <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                             <thead>
                              <tr>
                                <th>Thử thách</th>
                                <th>ngày</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodytip">  
                              <?php
                              $t= 0;
                              if(!empty($listTip)){
                                foreach($listTip as $key => $item){
                                  $t++;
                                 
                                    $delete= '<a onclick="deletetipTr('.$t.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                  
                                  ?>
                                  <tr class="gradeX" id="trtip-<?php echo $t ?>">
                                    <td>
                                        <input type="text" class="form-control phone-mask" name="tip[<?php echo $t ?>]" id="tip<?php echo $t ?>" value="<?php echo $item->tip ?>"/>
                                        <input type="hidden" class="form-control phone-mask" name="id_tip[<?php echo $t ?>]" id="id_tip<?php echo $t ?>" value="<?php echo $item->id ?>"/>
                                    </td>
                                    <td>
                                      <input type="number" class="form-control" placeholder="" name="day_number[<?php echo $t ?>]" id="day_number<?php echo $t ?>" value="<?php echo $item->day ?>" />
                                    </td>
                                   
                                    <td align="center" class="actions"><?php echo $delete ?></td>
                                  </tr>
                                <?php }}else{
                                  $t++;
                                  ?>
                                  <tr class="gradeX" id="trtip-<?php echo $t ?>">
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="tip[<?php echo $t ?>]"  value=""/>
                                       <input type="hidden" class="form-control phone-mask" name="id_tip[<?php echo $t ?>]" id="id_tip<?php echo $t ?>" value=""/>
                                    </td>
                                    <td>
                                      <input type="number" class="form-control phone-mask" name="day_number[<?php echo $t ?>]"  value=""/>
                                    </td>
                                    
                                    <td align="center" class="actions"></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table> 

                            <div class="form-group mb-3 col-md-12">
                              <button type="button" class="btn btn-danger" onclick="return addRowtip();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm</button>
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
     var row= <?php echo $i ;?>;
   function addRowResult()
    {

        row++;
        $('#tbodyresult tr:last').after('<tr class="gradeX" id="trResult-'+row+'">\
          <td>\
          <input type="text" class="form-control phone-mask" name="title_reult['+row+']"  value=""/>\
          </td>\
          <input type="hidden" class="form-control phone-mask" name="id_result['+row+']" id="id_result'+row+'" value=""/>\
          <td>\
          <input type="text" class="form-control phone-mask" name="description_result['+row+']"  value=""/>\
          </td>\
          <td>\
          <input type="file" class="form-control phone-mask" name="image_result'+row+'" id="image_result'+row+'" value=""/>\
          <input type="hidden" class="form-control phone-mask" name="image_result_cu['+row+']" id="image_result_cu'+row+'" value=""/>\
          </td>\
          <td align="center" class="actions"><a onclick="deleteResultTr('+row+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td>\
          </tr>');
    }

    function deleteResultTr(i)
    {
        row--;
        $('#trResult-'+i).remove();
       
    }


     var f= <?php echo $y ;?>;
   function addRowFeedback()
    {

        f++;
        $('#tbodyfeedback tr:last').after('<tr class="gradeX" id="trfeedback-'+f+'">\
          <td>\
          <input type="text" class="form-control phone-mask" name="full_name['+f+']"  value=""/>\
          </td>\
          <input type="hidden" class="form-control phone-mask" name="id_feedback['+f+']" id="id_feedback'+f+'" value=""/>\
          <td>\
          <input type="text" class="form-control phone-mask" name="feedback['+f+']"  value=""/>\
          </td>\
          <td>\
          <input type="number" class="form-control phone-mask" name="weight['+f+']"  value=""/>\
          </td>\
          <td>\
          <input type="file" class="form-control phone-mask" name="image_feedback'+f+'" id="image_result'+f+'" value=""/>\
          <input type="hidden" class="form-control phone-mask" name="image_feedback_cu['+f+']" id="image_result_cu'+f+'" value=""/>\
          </td>\
          <td align="center" class="actions"><a onclick="deletefeedbackTr('+f+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td>\
          </tr>');
    }

    function deletefeedbackTr(i)
    {
        f--;
        $('#trfeedback-'+i).remove();
       
    }


      var t= <?php echo $t ;?>;
   function addRowtip()
    {

        t+;
        $('#tbodytip tr:last').after('<tr class="gradeX" id="trtip-'+t+'">\
          <td>\
          <input type="text" class="form-control phone-mask" name="tip['+t+']"  value=""/>\
          </td>\
          <input type="hidden" class="form-control phone-mask" name="id_tip['+t+']" id="id_tip'+f+'" value=""/>\
          <td>\
          <input type="number" class="form-control phone-mask" name="day_number['+t+']"  value=""/>\
          </td>\
          <td align="center" class="actions"><a onclick="deletetipTr('+t+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td>\
          </tr>');
    }

    function deletetipTr(i)
    {
        t--;
        $('#trtip-'+i).remove();
       
    }

    

</script>