<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách đơn Combo liệu trình</h4>
    <p><a href="/orderCombo" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
    
    <div class="data-content">
        <form id="" action="" class="form-horizontal" method="get" enctype="">  
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />                        
            <div class=" card mb-4">
                <h5 class="card-header">Tìm kiếm dữ liệu</h5>
                <div class="card-body">
                    <div class=" row">
                        <div class="col-md-1">
                            <label class="form-label">ID</label>
                            <input type="text"  maxlength="100" name="id" id="id" class="ui-autocomplete-input form-control"  value="<?php echo @$_GET['id'] ?>" /> 
                        </div>
                        <div class="mb-3 col-md-3">
                           <label class="form-label" for="basic-default-phone">Khách hàng (*)</label>
                           <input required type="text" required="" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$_GET['full_name'];?>" />
                            <input type="hidden" name="id_customer"  id="id_customer" value="<?php echo (int) @$_GET['id_customer'];?>">
                       </div>
                        <div class="col-md-2">
                            <label class="form-label">Tạo từ ngày</label>
                            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Đến ngày</label>
                            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
                        </div>
                        
                        <div class="col-md-1">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary d-block">Lọc</button>
                        </div>
                    </div> 
                </div>
            </div>
            <div>
                <div class="form-group col-md-12">
                    <div class=" card mb-4">
                        <div class="card-body">
                            <div class="scroll-table mb-3">
                                <?php echo @$mess; ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" style=" text-align: center; ">
                                        <thead>
                                            <tr>
                                                <th rowspan='2'>Id</th>
                                                <th rowspan='2'>thời gian</th>
                                                <th rowspan='2'>khách hàng</th>
                                                <th rowspan="2">Thành tiền </th>
                                                <th rowspan="2">Chi tiết </th>
                                                <th colspan="4">thông tin Combo </th>                                                
                                            </tr>
                                            <tr>
                                                <th >Sản phẩn</th>
                                                <th >Giá bán</th>
                                                <th >Số lượng </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($listData)){
                                                    foreach($listData as $key => $item){ 
                                                        $type = '<span style="color: red">Chưa thanh toán</span>';
                                                        if($item->status==1){
                                                            $type = 'Đã thanh toán';
                                                        }elseif($item->status==2){
                                                            $type = 'Dang sử lý';
                                                        }elseif($item->status==3){
                                                            $type = 'Hủy';
                                                        }
                                                        $checkin ='';
                                                        if(!empty($item->bed) && $item->status==0){
                                                            $checkin ='<a class="dropdown-item" href="/checkinbed?id_order='. $item->id.'&id_bed='. $item->id_bed.'" title="check in"><i class="bx bx-exclude me-1"></i></a>';
                                                        }

                                                        if($item->promotion>101){
                                                          $promotion = number_format($item->promotion).'đ';
                                                        }else{
                                                           $promotion = $item->promotion.'%';
                                                        }
                                                        if($item->product){
                                                        ?>
                                                <tr> 
                                                    <td rowspan='<?php echo count(@$item->product); ?>'><?php echo @$item->id ?></td>
                                                    <td rowspan='<?php echo count($item->product); ?>'><?php echo date('Y-m-d H:i:s', $item->time); ?></td>
                                                    <td rowspan='<?php echo count($item->product); ?>'><?php echo $item->full_name ?></td>
                                                    <td rowspan='<?php echo count($item->product); ?>' style="text-align: left;">Chưa giảm giá <?php echo number_format(@$item->total) ?>đ<br/>
                                                    Giảm giá: <?php echo $promotion ?><br/>
                                                    Tổng cộng: <?php echo number_format(@$item->total_pay) ?>đ<br/>
                                                    Trạng thái: <?php echo $type ?></td>
                                                    <td rowspan='<?php echo count($item->product); ?>'> <a class="btn rounded-pill btn-icon btn-outline-secondary" title="Từ chối" data-bs-toggle="modal"
                            data-bs-target="#basicModal<?php echo $item->id; ?>" ><i class="bx  bx bxs-show"></i></a></td>
                                                            <?php  if(!empty($item->product)){ 
                                                                      foreach($item->product as $k => $value){
                                                                        
                                                                ?>
                                                     
                                                            <td><?php echo $value->name ?></td>
                                                            <td><?php echo number_format($value->price) ?>đ</td>
                                                            <td><?php echo $value->quantity ?></td>

                                                      </tr>
                                                        <?php }} 
                                            }}}else{
                                                echo '<tr>
                                                        <td colspan="10" align="center">Chưa có đơn nào</td>
                                                      </tr>';
                                              } ?>
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>
    </div>
</div>    

<?php   if(!empty($listData)){
           foreach($listData as $key => $items){
            if($items->promotion>101){
              $promotion = number_format($items->promotion).'đ';
            }else{
               $promotion = $items->promotion.'%';
            }

             ?>      
            <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" style="max-width: 70%;" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Thông tin Combo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                               <div class="modal-footer" style="display: block;">
                                <p><label>ID:</label> <?php echo $items->id ?></p>
                                <p><label>Tiên khách hàng:</label> <?php echo $items->full_name ?></p>
                                <p><label>Điện thoại:</label> <?php echo $items->customer->phone ?></p>
                                <p><label>Email:</label> <?php echo $items->customer->email ?></p>
                                <p> Chưa giảm giá: <?php echo number_format(@$item->total) ?>đ <br/>
                                Giảm giá: <?php echo $promotion ?><br/>
                                Tổng cộng: <?php echo number_format(@$items->total_pay) ?>đ<br/>
                                Trạng thái: <?php echo $type ?></td></p>

                                <table class="table table-bordered" style=" text-align: center; ">
                                        <thead>
                                            <tr>
                                                <th rowspan='2'>Sản Combo</th>
                                                <th rowspan='2'>Giá bán</th>
                                                <th rowspan='2'>Số lượng </th> 
                                                <th colspan="4">thông tin Combo </th>
                                            </tr>
                                            <tr>
                                                <th >Sản phẩn</th>
                                                <th >Loại</th>
                                                <th >Số lượng</th>
                                                <th >Sử dụng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($items->product)){ 
                                                    foreach($items->product as $k => $value){
                                                                        
                                                                ?>
                                                    <tr>
                                                            <td rowspan='<?php echo count($value->combo_product)+count($value->combo_service    ); ?>'><?php echo $value->name ?></td>
                                                            <td rowspan='<?php echo count($value->combo_product)+count($value->combo_service); ?>'><?php echo number_format($value->price) ?>đ</td>
                                                            <td rowspan='<?php echo count($value->combo_product)+count($value->combo_service); ?>'><?php echo $value->quantity ?></td>
                                                            <?php foreach($value->combo_product as $key => $item){ ?>
                                                                <td><?php echo $item->name ?></td>
                                                                <td>Sản phẩn </td>
                                                                <td><?php echo $item->quantity_Combo*$value->quantity ?></td>
                                                                <td></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <?php foreach($value->combo_service as $key => $item){ 
                                                                $quantity = 0;
                                                                $quantity = count($modelUserserviceHistories->find()->where(array('id_order_details'=>$value->id, 'id_services'=>$item->id))->all()->toList());



                                                                ?>
                                                                <td><?php echo $item->name ?></td>
                                                                <td>Dịch vụ </td>
                                                                <td><?php echo $quantity.'/'.$item->quantity_Combo*$value->quantity ?></td>
                                                                <td>
                                                                    <?php if($quantity < $item->quantity_Combo*$value->quantity){ ?>
                                                                    <a class="btn btn-primary d-block" title="sử dụng" data-bs-toggle="modal" data-bs-target="#sudung<?php echo $value->id; ?>" style=" color: white; ">Sử dụng</a>
                                                                    <?php }else{ ?>
                                                                Đã hết
                                                            <?php } ?>
                                                                </td>

                                                            <?php } ?>
                                                    
                                                        <?php }} ?>
                                        </tbody>
                                    </table>

                              </div>
                              
                            </div>
                          </div>
                        </div>


                <?php }} 
                  if(!empty($items->product)){ 
                        foreach($items->product as $k => $value){
                    foreach($value->combo_service as $key => $item){ ?>
       
                        <div class="modal fade" id="sudung<?php echo $value->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Dịch vụ <?php echo $item->name ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form id="" action="/addUserService" class="form-horizontal" method="get" enctype=""> 
                                     <div class="modal-footer" style="display: block;">
                                        <div class="card-body">
                                            <div class="row gx-3 gy-2 align-items-center">
                                            <div class="col-md-12">
                                            <input type="hidden" value="<?php echo $value->id; ?>"  name="id">
                                            <input type="hidden" value="<?php echo $item->id ?>"  name="id_service">
                                             <label class="form-label">Chọn gường </label>
                                            <select  name="id_bed" id="id_bed"  class="form-select color-dropdown">
                                                <option value="">Chọn giường</option>
                                                <?php if(!empty($listRoom))
                                                    foreach ($listRoom as $room) { 
                                                        echo '<optgroup label="'.$room->name.'">';
                                                        if(!empty($room->bed)){
                                                            foreach($room->bed as $bed){
                                                                $selected = '';
                                                                if(!empty($_GET['idBed']==$bed->id)){
                                                                    $selected = 'selected';
                                                                }
                                                                echo '<option data-unit="'.@$bed->id.'" '.@$selected.' value="'.$bed->id.'">'.$bed->name.'</option>';
                                                               }
                                                            }
                                                echo '</optgroup>';
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                     <button type="submit" class="btn btn-primary">Sử dụng</button>
                                 </div>
                                </form>
                            
                          </div>
                      </div>
                  </div>
<?php }}} ?>

<script type="text/javascript">
    // tìm khách hàng 
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#full_name" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_customer').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerApi", {
                    key: extractLast( request.term )
                }, response );
            },
            search: function() {
                // custom minLength
                var term = extractLast( this.value );
                if ( term.length < 2 ) {
                    return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
               
                $('#full_name').val(ui.item.label);
                $('#id_customer').val(ui.item.id);
          
                return false;

                tinhtien();
            }
        });
    });
</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../footer.php'); ?>  