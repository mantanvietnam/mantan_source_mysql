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
                <!-- <div class="col-md-6">
                  <h5 class="mb-0">Tổng cộng (VNĐ)</h5>
                  <br>
                  <div class="form-group row">
                      <label class="col-md-6"><strong>Tiền phòng:</strong></label>
                      <div class="col-md-6" id="totalMoney"><?php echo number_format(@$data->total); ?> VNĐ</div>
                       <input type="hidden" name="total" id="total" value="<?php echo @$data->total; ?>">
                  </div>
                   <br>  
                  <div class="form-group row">
                      <label class="col-md-6"><strong>Giảm giá:</strong></label>
                      <div class="col-md-6"><input value="<?php echo @$data->promotion ?>" type="number"  onchange="tinhtien();" style="width: 50%;"  name="promotion" id="promotion" class="form-control input_money"  /></div>
                  </div>
                   <br>  
                  <div class="form-group row">
                      <label class="col-md-6" style="color: blue; font-size: 14px;"><strong>Phải thanh toán:</strong></label>
                          <div class="col-md-6" id="totalPay"><?php echo number_format(@$data->total_pay); ?> VNĐ</div>
                           <input type="hidden" name="totalPays" id="totalPays" value="<?php echo @$data->total_pay; ?>">
                  </div>
                </div> -->
                <!-- <div class="col-md-12">
                   <br> 
                  <h5 class="mb-0">Thông tin sản phẩm <button type="button" class="btn btn-danger" onclick="return addRowProduct();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm sản phẩm</button></h5>
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
                                            <th >Xóa</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyproduct">
                                        <?php  $p = 0;
                                        if(!empty($data->product)){ 
                                             
                                          foreach($data->product as $k => $value){
                                                $p++;
                                    $delete= '';
                                    if($p > 1){
                                        $delete= '<a onclick="deleteProduct('.$p.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }
                                                ?>
                                    <tr class="gradeX" id="trProduct-<?php echo $p ?>">
                                        <td>
                                            <input value="<?php echo $value->product->id ?>" type="hidden" required="" name="id_product[<?php echo $p ?>]" id="id_product-<?php echo $p ?>" class="form-control input_money"  />
                                            <input value="<?php echo $value->product->name ?>" type="text" required="" onclick="return name_product(<?php echo $p ?>);" name="name_product[<?php echo $p ?>]" id="name_product-<?php echo $p ?>" class="form-control input_money"/>
                                        </td>
                                        <td>
                                            <input value="<?php echo $value->price ?>" type="number" required="" name="price_product[<?php echo $p ?>]" id="price_product-<?php echo $p ?>" class="form-control input_money" onchange="tinhtien();" /></td>
                                        <td>
                                            <input value="<?php echo $value->quantity ?>" type="number" required="" name="quantity_product[<?php echo $p ?>]" id="quantity_product-<?php echo $p ?>" class="form-control input_money" onchange="tinhtien();" placeholder="Số lượng"/>
                                        </td>
                                        <td id='total_product-<?php echo $p ?>'>
                                            <?php echo number_format($value->quantity*$value->price) ?>VNĐ
                                            
                                        </td>
                                        <td><?php echo $delete ?></td>
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
                </div> -->
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
                                            <th>Giá bán</th>
                                            <th>lần thừ </th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyservice">
                                        <?php 
                                        if(!empty($data->service)){ 
                                          foreach($data->service as $k => $value){
                                    ?>
                                    
                                    <tr class="gradeX">
                                        <td><?php echo $value->service->name ?></td>
                                        <td><?php echo $value->price ?></td>
                                        <td><?php echo $value->number_uses ?></td>
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
               <!--  <div class="col-md-12">
                   <br> 
                  <h5 class="mb-0">Thông tin combo <button type="button" class="btn btn-danger" onclick="return addRowCombo();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm Combo</button></h5>
                  <br>
                        <div class="scroll-table mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th >Combo</th>
                                            <th >Giá bán</th>
                                            <th >Số lượng </th>
                                            <th>Thành tiền</th>
                                            <th >Xóa</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyCombo">
                                        <?php  $c = 0;
                                        if(!empty($data->combo)){ 
                                          foreach($data->combo as $k => $value){
                                                $c++;
                                                $delete= '';
                                                if($c > 1){
                                                    $delete= '<a onclick="deleteCombo('.$c.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                                }?>
                                    <tr class="gradeX" id="trcombo-<?php echo $c ?>">
                                        <td>
                                            <input value="<?php echo $value->combo->id ?>" type="hidden" required="" name="id_combo[<?php echo $c ?>]" id="id_combo-<?php echo $c ?>" class="form-control input_money"  />
                                            <input value="<?php echo $value->combo->name ?>" type="text" required="" onclick="return name_combo(<?php echo $c ?>);"  name="name_combo[<?php echo $c ?>]" id="name_combo-<?php echo $c ?>" class="form-control input_money"  placeholder="Số lượng"/>
                                        </td>
                                        <td>
                                            <input value="<?php echo $value->price ?>" type="number" required="" onchange="tinhtien();" name="price_combo[<?php echo $c ?>]" id="price_combo-<?php echo $c ?>" class="form-control input_money" /></td>
                                        <td>
                                            <input value="<?php echo $value->quantity ?>" type="number" required="" name="quantity_combo[<?php echo $c ?>]" id="quantity_combo-<?php echo $c ?>" class="form-control input_money" onchange="tinhtien();" placeholder="Số lượng"/>
                                        </td>
                                        <td id='total_combo-<?php echo $c ?>'>
                                            <?php echo number_format($value->quantity*$value->price) ?>VNĐ
                                            
                                        </td>
                                        <td><?php echo $delete ?></td>
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
                </div> -->
              </div>
                <a href="/listRoomBed" class="btn btn-primary">Quay lại</a> 
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>

<!-- <script type="text/javascript">
     var p= <?php echo $p; ?>;
    function addRowProduct()
    {
        p++;
        $('#tbodyproduct tr:last').after('<tr class="gradeX" id="trProduct-'+p+'" ?>"><td><input value="" type="hidden" required="" name="id_product['+p+']" id="id_product-'+p+'" class="form-control input_money"  /><input value="" type="text" required="" name="name_product['+p+']" id="name_product-'+p+'" class="form-control input_money"  placeholder="Số lượng"/></td><td><input value="" type="number" required="" name="price_product['+p+']" id="price_product-'+p+'" onchange="tinhtien();" class="form-control input_money" /></td><td><input value="" type="number" required="" name="quantity_product['+p+']" id="quantity_product-'+p+'" onchange="tinhtien();" class="form-control input_money"  placeholder="Số lượng"/></td><td id="total_product-'+p+'""></td><td><a onclick="deleteProduct('+p+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td> </tr>');

       
        // $('#soluong-'+row).val('');
        $('#trProduct-0').remove();
        name_product(p);
        tinhtien();
    }

    function deleteProduct(i)
    {
     
        $('#trProduct-'+i).remove();
        tinhtien();
    }

    function name_product(number) {

        $(function() {
             function split( val ) {
              return val.split( /,\s*/ );
            }

            function extractLast( term ) {
              return split( term ).pop();
            }
            $( "#name_product-"+number )
            // don't navigate away from the field on tab when selecting an item
            .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_product-'+number).val(0);
            }).autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchProductApi", {
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

               
                $('#name_product-'+number ).val(ui.item.name);
                $('#id_product-'+number).val(ui.item.id);
                $('#price_product-'+number).val(ui.item.price);
                $('#quantity_product-'+number).val(1);
                tinhtien();
          
                return false;
            }
        });
        });
    }
</script>
<script type="text/javascript">
     var s= <?php echo $s; ?>;
    function addRowService()
    {
        s++;
        $('#tbodyservice tr:last').after('<tr class="gradeX" id="trservice-'+s+'" ?>"><td><input value="" type="hidden" required="" name="id_service['+s+']" id="id_service-'+s+'" class="form-control input_money"  /><input value="" type="text" required="" name="name_service['+s+']" id="name_service-'+s+'" class="form-control input_money"  placeholder="Số lượng"/></td><td><input value="" type="number" required="" name="price_service['+s+']" id="price_service-'+s+'" onchange="tinhtien();" class="form-control input_money" /></td><td><input value="" type="number" required="" name="quantity_service['+s+']" id="quantity_service-'+s+'" onchange="tinhtien();" class="form-control input_money"  placeholder="Số lượng"/></td><td id="total_service-'+s+'""></td><td><a onclick="deleteService('+s+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td> </tr>');

       
        // $('#soluong-'+row).val('');
        $('#trservice-0').remove();
        name_service(s);
        tinhtien();
    }

    function deleteService(i)
    {
     
        $('#trservice-'+i).remove();
        tinhtien();
    }

    function name_service(number) {

        $(function() {
             function split( val ) {
              return val.split( /,\s*/ );
            }

            function extractLast( term ) {
              return split( term ).pop();
            }
            $( "#name_service-"+number )
            // don't navigate away from the field on tab when selecting an item
            .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_service-'+number).val(0);
            }).autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchServicesApi", {
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

               
                $('#name_service-'+number ).val(ui.item.name);
                $('#id_service-'+number).val(ui.item.id);
                $('#price_service-'+number).val(ui.item.price);
                $('#quantity_service-'+number).val(1);
                tinhtien();
          
                return false;
            }
        });
        });
    }
</script>

<script type="text/javascript">
     var c= <?php echo $c; ?>;
    function addRowCombo()
    {
        c++;
        $('#tbodyCombo tr:last').after('<tr class="gradeX" id="trcombo-'+c+'" ?>"><td><input value="" type="hidden" required="" name="id_combo['+c+']" id="id_combo-'+c+'" class="form-control input_money"  /><input value="" type="text" required="" name="name_combo['+c+']" id="name_combo-'+c+'" class="form-control input_money"  placeholder="Số lượng"/></td><td><input value="" type="number" required="" name="price_combo['+c+']" id="price_combo-'+c+'" onchange="tinhtien();" class="form-control input_money" /></td><td><input value="" type="number" required="" name="quantity_combo['+c+']" id="quantity_combo-'+c+'" onchange="tinhtien();" class="form-control input_money"  placeholder="Số lượng"/></td><td id="total_combo-'+c+'""></td><td><a onclick="deleteCombo('+c+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td> </tr>');

       
        // $('#soluong-'+row).val('');
        $('#trcombo-0').remove();
        name_combo(c);
        tinhtien();
    }

    function deleteCombo(i)
    {
     
        $('#trcombo-'+i).remove();
        tinhtien();
    }

    function name_combo(number) {

        $(function() {
             function split( val ) {
              return val.split( /,\s*/ );
            }

            function extractLast( term ) {
              return split( term ).pop();
            }
            $( "#name_combo-"+number )
            // don't navigate away from the field on tab when selecting an item
            .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_combo-'+number).val(0);
            }).autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchComboApi", {
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

               
                $('#name_combo-'+number ).val(ui.item.name);
                $('#id_combo-'+number).val(ui.item.id);
                $('#price_combo-'+number).val(ui.item.price);
                $('#quantity_combo-'+number).val(1);
                tinhtien();
          
                return false;

            }
        });
        });
    }
</script>

<script type="text/javascript">
    function tinhtien(){
        var total= 0;
        var i;
        var y;
        var x;
        var number;
        var price;
        var id_product;


        if(p>0){
            for(i=1;i<=p;i++){
                if ($('#trProduct-'+i).length > 0) {
                    number= parseFloat($('#quantity_product-'+i).val());
                    price= parseFloat($('#price_product-'+i).val());

                    id_product= $('#id_product-'+i).val();
                    $('#quantity_product-'+i).css("border","");
                    money = 0;
                    if(number>0){
                        money= number*price;
                        
                        total+= money;
                    }
                     
                    money = new Intl.NumberFormat().format(money);
                    $('#total_product-'+i).html(money+'VNĐ');
                }
            }
        }

        if(s>0){
            for(y=1;y<=s;y++){
                if ($('#trservice-'+y).length > 0) {
                    number= parseFloat($('#quantity_service-'+y).val());
                    price= parseFloat($('#price_service-'+y).val());

                    id_product= $('#id_service-'+y).val();
                    $('#quantity_service-'+y).css("border","");

                    
                    money = 0;
                    if(number>0){
                        money= number*price;
                        
                        total+= money;
                    }
                    money = new Intl.NumberFormat().format(money);
                    $('#total_service-'+y).html(money+'VNĐ');
                }
            }
        }

        if(s>0){
            for(x=1;x<=c;x++){
                if ($('#trcombo-'+x).length > 0) {
                    number= parseFloat($('#quantity_combo-'+x).val());
                    price= parseFloat($('#price_combo-'+x).val());

                    id_product= $('#id_combo-'+x).val();
                    $('#quantity_combo-'+x).css("border","");

                    
                    money = 0;
                    if(number>0){
                        money= number*price;
                        
                        total+= money;
                    }
                    money = new Intl.NumberFormat().format(money);
                    $('#total_combo-'+x).html(money+'VNĐ');
                }
            }
        }

        console.log(total);

        document.getElementById("total").value = total;
        var showTotal= new Intl.NumberFormat().format(total);
        $('#totalMoney').html(showTotal+'VNĐ');

        // giảm giá
        var promotion= $('#promotion').val();
        if(promotion<=100){
            promotion= total*promotion/100;
        }

        // tổng tiền cần thanh toán
        totalPay= total-promotion;
         document.getElementById("totalPays").value = totalPay;
        var showPay= new Intl.NumberFormat().format(totalPay);
        $('#totalPay').html(showPay+'VNĐ');

        moneyCustomerPay = $('#moneyCustomerPay').val();
        var moneyCustomerReturn = new Intl.NumberFormat().format(moneyCustomerPay - totalPay);
        $('#moneyCustomerReturn').html(moneyCustomerReturn+'đ');
    }

</script> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>