<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Landingpage - Home Setting</h4>

    <!-- Basic Layout -->
    
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class=" mb-4">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-1" aria-controls="navs-top-home" aria-selected="true">
                        KHỐI ĐẦU TRANG
                        </button>
                    </li>
                    
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-2" aria-controls="navs-top-info" aria-selected="false">
                            KHỐI THỨ 2
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-3" aria-controls="navs-top-info" aria-selected="false">
                        KHỐI THỨ 3
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-4" aria-controls="navs-top-image" aria-selected="false">
                        KHỐI THỨ 4
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-5" aria-controls="navs-top-image" aria-selected="false">
                        KHỐI THỨ 5
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-6" aria-controls="navs-top-image" aria-selected="false">
                        KHỐI THỨ 6
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-7" aria-controls="navs-top-image" aria-selected="false">
                            KHỐI THỨ 7
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-8" aria-controls="navs-top-image" aria-selected="false">
                            KHỐI THỨ 8
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-9" aria-controls="navs-top-image" aria-selected="false">
                            KHỐI THỨ 9
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-10" aria-controls="navs-top-image" aria-selected="false">
                            KHỐI THỨ 10
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-11" aria-controls="navs-top-image" aria-selected="false">
                            FOOTER
                        </button>
                    </li>
                </ul>
            </div>
            <!-- 0 -->
            <div class="card-body tab-content ">
 
                <div class="tab-pane fade active show" id="navs-1" role="tabpanel">
                    <div class="card-body row">
                        <div class="col-6">
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Tiêu đề bên trái header: 1</label>
                                <input class="form-control" type="text" name="leftheader1" value="<?php echo @$data['leftheader1'];?>"/>
                            </div>  
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Tiêu đề bên trái header: 2</label>
                                <input class="form-control" type="text" name="leftheader2" value="<?php echo @$data['leftheader2'];?>"/>
                            </div> 
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Tiêu đề bên trái header: 3</label>
                                <input class="form-control" type="text" name="leftheader3" value="<?php echo @$data['leftheader3'];?>"/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">time down giờ</label>
                                <input class="form-control" type="text" name="hour" value="<?php echo @$data['hour'];?>"/>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">time down phút</label>
                                <input class="form-control" type="text" name="minutes" value="<?php echo @$data['minutes'];?>"/>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">time down giây</label>
                                <input class="form-control" type="text" name="seconds" value="<?php echo @$data['seconds'];?>"/>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Nút bấm đầu</label>
                                <input class="form-control" type="text" name="button1" value="<?php echo @$data['button1'];?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-2" role="tabpanel">
                    <div class="card-body row">
                        <div class="col-6">
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">background khối thứ 2</label>
                                <?php showUploadFile('backgound','backgound', @$data['backgound'],1);?>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">ảnh nội dung bên trái 1</label>
                                <?php showUploadFile('image1','image1', @$data['image1'],2);?>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">ảnh nội dung bên trái 2</label>
                                <?php showUploadFile('image2','image2', @$data['image2'],3);?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Ảnh bên phải 1</label>
                                <?php showUploadFile('image3','image3', @$data['image3'],4);?>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Ảnh bên phải 2</label>
                                <?php showUploadFile('image4','image4', @$data['image4'],5);?>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Ảnh bên phải 3</label>
                                <?php showUploadFile('image5','image5', @$data['image5'],6);?>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Ảnh bên phải 4</label>
                                <?php showUploadFile('image6','image6', @$data['image6'],7);?>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Ảnh bên phải 5</label>
                                <?php showUploadFile('image7','image7', @$data['image7'],8);?>
                            </div>
                            <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Ảnh bên phải 6</label>
                                <?php showUploadFile('image8','image8', @$data['image8'],9);?>
                            </div>
                        </div>
                          
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-3" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">background</label>
                            <?php showUploadFile('backgound2','backgound2', @$data['backgound2'],10);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề lớn</label>
                            <input class="form-control" type="text" name="title1" value="<?php echo @$data['title1'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                            <input class="form-control" type="text" name="noidung1" value="<?php echo @$data['noidung1'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                            <input class="form-control" type="text" name="noidung2" value="<?php echo @$data['noidung2'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung 3</label>
                            <input class="form-control" type="text" name="noidung3" value="<?php echo @$data['noidung3'];?>"/>
                        </div>
                    </div>
                </div>
           
                <div class="tab-pane fade show" id="navs-4" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">background</label>
                            <input class="form-control" type="text" name="backgound3" value="<?php echo @$data['backgound3'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">image trái khối thứ 4</label>
                            <?php showUploadFile('image9','image9', @$data['image9'],11);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề lớn 1</label>
                            <input class="form-control" type="text" name="title2" value="<?php echo @$data['title2'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề lớn 2</label>
                            <input class="form-control" type="text" name="title3" value="<?php echo @$data['title3'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung bước 1</label>
                            <input class="form-control" type="text" name="noidungbuoc1" value="<?php echo @$data['noidungbuoc1'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung bước 2</label>
                            <input class="form-control" type="text" name="noidungbuoc2" value="<?php echo @$data['noidungbuoc2'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung bước 3</label>
                            <input class="form-control" type="text" name="noidungbuoc3" value="<?php echo @$data['noidungbuoc3'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung bước 4</label>
                            <input class="form-control" type="text" name="noidungbuoc4" value="<?php echo @$data['noidungbuoc4'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung bước 5</label>
                            <input class="form-control" type="text" name="noidungbuoc5" value="<?php echo @$data['noidungbuoc5'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nút bấm</label>
                            <input class="form-control" type="text" name="button3" value="<?php echo @$data['button3'];?>"/>
                        </div>
                    </div>
                </div>
          
                <div class="tab-pane fade show" id="navs-5" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung trên</label>
                            <input class="form-control" type="text" name="noidung4" value="<?php echo @$data['noidung4'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung dưới </label>
                            <input class="form-control" type="text" name="noidung5" value="<?php echo @$data['noidung5'];?>"/>
                        </div>
                      
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-6" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nut Bấm</label>
                            <input class="form-control" type="text" name="button4" value="<?php echo @$data['button4'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề trên </label>
                            <input class="form-control" type="text" name="title4" value="<?php echo @$data['title4'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề dưới</label>
                            <input class="form-control" type="text" name="title5" value="<?php echo @$data['title5'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 1 </label>
                            <input class="form-control" type="text" name="step1" value="<?php echo @$data['step1'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 2 </label>
                            <input class="form-control" type="text" name="step2" value="<?php echo @$data['step2'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 3 </label>
                            <input class="form-control" type="text" name="step3" value="<?php echo @$data['step3'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 4 </label>
                            <input class="form-control" type="text" name="step4" value="<?php echo @$data['step4'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 5 </label>
                            <input class="form-control" type="text" name="step5" value="<?php echo @$data['step5'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 6 </label>
                            <input class="form-control" type="text" name="step6" value="<?php echo @$data['step6'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 7 </label>
                            <input class="form-control" type="text" name="step7" value="<?php echo @$data['step7'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 8 </label>
                            <input class="form-control" type="text" name="step8" value="<?php echo @$data['step8'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 9 </label>
                            <input class="form-control" type="text" name="step9" value="<?php echo @$data['step9'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 10 </label>
                            <input class="form-control" type="text" name="step10" value="<?php echo @$data['step10'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 11 </label>
                            <input class="form-control" type="text" name="step11" value="<?php echo @$data['step11'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 12 </label>
                            <input class="form-control" type="text" name="step12" value="<?php echo @$data['step12'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nội dung danh sách 13 </label>
                            <input class="form-control" type="text" name="step13" value="<?php echo @$data['step13'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Ảnh bên phải </label>
                                <?php showUploadFile('image10','image10', @$data['image10'],12);?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-7" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề khối </label>
                            <input class="form-control" type="text" name="title6" value="<?php echo @$data['title6'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Chữ Vàng</label>
                            <input class="form-control" type="text" name="chuvang" value="<?php echo @$data['chuvang'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Chữ in hoa cạnh nội dung 1</label>
                            <input class="form-control" type="text" name="ih1" value="<?php echo @$data['ih1'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                            <input class="form-control" type="text" name="noidungkhoi71" value="<?php echo @$data['noidungkhoi71'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Chữ in hoa cạnh nội dung 2</label>
                            <input class="form-control" type="text" name="ih2" value="<?php echo @$data['ih2'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                            <input class="form-control" type="text" name="noidungkhoi72" value="<?php echo @$data['noidungkhoi72'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Chữ in hoa cạnh nội dung 3</label>
                            <input class="form-control" type="text" name="ih3" value="<?php echo @$data['ih3'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                            <input class="form-control" type="text" name="noidungkhoi73" value="<?php echo @$data['noidungkhoi73'];?>"/>
                        </div>
                     
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Ảnh bên phải </label>
                            <?php showUploadFile('image11','image11', @$data['image11'],13);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">BUTTON</label>
                            <input class="form-control" type="text" name="button7" value="<?php echo @$data['button7'];?>"/>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-8" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề chữ vàng khối</label>
                            <input class="form-control" type="text" name="tieudevang" value="<?php echo @$data['tieudevang'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề chữ trắng khối </label>
                            <input class="form-control" type="text" name="tieudetrang" value="<?php echo @$data['tieudetrang'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">giá bên trái</label>
                            <input class="form-control" type="text" name="priceleft" value="<?php echo @$data['priceleft'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề giá</label>
                            <input class="form-control" type="text" name="tieudegia" value="<?php echo @$data['tieudegia'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được đầu tiên </label>
                            <input class="form-control" type="text" name="dsdautien" value="<?php echo @$data['dsdautien'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ hai </label>
                            <input class="form-control" type="text" name="dsdauhai" value="<?php echo @$data['dsdauhai'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ ba </label>
                            <input class="form-control" type="text" name="dsdauba" value="<?php echo @$data['dsdauba'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ tư </label>
                            <input class="form-control" type="text" name="dsdautu" value="<?php echo @$data['dsdautu'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ năm </label>
                            <input class="form-control" type="text" name="dsdaunam" value="<?php echo @$data['dsdaunam'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">giá bên phải</label>
                            <input class="form-control" type="text" name="priceright" value="<?php echo @$data['priceright'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề giá Phải</label>
                            <input class="form-control" type="text" name="tieudegiavip" value="<?php echo @$data['tieudegiavip'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được đầu tiên Phải </label>
                            <input class="form-control" type="text" name="dsdautienp" value="<?php echo @$data['dsdautienp'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ ha phải </label>
                            <input class="form-control" type="text" name="dsdauhaip" value="<?php echo @$data['dsdauhaip'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ ba phải </label>
                            <input class="form-control" type="text" name="dsdaubap" value="<?php echo @$data['dsdaubap'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ tư phải </label>
                            <input class="form-control" type="text" name="dsdautup" value="<?php echo @$data['dsdautup'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ năm phải </label>
                            <input class="form-control" type="text" name="dsdaunamp" value="<?php echo @$data['dsdaunamp'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">thông tin nhận được thứ sáu phải </label>
                            <input class="form-control" type="text" name="dsdausaup" value="<?php echo @$data['dsdausaup'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung dưới 1 </label>
                            <input class="form-control" type="text" name="noidungnho1" value="<?php echo @$data['noidungnho1'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung dưới 2 </label>
                            <input class="form-control" type="text" name="noidungnho2" value="<?php echo @$data['noidungnho2'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">button chung khối </label>
                            <input class="form-control" type="text" name="btchung" value="<?php echo @$data['btchung'];?>"/>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-9" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề lớn màu vàng</label>
                            <input class="form-control" type="text" name="titlevangk9" value="<?php echo @$data['titlevangk9'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề lớn màu trắng</label>
                            <input class="form-control" type="text" name="tieudetrangk9" value="<?php echo @$data['tieudetrangk9'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">tiêu đề màu vàng trắng</label>
                            <input class="form-control" type="text" name="tieudevangtrang" value="<?php echo @$data['tieudevangtrang'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Địa điểm</label>
                            <input class="form-control" type="text" name="diadiem" value="<?php echo @$data['diadiem'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Thời gian</label>
                            <input class="form-control" type="text" name="thoigian" value="<?php echo @$data['thoigian'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Phí Tham dự</label>
                            <input class="form-control" type="text" name="phithamdu" value="<?php echo @$data['phithamdu'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Giá tham dự</label>
                            <input class="form-control" type="text" name="pricethamdu" value="<?php echo @$data['pricethamdu'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">ưu đãi phía dưới giá tham dự</label>
                            <input class="form-control" type="text" name="uudaigia" value="<?php echo @$data['uudaigia'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">time down ngày</label>
                            <input class="form-control" type="text" name="timedownngay" value="<?php echo @$data['timedownngay'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">time down Giờ </label>
                            <input class="form-control" type="text" name="timedowngio" value="<?php echo @$data['timedowngio'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">time down Phút</label>
                            <input class="form-control" type="text" name="timedownphut" value="<?php echo @$data['timedownphut'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">time down giây</label>
                            <input class="form-control" type="text" name="timedowngiay" value="<?php echo @$data['timedowngiay'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">check box left địa điểm</label>
                            <input class="form-control" type="text" name="checkboxleftdd" value="<?php echo @$data['checkboxleftdd'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">check box right địa điểm</label>
                            <input class="form-control" type="text" name="checkboxrightdd" value="<?php echo @$data['checkboxrightdd'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">check box left giá </label>
                            <input class="form-control" type="text" name="checkboxleftprice" value="<?php echo @$data['checkboxleftprice'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">check box right giá</label>
                            <input class="form-control" type="text" name="checkboxrightprice" value="<?php echo @$data['checkboxrightprice'];?>"/>
                        </div>
                      
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-10" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề đầu</label>
                            <input class="form-control" type="text" name="titlek10" value="<?php echo @$data['titlek10'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề cạnh tiêu đề đầu</label>
                            <input class="form-control" type="text" name="titlek10bd" value="<?php echo @$data['titlek10bd'];?>"/>
                        </div>
                        
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề dưới thứ nhất </label>
                            <input class="form-control" type="text" name="titleb10" value="<?php echo @$data['titleb10'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề dưới thứ 2</label>
                            <input class="form-control" type="text" name="titleb11" value="<?php echo @$data['titleb11'];?>"/>
                        </div>
                      
                    </div>
                </div>
                <div class="tab-pane fade show" id="navs-11" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Title footer</label>
                            <input class="form-control" type="text" name="titlefooter" value="<?php echo @$data['titlefooter'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Ảnh LOGO </label>
                            <?php showUploadFile('footerlogo','footerlogo', @$data['footerlogo'],14);?>
                        </div>
                        
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Địa chỉ </label>
                            <input class="form-control" type="text" name="address" value="<?php echo @$data['address'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Số điện thoại </label>
                            <input class="form-control" type="text" name="sdt" value="<?php echo @$data['sdt'];?>"/>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input class="form-control" type="text" name="email" value="<?php echo @$data['email'];?>"/>
                        </div>
                    </div>
                </div>
               
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary" style="width:75px; height: 35px;">Lưu</button>
                </div>

            </div>
          </div>
        </div>

        
      </div>
    <?= $this->Form->end() ?>
</div>