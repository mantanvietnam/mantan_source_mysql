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

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/orderMemberAgency"> Yêu cầu nhập hàng</a> /</span>
    Sửa yêu cầu
  </h4>

    <form id="summary-form" action="" method="post" class="form-horizontal">
        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
        <div class="row">
            <div class="mb-3 col-md-5">

                <div class="card mb-4">
                    <h4 class="fw-bold m-4 mb-0">Sản phẩm</h4>

                    <?php
                    
                    if(!empty($listProduct)){ ?>
                        <div class="row">
                            <div class="m-4 col-md-11 mb-0">
                                <?php echo @$mess;?>
                                <input type="text" placeholder="Tìm sản phẩm"  class="form-control phone-mask" id="searchProduct">
                            </div>
                        </div>

                        <div >
                          <div class="card card-body">
                            <div id="tabs">
                              <ul>
                                <li><a href="#tabs-1">Sản phẩm bán</a></li>
                                <li><a href="#tabs-2">Quà tặng</a></li>
                              </ul>
                              <div id="tabs-1">
                                <div class="row diagram">
                                    <?php foreach($listProduct as $key => $Product){ ?>
                                        <div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" style=" background-image: url('<?php echo $Product->image ?>');" onclick="addProduct('<?php echo $Product->id ?>','<?php echo $Product->title ?>',<?php echo $Product->price ?>, '','<?php echo @$Product->unit ?>');" id='product_<?php echo $Product->id ?>' >
                                            <div class="item_produc">
                                                <div class="customer-name">
                                                    <span class="service_name"><b><?php echo $Product->title ?></b></span>
                                                </div>
                                                
                                                <div class="customer-name">
                                                    <span class="service_price"><?php echo number_format($Product->price).'đ/'.$Product->unit; ?></span>
                                                </div>
                                            </div>
                                         </div> 
                                    <?php   } ?>
                                </div>
                              </div>
                              <div id="tabs-2">
                                <div class="row diagram">
                                    <?php foreach($listProduct as $key => $Product){ ?>
                                        <div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" style=" background-image: url('<?php echo $Product->image ?>');" onclick="addProduct('<?php echo $Product->id ?>','<?php echo $Product->title ?>',0, 'free','<?php echo @$Product->unit ?>');" id='product_<?php echo $Product->id ?>_free' >
                                            <div class="item_produc">
                                                <div class="customer-name">
                                                    <span class="service_name"><?php echo $Product->title ?></span>
                                                </div>
                                                
                                                <div class="customer-name">
                                                    <span class="service_price">0đ</span>
                                                </div>
                                            </div>
                                         </div> 
                                    <?php   } ?>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                    <?php   } ?>
                </div>
            </div>

            <div class="mb-3 col-md-7">
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
                                    <th width="20%">Tên sản phẩm</th>
                                    <th  width="15%">Số lượng</th>
                                    <th  width="15%">Đơn giá</th>
                                    <th  width="15%">Đơn vị</th>
                                    <th  width="15%">Giảm giá</th>
                                    <th  width="15%">Thành tiền</th>
                                    <th  width="5%">Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="listProductOrder">
                                <?php 
                                $i = 0;
                                $listProductAdd = array();
                                if(!empty($orderDetail)){
                                       foreach($orderDetail as $key => $item){
                                        $i++;
                                        $listProductAdd[$item->product->id] = $i;
                                      $priceBuy = $item->price*$item->quantity;
                                        if($item->discount > 0){
                                          $priceDiscount = $item->discount;

                                          if($priceDiscount<=100){
                                              $priceDiscount= $priceBuy*$item->discount/100;
                                              $showDiscount = $item->discount.'%';
                                          }else{
                                              $showDiscount = number_format($item->discount).'đ';

                                              $priceDiscount = $priceDiscount*$item->quantity;
                                          }

                                          $priceBuy -= $priceDiscount;
                                        }

                                        $unit = '';
                                        if(!empty($item->unitConversion)){
                                            foreach($item->unitConversion as $key => $value){
                                                if($item->id_unit==$value->id){
                                                    $unit .= '<option selected value="'.$value->id.'">'.$value->unit.'</option>';
                                                }else{
                                                    $unit .= '<option value="'.$value->id.'">'.$value->unit.'</option>';
                                                }
                                            }
                                        }

                                echo    '<tr id="tr'.$i.'">
                                            <td style="text-align: initial;">
                                                <input type="hidden" name="idHangHoa['.$i.']" id="idProduct'.$i.'" value="'.$item->product->id.'">
                                                '.$item->product->title.'
                                            </td>
                                            <td>
                                                <div class="quantity">
                                                    <div class="number-spinner">
                                                        <span class="ns-btn" ></span>
                                                        <input name="soluong['.$i.']" min="1" id="soluong'.$i.'"  type="number" class="pl-ns-value form-control" value="'.$item->quantity.'"  onchange="tinhtien(1);">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" readonly value="'.$item->price.'" class="input_money form-control" name="money['.$i.']" min="1" id="money-'.$i.'" onchange="tinhtien(1);">
                                            </td>
                                            <td id="tdunit-'.$i.'">
                                                <select name="id_unit['.$i.']"  class="form-control form-select color-dropdown"  onclick="unitgetPrice('.$item->id_product.','.$i.','.$item->product->price.')"  id="id_unit'.$i.'">
                                                    <option value="0">'.$item->product->unit.'</option>'.$unit.'</select>
                                            </td>
                                            <td>
                                                <input type="number" value="'.$item->discount.'" class="input_money form-control" name="discount['.$i.']" min="0" id="discount-'.$i.'" onchange="tinhtien(1);">
                                            </td>
                                            <td id="totalmoney'.$i.'">'.$priceBuy.'</td>
                                            <td>
                                                <a href="javascript:void(0);" class="dropdown-item" onclick="deleteProduct('.$i.')"><i class="bx bx-trash me-1" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>';
                               }
                           }else{
                                echo '<tr id="trFirst">
                                    <td colspan="7" align="center">Chưa có sản phẩm nào được chọn.</td>
                                </tr>';

                                 } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="side-bar">
                        <div class="box-form-bar">
                            <div class="info-bh">
                                <ul>
                                    <li>
                                        <span>Thành tiền</span><span id="totalMoney"><?php echo number_format($order->total); ?></span>
                                        <input type="hidden" name="total" id="total" value="<?php echo $order->total; ?>">
                                    </li>    

                                    <li>
                                        <span>Chiết khấu (%)</span>
                                        <span><input class="per-bh input_money form-control" min="0" onchange="tinhtien(0);" type="text" name="promotion" id="promotion" placeholder="0" value="<?php echo $order->discount; ?>" autocomplete="off" /></span>
                                    </li>

                                    <?php 
                                   
                                        $costs = 0;
                                    if(!empty($costsIncurred)){ 
                                        $ordercostsIncurred =  json_decode($order->costsIncurred, true);
                                        ?>   
                                        <li>
                                            <span><strong>chi phí phá sinh</strong></span>
                                        </li> 
                                        <?php foreach ($costsIncurred as $key => $value){ 
                                                $costs++
                                            ?>
                                        <li>
                                            <span><?php echo @$value->name ?></span>
                                            <input type="hidden" name="nameCostsIncurred[]" id="nameCostsIncurred<?php echo $costs ?>" value="<?php echo @$value->name ?>">
                                            <span><input class="per-bh input_money form-control" min="0" onchange="tinhtien(0);" type="number" name="costsIncurred[]" id="costsIncurred<?php echo $costs ?>" placeholder="0" value="<?php echo $ordercostsIncurred[$value->name]; ?>" autocomplete="off" /></span>
                                        </li> 
                                    <?php }} ?>
                                    
                                    <li class="total-bh">
                                        <p><strong>Tổng thanh toán</strong></p>
                                        <p><strong id="totalPay"><?php echo number_format($order->total); ?></strong></p>
                                        <input type="hidden" name="totalPays" id="totalPays" value="<?php echo $order->total; ?>">
                                    </li>

                                    <li>
                                        <span>Đại lý mua hàng (*)</span>
                                        <p><?php echo $member_buy->name.' '.$member_buy->phone ?></p>
                                        <input type="hidden" name="id_member_buy" id="id_member_buy" value="<?php echo @$member_buy->id;?>">
                                    </li>

                                    <li class="total-bh">
                                        <p>Đại lý tuyến trên</p>
                                        <p id="father_info">
                                            <?php if(!empty($father)) echo @$father->name.' '.@$father->phone;?>
                                        </p>
                                    </li>

                                    <li style="display: contents;"><span>Ghi chú</span><br/>
                                        <textarea class="form-control phone-mask" rows="3" name="note"></textarea>
                                    </li>  
                                </ul>
                            </div>

                            <div class="action-cta">
                                <ul>
                                    <li><a href="/editOrderAgency/?id=<?php echo $_GET['id'] ?>" class="btn  btn-secondary">Nhập lại</a></li>
                                    <li><a href="javascript:void(0);" class="btn btn-danger" onclick="createOrder();">Lưu thông tin đơn hàng</a></li>
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
var listProductAdd= {<?php 
    if(!empty($listProductAdd)){
        foreach($listProductAdd as $key => $value){
            echo $key.':'.$value.',';
        }
    }
 ?>};
var row=<?php echo $i; ?>;
var numberProduct= <?php echo $i; ?>;
var checkProduct= true;
var member_buy = '<?php if(!empty($member_buy)) echo $member_buy->name.' '.$member_buy->phone;?>';
var listPositions = {}

<?php
if(!empty($listPositions)){
    foreach ($listPositions as $key => $value) {
        echo '  listPositions['.$key.'] = {};
                listPositions['.$key.']["minMoney"] = '.(int) $value->keyword.';
                listPositions['.$key.']["discount"] = '.(int) $value->description.';
            ';
    }
}
?>

function checkDiscountConfig(money)
{
    var discount = 0;

    Object.keys(listPositions).forEach(function(key) {
        if(money >= listPositions[key]['minMoney']){
            discount = listPositions[key]['discount'];
        }
    });

    $('#promotion').val(discount);

    return discount;
}

// all sản phầm vào đơn hàng 
function addProduct(id, name, priceProduct, type,unit)
{
    var keyID = id+type;
    


    if(listProductAdd.hasOwnProperty(keyID)){
        // thêm số lượng vào mặt hàng đã có  && priceProduct==$('#money-'+listProductAdd[keyID]).val()
        var numberProductRow= $('#soluong'+listProductAdd[keyID]).val();
        numberProductRow++;
        $('#soluong'+listProductAdd[keyID]).val(numberProductRow);
    }else{
        
        row++;
        listProductAdd[keyID]= row;
        numberProduct++;
        //var showNumberProduct= new Intl.NumberFormat().format(numberProduct);
        //$('#numberProduct').html(showNumberProduct);
                
        var readonly;

        $('#listProductOrder tr:first').after('\
            <tr id="tr'+row+'">\
                <td style="text-align: initial;">\
                    <input type="hidden" name="idHangHoa['+row+']" id="idProduct'+row+'" value="'+id+'">\
                    '+name+'\
                </td>\
                <td>\
                    <div class="quantity">\
                        <div class="number-spinner">\
                            <span class="ns-btn" ></span>\
                            <input name="soluong['+row+']" min="1" id="soluong'+row+'"  type="number" class="pl-ns-value form-control" value="1"  onchange="tinhtien(1);">\
                        </div>\
                    </div>\
                </td>\
                <td>\
                    <input type="text" readonly value="'+priceProduct+'" class="input_money form-control" name="money['+row+']" min="1" id="money-'+row+'" onchange="tinhtien(1);">\
                </td>\
                <td id="tdunit-'+row+'">\
                    '+unit+'\
                </td>\
                <td>\
                    <input type="number" value="0" class="input_money form-control" name="discount['+row+']" min="0" id="discount-'+row+'" onchange="tinhtien(1);">\
                </td>\
                <td id="totalmoney'+row+'"></td>\
                <td>\
                    <a href="javascript:void(0);" class="dropdown-item" onclick="deleteProduct(\''+row+'\')"><i class="bx bx-trash me-1" aria-hidden="true"></i></a>\
                </td>\
            </tr>');    
            
            //$("#trFirst").hide();
            unitselect(id, row, unit,priceProduct,type);


            var id_member_buy = $('#id_member_buy').val();

            if(id_member_buy != '' && id_member_buy!='0'){

                discountProductAgency(id, id_member_buy);

            }
           
    }

    tinhtien(1);
}


function unitselect(id_product, i, unit,price,type){

    $.ajax({
          method: "POST",
          url: "/apis/listUnitConversionAPI",
          data: { 
            id_product: id_product,
        }
    }).done(function( msg ) {
             var select = '<select name="id_unit['+i+']"  class="form-control form-select color-dropdown"  onclick="unitgetPrice('+id_product+','+i+','+price+')"  id="id_unit'+i+'"><option value="0">'+unit+'</option>';
             if (msg.code === 1 && msg.data.length > 0 && type !=='free') {
                    msg.data.forEach(item => {
                        select += '<option value="'+item.id+'">'+item.unit+'</option>';
                        
                    });
                 
                }
                select += '</select>';
                $('#tdunit-'+i).html(select);
               
        });
}

function unitgetPrice(id_product, i,price){
    var id_unit = $('#id_unit'+i).val();
    $.ajax({
          method: "POST",
          url: "/apis/unitgetPriceAPI",
          data: { 
            id_product: id_product,
            id_unit: id_unit,
        }
    }).done(function( msg ) {
            if (msg.code === 1) {
                  document.getElementById("money-"+i).value = msg.data.price;
                   tinhtien(1);

            }else{
                document.getElementById("money-"+i).value = price;
                tinhtien(1);
            }
        });

}


// xóa sản phẩm trong đơn 
function deleteProduct(number)
{
    var check= confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');

    if(check == true){
        $("#tr"+number).remove();
        
        numberProduct--;
        //var showNumberProduct= new Intl.NumberFormat().format(numberProduct);
        //$('#numberProduct').html(showNumberProduct);
        
        tinhtien(1);

        if(numberProduct==0){
            $("#trFirst").show();
            row= 0;
            listProductAdd= {};
        }

    }
}


// tính tiền 
function tinhtien(checkDiscount)
{
    var total= 0;
    var totalPay= 0;
    var i;
    var number;
    var price;
    var idProduct;
    var discount;


    var costs = <?php echo @$costs; ?>;
    var total_costsIncurred = 0;
    if(costs>0){
        for(y=1;y<=costs;y++){
            costsIncurred= parseFloat($('#costsIncurred'+y).val());

             total_costsIncurred+= costsIncurred;

        }
    }

    if(row>0){
        for(i=1;i<=row;i++){
            if ($('#tr'+i).length > 0) {
                number= parseFloat($('#soluong'+i).val());
                price= parseFloat($('#money-'+i).val());
               
                $('#soluong'+i).css("border","");
                
               
                if($('#discount-'+i).val()!=''){
                    discount= parseFloat($('#discount-'+i).val());
                }else{
                    discount= 0;
                }
                
                money = 0;
                if(number>0){
                    money= number*price;

                    if(discount>=0 && discount<=100){
                        discount= price*discount/100;
                    }

                    money-= discount*number;
                    
                    total+= money;
                }
                
                money = new Intl.NumberFormat().format(money);
                $('#totalmoney'+i).html(money+'đ');
            }
        }

        if(checkDiscount == 1) checkDiscountConfig(total);

        // giảm giá
        var promotion= $('#promotion').val();
        if(promotion<=100){
            promotion= total*promotion/100;
        }
        
        // tổng tiền cần thanh toán
        totalPay= total-promotion+total_costsIncurred;;

        // thành tiền
        document.getElementById("total").value = total;
        var showTotal= new Intl.NumberFormat().format(total);
        $('#totalMoney').html(showTotal+'đ');

        // tổng tiền cần thanh toán sau chiết khấu
        document.getElementById("totalPays").value = totalPay;
        var showPay= new Intl.NumberFormat().format(totalPay);
        $('#totalPay').html(showPay+'đ');
    }else{
        $('#totalMoney').html('0đ');
        $('#totalPay').html('0đ');
    }
}

// lấy lịch sử giảm gá từng sản phẩm
function discountProductAgency(id_product, id_member_buy){
    var idProduct 
     $.ajax({
          method: "POST",
          url: "/apis/AjaxDiscountProductAgency",
          data: { 
            id_product: id_product,
            id_member_buy: id_member_buy, 
        }
    })
        .done(function( msg ) {
            // /console.log(id_product);
            // var obj = jQuery.parseJSON(msg);
             // console.log(obj);
            if(msg.code==1){
                if(row>0){
                    for(i=1;i<=row;i++){
                            idProduct= $('#idProduct'+i).val();
                            if(id_product == idProduct){

                                $('#discount-'+i).val(msg.discount);
                                tinhtien(1); 
                            }
                        
                    }
                }
            }
        })

        
}

// thanh toán 
function createOrder()
{
    tinhtien(0);

    var r;
    var id_member_buy = $('#id_member_buy').val();

     console.log(numberProduct);

    if(numberProduct>0){
        if(id_member_buy != '' && id_member_buy!='0'){
            r = confirm("Bạn muốn tạo yêu cầu nhập hàng cho đại lý "+member_buy+" đúng không?");
            if (r == true) {
                if(checkProduct){
                    $('#summary-form').submit();
                }
            }
        }else{
            alert('Bạn chưa chọn đại lý nào');
        }
    }else{
        alert('Bạn chưa chọn sản phẩm nào');
    }
}


function showAddCustom()
    {
        $('#addCustomer').modal('show');
    }

  
</script>

<script type="text/javascript">
    // tìm sản phẩm
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
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchProductAPI", {
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
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );

                addProduct(ui.item.id,ui.item.title,ui.item.price, '',ui.item.unit);
                
                $( "#searchProduct" ).val('');
                return false;
            }
        });
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>