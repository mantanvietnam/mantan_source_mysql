<?php include(__DIR__.'/../header.php'); ?>

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
            <h5 class="mb-0"> Thông tin giường <?php echo @$data->bed->name ?></h5>
          </div>
          <div class="card-body">
              <p><?php echo @$mess;?></p>
            
              <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="basic-default-email">Khách háng</label>
                          <input required="" type="text" placeholder="Nhập tên hoặc sđt khách hàng" autocomplete="off" class="form-control phone-mask ui-autocomplete-input" name="full_name" id="full_name" value="<?php echo @$data->customer->name.' '.@$data->customer->phone ?>">
                        <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $data->id_customer ?>">
                </div>
                 <div class="col-md-6 mb-3">
                    <label class="form-label" for="basic-default-email">Nhân viên phụ trách</label>
                    <select class="form-select" name="id_staff" id="id_staff">
                        <?php foreach($dataMember as $key => $item){ ?>
                            <option value="<?php echo $item->id ?>" <?php if(isset($data->id_staff) && $data->id_staff==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-8">
                   <br> 
                  <h5 class="mb-0">Thông tin dịch vụ </h5>
                  <br>
                        <div class="scroll-table mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th>dịch vụ</th>
                                            <th>Giá</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyService">
                                     <?php
                                    if(!empty($data->userservice)){

                                    $i= 0;
                                        foreach($data->userservice as $key => $item){
                                            $i++;
                                    $delete= '';
                                    if($i > 1){
                                        $delete= '<a onclick="deleteService('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }
                                            $quantity = 0;
                                          //  $quantity = $modelUserserviceHistories->find()->where(array('id_order_details'=>$item->id_order_details, 'id_services'=>$item->id_services))->count(); 
                                       echo '<tr class="gradeX" id="trService-'.$i.'">
                                             <td>
                                                    <select onchange="checkUnit('.$i.');" name="idService['.$i.']" id="idService-'.$i.'"  class="form-select color-dropdown">
                                                        <option value="">Chọn dịch vụ</option>';
                                                        foreach ($CategoryService as $cService) { 
                                                            echo '<optgroup label="'.$cService->name.'">';
                                                            if(!empty($cService->service)){
                                                                foreach($cService->service as $service){
                                                                    if($item->id_services==$service->id){
                                                                        $select= 'selected';
                                                                        //$unit= $product['unit'];
                                                                    }else{
                                                                        $select= '';
                                                                    }
                                                                    echo '<option data-unit="'.@$service->id.'" '.$select.' value="'.$service->id.'">'.$service->name.'</option>';
                                                               }
                                                            }
                                                            echo '</optgroup>';
                                                        }
                                                    echo '</select>
                                                <input value="'.$item->orderDetail->quantity.'" type="hidden" name="quantityService['.$i.']" id="quantityService-'.$i.'" class="form-control input_money"  placeholder="Số lượng"/></td>
                                            <td><input value="'.$item->orderDetail->price.'" type="number" name="price['.$i.']" id="price-'.$i.'" class="form-control input_money"  onchange="tinhtien();"  placeholder="Số lượng"/></td>
                                            <td></td>

                                        </tr>';
                                    }
                                }
                                ?>
                                        </tbody>
                                    </table>
                               </div>
                            </div>

                    <div class="mb-3 col-md-6">
                          
                    </div>
                    <div class="form-group mb-3 col-md-12">
                    <button type="button" class="btn btn-danger" onclick="return addRowService();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm dịch vụ</button>
                </div>
                <div class="col-md-6 mb-3">
                   <p> <label class="form-label" for="basic-default-email">thành tiền: </label> &nbsp;&nbsp; <strong id="totalPay"><?php echo number_format($data->order->total_pay); ?>đ</strong></p>
                    <input type="hidden"  class="form-control phone-mask ui-autocomplete-input" name="total" id="total" value="<?php echo $data->order->total_pay ?>">
                </div>
                
                </div>
              </div>
                <a href="/listRoomBed" class="btn btn-danger">Quay lại</a> 
                <button style="submit" href="/listRoomBed" class="btn btn-primary">Lưu</button> 
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
    var rows= <?php echo count(@$data->userservice);?>;
    var strings= $('#idService-1').html();
    function addRowService()
    {
        rows++;
        $('#tbodyService tr:last').after('<tr class="gradeX" id="trService-'+rows+'"><td><select onchange="checkUnit('+rows+');" name="idService['+rows+']" id="idService-'+rows+'" class="form-select color-dropdown">'+strings+'</select><input value="1" type="hidden" id="quantityService-'+rows+'" name="quantityService['+rows+']" class="form-control input_money"  placeholder="Số lượng"/></td><td><input value="" type="number" onchange="tinhtien();" name="price['+rows+']" id="price-'+rows+'" class="form-control input_money"  placeholder="giá bạn "/></td><td align="center" class="actions"><a onclick="deleteService('+rows+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td></tr>');

        $('#idService-'+rows+' option:selected').removeAttr('selected');
        $('#soluong-'+rows).val('');

       /* if(rows>1){
            document.getElementById("a_service").style.display = 'block';

        }*/
    }

    function deleteService(i)
    {
        rows--;
        $('#trService-'+i).remove();
         if(rows==1){
            document.getElementById("a_service").style.display = 'none';

        }
    }

    function checkUnit(row){
        var id = $('#idService-'+row).val();

        $.ajax({
                method: 'GET',
                url: '/apis/getbyServicesApi',
                data: { id: id},
                success:function(res){
                    if(res.code==1){
                        $('#price-'+row).val(res.data.price);
                        tinhtien();
                    }
                }
            })

    }

      // tính tiền 
    function tinhtien(){
        var total= 0;
        var i;
        var number;
        var price;
        var idProduct;
        if(rows>0){
            for(i=1;i<=rows;i++){
                 // if ($('#trService-'+i).length > 0) {
                    price= parseInt($('#price-'+i).val());
                    number= parseInt($('#quantityService-'+i).val());
                   money = 0;
                    // if(number<0){
                        money= number*price;
                        total+= money;
                    // }
                     
                 // }
            }
            document.getElementById("total").value = total;
            var showTotal= new Intl.NumberFormat().format(total);
            $('#totalPay').html(showTotal+'đ');

        }
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
                  // tinhtien();
                return false;

              
            }
        });
    });
</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


<?php include(__DIR__.'/../footer.php'); ?>