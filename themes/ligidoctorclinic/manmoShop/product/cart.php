<?php getHeader();
?>

<?php
	if(isset($_SESSION['orderProducts'])){
		$listOrderProduct= $_SESSION['orderProducts'];
	}else{
		$listOrderProduct= array();
	}
	$numberProduct= count($listOrderProduct);
?>
	<!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="rs clsH3Blog">Giỏ hàng</h1>
                    <ul class="list-inline rs">
                        <li class="list-inline-item"><a href="/">Trang chủ</a></li>

                        
                        <li class="list-inline-item"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li class="list-inline-item">Giỏ hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ::::::  End  Breadcrumb Section  ::::::  -->

     <!-- ::::::  Start  Main Container Section  ::::::  -->
     <main id="main-container" class="main-container">
        <div class="container">
        	<div class="">Giỏ hàng của bạn (<?php echo $numberProduct;?> sản phẩm)</div>
        	<?php if($numberProduct>0) { ?>
            <div class="row">
                <div class="col-12">
                    <!-- Start Cart Table -->
                    <div class="table-content table-responsive cart-table-content m-t-30">
                    	<form action="/saveOrderProduct_reloadOrder" method="post" id="formCart" class="form-box">
                        <table>
                            <thead class="gray-bg" >
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Tích lũy</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
									$total= 0;
									$totalPoint= 0;
									foreach($_SESSION['orderProducts'] as $product){
										$priceShow= $product['Merchandise']['price'];
										$money= $priceShow*$product['Merchandise']['numberOrder'];
										$point= $product['Merchandise']['point']*$product['Merchandise']['numberOrder'];
										$total += $money; 
										$totalPoint += $point; 

										?>
										
												<!-- dfsafsafasfas -->
												<tr>
				                                    <td class="product-thumbnail">
				                                        <a href="#"><img class="img-fluid" src="<?php echo $product['Merchandise']['image'] ?>" alt=""></a>
				                                    </td>
				                                    <td class="product-name"><a href="product/<?php echo @$product['Merchandise']['urlSlug'] ?>.html"><?php echo $product['Merchandise']['name'] ?></a></td>
				                                    <td class="product-price-cart"><span class="amount"><?php echo number_format($priceShow) ?></span></td>
				                                    <td class="product-quantities">
				                                        <div class="quantity d-inline-block">
				                                            <?php echo number_format($product['Merchandise']['numberOrder']) ?>
				                                        </div>
				                                    </td>
				                                    <td class="product-subtotal"><?php echo number_format($money) ?></td>
				                                    <td class="product-subtotal"><?php echo number_format($point) ?> điểm</td>
				                                    <td class="product-remove">
				                                        
				                                        <a href="javascript:void(0);" onclick="deleteProductCart('<?php echo $product['Merchandise']['id']; ?>');"><i class="fa fa-times"></i></a>
				                                    </td>
				                                </tr>
										<?php
									}
								?>
								<tr></tr>
                            </tbody>
                        </table>
             
                    	</form>
                    </div>  <!-- End Cart Table -->
                     <!-- Start Cart Table Button -->
                    <div class="cart-table-button m-t-10">
                        
                        <div class="cart-table-button--right">
                            <a href="javascript:void(0);" onclick="clearCart();" class="btn btn--box btn--large btn--radius btn--black btn--black-hover-green btn--uppercase font--bold m-t-20">XÓA TOÀN BỘ GIỎ HÀNG</a>
                        </div>
                    </div>  <!-- End Cart Table Button -->
                </div>
            </div>
            <div class="row my_fde">
                <form action="<?php echo $urlHomes.'saveOrderProduct_addOrder';?>" method="post" class="col-lg-6 col-md-6">
                	<input type="hidden" name="userId" value="<?php echo @$_SESSION['infoUser']['User']['id'];?>">
                    <div class="sidebar__widget m-t-40">
                        <div class="sidebar__box">
                            <div class="sidebar__title">Thông tin của bạn</div>
                        </div>

                            <div class="form-box__single-group">
                                <label for="hoten">* Họ tên</label>
                                <input type="text" maxlength="255" required="" name="cus_name" id="cus_name" value="<?php echo @$_SESSION['infoUser']['User']['cus_name'];?>">
                            </div>
                            <div class="form-box__single-group">
                                <label for="sdt">* Số điện thoại</label>
                                <input type="tel" name="phone" id="sdt" maxlength="11" required="" value="<?php echo @$_SESSION['infoUser']['User']['phone'];?>" >
                            </div>
                            <div class="form-box__single-group">
                                <label for="email">* Email</label>
                                <input type="email" name="email" id="email" required="" value="<?php echo @$_SESSION['infoUser']['User']['email'];?>">
                            </div>
                            <div class="form-box__single-group">
                                <label for="diachi">* Địa chỉ nhận hàng</label>
                                <input type="text" maxlength="255" required="" name="address" id="diachi" value="<?php echo @$_SESSION['infoUser']['User']['address'];?>">
                            </div>
                            <div class="form-box__single-group">
                                <label for="ghichu">Ghi chú</label>
                                <textarea id="note" name="note" rows="5"></textarea>
                            </div>
                            
                            <button style="margin-top: 20px" class="btn btn--box btn--small btn--radius btn--green btn--green-hover-black btn--uppercase font--semi-bold" <?php echo (isset($_SESSION['infoUser']))?'type="submit"':'type="button" onclick="LoginFunciton()"'; ?>>Xác nhận</button>
                    </div>
	                
            	</form>
                <div class="col-lg-6 col-md-6">
                    <div class="sidebar__widget m-t-40">
                        <div class="sidebar__box">
                            <div class="sidebar__title">Thanh toán</div>
                        </div>
                        <div class="total-cost">Tổng tiền<span><?php echo number_format($total).'đ'; ?></span></div>
                        <div class="total-cost" style="border-top: 1px solid #7e7e7e;padding-top: 15px;">Tổng điểm tích lũy<span><?php echo number_format($totalPoint).' điểm'; ?></span></div>
                        <div class="total-shipping">
                        	Chưa bao gồm phí vận chuyển
                            
                        </div>
                        <div style="font-size:1.5rem" class="grand-total m-tb-25">Tổng thanh toán <span><?php echo number_format($total).'đ'; ?></span></div>
                    </div>
                </div>
            </div>
        <?php }else { ?>
        	<p>Bạn chưa có sản phẩm nào trong này.</p>
        <?php
    	}
        ?>
        </div>
    </main> <!-- ::::::  End  Main Container Section  ::::::  -->

<script type="text/javascript">
	var urlHomes= "<?php echo $urlHomes; ?>";
    var urlPluginCart= "/cart/";
	
	function deleteProductCart(idProduct)
	{
		var r= confirm('Bạn có chắc chắn muốn xóa không?');
		if(r)
		{
			$.ajax({
		      type: "POST",
		      url: "/saveOrderProduct_deleteProductCart",
		      data: {idProduct:idProduct}
		    }).done(function( msg ) { 	
			  		window.location= urlPluginCart;
			})
			.fail(function() {
					alert('Quá trình xử lý bị lỗi !');
					return false;
			});
		}
	}
	
	function clearCart()
	{
		var r= confirm('Bạn có chắc chắn muốn làm trống giỏ hàng không?');
		if(r)
		{
			$.ajax({
		      type: "POST",
		      url: "/saveOrderProduct_clearCart",
		      data: {}
		    }).done(function( msg ) { 	
			  		window.location= urlPluginCart;
			})
			.fail(function() {
					alert('Quá trình xử lý bị lỗi !');
					return false;
			});
		}
	}
</script>	

<?php getFooter(); ?>

<?php if(!empty($_GET['codeOrder'])) { ?>
    <div id="messModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                	Đặt hàng thành công, mã đặt hàng của bạn là <b><?php echo $_GET['codeOrder'];?></b>. Vui lòng liên hệ hotline <?php echo $contactSite['Option']['value']['fone'];?> nếu cần hỗ trợ.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#messModal').modal('show');
    </script>
<?php } ?>