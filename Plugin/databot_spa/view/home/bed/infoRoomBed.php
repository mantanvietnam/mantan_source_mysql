<?php include(__DIR__.'/../header.php');

if(@$data->order->promotion>101){
            $promotion = number_format(@$data->order->promotion).'đ';
        }else{
            $promotion = @$data->order->promotion.'%';
        } 
        $type = '<span style="color: red">Chưa thanh toán';
        if(@$data->order->status==1){
            $type = 'Đã thanh toán';
        }
?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listRoomBed">Sơ đồ giường</a> /</span>
    Thông tin giường <?php echo @$data->bed->name ?>
  </h4>
  <!-- Basic Layout -->
  <?= $this->Form->create(); ?>
    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Thông tin giường <?php echo @$data->name ?></h5>
          </div>
          <div class="card-body">
              <p><?php echo @$mess;?></p>
            
              <div class="row">
                <div class="col-md-6">
                 <div class="row">
                    <div class="col-sm-12 row">
                        <h5 class="mb-0">Thông tin khách hàng</h5> 
                    </div>
                    <br><br>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Tên khách hàng:</strong></label>
                        <div class="col-sm-8"><?php echo $data->full_name; ?> </div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Địa chỉ:</strong></label>
                        <div class="col-sm-8"><?php echo @$data->customer->address; ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Điện thoại:</strong></label>
                        <div class="col-sm-8"><?php echo @$data->customer->phone; ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Email:</strong></label>
                        <div class="col-sm-8"><?php echo @$data->customer->email; ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Ngày sinh:</strong></label>
                        <div class="col-sm-8"><?php echo @$data->customer->birthday; ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Ghi chú checkin:</strong></label>
                        <div class="col-sm-8"><?php echo @$data->note; ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Trạng thái:</strong></label>
                        <div class="col-sm-8"><?php echo $type ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Nhân viên:</strong></label>
                        <div class="col-sm-8"><?php echo $data->staff->name; ?> </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                   <br> 
                  <h5 class="mb-0">Thông tin dịch vụ </h5>
                  <br>
                        <div class="scroll-table mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th>dịch vụ</th>
                                            <th>Số Lượng</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyservice">
                                    <?php
                                    if(!empty($data->userservice)){
                                        foreach($data->userservice as $key => $item){
                                            $quantity = 0;
                                            $quantity = $modelUserserviceHistories->find()->where(array('id_order_details'=>$item->id_order_details, 'id_services'=>$item->id_services, 'status <'=>3))->count(); 
                                       echo "<tr>
                                            <td>".$item->service->name."</td>
                                            <td>".number_format($quantity)."/".number_format($item->orderDetail->quantity)."</td>
                                        </tr>";
                                    }
                                }
                                ?>
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                </div>
              </div>
                <a href="/listRoomBed" class="btn btn-primary">Quay lại</a> 
                <?php  if(@$data->order->status==0){ 
                   echo '<a href="/editBebOrder?idBed='.@$data->id.'&status=0" class="btn btn-danger">Sửa</a>';
                 }?>
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>