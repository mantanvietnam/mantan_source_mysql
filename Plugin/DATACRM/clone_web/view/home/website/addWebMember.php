<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWebMember">Website đại lý</a> /</span>
    Cài đặt website đại lý
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt website đại lý</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Loại tài khoản</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="type" id="type" onchange="select_type_account();">
                        <option value="member" <?php if(!empty($data->type) && $data->type=='member') echo 'selected'; ?> >Đại lý</option>
                        <option value="affiliate" <?php if(isset($data->type) && $data->type=='affiliate') echo 'selected'; ?> >Cộng tác viên affiliate</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3" id="div_member">
                    <label class="form-label" for="basic-default-phone">Đại lý (*)</label>
                    <input type="text" class="form-control phone-mask" name="member" id="member" placeholder="Nhập tên hoặc SĐT" value="<?php if(!empty($member)) echo $member->name.' '.$member->phone;?>" autocomplete="off" />
                    <input type="hidden" name="id_member" id="id_member" value="<?php echo @$data->id_member;?>">
                  </div>

                  <div class="mb-3" id="div_affiliate" style="display: none;">
                    <label class="form-label" for="basic-default-phone">Cộng tác viên  affiliate(*)</label>
                    <input type="text" class="form-control phone-mask" name="affiliate" id="affiliate" placeholder="Nhập tên hoặc SĐT" value="<?php if(!empty($affiliate)) echo $affiliate->name.' '.$affiliate->phone;?>" autocomplete="off" />
                    <input type="hidden" name="id_affiliate" id="id_affiliate" value="<?php echo @$data->id_member;?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tên miền (*)</label>
                    <input type="text" required  class="form-control" placeholder="VD: tranmanh.zikii.vn" name="domain" id="domain" value="<?php echo @$data->domain;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Gói giao diện (*)</label>
                    <div class="input-group input-group-merge">
                      <select name="theme" id="theme" class="form-select" required>
                        <option value="">Chọn gói giao diện</option>
                        <?php 
                        if(!empty($listFolder)){
                          foreach ($listFolder as $key => $value) {
                            if(empty($data->theme) || $data->theme!=$value){
                              echo '<option value="'.$value.'" >'.$value.'</option>';
                            }else{
                              echo '<option selected value="'.$value.'" >'.$value.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(isset($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
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

        $( "#member" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchMemberAPI", {
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
                
                $( "#member" ).val(ui.item.label);
                $( "#id_member" ).val(ui.item.id);

                member_buy = ui.item.label;

                return false;
            }
        });

        $( "#affiliate" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchAffiliateAPI", {
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
                
                $( "#affiliate" ).val(ui.item.label);
                $( "#id_affiliate" ).val(ui.item.id);

                member_buy = ui.item.label;

                return false;
            }
        });
    });
</script>

<script type="text/javascript">
  function select_type_account()
  {
    var type = $('#type').val();

    $('#div_member').hide();
    $('#div_affiliate').hide();

    if(type=='member'){
      $('#div_member').show();
    }else{
      $('#div_affiliate').show();
    }
  }
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>