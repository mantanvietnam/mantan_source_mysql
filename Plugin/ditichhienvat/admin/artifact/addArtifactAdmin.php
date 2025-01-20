<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin">Hiện vật</a> /</span>
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
            <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab1" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin hiện vật
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
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab6" aria-controls="navs-top-info" aria-selected="false">
                          Thuyết minh
                        </button>
                      </li>
                      
            </ul>
            <div id="tabs">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab1" role="tabpanel">
                        <div class="row">
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Tên hiện vật:</label>
                                <input type="text" name="name"  required="" class="form-control" value="<?php echo @$data['name'] ?>">
                            </div>
                             <div class="mb-3 form-group col-sm-6">
                                <label for="">Trạng thái:</label>&ensp;
                               <?php if(!isset($data['status'])){
                                if($data['status']==''){ ?>
                                <input type="radio" name="status" class="" id="status" value="1" checked="checked"> Hiển thị&ensp;
                                <input type="radio" name="status" class="" id="status" value="0" > Ẩn

                                <?php }}else{ ?>
                                    <input type="radio" name="status" class="" id="status" value="1" <?php if(@$data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                                    <input type="radio" name="status" class="" id="status" value="0" <?php if(@$data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                                <?php } ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for=""> Ký hiệu, mã số ảnh:</label>
                                <input type="text" name="sign"  class="form-control" value="<?php echo @$data['sign'] ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Tên di tích:</label>
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
                                <label for="">Danh mục:</label>
                                <select class="form-select" id="idcategory" name="idcategory" onchange="getDistrict();">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    foreach ($listCategoryartifact as $category) {
                                        if( @$data['idcategory']!=$category['id']){
                                            echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                        }else{
                                            echo '<option selected value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                        }
                                        
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Địa chỉ :</label>
                                <input type="text" name="address"  class="form-control" value="<?php echo @$data['address'] ?>">
                            </div>
                             <div class="mb-3 form-group col-md-6">
                                <label for="">Chất liệu:</label>
                                <input type="text" name="material"  class="form-control" value="<?php echo @$data['material'] ?>">
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
                            <!-- <div class="mb-3 form-group col-md-6">
                                <label for="">Thế kỷ:</label>
                                <input type="text" name="century" class="form-control" value="<?php echo @$data['century']; ?>">                       
                            </div> -->
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
                                <label for="">Phân loại giá trị hiện vật:</label>
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
                                <input type="number" name="number" class="form-control" value="<?php echo @$data['number']; ?>">                       
                            </div>
                            <div class="mb-3 form-group col-md-2">
                                <label for="">Số lượng:</label>
                                <input type="number" name="quantity" class="form-control" value="<?php echo @$data['quantity']; ?>">                       
                            </div>
                           <div class="mb-3 form-group col-md-2">
                                <label for="">Màu sắc:</label>
                                <input type="text" name="color" class="form-control" value="<?php echo @$data['color']; ?>">
                            </div>
                            <div class="mb-3 form-group col-sm-6">
                                <label for="">Kích thước:</label>
                               <textarea name="size" id="size" onkeyup="" class="form-control" rows="5"><?php echo @$data['size'] ?></textarea>
                            </div>
                            <div class="mb-3 form-group col-sm-6">
                                <label for="">Khảo tả đặc điểm:</label>
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
                                    <label for="">File GLB:</label>
                                    <?php 
                                    showUploadFile('filegle','filegle',@$data['filegle'],13);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                    <label for="">File USDZ:</label>
                                    <?php 
                                    showUploadFile('fileusdz','fileusdz',@$data['fileusdz'],14);
                                    ?>
                            </div>
                            
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Link ảnh 360:</label>
                                <input type="text" name="image360" class="form-control" value="<?php echo @$data['image360']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Environment Image (Ảnh môi trường):</label>
                                <input type="text" name="environmentimage" class="form-control" value="<?php echo @$data['environmentimage']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Background Color (Màu nền):</label>
                                <input type="text" name="backgroundcolor" class="form-control" value="<?php echo @$data['backgroundcolor']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Exposure (Độ phơi sáng):</label>
                                <input type="text" name="exposure" class="form-control" value="<?php echo @$data['exposure']; ?>">
                            </div>
                             <div class="mb-3 form-group col-md-6">
                                <label for="">Shadow Intensity (Cường độ bóng):</label>
                                <input type="text" name="intensity" class="form-control" value="<?php echo @$data['intensity']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Shadow Softness (Độ mềm bóng):</label>
                                <input type="text" name="softness" class="form-control" value="<?php echo @$data['softness']; ?>">
                            </div>
                           
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Counter-Clockwise Limit (Giới hạn xoay ngược chiều kim đồng hồ):</label>
                                <input type="text" name="counterclockwise" class="form-control" value="<?php echo @$data['counterclockwise']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Clockwise Limit (Giới hạn xoay cùng chiều kim đồng hồ):</label>
                                <input type="text" name="clockwiselimit" class="form-control" value="<?php echo @$data['clockwiselimit']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Top-down Limit (Giới hạn xoay từ trên xuống):</label>
                                <input type="text" name="topdownlimit" class="form-control" value="<?php echo @$data['topdownlimit']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Bottom-up Limit (Giới hạn xoay từ dưới lên) :</label>
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
                                <label for="">Tiêu đề tài liệu:</label>
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
                                    <label for="">File tài liệu:</label>
                                    <?php 
                                    showUploadFile('docifile','docifile',@$data['docifile'],100112);
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
                                <label for="">Loại video:</label>
                                <input type="text" name="videotype" class="form-control" value="<?php echo @$data['videotype']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Tiêu đề video:</label>
                                <input type="text" name="videotitle" class="form-control" value="<?php echo @$data['videotitle']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Link:</label>
                                <input type="text" name="videolink" class="form-control" value="<?php echo @$data['videolink']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Tác giả:</label>
                                <input type="text" name="videoauthor" class="form-control" value="<?php echo @$data['videoauthor']; ?>">
                            </div>
                           
                            <div class="mb-3 form-group col-md-6">
                                    <label for="">File video:</label>
                                    <?php 
                                    showUploadFile('videofile','videofile',@$data['videofile'],15);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Mô tả video  :</label>
                                <textarea name="videodescribe" id="videodescribe" onkeyup="" class="form-control" rows="5"><?php echo @$data['videodescribe'] ?></textarea>
                            </div>
                        </div>
                    </div><div class="tab-pane fade" id="tab6" role="tabpanel">
                        <div class="row">
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Loại thuyết minh :</label>
                                <input type="text" name="presenttype" class="form-control" value="<?php echo @$data['presenttype']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Tiêu đề thuyết minh:</label>
                                <input type="text" name="presenttitle" class="form-control" value="<?php echo @$data['presenttitle']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Link :</label>
                                <input type="text" name="presentlink" class="form-control" value="<?php echo @$data['presentlink']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Tác giả :</label>
                                <input type="text" name="presentauthor" class="form-control" value="<?php echo @$data['presentauthor']; ?>">
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                    <label for="">File thuyết minh:</label>
                                    <?php 
                                    showUploadFile('presentfile','presentfile',@$data['presentfile'],12);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Mô tả thuyết minh:</label>
                                <textarea name="presentdescribe" id="presentdescribe" onkeyup="" class="form-control" rows="5"><?php echo @$data['presentdescribe'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab5" role="tabpanel">
                        <div class="row">
                             <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh đại diện:</label>
                                 <?php 
                                    showUploadFile('image','image',@$data['image'],1001);
                                    ?>
                            </div>
                            
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image2','image2',@$data['image2'],1002);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image3','image3',@$data['image3'],1003);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image4','image4',@$data['image8'],1004);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image5','image5',@$data['image5'],1005);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image6','image6',@$data['image6'],1006);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image7','image7',@$data['image7'],1007);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image8','image8',@$data['image8'],1008);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image9','image9',@$data['image9'],1009);
                                    ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                 <?php 
                                    showUploadFile('image10','image10',@$data['image10'],10010);
                                    ?>
                            </div>
                        </div> 
                    </div>                
                </div>
            
           
        </div>
    </div>
  

              <div class="col-md-12">
            <button style=" margin: 10px; width: 80px;" type="submit" class="btn btn-primary">Lưu</button> 
            <a class="btn btn-danger" href="/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin">Hủy</a> 
        </div>
          </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>


<script src="http://ms29.manmoweb.com/app/Plugin/manmoHome/admin/dropzone.js"></script>