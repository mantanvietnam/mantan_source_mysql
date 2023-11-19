<?php include __DIR__.'/../header.php';?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<style>
	footer {
		display: none;
	}
	main {
		overflow: hidden;
	}
</style>
<main>
	<section class="box-gallery">
		<div class="container">
			<div class="content-detail-gallery detail-cart">
				<div class="title text-center">
					<span>Giỏ hàng của khách</span>
					<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
					</svg>
				</div>
				<div class="content-cart">
					<div class="info-form-user">
						<div class="item-frm">
							<div class="desc">
								<input type="text" placeholder="Số điện thoại khách hàng" name="phone" id="search_user" class="txt_filed">
							</div>
						</div>
					</div>

					<div class="table-cart">
						<?php
							echo $mess;
							if(!empty($infoCart)){
								foreach ($infoCart as $key => $value) {
									echo '	<div class="item-cart">
												<div class="prd-cart">
													<div class="avarta">
														<div class="avr"><a href="javascript:void(0);"><img src="'.$value->image.'" class="img-fluid w-100" alt=""></a></div>
													</div>
													<div class="info">
														<h3><a href="javascript:void(0);">'.$value->name.'</a></h3>
													</div>
												</div>
												<div class="price text-center">'.number_format($value->price).'đ</div>
												<div class="checkbox-cart text-center">
													x '.$value->amount_sell.'
												</div>
											</div>';

								}
							}
						?>
					</div>

					<?php if(!empty($infoCart)) echo '<div class="btn-main text-center"><a id="buttonCreate" href="/createOrderUser">TẠO ĐƠN</a></div>';?>
					
				</div>
			</div>
		</div>
	</section>
</main>

<script type="text/javascript">
	function updatePhone()
	{
		var phone = $('#phone').val();
		$('#buttonCreate').attr("href", "/createOrderUser/?phone="+phone);
	}
</script>

<script type="text/javascript">
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $("#search_user")
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#buttonCreate').attr("href", "/createOrderUser");
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchUserApi", {
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

                $('#search_user').val(ui.item.label);

                $('#buttonCreate').attr("href", "/createOrderUser/?phone="+ui.item.phone);
          
                return false;
            }
        });

    });
</script>

<?php include __DIR__.'/../footer.php';?>