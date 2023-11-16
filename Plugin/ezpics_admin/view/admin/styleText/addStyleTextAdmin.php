<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-styleText-listStyleTextAdmin.php">Mẫu chữ</a> /</span>
    Thông tin mẫu chữ
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  mẫu chữ</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <b>Xem trước:</b> <span id="showViewText">Ezpics - Dùng là thích</span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên mẫu chữ (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                </div>

                <div class="col-md-6">  
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

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Màu chữ</label>
                    <div class="input-group input-group-merge">
                      <input type="text" name="color" id="color" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['color'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Cỡ chữ</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="100" name="size" id="size" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['size'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Font chữ</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="font" id="font" onchange="showViewText();">
                        <?php 
                        if(!empty($listFont)){
                          foreach ($listFont as $f) {
                            if(empty($data->content['font']) || $data->content['font']!=$f->name)
                            {
                              echo '<option value="'.$f->name.'">'.$f->name.'</option>';
                            }else{
                              echo '<option selected value="'.$f->name.'">'.$f->name.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Căn lề</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="text_align" id="text_align" onchange="showViewText();">
                        <option value="left" <?php if(!empty($data->content['text_align']) && $data->content['text_align']=='left') echo 'selected'; ?> >Trái</option>
                        <option value="center" <?php if(!empty($data->content['text_align']) && $data->content['text_align']=='center') echo 'selected'; ?> >Giữa</option>
                        <option value="right" <?php if(!empty($data->content['text_align']) && $data->content['text_align']=='right') echo 'selected'; ?> >Phải</option>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Độ sáng</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="100" name="brightness" id="brightness" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['brightness'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Độ tương phản</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="100" name="contrast" id="contrast" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['contrast'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Độ bão hòa</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="100" name="saturate" id="saturate" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['saturate'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Độ trong</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="1" name="opacity" id="opacity" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['opacity'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Gạch chân</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="gachchan" id="gachchan" onchange="showViewText();">
                        <option value="none" <?php if(!empty($data->content['gachchan']) && $data->content['gachchan']=='none') echo 'selected'; ?> >Không gạch</option>
                        <option value="underline" <?php if(!empty($data->content['gachchan']) && $data->content['gachchan']=='underline') echo 'selected'; ?> >Gạch dưới chữ</option>
                        <option value="line-through" <?php if(!empty($data->content['gachchan']) && $data->content['gachchan']=='line-through') echo 'selected'; ?> >Gạch ngang chữ</option>
                        <option value="overline " <?php if(!empty($data->content['gachchan']) && $data->content['gachchan']=='overline') echo 'selected'; ?> >Gạch trên chữ</option>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Kiểu chữ</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="uppercase" id="uppercase" onchange="showViewText();">
                        <option value="none" <?php if(!empty($data->content['uppercase']) && $data->content['uppercase']=='none') echo 'selected'; ?> >Giữ nguyên như nhập</option>
                        <option value="uppercase" <?php if(!empty($data->content['uppercase']) && $data->content['uppercase']=='uppercase') echo 'selected'; ?> >Viết hoa hết</option>
                        <option value="lowercase" <?php if(!empty($data->content['uppercase']) && $data->content['uppercase']=='lowercase') echo 'selected'; ?> >Viết thường hết</option>
                        <option value="capitalize " <?php if(!empty($data->content['uppercase']) && $data->content['uppercase']=='capitalize') echo 'selected'; ?> >Viết hoa chữ cái đầu</option>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">In nghiêng</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="innghieng" id="innghieng" onchange="showViewText();">
                        <option value="normal" <?php if(!empty($data->content['innghieng']) && $data->content['innghieng']=='normal') echo 'selected'; ?> >Không in nghiêng</option>
                        <option value="italic" <?php if(!empty($data->content['innghieng']) && $data->content['innghieng']=='italic') echo 'selected'; ?> >Có in nghiêng</option>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">In đậm</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="indam" id="indam" onchange="showViewText();">
                        <option value="normal" <?php if(!empty($data->content['indam']) && $data->content['indam']=='normal') echo 'selected'; ?> >Không in đậm</option>
                        <option value="bolder" <?php if(!empty($data->content['indam']) && $data->content['indam']=='bolder') echo 'selected'; ?> >Có in đậm</option>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Độ nghiêng của chữ</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="180" name="rotate" id="rotate" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['rotate'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Giãn chữ</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="100" name="gianchu" id="gianchu" onchange="showViewText();"  class="form-control" value="<?php echo @$data->content['gianchu'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Giãn dòng</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="100" name="giandong" id="giandong" onchange="showViewText();"  class="form-control" value="<?php echo @$data->content['giandong'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Chiều dài chữ</label>
                    <div class="input-group input-group-merge">
                      <input type="number" min="0" max="100" name="width" id="width" onchange="showViewText();" class="form-control" value="<?php echo @$data->content['width'];?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Áp dụng gradient</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="gradient" id="gradient" onchange="showViewText();">
                        <option value="0" <?php if(!empty($data->content['gradient']) && $data->content['gradient']=='0') echo 'selected'; ?> >Không áp dụng</option>
                        <option value="1" <?php if(!empty($data->content['gradient']) && $data->content['gradient']=='1') echo 'selected'; ?> >Có áp dụng</option>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Hướng đổ màu gradient</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="linear_position" id="linear_position" onchange="showViewText();">
                        <option value="to right" <?php if(!empty($data->content['linear_position']) && $data->content['linear_position']=='to right') echo 'selected'; ?> >Trái sang phải</option>
                        <option value="to left" <?php if(!empty($data->content['linear_position']) && $data->content['linear_position']=='to left') echo 'selected'; ?> >Phải sang trái</option>
                      </select>
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Mã màu đầu</label>
                    <div class="input-group input-group-merge">
                      <input type="text" name="color_first" id="color_first" onchange="showViewText();" class="form-control" value="<?php echo @$data->color_first;?>">
                    </div>
                  </div>   
                </div>

                <div class="col-md-2">  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Mã màu cuối</label>
                    <div class="input-group input-group-merge">
                      <input type="text" name="color_after" id="color_after" onchange="showViewText();" class="form-control" value="<?php echo @$data->color_after;?>">
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
  function showViewText()
  {
    var color = $('#color').val();
    var size = $('#size').val();
    var font = $('#font').val();
    var text_align = $('#text_align').val();
    var brightness = $('#brightness').val();
    var contrast = $('#contrast').val();
    var gachchan = $('#gachchan').val();
    var uppercase = $('#uppercase').val();
    var indam = $('#indam').val();
    var gianchu = $('#gianchu').val();
    var giandong = $('#giandong').val();
    var width = $('#width').val();

    console.log(color);
    console.log(uppercase);

    var myElement = document.getElementById('showViewText');

    myElement.style.color = color;
    myElement.style.fontSize = size+'px';
    myElement.style.fontFamily = font;
    myElement.style.textAlign = text_align;
    myElement.style.textDecoration = gachchan;
    myElement.style.fontStyle = uppercase;
    myElement.style.fontWeight = indam;
    myElement.style.letterSpacing = gianchu+'px';
    myElement.style.width = width+'px';
    myElement.style.lineHeight = giandong;
    myElement.style.filter = 'brightness('+brightness+')';

    //$('#showViewText').css('color',color, 'font-size',size); 
  }
</script> letter-spacing