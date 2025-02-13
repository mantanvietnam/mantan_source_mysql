<?php include(__DIR__.'/../header.php'); ?>
<style type="text/css">
    table, th, td {
  border: 1px solid #d9dee3;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách đơn Combo liệu trình</h4>
    <p><a href="/orderCombo" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
    
    <div class="data-content">
        <form id="" action="" class="form-horizontal" method="get" enctype="">                          
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
                           <input  type="text"  class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$_GET['full_name'];?>" />
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
                                                <th width="5%">ID</th>
                                                <th width="10%">Thời gian</th>
                                                <th width="15%">Khách hàng</th>
                                                <th width="40%" style="padding: 0px;">
                                                    <table  class="table table-borderless" >
                                                        <thead>
                                                          <th colspan="4" class="text-center">Thông tin</th> 
                                                          <tr>
                                                            <th width="40%">Tên gói</th>
                                                            <th width="40%">Giá bán</th>
                                                            <th width="20%">Số lượng </th>
                                                          </tr>
                                                        </thead>
                                                      </table>
                                                </th>
                                                 <th width="10%">Thành tiền </th> 
                                                 <th width="10%">Chi tiết </th>                                              
                                            </tr>
                                           <!--  <tr>
                                                
                                            </tr> -->
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

                                                        if($item->promotion > 101){
                                                            $promotion = number_format($item->promotion).'đ';
                                                        }else{
                                                            $promotion = (int) $item->promotion.'%';
                                                        }

                                                        if($item->order_details){
                                                            $number_row = count($item->order_details);
                                                        ?>
                                                        <tr> 
                                                            <td>
                                                                <?php echo @$item->id ?>
                                                            </td>
                                                            <td>
                                                                <?php echo date('H:i d/m/Y', $item->time); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $item->full_name ?>
                                                            </td>

                                                            <td style="padding: 0px;">
                                                                <table  class="table table-borderless">
                                                                    <tbody>
                                                                            <?php  
                                                                if(!empty($item->order_details)){ 
                                                                    foreach($item->order_details as $k => $value){ 
                                                                        echo '  <tr> 
                                                                        <td width="40%">'.$value->info_combo->name.'</td>
                                                                                <td width="40%">'.number_format($value->price).'đ</td>
                                                                                <td width="20%">'.number_format($value->quantity).'</td>';
                                                                    }
                                                                }             
                                                            ?>
                                                                        </tr> 
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                            
                                                            
                                                            <td style="text-align: left;">
                                                                Chưa giảm giá: <?php echo number_format(@$item->total) ?>đ<br/>
                                                                Giảm giá: <?php echo $promotion ?><br/>
                                                                Tổng cộng: <?php echo number_format(@$item->total_pay) ?>đ<br/>
                                                                Trạng thái: <?php echo $type ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn rounded-pill btn-icon btn-outline-secondary" title="Xem đơn hàng" data-bs-toggle="modal" data-bs-target="#basicModal<?php echo $item->id; ?>" >
                                                                    <i class="bx  bx bxs-show"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                        }
                                                    }
                                                }else{
                                                    echo '<tr>
                                                            <td colspan="10" align="center">Chưa có đơn nào</td>
                                                          </tr>';
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
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
    </div>
</div> 
  

<?php   
    if(!empty($listData)){
        foreach($listData as $key => $items){
            if($items->promotion > 101){
                $promotion = number_format($items->promotion).'đ';
            }else{
                $promotion = $items->promotion.'%';
            } ?>     

            <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                <div class="modal-dialog" style="max-width: 70%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Thông tin Combo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-footer" style="display: block;">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><label>ID:</label> <?php echo $items->id ?></p>
                                    <p><label>Tên khách hàng:</label> <?php echo @$items->full_name ?></p>
                                    <p><label>Điện thoại:</label> <?php echo @$items->customer->phone ?></p>
                                    <p><label>Email:</label> <?php echo @$items->customer->email ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><label>Chưa giảm giá:</label> <?php echo number_format(@$item->total) ?>đ </p>
                                    <p><label>Giảm giá:</label> <?php echo $promotion ?></p>
                                    <p><label>Tổng cộng:</label> <?php echo number_format(@$items->total_pay) ?>đ</p>
                                    <p><label>Trạng thái:</label> <?php echo $type ?></p>
                                </div>
                            </div>
                            
                            

                            <table class="table table-bordered" style=" text-align: center; ">
                                <thead>
                                    <tr>
                                        <th rowspan='2'>Combo</th>
                                        <th rowspan='2'>Giá bán</th>
                                        <th rowspan='2'>Số lượng </th> 
                                        <th colspan="4">Thông tin Combo </th>
                                    </tr>
                                    <tr>
                                        <th >Sản phẩm</th>
                                        <th >Loại</th>
                                        <th >Số lượng</th>
                                        <th >Sử dụng</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                        if(!empty($items->order_details)){ 
                                            foreach($items->order_details as $k => $detail){ 
                                                $value = $detail->info_combo;
                                                $number_row = count($value->combo_product)+count($value->combo_service);
                                                ?>
                                                <tr>
                                                    <td rowspan='<?php echo $number_row;?>'><?php echo $value->name ?></td>
                                                    <td rowspan='<?php echo $number_row;?>'><?php echo number_format($detail->price) ?>đ</td>
                                                    <td rowspan='<?php echo $number_row;?>'><?php echo $detail->quantity ?></td>

                                                    <?php 
                                                    foreach($value->combo_product as $key => $item){
                                                        $quantity = $item->quantity_combo*$value->quantity;

                                                        if($key > 0) echo '<tr>';
                                                        
                                                        echo '<td>'.$item->name.'</td>
                                                              <td>Sản phẩn</td>
                                                              <td>'.number_format($quantity).'</td>
                                                              <td></td>
                                                            </tr>';
                                                    } 
                                                    
                                                    foreach($value->combo_service as $key => $item){ 
                                                        $quantity = $modelUserserviceHistories->find()->where(array('id_order_details'=>$detail->id, 'id_services'=>$item->id))->all()->toList();

                                                        $quantity = count($quantity);
                                                        $quantityAll = $item->quantity_combo*$value->quantity;

                                                        if($quantity < $quantityAll){
                                                            $btn = '<a class="btn btn-primary d-block" title="Sử dụng" data-bs-toggle="modal" data-bs-target="#sudung'.$value->id.'" style=" color: white; ">Sử dụng</a>';
                                                        }else{
                                                            $btn = 'Đã hết';
                                                        }

                                                        if($key > 0) echo '<tr>';

                                                        echo '<td>'.$item->name.'</td>
                                                              <td>Dịch vụ </td>
                                                              <td>'.$quantity.'/'.$quantityAll.'</td>
                                                              <td>'.$btn.'</td>
                                                            </tr>';
                                                    } 
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    <?php 
            if(!empty($items->order_details)){ 
                foreach($items->order_details as $k => $detail){
                    $value = $detail->info_combo;

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
                                                        <!-- id order detail -->
                                                        <input type="hidden" value="<?php echo $detail->id; ?>"  name="id">
                                                        <!-- id service -->
                                                        <input type="hidden" value="<?php echo $item->id ?>"  name="id_service">

                                                        <label class="form-label">Chọn giường </label>
                                                        <select  name="id_bed" id="id_bed" required class="form-select color-dropdown">
                                                            <option value="">Chọn giường</option>
                                                            <?php 
                                                            if(!empty($listRoom)){
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
                                                                }
                                                            }
                                                            ?>
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
                    <?php   
                    }
                }
            } 
        }
    }               
?>

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