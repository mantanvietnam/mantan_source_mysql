<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh mục nhập hàng vào kho</h4>
    <div class="data-content">
        <form id="" action="" class="form-horizontal" method="post" enctype="multipart/form-data">  
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />                        
            <div class=" card mb-4">
                <div class="card-body">
                    <div class=" row">
                        <div class="form-group col-md-3">
                            <label class="col-sm-12 control-label">Kho hàng<span class="required">*</span>:</label>
                            <div class="col-sm-12">  
                                <select name="idWarehouse" id="idWarehouse" class="form-select color-dropdown" required="">
                                    <?php 
                                        if(!empty($listWarehouse)){
                                            foreach($listWarehouse as $item){
                                                echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                            }
                                        }else{
                                            echo '<option value="">Chọn kho hàng</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-sm-12 control-label">Thanh toán<span class="required">*</span>:</label>
                            <div class="col-sm-12">
                                <select name="typeBill" class="form-control" >
                                    <option value="tien_mat">Đã thanh toán</option>
                                    <option value="cong_no">Công nợ chi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-sm-12 control-label">Nhà cung cấp (Đối tác):</label>
                            <div class="col-sm-12">
                                <input type="hidden" required="" name="idPartner" id="idPartner" value="<?php echo @$_GET['idPartner'] ?>">  
                                <input type="text" required="" placeholder="Tìm kiếm nhà cung cấp theo tên đối tác"  maxlength="100" name="partner_name" id="partner_name" class="ui-autocomplete-input form-control"  value="<?php echo @$_GET['partner_name'] ?>" /> 
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-sm-12 control-label"></label>
                            <div class="col-sm-12">
                                <a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#basicModal" target="_blank"><i class="bx bx-plus" aria-hidden="true"></i> Thêm đối tác</a>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            
            <div>
                <div class="form-group col-md-12">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <button type="button" class="btn btn btn-danger" onclick="return addRow();">
                                <i class="bx bx-plus" aria-hidden="true"></i> Thêm sản phẩm
                            </button>
                        </div>
                    </div>
                    <div class=" card mb-4">
                        <div class="card-body">
                            <div class="scroll-table mb-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th >Hàng hóa</th>
                                                <th >Số lượng</th>
                                                <th >Đơn giá nhập</th>
                                                <th >Thành tiền</th>
                                                <th>Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php if(empty($listMerchandiseOrder)){ ?>
                                                <tr id="trProduct-1">
                                                    <td>
                                                        <input type="hidden" required="" name="idHangHoa[1]" id="idHangHoa-1" value="">
                                                        <input type="text" required="" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-1" value="" id="searchProduct-1">
                                                    </td>
                                                    
                                                    <td>
                                                        <input value="" type="text" required="" name="soluong[1]" max="7" id="soluong-1" class="form-control"  placeholder="" onchange="tinhtien();"/>
                                                    </td>
                                                    <td>
                                                        <input value="" type="text" required="" name="price[1]" id="price-1" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                    </td>
                                                   
                                                    <td>
                                                        <input value="" type="text" disabled="" name="money[1]" id="money-1" class="form-control input_money"  placeholder=""/>
                                                        </td>
                                                        <td align="center">
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="deleteProduct(1);"><i class="bx bx-trash me-1" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                                <?php }else{ 
                                                                    $dem=0;
                                                                    foreach($listMerchandiseOrder as $item){
                                                                        $dem++;

                                                                        echo '<tr id="trProduct-'.$dem.'">
                                                                                <td>
                                                                                    <input type="hidden" required="" name="idHangHoa['.$dem.']" id="idHangHoa-'.$dem.'" value="'.$item['Merchandise']['id'].'">
                                                                                    <input type="text" required="" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-'.$dem.'" value="'.$item['Merchandise']['name'].'" id="searchProduct-'.$dem.'">
                                                                                </td>
                                                                                
                                                                                <td>
                                                                                    <input value="'.$item['Merchandise']['numberOrder'].'" type="text" required="" name="soluong['.$dem.']" max="7" id="soluong-'.$dem.'" class="form-control "  placeholder="" onchange="tinhtien();"/>
                                                                                </td>
                                                                                <td>
                                                                                    <input value="'.$item['Merchandise']['priceOrder'].'" type="text" required="" name="price['.$dem.']" id="price-'.$dem.'" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                                </td>
                                                                                
                                                                                <td>
                                                                                    <input value="" type="text" disabled="" name="money['.$dem.']" id="money-'.$dem.'" class="form-control input_money"  placeholder=""/>
                                                                                </td>
                                                                                <td align="center">
                                                                                    <a style="color:#fff;" href="javascript:void(0);" onclick="deleteProduct('.$dem.');"><i class="bx bx-trash me-1" aria-hidden="true"></i></a>
                                                                                </td>
                                                                            </tr>';
                                                                    }
                                        }?>
                                        </tbody>
                                        <tbody>
                                            <tr class="gradeX">
                                                <td colspan='4'><b>Tổng tiền</b> </td>
                                                <td colspan='4'><b><span id="totalMoney">0</span>đ</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                            <div class="row ">
                                <div class="text-center col-sm-12">
                                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            
        </form>
    </div>
</div>   

<div class="modal fade" id="basicModal"  name="id">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Thêm đối tác </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>

            </div>
            <form class="">

                <div class="row modal-header">
                    <div id="mess"></div>
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-phone">Tên đối tác (*)</label>
                            <input required type="text" class="form-control phone-mask" name="name" id="name" value="" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input type="email" class="form-control" placeholder="" name="email" id="email" value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                            <input type="text" required class="form-control" placeholder="" name="phone" id="phone" value="" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="" name="address" id="address" value="" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" onclick="addPartnerAjax();" style=" width: 70px; " class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>       

<script type="text/javascript">

   
    <?php echo (empty($listMerchandiseOrder))?'var row=1;':'var row='.count($listMerchandiseOrder).';';?>
    <?php echo (empty($listMerchandiseOrder))?'var numberProduct=1;':'var numberProduct='.count($listMerchandiseOrder).';';?>
    
    function addRow()
    {
        row++;
        numberProduct++;
       
            // màn desktop
        $('#tbody tr:last').after('<tr id="trProduct-'+row+'"><td><input type="hidden" required="" name="idHangHoa['+row+']" id="idHangHoa-'+row+'" value=""><input type="text" required="" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-'+row+'" id="searchProduct-'+row+'"></td><td><input required="" value="" onchange="tinhtien();" type="text" id="soluong-'+row+'" max="7" name="soluong['+row+']" class="form-control "  placeholder=""/></td><td><input required="" value="" onchange="tinhtien();" type="text" id="price-'+row+'" name="price['+row+']" class="form-control input_money"  placeholder=""/></td><td><input value="" disabled type="text" id="money-'+row+'" name="money['+row+']" class="form-control input_money"  placeholder=""/></td><td align="center"><a href="javascript:void(0);" class="dropdown-item" onclick="deleteProduct('+row+');"><i class="bx bx-trash me-1" aria-hidden="true"></i></a></td></tr>');
        
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }); 

        // $('.input_money').divide({delimiter: ',',divideThousand: true});
        
        searchProduct(row);

    }

    if(window.innerWidth < 1024){    
        $('#showDesktop').remove();     
    }else{    
        $('#showMobile').remove();      
    }

    function deleteProduct(id)
    {
        numberProduct--;
        if(numberProduct<=0){
            addRow();
            numberProduct= 1;
        }
        $('#trProduct-'+id).remove();
        $('#divProduct-'+id).remove();
    }

    
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#partner_name" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#idPartner').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchPartnerApi", {
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

               
                $('#partner_name').val(ui.item.label);
                $('#idPartner').val(ui.item.id);
          
                return false;
            }
        });
    });

    function searchProduct(number) {

    $(function() {
         function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }
        $( "#searchProduct-"+number )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#idHangHoa-'+number).val(0);
        })
        .autocomplete({
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

               
                $('#searchProduct-'+number ).val(ui.item.label);
                $('#idHangHoa-'+number).val(ui.item.id);
          
                return false;
            }
        });
        });
    }

    function tinhtien()
    {
        var i;
        var quantity,price,total,totalMoney;
        totalMoney= 0;
        
        if(numberProduct>0){
            for(i=1;i<=row;i++){
                if( $("#soluong-"+i).length ){
                    if($("#soluong-"+i).val()==''){
                        quantity= 0;
                    }else{
                        quantity= parseFloat($("#soluong-"+i).val());
                    }
                    
                    if($("#price-"+i).val()==''){
                        price= 0;
                    }else{
                        price= parseFloat($("#price-"+i).val());
                    }

                   

                    total= parseFloat(quantity*price);
                    
                    $("#money-"+i).val(total);
                    
                    totalMoney += total;
                }
            }
        }

        $("#totalMoney").html(totalMoney.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));

    }

   

    <?php 
    if(empty($listMerchandiseOrder)){
         echo 'searchProduct(1);';
        
    }else{
        for($i=1;$i<=count($listMerchandiseOrder);$i++){
             echo 'searchProduct('.$i.');';
        }

        echo 'tinhtien();';
        
    }
    ?>

    function addPartnerAjax(){
        var name = $('#name').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var email = $('#email').val();

        console.log(name);
        console.log(phone);
        console.log(address);
        console.log(email);
         $.ajax({
            method: "POST",
            data:{name: name,
                  phone: phone,
                  address: address,
                  email: email,
                },
            url: "/apis/addPartnerAjax",
        })
        .done(function(msg) {
            console.log(msg);
            if(msg.code==1){    
                location.reload();
            }else{
                var html = msg.mess;
                document.getElementById("mess").innerHTML = html;

            }
           
        });


    }
    
</script>

<div id="showAddCodeOrder" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="get">
                <div class="modal-header">
                    <h4 class="modal-title">Mã đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="showMess">
                        <input value="" type="text" name="codeOrder" required="" class="form-control"  placeholder="" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="buttonMM">Nhập hàng</button>
                </div>
            </form>
        </div>

    </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../footer.php'); ?>  