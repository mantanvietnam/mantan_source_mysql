<?php include(__DIR__.'/../header.php'); ?>
<?php  

if(@$data->order->promotion>101){
            $promotion = number_format(@$data->order->promotion).'đ';
        }else{
            $promotion = number_format(@$data->order->promotion).'%';
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
 
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Thông tin giường <?php echo @$data->name ?></h5>
          </div>
          <div class="card-body">
              <p><?php echo @$mess;?></p>
            
              <div class="row">
                <div class="col-md-6 mb-3">
                 <div class="row">
                    <div class="col-sm-12 row mb-3">
                        <h5 class="mb-0">Thông tin khách hàng</h5> 
                    </div>
                    
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

                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Chưa giảm giá:</strong></label>
                        <div class="col-sm-8"><?php echo number_format(@$data->order->total) ?>đ</div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Giảm giá:</strong></label>
                        <div class="col-sm-8"><?php echo $promotion ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Tổng cộng:</strong></label>
                        <div class="col-sm-8"><?php echo number_format(@$data->order->total_pay) ?>đ</div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Trạng thái:</strong></label>
                        <div class="col-sm-8"><?php echo $type ?></div>
                    </div>
                    <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Nhân viên:</strong></label>
                        <div class="col-sm-8"><?php echo $data->staff->name; ?> </div>
                    </div>
                     <div class="form-group col-sm-12 row">
                        <label class="col-sm-4 control-label"><strong>Check in:</strong></label>
                        <div class="col-sm-8"> <?php echo date('H:i d/m/Y',$data->order->time); ?> </div>
                    </div>
                </div>
               
                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-sm-12 row mb-3">
                            <h5 class="mb-0">Thông tin dịch vụ </h5>
                        </div>
                    
                    
                        <div class="scroll-table mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th >Dịch vụ</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyservice">
                                    <?php
                                    if(!empty($data->userservice)){
                                        foreach($data->userservice as $key => $item){
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
               
              </div>
                 <?php  if(@$data->order->status==0){ 
                   echo '<a href="" data-bs-toggle="modal" data-bs-target="#thanhtoan"  class="btn btn-primary">Check-out</a>
                   <a href="/editBebOrder?idBed='.@$data->id.'&status=0" class="btn btn-danger">Sửa</a>';
                 }else{
                    echo ' <a href="" data-bs-toggle="modal" data-bs-target="#Checkout"  class="btn btn-primary">Check-out</a>';

                }?>

          </div>
        </div>
      </div>

    </div>
</div>

<div class="modal fade" id="thanhtoan"  name="id">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Thanh toán đơn Dịch vụ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="" action="/paymentOrders" class="form-horizontal" method="get" enctype=""> 
            <input type="hidden" value="<?php echo @$data->order->id; ?>"  name="id">
            <input type="hidden" value="checkout"  name="type">
            <input type="hidden" value="<?php echo $data->id_services; ?>"  name="id_service">
            <input type="hidden" value="<?php echo $data->id; ?>"  name="id_Userservice">
            <input type="hidden" value="<?php echo $data->full_name; ?>"  name="full_name">
            <input type="hidden" value="<?php echo @$data->id; ?>"  name="id_bed">
            <input type="hidden" value="listRoomBed"  name="url">

            <div class="modal-footer" style="display: block;">
                <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-6">
                            <b>Tên khách hàng:</b> <?php echo $data->full_name ?>
                        </div>
                            
                        <div class="col-md-6">
                            <b>Điện thoại:</b> <?php echo @$data->customer->phone ?>
                        </div>

                        <div class="col-md-6">
                            <b>Email:</b> <?php echo @$data->customer->email ?>
                        </div>

                        <div class="col-md-6">
                            <b>Chưa giảm giá:</b> <?php echo number_format(@$data->order->total) ?>đ
                        </div>

                        <div class="col-md-6">
                            <b>Giảm giá:</b> <?php echo $promotion ?>
                        </div>

                        <div class="col-md-6">
                            <b>Thành tiền:</b> <?php echo number_format(@$data->order->total_pay) ?>đ
                        </div>
                        <div class="col-md-12">
                        <b>Check in:</b> <?php echo date('H:i d/m/Y',$data->order->time); ?>
                        </div>

                        <div class="col-md-12">
                            <b class="form-label">Check out</b>
                            <input type="text" name="time_checkout"  id="time_checkout" class="form-control datetimepicker" value="<?php echo date('d/m/Y H:i')?>">
                        </div>

                        <div class="col-md-12">
                            <b class="form-label">Hình thức thanh toán </b>
                            <?php 
                                $required = '';
                                if(empty($data->customer->card)){
                                $required = 'required';
                             } ?>
                            <select name="type_collection_bill" class="form-select color-dropdown" id="type_collection_bill" class="form-select color-dropdown" onclick="selecttypebill(<?php echo @$data->order->total_pay; ?>)" <?php echo $required; ?>>
                                  <option value="">Chọn hình thức thanh toán</option>
                                  <?php
                                  global $type_collection_bill;
                                  foreach ($type_collection_bill as $key => $value) {
                                      if(empty(@$data->type_collection_bill) || @$data->type_collection_bill!=$key){
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                    }else{
                                        echo '<option selected value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                                ?>
                                <!-- <option value="cong_no">Nợ </option> -->
                            </select>
                        </div>

                        <?php if(!empty($data->customer->card)){ ?>
                        <div class="col-md-12">
                            <b class="form-label">Thẻ trả trước </b>
                            <select  name="card" id="card"  class="form-select color-dropdown">
                                <option value="">Chọn thẻ trả trước</option>
                              <?php
                                foreach ($data->customer->card as $k => $value) {
                                 
                                    echo '<option value="'.@$value->id.'">'.@$value->infoPrepayCard->name.' (tiền được tiêu '.number_format(@$value->total).')</option>';
                                  
                                }
                              ?>
                            </select>
                        </div>
                        <?php } ?>

                        <div class="col-md-12" id="sotenkhachdua" style='display: none;'>
                            <b class="form-label">Số tiền khách đưa</b>
                            <input type="text" class="money-khach input_money form-control" name="moneyCustomerPay" id="moneyCustomerPay"placeholder="0" required="" value="<?php echo @$data->order->total_pay; ?>" min="0" onchange="tinhtien();" autocomplete="off">
                            <input type="hidden" value="<?php echo @$data->order->total_pay; ?>" id="total_pay"  name="total_pay">
                            <input type="hidden" name="moneyReturn" id="moneyReturn" value="">
                        </div>

                        <div class="col-md-12" id="sotentralaikhach" style='display: none;'>
                            <b class="form-label">Số tiền trả lại:</b> 
                            <span id="moneyCustomerReturn">0đ</span>
                        </div> 

                        <div class="col-md-12">
                            <b class="form-label">Kết quả sử dụng dịch vụ</b>
                            <textarea class="form-control" name="note"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thanh toán</button>
            </div>
        </form>

    </div>
    </div>
</div>

<div class="modal fade" id="Checkout"  name="id">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1"> Thông tin  Check-out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?= $this->Form->create(); ?>
    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
            <div class="modal-footer" style="display: block;">
                <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-12">
                            <input type="hidden" value="<?php echo @$data->order->id; ?>"  name="id">
                            <input type="hidden" value="checkout"  name="type">
                            <input type="hidden" value="<?php echo $data->id_services; ?>"  name="id_service">
                            <input type="hidden" value="<?php echo $data->id; ?>"  name="id_Userservice">
                            <input type="hidden" value="<?php echo @$data->customer->name; ?>"  name="full_name">
                            <input type="hidden" value="<?php echo @$data->id; ?>"  name="id_bed">
                            <p><label>Tên khách hàng:</label> <?php echo $data->full_name ?></p>
                            <p><label>Điện thoại:</label> <?php echo @$data->customer->phone ?></p>
                            <p><label>Email:</label> <?php echo @$data->customer->email ?></p>
                            <p><label>Check in:</label> <?php echo date('H:i d/m/Y',$data->order->time); ?></p>
                            <p><label class="form-label">Check out</label></p>
                            <input type="text" name="time_checkout"  id="time_checkout" class="form-control datetimepicker" value="<?php echo date('d/m/Y H:i')?>">
                            <p><label class="form-label">Kết quả sử dụng dịch vụ</label></p>
                            <textarea class="form-control" name="note"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thanh toán</button>
            </div>
        
  <?= $this->Form->end() ?>

    </div>
    </div>
</div>

<script type="text/javascript">
    var typecollectionbill
    function selecttypebill(price){
        typecollectionbill = $('#type_collection_bill').val();

        console.log(typecollectionbill);
       if(typecollectionbill=='tien_mat'){
            document.getElementById('sotenkhachdua').style.display = "block";
            document.getElementById('sotentralaikhach').style.display = "block";
        }else{
            document.getElementById('sotenkhachdua').style.display = "none";
            document.getElementById('sotentralaikhach').style.display = "none";
            document.getElementById('moneyCustomerPay').value =price;


        }
    }

    function tinhtien(){
        var totalPay = $('#total_pay').val();
        var moneyCustomerPay = $('#moneyCustomerPay').val();

        var total  = moneyCustomerPay  - totalPay;

         console.log(total);

        document.getElementById('moneyReturn').value =total;
        var moneyCustomerReturn = new Intl.NumberFormat().format(total);
        $('#moneyCustomerReturn').html(moneyCustomerReturn+'đ');

       

    }
      
</script>

<?php include(__DIR__.'/../footer.php'); ?>