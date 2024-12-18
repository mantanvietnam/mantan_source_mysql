<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt trang về chúng tôi</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="card mb-4">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
          Header
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
          Sứ mệnh và tầm nhìn
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
          Sản phẩm
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-founder" aria-controls="navs-top-info" aria-selected="false">
          Người sáng lập
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specificaions" aria-controls="navs-top-info" aria-selected="false">
          Slider giải thưởng
        </button>
      </li>
    </ul>
      <div class="card-body tab-content ">
        <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="titel_header" id="titel_header" value="<?php echo @$setting['titel_header'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="titel_header_en" id="titel_header_en" value="<?php echo @$setting['titel_header_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">chữ nhỏ tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="desc_header" id="desc_header" value="<?php echo @$setting['desc_header'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">chữ nhỏ tiếng Anh</label>
              <input type="text" class="form-control phone-mask" name="desc_header_en" id="desc_header_en" value="<?php echo @$setting['desc_header_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Ảnh</label>
               <?php showUploadFile('image_header','image_header', @$setting['image_header'],1);?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="titel_tamnhin" id="titel_tamnhin" value="<?php echo @$setting['titel_tamnhin'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="titel_tamnhin_en" id="titel_tamnhin_en" value="<?php echo @$setting['titel_tamnhin_en'];?>"/>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
              <label class="form-label">Tiêu đề phần tử 1 tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="desc_tamnhin_phantu1" id="desc_tamnhin_phantu1" value="<?php echo @$setting['desc_tamnhin_phantu1'];?>"/>
              </div>
              <div class="mb-3">
              <label class="form-label">Tiêu đề phần tử 1 tiếng Anh</label>
              <input type="text" class="form-control phone-mask" name="desc_tamnhin_phantu1_en" id="desc_tamnhin_phantu1_en" value="<?php echo @$setting['desc_tamnhin_phantu1_en'];?>"/>
              </div>
              <div class="mb-3">
              <label class="form-label">ảnh phần tử 1</label>
              <?php showUploadFile('image_tamnhin_phantu1','image_tamnhin_phantu1', @$setting['image_tamnhin_phantu1'],2);?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
              <label class="form-label">Tiêu đề phần tử 2 tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="desc_phantu2" id="desc_phantu2" value="<?php echo @$setting['desc_phantu2'];?>"/>
              </div>
              <div class="mb-3">
              <label class="form-label">Tiêu đề phần tử 1 tiếng Anh</label>
              <input type="text" class="form-control phone-mask" name="desc_tamnhin_phantu2_en" id="desc_tamnhin_phantu2_en" value="<?php echo @$setting['desc_tamnhin_phantu2_en'];?>"/>
              </div>
              <div class="mb-3">
              <label class="form-label">ảnh phần tử 2</label>
              <?php showUploadFile('image_tamnhin_phantu2','image_tamnhin_phantu2', @$setting['image_tamnhin_phantu2'],3);?>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="titel_sanpham" id="titel_sanpham" value="<?php echo @$setting['titel_sanpham'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="titel_sanpham_en" id="titel_sanpham_en" value="<?php echo @$setting['titel_sanpham_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">chữa nhỏ tiếng việt</label>
              <input type="text" class="form-control phone-mask" name="desc_sanpham" id="desc_sanpham" value="<?php echo @$setting['desc_sanpham'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">chữa nhỏ tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="desc_sanpham_en" id="desc_sanpham_en" value="<?php echo @$setting['desc_sanpham_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">link tiếng việt</label>
              <input type="text" class="form-control phone-mask" name="link_sanpham" id="link_sanpham" value="<?php echo @$setting['link_sanpham'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">link tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="link_sanpham_en" id="link_sanpham_en" value="<?php echo @$setting['link_sanpham_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">ảnh</label>
              <?php showUploadFile('image_sanpham','image_sanpham', @$setting['image_sanpham'],4);?>
              </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-founder" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="titel_nhasangnlap" id="titel_nhasangnlap" value="<?php echo @$setting['titel_nhasangnlap'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="titel_nhasangnlap_en" id="titel_nhasangnlap_en" value="<?php echo @$setting['titel_nhasangnlap_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">chữa nhỏ tiếng việt</label>
              <input type="text" class="form-control phone-mask" name="desc_nhasangnlap" id="desc_nhasangnlap" value="<?php echo @$setting['desc_nhasangnlap'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">chữa nhỏ tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="desc_nhasangnlap_en" id="desc_nhasangnlap_en" value="<?php echo @$setting['desc_nhasangnlap_en'];?>"/>
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label">ảnh</label>
              <?php showUploadFile('image_nhasangnlap','image_nhasangnlap', @$setting['image_nhasangnlap'],5);?>
              </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-specificaions" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">id ảnh giả thưởng</label>
              <input type="text" class="form-control phone-mask" name="id_album" id="id_album" value="<?php echo @$setting['id_album'];?>"/>
            </div>
            <
        </div>
      </div>
      <div class="card-body">
        <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
      </div>
    </div>
<?= $this->Form->end() ?>
</div>
