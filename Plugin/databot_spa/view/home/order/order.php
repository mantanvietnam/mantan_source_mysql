<?php include(__DIR__.'/../header.php'); ?>
<style type="text/css">
	.tableService{
		padding: 1rem !important;
	    font-size: 1.4rem;
	    color: #67798c;
	    font-family: inherit;
	    font-weight: 900;
	}
    /*.card{
        padding: 30px;
    }*/
   
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
        background: seagreen;
        color: white;
        height: 100px;
        margin: 1px;
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
</style>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Tạo đơn hàng</h4>
 <?= $this->Form->create(); ?>
 	<div class="row">
 		<div class="mb-3 col-md-6">
		 	<div class="card-header d-flex justify-content-between align-items-center">
		 		<div class="card mb-4 card-body">
		 			<div class="row">
	                  <div class="mb-3 col-md-10">
	                    <label class="form-label" for="basic-default-phone">Khách hàng (*)</label>
	                    <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
	                    <input type="hidden" name="id_customer" id="id_customer" value="<?php echo (int) @$data->id_customer;?>">
	                  </div>
	                  <div class="mb-3 col-md-2">
	                   <p><a href="/addCustomer" class="btn btn-primary" type="Thêm khách hàng"><i class='bx bx-plus'></i> </a></p>
	                  </div>
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
				    			<div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" onclick="addProduct('<?php echo $Service->id ?>','<?php echo $Service->name ?>',<?php echo $Service->price ?>,'service');" id='service<?php echo $Service->id ?>'>
                                    <div class="customer-name"><span class="service_name"><?php echo $Service->name ?></span></div>
                                    <div class="customer-name"><span class="service_price"><?php echo number_format($Service->price) ?>đ</span></div>
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
				    			<div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" onclick="addProduct('<?php echo $combo->id ?>','<?php echo $combo->name ?>',<?php echo $combo->price ?>,'combo');" id='combo<?php echo $Product->id ?>'>
                                    <div class="customer-name"><span class="service_name"><?php echo $combo->name ?></span></div>
                                    <div class="customer-name"><span class="service_price"><?php echo number_format($combo->price) ?>đ</span></div>
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
				    			<div class="col-xs-6 col-sm-3 col-md-3 clear-room context-menu-two" onclick="addProduct('<?php echo $Product->id ?>','<?php echo $Product->name ?>',<?php echo $Product->price ?>,'product');" id='product_<?php echo $Product->id ?>' >
                                       <div class="customer-name"><span class="service_name"><?php echo $Product->name ?></span></div>
                                            <div class="customer-name"><span class="service_price"><?php echo number_format($Product->price) ?>đ</span></div>
                                 </div> 
				   <?php   } ?>
					</div>
				  </div>
				</div>
				 <?php   } ?>
		 	</div>
		 	
		</div>
	</div>


 <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
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