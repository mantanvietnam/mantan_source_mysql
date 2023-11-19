<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-product-listProductAdmin.php">Sản phẩm</a> /</span>
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
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-home" aria-selected="true">
                                            Thông tin chi tiết
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                                            Hình ảnh
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="navs-top-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Tên sản phẩm (*)</label>
                                                <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Mã sản phẩm (*)</label>
                                                <input type="text" class="form-control phone-mask" name="code" id="code" value="<?php echo @$data->code;?>" required />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Trạng thái</label>
                                                    <div class="input-group input-group-merge">
                                                        <select class="form-select" name="status" id="status">
                                                            <option value="1" <?php if(!empty($data->status) && $data->status== 1) echo 'selected'; ?> >Kích hoạt</option>
                                                            <option value="0" <?php if(!empty($data->status) && $data->status== 0 ) echo 'selected'; ?> >Khóa</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Danh mục (*)</label>
                                                    <div class="input-group input-group-merge">
                                                        <select class="form-select" name="category_id" id="category_id">
                                                            <option value="">Chọn danh mục</option>
                                                            <?php
                                                            if (!empty($categoryList)) {
                                                                foreach ($categoryList as $key => $item) {
                                                                    if (empty($data->category_id) || $data->category_id != $item->id) {
                                                                        echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                                                    } else {
                                                                        echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Mô tả ngắn</label>
                                                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Giá bán</label>
                                                <input type="number" class="form-control phone-mask" name="price" id="price" value="<?php echo $data->price ?? 0;?>" />
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Loại hàng</label>
                                                <div class="input-group input-group-merge">
                                                    <select class="form-select" name="type" id="type">
                                                        <option value="0">Tiêu hao</option>
                                                        <option value="1" <?php if(!empty($data->type) && $data->type == 1) echo 'selected'; ?> >Tái sử dụng</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Số lượng trong kho</label>
                                                <input type="number" class="form-control phone-mask" name="amount_in_stock" id="amount_in_stock" value="<?php echo @$data->amount_in_stock;?>" />
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Số lượng đã bán</label>
                                                <input type="number" class="form-control phone-mask" name="amount_sold" id="amount_sold" value="<?php echo @$data->amount_sold;?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                                        <label class="form-label">Hình minh họa</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                      <div class="input-group">
                                                          <input type="text" class="form-control" aria-label="" aria-describedby="btnGroupAddonUpload"
                                                                 name="image" id="image" value="<?php echo @$data->image;?>"
                                                          >
                                                          <div class="input-group-prepend">
                                                            <div class="btn btn-secondary input-group-text" onclick="BrowseServerImage();" id="btnGroupAddonUpload">Upload</div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <img id="show-image" src="<?php echo @$data->image ?: 'https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg'; ?>"
                                                       alt="" style="max-width: 400px; max-height: 400px"
                                                  />
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
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
  <script type="text/javascript">
    function BrowseServerImage(number = 0)
    {
      let finder = new CKFinder();
      finder.basePath = "../";
      finder.selectActionFunction = SetFileFieldImage;
      finder.popup();
    }

    function SetFileFieldImage(fileUrl)
    {
      $("#image").val(fileUrl);
      $("#show-image").attr('src', fileUrl);
    }
  </script>
</div>
