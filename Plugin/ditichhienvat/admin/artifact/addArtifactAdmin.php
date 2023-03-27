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
            <h5 class="mb-0">Thông tin hiện vật</h5>
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
                    <div class="col-md-6">
                        <label for="">Tên</label>
                        <input type="text" name="name"  required="" class="form-control" value="<?php echo @$data['name'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="">Chất liệu</label>
                        <input type="number" name="material"  class="form-control" value="<?php echo @$data['material'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="">Ở trong di tích</label>
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
                   
                    <div class="col-md-6">
                        <label for="">Nơi phát hiện</label>
                        <input type="text" name="excavation" class="form-control" value="<?php echo @$data['excavation']; ?>">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="">Niên đại</label>
                        <input type="text" name="period" class="form-control" value="<?php echo @$data['period']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="">Năm</label>
                        <input type="number" name="year" class="form-control" value="<?php echo @$data['year']; ?>">                       
                    </div>
                    <div class="col-md-6">
                        <label for="">Chứng nhận</label>
                        <input type="text" name="certification" class="form-control" value="<?php echo @$data['certification']; ?>">                       
                    </div>
                    <div class="col-md-6">
                        <label for="">Hinh dạnh</label>
                        <input type="text" name="shape" class="form-control" value="<?php echo @$data['shape']; ?>">                       
                    </div>
                    <div class="col-md-3">
                        <label for="">Trọng lượng</label>
                        <input type="number" name="weight" class="form-control" value="<?php echo @$data['weight']; ?>">                       
                    </div>
                    <div class="col-md-3">
                        <label for="">Chiều dài</label>
                        <input type="number" name="length" class="form-control" value="<?php echo @$data['length']; ?>">                       
                    </div>
                    <div class="col-md-3">
                        <label for="">Chiều rộng</label>
                        <input type="number" name="width" class="form-control" value="<?php echo @$data['width']; ?>">                       
                    </div>
                    <div class="col-md-3">
                        <label for="">Chiều cao</label>
                        <input type="number" name="height" class="form-control" value="<?php echo @$data['height']; ?>">                       
                    </div>
                    <div class="form-group col-sm-6">
                        <i>Ảnh 360:</i>
                         <input type="text" name="image360" class="form-control" id="image360" value="<?php echo @$data['image360'] ?>">
                       
                    </div>
                    <div class="col-md-6">
                        <label for="">Ảnh đạt diện</label>
                        <?php 
                        showUploadFile('image','image',@$data['image'],1000000);
                        ?>
                    </div>
                    <div class="form-group col-sm-6">
                        <i>Mô tả ngắn:</i>
                       <textarea name="introductory" id="introductory" onkeyup="" class="form-control" rows="5"><?php echo @$data['introductory'] ?></textarea>
                    </div>
                    
                </div>
             

                <!-- giới thiệu -->
                <div id="tabs-3">
                    <i>Nội dung bài viết</i>
                    <?php showEditorInput('content','content',@$data['content']);?>
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