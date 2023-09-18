<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCollectionBill">Phiếu thu</a> /</span>
    Thông tin phiếu thu
  </h4>
  <!-- Basic Layout -->
  <?= $this->Form->create(); ?>
    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Thông tin phiếu thu</h5>
          </div>
          <div class="card-body">
              <p><?php global $type_collection_bill; ?></p>
            
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
                      <div class="col-md-6" id="totalMoney"><?php echo number_format(@$order->total); ?> VNĐ</div>
                    </div>
                   <br>  
                    <div class="form-group row">
                          <label class="col-md-6"><strong>giảm giá:</strong></label>
                          <?php 
                            if($order->promotion>101){
                              $promotion = number_format($order->promotion).'đ';
                            }else{
                               $promotion = $order->promotion.'%';
                            }
                           ?>
                          <div class="col-md-6"><?php echo @$promotion ?></div>
                        </div>
                   <br>  
                    <div class="form-group row">
                        <label class="col-md-6" style="color: blue; font-size: 14px;"><strong>Phải thanh toán:</strong></label>
                            <div class="col-md-6" id="totalPay"><?php echo number_format(@$order->total_pay); ?> VNĐ</div>
                               <input type="hidden" name="totalPays" id="totalPays" value="<?php echo @$data->total_pay; ?>">
                    </div>
                    <br>  
                    <div class="form-group row">
                        <label class="col-md-6"><strong>Hình thức thanh toán</strong></label>
                         <div class="col-md-6" id="totalPay"><?php  echo $type_collection_bill[@$data->type_collection_bill]; ?></div>
                    </div> 
                </div>
                <div class="col-md-12">
                    <br> 
                    <h5 class="mb-0">thông tin sản phẩm</h5>
                    <br>

                        <div class="scroll-table mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th >Sản phẩn</th>
                                            <th >Giá bán</th>
                                            <th >Số lượng </th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyproduct">
                                        <?php 
                                        if(!empty($order->product)){ 
                                             
                                          foreach($order->product as $k => $value){?>
                                    <tr>
                                        <td><?php echo $value->product->name ?></td>
                                        <td><?php echo number_format($value->price) ?></td>
                                        <td><?php echo number_format($value->quantity); ?></td>
                                        <td><?php echo number_format($value->quantity*$value->price) ?>VNĐ</td>
                                    </tr>
                                            <?php }}else{
                                                echo '<tr  id="trProduct-0">
                                                        <td colspan="10" align="center">Chưa có sản phẩm nào</td>
                                                      </tr>';
                                              } ?>
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                </div>
                <div class="col-md-12">
                   <br> 
                  <h5 class="mb-0">thông tin dịch vụ </h5>
                  <br>
                        <div class="scroll-table mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th >dịch vụ</th>
                                            <th >Giá bán</th>
                                            <th >Số lượng </th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyservice">
                                        <?php 
                                        if(!empty($order->service)){ 
                                           
                                          foreach($order->service as $k => $value){?>
                                    <tr>
                                        <td><?php echo $value->service->name ?></td>
                                        <td><?php echo number_format($value->price) ?></td>
                                        <td><?php echo number_format($value->quantity); ?></td>
                                        <td><?php echo number_format($value->quantity*$value->price) ?>VNĐ</td>
                                    </tr>
                                            <?php }}else{
                                                echo '<tr id="trservice-0">
                                                        <td colspan="5" align="center">Chưa có dịch vụ nào</td>
                                                      </tr>';
                                              } ?>
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                </div>
                <div class="col-md-12">
                   <br> 
                  <h5 class="mb-0">thông tin combo</h5>
                  <br>
                        <div class="scroll-table mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th >combo</th>
                                            <th >Giá bán</th>
                                            <th >Số lượng </th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyCombo">
                                        <?php  
                                        if(!empty($order->combo)){ 
                                          foreach($order->combo as $k => $value){ ?>
                                    <tr>
                                        <td><?php echo $value->combo->name ?></td>
                                        <td><?php echo number_format($value->price) ?></td>
                                        <td><?php echo number_format($value->quantity); ?></td>
                                        <td><?php echo number_format($value->quantity*$value->price) ?>VNĐ</td>
                                    </tr>
                                            <?php }}else{
                                                echo '<tr id="trcombo-0" >
                                                        <td colspan="10" align="center">Chưa có combo nào</td>
                                                      </tr>';
                                              } ?>
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                </div>
              </div>
                <a href="/listCollectionBill" class="btn btn-primary">Quay lại</a> 
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>



<?php include(__DIR__.'/../footer.php'); ?>