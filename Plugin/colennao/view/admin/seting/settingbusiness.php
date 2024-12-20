<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt trang về Business</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="card mb-4">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
          Giới thiệu
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
          Lý do
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
            Nội dung độc quyền
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home2" aria-controls="navs-top-info" aria-selected="false">
            nội dung giới thiệu 2
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-founder" aria-controls="navs-top-info" aria-selected="false">
            Sider
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specificaions" aria-controls="navs-top-info" aria-selected="false">
            giới thiệu Zoom
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-coaching" aria-controls="navs-top-info" aria-selected="false">
            Coaching
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-prize" aria-controls="navs-top-info" aria-selected="false">
            Slide giải thưởng và doanh nghiệp
        </button>
      </li>
    </ul>
      <div class="card-body tab-content ">
        <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Link 1</label>
              <input type="text" class="form-control phone-mask" name="link_business_1" id="link_business_1" value="<?php echo @$setting['link_business_1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Link 2</label>
              <input type="text" class="form-control phone-mask" name="link_business_2" id="link_business_2" value="<?php echo @$setting['link_business_2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề </label>
              <input type="text" class="form-control phone-mask" name="title_business" id="title_business" value="<?php echo @$setting['title_business'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_business_en" id="title_business_en" value="<?php echo @$setting['title_business_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề desc </label>
              <input type="text" class="form-control phone-mask" name="desc_business" id="desc_business" value="<?php echo @$setting['desc_business'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề desc en</label>
              <input type="text" class="form-control phone-mask" name="desc_business_en" id="desc_business_en" value="<?php echo @$setting['desc_business_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Link video youtube</label>
              <input type="text" class="form-control phone-mask" name="link_business_youtube" id="link_business_youtube" value="<?php echo @$setting['link_business_youtube'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">image poster</label>
               <?php showUploadFile('image_poster','image_poster', @$setting['image_poster'],1);?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">text số liệu 1</label>
              <input type="text" class="form-control phone-mask" name="text_data_business1" id="text_data_business1" value="<?php echo @$setting['text_data_business1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">desc </label>
              <input type="text" class="form-control phone-mask" name="title_desc_reason1" id="title_desc_reason1" value="<?php echo @$setting['title_desc_reason1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">desc tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_desc_reason_en1" id="title_desc_reason_en1" value="<?php echo @$setting['title_desc_reason_en1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">image reason 1</label>
               <?php showUploadFile('image_reason1','image_reason1', @$setting['image_reason1'],2);?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">text số liệu 2</label>
              <input type="text" class="form-control phone-mask" name="text_data_business2" id="text_data_business2" value="<?php echo @$setting['text_data_business2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">desc </label>
              <input type="text" class="form-control phone-mask" name="title_desc_reason2" id="title_desc_reason2" value="<?php echo @$setting['title_desc_reason2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">desc tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_desc_reason_en2" id="title_desc_reason_en2" value="<?php echo @$setting['title_desc_reason_en2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">image reason 2</label>
               <?php showUploadFile('image_reason2','image_reason2', @$setting['image_reason2'],3);?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">text số liệu 3</label>
              <input type="text" class="form-control phone-mask" name="text_data_business3" id="text_data_business3" value="<?php echo @$setting['text_data_business3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">desc </label>
              <input type="text" class="form-control phone-mask" name="title_desc_reason3" id="title_desc_reason3" value="<?php echo @$setting['title_desc_reason3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">desc tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_desc_reason_en3" id="title_desc_reason_en3" value="<?php echo @$setting['title_desc_reason_en3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">image reason 3</label>
               <?php showUploadFile('image_reason3','image_reason3', @$setting['image_reason3'],4);?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-home2" role="tabpanel">
          <div class="card-body row ">
            aaa
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive title</label>
              <input type="text" class="form-control phone-mask" name="exclusive_title1" id="exclusive_title1" value="<?php echo @$setting['exclusive_title1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive title en</label>
              <input type="text" class="form-control phone-mask" name="exclusive_title1_en" id="exclusive_title1_en" value="<?php echo @$setting['exclusive_title1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive desc</label>
              <input type="text" class="form-control phone-mask" name="exclusive_desc1" id="exclusive_desc1" value="<?php echo @$setting['exclusive_desc1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive desc en</label>
              <input type="text" class="form-control phone-mask" name="exclusive_desc1_en" id="exclusive_desc1_en" value="<?php echo @$setting['exclusive_desc1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive text</label>
              <input type="text" class="form-control phone-mask" name="exclusive_text1" id="exclusive_text1" value="<?php echo @$setting['exclusive_text1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive text en</label>
              <input type="text" class="form-control phone-mask" name="exclusive_text1_en" id="exclusive_text1_en" value="<?php echo @$setting['exclusive_text1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive poster 1</label>
               <?php showUploadFile('poster_exclusive1','poster_exclusive1', @$setting['poster_exclusive1'],5);?>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive title 2</label>
              <input type="text" class="form-control phone-mask" name="exclusive_title2" id="exclusive_title2" value="<?php echo @$setting['exclusive_title2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive title 2 en</label>
              <input type="text" class="form-control phone-mask" name="exclusive_title2_en" id="exclusive_title2_en" value="<?php echo @$setting['exclusive_title2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive desc 2</label>
              <input type="text" class="form-control phone-mask" name="exclusive_desc2" id="exclusive_desc2" value="<?php echo @$setting['exclusive_desc2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive desc 2 en</label>
              <input type="text" class="form-control phone-mask" name="exclusive_desc2_en" id="exclusive_desc2_en" value="<?php echo @$setting['exclusive_desc2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive text 2</label>
              <input type="text" class="form-control phone-mask" name="exclusive_text2" id="exclusive_text2" value="<?php echo @$setting['exclusive_text2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive text 2 en</label>
              <input type="text" class="form-control phone-mask" name="exclusive_text2_en" id="exclusive_text2_en" value="<?php echo @$setting['exclusive_text2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive poster 2</label>
               <?php showUploadFile('poster_exclusive2','poster_exclusive2', @$setting['poster_exclusive2'],6);?>
            </div>


          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-founder" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">id slide</label>
              <input type="text" class="form-control phone-mask" name="slide_business" id="slide_business" value="<?php echo @$setting['slide_business'];?>"/>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-specificaions" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề</label>
              <input type="text" class="form-control phone-mask" name="zoom_title" id="zoom_title" value="<?php echo @$setting['zoom_title'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="zoom_title_en" id="zoom_title_en" value="<?php echo @$setting['zoom_title_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">DESC</label>
              <input type="text" class="form-control phone-mask" name="zoom_desc" id="zoom_desc" value="<?php echo @$setting['zoom_desc'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Desc tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="zoom_desc_en" id="zoom_desc_en" value="<?php echo @$setting['zoom_desc_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Exclusive poster 2</label>
               <?php showUploadFile('zoom_image','zoom_image', @$setting['zoom_image'],7);?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-coaching" role="tabpanel">
          <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Link video coaching</label>
              <input type="text" class="form-control phone-mask" name="link_video_coaching1" id="link_video_coaching1" value="<?php echo @$setting['link_video_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề </label>
              <input type="text" class="form-control phone-mask" name="title_coaching1" id="title_coaching1" value="<?php echo @$setting['title_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="title_coaching1_en" id="title_coaching1_en" value="<?php echo @$setting['title_coaching1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 1</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching1" id="text_description_coaching1" value="<?php echo @$setting['text_description_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 1 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching1_en" id="text_description_coaching1_en" value="<?php echo @$setting['text_description_coaching1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 2</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching2" id="text_description_coaching2" value="<?php echo @$setting['text_description_coaching2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 2 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching2_en" id="text_description_coaching2_en" value="<?php echo @$setting['text_description_coaching2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 3</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching3" id="text_description_coaching3" value="<?php echo @$setting['text_description_coaching3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 3 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching3_en" id="text_description_coaching3_en" value="<?php echo @$setting['text_description_coaching3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 4</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching4" id="text_description_coaching4" value="<?php echo @$setting['text_description_coaching4'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 4 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching4_en" id="text_description_coaching4_en" value="<?php echo @$setting['text_description_coaching4_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 5</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching5" id="text_description_coaching5" value="<?php echo @$setting['text_description_coaching5'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 5 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching5_en" id="text_description_coaching5_en" value="<?php echo @$setting['text_description_coaching5_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 6</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching6" id="text_description_coaching6" value="<?php echo @$setting['text_description_coaching6'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 6 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching6_en" id="text_description_coaching6_en" value="<?php echo @$setting['text_description_coaching6_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 7</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching7" id="text_description_coaching7" value="<?php echo @$setting['text_description_coaching7'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 7 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description_coaching7_en" id="text_description_coaching7_en" value="<?php echo @$setting['text_description_coaching7_en'];?>"/>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Link video coaching</label>
              <input type="text" class="form-control phone-mask" name="link_video1_coaching1" id="link_video1_coaching1" value="<?php echo @$setting['link_video1_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề </label>
              <input type="text" class="form-control phone-mask" name="title1_coaching1" id="title1_coaching1" value="<?php echo @$setting['title1_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng annh</label>
              <input type="text" class="form-control phone-mask" name="title1_coaching1_en" id="title1_coaching1_en" value="<?php echo @$setting['title1_coaching1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 1</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching1" id="text_description1_coaching1" value="<?php echo @$setting['text_description1_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 1 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching1_en" id="text_description1_coaching1_en" value="<?php echo @$setting['text_description1_coaching1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 2</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching2" id="text_description1_coaching2" value="<?php echo @$setting['text_description1_coaching2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 2 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching2_en" id="text_description2_coaching2_en" value="<?php echo @$setting['text_description2_coaching2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 3</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching3" id="text_description1_coaching3" value="<?php echo @$setting['text_description1_coaching3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 1 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description3_coaching3_en" id="text_description3_coaching3_en" value="<?php echo @$setting['text_description3_coaching3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 4</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching4" id="text_description1_coaching4" value="<?php echo @$setting['text_description1_coaching4'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 4 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description4_coaching4_en" id="text_description4_coaching4_en" value="<?php echo @$setting['text_description4_coaching4_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 5</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching5" id="text_description1_coaching5" value="<?php echo @$setting['text_description1_coaching5'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 5 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description5_coaching5_en" id="text_description5_coaching5_en" value="<?php echo @$setting['text_description5_coaching5_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 6</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching6" id="text_description1_coaching6" value="<?php echo @$setting['text_description1_coaching6'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 6 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description6_coaching6_en" id="text_description6_coaching6_en" value="<?php echo @$setting['text_description6_coaching6_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 7</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching7" id="text_description1_coaching7" value="<?php echo @$setting['text_description1_coaching7'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 7 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description7_coaching7_en" id="text_description7_coaching7_en" value="<?php echo @$setting['text_description7_coaching7_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">image</label>
               <?php showUploadFile('image_coaching','image_coaching', @$setting['image_coaching'],8);?>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề </label>
              <input type="text" class="form-control phone-mask" name="title2_coaching1" id="title2_coaching1" value="<?php echo @$setting['title2_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tiêu đề tiếng annh</label>
              <input type="text" class="form-control phone-mask" name="title2_coaching1_en" id="title2_coaching1_en" value="<?php echo @$setting['title2_coaching1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 1</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching1" id="text_description2_coaching1" value="<?php echo @$setting['text_description2_coaching1'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 1 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching1_en" id="text_description2_coaching1_en" value="<?php echo @$setting['text_description2_coaching1_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 2</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching2" id="text_description2_coaching2" value="<?php echo @$setting['text_description2_coaching2'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 2 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description1_coaching2_en" id="text_description1_coaching2_en" value="<?php echo @$setting['text_description1_coaching2_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 3</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching3" id="text_description2_coaching3" value="<?php echo @$setting['text_description2_coaching3'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 3 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching3_en" id="text_description2_coaching3_en" value="<?php echo @$setting['text_description2_coaching3_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 4</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching4" id="text_description2_coaching4" value="<?php echo @$setting['text_description2_coaching4'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 4 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching4_en" id="text_description2_coaching4_en" value="<?php echo @$setting['text_description2_coaching4_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 5</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching5" id="text_description2_coaching5" value="<?php echo @$setting['text_description2_coaching5'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 5 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching5_en" id="text_description2_coaching5_en" value="<?php echo @$setting['text_description2_coaching5_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 6</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching6" id="text_description2_coaching6" value="<?php echo @$setting['text_description2_coaching6'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 6 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching6_en" id="text_description2_coaching6_en" value="<?php echo @$setting['text_description2_coaching6_en'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 7</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching7" id="text_description2_coaching7" value="<?php echo @$setting['text_description2_coaching7'];?>"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">text mô tả 7 tiếng anh</label>
              <input type="text" class="form-control phone-mask" name="text_description2_coaching7_en" id="text_description2_coaching7_en" value="<?php echo @$setting['text_description2_coaching7_en'];?>"/>
            </div>


          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-prize" role="tabpanel">
          <div class="card-body row ">
          <div class="col-md-6 mb-3">
              <label class="form-label">Slide giải thưởng và doanh nghiệp</label>
              <input type="text" class="form-control phone-mask" name="id_slide_price" id="id_slide_price" value="<?php echo @$setting['id_slide_price'];?>"/>
            </div>
          </div>
        </div>
      <div class="card-body">
        <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
      </div>
    </div>
<?= $this->Form->end() ?>
</div>
