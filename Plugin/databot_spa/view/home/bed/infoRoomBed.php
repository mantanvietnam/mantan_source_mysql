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
                   <br>  
                  <div class="form-group row">
                      <label class="col-md-6"><strong>giảm giá:</strong></label>
                      <div class="col-md-6"><input value="<?php echo @$data->promotion ?>" type="number" style="width: 50%;" required="" name="promotion" id="promotions" class="form-control input_money"  /></div>
                  </div>
                   <br>  
                  <div class="form-group row">
                      <label class="col-md-6" style="color: blue; font-size: 14px;"><strong>Phải thanh toán:</strong></label>
                          <div class="col-md-6"><?php echo number_format(@$data->total_pay); ?> VNĐ</div>
                  </div>
                </div>
                <div class="col-md-12">
                   <br> 
                  <h5 class="mb-0">thông tin sản phẩm <button type="button" class="btn btn-danger" onclick="return addRowProduct();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm sản phẩm</button></h5>
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
                                            <th>Thành tiền</th>
                                            <th >Xóa</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyproduct">
                                        <?php  if(!empty($data->product)){ 
                                             $p = 0;
                                          foreach($data->product as $k => $value){
                                            if($value->type=='product'){
                                                $p++;
                                    $delete= '';
                                    if($p > 1){
                                        $delete= '<a onclick="deleteProduct('.$p.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }
                                                ?>
                                    <tr class="gradeX" id="trProduct-<?php echo $p ?>">
                                        <td>
                                            <input value="<?php echo $value->prod->id ?>" type="hidden" required="" name="id_product[<?php echo $p ?>]" id="id_product-<?php echo $p ?>" class="form-control input_money"  />
                                            <input value="<?php echo $value->prod->name ?>" type="text" required="" onclick="return name_product(<?php echo $p ?>);" name="name_product[<?php echo $p ?>]" id="name_product-<?php echo $p ?>" class="form-control input_money"  placeholder="Số lượng"/>
                                        </td>
                                        <td>
                                            <input value="<?php echo $value->price ?>" type="text" required="" name="price_product[<?php echo $p ?>]" id="price_product-<?php echo $p ?>" class="form-control input_money" /></td>
                                        <td>
                                            <input value="<?php echo $value->quantity ?>" type="text" required="" name="quantity_product[<?php echo $p ?>]" id="quantity_product-<?php echo $p ?>" class="form-control input_money"  placeholder="Số lượng"/>
                                        </td>
                                        <td id='total_product-<?php echo $p ?>'>
                                            <?php echo number_format($value->quantity*$value->price) ?>VNĐ
                                            
                                        </td>
                                        <td><?php echo $delete ?></td>
                                    </tr>
                                            <?php }}}else{
                                                echo '<tr>
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
                  <h5 class="mb-0">thông tin dịch vụ <button type="button" class="btn btn-danger" onclick="return addRowService();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm dịch vụ</button></h5>
                  <br>
                        <div class="scroll-table mb-3">
                            <?php echo @$mess; ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th >dịc vụ</th>
                                            <th >Giá bán</th>
                                            <th >Số lượng </th>
                                            <th>Thành tiền</th>
                                            <th >Xóa</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyservice">
                                        <?php  if(!empty($data->product)){ 
                                            $s = 0;
                                          foreach($data->product as $k => $value){
                                            if($value->type=='service'){
                                                $s++;
                                    $delete= '';
                                    if($s > 1){
                                        $delete= '<a onclick="deleteService('.$s.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }?>
                                    <tr class="gradeX" id="trService-<?php echo $s ?>">
                                        <td>
                                            <input value="<?php echo $value->prod->id ?>" type="hidden" required="" name="id_service[<?php echo $s ?>]" id="id_service-<?php echo $s ?>" class="form-control input_money"  />
                                            <input value="<?php echo $value->prod->name ?>" type="text" required="" onclick="return name_service(<?php echo $s ?>);" name="name_service[<?php echo $s ?>]" id="name_service-<?php echo $s ?>" class="form-control input_money"  placeholder="Số lượng"/>
                                        </td>
                                        <td>
                                            <input value="<?php echo $value->price ?>" type="text" required="" name="price_service[<?php echo $s ?>]" id="price_service-<?php echo $s ?>" class="form-control input_money" /></td>
                                        <td>
                                            <input value="<?php echo $value->quantity ?>" type="text" required="" name="quantity_service[<?php echo $s ?>]" id="quantity_service-<?php echo $s ?>" class="form-control input_money"  placeholder="Số lượng"/>
                                        </td>
                                        <td id='total_service-<?php echo $s ?>'>
                                            <?php echo number_format($value->quantity*$value->price) ?>VNĐ
                                            
                                        </td>
                                        <td><?php echo $delete ?></td>
                                    </tr>
                                            <?php }}}else{
                                                echo '<tr>
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
                  <h5 class="mb-0">thông tin combo <button type="button" class="btn btn-danger" onclick="return addRowCombo();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm combo</button></h5>
                  <br>
                        <div class="scroll-table mb-3">
                            <?php echo @$mess; ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" style=" text-align: center; ">
                                    <thead>
                                        <tr>
                                            <th >combo</th>
                                            <th >Giá bán</th>
                                            <th >Số lượng </th>
                                            <th>Thành tiền</th>
                                            <th >Xóa</th>
                                        </tr>
                                    </thead>
                                   <tbody id="tbodyCombo">
                                        <?php  if(!empty($data->product)){ 
                                            $c = 0;
                                          foreach($data->product as $k => $value){
                                            if($value->type=='combo'){
                                                $c++;
                                                $delete= '';
                                                if($c > 1){
                                                    $delete= '<a onclick="deleteCombo('.$c.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                                }?>
                                    <tr class="gradeX" id="trCombo-<?php echo $c ?>">
                                        <td>
                                            <input value="<?php echo $value->prod->id ?>" type="hidden" required="" name="id_combo[<?php echo $c ?>]" id="id_combo-<?php echo $c ?>" class="form-control input_money"  />
                                            <input value="<?php echo $value->prod->name ?>" type="text" required="" name="name_combo[<?php echo $c ?>]" id="name_combo-<?php echo $c ?>" class="form-control input_money"  placeholder="Số lượng"/>
                                        </td>
                                        <td>
                                            <input value="<?php echo $value->price ?>" type="text" required="" name="price_combo[<?php echo $c ?>]" id="price_combo-<?php echo $c ?>" class="form-control input_money" /></td>
                                        <td>
                                            <input value="<?php echo $value->quantity ?>" type="text" required="" name="quantity_combo[<?php echo $c ?>]" id="quantity_combo-<?php echo $c ?>" class="form-control input_money"  placeholder="Số lượng"/>
                                        </td>
                                        <td id='total_combo-<?php echo $c ?>'>
                                            <?php echo number_format($value->quantity*$value->price) ?>VNĐ
                                            
                                        </td>
                                        <td><?php echo $delete ?></td>
                                    </tr>
                                            <?php }}}else{
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

<script type="text/javascript">
     var p= <?php echo $p; ?>;
    var string= $('#id_product-1').html();
    function addRowProduct()
    {
        p++;
        $('#tbodyproduct tr:last').after('<tr class="gradeX" id="trProduct-'+p+'" ?>"><td><input value="" type="hidden" required="" name="id_product['+p+']" id="id_product-'+p+'" class="form-control input_money"  /><input value="" type="text" required="" name="name_product['+p+']" id="name_product-'+p+'" class="form-control input_money"  placeholder="Số lượng"/></td><td><input value="" type="text" required="" name="price_product['+p+']" id="price_product-'+p+'" class="form-control input_money" /></td><td><input value="" type="text" required="" name="quantity_product['+p+']" id="quantity_product-'+p+'" class="form-control input_money"  placeholder="Số lượng"/></td><td id="total_product-'+p+'""></td><td><a onclick="deleteProduct('+p+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td> </tr>');

       
        // $('#soluong-'+row).val('');

        name_product(p);
    }

    function deleteProduct(i)
    {
     
        $('#trProduct-'+i).remove();
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
          
                return false;
            }
        });
        });
    }
</script>
<script type="text/javascript">
     var s= <?php echo $s; ?>;
    var string= $('#id_service-1').html();
    function addRowService()
    {
        s++;
        $('#tbodyservice tr:last').after('<tr class="gradeX" id="trservice-'+s+'" ?>"><td><input value="" type="hidden" required="" name="id_service['+s+']" id="id_service-'+s+'" class="form-control input_money"  /><input value="" type="text" required="" name="name_service['+s+']" id="name_service-'+s+'" class="form-control input_money"  placeholder="Số lượng"/></td><td><input value="" type="text" required="" name="price_service['+s+']" id="price_service-'+s+'" class="form-control input_money" /></td><td><input value="" type="text" required="" name="quantity_service['+s+']" id="quantity_service-'+s+'" class="form-control input_money"  placeholder="Số lượng"/></td><td id="total_service-'+s+'""></td><td><a onclick="deleteService('+s+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td> </tr>');

       
        // $('#soluong-'+row).val('');

        name_service(s);
    }

    function deleteService(i)
    {
     
        $('#trservice-'+i).remove();
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
                console.log('a');
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
          
                return false;
            }
        });
        });
    }
</script>

<script type="text/javascript">
     var c= <?php echo $c; ?>;
    var string= $('#idHangHoa-1').html();
    function addRowCombo()
    {
        c++;
        $('#tbodyCombo tr:last').after('<tr class="gradeX" id="trcombo-'+c+'" ?>"><td><input value="" type="hidden" required="" name="id_combo['+c+']" id="id_combo-'+c+'" class="form-control input_money"  /><input value="" type="text" required="" name="name_combo['+c+']" id="name_combo-'+c+'" class="form-control input_money"  placeholder="Số lượng"/></td><td><input value="" type="text" required="" name="price_combo['+c+']" id="price_combo-'+c+'" class="form-control input_money" /></td><td><input value="" type="text" required="" name="quantity_combo['+c+']" id="quantity_combo-'+c+'" class="form-control input_money"  placeholder="Số lượng"/></td><td id="total_combo-'+c+'""></td><td><a onclick="deleteCombo('+c+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td> </tr>');

       
        // $('#soluong-'+row).val('');

        name_combo(c);
    }

    function deleteCombo(i)
    {
     
        $('#trcombo-'+i).remove();
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
                console.log('a');
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
          
                return false;
            }
        });
        });
    }
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>