<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCombo">Combo liệu trình</a> /</span>
    Thông tin Combo liệu trình
  </h4>

  <!-- Basic Layout -->
  <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Combo liệu trình</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Tên combo<span class="required">*</span>:</label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data['name'];?>" type="text" required="" name="name" id="name" class="form-control"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">GIÁ<span class="required">*</span>: </label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data['price'];?>" type="text" required="" name="price" id="price" class="form-control input_money"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label  control-label">GIÁ ƯU ĐÃI </label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data['price'];?>" type="text" name="price_old" id="price_old" class="form-control input_money"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Số lượng<span class="required">*</span>: </label>
                    <div class="col-sm-12">
                        <input value="<?php echo @$data['quantity'];?>" type="text" required="" name="quantity" id="quantity" class="form-control input_money"  placeholder=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Bán online<span class="required">*</span>: </label>
                    <div class="col-sm-12">
                        <input name="status" type="radio" value="1" required="" <?php if(!empty($data['status']) && $data['status']=='1') echo 'checked';?> > Có bán 
                        <input name="status" type="radio" value="0" <?php if(!empty($data['status']) && $data['status']=='0') echo 'checked';?> > Không bán 
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Ảnh minh họa<span class="required">*</span>: </label>
                    <div class="col-sm-12">
                        <?php                    
                        showUploadFile('image','image',@$data['image'],0);
                        ?>
                    </div>
                </div>
                                    
                <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Sản phẩm <span class="required">*</span>: </label>
                    <button type="button" class="btn btn-primary" onclick="return addRow();"><i class="bx bx-plus" aria-hidden="true"></i></button>
                </div>

                <div class="form-group mb-3 col-md-12">
                    <div class="table-responsive" style="margin-top: 15px;">
                        <table class="table table-bordered table-striped table-hover mb-none text-center">
                            <thead>
                                <tr>
                                    <th>Hàng hóa</th>
                                    <th>Số lượng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            <?php 
                                $dadaproduct= str_replace('   ', '', utf8_encode($data->product));
                                    $dadaproduct= str_replace(array("\r", "\n"), '', $dadaproduct);
                                    $dadaProduct = json_decode($dadaproduct, true);
                                if(empty($dadaProduct)){
                                    
                                    $dadaProduct[0]= '';
                                }
                                $i= 0;

                                
                                    foreach ($dadaProduct as $idproduct =>$quantity) {
                                        $i++;
                                        $unit= '';
                                        echo '  <tr class="gradeX" id="tr-'.$i.'">
                                                    <td>
                                                        <select onchange="checkUnit('.$i.');" name="idHangHoa['.$i.']" id="idHangHoa-'.$i.'" required=""  class="form-control">
                                                            <option value="">Chọn hàng hóa</option>';
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
                                                    <td><input value="'.$quantity.'" type="text" required="" name="soluong['.$i.']" id="soluong-'.$i.'" class="form-control input_money"  placeholder="Số lượng"/></td>
                                                   
                                                        <td align="center" class="actions"><a onclick="deleteTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td>
                                                    </tr>';
                                        }
                                    ?>             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                 <div class="form-group mb-3 col-md-6">
                    <label class="col-sm-12 form-label control-label">Dịch vụ: </label>
                    <button type="button" class="btn btn-primary" onclick="return addRowService();"><i class="bx bx-plus" aria-hidden="true"></i></button>
                </div>

                <div class="form-group mb-3 col-md-12">
                    <div class="table-responsive" style="margin-top: 15px;">
                         <table class="table table-bordered table-striped table-hover mb-none text-center">
                           <thead>
                                <tr>
                                    <th>Dịch vụ</th>
                                    <th>Số lượng</th>
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
                                        $unit= '';
                                        echo '  <tr class="gradeX" id="trService-'.$i.'">
                                                    <td>
                                                        <select onchange="checkUnit('.$i.');" name="idService['.$i.']" id="idService-'.$i.'" required=""  class="form-control">
                                                            <option value="">Chọn hàng hóa</option>';
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
                                                    <td><input value="'.$quantityService.'" type="text" required="" name="quantityService['.$i.']" id="quantityService-'.$i.'" class="form-control input_money"  placeholder="Số lượng"/></td>
                                                   
                                                        <td align="center" class="actions"><a onclick="deleteService('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td>
                                                    </tr>';
                                        }
                                    ?>             
                                </tbody>
                            </table> 
                        </div>
                </div>
                <button type="submit" style=" width: 70px; " class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>
</div>
    
<script type="text/javascript">
    var row= <?php echo count(@$dadaProduct);?>;
    var string= $('#idHangHoa-1').html();
    function addRow()
    {
        row++;
        $('#tbody tr:last').after('<tr class="gradeX" id="tr-'+row+'"><td><select onchange="checkUnit('+row+');" name="idHangHoa['+row+']" id="idHangHoa-'+row+'" class="form-control">'+string+'</select></td><td><input value="" type="text" id="soluong-'+row+'" name="soluong['+row+']" class="form-control input_money"  placeholder="Số lượng"/></td><td align="center" class="actions"><a onclick="deleteTr('+row+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td></tr>');

        $('#idHangHoa-'+row+' option:selected').removeAttr('selected');
        $('#soluong-'+row).val('');
    }

    function deleteTr(i)
    {
        $('#tr-'+i).remove();
    }

   
</script>
<script type="text/javascript">
    var rows= <?php echo count(@$dadaService);?>;
    var strings= $('#idService-1').html();
    function addRowService()
    {
        row++;
        $('#tbodyService tr:last').after('<tr class="gradeX" id="trService-'+rows+'"><td><select onchange="checkUnit('+rows+');" name="idService['+rows+']" id="idService-'+rows+'" class="form-control">'+strings+'</select></td><td><input value="" type="text" id="quantityService-'+rows+'" name="quantityService['+rows+']" class="form-control input_money"  placeholder="Số lượng"/></td><td align="center" class="actions"><a onclick="deleteService('+rows+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a></td></tr>');

        $('#idService-'+row+' option:selected').removeAttr('selected');
        $('#soluong-'+row).val('');
    }

    function deleteService(i)
    {
        $('#trService-'+i).remove();
    }

   
</script>
<?php include(__DIR__.'/../footer.php'); ?> 