<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/list<?php echo $slug ?>"><?php echo $title ?></a> /</span>
    Thông tin <span style="text-transform: lowercase;"><?php echo $title ?></span>
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <p><?php echo @$mess;?></p>
          <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
          <div class="row">
            <div class="col-12">
              <div class=" mb-4">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                      thông tinh chung 
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                       file tài liệu
                    </button>
                  </li>



                </ul>

                <div class="tab-content">
                  <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-6">
                        <div class="mb-3 col-12 col-sm-12 col-md-12">
                          <label class="form-label">Tiêu đề *</label>
                          <input type="text" class="form-control" name="title" value="<?php echo @$data->title;?>" required />
                        </div>
                        <div class="mb-3 col-12 col-sm-12 col-md-12">
                          <label class="form-label">Hình minh họa *</label>
                          <?php showUploadFile('image','image',@$data->image,0);?>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-email">Hiểu thị</label>
                          <div class="input-group input-group-merge">
                            <select class="form-select" name="public" id="public">
                              <option value="private" <?php if(!empty($data->public) && $data->public=='private') echo 'selected'; ?> >Dành riêng cho đại lý</option>
                              <option value="public" <?php if(!empty($data->public) && $data->public=='public') echo 'selected'; ?> >Chung cho hệ thống</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-12 col-md-12">
                          <label class="form-label">id drive </label>
                          <input type="text" class="form-control" name="id_drive" value="<?php echo @$data->id_drive;?>" required />
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-email">Trạng thái</label>
                          <div class="input-group input-group-merge">
                            <select class="form-select" name="status" id="status">
                              <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                              <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-message">Mô tả ngắn</label>
                          <textarea class="form-control" name="description" rows="5"><?php echo @$data->description;?></textarea>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                    <?php if(@$type !='album'){ ?>
                    <div class="row">
                      <div class="col-md-12"> 
                        <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                         <thead>
                          <tr>
                            <th>Tiêu đề *</th>
                            <th><?php echo $name ?> * </th>
                            <th>Mô tả ngắn </th>
                            <th>Xóa</th>
                          </tr>
                        </thead>
                        <tbody id="tbodylink">  
                          <?php
                          $i= 0;
                          if(!empty($data->info)){
                            foreach($data->info as $key => $value){
                              $i++;

                              $delete= '<a onclick="deleteTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';

                              ?>
                              <tr class="gradeX" id="trlink-<?php echo $i ?>">
                                <td>
                                  <input type="text" class="form-control phone-mask" name="title_info[<?php echo $i ?>]" id="title_info<?php echo $i ?>" value="<?php echo $value->title ?>"/>
                                </td>
                                <td>
                                  <?php if(@$type=='album'){ ?>
                                    <input type="file" class="form-control phone-mask" name="file<?php echo $i ?>" id="file<?php echo $i ?>" value=""/>
                                    <?php
                                    if(!empty($value->file)){
                                      echo '<input type="hidden" class="form-control phone-mask" name="file_cu['.$i.']" id="file_cu'.$i.'" value="'.$value->file.'"/>
                                      <br/><img src="'.$value->file.'" width="80" />';

                                    }
                                  }elseif(@$type=='document'){

                                    ?>
                                    <input type="file" class="form-control phone-mask" name="file<?php echo $i ?>" id="file<?php echo $i ?>" value=""/>
                                    <?php
                                    if(!empty($value->file)){
                                      echo '<input type="hidden" class="form-control phone-mask" name="file_cu['.$i.']" id="file_cu'.$i.'" value="'.$value->file.'"/>
                                      <br/><a target="_blank" href="'.$value->file.'">'.$value->file.'</a>';

                                    }


                                  }elseif(@$type=='video'){?>
                                    <input type="text" class="form-control phone-mask" name="file[<?php echo $i ?>]" id="file<?php echo $i ?>" value="<?php echo @$value->file ?>"/>
                                  <?php }


                                  ?>

                                </td>
                                <td>
                                  <input type="text" class="form-control" placeholder="" name="description_info[<?php echo $i ?>]" id="description_info<?php echo $i ?>" value="<?php echo $value->description ?>" />
                                </td>

                                <td align="center" class="actions"><?php echo $delete ?></td>
                              </tr>
                            <?php }}else{
                              $i++;
                              ?>
                              <tr class="gradeX" id="trlink-<?php echo $i ?>">
                                <td>
                                  <input type="text" class="form-control phone-mask" name="title_info[<?php echo $i ?>]"  value=""/>
                                </td>
                                <td>
                                  <?php if(@$type=='video'){?>
                                    <input type="text" class="form-control phone-mask" name="file[<?php echo $i ?>]" id="file<?php echo $i ?>" value=""/>
                                  <?php }else{?>
                                    <input type="file" class="form-control phone-mask" name="file<?php echo $i ?>" id="file<?php echo $i ?>" value=""/>
                                    <input type="hidden" class="form-control phone-mask" name="file_cu[<?php echo $i ?>]" id="file_cu<?php echo $i ?>" value=""/>
                                  <?php } ?> 
                                </td>
                                <td>
                                  <input type="text" class="form-control phone-mask" name="description_info[<?php echo $i ?>]"  value=""/>
                                </td>

                                <td align="center" class="actions"></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table> 

                        <div class="form-group mb-3 col-md-12">
                          <button type="button" class="btn btn-danger" onclick="return addRowlink();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm </button>
                        </div>
                      </div>
                    </div>
                  <?php }else{ ?>
                    <div class="row" style="margin-top: 15px;">
                          <div class="form-group col-md-12 dropzone" style="margin-bottom: 10px;">
                            <div class="fallback">
                              <?php if (@$_GET['status']=='loianh') {?>
                                <p style="color: red;">dung lượng ảnh không quá 1MB</p>
                              <?php } ?>
                              <input name="listImage[]" type="file" multiple="multiple" />
                            </div>
                          </div>
                          <?php
                          if(!empty($data->info)){
                            $n= count($data->info);
                            $i= 0;
                            foreach($data->info as $key => $value){
                              $i++;
                              if(!isset($data->images[$i])){
                                $listImage= $urlHomes.'/app/Plugin/mantanHotel/images/no-thumb.png';
                              }else{ 
                                $listImage= $data->images[$i];
                              }
                              $so = $i+1;
                              $title='<p>&nbsp;</p>';
                              echo '<div class="col-md-6" id="hinh-'.$i.'">
                              '.$title.'
                              <label class="form-label" >Hình '.$so.'</label>
                                      <input type="file" class="form-control phone-mask" name="image'.$i.'" id="image'.$i.'" value=""/>
                                      <input type="hidden" class="form-control phone-mask" name="anh['.$i.']" id="anh'.$i.'" value="'.$value->file.'"/></p>
                                      <p><img src="'.$value->file.'" width="80" /></p>
                                      <p><a href="javascript:void(0);" title="xóa" style="color: #0ea1e4;" onclick="clearImage(\''.$i.'\');"><i class="bx bxs-trash me-1" aria-hidden="true"></i></a>
                                      </div>';
                            }
                          }
                          ?>
                        </div>
                      <?php } ?>
                  </div>
              </div>
            </div>
          </div>
        </div>
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
     var row= <?php echo $i ;?>;
   function addRowlink()
    {
      console.log(row);
        row++;
        $('#tbodylink tr:last').after('<tr class="gradeX" id="trlink-'+row+'">\
          <td>\
          <input type="text" class="form-control phone-mask" name="title_info['+row+']"  value=""/>\
          </td>\
          <td>\
             <?php if(@$type=='video'){ ?>
                 <input type="text" class="form-control phone-mask" name="file['+row+']" id="file'+row+'" value=""/>\
                <?php }else{ ?>
                <input type="file" class="form-control phone-mask" name="file'+row+'" id="file'+row+'" value=""/>\
              <input type="hidden" class="form-control phone-mask" name="file_cu['+row+']" id="file_cu'+row+'" value=""/>\
            <?php } ?>
          </td>\
          <td>\
          <input type="type" class="form-control phone-mask" name="description_info['+row+']"  value=""/>\
          </td>\
          <td align="center" class="actions"><a onclick="deleteTr('+row+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td>\
          </tr>');
    }

    function deleteTr(i)
    {
        row--;
        $('#trlink-'+i).remove();
       
    }

    function clearImage(i){
      $('#hinh-'+i).remove();
    }

</script>
<?php include(__DIR__.'/../footer.php'); ?>