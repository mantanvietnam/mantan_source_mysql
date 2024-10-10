<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-reward-listRewardAdmin">Phần thưởng</a> /</span>
    Thông tin phần thưởng
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  mã phần thưởng</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>

            <?= $this->Form->create(); ?>
            <div class="row">
              <div class="col-12">
                <div class=" mb-4">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        Thông tin trả thưởng kiểu 1
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                        Tiền trả thưởng kiểu 2
                      </button>
                    </li>
                    
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-phone">Tên phần thưởng (*)</label>
                            <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                          </div>

                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Ngày bắt đầu (*)</label>
                            <input type="text" required  class="form-control datepicker" placeholder="" name="start_date" id="start_date" value="<?php if(!empty($data->start_date)){  echo date('d/m/Y', @$data->start_date);}?>" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiền thưởng </label>
                            <input type="number"  class="form-control" placeholder="" name="money" id="money" value="<?php echo @$data->money;?>" />
                          </div>
                          <div class="mb-3 col-12 col-sm-12 col-md-12">
                                        <label class="form-label">Hình minh họa *</label>
                                        <?php showUploadFile('image','image',@$data->image,1);?>
                                    </div>
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Trạng thái:</label>&ensp;
                            <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Kích hoạt &ensp;
                            <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Khóa
                          </div>         
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Số lượng cuốc thành công</label>
                            <input type="number"   class="form-control" placeholder="" name="quantity_booking" id="quantity_booking" value="<?php echo @$data->quantity_booking;?>" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Ngày Kết túc (*)</label>
                            <input type="text" required  class="form-control datepicker" placeholder="" name="end_date" id="end_date" value="<?php if(!empty($data->end_date)){  echo date('d/m/Y', @$data->end_date);}?>" />
                          </div>

                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Mô tả ngắn </label>
                            <input type="text" class="form-control" placeholder="" name="note" id="note" value="<?php echo @$data->note;?>" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Kiểu thưởng</label>
                            <div class="input-group input-group-merge">
                              <select class="form-select" name="type" id="type">
                                <option value="1" <?php if(!empty($data->type) && $data->type=='1') echo 'selected'; ?> >Thưởng cả tổng số cuốc</option>
                                <option value="2" <?php if(!empty($data->type) && $data->type=='2') echo 'selected'; ?> >Thưởng từng cuốc</option>
                              </select>
                            </div>
                          </div>


                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-message">Nội dung bải viết</label>
                                        <?php showEditorInput('content', 'content', @$data->content);?>
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
                                <th>Số cuốc tối da</th>
                                <th>Số tiền thưởng / cuốc</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodyfeedback">  
                              <?php
                              $y= 0;
                              if(!empty($data->bonu)){
                                
                                foreach($data->bonu as $key => $item){
                                  $y++;
                                 
                                    $delete= '<a onclick="deletefeedbackTr('.$y.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                  
                                  ?>
                                  <tr class="gradeX" id="trfeedback-<?php echo $y ?>">
                                    <td>
                                        <input type="number" class="form-control phone-mask" name="soluong_cuoc[<?php echo $y ?>]" id="soluong_cuoc<?php echo $y ?>" value="<?php echo @$item['soluong_cuoc'] ?>" />
                                    </td>
                                    <td>
                                        <input type="number" class="form-control phone-mask" name="tien_thuong[<?php echo $y ?>]" id="tien_thuong<?php echo $y ?>" value="<?php echo @$item['tien_thuong'] ?>" />
                                    </td>
                                    
                                    <td align="center" class="actions"><?php echo $delete ?></td>
                                  </tr>
                                <?php }}else{
                                  $y++;
                                  ?>
                                  <tr class="gradeX" id="trfeedback-<?php echo $y ?>">
                                    <td>
                                      <input type="number" class="form-control phone-mask" name="soluong_cuoc[<?php echo $y ?>]"  value="" />
                                    </td>
                                    <td>
                                      <input type="number" class="form-control phone-mask" name="tien_thuong[<?php echo $y ?>]"  value="" />
                                      
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
            <?= $this->Form->end() ?>
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
          <input type="number" class="form-control phone-mask" name="soluong_cuoc['+f+']"  value="" />\
          </td>\
          <td>\
              <input type="number" class="form-control phone-mask" name="tien_thuong['+f+']" id="tien_thuong'+f+'" value="" />\
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