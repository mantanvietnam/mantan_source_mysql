<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/phongtruyenthong-view-admin-class-listClassAdmin.php">Lớp học</a> /</span>
    Thông tin lớp học
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin lớp học</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin chung
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Giới thiệu chi tiết
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                          Hình ảnh
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tên lớp học (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Niên khóa (*)</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="id_year" id="id_year" required>
                                  <option value="">Chọn niên khóa</option>
                                  <?php 
                                  if(!empty($years)){
                                    foreach ($years as $key => $item) {
                                      if(empty($data->id_year) || $data->id_year!=$item->id){
                                        echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                      }else{
                                        echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                      }
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Tài khoản lớp trưởng</label>
                              <input type="text" class="form-control phone-mask" name="user" id="user" value="<?php echo @$data->user;?>" />
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Video giới thiệu lớp</label>
                              <?php showUploadFile('video','video',@$data->video,100);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Trạng thái</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="status" id="status">
                                  <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                                  <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                                </select>
                              </div>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mật khẩu</label>
                              <input type="text" class="form-control phone-mask" name="pass" id="pass" value="<?php echo @$data->pass;?>" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Giới thiệu chi tiết về lớp học</label>
                              <textarea name="info" rows="20" class="form-control"><?php echo @$data->info;?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Hình minh họa</label>
                              <?php showUploadFile('image','image',@$data->image,0);?>
                            </div>
                          </div>
                          
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 1</label>
                              <?php showUploadFile('image1','images[1]',@$data->images[1],1);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 1</label>
                              <input type="text" class="form-control phone-mask" name="des_image[1]"  value="<?php echo @$data->des_image[1];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 1</label>
                              <?php showUploadFile('audio_image1','audio_image[1]',@$data->audio_image[1],1001);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 2</label>
                              <?php showUploadFile('image2','images[2]',@$data->images[2],2);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 2</label>
                              <input type="text" class="form-control phone-mask" name="des_image[2]"  value="<?php echo @$data->des_image[2];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 2</label>
                              <?php showUploadFile('audio_image2','audio_image[2]',@$data->audio_image[2],1002);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 3</label>
                              <?php showUploadFile('image3','images[3]',@$data->images[3],3);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 3</label>
                              <input type="text" class="form-control phone-mask" name="des_image[3]"  value="<?php echo @$data->des_image[3];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 3</label>
                              <?php showUploadFile('audio_image3','audio_image[3]',@$data->audio_image[3],1003);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 4</label>
                              <?php showUploadFile('image4','images[4]',@$data->images[4],4);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 4</label>
                              <input type="text" class="form-control phone-mask" name="des_image[4]"  value="<?php echo @$data->des_image[4];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 4</label>
                              <?php showUploadFile('audio_image4','audio_image[4]',@$data->audio_image[4],1004);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 5</label>
                              <?php showUploadFile('image5','images[5]',@$data->images[5],5);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 5</label>
                              <input type="text" class="form-control phone-mask" name="des_image[5]"  value="<?php echo @$data->des_image[5];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 5</label>
                              <?php showUploadFile('audio_image5','audio_image[5]',@$data->audio_image[5],1005);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 6</label>
                              <?php showUploadFile('image6','images[6]',@$data->images[6],6);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 6</label>
                              <input type="text" class="form-control phone-mask" name="des_image[6]"  value="<?php echo @$data->des_image[6];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 6</label>
                              <?php showUploadFile('audio_image6','audio_image[6]',@$data->audio_image[6],1006);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 7</label>
                              <?php showUploadFile('image7','images[7]',@$data->images[7],7);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 7</label>
                              <input type="text" class="form-control phone-mask" name="des_image[7]"  value="<?php echo @$data->des_image[7];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 7</label>
                              <?php showUploadFile('audio_image7','audio_image[7]',@$data->audio_image[7],1007);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 8</label>
                              <?php showUploadFile('image8','images[8]',@$data->images[8],8);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 8</label>
                              <input type="text" class="form-control phone-mask" name="des_image[8]"  value="<?php echo @$data->des_image[8];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 8</label>
                              <?php showUploadFile('audio_image8','audio_image[8]',@$data->audio_image[8],1008);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 9</label>
                              <?php showUploadFile('image9','images[9]',@$data->images[9],9);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 9</label>
                              <input type="text" class="form-control phone-mask" name="des_image[9]"  value="<?php echo @$data->des_image[9];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 9</label>
                              <?php showUploadFile('audio_image9','audio_image[9]',@$data->audio_image[9],1009);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 10</label>
                              <?php showUploadFile('image10','images[10]',@$data->images[10],10);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 10</label>
                              <input type="text" class="form-control phone-mask" name="des_image[10]"  value="<?php echo @$data->des_image[10];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 10</label>
                              <?php showUploadFile('audio_image10','audio_image[10]',@$data->audio_image[10],10010);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 11</label>
                              <?php showUploadFile('image11','images[11]',@$data->images[11],11);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 11</label>
                              <input type="text" class="form-control phone-mask" name="des_image[11]"  value="<?php echo @$data->des_image[11];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 11</label>
                              <?php showUploadFile('audio_image11','audio_image[11]',@$data->audio_image[11],10011);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 12</label>
                              <?php showUploadFile('image12','images[12]',@$data->images[12],12);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 12</label>
                              <input type="text" class="form-control phone-mask" name="des_image[12]"  value="<?php echo @$data->des_image[12];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 12</label>
                              <?php showUploadFile('audio_image12','audio_image[12]',@$data->audio_image[12],10012);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 13</label>
                              <?php showUploadFile('image13','images[13]',@$data->images[13],13);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 13</label>
                              <input type="text" class="form-control phone-mask" name="des_image[13]"  value="<?php echo @$data->des_image[13];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 13</label>
                              <?php showUploadFile('audio_image13','audio_image[13]',@$data->audio_image[13],10013);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 14</label>
                              <?php showUploadFile('image14','images[14]',@$data->images[14],14);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 14</label>
                              <input type="text" class="form-control phone-mask" name="des_image[14]"  value="<?php echo @$data->des_image[14];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 14</label>
                              <?php showUploadFile('audio_image14','audio_image[14]',@$data->audio_image[14],10014);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 15</label>
                              <?php showUploadFile('image15','images[15]',@$data->images[15],15);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 15</label>
                              <input type="text" class="form-control phone-mask" name="des_image[15]"  value="<?php echo @$data->des_image[15];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 15</label>
                              <?php showUploadFile('audio_image15','audio_image[15]',@$data->audio_image[15],10015);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 16</label>
                              <?php showUploadFile('image16','images[16]',@$data->images[16],16);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 16</label>
                              <input type="text" class="form-control phone-mask" name="des_image[16]"  value="<?php echo @$data->des_image[16];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 16</label>
                              <?php showUploadFile('audio_image16','audio_image[16]',@$data->audio_image[16],10016);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 17</label>
                              <?php showUploadFile('image17','images[17]',@$data->images[17],17);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 17</label>
                              <input type="text" class="form-control phone-mask" name="des_image[17]"  value="<?php echo @$data->des_image[17];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 17</label>
                              <?php showUploadFile('audio_image17','audio_image[17]',@$data->audio_image[17],10017);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 18</label>
                              <?php showUploadFile('image18','images[18]',@$data->images[18],18);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 18</label>
                              <input type="text" class="form-control phone-mask" name="des_image[18]"  value="<?php echo @$data->des_image[18];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 18</label>
                              <?php showUploadFile('audio_image18','audio_image[18]',@$data->audio_image[18],10018);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 19</label>
                              <?php showUploadFile('image19','images[19]',@$data->images[19],19);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 19</label>
                              <input type="text" class="form-control phone-mask" name="des_image[19]"  value="<?php echo @$data->des_image[19];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 19</label>
                              <?php showUploadFile('audio_image19','audio_image[19]',@$data->audio_image[19],10019);?>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Hình 20</label>
                              <?php showUploadFile('image20','images[20]',@$data->images[20],20);?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hình 20</label>
                              <input type="text" class="form-control phone-mask" name="des_image[20]"  value="<?php echo @$data->des_image[20];?>" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">Audio hình 20</label>
                              <?php showUploadFile('audio_image20','audio_image[20]',@$data->audio_image[20],10020);?>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>