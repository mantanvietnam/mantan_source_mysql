<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/product_feedback-view-admin-feedback-listFeedback.php">Đánh giá</a> /</span>
    Thông tin đánh giá
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đánh giá</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Khách hàng đánh giá (*)</label>
                    <input type="hidden" name="id_customer" id="id_customer" required value="<?php echo @$data->id_customer;?>">
                    <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->customer->full_name.' '.@$data->customer->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Sản phẩm dịch vụ (*)</label>
                    <input type="hidden" name="id_product" id="id_product" required value="<?php echo @$data->id_product;?>">
                    <input required type="text" class="form-control phone-mask" name="name_product" id="name_product" value="<?php echo @$data->product->title;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ý kiến khách hàng</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="note" id="note"><?php echo @$data->note;?></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <?php 
                  if(!empty($criteria)){
                    foreach ($criteria as $key => $value) {
                      echo '<div class="mb-3">
                              <label class="form-label">Số điểm đánh giá cho tiêu chí '.$value.' (*)</label>
                              <input required min="0" max="5" type="number" class="form-control phone-mask" name="point['.$key.']" id="" value="'.@$data->point_detail[$key].'" />
                            </div>';
                    }
                  }
                  ?>  
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script type="text/javascript">
$(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }

    function extractLast( term ) {
      return split( term ).pop();
    }


    $( "#phone" )
    // don't navigate away from the field on tab when selecting an item
    .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
        }
    })
    .autocomplete({
        source: function( request, response ) {
            $.getJSON( "/apis/searchCustomerAPI", {
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
           
            $('#phone').val(ui.item.label);
            $('#id_customer').val(ui.item.id);
      
            return false;
        }
    });


    $( "#name_product" )
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
            //console.log(ui);
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.label );
           
            $('#id_product').val(ui.item.id);
            $('#name_product').val(ui.item.title);
            
            return false;
        }
    });
});
</script>