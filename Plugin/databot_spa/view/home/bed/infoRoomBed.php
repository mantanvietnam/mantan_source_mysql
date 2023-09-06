<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listRoomBed">Sơ đồ phòng</a> /</span>
    Thông tin giường <?php echo @$data->bed->name ?>
  </h4>

  <!-- Basic Layout -->
  <?= $this->Form->create(); ?>
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Thông tin giường <?php echo @$data->bed->name ?></h5>
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
                  </div>
                </div>
                <div class="col-md-6">
                  <h5 class="mb-0">Tổng cộng (VNĐ)</h5>
                  <br>
                  <div class="form-group row">
                      <label class="col-md-6"><strong>Tiền phòng:</strong></label>
                      <div class="col-md-6"><?php echo number_format(@$data->total); ?> VNĐ</div>
                  </div>
                  
                  <div class="form-group row">
                      <label class="col-md-6"><strong>giảm giá:</strong></label>
                      <div class="col-md-6"><?php echo number_format(@$data->promotion);  if(@$data->promotion>100){ echo 'VNĐ';}else{ echo '%';} ?></div>
                  </div>
                  
                  <div class="form-group row">
                      <label class="col-md-6" style="color: blue; font-size: 14px;"><strong>Phải thanh toán:</strong></label>
                          <div class="col-md-6"><?php echo number_format(@$data->total_pay); ?> VNĐ</div>
                  </div>
                </div>
                <div class="col-md-12">
                   <br> 
                  <h5 class="mb-0">thông tin sản phẩm dịch vụ </h5>
                  <br>
                            <div class="scroll-table mb-3">
                                <?php echo @$mess; ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" style=" text-align: center; ">
                                        <thead>
                                            <tr>
                                                <th >Sản phẩn</th>
                                                <th >Giá bán</th>
                                                <th >Số lượng </th>
                                                <th >loại </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                                            <?php  if(!empty($data->product)){ 
                                                                      foreach($data->product as $k => $value){
                                                                        if($value->type=='product'){
                                                                            $type ='Sản phẩm';
                                                                        }elseif($value->type=='service') {
                                                                           $type ='Dịch vụ';
                                                                        }elseif($value->type=='combo'){
                                                                            $type ='Combo';
                                                                        }
                                                                ?>
                                                     <tr>
                                                            <td><?php echo $value->prod->name ?></td>
                                                            <td><?php echo number_format($value->price) ?>đ</td>
                                                            <td><?php echo $value->quantity ?></td>
                                                            <td><?php echo $type ?></td>

                                                      </tr>
                                            <?php }}else{
                                                echo '<tr>
                                                        <td colspan="10" align="center">Chưa có sản phẩm nào</td>
                                                      </tr>';
                                              } ?>
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                        
                </div>
              </div>
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>