<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">   Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="card-body row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card  mb-4">
            <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          KHỐI ĐẦU
                        </button>
                      </li>
                     
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                          TẦM NHÌN
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                         THỐNG KÊ
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-video" aria-controls="navs-top-info" aria-selected="false">
                         VIDEO
                        </button>
                      </li>
                      
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-feedback" aria-controls="navs-top-image" aria-selected="false">
                          FEEDBACK
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-evaluate" aria-controls="navs-top-image" aria-selected="false">
                           KHÁCH HÀNG
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-transmit" aria-controls="navs-top-image" aria-selected="false">
                         TRUYỀN THÔNG 
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contac" aria-controls="navs-top-image" aria-selected="false">
                           LIÊN HỆ
                        </button>
                      </li>
            <div class="card-body tab-content ">
                <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Logo</label>
                            <?php  showUploadFile('logo','logo',@$data['logo'],0);?>
                            <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                            <?php  showUploadFile('image','image',@$data['image'],1);?>
                            <label class="form-label" for="basic-default-fullname">Đường đẫn câu chuyện về tôi</label>
                            <input class="form-control" type="text" name="cauchuyevetoi" value="<?php echo @$data['cauchuyevetoi'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Text slide</label>
                            <?php showEditorInput('textSlide','textSlide',@$data['textSlide'],0); ?>
                       </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Tầm nhìn</label>
                            <input class="form-control" type="text" name="textSlide0" value="<?php echo @$data['textSlide0'];?>" />
                            <label class="form-label" for="basic-default-fullname">text giới thiệu</label>
                            <input class="form-control" type="text" name="textSlide1" value="<?php echo @$data['textSlide1'];?>" />
                            <label class="form-label" for="basic-default-fullname">Ảnh chân dung 1</label>
                            <?php showUploadFile('avatar','avatar',@$data['avatar'],2);?>
                            <label class="form-label" for="basic-default-fullname">Ảnh chân dung 2</label>
                            <?php  showUploadFile('avatar2','avatar2',@$data['avatar2'],16);?>
                            <label class="form-label" for="basic-default-fullname">Họ tên</label>
                            <input class="form-control" type="text" name="fullName" value="<?php echo @$data['fullName'];?>" />
                            <label class="form-label" for="basic-default-fullname">Ảnh chứ ký</label>
                            <?php  showUploadFile('avatar4','avatar4',@$data['avatar4'],17);?>
                            <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                            <?php showUploadFile('background1','background1',@$data['background1'],18); ?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Giới thiệu bản thân</label>
                            <?php showEditorInput('personIntroduction','personIntroduction',@$data['personIntroduction'],2); ?>
                        </div>

                       
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                    <div class="card-body row">
                     
                       <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Tên đề</label>
                            <input class="form-control" type="text" name="numberStatic0" value="<?php echo @$data['numberStatic0'];?>" />
                       </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">ảnh minh họa trái</label>
                              <?php showUploadFile('imageLearn1','imageLearn1',@$data['imageLearn1'],3);?>
                        </div>
                         <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">ảnh minh họa phải</label>
                            <?php showUploadFile('imageLearn1000','imageLearn1000',@$data['imageLearn1000'],1000);?>
                         </div>
                       <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung thống kê 1</label>
                            <input class="form-control" type="text" name="nameStatic1" value="<?php echo @$data['nameStatic1'];?>" />
                            <label class="form-label" for="basic-default-fullname">Số lượng thống kê 1</label>
                            <input class="form-control" type="text" name="numberStatic1" value="<?php echo @$data['numberStatic1'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung thống kê 2</label>
                            <input class="form-control" type="text" name="nameStatic2" value="<?php echo @$data['nameStatic2'];?>" />
                            <label class="form-label" for="basic-default-fullname">Số lượng thống kê 2</label>
                            <input class="form-control" type="text" name="numberStatic2" value="<?php echo @$data['numberStatic2'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Nội dung thống kê 3</label>
                            <input class="form-control" type="text" name="nameStatic3" value="<?php echo @$data['nameStatic3'];?>" />
                            <label class="form-label" for="basic-default-fullname">Số lượng thống kê 3</label>
                            <input class="form-control" type="text" name="numberStatic3" value="<?php echo @$data['numberStatic3'];?>" />
                         </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-video" role="tabpanel">
                    <div class="card-body row">
                       <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Text video</label>
                            <?php showEditorInput('textvideo','textvideo',@$data['textvideo'],3); ?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">code video youtube</label>
                                <input class="form-control" type="text" name="video" value="<?php echo htmlspecialchars_decode(@$data['video']);?>" />
                                <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                                <?php showUploadFile('background2','background2',@$data['background2'],19)?>
                          </div>
                         
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-feedback" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                            <input class="form-control" type="text" name="imageLearn0" value="<?php echo htmlspecialchars_decode(@$data['imageLearn0']);?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa khóa 1</label>
                            <?php showUploadFile('imageLearn2','imageLearn2',@$data['imageLearn2'],5);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa khóa 2</label>
                            <?php showUploadFile('imageLearn3','imageLearn3',@$data['imageLearn3'],6);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa khóa 3</label>
                            <?php   showUploadFile('imageLearn4','imageLearn4',@$data['imageLearn4'],7);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa khóa 4</label>
                            <?php  showUploadFile('imageLearn5','imageLearn5',@$data['imageLearn5'],8); ?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <label class="form-label" for="basic-default-fullname">tiêu đề tin tức</label>
                        <input class="form-control" type="text" name="baivietmannhat" value="<?php echo htmlspecialchars_decode(@$data['baivietmannhat']);?>" />
                        </div>
                    
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-evaluate" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                            <input class="form-control" type="text" name="video0" value="<?php echo htmlspecialchars_decode(@$data['video0']);?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">video cảm nhận 1</label>
                            <input class="form-control" type="text" name="video1" value="<?php echo htmlspecialchars_decode(@$data['video1']);?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">video cảm nhận 2</label>
                            <input class="form-control" type="text" name="video2" value="<?php echo htmlspecialchars_decode(@$data['video2']);?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">video cảm nhận 3</label>
                            <input class="form-control" type="text" name="video3" value="<?php echo htmlspecialchars_decode(@$data['video3']);?>" />
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-transmit" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-12 col-lg-12 col-xl-12">
                             <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                            <input class="form-control" type="text" name="chuyenthongbaochi" value="<?php echo @$data['chuyenthongbaochi'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa 1</label>
                            <?php                    
                                showUploadFile('imageLearn12','imageLearn12',@$data['imageLearn12'],12);
                            ?>
                            
                            <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                            <input class="form-control" type="text" name="titleLearn1" value="<?php echo @$data['titleLearn1'];?>" />
                            <label class="form-label" for="basic-default-fullname">Mô tả 1</label>
                            <input class="form-control" type="text" name="decsLearn1" value="<?php echo @$data['decsLearn1'];?>" />
                            <label class="form-label" for="basic-default-fullname">Link</label>
                            <input class="form-control" type="text" name="link1" value="<?php echo @$data['link1'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa  2</label>
                            <?php                    
                                showUploadFile('imageLearn13','imageLearn13',@$data['imageLearn13'],13);
                            ?>
                            <br/><br/>
                            <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                            <input class="form-control" type="text" name="titleLearn2" value="<?php echo @$data['titleLearn2'];?>" />
                            <label class="form-label" for="basic-default-fullname">Mô tả 2</label>
                            <input class="form-control" type="text" name="decsLearn2" value="<?php echo @$data['decsLearn2'];?>" />
                            <label class="form-label" for="basic-default-fullname">Link</label>
                            <input class="form-control" type="text" name="link2" value="<?php echo @$data['link2'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa 3</label>
                            <?php                    
                                showUploadFile('imageLearn14','imageLearn14',@$data['imageLearn14'],14);
                            ?>
                            <br/><br/>
                            <label class="form-label" for="basic-default-fullname">Tiêu đề  3</label>
                            <input class="form-control" type="text" name="titleLearn3" value="<?php echo @$data['titleLearn3'];?>" />
                            <label class="form-label" for="basic-default-fullname">Mô tả  3</label>
                            <input class="form-control" type="text" name="decsLearn4" value="<?php echo @$data['decsLearn4'];?>" />
                            <label class="form-label" for="basic-default-fullname">Link</label>
                            <input class="form-control" type="text" name="link3" value="<?php echo @$data['link3'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Ảnh minh họa 4</label>
                            <?php                    
                                showUploadFile('imageLearn15','imageLearn15',@$data['imageLearn15'],15);
                            ?>
                            <br/><br/>
                            <label class="form-label" for="basic-default-fullname">Tiêu đề  4</label>
                            <input class="form-control" type="text" name="titleLearn6" value="<?php echo @$data['titleLearn6'];?>" />
                            <label class="form-label" for="basic-default-fullname">Mô tả  4</label>
                            <input class="form-control" type="text" name="decsLearn5" value="<?php echo @$data['decsLearn5'];?>" />
                            <label class="form-label" for="basic-default-fullname">Link </label>
                            <input class="form-control" type="text" name="link4" value="<?php echo @$data['link4'];?>" />
                       </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-contac" role="tabpanel">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Link Facebook</label>
                            <input class="form-control" type="text" name="facebook" value="<?php echo @$data['facebook'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label class="form-label" for="basic-default-fullname">Mã nhúng Messenger Facebook</label>
                                <textarea style="width: 100%;" rows="5" name="messenger"><?php echo @htmlspecialchars_decode($data['messenger']);?></textarea>
                            </div>
                         <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Link Youtube</label>
                            <input class="form-control" type="text" name="youtube" value="<?php echo @$data['youtube'];?>" />
                        </div>

                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Link Instagram</label>
                            <input class="form-control" type="text" name="instagram" value="<?php echo @$data['instagram'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">SPA</label>
                            <input class="form-control" name="nameThamMy" value="<?php echo @$data['nameThamMy'];?>"data-jscolor="">
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Điện thoại CSKH</label>
                            <input class="form-control" name="hotline" value="<?php echo @$data['hotline'];?>"data-jscolor="">
                        </div>
                         <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Email CSKH</label>
                            <input class="form-control" name="linkMail" value="<?php echo @$data['linkMail'];?>"data-jscolor="">
                        </div>
                         <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                            <input class="form-control" name="address" value="<?php echo @$data['address'];?>"data-jscolor="">
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