<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/product-view-admin-product-listProduct.php">Sản phẩm</a> /</span>
    Thông tin sản phẩm
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin sản phẩm</h5>
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
                          Mô tả sản phẩm
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Thông tin sản phẩm
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                          Đặc điểm nổi bật
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                         Thông số kỹ thuật
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
                              <label class="form-label">Tên sản phẩm (*)</label>
                              <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mã sản phẩm (*)</label>
                              <input type="text" class="form-control phone-mask" name="code" id="code" value="<?php echo @$data->code;?>" required />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Danh mục (*)</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="id_category" id="id_category" required>
                                  <option value="">Chọn danh mục</option>
                                  <?php 
                                  if(!empty($listCategory)){
                                    foreach ($listCategory as $key => $item) {
                                      if(empty($data->id_category) || $data->id_category!=$item->id){
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
                              <label class="form-label">Nhà sản xuất</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="id_manufacturer" id="id_manufacturer">
                                  <option value="">Chọn nhà sản xuất</option>
                                  <?php 
                                  if(!empty($listManufacturer)){
                                    foreach ($listManufacturer as $key => $item) {
                                      if(empty($data->id_manufacturer) || $data->id_manufacturer!=$item->id){
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
                              <label class="form-label">Ghim lên đầu</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="hot" id="hot">
                                  <option value="1" <?php if(!empty($data->hot) && $data->hot=='1') echo 'selected'; ?> >Có</option>
                                  <option value="0" <?php if(empty($data->hot)) echo 'selected'; ?> >Không</option>
                                </select>
                              </div>
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
                              <label class="form-label">Số lượt xem</label>
                              <input disabled type="number" class="form-control phone-mask" name="view" id="view" value="<?php echo (int) @$data->view;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Id sản phẩm quà tặng </label>
                              <input type="text" class="form-control" name="id_product" id="id_product" value="<?php echo @$data->id_product; ?>" />
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Từ khóa</label>
                              <input type="text" class="form-control phone-mask" name="keyword" id="keyword" value="<?php echo @$data->keyword;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Giá bán</label>
                              <input type="text" class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Giá bán cũ</label>
                              <input type="text" class="form-control phone-mask" name="price_old" id="price_old" value="<?php echo @$data->price_old;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Giá ưu đãi</label>
                              <input type="text" class="form-control" name="pricepro_discount" id="pricepro_discount" value="<?php echo @$data->pricepro_discount; ?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Số lượng</label>
                              <input type="text" class="form-control phone-mask" name="quantity" id="quantity" value="<?php echo (int) @$data->quantity;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Id sản phẩm ưu đãi</label>
                              <input type="text" class="form-control" name="idpro_discount" id="idpro_discount" value="<?php echo @$data->idpro_discount; ?>" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Thông tin mô tả về sản phẩm</label>
                              <?php showEditorInput('info', 'info', @$data->info);?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Đặc điểm nổi bật</label>
                              <?php showEditorInput('rule', 'rule', @$data->rule);?>
                            </div>
                          </div>
                        </div>
                      </div>
                       <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Thông số kỹ thuật</label>
                              <?php showEditorInput('specification', 'specification', @$data->specification);?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                        <div class="row">
                          <div class="col-md-4">
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
                              <label class="form-label">Hình 2</label>
                              <?php showUploadFile('image2','images[2]',@$data->images[2],2);?>
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
                              <label class="form-label">Hình 4</label>
                              <?php showUploadFile('image4','images[4]',@$data->images[4],4);?>
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
                              <label class="form-label">Hình 6</label>
                              <?php showUploadFile('image6','images[6]',@$data->images[6],6);?>
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
                              <label class="form-label">Hình 8</label>
                              <?php showUploadFile('image8','images[8]',@$data->images[8],8);?>
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
                              <label class="form-label">Hình 10</label>
                              <?php showUploadFile('image10','images[10]',@$data->images[10],10);?>
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
                              <label class="form-label">Hình 12</label>
                              <?php showUploadFile('image12','images[12]',@$data->images[12],12);?>
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
                              <label class="form-label">Hình 14</label>
                              <?php showUploadFile('image14','images[14]',@$data->images[14],14);?>
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
                              <label class="form-label">Hình 16</label>
                              <?php showUploadFile('image16','images[16]',@$data->images[16],16);?>
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
                              <label class="form-label">Hình 18</label>
                              <?php showUploadFile('image18','images[18]',@$data->images[18],18);?>
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
                              <label class="form-label">Hình 20</label>
                              <?php showUploadFile('image20','images[20]',@$data->images[20],20);?>
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