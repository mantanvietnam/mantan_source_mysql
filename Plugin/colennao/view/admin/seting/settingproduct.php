<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt trang về sản phẩm</h4>

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
          Các sản phẩm phổ biến
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
            Banner product
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-founder" aria-controls="navs-top-info" aria-selected="false">
          Slide product
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specificaions" aria-controls="navs-top-info" aria-selected="false">
          Discover product
        </button>
      </li>
    </ul>
      <div class="card-body tab-content ">
        <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="title_header_product" id="title_header_product" value="<?php echo @$setting['title_header_product'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_header_product_en" id="title_header_product_en" value="<?php echo @$setting['title_header_product_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề 1 tiếng việt</label>
              <input type="text" class="form-control phone-mask" name="title_header_product2" id="title_header_product2" value="<?php echo @$setting['title_header_product2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề 1 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_header_product2_en" id="title_header_product2_en" value="<?php echo @$setting['title_header_product2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề 2 tiếng việt</label>
              <input type="text" class="form-control phone-mask" name="title_header_product3" id="title_header_product3" value="<?php echo @$setting['title_header_product3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề 2 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_header_product3_en" id="title_header_product3_en" value="<?php echo @$setting['title_header_product3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Link</label>
              <input type="text" class="form-control phone-mask" name="link_header_product" id="link_header_product" value="<?php echo @$setting['link_header_product'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Ảnh</label>
               <?php showUploadFile('image_product_header','image_product_header', @$setting['image_product_header'],20);?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng Việt</label>
              <input type="text" class="form-control phone-mask" name="title_popular_product" id="title_popular_product" value="<?php echo @$setting['title_popular_product'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_popular_product_en" id="title_popular_product_en" value="<?php echo @$setting['title_popular_product_en'];?>"/>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Text 1 tiếng việt</label>
                <input type="text" class="form-control phone-mask" name="text1_popular" id="text1_popular" value="<?php echo @$setting['text1_popular'];?>"/>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Text 1 tiếng anh</label>
                    <input type="text" class="form-control phone-mask" name="text1_popular_en" id="text1_popular_en" value="<?php echo @$setting['text1_popular_en'];?>"/>
                </div>
              </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Text 2 tiếng việt</label>
                    <input type="text" class="form-control phone-mask" name="text2" id="text2" value="<?php echo @$setting['text2'];?>"/>
                </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Text 2 tiếng Anh</label>
                <input type="text" class="form-control phone-mask" name="text2_en" id="text2_en" value="<?php echo @$setting['text2_en'];?>"/>
              </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                <label class="form-label">ảnh phần tử 1</label>
                <?php showUploadFile('image_popular_1','image_popular_1', @$setting['image_popular_1'],3);?>
              </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">ảnh phần tử 2</label>
                    <?php showUploadFile('image_popular_2','image_popular_2', @$setting['image_popular_2'],4);?>
                </div>
            </div> 
            </div>

          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Text banner 1</label>
              <input type="text" class="form-control phone-mask" name="text_banner_1" id="text_banner_1" value="<?php echo @$setting['text_banner_1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">>Text banner 1 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_banner_1_en" id="text_banner_1_en" value="<?php echo @$setting['text_banner_1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text banner 2</label>
              <input type="text" class="form-control phone-mask" name="text_banner_2" id="text_banner_2" value="<?php echo @$setting['text_banner_2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text banner 2 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_banner_2_en" id="text_banner_2_en" value="<?php echo @$setting['text_banner_2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text banner 3 tiếng việt</label>
              <input type="text" class="form-control phone-mask" name="text_banner_3" id="text_banner_3" value="<?php echo @$setting['text_banner_3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text banner 3 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_banner_3_en" id="text_banner_3_en" value="<?php echo @$setting['text_banner_3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">ảnh</label>
              <?php showUploadFile('image_banner_1','image_banner_1', @$setting['image_banner_1'],6);?>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text mô tả phần 2  </label>
              <input type="text" class="form-control phone-mask" name="text_description_banner_1" id="text_description_banner_1" value="<?php echo @$setting['text_description_banner_1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text mô tả phần 2 tiếng anh </label>
              <input type="text" class="form-control phone-mask" name="text_description_banner1_en" id="text_description_banner1_en" value="<?php echo @$setting['text_description_banner1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text mô tả phần 3 </label>
              <input type="text" class="form-control phone-mask" name="text_description_banner3" id="text_description_banner3" value="<?php echo @$setting['text_description_banner3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Text mô tả phần 3 tiếng anh </label>
              <input type="text" class="form-control phone-mask" name="text_description_banner3_en" id="text_description_banner3_en" value="<?php echo @$setting['text_description_banner3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">ảnh</label>
              <?php showUploadFile('image_banner_2','image_banner_2', @$setting['image_banner_2'],7);?>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">link dowload </label>
              <input type="text" class="form-control phone-mask" name="link_dowload_banner" id="link_dowload_banner" value="<?php echo @$setting['link_dowload_banner'];?>"/>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-founder" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng việt</label>
              <input type="text" class="form-control phone-mask" name="title_slide_product" id="title_slide_product" value="<?php echo @$setting['title_slide_product'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_slide_product_en" id="title_slide_product_en" value="<?php echo @$setting['title_slide_product_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Số liệu</label>
              <input type="text" class="form-control phone-mask" name="slide_number_data" id="slide_number_data" value="<?php echo @$setting['slide_number_data'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Số liệu tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="slide_number_data_en" id="slide_number_data_en" value="<?php echo @$setting['slide_number_data_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả</label>
              <input type="text" class="form-control phone-mask" name="description_data" id="description_data" value="<?php echo @$setting['description_data'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="description_data_en" id="description_data_en" value="<?php echo @$setting['description_data_en'];?>"/>
            </div>
      
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-specificaions" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề</label>
              <input type="text" class="form-control phone-mask" name="discover_text_title1" id="discover_text_title1" value="<?php echo @$setting['discover_text_title1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="discover_text_title1_en" id="discover_text_title1_en" value="<?php echo @$setting['discover_text_title1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả </label>
              <input type="text" class="form-control phone-mask" name="discover_description_title1" id="discover_description_title1" value="<?php echo @$setting['discover_description_title1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="discover_description_title1_en" id="discover_description_title1_en" value="<?php echo @$setting['discover_description_title1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Link</label>
              <input type="text" class="form-control phone-mask" name="discover_link1" id="discover_link1" value="<?php echo @$setting['discover_link1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">ảnh</label>
              <?php showUploadFile('image_discover_1','image_discover_1', @$setting['image_discover_1'],8);?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề</label>
              <input type="text" class="form-control phone-mask" name="discover_text_title2" id="discover_text_title2" value="<?php echo @$setting['discover_text_title2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="discover_text_title2_en" id="discover_text_title2_en" value="<?php echo @$setting['discover_text_title2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả </label>
              <input type="text" class="form-control phone-mask" name="discover_description_title2" id="discover_description_title2" value="<?php echo @$setting['discover_description_title2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="discover_description_title2_en" id="discover_description_title2_en" value="<?php echo @$setting['discover_description_title2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Link</label>
              <input type="text" class="form-control phone-mask" name="discover_link2" id="discover_link2" value="<?php echo @$setting['discover_link2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">ảnh</label>
              <?php showUploadFile('image_discover_2','image_discover_2', @$setting['image_discover_2'],9);?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề</label>
              <input type="text" class="form-control phone-mask" name="discover_text_title3" id="discover_text_title3" value="<?php echo @$setting['discover_text_title3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="discover_text_title3_en" id="discover_text_title3_en" value="<?php echo @$setting['discover_text_title3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả </label>
              <input type="text" class="form-control phone-mask" name="discover_description_title3" id="discover_description_title3" value="<?php echo @$setting['discover_description_title3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mô tả tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="discover_description_title3_en" id="discover_description_title3_en" value="<?php echo @$setting['discover_description_title3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Link</label>
              <input type="text" class="form-control phone-mask" name="discover_link3" id="discover_link3" value="<?php echo @$setting['discover_link3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">ảnh</label>
              <?php showUploadFile('image_discover_3','image_discover_3', @$setting['image_discover_3'],9);?>
            </div>
        </div>
      </div>
      <div class="card-body">
        <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
      </div>
    </div>
<?= $this->Form->end() ?>
</div>
