<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-courses-listCourse">Khóa học</a> /</span>
    Thông tin khóa học
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khóa học</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
            <div class="row">
                <div class="col-md-12">
                  <div class="nav-align-top mb-4">
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-question" aria-controls="navs-top-question" aria-selected="true">
                           Thông tin
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-answer1" aria-controls="navs-top-answer1" aria-selected="false">
                          Nhưng điều đạt được sau khóa học
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-unit" aria-selected="false">
                            Hãy thử nghiệm khóa học này nếu bạn muốn
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-4" aria-controls="navs-top-4" aria-selected="false">
                            BANNER
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-5" aria-controls="navs-top-5" aria-selected="false">
                            Những điều bạn sẽ nhận được
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-6" aria-controls="navs-top-6" aria-selected="false">
                            Câu hỏi khóa học
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Tên khóa học (*)</label>
                                <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Tên khóa học tiếng anh (*)</label>
                                <input  type="text" class="form-control phone-mask" name="titleen" id="titleen" value="<?php echo @$data->titleen;?>" />
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
                                <label class="form-label">Mã video Youtube</label>
                                <input type="text" class="form-control phone-mask" name="youtube_code" id="youtube_code" value="<?php echo @$data->youtube_code;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">màu chủ đạo</label>
                                <input type="text" class="form-control phone-mask" name="color" id="color" value="<?php echo @$data->color;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">màu text</label>
                                <input type="text" class="form-control phone-mask" name="colortext" id="colortext" value="<?php echo @$data->colortext;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Giá cũ</label>
                                <input  type="number" class="form-control phone-mask" name="price_old" id="price_old" value="<?php echo @$data->price_old;?>" />
                              </div>
                              <!-- <div class="mb-3">
                                <label class="form-label">Hiển thị</label>
                                <div class="input-group input-group-merge">
                                  <select class="form-select" name="public" id="public">
                                    <option value="0">Dành riêng cho đại lý</option>
                                    <option value="1" <?php if(!empty($data->public)) echo 'selected'; ?> >Chung cho cộng đồng</option>
                                  </select>
                                </div>
                              </div> -->
                            </div>

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Hình minh họa</label>
                                <?php showUploadFile('image','image',@$data->image,0);?>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Mô tả ngắn</label>
                                <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Mô tả ngắn tiếng anh</label>
                                <textarea maxlength="160" rows="5" class="form-control" name="descriptionen" id="descriptionen"><?php echo @$data->descriptionen;?></textarea>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Số lượt xem</label>
                                <input disabled type="number" class="form-control phone-mask" name="view" id="view" value="<?php echo (int) @$data->view;?>" />
                              </div>
                               <div class="mb-3">
                                <label class="form-label">Giá mới</label>
                                <input  type="number" class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Giới thiệu khóa học</label>
                                <?php showEditorInput('content', 'content', @$data->content);?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Giới thiệu khóa học tiếng anh</label>
                                <?php showEditorInput('introduceen', 'introduceen', @$data->introduceen);?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-answer1" role="tabpanel">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label">Những điều đạt được sau khóa học</label>
                                  <?php showEditorInput('achieved', 'achieved', @$data->achieved);?>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label">Những điều đạt được sau khóa học</label>
                                  <?php showEditorInput('achieveden', 'achieveden', @$data->achieveden);?>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Hãy thử khóa học này nếu bạn muốn</label>
                                    <?php showEditorInput('trycourse', 'trycourse', @$data->trycourse);?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Hãy thử khóa học này nếu bạn muốn tiếng anh</label>
                                    <?php showEditorInput('trycourseen', 'trycourseen', @$data->trycourseen);?>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-4" role="tabpanel">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Nội dung trong banner</label>
                                    <input  type="text" class="form-control phone-mask" name="textbanner" id="textbanner" value="<?php echo @$data->textbanner;?>" />
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Nội dung trong banner tiếng anh</label>
                                    <input  type="text" class="form-control phone-mask" name="textbanneren" id="textbanneren" value="<?php echo @$data->textbanneren;?>" />
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">ảnh banner</label>
                                    <?php showUploadFile('imagebanner','imagebanner',@$data->imagebanner,1);?>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-5" role="tabpanel">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Bạn sẽ nhận được gì</label>
                                    <?php showEditorInput('willyouget', 'willyouget', @$data->willyouget);?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Bạn sẽ nhận được gì tiếng anh</label>
                                    <?php showEditorInput('wgeten', 'wgeten', @$data->wgeten);?>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-6" role="tabpanel">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">thông tin câu hỏi</label>
                                    <?php showEditorInput('questioncourse', 'questioncourse', @$data->questioncourse);?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">thông tin câu hỏi tiếng anh</label>
                                    <?php showEditorInput('questionen', 'questionen', @$data->questionen);?>
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