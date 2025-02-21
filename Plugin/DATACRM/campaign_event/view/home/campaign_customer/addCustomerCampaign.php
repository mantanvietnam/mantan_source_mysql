<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCampaign">Chiến dịch</a> /</span> <a href="/listCustomerCampaign/?id=<?php echo $infoCampaign->id;?>"><?php echo $infoCampaign->name;?></a> / 
    Khách đăng ký
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khách đăng ký</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Khu vực</label>
                    <select name="id_location" class="form-select color-dropdown">
                      <option value="0">Chọn khu vực</option>
                      <?php
                      if(!empty($infoCampaign->location)){
                        foreach($infoCampaign->location as $key=>$location){
                          if(!empty($location)){
                            if(empty($data->id_location) || $data->id_location!=$key){
                              echo '<option value="'.$key.'">'.$location.'</option>';
                            }else{
                              echo '<option selected value="'.$key.'">'.$location.'</option>';
                            }
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đội nhóm</label>
                    <select name="id_team" class="form-select color-dropdown">
                      <option value="0">Chọn đội nhóm</option>
                      <?php
                      if(!empty($infoCampaign->team)){
                        foreach($infoCampaign->team as $key=>$team){
                          if(!empty($team['name'])){
                            if(empty($data->id_team) || $data->id_team!=$key){
                              echo '<option value="'.$key.'">'.$team['name'].'</option>';
                            }else{
                              echo '<option selected value="'.$key.'">'.$team['name'].'</option>';
                            }
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hạng vé</label>
                    <select name="id_ticket" class="form-select color-dropdown">
                      <option value="0">Chọn hạng vé</option>
                      <?php
                      if(!empty($infoCampaign->ticket)){
                        foreach($infoCampaign->ticket as $key=>$ticket){
                          if(!empty($ticket['name'])){
                            if(empty($data->id_ticket) || $data->id_ticket!=$key){
                              echo '<option value="'.$key.'">'.$ticket['name'].' '.number_format($ticket['price']).'đ</option>';
                            }else{
                              echo '<option selected value="'.$key.'">'.$ticket['name'].' '.number_format($ticket['price']).'đ</option>';
                            }
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Checkin tự động</label>
                    <select name="checkin" class="form-select color-dropdown">
                      <option value="0">Chưa checkin</option>
                      <option value="1" <?php if(!empty($data->time_checkin)) echo 'selected';?>>Đã checkin</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ghi chú</label>
                    <textarea class="form-control phone-mask" name="note" rows="5"><?php echo @$data->note;?></textarea>
                  </div>
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
    // tìm sản phẩm
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
                
                $( "#full_name" ).val(ui.item.full_name);
                $( "#phone" ).val(ui.item.phone);

                return false;
            }
        });
    });
</script>
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>