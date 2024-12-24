<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listbook">Danh sách</a> /</span>
    Thông tin sách
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin sách</h5>
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
                    
                      </li>
                    </ul>
                     <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Tên quyển sách</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Tác giả</label>
                              <input type="text" required  class="form-control" placeholder="" name="author" id="author" value="<?php echo @$data->author;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh</label>
                              <?php showUploadFile('image','image',@$data->image,0);?>
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
                                <label class="form-label">Mô tả ngắn</label>
                                <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>

                         
                          </div>

                          <div class="col-md-6">
                            
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Giá sách</label>
                              <input type="number" class="form-control" placeholder="" name="price" id="" value="<?php echo @$data->price;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Số lượng</label>
                              <input type="number" class="form-control" placeholder="" name="quantity" id="" value="<?php echo @$data->quantity;?>" readonly/>
                            </div>
                             <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Ngày xuất bản</label>
                              <input  type="datetime-local" class="form-control" name="published_date" id="name" value="<?php echo isset($data->published_date) ? date('Y-m-d\TH:i', $data->published_date) : ''; ?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Mã xuất bản</label>
                              <input type="text" class="form-control phone-mask" name="book_code" id="name" value="<?php echo @$data->book_code;?>" required/>
                            </div>
                              <div class="row ">
                                <div class="mb-3 form-group col-6">
                                  <i>Danh mục sách</i>
                                  <select name="id_category" id="id_category" class="form-control">
                                      <option value="">Chọn Danh mục sách</option>
                                      <?php if (!empty($listcategory)): ?>
                                          <?php foreach ($listcategory as $key => $value): ?>
                                              <option value="<?php echo $value->id; ?>" <?php echo ($data->id_category == $value->id) ? 'selected' : ''; ?>>
                                                  <?php echo $value->name; ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>
                                </div>
                                <div class="mb-3 form-group col-6">
                                    <i>Nhà xuất bản</i>
                                    <select name="publishing_id" id="publishing_id" class="form-control">
                                        <option value="">Chọn Nhà xuất bản</option>
                                        <?php if (!empty($listcategorypublishers)): ?>
                                            <?php foreach ($listcategorypublishers as $publisher): ?>
                                                <option value="<?php echo $publisher->id; ?>" 
                                                    <?php echo (!empty($data->publishing_id) && $data->publishing_id == $publisher->id) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($publisher->name); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- <div class="mb-3">
                                  <label class="form-label" for="basic-default-fullname">Loại sách</label>
                                  <input type="text"  class="form-control" placeholder="" name="typebook" id="typebook" value="<?php echo @$data->typebook;?>" />
                                </div> -->
                              </div>

                            
                          </div>

                        </div>
                      </div>
                 
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 70px;">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>
<script type="text/javascript">
    function downloadImageFromSrc(url, phone){
      var fileName = 'QR_ICHAM_'+phone+'.jpg';
      var xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);
      xhr.responseType = "blob";
      xhr.onload = function(){
          var urlCreator = window.URL || window.webkitURL;
          var imageUrl = urlCreator.createObjectURL(this.response);
          var tag = document.createElement('a');
          tag.href = imageUrl;
          tag.download = fileName;
          document.body.appendChild(tag);
          tag.click();
          document.body.removeChild(tag);
      }
      xhr.send();
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>