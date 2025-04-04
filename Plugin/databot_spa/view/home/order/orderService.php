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
	                   <input required type="text" required="" placeholder="Nhập tên hoặc sđt khách hàng" autocomplete="off" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
	                    <input type="hidden" name="id_customer"  id="id_customer" value="<?php echo (int) @$data->id_customer;?>">
	               </div>
	               <div class="mb-3 col-md-2">
                        <label class="form-label" for="basic-default-phone">&nbsp;</label>
	                    <a href="javascript:void(0);" onclick="showAddCustom();" title="Thêm khách hàng mới" class="btn btn-primary"><i class="bx bx-plus"></i></a>
	               </div>
	           </div>
		 	</div>
		 	<div class="card mb-4">
		 		<h4 class="fw-bold m-2">Dịch vụ</h4>
		 		<?php

                 if(!empty($listService)){ ?>
                    <div class="m-3 col-md-10">
                       
                        <input type="text" placeholder="Tìm dịch vụ" autocomplete="off" class="form-control phone-mask" id="searchProduct">
                   </div>
				<div >
				  <div class="card card-body">
				  	<div class="row diagram">

				     <?php foreach($listService as $key => $combo){ ?>
				    			<div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" style=" background-image: url('<?php echo $combo->image ?>');" onclick="addProduct('<?php echo $combo->id ?>','<?php echo $combo->name ?>',<?php echo $combo->price ?>,'service');" id='combo<?php echo $combo->id ?>' >
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
		 	
		</div>
        <div class="mb-3 col-md-6">
            <div class="card mb-4">
                <h4 class="fw-bold py-3 mb-4 info-order">Thông tin đơn hàng</h4>
                 <div class="top row">
                    <div class="left col-md-10">
                        <i class="bx bx-time" aria-hidden="true"></i>&nbsp;
                        <div class="input-group">
                            <input type="text" name="time" id="time" value="<?php echo date('d/m/Y H:i')?>" class="form-control datetimepicker"  required />
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
                                <td colspan="7" align="center">Chưa có dich vụ nào được chọn.</td>
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
                                        <?php if(empty($_GET['idBed'])){ ?>
                                        <li><span>Giảm giá</span><span><input class="per-bh input_money form-control" min="0" onchange="tinhtien();" type="text" name="promotion" id="promotion" placeholder="0" value="" autocomplete="off" /></span></li>
                                        <li><span>Hình thức thanh toán</span><span>
                                            <select name="type_collection_bill" id="type_collection_bill" class="form-select color-dropdown" required onchange="tinhtien();">
                                              <option value="0">Chọn hình thức thanh toán</option>
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
                                            <input type="hidden" name="moneyReturn" id="moneyReturn" value="">
                                        </li>
                                         <li id="sotenkhachdua">
                                            <span>Số tiền khách đưa</span>
                                            <span>
                                                <input type="text" class="money-khach input_money form-control" name="moneyCustomerPay" id="moneyCustomerPay" value="" placeholder="0" required="" min="0" onchange="tinhtien();" autocomplete="off">
                                            </span>
                                        </li>
                                        <li id="sotentralaikhach"><span>Số tiền trả lại</span><span id="moneyCustomerReturn">0</span></li> 
                                         <?php }else{ ?>
                                        <li class="total-bh">
                                            <p>Giường & phòng</p>
                                            <p> <input  min="0" onchange="tinhtien();" type="hidden" name="promotion" id="promotion" placeholder="0" value="" autocomplete="off" />
                                                <input type="hidden" name="total" id="total" value="">
                                                <input type="hidden" name="totalPays" id="totalPays" value="">
                                                <input type="hidden" name="moneyReturn" id="moneyReturn" value="">
                                                <input type="hidden" class="money-khach input_money form-control" name="moneyCustomerPay" id="moneyCustomerPay" value="" placeholder="0" required="" min="0" onchange="tinhtien();" autocomplete="off">
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
                                    <?php } ?>
                                        <li class="total-bh">
                                            <p>Nhân viên phụ trách</p>
                                            <p>
                                                <select  name="id_staff" id="id_staff"  class="form-select color-dropdown">
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
                                        <div id="card"> </div>  
                                        <li style="display: contents;"><span>Ghi chú</span><br/>
                                            <textarea class="form-control phone-mask" rows="3" name="note"></textarea>
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

                                       <!--  <li><a  href="javascript:void(0);" class="btn btn-primary" onclick="saveOrder();">Tạo đơn</a></li> -->
                                        <li><a href="javascript:void(0);" class="btn btn-danger" onclick="createOrder();">Thanh toán</a></li>
                                    <?php }else{ ?>

                                        <li><a  href="javascript:void(0);" class="btn btn-primary" onclick="nhankhach();">Nhận khách </a></li>
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

<div id="addCustomer"  class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm thông tin khách hàng mới</h4>
                
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="data-content card-body">
                <div id="messAddCustom"></div>
                <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                        <input required type="text" class="form-control phone-mask" name="name" id="name" value="" />
                        <input  type="hidden" class="form-control phone-mask" name="name" id="id_member" value="<?php echo $user->id_member; ?>" />
                        <input  type="hidden" class="form-control phone-mask" name="name" id="id_spa" value="<?php echo $user->id_spa; ?>" />
                        <input  type="hidden" class="form-control phone-mask" name="name" id="id_staff" value="<?php echo $user->id_staff; ?>" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                        <input type="text" class="form-control" placeholder="" name="phone" id="phone" value="" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                        <input type="text" class="form-control phone-mask" name="address" id="address" value="" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Giới tính</label>
                        <select name="sex" id='sex' class="form-select color-dropdown">
                          <option value="0">Nữ</option>
                          <option value="1" >Nam</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="row">

                    <div class="text-center col-sm-12" style="padding-bottom: 30px;">
                        <button type="button" class="btn btn-primary" onclick="addCustomer();">Lưu thông tin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        idcustomer = $('#id_customer').val();

         var typecollectionbill= $('#type_collection_bill').val();
         <?php if(empty($_GET['idBed'])){ ?>
            if(typecollectionbill=='tien_mat'){
                document.getElementById("sotenkhachdua").style.display = "flex";
                document.getElementById("sotentralaikhach").style.display = "flex";
            }else{
                document.getElementById("sotenkhachdua").style.display = "none";
                document.getElementById("sotentralaikhach").style.display = "none";
            }
        <?php } ?>

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
                    document.getElementById("moneyReturn").value =moneyCustomerPay - totalPay;
                    var moneyCustomerReturn = new Intl.NumberFormat().format(moneyCustomerPay - totalPay);
                    $('#moneyCustomerReturn').html(moneyCustomerReturn+'đ');



                }
            }

            $.ajax({
                method: 'GET',
                url: '/apis/listCustomerPrepayCardAPI',
                data: { id_customer: idcustomer , total: totalPay},
                success:function(res){
                    if(res.code==1){
                        console.log('abc'+res.data.length); 
                        var y= 0;
                        var data= res.data;
                    
                        var html = '';
                        html += '<li id="cards" class="total-bh">'
                        html +=    '<p>Dùng thẻ trả trước</p>';
                        html +=    '<p>';
                        html +=        '<select  name="card" id="card"  class="form-select color-dropdown">';
                        html +=            '<option value="">chọn thẻ trả trước</option>';

                                for(let y=0; y<data.length; y++){
                                    var total= new Intl.NumberFormat().format(data[y].total)
                        html +=            '<option value="'+data[y].id+'">'+data[y].infoPrepayCard.name +' (tiền được tiêu '+total+')</option>';
                                }
                        html +=        '</select>';
                        html +=    '</p>';
                        html == '</li>'
                        $('#card').html(html);
                         $('#card').show();
                    }else{
                         
                        $('#cards').remove();
                    }
                }
            })
        }
    }

    // tạo đơn hàng 
    function saveOrder(){
        tinhtien();
        var moneyCustomerPay= $('#moneyCustomerPay').val();
        var congno= $('#typeCollectionBill').val();
        var id_customer= $('#id_customer').val();
        var r= true;
  
        $('#luudonhang').show();
        $('#thanhtoan').remove();
        $('#nhankhach').remove();
        if(id_customer>=0){
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
            }else{
            alert('Bạn chưa chọn khách hàng');
        }

    }

    // thanh toán 
    function createOrder(){
        tinhtien();
        var moneyCustomerPay= $('#moneyCustomerPay').val();
        var congno= $('#typeCollectionBill').val();
        var id_customer= $('#id_customer').val();
        var r= true;
  
        $('#luudonhang').remove();
        $('#thanhtoan').show();
        $('#nhankhach').remove();

         var type_collection_bill = $('#type_collection_bill').val();
        if(id_customer>=0){
            if(type_collection_bill==0){
                alert('Bạn chưa chọn hình thức thanh toán');
            }else{

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
        }else{
            alert('Bạn chưa chọn khách hàng');
        }

    }

        // nhận khách
    function nhankhach(){
        tinhtien();
        var moneyCustomerPay= $('#moneyCustomerPay').val();
        var congno= $('#typeCollectionBill').val();
        var id_customer= $('#id_customer').val();
        var r= true;
  
        $('#luudonhang').remove();
        $('#luudonhang').remove();
        $('#nhankhach').show();
        if(id_customer>=0){
            if(numberProduct>0){
                r = confirm("Bạn nhận khách này vào giường?");
                if (r == true) {
                    if(checkProduct){
                        $('#summary-form').submit();
                    }
                }
            }else{
                alert('Bạn chưa chọn sản phẩm nào');
            }
        }else{
            alert('Bạn chưa chọn khách hàng');
        }
        

    }

        function showAddCustom()
    {
        $('#addCustomer').modal('show');
    }

function addCustomer()
{

    var name = $('#name').val();
    var id_member = $('#id_member').val();
    var phone = $('#phone').val();
    var id_spa = $('#id_spa').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var id_staff = $('#id_staff').val();
    var sex = $('#sex').val();
    
    $.ajax({
          method: "POST",
          url: "/apis/addCustomerApi",
          data: { 
            name: name,
            id_member: id_member,
            phone: phone,
            id_spa: id_spa,
            email: email,
            address: address,
            id_staff: id_staff,
            sex:sex,
        }
    }).done(function( msg ) {
            console.log(msg);

            // var obj = jQuery.parseJSON(msg);
             // console.log(obj);
            if(msg.code==1){
                $('#id_customer').val(msg.data.id);
                $('#full_name').val(msg.data.name);
                $('#addCustomer').modal('hide');
            }else{
                console.log(msg.mess);
               $('#messAddCustom').html(msg.mess); 
            }
        }) 
          
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
                  tinhtien();
                return false;

              
            }
        });
    });
</script>
<script type="text/javascript">
     $(function() {
         function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }
        $( "#searchProduct" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_product-'+number).val(0);
        })
        .autocomplete({
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

                addProduct(ui.item.id,ui.item.name,ui.item.price,'service')
          
                return false;
            }
        });
        });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../footer.php'); ?>