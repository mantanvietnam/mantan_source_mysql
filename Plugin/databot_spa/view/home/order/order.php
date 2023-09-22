<?php include(__DIR__.'/../header.php'); ?>
<style type="text/css">
	.tableService{
		padding: 1rem !important;
	    font-size: 1.4rem;
	    color: #67798c;
	    font-family: inherit;
	    font-weight: 900;
	}
   
    .diagram .floors {
        font-weight: bold;
        background: #1d2127;
        color: white;
        margin: 1px 0;
        font-size: 18px;
        padding: 0 6px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .diagram .clear-room {
        background-repeat: round;
        background-size: auto;
        color: white;
        height: 100px;
        margin: 3px;
        padding: 0px;
    }

    @media screen and (max-width: 767px){
        .diagram{
            margin-bottom: 20px;
        }
        .diagram .floors{
            margin: 0;
            border: 1px solid white;
                z-index: 1;
        }
        .diagram .clear-room, .diagram .booked, .diagram .un-clear, .diagram .clear-room, .diagram .khachDoan, .diagram .waiting-room{
            margin: 0;
            border: 1px solid white;
        }
    }
    .table-bordered{
        width: 100%;
        border-color: #dbdbdb;
        text-align: center;
    }
    .top .left{
        display: flex;
        padding: 0px 20px;
        border-bottom: 1px solid #566a7f;
        position: relative;
        display: flex;
        align-items: center;
        margin: 13px;
    }
    .box-form-bar ul li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        position: relative;
       
    } 
    .box-form-bar ul {
         padding-left: 0px !important;
    }

    .info-bh,  .action-cta{
        padding: 25px;
    }
    .action-cta ul {
        display: flex;
        justify-content: space-between;
        align-items: center;
        list-style: none;
    }

    .table-responsive{
    padding: 7px;
    }
    .datetimepicker{
        border: none;
    }
    .info-order{
        text-align: center;
        margin-bottom: 0px !important;
    }
    .input-Warehouses{
        position: relative;
        display: flex;
        flex-wrap: wrap;
        padding: 0 20px;
    
        align-items: stretch;
        width: 70%;
    }
    .right{
        display: flex;
        padding: 0px 20px;
        position: relative;
        display: flex;
        align-items: center;
        margin: 13px;
    }
    .item_produc{
        background: rgba(54, 46, 46, 0.59);
        height: 100%;
        color: white;
        object-fit: contain;
        font-size: 16px;
        z-index: 2;
        top: 60%;
        width: 100%;
        padding: 5px;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
  
<form id="summary-form" action="" method="post" class="form-horizontal">
    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
 	<div class="row">
 		<div class="mb-3 col-md-6">
            <h4 class="fw-bold mb-4">Tạo đơn hàng</h4>
		 	<div class="card mb-4 card-body">
		 		<div class="row">
	               <div class="mb-3 col-md-10">
	                   <label class="form-label" for="basic-default-phone">Khách hàng (*)</label>
	                   <input required type="text" required="" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
	                    <input type="hidden" name="id_customer"  id="id_customer" value="<?php echo (int) @$data->id_customer;?>">
	               </div>
	               <div class="mb-3 col-md-2">
	                   <p><a href="/addCustomer" class="btn btn-primary" target="_blank" type="Thêm khách hàng mới "><i class='bx bx-plus'></i> </a></p>
	               </div>
	           </div>
		 	</div>
		 	<div class="card mb-4">
		 		<a class="tableService" data-bs-toggle="collapse" href="#collapseService" role="button" aria-expanded="false" aria-controls="collapseExample">Dịch vụ <i class='bx bx-plus' style="float: right;"></i></a>
		 		<?php if(!empty($listService)){ ?>
				<div class="collapse" id="collapseService">
				  <div class="card card-body">
				  	<div class="row diagram">
				    <?php	foreach($listService as $key => $Service){ ?>
				    			<div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" style=" background-image: url('<?php echo $Service->image ?>');" onclick="addProduct('<?php echo $Service->id ?>','<?php echo $Service->name ?>',<?php echo $Service->price ?>,'service');" id='service<?php echo $Service->id ?>'>
                                    <div class="item_produc">
                                        <div class="customer-name"><span class="service_name"><?php echo $Service->name ?></span></div>
                                        <div class="customer-name"><span class="service_name"><?php echo $Service->duration ?> phút</span></div>
                                        <div class="customer-name"><span class="service_price"><?php echo number_format($Service->price) ?>đ</span></div>
                                    </div>
                                    
                                 </div> 
				  <?php   } ?>
				</div>
				  </div>
				</div>
				 <?php   } ?>
		 	</div>

		 	<div class="card mb-4">
		 		<a class="tableService" data-bs-toggle="collapse" href="#collapseCombo" role="button" aria-expanded="false" aria-controls="collapseExample">ComBo<i class='bx bx-plus' style="float: right;"></i></a>
				<?php if(!empty($listCombo)){ ?>
				<div class="collapse" id="collapseCombo">
				  <div class="card card-body">
				  	<div class="row diagram">
				    <?php	foreach($listCombo as $key => $combo){ ?>
				    			<div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" style=" background-image: url('<?php echo $combo->image ?>');" onclick="addProduct('<?php echo $combo->id; ?>','<?php echo $combo->name ?>',<?php echo $combo->price ?>,'combo');" id='combo<?php echo $combo->id ?>'>
                                    <div class="item_produc">
                                        <div class="customer-name"><span class="service_name"><?php echo $combo->name ?></span></div>
                                        <div class="customer-name"><span class="service_price"><?php echo number_format($combo->price) ?>đ</span></div>
                                    </div>
                                 </div> 
				  <?php   } ?>
				</div>
				  </div>
				</div>
				 <?php   } ?>
		 	</div>

		 	<div class="card mb-4">
		 		<a class="tableService" data-bs-toggle="collapse" href="#collapseProduct" role="button" aria-expanded="false" aria-controls="collapseExample">Sản phẩn<i class='bx bx-plus' style="float: right;"></i></a>
		 		<?php if(!empty($listProduct)){ ?>
				<div class="collapse" id="collapseProduct">
				  <div class="card card-body">
				  	<div class="row diagram">
				     <?php foreach($listProduct as $key => $Product){ ?>
				    			<div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" style=" background-image: url('<?php echo $Product->image ?>');" onclick="addProduct('<?php echo $Product->id ?>','<?php echo $Product->name ?>',<?php echo $Product->price ?>,'product');" id='product_<?php echo $Product->id ?>' >
                                    <div class="item_produc">
                                       <div class="customer-name"><span class="service_name"><?php echo $Product->name ?></span></div>
                                            <div class="customer-name"><span class="service_price"><?php echo number_format($Product->price) ?>đ</span></div>
                                        </div>
                                 </div> 
				   <?php   } ?>
					</div>
				  </div>
				</div>
				 <?php   } ?>
		 	</div>
		 	
		</div>
        <div class="mb-3 col-md-6">
            <div class="card mb-4">
                <h4 class="fw-bold py-3 mb-4 info-order">Thông tin đơn hàng</h4>
                 <div class="top row">
                    <div class="left col-md-4">
                        <i class="bx bx-time" aria-hidden="true"></i>&nbsp;
                        <div class="input-group">
                            <input type="text" name="time" id="time" value="<?php echo date('d/m/Y H:i')?>" class="form-control datetimepicker"  required />
                        </div>
                    </div>      
                    <div class="right col-md-7">
                        <p >Kho hàng (*)</p>
                        <div class="input-Warehouses">
                            <select  name="id_warehouse" required="" id="id_bed"  class="form-select color-dropdown">
                                                        <option value="">Chọn Kho</option>
                                                     <?php if(!empty($listWarehouse)){
                                                        foreach ($listWarehouse as $warehouse) { 
                                                            echo '<option  value="'.$warehouse->id.'">'.$warehouse->name.'</option>';
                                                            }
                                                            
                                                        }?>
                                                </select>
                        </div>
                        
                    </div>
                </div>
                <div class="table-responsive">
                    <table class=" table-bordered">
                        <thead>
                            <tr>
                                <th width="30%">Tên sản phẩm</th>
                                <th  width="15%">Số lượng</th>
                                <th  width="20%">Đơn giá</th>
                                <th  width="20%">Thành tiền</th>
                                <th  width="15%"></th>
                            </tr>
                        </thead>
                        <tbody id="listProductOrder">
                            <tr id="trFirst">
                                <td colspan="7" align="center">Chưa có sản phẩm nào được chọn.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <div class="side-bar">
                         <div class="box-form-bar">
                                <div class="info-bh">
                                    <ul>
                                        <li><span>Thành tiền</span><span id="totalMoney">0</span>
                                            <input type="hidden" name="total" id="total" value="">
                                        </li>                                        
                                        <li><span>Giảm giá</span><span><input class="per-bh input_money form-control" min="0" onchange="tinhtien();" type="text" name="promotion" id="promotion" placeholder="0" value="" autocomplete="off" /></span></li>
                                        <li><span>Hình thức thanh toán</span><span>
                                            <select name="type_collection_bill" class="form-select color-dropdown" required>
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
                                        </span></li> 
                                        <li class="total-bh"><p><strong>Tổng thanh toán</strong></p><p><strong id="totalPay">0</strong></p>
                                            <input type="hidden" name="totalPays" id="totalPays" value="">
                                        </li>
                                         <li id="sotenkhachdua">
                                            <span>Số tiền khách đưa</span>
                                            <span>
                                                <input type="text" class="money-khach input_money form-control" name="moneyCustomerPay" id="moneyCustomerPay" value="" placeholder="0" required="" min="0" onchange="tinhtien();" autocomplete="off">
                                            </span>
                                        </li>
                                        <li id="sotentralaikhach"><span>Số tiền trả lại</span><span id="moneyCustomerReturn">0</span></li> 

                                        
                                        <li class="total-bh">
                                            <p>Giường & phòng</p>
                                            <p>
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

                                            </p>
                                        </li>
                                        <li class="total-bh">
                                            <p>Nhân viên phụ trách</p>
                                            <p>
                                                <select  name="id_Staff" id="id_Staff"  class="form-select color-dropdown">
                                                        <option value="">Chọn nhân viên</option>
                                                     <?php if(!empty($listStaffs)){
                                                        foreach ($listStaffs as $Staff) {
                                                                    $selected = '';
                                                                    if(@$user->id==$Staff->id){
                                                                        $selected = 'selected';
                                                                    }
                                                                    echo '<option data-unit="'.@$Staff->id.'" '.@$selected.'  value="'.$Staff->id.'">'.$Staff->name.'</option>';
                                                            }
                                                           
                                                        }?>
                                                </select>

                                            </p>
                                        </li>
                                        <li style="display: contents;"><span>chú ý</span><br/>
                                            <textarea class="form-control phone-mask" rows="8" name="note"></textarea>
                                        </li> 

                                         
                                    </ul>
                                </div>
                                <div class="action-cta">
                                     <div id="thanhtoan" style="display: none;">
                                        <input type="hidden" name="typeOrder" value="1">
                                    </div>
                                     <div id="luudonhang" style="display: none;">
                                        <input type="hidden" name="typeOrder" value="2">
                                    </div>
                                    <div id="nhankhach" style="display: none;">
                                        <input type="hidden" name="typeOrder" value="3">
                                    </div>
                                    <ul>
                                        <li><a href="/order" class="btn  btn-secondary">Nhập lại</a></li>
                                        <?php if(empty($_GET['idBed'])){ ?>

                                        <li><a  href="javascript:void(0);" class="btn btn-primary" onclick="saveOrder();">Tạo đơn</a></li>
                                        <li><a href="javascript:void(0);" class="btn btn-danger" onclick="createOrder();">Thanh toán</a></li>
                                    <?php }else{ ?>

                                        <li><a  href="javascript:void(0);" class="btn btn-primary" onclick="nhankhach();">nhận khách </a></li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
	</div>


</form>
</div>


<script type="text/javascript">
    var listProductAdd= {};
     var row=0;
     var id_customer=0;
    var numberProduct= 0;
    var checkProduct= true;

// all sản phầm vào đơn hàng 
function addProduct(id, name, priceProduct,type){
    id_customer = parseFloat($('#id_customer').val());
   
    if(listProductAdd.hasOwnProperty(id)){
        // thêm số lượng vào mặt hàng đã có
        var numberProductRow= $('#soluong'+listProductAdd[id]).val();
        numberProductRow++;
        $('#soluong'+listProductAdd[id]).val(numberProductRow);
    }else{
        row++;
        listProductAdd[id]= row;
        numberProduct++;
        var showNumberProduct= new Intl.NumberFormat().format(numberProduct);
        $('#numberProduct').html(showNumberProduct);
                
        var readonly;

        $('#listProductOrder tr:first').after('<tr id="tr'+row+'"><td style="text-align: initial;"><input type="hidden" name="idHangHoa['+row+']" id="idProduct'+row+'" value="'+id+'"><input type="hidden" name="type['+row+']" value="'+type+'">'+name+'</td><td><div class="quantity"><div class="number-spinner"><span class="ns-btn" ></span><input name="soluong['+row+']" min="1" id="soluong'+row+'"  type="number" class="pl-ns-value form-control" value="1"  onchange="tinhtien();"></div></div></td><td><input type="text"  value="'+priceProduct+'" class="input_money form-control" name="money['+row+']" min="1" id="money-'+row+'" onchange="tinhtien();"></td><td id="totalmoney'+row+'"></td><td><a href="javascript:void(0);" class="dropdown-item" onclick="deleteProduct(\''+row+'\')"><i class="bx bx-trash me-1" aria-hidden="true"></i></a></td></tr>');    
            $("#trFirst").hide();
           //$('.input_money').divide({delimiter: ',',divideThousand: true});
           // activeButtonPlus();
        }

        tinhtien();
        
    }

    // xóa sản phẩm trong đơn 
    function deleteProduct(number)
    {
        var check= confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');

        if(check == true){
            $("#tr"+number).remove();
            
            numberProduct--;
            var showNumberProduct= new Intl.NumberFormat().format(numberProduct);
            $('#numberProduct').html(showNumberProduct);
            
           tinhtien();

            if(numberProduct==0){
                $("#trFirst").show();
            }
        }
    }

    // tính tiền 
    function tinhtien(){
        var total= 0;
        var i;
        var number;
        var price;
        var idProduct;

        if(row>0){
            for(i=1;i<=row;i++){
                if ($('#tr'+i).length > 0) {
                    number= parseFloat($('#soluong'+i).val());
                    price= parseFloat($('#money-'+i).val());

                    console.log(number);
                    console.log(price);

                   
                    idMerchandise= $('#idMerchandise'+i).val();
                    $('#soluong'+i).css("border","");
                    
                    money = 0;
                    if(number>0){
                        money= number*price;
                        
                        total+= money;
                    }
                     
                    money = new Intl.NumberFormat().format(money);
                    $('#totalmoney'+i).html(money+'đ');


                    document.getElementById("total").value = total;
                    var showTotal= new Intl.NumberFormat().format(total);
                    $('#totalMoney').html(showTotal+'đ');

                    // giảm giá
                    var promotion= $('#promotion').val();
                    if(promotion<=100){
                        promotion= total*promotion/100;
                    }
                    console.log(promotion);

                   // tổng tiền cần thanh toán
                    totalPay= total-promotion;
                     document.getElementById("totalPays").value = totalPay;
                    var showPay= new Intl.NumberFormat().format(totalPay);
                    $('#totalPay').html(showPay+'đ');

                    moneyCustomerPay = $('#moneyCustomerPay').val();
                    var moneyCustomerReturn = new Intl.NumberFormat().format(moneyCustomerPay - totalPay);
                    $('#moneyCustomerReturn').html(moneyCustomerReturn+'đ');



                }
            }

            $.ajax({
                method: 'GET',
                url: '/apis/listCustomerPrepayCardAPI',
                data: { id_customer: id_customer , total: totalPay},
                success:function(res){
                  console.log(res);
                 // location.reload();
                }
            })
        }
    }

    // tạo đơn hàng 
    function saveOrder(){
        tinhtien();
        var moneyCustomerPay= $('#moneyCustomerPay').val();
        var congno= $('#typeCollectionBill').val();
        var r= true;
  
        $('#luudonhang').show();
        $('#thanhtoan').remove();
        $('#nhankhach').remove();

        if(numberProduct>0){
            r = confirm("bạn lưu đơn này?");
            if (r == true) {
                if(checkProduct){
                    $('#summary-form').submit();
                }
            }
        }else{
            alert('Bạn chưa chọn sản phẩm nào');
        }

    }

    // thanh toán 
    function createOrder(){
        tinhtien();
        var moneyCustomerPay= $('#moneyCustomerPay').val();
        var congno= $('#typeCollectionBill').val();
        var r= true;
  
        $('#luudonhang').remove();
        $('#thanhtoan').show();
        $('#nhankhach').remove();

        if(numberProduct>0){
            r = confirm("bạn thanh toán đơn này?");
            if (r == true) {
                if(checkProduct){
                    $('#summary-form').submit();
                }
            }
        }else{
            alert('Bạn chưa chọn sản phẩm nào');
        }

    }

        // nhận khách
    function nhankhach(){
        tinhtien();
        var moneyCustomerPay= $('#moneyCustomerPay').val();
        var congno= $('#typeCollectionBill').val();
        var r= true;
  
        $('#luudonhang').remove();
        $('#luudonhang').remove();
        $('#nhankhach').show();

        if(numberProduct>0){
            r = confirm("bạn nhận khách này vào giường?");
            if (r == true) {
                if(checkProduct){
                    $('#summary-form').submit();
                }
            }
        }else{
            alert('Bạn chưa chọn sản phẩm nào');
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
          
                return false;
            }
        });
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../footer.php'); ?>