<?php include(__DIR__.'/../header.php'); 
global $type_collection_bill;
?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPayableDebt">Công nợ phải trả</a> /</span>
    Thông tin công nợ phải trả
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin công nợ phải trả</h5>
          </div>
          <div class="card-body">
            <?php echo @$mess;?>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Đối tác (*)</label>
                  <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
                  <input type="hidden" name="id_customer" id="id_customer" value="<?php echo (int) @$data->id_customer;?>">
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Thời gian tạo công nợ (*)</label>
                  <input type="text" required  class="form-control hasDatepicker datetimepicker" placeholder="" name="time" id="time" value="<?php echo date('d/m/Y H:i', @$data->time);?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Số tiền (*)</label>
                  <input required type="number" min="100" class="form-control phone-mask" name="total" id="total" value="<?php echo @$data->total;?>" />
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="basic-default-phone">Nội dung nợ</label>
                    <textarea  class="form-control" rows="5" name="note"><?php echo @$data->note;?></textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>
    </div>
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