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
            <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab1" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin hiên vật
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab5" aria-controls="navs-top-image" aria-selected="false">
                         Hình ảnh
                        </button>
                      </li> 
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab2" aria-controls="navs-top-info" aria-selected="false">
                          3D hiện vật
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab3" aria-controls="navs-top-info" aria-selected="false">
                          Tài liệu
                        </button>
                      </li>
                       
                       <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab4" aria-controls="navs-top-info" aria-selected="false">
                          Video
                        </button>
                      </li>
                      
                    </ul>
            <div id="tabs">
               <!--  <ul>
                    <li><a href="#tabs-1">Thông tin chung</a></li>
                    <li><a href="#tabs-2">Hình ảnh</a></li>
                    <li><a href="#tabs-3">Giới thiệu</a></li>
                </ul> -->
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab1" role="tabpanel">
                        <div class="row">
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
                                <label for="">Ngày đăng ký:</label>
                                <input type="date" name="registrationdate" class="form-control" value="<?php echo (!empty($data['registrationdate']))?  date("Y-m-d", @$data['registrationdate']) : " " ?>">                       
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
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <div class="row">
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Màu sắc:</label>
                                <input type="text" name="color" class="form-control" value="<?php echo @$data['color']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">link ảnh 360:</label>
                                <input type="text" name="image360" class="form-control" value="<?php echo @$data['image360']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Độ phơi sáng:</label>
                                <input type="text" name="exposure" class="form-control" value="<?php echo @$data['exposure']; ?>">
                            </div>
                             <div class="mb-3 form-group col-md-6">
                                <label for="">Cường độ bóng:</label>
                                <input type="text" name="intensity" class="form-control" value="<?php echo @$data['intensity']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Độ mềm bóng:</label>
                                <input type="text" name="softness" class="form-control" value="<?php echo @$data['softness']; ?>">
                            </div>
                           
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Giới hạn xoay ngược chiều kim đồng hồ:</label>
                                <input type="text" name="counterclockwise" class="form-control" value="<?php echo @$data['counterclockwise']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Giới hạn xoay cùng chiều kim đồng hồ:</label>
                                <input type="text" name="clockwiselimit" class="form-control" value="<?php echo @$data['clockwiselimit']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Giới hạn xoay từ trên xuống:</label>
                                <input type="text" name="topdownlimit" class="form-control" value="<?php echo @$data['topdownlimit']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Giới hạn xoay từ dưới lên :</label>
                                <input type="text" name="bottomuplimit" class="form-control" value="<?php echo @$data['bottomuplimit']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <div class="row">
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Loại tài liệu :</label>
                                <input type="text" name="doctype" class="form-control" value="<?php echo @$data['doctype']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">tiêu đề tài liệu:</label>
                                <input type="text" name="doctitle" class="form-control" value="<?php echo @$data['doctitle']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Link :</label>
                                <input type="text" name="doclink" class="form-control" value="<?php echo @$data['doclink']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Tác giả :</label>
                                <input type="text" name="docauthor" class="form-control" value="<?php echo @$data['docauthor']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ngày xuất bản :</label>
                                <input type="date" name="docdate" class="form-control" value="<?php echo (!empty($data['docdate']))?  date("Y-m-d", @$data['docdate']) : " " ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                    <label for="">File thài liệu:</label>
                                    <?php 
                                    showUploadFile('docifile','docifile',@$data['docifile'],12);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Mô tả tài liệu :</label>
                                <textarea name="docdescribe" id="docdescribe" onkeyup="" class="form-control" rows="5"><?php echo @$data['docdescribe'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                         <div class="row">
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Link video :</label>
                                <input type="text" name="video" class="form-control" value="<?php echo @$data['video']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">thuyết minh :</label>
                                 <?php 
                                    showUploadFile('present','present',@$data['present'],12);
                                    ?>
                            </div>
                        </div>
                    </div>
                     <div class="tab-pane fade" id="tab5" role="tabpanel">
                        <div class="row">
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 1:</label>
                                 <?php 
                                    showUploadFile('image','image',@$data['image'],1001);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 2:</label>
                                 <?php 
                                    showUploadFile('image2','image2',@$data['image2'],1002);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 3:</label>
                                 <?php 
                                    showUploadFile('image3','image3',@$data['image3'],1003);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 4:</label>
                                 <?php 
                                    showUploadFile('image4','image4',@$data['image8'],1004);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 5:</label>
                                 <?php 
                                    showUploadFile('image5','image5',@$data['image5'],1005);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 6:</label>
                                 <?php 
                                    showUploadFile('image6','image6',@$data['image6'],1006);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 7:</label>
                                 <?php 
                                    showUploadFile('image7','image7',@$data['image7'],1007);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 8:</label>
                                 <?php 
                                    showUploadFile('image8','image8',@$data['image8'],1008);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 9:</label>
                                 <?php 
                                    showUploadFile('image9','image9',@$data['image9'],1009);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">ảnh 10:</label>
                                 <?php 
                                    showUploadFile('image10','image10',@$data['image10'],10010);
                                    ?>
                            </div>
                        </div> 
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