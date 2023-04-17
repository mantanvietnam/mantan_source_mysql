<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/tayho360-admin-tour-listTourAdmin.php">Tour</a> /</span>
    <span class="text-muted fw-light"><a href="tayho360-admin-tour-listReportAdmin.php/?idtour=<?php echo($_GET['idtour']) ?>">Lịch trình</a> /</span>
    <?php 
     if(!empty($_GET['id'])){
        echo "Sửa thông tin";

    }else{
       echo "Thêm mới";
    }

     ?>
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông Lịch trình</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;
        ?></p>
            <?= $this->Form->create(); ?>
            <div class="row">
       
            <div class="col-md-12">
               
                <div id="tabs">

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab1" role="tabpanel">
                        <div class="row" >
                            <div class="mb-3 form-group col-sm-6">
                                <i>Tiêu đề<span class="required">*</span>:</i>
                                <input type="text" maxlength="100" name="name" id="name" value="<?php echo @$data['name'] ?>" class="form-control" required="">
                                <input type="hidden"  name="idtour" id="idtour" value="<?php echo @$_GET['idtour'] ?>" >
                            </div>
                            <div class="mb-3 form-group col-sm-6">
                                <i>Trạng thái:</i>&ensp;
                                <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                                <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                            </div>
                             <div class="mb-3 form-group col-sm-3">
                                <i>Thời gian:</i>
                                <input type="text" maxlength="100" name="time" id="time" value="<?php echo @$data['time'] ?>" class="form-control">
                            </div>
                          
                            <div class="mb-3 form-group col-sm-3">
                                <i>ngày :</i>
                                <select class="form-select" id="date" name="date" onchange="getDistrict();">
                                    <option value="">Chọn ngày</option>
                                    <?php
                                    foreach (datetour() as $category) {
                                        if( @$data['date']!=$category['id']){
                                            echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                        }else{
                                            echo '<option selected value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                        }
                                        
                                    }
                                    ?>
                                </select> 
                            </div>
                             <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh đại diện:</label>
                                    <?php showUploadFile('image','image',@$data['image'],1001); ?>
                            </div>
                            
                            <div class="mb-3 form-group col-sm-6">
                                <i>Gới thiệu:</i>
                               <textarea name="introductory" id="introductory" onkeyup="" class="form-control" rows="5"><?php echo @$data['introductory'] ?></textarea>
                            </div>
                           
                         
                            
                        </div>
                    </div> 
                    <div class="tab-pane fade" id="tab5" role="tabpanel">
                        <div class="row">
                            
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image2','image2',@$data['image2'],1002); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image3','image3',@$data['image3'],1003); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image4','image4',@$data['image4'],1004); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image5','image5',@$data['image5'],1005); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image6','image6',@$data['image6'],1006); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image7','image7',@$data['image7'],1007); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image8','image8',@$data['image8'],1008); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image9','image9',@$data['image9'],1009); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image10','image10',@$data['image10'],10010); ?>
                            </div>      
                        </div> 
                    </div>  
                </div>

            </div>
            </div>
        
  

              <button style=" margin: 10px; width: 80px;" type="submit" class="btn btn-primary">Lưu</button>
          </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>