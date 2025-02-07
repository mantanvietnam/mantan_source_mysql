<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/listCombo">Combo liệu trình</a> /</span>
        Thông tin gói combo
    </h4>

    <!-- Basic Layout -->
    
    <?= $this->Form->create(); ?>
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin gói combo liệu trình</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            
            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Tên combo (*)</label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data->name;?>" type="text" required="" name="name" id="name" class="form-control"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Giá bán</label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data->price;?>" type="text" name="price" id="price" class="form-control input_money"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Số lượng Combo phát hành</label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data->quantity;?>" type="text" name="quantity" id="quantity" class="form-control input_money"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Trạng thái</label>
                    <div class="col-sm-12">
                        <input name="status" type="radio" value="active" <?php if(empty($data->status) || $data->status=='active') echo 'checked';?> > Kích hoạt &nbsp;&nbsp;
                        <input name="status" type="radio" value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'checked';?> > Khóa 
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Ảnh minh họa</label>
                    <div class="col-sm-12">
                        <?php                    
                        showUploadFile('image','image',@$data->image,0);
                        ?>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Thời gian sử dụng (ngày)</label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data->use_time;?>" type="text" required="" name="use_time" id="use_time" class="form-control input_money"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-12">
                    <label class="form-label">Mô tả gói combo </label>
                    <textarea class="form-control phone-mask" rows="3" name="description"><?php echo @$data->description;?></textarea>
                </div>
                                    
                <div class="form-group mb-3 col-md-12">
                    <button type="button" class="btn btn-danger" onclick="return addRow();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm sản phẩm</button>
                </div>

                <div class="form-group mb-3 col-md-12">
                    <div class="table-responsive" style="margin-top: 15px;">
                        <table class="table table-bordered table-striped table-hover mb-none text-center">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php 
                                $dadaproduct = str_replace('   ', '', utf8_encode($data->product));
                                $dadaproduct = str_replace(array("\r", "\n"), '', $dadaproduct);
                                $dadaProduct = json_decode($dadaproduct, true);
                                
                                if(empty($dadaProduct)){
                                    $dadaProduct[0]= '';
                                }
                                $i= 0;

                                foreach ($dadaProduct as $idproduct =>$quantity) {
                                    $i++;
                                    $delete= '';
                                    if($i > 1){
                                        $delete= '<a onclick="deleteTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }else{
                                        $delete= '<a id="a_product" style="display: none;" onclick="deleteTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }
                                    echo '  <tr class="gradeX" id="tr-'.$i.'">
                                                <td>
                                                    <select onchange="checkUnit('.$i.');" name="idHangHoa['.$i.']" id="idHangHoa-'.$i.'"  class="form-select color-dropdown">
                                                        <option value="">Chọn sản phẩm</option>';
                                                        foreach ($categoryProduct as $category) { 
                                                            echo '<optgroup label="'.$category->name.'">';
                                                            if(!empty($category->product)){
                                                                foreach($category->product as $product){
                                                                    if($idproduct==$product->id){
                                                                        $select= 'selected';
                                                                        //$unit= $product['unit'];
                                                                    }else{
                                                                        $select= '';
                                                                    }
                                                                    echo '<option data-unit="'.@$product->id.'" '.$select.' value="'.$product->id.'">'.$product->name.'</option>';
                                                               }
                                                            }
                                                            echo '</optgroup>';
                                                        }
                                                    echo '</select>
                                                </td>
                                                <td><input value="'.$quantity.'" type="text" name="soluong['.$i.']" id="soluong-'.$i.'" class="form-control input_money"  placeholder="Số lượng"/></td>
                                               
                                                    <td align="center" class="actions">'.$delete.'</td>
                                                </tr>';
                                }
                            ?>             
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-12">
                    <button type="button" class="btn btn-danger" onclick="return addRowService();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm dịch vụ</button>
                </div>

                <div class="form-group mb-3 col-md-12">
                    <div class="table-responsive" style="margin-top: 15px;">
                        <table class="table table-bordered table-striped table-hover mb-none text-center">
                           <thead>
                                <tr>
                                    <th>Dịch vụ</th>
                                    <th>Số lần sử dụng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyService">
                            <?php 
                                $dadaservice= str_replace('   ', '', utf8_encode($data->service));
                                    $dadaservice= str_replace(array("\r", "\n"), '', $dadaservice);
                                    $dadaService = json_decode($dadaservice, true);
                                if(empty($dadaService)){
                                    
                                    $dadaService[0]= '';
                                }
                                $i= 0;

                                
                                foreach ($dadaService as $idService =>$quantityService) {
                                    $i++;
                                    $delete= '';
                                    if($i > 1){
                                        $delete= '<a onclick="deleteService('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }else{
                                        $delete= '<a id="a_service" style="display: none;" onclick="deleteService('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>';
                                    }
                                    echo '  <tr class="gradeX" id="trService-'.$i.'">
                                                <td>
                                                    <select onchange="checkUnit('.$i.');" name="idService['.$i.']" id="idService-'.$i.'"  class="form-select color-dropdown">
                                                        <option value="">Chọn dịch vụ</option>';
                                                        foreach ($CategoryService as $cService) { 
                                                            echo '<optgroup label="'.$cService->name.'">';
                                                            if(!empty($cService->service)){
                                                                foreach($cService->service as $service){
                                                                    if($idService==$service->id){
                                                                        $select= 'selected';
                                                                        //$unit= $product['unit'];
                                                                    }else{
                                                                        $select= '';
                                                                    }
                                                                    echo '<option data-unit="'.@$service->id.'" '.$select.' value="'.$service->id.'">'.$service->name.'</option>';
                                                               }
                                                            }
                                                            echo '</optgroup>';
                                                        }
                                                    echo '</select>
                                                </td>
                                                <td><input value="'.$quantityService.'" type="text" name="quantityService['.$i.']" id="quantityService-'.$i.'" class="form-control input_money"  placeholder="Số lượng"/></td>
                                               
                                                    <td align="center" class="actions">'.$delete.'</td>
                                                </tr>';
                                }
                            ?>             
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
            
          </div>

            <hr/>
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Hoa hồng cho nhân viên bán gói combo</h5>
            </div>

            <div class="card-body">
              <div class="row">
                <p class="text-danger">Hệ thống sẽ ưu tiên tính tiền cố định trước rồi mới đến tính theo hoa hồng</p>
                <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Trả số tiền cố định</label>
                      <input type="number" min="0" class="form-control phone-mask" name="commission_staff_fix" id="commission_staff_fix" value="<?php echo @$data->commission_staff_fix;?>"/>
                      
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Trả theo %</label>
                      <input type="number" min="0" max="100" class="form-control phone-mask" name="commission_staff_percent" id="commission_staff_percent" value="<?php echo @$data->commission_staff_percent;?>"/>
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button> 
            </div>
        </div>
      </div>

    </div>
    <?= $this->Form->end() ?>

</div>
    
<script type="text/javascript">
    var row= <?php echo count(@$dadaProduct);?>;
    var string= $('#idHangHoa-1').html();
    function addRow()
    {
        row++;
        $('#tbody tr:last').after('<tr class="gradeX" id="tr-'+row+'"><td><select onchange="checkUnit('+row+');" name="idHangHoa['+row+']" id="idHangHoa-'+row+'" class="form-select color-dropdown">'+string+'</select></td><td><input value="" type="text" id="soluong-'+row+'" name="soluong['+row+']" class="form-control input_money"  placeholder="Số lượng"/></td><td align="center" class="actions"><a onclick="deleteTr('+row+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td></tr>');

        $('#idHangHoa-'+row+' option:selected').removeAttr('selected');
        $('#soluong-'+row).val('');
         if(row>1){
            document.getElementById("a_product").style.display = 'block';

        }

    }


    function deleteTr(i)
    {
        row--;
        $('#tr-'+i).remove();
        if(row==1){
            document.getElementById("a_product").style.display = 'none';

        }
    }
</script>

<script type="text/javascript">
    var rows= <?php echo count(@$dadaService);?>;
    var strings= $('#idService-1').html();
    function addRowService()
    {
        rows++;
        $('#tbodyService tr:last').after('<tr class="gradeX" id="trService-'+rows+'"><td><select onchange="checkUnit('+rows+');" name="idService['+rows+']" id="idService-'+rows+'" class="form-select color-dropdown">'+strings+'</select></td><td><input value="" type="text" id="quantityService-'+rows+'" name="quantityService['+rows+']" class="form-control input_money"  placeholder="Số lượng"/></td><td align="center" class="actions"><a onclick="deleteService('+rows+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td></tr>');

        $('#idService-'+rows+' option:selected').removeAttr('selected');
        $('#soluong-'+rows).val('');

        if(rows>1){
            document.getElementById("a_service").style.display = 'block';

        }
    }

    function deleteService(i)
    {
        rows--;
        $('#trService-'+i).remove();
         if(rows==1){
            document.getElementById("a_service").style.display = 'none';

        }
    }
</script>
<?php include(__DIR__.'/../footer.php'); ?> 