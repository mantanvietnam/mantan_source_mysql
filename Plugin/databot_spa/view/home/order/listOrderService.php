<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách đơn dịch vụ</h4>
    <p><a href="/orderService" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
    
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
                         <input type="text" class="form-control phone-mask" name="full_name" id="full_name"
                                value="<?php echo @$_GET['full_name']; ?>" />
                            <input type="hidden" name="id_customer" id="id_customer"
                                value="<?php echo (int) @$_GET['id_customer']; ?>">
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
    </form>
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
                                            <th rowspan='2'>ID</th>
                                            <th rowspan='2'>Thời gian</th>
                                            <th rowspan='2'>Khách hàng</th>
                                            <th rowspan="2">Thành tiền</th>
                                            <th colspan="3">Thông tin dịch vụ</th>       
                                            <th rowspan="2">Sử dụng</th>                                
                                        </tr>
                                        <tr>
                                            <th >Dịch vụ</th>
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
                                                    $type = 'Đang xử lý';
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

                                                $count = 0;
                                                if(!empty($item->product)){
                                                    $count = count(@$item->product);
                                                }
                                            ?>
                                            <tr> 
                                                <td rowspan='<?php echo $count; ?>'>
                                                    <a class="btn rounded-pill btn-icon btn-outline-secondary" title="Xem chi tiết" data-bs-toggle="modal"
                                                       data-bs-target="#basicModal<?php echo $item->id; ?>" ><?php echo $item->id ?></a>
                                                </td>
                                                <td rowspan='<?php echo $count; ?>'><?php echo date('H:i d/m/Y', $item->time); ?></td>
                                                <td rowspan='<?php echo $count; ?>'><?php echo $item->full_name.'<br/>'.@$item->customer->phone; ?></td>
                                                <td rowspan='<?php echo $count; ?>' style="text-align: left;">
                                                    Chưa giảm giá <?php echo number_format(@$item->total) ?>đ<br/>
                                                    Giảm giá: <?php echo $promotion ?><br/>
                                                    Tổng cộng: <?php echo number_format(@$item->total_pay) ?>đ<br/>
                                                    Trạng thái: <?php echo $type ?>
                                                </td>
                                                
                                                <?php  
                                                    if(!empty($item->product)){ 
                                                        foreach($item->product as $k => $value){
                                                            $button_use = '';
                                                            if($value->number_uses<$value->quantity){
                                                                $button_use = '<button  type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                   data-bs-target="#sudung'.$value->id.'">Sử dụng</button>';
                                                            }

                                                            if($k==0){
                                                                echo '  <td>'.$value->prod->name.'</td>
                                                                        <td>'.number_format($value->price).'đ</td>
                                                                        <td>'.$value->number_uses.'/'.$value->quantity.'</td>
                                                                        <td>'.$button_use.'</td>
                                                                    ';
                                                            }else{
                                                                echo '      
                                                                        </tr>
                                                                        <tr>
                                                                            <td>'.$value->prod->name.'</td>
                                                                            <td>'.number_format($value->price).'đ</td>
                                                                            <td>'.$value->number_uses.'/'.$value->quantity.'</td>
                                                                            <td>'.$button_use.'</td>
                                                                    ';
                                                            }

                                                            
                                                        }
                                                    }
                                                ?>
                                                
                                            </tr>
                                            <?php 
                                            }
                                        }else{
                                            echo '<tr>
                                            <td colspan="10" align="center">Chưa có đơn nào</td>
                                            </tr>';
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                          <!-- Phân trang -->
                          <div class="demo-inline-spacing">
                              <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                  <?php
                                  if(@$totalPage>0){
                                    if ($page > 5) {
                                        $startPage = $page - 5;
                                    } else {
                                        $startPage = 1;
                                    }

                                    if ($totalPage > $page + 5) {
                                        $endPage = $page + 5;
                                    } else {
                                        $endPage = $totalPage;
                                    }

                                    echo '<li class="page-item first">
                                    <a class="page-link" href="'.$urlPage.'1"
                                    ><i class="tf-icon bx bx-chevrons-left"></i
                                    ></a>
                                    </li>';

                                    for ($i = $startPage; $i <= $endPage; $i++) {
                                        $active= ($page==$i)?'active':'';

                                        echo '<li class="page-item '.$active.'">
                                        <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                        </li>';
                                    }

                                    echo '<li class="page-item last">
                                    <a class="page-link" href="'.$urlPage.$totalPage.'"
                                    ><i class="tf-icon bx bx-chevrons-right"></i
                                    ></a>
                                    </li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                    </div>
                </div>
        </div>
    </div>          
    <?php   if(!empty($listData)){
     foreach($listData as $key => $items){
        if($items->promotion>101){
            $promotion = number_format($items->promotion).'đ';
        }else{
            $promotion = $items->promotion.'%';
        }

          $type = '<span style="color: red">Chưa thanh toán</span>';
        if($items->status==1){
            $type = 'Đã thanh toán';
        }elseif($items->status==2){
             $type = 'Đang xử lý';
        }elseif($items->status==3){
            $type = 'Hủy';
        }

    ?>      
    
    <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Thông tin Dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer" style="display: block;">
                    <div class="row mb-3">
                        <div class="col-md-6"><b>ID:</b> <?php echo $items->id ?></div>
                        <div class="col-md-6"><b>Tên khách hàng:</b> <?php echo $items->full_name ?></div>
                        <div class="col-md-6"><b>Điện thoại:</b> <?php echo $items->customer->phone ?></div>
                        <div class="col-md-6"><b>Email:</b> <?php echo $items->customer->email ?></div>
                        <div class="col-md-6"><b>Giá ban đầu:</b> <?php echo number_format(@$items->total) ?>đ</div>
                        <div class="col-md-6"><b>Giảm giá:</b> <?php echo $promotion ?></div>
                        <div class="col-md-6"><b>Thành tiền:</b> <?php echo number_format(@$items->total_pay) ?>đ</div>
                        <div class="col-md-6"><b>Trạng thái:</b> <?php echo $type ?></div>
                    </div>

                    <table class="table table-bordered" style=" text-align: center; ">
                        <thead>
                            <tr>
                                <th >Dịch vụ</th>
                                <th >Giá bán</th>
                                <th >Số lượng </th>                                                
                                <th >Sử dụng </th>                                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(!empty($items->product)){ 
                              foreach($items->product as $k => $value){

                                ?>
                                <tr>
                                    <td><?php echo $value->prod->name ?></td>
                                    <td><?php echo number_format($value->price) ?>đ</td>
                                    <td><?php echo $value->number_uses.'/'.$value->quantity ?></td>
                                    <td>
                                        <?php if($value->number_uses < $value->quantity){ ?>
                                            <a class="btn btn-primary d-block" title="Sử dụng" data-bs-toggle="modal" data-bs-target="#sudung<?php echo $value->id; ?>" style=" color: white; ">Sử dụng</a>
                                        <?php }else{ ?>
                                            Đã hết
                                        <?php } ?>
                                    </td>

                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                
                    <?php  if(@$items->status==0){ ?>
                        <a href="" data-bs-toggle="modal" data-bs-target="#thanhtoan<?php echo $items->id; ?>"  class="btn btn-primary">Thanh toán</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php  if(!empty($items->product)){ 
    foreach($items->product as $k => $value){?>
        <div class="modal fade" id="sudung<?php echo $value->id; ?>"  name="id">

          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Dịch vụ <?php echo $value->prod->name ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="" action="/addUserService" class="form-horizontal" method="get" enctype=""> 
             <div class="modal-footer" style="display: block;">
                <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-12">
                            <input type="hidden" value="<?php echo $value->id; ?>"  name="id">
                            <input type="hidden" value="<?php echo $value->id_product; ?>"  name="id_service">
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
                            <label class="form-label">Chọn nhân viên phụ trách </label>
                            <select  name="id_staff" required id="id_staff"  class="form-select color-dropdown">
                                <option value="">Chọn nhân viên</option>
                                <?php if(!empty($listStaff)){
                                    foreach ($listStaff as $Staff) {
                                        $selected = '';
                                        if(@$user->id==$Staff->id){
                                            $selected = 'selected';
                                        }
                                        echo '<option data-unit="'.@$Staff->id.'" '.@$selected.'  value="'.$Staff->id.'">'.$Staff->name.'</option>';
                                    }
                                    
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
<?php }} ?>
<!-- ?id_order='.$item->id.'&type=service -->
<div class="modal fade" id="thanhtoan<?php echo $items->id; ?>"  name="id">

          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Thanh toán đơn Dịch vụ <?php echo $value->prod->name ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="" action="/paymentOrders" class="form-horizontal" method="get" enctype=""> 
             <div class="modal-footer" style="display: block;">
                <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-12">
                            <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                            <input type="hidden" value="<?php echo $value->id_product; ?>"  name="id_service">
                            <input type="hidden" value="<?php echo $items->full_name; ?>"  name="full_name">
                            <input type="hidden" value="listOrderService"  name="url">
                            <p><label>Tên khách hàng:</label> <?php echo $items->full_name ?></p>
                            <p><label>Điện thoại:</label> <?php echo $items->customer->phone ?></p>
                            <p>Email:</label> <?php echo $items->customer->email ?></p>
                            <p> Chưa giảm giá: <?php echo number_format(@$items->total) ?>đ <br/>
                                Giảm giá: <?php echo $promotion ?><br/>
                                Tổng cộng: <?php echo number_format(@$items->total_pay) ?>đ<br/>
                                Trạng thái: <?php echo $type ?></p>
                            <label class="form-label">Hình thức thanh toán </label>
                             <?php 
                                $required = '';
                                if(empty($items->customer->card)){
                                $required = 'required';
                             } ?>
                                <select name="type_collection_bill" id="type_collection_bill<?php echo $items->id; ?>" class="form-select color-dropdown" onclick="selecttypebill(<?php echo $items->id; ?>,<?php echo $items->total_pay; ?>)" <?php echo $required; ?>>
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
                                </select>

                                <p id="sotenkhachdua<?php echo $items->id; ?>" style='display: none;'>
                                   <label class="form-label">Số tiền khách đưa</label>

                                   <input type="text" class="money-khach input_money form-control" name="moneyCustomerPay" id="moneyCustomerPay<?php echo $items->id; ?>" value="<?php echo @$items->total_pay; ?>" placeholder="0" required="" min="0" onchange="tinhtien(<?php echo $items->id; ?>);" autocomplete="off">
                                   <input type="hidden" value="<?php echo $items->total_pay; ?>" id="total_pay<?php echo $items->id; ?>"  name="total_pay">
                                   <input type="hidden" name="moneyReturn" id="moneyReturn<?php echo $items->id; ?>" value="">

                               </p>
                                <?php if(!empty($items->customer->card)){ ?>

                                    <label class="form-label">Thẻ trả trước </label>
                                    <select  name="card" id="card"  class="form-select color-dropdown">
                                        <option value="">chọn thẻ trả trước</option>
                                      <?php
                                        foreach ($items->customer->card as $k => $value) {
                                         
                                            echo '<option  value="'.@$value->id.'">'.@$value->infoPrepayCard->name.' (tiền được tiêu '.number_format(@$value->total).')</option>';
                                          
                                        }
                                      ?>
                                    </select>

                                <?php } ?>
                                        <p id="sotentralaikhach<?php echo $items->id; ?>" style='display: none;'><label class="form-label">Số tiền trả lại:</label> <span id="moneyCustomerReturn<?php echo $items->id; ?>"></span></p> 

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thanh toán</button>
            </div>
        </form>

    </div>
</div>
</div>

<?php }} ?>

<script type="text/javascript">
    var typecollectionbill
    function selecttypebill(id, price){
        typecollectionbill = $('#type_collection_bill'+id).val();

        
       if(typecollectionbill=='tien_mat'){
            document.getElementById('sotenkhachdua'+id).style.display = "block";
            document.getElementById('sotentralaikhach'+id).style.display = "block";
        }else{
            document.getElementById('sotenkhachdua'+id).style.display = "none";
            document.getElementById('sotentralaikhach'+id).style.display = "none";
            document.getElementById('moneyCustomerPay'+id).value =price;


        }
    }

    function tinhtien(id){
        var totalPay = $('#total_pay'+id).val();
        var moneyCustomerPay = $('#moneyCustomerPay'+id).val();

        var total  = moneyCustomerPay  - totalPay;

         console.log(total);

        document.getElementById('moneyReturn'+id).value =total;
        var moneyCustomerReturn = new Intl.NumberFormat().format(total);
        $('#moneyCustomerReturn'+id).html(moneyCustomerReturn+'đ');

       

    }
      
</script>

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