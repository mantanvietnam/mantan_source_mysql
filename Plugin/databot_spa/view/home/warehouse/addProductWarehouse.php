<?php include($urlLocal['urlLocalPlugin'].'/mantanHotel/view/ver3/header.php');?>
<main>
    <section class="content-main" style="padding: 20px 0;">
        <div class="bg-maps"><img src="<?php echo getUrlBackground();?>" class="img-fluid w-100" alt=""></div>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="left-content">
                        <div class="top-main top-main-cong"> 
                            <ul class="align-items-end">
                                <li>
                                    <div class="txt-top-main">
                                        <h3><a href="/managerListMerchandise" title="Quay lại"><i class="fa fa-arrow-circle-left"></i></a> NHẬP HÀNG HÓA VÀO KHO</h3>
                                        
                                        <?php 
                                        if(!empty($_SESSION['infoManager']['Manager']['idParent'])){
                                            echo '
                                            <div class="dropdown">
                                                <div class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </div>
                                                <div class="dropdown-menu dropdownMore" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="/managerAddOrderMerchandiseParent">Nhập hàng từ tuyến trên</a>
                                                    <a class="dropdown-item" href="/managerListOrderMerchandiseParent">Đơn hàng từ tuyến trên</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="$(\'#showAddCodeOrder\').modal(\'show\');">Thêm bằng mã đặt hàng</a>
                                                </div>
                                            </div>
                                                ';
                                        }
                                        ?>
                                            
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="data-content">
                            <form id="" action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="col-sm-12 control-label">Kho hàng<span class="required">*</span>:</label>
                                        <div class="col-sm-12">
                                            <?php 
                                                if($_SESSION['infoManager']['Manager']['isStaff']==false){ ?>   
                                                    <select name="idWarehouse" id="idWarehouse" class="form-control" required="">
                                                    <option value="">Kho hàng</option>
                                                    <?php 
                                                        if(!empty($listWarehouse)){
                                                            foreach($listWarehouse as $item){
                                                                if(empty($_SESSION['warehouseSelect']) || $_SESSION['warehouseSelect']!=$item['Warehouse']['id']){
                                                                    echo '<option value="'.$item['Warehouse']['id'].'">'.$item['Warehouse']['name'].'</option>';
                                                                }else{
                                                                    echo '<option selected value="'.$item['Warehouse']['id'].'">'.$item['Warehouse']['name'].'</option>';
                                                                }
                                                            }
                                                        }
                                                  ?>
                                                    </select>
                                                    <?php }else{?>
                                                    <select name="idWarehouse" id="idWarehouse" class="form-control" required>
                                                        <option value="">Kho hàng</option>
                                                    <?php 
                                                    if(!empty($listWarehouse)){
                                                        foreach($listWarehouse as $item){
                                                            foreach ($_SESSION['infoManager']['Manager']['warehouse'] as $value) {
                                                                if($item['Warehouse']['id']==$value){
                                                                    if(empty($_SESSION['warehouseSelect']) || $_SESSION['warehouseSelect']!=$item['Warehouse']['id']){
                                                                        echo '<option value="'.$item['Warehouse']['id'].'">'.$item['Warehouse']['name'].'</option>';
                                                                    }else{
                                                                        echo '<option selected value="'.$item['Warehouse']['id'].'">'.$item['Warehouse']['name'].'</option>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            <?php }?>
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
                                        <label class="col-sm-12 control-label">Hình thức<span class="required">*</span>:</label>
                                        <div class="col-sm-12">
                                            <select name="typeImport" class="form-control" >
                                                <option value="new">Nhập hàng mới</option>
                                                <option value="again">Nhập lại hàng bán</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="col-sm-12 control-label">Nhà cung cấp:</label>
                                        <div class="col-sm-12">
                                            <input type="hidden" name="idPartner" id="idPartner" value="<?php echo @$_GET['idPartner'] ?>">   
                                            <input type="text"  maxlength="100" name="partner_name" id="partner_name" class="ui-autocomplete-input form-control"  value="<?php echo @$_GET['partner_name'] ?>" /> 
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        
                                        <div class="" id="showDesktop">
                                            <div class="row" style="margin-bottom: 10px;">
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <button type="button" class="btn btn-primary" onclick="return addRow();"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </div>
                                            </div>

                                            <div class="scroll-table">
                                                <div class="table-list table-list-auto">
                                                    <table class="w-100 table-fix">
                                                        <thead>
                                                            <tr>
                                                                <th style=" width: 20%; ">Hàng hóa</th>
                                                                <th style=" width: 10%; ">Ngày hết hạn</th>
                                                                <th style=" width: 10%; ">Số lượng</th>
                                                                <th style=" width: 10%; ">Đơn vị</th>
                                                                <th style=" width: 15%; ">Đơn giá nhập</th>
                                                                <th style=" width: 15%; ">Chi phí phát sinh</th>
                                                                <th style=" width: 15%; ">Thành tiền</th>
                                                                <th style=" width: 5%; ">Xóa</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody">
                                                            <?php if(empty($listMerchandiseOrder)){ ?>
                                                            <tr id="trProduct-1">
                                                                <td>
                                                                    <input type="hidden" name="idHangHoa[1]" id="idHangHoa-1" value="">
                                                                    <input type="text" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-1" value="" id="searchProduct-1">
                                                                </td>
                                                                <td>
                                                                    <input value="<?php echo date('d/m/Y', strtotime('+1 year'));?>" type="text" name="dateEnd[1]" required="" id="dateEnd-1" class="form-control datepicker"  placeholder="" autocomplete="off" />
                                                                </td>
                                                                <td>
                                                                    <input value="" type="text" required="" name="soluong[1]" max="7" id="soluong-1" class="form-control"  placeholder="" onchange="tinhtien();"/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" placeholder="" disabled="" class="form-control" name="unit-1" value="" id="unit-1">
                                                                </td>
                                                                <td>
                                                                    <input value="" type="text" required="" name="price[1]" id="price-1" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                </td>
                                                                <td>
                                                                    <input value="" type="text" required="" name="costsIncurredImport[1]" id="costsIncurredImport-1" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                </td>
                                                                <td>
                                                                    <input value="" type="text" disabled="" name="money[1]" id="money-1" class="form-control input_money"  placeholder=""/>
                                                                </td>
                                                                <td align="center">
                                                                    <a style="color:#fff;" href="javascript:void(0);" onclick="deleteProduct(1);"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php }else{ 
                                                                $dem=0;
                                                                foreach($listMerchandiseOrder as $item){
                                                                    $dem++;

                                                                    echo '<tr id="trProduct-'.$dem.'">
                                                                            <td>
                                                                                <input type="hidden" name="idHangHoa['.$dem.']" id="idHangHoa-'.$dem.'" value="'.$item['Merchandise']['id'].'">
                                                                                <input type="text" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-'.$dem.'" value="'.$item['Merchandise']['name'].'" id="searchProduct-'.$dem.'">
                                                                            </td>
                                                                            <td>
                                                                                <input value="'.date('d/m/Y', strtotime('+1 year')).'" type="text" name="dateEnd['.$dem.']" required="" id="dateEnd-'.$dem.'" class="form-control datepicker"  placeholder="" autocomplete="off" />
                                                                            </td>
                                                                            <td>
                                                                                <input value="'.$item['Merchandise']['numberOrder'].'" type="text" required="" name="soluong['.$dem.']" max="7" id="soluong-'.$dem.'" class="form-control "  placeholder="" onchange="tinhtien();"/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="" disabled="" class="form-control" name="unit-'.$dem.'" value="'.$item['Merchandise']['unit'].'" id="unit-'.$dem.'">
                                                                            </td>
                                                                            <td>
                                                                                <input value="'.$item['Merchandise']['priceOrder'].'" type="text" required="" name="price['.$dem.']" id="price-'.$dem.'" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                            </td>
                                                                             <td>
                                                                                <input value="0" type="text" required="" name="costsIncurredImport['.$dem.']" id="costsIncurredImport-'.$dem.'" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                            </td>
                                                                            <td>
                                                                                <input value="" type="text" disabled="" name="money['.$dem.']" id="money-'.$dem.'" class="form-control input_money"  placeholder=""/>
                                                                            </td>
                                                                            <td align="center">
                                                                                <a style="color:#fff;" href="javascript:void(0);" onclick="deleteProduct('.$dem.');"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                                        </div>

                                        <div class="" id="showMobile">
                                            <div class="row" style="margin-bottom: 10px;">
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <button type="button" class="btn btn-primary" onclick="return addRow();"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                            <div id="divBody">   
                                                <?php if(empty($listMerchandiseOrder)){ ?>
                                                    <section>
                                                        <div class="row list-kho" id="divProduct-1" >
                                                            <div class="col-12 text-right">
                                                                <a style="color:#fff;" href="javascript:void(0);" onclick="deleteProduct(1);"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="inputs">
                                                                    <p>Hàng Hóa</p>
                                                                    <input type="hidden" name="idHangHoa[1]" id="idHangHoa-1" value="">
                                                                    <input type="text" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-1" value="" id="searchProduct-1">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="inputs">
                                                                    <p>Ngày Hết Hạn</p>
                                                                    <input value="<?php echo date('d/m/Y', strtotime('+1 year'));?>" type="text" name="dateEnd[1]" required="" id="dateEnd-1" class="form-control datepicker"  placeholder="" autocomplete="off" />
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="inputs">
                                                                    <p>Đơn Giá Nhập</p>
                                                                    <input value="" type="text" required="" name="price[1]" id="price-1" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="inputs">
                                                                    <p>Chi phí phát sinh</p>
                                                                    <input value="" type="text" required="" name="costsIncurredImport[1]" id="costsIncurredImport-1" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="inputs">
                                                                    <p>Số Lượng</p>
                                                                    <input value="" type="text" required="" name="soluong[1]" id="soluong-1" max="7" class="form-control"  placeholder="" onchange="tinhtien();"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="inputs">
                                                                    <p>Đơn Vị</p>
                                                                    <input type="text" placeholder="" disabled="" class="form-control" name="unit-1" value="" id="unit-1">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-6">
                                                                <div class="inputs">
                                                                    <p>Thành Tiền</p>
                                                                    <input value="" type="text" disabled="" name="money[1]" id="money-1" class="form-control input_money"  placeholder=""/>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </section>
                                                <?php } 
                                               else{ 
                                                    $dem=0;
                                                    foreach($listMerchandiseOrder as $item){
                                                        $dem++;

                                                        echo '
                                                        <section>
                                                            <div class="row list-kho" id="divProduct-'.$dem.'" >
                                                                <div class="col-12 text-right">
                                                                    <a style="color:#fff;" href="javascript:void(0);" onclick="deleteProduct('.$dem.');"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="inputs">
                                                                        <p>Hàng Hóa</p>
                                                                        <input type="hidden" name="idHangHoa['.$dem.']" id="idHangHoa-'.$dem.'" value="">
                                                                        <input type="text" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-'.$dem.'" value="" id="searchProduct-'.$dem.'">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="inputs">
                                                                        <p>Ngày Hết Hạn</p>
                                                                        <input value="'.date('d/m/Y', strtotime('+1 year')).'" type="text" name="dateEnd['.$dem.']" required="" id="dateEnd-'.$dem.'" class="form-control datepicker"  placeholder="" autocomplete="off" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="inputs">
                                                                        <p>Đơn Giá Nhập</p>
                                                                        <input value="" type="text" required="" name="price['.$dem.']" id="price-'.$dem.'" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                    </div>
                                                                </div>
                                                                 <div class="col-6">
                                                                    <div class="inputs">
                                                                        <p>Chi phí phát sinh</p>
                                                                        <input value="" type="text" required="" name="costsIncurredImport['.$dem.']" id="costsIncurredImport-'.$dem.'" class="form-control input_money"  placeholder="" onchange="tinhtien();" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="inputs">
                                                                        <p>Số Lượng</p>
                                                                        <input value="" type="text" required="" name="soluong['.$dem.']" id="soluong-'.$dem.'" class="form-control " max="7"  placeholder="" onchange="tinhtien();"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="inputs">
                                                                        <p>Đơn Vị</p>
                                                                        <input type="text" placeholder="" disabled="" class="form-control" name="unit-'.$dem.'" value="" id="unit-'.$dem.'">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-6">
                                                                    <div class="inputs">
                                                                        <p>Thành Tiền</p>
                                                                        <input value="" type="text" disabled="" name="money['.$dem.']" id="money-'.$dem.'" class="form-control input_money"  placeholder=""/>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </section>
                                                            ';
                                                    }
                                                }?>
                                                <div class="row list-kho">
                                                    <div class="col-6">
                                                        <p>Tổng Tiền</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p id="totalMoney">0</p>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="text-center col-sm-12">
                                        <button type="submit" class="buttonMM">Lưu thông tin</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">

   
    <?php echo (empty($listMerchandiseOrder))?'var row=1;':'var row='.count($listMerchandiseOrder).';';?>
    <?php echo (empty($listMerchandiseOrder))?'var numberProduct=1;':'var numberProduct='.count($listMerchandiseOrder).';';?>
    
    function addRow()
    {
        row++;
        numberProduct++;
        if(window.innerWidth < 1024){
            // màn mobile
            $('#divBody section:last').after('<section> <div class="row list-kho" id="divProduct-'+row+'" > <div class="col-12 text-right"> <a style="color:#fff;" href="javascript:void(0);" onclick="deleteProduct('+row+');"><i class="fa fa-times" aria-hidden="true"></i></a> </div> <div class="col-12"> <div class="inputs"> <p>Hàng Hóa</p> <input type="hidden" name="idHangHoa['+row+']" id="idHangHoa-'+row+'" value=""> <input type="text" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-'+row+'" value="" id="searchProduct-'+row+'"> </div> </div> <div class="col-6"> <div class="inputs"> <p>Ngày Hết Hạn</p> <input value="<?php echo date('d/m/Y', strtotime('+1 year'));?>" type="text" name="dateEnd['+row+']" required="" id="dateEnd-'+row+'" class="form-control datepicker" placeholder="" autocomplete="off" /> </div> </div> <div class="col-6"> <div class="inputs"> <p>Đơn Giá Nhập</p> <input value="" type="text" required="" name="price['+row+']" id="price-'+row+'" class="form-control input_money" placeholder="" onchange="tinhtien();" /> </div> </div>  <div class="col-6"> <div class="inputs"> <p>Chi phí phát sinh</p> <input value="" type="text" required="" name="costsIncurredImport['+row+']" id="costsIncurredImport-'+row+'" class="form-control input_money" placeholder="" onchange="tinhtien();" /> </div> </div> <div class="col-6"> <div class="inputs"> <p>Số Lượng</p> <input value=""  max="7" type="text" required="" name="soluong['+row+']" id="soluong-'+row+'" class="form-control " placeholder="" onchange="tinhtien();"/> </div> </div> <div class="col-6"> <div class="inputs"> <p>Đơn Vị</p> <input type="text" placeholder="" disabled="" class="form-control" name="unit-'+row+'" value="" id="unit-'+row+'"> </div> </div> <div class="col-6"> <div class="inputs"> <p>Thành Tiền</p> <input value="" type="text" disabled="" name="money['+row+']" id="money-'+row+'" class="form-control input_money" placeholder=""/> </div> </div> </div> </section>');
        }else{
            // màn desktop
            $('#tbody tr:last').after('<tr id="trProduct-'+row+'"><td><input type="hidden" name="idHangHoa['+row+']" id="idHangHoa-'+row+'" value=""><input type="text" placeholder="Tìm sản phẩm theo tên" class="form-control" name="searchProduct-'+row+'" id="searchProduct-'+row+'"></td><td><input required="" value="<?php echo date('d/m/Y', strtotime('+1 year'));?>" type="text" name="dateEnd['+row+']" id="dateEnd-'+row+'" class="form-control datepicker"  placeholder="" autocomplete="off" /></td><td><input required="" value="" onchange="tinhtien();" type="text" id="soluong-'+row+'" max="7" name="soluong['+row+']" class="form-control "  placeholder=""/></td><td><input type="text" placeholder="" disabled="" class="form-control" name="unit-'+row+'" value="" id="unit-'+row+'"></td><td><input required="" value="" onchange="tinhtien();" type="text" id="price-'+row+'" name="price['+row+']" class="form-control input_money"  placeholder=""/></td><td><input required="" value="" onchange="tinhtien();" type="text" id="costsIncurredImport-'+row+'" name="costsIncurredImport['+row+']" class="form-control input_money"  placeholder=""/></td><td><input value="" disabled type="text" id="money-'+row+'" name="money['+row+']" class="form-control input_money"  placeholder=""/></td><td align="center"><a href="javascript:void(0);" style="color:#fff;" onclick="deleteProduct('+row+');"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
        }
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }); 

        $('.input_money').divide({delimiter: ',',divideThousand: true});
        
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
    })
    .autocomplete({
        source: function( request, response ) {
            $.getJSON( "/managerGetPartnerAPI", {
                term: extractLast( request.term )
            }, response );
        },
        search: function() {
            // custom minLength
            var term = extractLast( this.value );
            if ( term.length < 2 ) {
                return false;
            }else{
                console.log("abc")
            }
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            
            $('#idPartner').val(ui.item.id);
            $('#partner_name').val(ui.item.fullName);

            return false;
        }
    });

    function searchProduct(number) {
    
        $( "#searchProduct-"+number )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/managerSearchMerchandiseAPI", {
                    term: extractLast( request.term )
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
                

                $('#idHangHoa-'+number).val(ui.item.id);
                $('#searchProduct-'+number).val(ui.item.name);
                $('#unit-'+number).val(ui.item.unit);


          
                return false;
            },
            open : function() {
                $('#idHangHoa-'+number).val('');
                $('#searchProduct-'+number).val('');
                $('#unit-'+number).val('');
            },
            close : function() { 
                if($('#idHangHoa-'+number).val()==''){
                    $('#idHangHoa-'+number).val('');
                    $('#searchProduct-'+number).val('');
                    $('#unit-'+number).val('');
                }
            }
        });
    }

    function tinhtien()
    {
        var i;
        var quantity,price,total,totalMoney,costsIncurredImport;
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

                     if($("#costsIncurredImport-"+i).val()==''){
                        costsIncurredImport= 0;
                    }else{
                        costsIncurredImport= parseInt($("#costsIncurredImport-"+i).val());
                    }

                    total= parseFloat(quantity*(price+costsIncurredImport));
                    
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
<?php include($urlLocal['urlLocalPlugin'].'/mantanHotel/view/ver3/footer.php');?>   