<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/account">Tài khoản</a> /</span>
    Đổi thông tin
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Đổi thông tin</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin 
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Thông tin tài khoản ngân hàng
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-theme" aria-controls="navs-top-info" aria-selected="false">
                          Theme info
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Họ tên (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$user->name;?>"/>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Ảnh đại diện (*)</label>
                              <?php showUploadFile('avatar','avatar',@$user->avatar,0);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Ảnh banner chia sẻ</label>
                              <?php showUploadFile('banner','banner',@$user->banner,1);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Email (*)</label>
                              <input required type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$user->email;?>"/>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                              <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="name" value="<?php echo @$user->birthday;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Trang Twitter</label>
                              <input type="text" class="form-control phone-mask" name="twitter" id="twitter" value="<?php echo @$user->twitter;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Kênh Tiktok</label>
                              <input type="text" class="form-control phone-mask" name="tiktok" id="tiktok" value="<?php echo @$user->tiktok;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Kênh Youtube</label>
                              <input type="text" class="form-control phone-mask" name="youtube" id="youtube" value="<?php echo @$user->youtube;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Trang Linkedin</label>
                              <input type="text" class="form-control phone-mask" name="linkedin" id="linkedin" value="<?php echo @$user->linkedin;?>" />
                            </div>

                            
                          </div>
                          
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Số điện thoại (*)</label>
                              <input disabled type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$user->phone;?>"/>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Địa chỉ</label>
                              <input required type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$user->address;?>"/>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Trang Website</label>
                              <input type="text" class="form-control phone-mask" name="web" id="web" value="<?php echo @$user->web;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Trang Facebook</label>
                              <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$user->facebook;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Trang Instagram</label>
                              <input type="text" class="form-control phone-mask" name="instagram" id="instagram" value="<?php echo @$user->instagram;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Trang Zalo</label>
                              <input type="text" class="form-control phone-mask" name="zalo" id="zalo" value="<?php echo @$user->zalo;?>" />
                            </div>
                             <!-- <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Giao diện trang info</label>
                              <select required class="form-select" name="display_info" id="display_info">
                                  <option value="">Chọn giao diện trang info</option>
                                  <?php foreach($displayInfo as $key => $item){
                                    $selected = '';
                                    if($user->display_info==$key){ 
                                      $selected = 'selected';
                                    }
                                    echo'<option value="'.$key.'" '.$selected.' >'.$item.'</option>';
                                  } ?>
                                </select>
                            </div> -->
                             <!-- <div class="mb-3">
                              <label class="form-label">Ảnh mã QR thanh toán</label>
                              <?php showUploadFile('image_qr_pay','image_qr_pay',@$user->image_qr_pay,3);?>
                            </div> -->
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Mã QR của bạn</label><br/>
                              <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'info/?id='.@$user->id;?>" width="100">
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Giới thiệu bản thân</label>
                              <?php showEditorInput('description', 'description', @$user->description);?>
                            </div>
                          </div>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Họ tên chủ thẻ(*)</label>
                              <input type="text" class="form-control phone-mask" name="bank_name" id="bank_name" value="<?php echo @$user->bank_name;?>"/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Số tài khoản ngân hàng</label>
                              <input type="text" class="form-control phone-mask" name="bank_number" id="bank_number" value="<?php echo @$user->bank_number;?>"/>
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                           <div class="mb-3">
                            <label class="form-label" for="basic-default-phone">ngân hàng </label>
                            <select class="form-select" name="bank_code" id="bank_code">
                              <option value="">Chọn ngân hàng</option>
                              <?php
                              $listBank = listBank();
                              foreach($listBank as $key => $item){
                                $selected = '';
                                if(@$user->bank_code==$item['code']){ 
                                  $selected = 'selected';
                                }
                                echo'<option value="'.$item['code'].'" '.$selected.' >'.$item['name'].' ('.$item['code'].')</option>';
                              } ?>
                            </select>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="tab-pane fade content" id="navs-top-theme" role="tabpanel">
                        <div class="row mb-3">
                          
                            <?php
                            $list_theme_info = explode(",", $user->list_theme_info);
                              if(!empty(listThemeInfo())){
                                foreach(listThemeInfo() as $key => $item){
                                  $status = '';

                                  if (in_array($item['id'], $list_theme_info)) {
                                      if($item['id'] == $user->display_info){
                                        $status = ' <p>Đang sử dụng theme này</p>';
                                      }else{
                                        $status = ' <a href="/useThemeInfo?id='.$item['id'].'" class="btn btn-success">Sử dụng theme này </a>';
                                      }
                                  }else{
                                     $status = ' <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal'.$item['id'].'">Đặt mua theme</a>';
                                  }

                                  echo '<div class="col-md-4">
                                        <img src="'.$item['image'].'" style="width: 100%; height:550px;"/>
                                        <div style=" text-align: center; font-size: 20px; padding: 10px 0; ">
                                        <a>Giá : '.number_format($item['price']).'đ</p>
                                        '.$status.'
                                        </div>
                                    </div>';
                                }
                              }
                             ?>
                        </div>
                      </div>

              <button type="submit" class="btn btn-primary">Lưu</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php  if(!empty(listThemeInfo())){
  global $urlTransaction;
  foreach(listThemeInfo() as $key => $item){
     $link = $urlTransaction.'accountName=tran ngọc manh &amount='.$item['price'].'&addInfo='.$boss->phone.' '.$user->id.' '.$item['id'];
    ?>
    <div class="modal fade" id="basicModal<?php echo $item['id'] ?>"  name="id">

      <div class="modal-dialog" role="document" style=" max-width: 45rem;">
        <div class="modal-content" style="padding: 20px;">
          <div class="modal-header form-label border-bottom">
            <h5 class="modal-title" id="exampleModalLabel1">Thanh toán Mua theme info </h5>
            <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="row">
            <div class="col-md-6">
                  <img src="<?php echo $item['image']?>" style="width: 100%; height:550px;"/>
                <div style=" text-align: center; font-size: 20px; padding: 10px 0; ">
                  <p>Giá : <?php echo number_format($item['price']) ?>đ</p>
                </div>
            </div>
            <div class="col-md-6">
              <h5 style="text-align: center;">Mã QR thanh toán</h5>
               <img src="<?php echo $link; ?>" style="width: 100%;">

            </div>
            
               
             </div>
           </div>
         </div>
       </div>
     </div>
   <?php  }
 }
 ?>

<?php include(__DIR__.'/../footer.php'); ?>