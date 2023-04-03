<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php"> Điểm đến hiện vật</a> /</span>
    <?php 
     if(!empty($_GET['id'])){
        echo "Sửa thông tin";

    }else{
       echo "Thêm mới";
    }

     ?>
  </h4>

  <script src="http://ms29.manmoweb.com/app/Plugin/manmoHome/admin/jquery.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!-- Dropzone css -->
<link href="http://ms29.manmoweb.com/app/Plugin/manmoHome/admin/dropzone.css" rel="stylesheet" type="text/css" />


  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Hiện vật</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;
        ?></p>
            <?= $this->Form->create(); ?>
             <div class="row">
       
        <div class="col-md-12">
            <div id="tabs">
               <!--  <ul>
                    <li><a href="#tabs-1">Thông tin chung</a></li>
                    <li><a href="#tabs-2">Hình ảnh</a></li>
                    <li><a href="#tabs-3">Giới thiệu</a></li>
                </ul> -->

                <div id="tabs-1" class="row">
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Tên</label>
                        <input type="text" name="name"  required="" class="form-control" value="<?php echo @$data['name'] ?>">
                    </div>
                     <div class="mb-3 form-group col-sm-6">
                        <i>Trạng thái:</i>&ensp;
                        <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                        <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Kí hiệu:</label>
                        <input type="text" name="sign"  class="form-control" value="<?php echo @$data['sign'] ?>">
                    </div>
                     <div class="mb-3 form-group col-md-6">
                        <label for="">Chất liệu:</label>
                        <input type="text" name="material"  class="form-control" value="<?php echo @$data['material'] ?>">
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Ở trong di tích:</label>
                        <select class="form-select" id="idHistoricalsite" name="idHistoricalsite" onchange="getDistrict();">
                            <option value="">Chọn di tích</option>
                            <?php
                            foreach ($listHistoricalsite as $item) {
                                if( @$data['idHistoricalsite']!=$item['id']){
                                    echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                }else{
                                    echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                }
                                
                            }
                            ?>
                        </select> 
                    </div>
                   
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Nơi phát hiện:</label>
                        <input type="text" name="excavation" class="form-control" value="<?php echo @$data['excavation']; ?>">
                    </div>

                    <div class="mb-3 form-group col-md-6">
                        <label for="">Chứng nhận:</label>
                        <input type="text" name="certification" class="form-control" value="<?php echo @$data['certification']; ?>">
                    </div>
                    
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Niên đại:</label>
                        <input type="text" name="period" class="form-control" value="<?php echo @$data['period']; ?>">
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Thế kỷ:</label>
                        <input type="text" name="century" class="form-control" value="<?php echo @$data['century']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Vị trí:</label>
                        <input type="text" name="location" class="form-control" value="<?php echo @$data['location']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Màu sắc:</label>
                        <input type="text" name="color" class="form-control" value="<?php echo @$data['color']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Ngày đăng ký:</label>
                        <input type="date" name="registrationdate" class="form-control" value="<?php echo @$data['registrationdate']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Hình dạng:</label>
                        <input type="text" name="shape" class="form-control" value="<?php echo @$data['shape']; ?>">
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Hiện trạng:</label>
                        <input type="text" name="current" class="form-control" value="<?php echo @$data['current']; ?>">
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Kỹ thuật chế tác:</label>
                        <input type="text" name="technique" class="form-control" value="<?php echo @$data['technique']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Phân loại giá trị của đồ vật:</label>
                        <input type="text" name="classify" class="form-control" value="<?php echo @$data['classify']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Người lập phiếu:</label>
                        <input type="text" name="voter" class="form-control" value="<?php echo @$data['voter']; ?>">                       
                    </div>
                     <div class="mb-3 form-group col-md-6">
                        <label for="">Nguồn gốc:</label>
                        <input type="text" name="source" class="form-control" value="<?php echo @$data['source']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Sưu tập:</label>
                        <input type="text" name="file" class="form-control" value="<?php echo @$data['file']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-6">
                        <label for="">Ảnh đại diện:</label>
                        <?php 
                        showUploadFile('image','image',@$data['image'],1000000);
                        ?>
                    </div>
                    <div class="mb-3 form-group col-md-2">
                        <label for="">Tờ số:</label>
                        <input type="number" name=" number" class="form-control" value="<?php echo @$data['number']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-2">
                        <label for="">Số lượng:</label>
                        <input type="number" name="quantity" class="form-control" value="<?php echo @$data['quantity']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-md-2">
                        <label for="">Trọng lượng:</label>
                        <input type="number" name="weight" class="form-control" value="<?php echo @$data['weight']; ?>">                       
                    </div>
                    <div class="mb-3 form-group col-sm-6">
                        <i>Kích thước:</i>
                       <textarea name="size" id="size" onkeyup="" class="form-control" rows="5"><?php echo @$data['size'] ?></textarea>
                    </div>
                    <div class="mb-3 form-group col-sm-6">
                        <i>Mô tả ngắn:</i>
                       <textarea name="introductory" id="introductory" onkeyup="" class="form-control" rows="5"><?php echo @$data['introductory'] ?></textarea>
                    </div>
                   <!--  <div class="mb-3 form-group col-sm-12">
                        <i>Nội dung bài viết:</i>
                        <?php showEditorInput('content','content',@$data['content']);?>
                    </div> -->
                    
                </div>
     

                
            </div>
            
           
        </div>
    </div>
  

              <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>


<script src="http://ms29.manmoweb.com/app/Plugin/manmoHome/admin/dropzone.js"></script>