<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProductAgency">Sản phẩm</a> /</span>
    Thông tin sản phẩm
  </h4>

  <!-- Basic Layout nav-align-top-->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-body">
            <p><?php echo $mess; ?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-12">
                  <div class=" mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Mô tả sản phẩm
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Thông tin sản phẩm
                        </button>
                      </li>
                      
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                          Hình ảnh
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-image" aria-selected="false">
                          Đơn vị quy đổi
                        </button>
                      </li>
                      
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tên sản phẩm (*)</label>
                              <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mã sản phẩm (*)</label>
                              <input type="text" class="form-control phone-mask" name="code" id="code" value="<?php echo @$data->code;?>" required />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Đơn vị tính (*)</label>
                              <input type="text" class="form-control phone-mask" name="unit" id="unit" value="<?php echo @$data->unit;?>" required />
                            </div>
                            
                            <div class="mb-3">
                              <label class="form-label">Danh mục (*)</label>
                              <div class="input-group input-group-merge">
                                <?php 
                                  if(!empty($listCategory)){
                                     echo '<ul class = "list-inline">';
                                        foreach ($listCategory as $Category) {
                                          $check = '';
                                          if(!empty($listCategoryCheck)){
                                            $check = (in_array($Category->id, $listCategoryCheck))? 'checked':'';
                                          }

                                          echo '<li><input type="checkbox" '.$check.' name="id_category[]" value="'.$Category->id.'"> '.$Category->name.'</li>';
                                        }
                                        echo '</ul>';
                                      }?>
                                
                              </div>
                            </div>

                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Giá bán (*)</label>
                              <input type="text" required class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Giá bán cũ</label>
                              <input type="text" class="form-control phone-mask" name="price_old" id="price_old" value="<?php echo @$data->price_old;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Giá bán cho đại lý </label>
                              <input type="text"  class="form-control phone-mask" name="price_agency" id="price_agency" value="<?php echo @$data->price_agency;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Hình minh họa (*)</label>
                              <input type="file" class="form-control phone-mask" name="image" id="image" value=""/>
                              <?php
                              if(!empty($data->image)){
                                echo '<br/><img src="'.$data->image.'" width="80" />';
                              }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Thông tin mô tả về sản phẩm</label>
                              <?php showEditorInput('info', 'info', @$data->info);?>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                       
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
                          if(!empty($data->images)){
                            $n= count($data->images);
                            for($i=0;$i<$n;$i++){
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
                                      <input type="hidden" class="form-control phone-mask" name="anh['.$i.']" id="anh'.$i.'" value="'.@$data->images[$i].'"/></p>
                                      <p><img src="'.@$data->images[$i].'" width="80" /></p>
                                      <p><a href="javascript:void(0);" title="xóa" style="color: #0ea1e4;" onclick="clearImage(\''.$i.'\');"><i class="bx bxs-trash me-1" aria-hidden="true"></i></a>
                                      </div>';
                            }
                          }
                          ?>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                            <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                             <thead>
                              <tr>
                                <th>Tên đơn vị</th>
                                <th>Số lượng đơn vị gốc </th>
                                <th>Giá bán lẻ </th>
                                <th>Giá bán cho dại lý</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodylink">  
                              <?php
                              $i= 0;
                              if(!empty($listUnitConversion)){
                                foreach($listUnitConversion as $key => $value){
                                  $i++;
                                 
                                    $delete= '<a onclick="deleteTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                  
                                  ?>
                                  <tr class="gradeX" id="trlink-<?php echo $i ?>">
                                    <td>
                                        <input type="text" class="form-control phone-mask" name="unitConversion[<?php echo $i ?>]" id="unitConversion<?php echo $i ?>" value="<?php echo $value->unit ?>"/>
                                        <input type="hidden" class="form-control phone-mask" name="id_unit[<?php echo $i ?>]" id="id_unit<?php echo $i ?>" value="<?php echo $value->id ?>"/>
                                    </td>
                                    <td>
                                      <input type="number" class="form-control" placeholder="" name="quantityConversion[<?php echo $i ?>]" id="quantityConversion<?php echo $i ?>" value="<?php echo $value->quantity ?>" />
                                    </td>
                                    <td>
                                      <input type="number" class="form-control" placeholder="" name="priceConversion[<?php echo $i ?>]" id="priceConversion<?php echo $i ?>" value="<?php echo $value->price ?>" />
                                    </td>
                                    <td>
                                      <input type="number" class="form-control" placeholder="" name="price_agencyConversion[<?php echo $i ?>]" id="price_agency<?php echo $i ?>" value="<?php echo $value->price_agency ?>" />
                                    </td>
                                    <td align="center" class="actions"><?php echo $delete ?></td>
                                  </tr>
                                <?php }}else{
                                  $i++;
                                  ?>
                                  <tr class="gradeX" id="trlink-<?php echo $i ?>">
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="unitConversion[<?php echo $i ?>]"  value=""/>
                                       <input type="hidden" class="form-control phone-mask" name="id_unit[<?php echo $i ?>]" id="id_unit<?php echo $i ?>" value=""/>
                                    </td>
                                    <td>
                                      <input type="number" class="form-control phone-mask" name="quantityConversion[<?php echo $i ?>]"  value=""/>
                                    </td>
                                    <td>
                                      <input type="number" class="form-control phone-mask" name="priceConversion[<?php echo $i ?>]"  value=""/>
                                    </td>
                                     <td>
                                      <input type="number" class="form-control phone-mask" name="price_agencyConversion[<?php echo $i ?>]"  value=""/>
                                    </td>
                                    <td align="center" class="actions"></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table> 

                            <div class="form-group mb-3 col-md-12">
                              <button type="button" class="btn btn-danger" onclick="return addRowlink();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm đơn vị</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
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
          <input type="text" class="form-control phone-mask" name="unitConversion['+row+']"  value=""/>\
          </td>\
          <input type="hidden" class="form-control phone-mask" name="id_unit['+row+']" id="id_unit'+row+'" value=""/>\
          <td>\
          <input type="number" class="form-control phone-mask" name="quantityConversion['+row+']"  value=""/>\
          </td>\
          <td>\
          <input type="number" class="form-control phone-mask" name="priceConversion['+row+']"  value=""/>\
          </td>\
           <td>\
          <input type="number" class="form-control phone-mask" name="price_agencyConversion['+row+']"  value=""/>\
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