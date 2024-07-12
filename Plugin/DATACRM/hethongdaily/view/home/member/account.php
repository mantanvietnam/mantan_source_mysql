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
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-link" aria-controls="navs-top-info" aria-selected="false">
                          Danh sách link
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
                              <label class="form-label">Ảnh đại diện</label>
                              <input type="file" class="form-control phone-mask" name="avatar" id="avatar" value=""/>
                              <?php
                              if(!empty($user->avatar)){
                                echo '<br/><img src="'.$user->avatar.'" width="80" />';
                              }
                              ?>
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
                              <label class="form-label">Ảnh banner chia sẻ</label>
                              <input type="file" class="form-control phone-mask" name="banner" id="banner" value=""/>
                              <?php
                              if(!empty($user->banner)){
                                echo '<br/><img src="'.$user->banner.'" width="80" />';
                              }
                              ?>
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
                            
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Mã QR của bạn</label><br/>
                              <div class="row">
                                <div class="col-md-6">
                                  <img class="mb-3" id="QRURLProfile" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'info/?id='.@$user->id;?>" width="100">
                                </div>
                                <div class="col-md-6">
                                  <button type="button" class="btn btn-primary mb-3" onclick="copyToClipboard('<?php echo $urlHomes.'info/?id='.@$user->id;?>');"><i class='bx bx-link'></i> Sao chép liên kết</button>

                                  <button type="button" class="btn btn-danger mb-3" onclick="downloadImageFromSrc('https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'info/?id='.@$user->id;?>', '<?php echo $user->phone;?>');"><i class='bx bx-cloud-download'></i> Tải mã QR</button>
                                </div>
                              </div>
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
                            <label class="form-label" for="basic-default-phone">Ngân hàng </label>
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
                      <div class="tab-pane fade" id="navs-top-link" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                            <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                             <thead>
                              <tr>
                                <th>Kiểu</th>
                                <th>Link</th>
                                <th>Tên link</th>
                                <th>Mô tả</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodylink">  
                              <?php
                              $i= 0;
                              if(!empty($dataLink)){
                                foreach($dataLink as $key => $value){
                                  $i++;
                                 
                                    $delete= '<a onclick="deleteTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                  
                                  ?>
                                  <tr class="gradeX" id="trlink-<?php echo $i ?>">
                                    <td>
                                      <select name="type[<?php echo $i ?>]" class="form-select color-dropdown">
                                        <option value="">Chọn kiểu link</option>
                                        <option value="website" <?php if($value->type=='website') echo 'selected';?> >website</option>
                                        <option value="facebook" <?php if($value->type=='facebook') echo 'selected';?> >Facebook</option>
                                        <option value="instagram " <?php if($value->type=='instagram ') echo 'selected';?> >Instagram </option>
                                        <option value="tiktok" <?php if($value->type=='tiktok') echo 'selected';?> >Tiktok</option>
                                        <option value="youtube" <?php if($value->type=='youtube') echo 'selected';?> >Youtube</option>
                                        <option value="zalo" <?php if($value->type=='zalo') echo 'selected';?> >Zalo</option>
                                        <option value="linkedin" <?php if($value->type=='linkedin') echo 'selected';?> >linkedin</option>
                                        <option value="twitter" <?php if($value->type=='twitter') echo 'selected';?> >Twitter</option>
                                      </select>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="link[<?php echo $i ?>]"  value="<?php echo @$value->link;?>"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="namelink[<?php echo $i ?>]"  value="<?php echo @$value->namelink;?>"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="descriptionlink[<?php echo $i ?>]"  value="<?php echo @$value->description;?>"/>
                                    </td>
                                    <td align="center" class="actions"><?php echo $delete ?></td>
                                  </tr>
                                <?php }}else{
                                  $i++;
                                  ?>
                                  <tr class="gradeX" id="trlink-<?php echo $i ?>">
                                    <td>
                                      <select name="type[<?php echo $i ?>]" class="form-select color-dropdown">
                                        <option value="">Chọn kiểu link</option>
                                        <option value="website" >website</option>
                                        <option value="facebook" >Facebook</option>
                                        <option value="instagram " >Instagram </option>
                                        <option value="tiktok" >Tiktok</option>
                                        <option value="youtube">Youtube</option>
                                        <option value="zalo">Zalo</option>
                                        <option value="linkedin" >linkedin</option>
                                        <option value="twitter" >Twitter</option>
                                      </select>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="link[<?php echo $i ?>]"  value=""/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="namelink[<?php echo $i ?>]"  value=""/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="descriptionlink[<?php echo $i ?>]"  value=""/>
                                    </td>
                                    <td align="center" class="actions"></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table> 

                            <div class="form-group mb-3 col-md-12">
                              <button type="button" class="btn btn-danger" onclick="return addRowlink();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm link</button>
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
                                        $status = ' <p>Đang sử dụng theme này <a data-bs-toggle="modal" data-bs-target="#editThemeinfo'.$item['id'].'" class="btn btn-primary" style=" color: #fff; ">chỉnh sửa màu</a></p>     ';
                                      }else{
                                        $status = ' <a href="/useThemeInfo?id='.$item['id'].'" class="btn btn-success">Sử dụng theme này </a> <a data-bs-toggle="modal" data-bs-target="#editThemeinfo'.$item['id'].'" class="btn btn-primary" style=" color: #fff; ">chỉnh sửa màu</a>';
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


      $themeinfo = $modelSetingThemeInfo->find()->where(['id_theme'=>(int)$item['id'],'id_member'=>$user->id])->first();
      
      $data_value = array();
    if(!empty($themeinfo->config)){
        $data_value = json_decode($themeinfo->config, true);

    }
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
       <div class="modal fade" id="editThemeinfo<?php echo $item['id'] ?>"  name="id">

      <div class="modal-dialog" role="document" style=" max-width: 45rem;">
        <div class="modal-content" style="padding: 20px;">
          <div class="modal-header form-label border-bottom">
            <h5 class="modal-title" id="exampleModalLabel1">Sửa màu sắc time info </h5>
            <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form enctype="multipart/form-data" method="post" action="editThemeinfo">
            <div class="row">
            <div class="col-md-6">
                  <img src="<?php echo $item['image']?>" style="width: 100%; height:550px;"/>
                <div style=" text-align: center; font-size: 20px; padding: 10px 0; ">
                  <p>Giá : <?php echo number_format($item['price']) ?>đ</p>
                </div>
            </div>
             <div class="col-md-6">
              <div class="row">
                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
                <input type="hidden"  name="id_theme" id="id_theme" value="<?php echo $item['id'] ?>"/>
                <div class="col-md-12 mb-3">
                      <label class="form-label" for="basic-default-phone">ảnh nền</label>
                      <input type="file" class="form-control phone-mask" name="image_background" id="image_background" value=""/>
                        <?php if(!empty($data_value['image_background'])){
                              echo '<img src="'.@$data_value['image_background'].'"  width="80" />';
                        }?>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="basic-default-phone">màu nền gradien</label></br>
                      Màu trên <input type="color" class="" name="background_color1" id="background_color1" value="<?php echo @$data_value['background_color1'] ?>" style="border: 1px solid #f9fafa;padding: 0px;"/></br>
                      Màu dưới<input type="color" class="" name="background_color2" id="background_color2" value="<?php echo @$data_value['background_color2'] ?>" style="border: 1px solid #f9fafa;padding: 0px;"/>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="basic-default-phone">màu Họ và Tên</label></br>
                      <input type="color" class="" name="text_color_name" id="text_color_name" value="<?php echo @$data_value['text_color_name'] ?>" style="border: 1px solid #f9fafa;padding: 0px;"/>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="basic-default-phone">màu Tên Chức danh</label></br>
                      <input type="color" class="" name="text_color_Jobtitle" id="text_color_Jobtitle" value="<?php echo @$data_value['text_color_Jobtitle'] ?>" style="border: 1px solid #f9fafa;padding: 0px;"/>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="basic-default-phone">màu  địa chỉ</label></br>
                      <input type="color" class="" name="text_color_address" id="text_color_address" value="<?php echo @$data_value['text_color_address'] ?>" style="border: 1px solid #f9fafa;padding: 0px;"/>
                    </div>
                   

                  </div>
              </div>
            </div>
              <button type="submit" class="btn btn-primary">Lưu</button> 
          </form>
             </div>
           </div>
         </div>
   <?php  }
 }
 ?>

 <script type="text/javascript">
  function copyToClipboard(text) {
      // Create a temporary input to hold the text to copy
      var $temp = $("<input>");
      $("body").append($temp);
      
      // Select and copy the text
      $temp.val(text).select();
      document.execCommand("copy");
      
      // Remove the temporary input
      $temp.remove();
      
      // Show success message
      alert('Đã copy thành công link liên kết ');
      //$('#copySuccessMessage').show().fadeOut(2000);
  }

  function downloadImageFromSrc(url, phone){
      var fileName = 'QR_ICHAM_'+phone+'.jpg';
      var xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);
      xhr.responseType = "blob";
      xhr.onload = function(){
          var urlCreator = window.URL || window.webkitURL;
          var imageUrl = urlCreator.createObjectURL(this.response);
          var tag = document.createElement('a');
          tag.href = imageUrl;
          tag.download = fileName;
          document.body.appendChild(tag);
          tag.click();
          document.body.removeChild(tag);
      }
      xhr.send();
  }
   var row= <?php echo $i ;?>;
   function addRowlink()
    {
      console.log(row);
        row++;
        $('#tbodylink tr:last').after('<tr class="gradeX" id="trlink-'+row+'"><td><select name="type['+row+']" class="form-select color-dropdown"><option value="">Chọn kiểu link</option><option value="website" >website</option><option value="facebook" >Facebook</option><option value="instagram " >Instagram </option><option value="tiktok" >Tiktok</option><option value="youtube">Youtube</option><option value="zalo">Zalo</option><option value="linkedin" >linkedin</option><option value="twitter" >Twitter</option></select></td><td><input type="text" class="form-control phone-mask" name="link['+row+']"  value=""/></td><td><input type="text" class="form-control phone-mask" name="namelink['+row+']"  value=""/></td><td><input type="text" class="form-control phone-mask" name="descriptionlink['+row+']"  value=""/></td><td align="center" class="actions"><a onclick="deleteTr('+row+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td></tr>');

         console.log(row);

        
    }

    function deleteTr(i)
    {
        row--;
        $('#trlink-'+i).remove();
       
    }

 </script>

<?php include(__DIR__.'/../footer.php'); ?>