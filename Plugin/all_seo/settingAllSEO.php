<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/all_seo-settingAllSEO">All SEO</a> /</span>
    Cài đặt
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt SEO</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-General" aria-controls="navs-top-General" aria-selected="true">
                          General
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Category" aria-controls="navs-top-Category" aria-selected="false">
                          Category
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Post" aria-controls="navs-top-Post" aria-selected="false">
                          Post - Page
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Expand" aria-controls="navs-top-Expand" aria-selected="false">
                          Expand
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-General" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Ảnh mặc định khi chia sẻ link</label>
                              <?php showUploadFile('image', 'image', @$data_value['general']['image'], 0);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Tiêu đề</label>
                              <input type="text" value="<?php echo @$data_value['general']['title'];?>" name="generalTitle" class="form-control" placeholder="%title%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Từ khóa</label>
                              <input type="text" value="<?php echo @$data_value['general']['keyword'];?>" name="generalKeyword" class="form-control" placeholder="%keyword%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <input type="text" value="<?php echo @$data_value['general']['description'];?>" name="generalDescription" class="form-control" placeholder="%description%" />
                            </div>

                            <div class="mb-3">
                              <ul>
                                <li>%title%: default title system</li>
                                <li>%keyword%: default keyword system</li>
                                <li>%description%: default description system</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-Category" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề</label>
                              <input type="text" value="<?php echo @$data_value['category']['title'];?>" name="categoryTitle" class="form-control" placeholder="%title%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Từ khóa</label>
                              <input type="text" value="<?php echo @$data_value['category']['keyword'];?>" name="categoryKeyword" class="form-control" placeholder="%keyword%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <input type="text" value="<?php echo @$data_value['category']['description'];?>" name="categoryDescription" class="form-control" placeholder="%description%" />
                            </div>

                            <div class="mb-3">
                              <ul>
                                <li>%title%: default title system</li>
                                <li>%keyword%: default keyword system</li>
                                <li>%description%: default description system</li>
                                <li>%categoryName%: the default is the name of news categories</li>
                                <li>%categoryKeyword%: the default is the name of news keyword</li>
                                <li>%categoryDescription%: the default is the name of news description</li>
                                <li>%page%: default number page</li>
                                <li>%pageMore%: default number page larger one</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-Post" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề</label>
                              <input type="text" value="<?php echo @$data_value['post']['title'];?>" name="postTitle" class="form-control" placeholder="%title%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Từ khóa</label>
                              <input type="text" value="<?php echo @$data_value['post']['keyword'];?>" name="postKeyword" class="form-control" placeholder="%keyword%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <input type="text" value="<?php echo @$data_value['post']['description'];?>" name="postDescription" class="form-control" placeholder="%description%" />
                            </div>

                            <div class="mb-3">
                              <ul>
                                <li>%title%: default title system</li>
                                <li>%keyword%: default keyword system</li>
                                <li>%description%: default description system</li>
                                <li>%postName%: default post title</li>
                                <li>%postKeyword%: default post keyword</li>
                                <li>%postDescription%: default post description</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-Expand" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề</label>
                              <input type="text" value="<?php echo @$data_value['expand']['title'];?>" name="expandTitle" class="form-control" placeholder="%title%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Từ khóa</label>
                              <input type="text" value="<?php echo @$data_value['expand']['keyword'];?>" name="expandKeyword" class="form-control" placeholder="%keyword%" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <input type="text" value="<?php echo @$data_value['expand']['description'];?>" name="expandDescription" class="form-control" placeholder="%description%" />
                            </div>

                            <div class="mb-3">
                              <ul>
                                <li>%title%: default title system</li>
                                <li>%keyword%: default keyword system</li>
                                <li>%description%: default description system</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>