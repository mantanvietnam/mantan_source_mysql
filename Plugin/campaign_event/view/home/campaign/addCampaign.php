<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCampaign">Chiến dịch</a> /</span>
    Thông tin
  </h4>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Thông tin chiến dịch</h5>
    
    <div class="demo-inline-spacing">
      <?php echo $mess;?>
      <?= $this->Form->create(); ?>
        <div class="row">
          <div class="col-md-12">
            <div id="tabs" class="mb-3">
              <ul>
                <li><a href="#tabs-1">Thông tin chung</a></li>
                <li><a href="#tabs-2">Quay thưởng</a></li>
                <li><a href="#tabs-3">Checkin</a></li>
                <li><a href="#tabs-4">Khu vực</a></li>
                <li><a href="#tabs-5">Đội nhóm</a></li>
                <li><a href="#tabs-6">Hạng vé</a></li>
              </ul>
              <div id="tabs-1">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Tên chiến dịch (*)</label>
                      <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Trạng thái</label>
                      <select name="status" class="form-select color-dropdown">
                          <option value="active" <?php if(!empty($data->status) && $data->status=="active") echo 'selected';?> >Kích hoạt</option>
                          <option value="lock" <?php if(!empty($data->status) && $data->status=="lock") echo 'selected';?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
                  </div>
                </div>
              </div>
              <div id="tabs-2">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Mã bảo mật quay thưởng</label>
                      <input type="text" class="form-control phone-mask" name="codeSecurity" id="codeSecurity" value="<?php echo @$data->codeSecurity;?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">ID người chiến thắng (cách nhau dấu phẩy)</label>
                      <input type="text" class="form-control phone-mask" name="codePersonWin" id="codePersonWin" value="<?php echo @$data->codePersonWin;?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Mã màu chữ</label>
                      <input type="text" class="form-control phone-mask" name="colorText" id="colorText" value="<?php echo @$data->colorText;?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Ảnh logo</label>
                      <?php showUploadFile('img_logo','img_logo',@$data->img_logo,0);?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Ảnh nền</label>
                      <?php showUploadFile('img_background','img_background',@$data->img_background,1);?>
                    </div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
                  </div>
                </div>
              </div>
              <div id="tabs-3">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Tên hiển thị của sự kiện</label>
                      <input type="text" class="form-control phone-mask" name="name_show" id="name_show" value="<?php echo @$data->name_show;?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Thông báo chào mừng</label>
                      <input type="text" class="form-control phone-mask" name="text_welcome" id="text_welcome" value="<?php echo @$data->text_welcome;?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Nội dung hiển thị khi quét QR checkin</label>
                      <textarea rows="5" name="noteCheckin" class="form-control"><?php echo @$data->noteCheckin;?></textarea>
                    </div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
                  </div>

                  <div class="col-md-12 mb-3">
                    <b>Mã thay thế:</b>
                    <br/>
                    %full_name% : Họ tên
                    <br/>
                    %email% : Email
                    <br/>
                    %phone% : Số điện thoại
                    <br/>
                    %note% : Ghi chú
                    <br/>
                    %avatar% : Link ảnh đại diện
                    <br/>
                    %campain% : Tên chiến dịch
                    <br/>
                    %code% : Mã đăng ký
                    <br/>
                    %affiliate% : Người giới thiệu
                    <br/>
                    %location% : Khu vực
                    <br/>
                    %team% : Đội nhóm
                    <br/>
                    %group% : Nhóm khách hàng
                    <br/>
                    %birthday% : Ngày sinh
                  </div>
                </div>
              </div>
              <div id="tabs-4">
                <div class="row">
                  <?php
                  for($i=1;$i<=10;$i++){
                    echo '<div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Khu vực '.$i.'</label>
                              <input type="text" class="form-control phone-mask" name="location['.$i.']" id="" value="'.@$data->location[$i].'" />
                            </div>
                          </div>';
                  }
                  ?>

                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
                  </div>
                </div>
              </div>
              <div id="tabs-5">
                <div class="row">
                  <?php
                  for($i=1;$i<=20;$i++){
                    echo '<div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Đội nhóm '.$i.'</label>
                              <input id="team'.$i.'" type="text" class="form-control phone-mask" name="team['.$i.']" id="" value="'.@$data->team[$i]['name'].'" />
                              <input type="hidden" value="'.@$data->team[$i]['id_member'].'" name="team_boss['.$i.']" id="team_boss'.$i.'" />
                            </div>
                          </div>';
                  }
                  ?>

                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
                  </div>
                </div>
              </div>

              <div id="tabs-6">
                <div class="row">
                  <?php
                  for($i=1;$i<=10;$i++){
                    echo '<div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Tên loại vé '.$i.'</label>
                              <input type="text" class="form-control phone-mask" name="ticket_name['.$i.']" id="" value="'.@$data->ticket[$i]['name'].'" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Giá vé '.$i.'</label>
                              <input type="text" class="form-control phone-mask" name="ticket_price['.$i.']" id="" value="'.@$data->ticket[$i]['price'].'" />
                            </div>
                          </div>';
                  }
                  ?>

                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>
<!--/ Responsive Table -->
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

        <?php for($i=1; $i<=20; $i++){ ?>
        $( "#team<?php echo $i;?>" )
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
                
                $( "#team<?php echo $i;?>" ).val(ui.item.label);
                $( "#team_boss<?php echo $i;?>" ).val(ui.item.id);

                return false;
            }
        });
        <?php }?>
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>