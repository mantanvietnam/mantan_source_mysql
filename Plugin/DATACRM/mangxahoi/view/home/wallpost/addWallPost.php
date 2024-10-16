<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWallPost">Bài viết mạng xã hội</a> /</span>
    Thông tin bài viết mạng xã hội
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin bài viết mạng xã hội</h5>
          </div>
          <div class="card-body">
          <p><?php echo @$mess;?></p>
          <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
            <div class="row">
              <div class="col-12">
                <div class=" mb-4">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        Nội dung bài viết
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-info" aria-selected="false">
                        Hình ảnh 
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-phone">Tên khách hàng</label>
                            <input type="text"  class="form-control" disabled=""  name="customer_buy" id="customer_buy" value="<?php if(!empty($data->infoCustomer)) echo $data->infoCustomer->full_name;?>" />
                           
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Ghim lên đầu</label>
                        <div class="row">
                          <div class="col-6">
                            <input type="radio" name="pin" value="1" <?php if(!empty($data->pin) && $data->pin==1) echo 'checked';?> /> Có 
                          </div>
                          <div class="col-6">
                            <input type="radio" name="pin" value="0" <?php if(empty($data->pin)) echo 'checked';?> /> Không 
                          </div>
                        </div>
                      </div>
                        <div class="col-md-3">
                          <label class="form-label" for="basic-default-email">Hiểu thị</label>
                          <div class="input-group input-group-merge">
                            <select class="form-select" name="public" id="public">
                              <option value="private" <?php if(!empty($data->public) && $data->public=='private') echo 'selected'; ?> >Riêng từ</option>
                              <option value="public" <?php if(!empty($data->public) && $data->public=='public') echo 'selected'; ?> >Công khai</option>
                            </select>
                          </div>
                      </div>
                       <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">nội dung  </label>
                              <?php showEditorInput('connent', 'connent', @$data->connent);?>
                           
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="tab-pane fade" id="navs-top-image" role="tabpanel">

                      <div class="row" style="margin-top: 15px;">

                        <div class="form-group col-md-12 dropzone" style="margin-bottom: 10px;">
                          <div class="fallback">
                            <?php if (@$_GET['status']=='loianh') {?>
                              <p style="color: red;">dung lượng ảnh không quá 1MB</p>
                            <?php } ?>
                            <input name="listImage[]" type="file" multiple="multiple" />
                          </div>
                        </div>
                        <?php
                        if(!empty($data->listImage)){
                          foreach($data->listImage as $img){
                            if(!isset($img->image)){
                              $listImage= $urlHomes.'/app/Plugin/mantanHotel/images/no-thumb.png';
                            }else{ 
                              $listImage= $img->image;
                            }

                            echo '<div class="col-md-6" id="hinh">
                            <input type="checkbox" class="" name="id_image_delete[]" value="'.$img->id.'"/>(kich vào để xóa ảnh)
                            <p><img src="'.@$listImage.'" width="150" /></p>
                            </div>';
                          }
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>



<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>