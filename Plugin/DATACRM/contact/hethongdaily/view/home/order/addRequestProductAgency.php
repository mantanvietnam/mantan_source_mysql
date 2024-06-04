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
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/requestProductAgency">Yêu cầu nhập hàng</a> /</span>
    Tạo yêu cầu
  </h4>

    <form id="summary-form" action="" method="post" class="form-horizontal">
        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
        <div class="row">
            <div class="mb-3 col-md-6">

                <div class="card mb-4">
                    <h4 class="fw-bold m-3 mb-0">Sản phẩm</h4>

                    <?php
                    
                    if(!empty($listProduct)){ ?>
                        <div class="row">
                            <div class="m-3 col-md-11 mb-0">
                                <?php echo @$mess;?>
                                <input type="text" placeholder="Tìm sản phẩm"  class="form-control phone-mask" id="searchProduct">
                            </div>
                        </div>

                        <div >
                          <div class="card card-body">
                            <div class="row diagram">
                                <?php foreach($listProduct as $key => $Product){ ?>
                                    <div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" style=" background-image: url('<?php echo $Product->image ?>');" onclick="addProduct('<?php echo $Product->id ?>','<?php echo $Product->title ?>',<?php echo $Product->price ?>);" id='product_<?php echo $Product->id ?>' >
                                        <div class="item_produc">
                                            <div class="customer-name">
                                                <span class="service_name"><?php echo $Product->title ?></span>
                                            </div>
                                            
                                            <div class="customer-name">
                                                <span class="service_price"><?php echo number_format($Product->price) ?>đ</span>
                                            </div>
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
                                    <th  width="15%">Xóa</th>
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
                                    <li>
                                        <span>Thành tiền</span><span id="totalMoney">0</span>
                                        <input type="hidden" name="total" id="total" value="">
                                    </li>    

                                    <li>
                                        <span>Chiết khấu (%)</span>
                                        <span><input class="per-bh input_money form-control" min="0" onchange="tinhtien();" type="text" name="promotion" id="promotion" placeholder="0" value="0" autocomplete="off" readonly /></span>
                                    </li>
                                    
                                    <li class="total-bh">
                                        <p><strong>Tổng thanh toán</strong></p>
                                        <p><strong id="totalPay">0</strong></p>
                                        <input type="hidden" name="totalPays" id="totalPays" value="">
                                    </li>

                                    <li class="total-bh">
                                        <p>Đại lý tuyến trên</p>
                                        <p>
                                            <?php echo @$father->name.' - '.@$father->phone;?>
                                        </p>
                                    </li>

                                    <li style="display: contents;"><span>Ghi chú</span><br/>
                                        <textarea class="form-control phone-mask" rows="3" name="note"></textarea>
                                    </li>  
                                </ul>
                            </div>

                            <div class="action-cta">
                                <ul>
                                    <li><a href="/addRequestProductAgency" class="btn  btn-secondary">Nhập lại</a></li>
                                    <li><a href="javascript:void(0);" class="btn btn-danger" onclick="createOrder();">Tạo yêu cầu nhập hàng</a></li>
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
var numberProduct= 0;
var checkProduct= true;
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
function addProduct(id, name, priceProduct)
{
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

        $('#listProductOrder tr:first').after('<tr id="tr'+row+'"><td style="text-align: initial;"><input type="hidden" name="idHangHoa['+row+']" id="idProduct'+row+'" value="'+id+'">'+name+'</td><td><div class="quantity"><div class="number-spinner"><span class="ns-btn" ></span><input name="soluong['+row+']" min="1" id="soluong'+row+'"  type="number" class="pl-ns-value form-control" value="1"  onchange="tinhtien();"></div></div></td><td><input type="text" readonly value="'+priceProduct+'" class="input_money form-control" name="money['+row+']" min="1" id="money-'+row+'" onchange="tinhtien();"></td><td id="totalmoney'+row+'"></td><td><a href="javascript:void(0);" class="dropdown-item" onclick="deleteProduct(\''+row+'\')"><i class="bx bx-trash me-1" aria-hidden="true"></i></a></td></tr>');    
            
            $("#trFirst").hide();
           
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
function tinhtien()
{
    var total= 0;
    var totalPay= 0;
    var i;
    var number;
    var price;
    var idProduct;

    if(row>0){
        for(i=1;i<=row;i++){
            if ($('#tr'+i).length > 0) {
                number= parseFloat($('#soluong'+i).val());
                price= parseFloat($('#money-'+i).val());
               
                $('#soluong'+i).css("border","");
                
                money = 0;
                if(number>0){
                    money= number*price;
                    total+= money;
                }
                 
                money = new Intl.NumberFormat().format(money);
                $('#totalmoney'+i).html(money+'đ');
            }
        }

        checkDiscountConfig(total);

        // giảm giá
        var promotion= $('#promotion').val();
        if(promotion<=100){
            promotion= total*promotion/100;
        }
        
        // tổng tiền cần thanh toán
        totalPay= total-promotion;

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

// thanh toán 
function createOrder()
{
    tinhtien();

    var r;

    if(numberProduct>0){
        r = confirm("Bạn muốn gửi yêu cầu nhập hàng đúng không?");
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

                addProduct(ui.item.id,ui.item.title,ui.item.price)
                
                $( "#searchProduct" ).val('');
                return false;
            }
        });
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>