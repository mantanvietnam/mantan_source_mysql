<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-packageworkouts-listPackageWorkouts">Gói luyện tập </a> /  Thông tin gói luyện tập
  </h4>

  <!-- Basic Layout nav-align-top-->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-body">
            <p><?php echo @$mess; ?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-12">
                  <div class=" mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin gói tập
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          bài tập
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-image" aria-selected="false">
                        giá gói tập
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-vn" aria-controls="navs-top-image" aria-selected="false">
                        Nội dung tập tiếng Việt
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-en" aria-controls="navs-top-image" aria-selected="false">
                        Nội dung tập tiếng Anh
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề tiếng Việt</label>
                              <input required type="text" class="form-control phone-mask" name="title" id="title" placeholder="tiên đề tiếng Việt" value="<?php echo @$data->title;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề tiếng Anh</label>
                              <input required type="text" class="form-control phone-mask" name="title_en" id="title_en" placeholder="tiên đề tiếng Anh" value="<?php echo @$data->title_en;?>" />
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
                              <label class="form-label">Hình minh họa (*)</label>
                               <input type="file" class="form-control phone-mask" name="image" id="image" value=""/>
                              <?php
                              if(!empty($data->image)){
                                echo '<br/><img src="'.$data->image.'" width="80" />';
                              }
                              ?>
                            </div>
                          </div>

                          <div class="col-md-6">
                            
                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn tiếng việt</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description" placeholder="Mô tả ngắn tiếng Vệt" id="description"><?php echo @$data->description;?></textarea>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn tiếng anh</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description_en" placeholder="Mô tả ngắn tiếng Anh" id="description_en"><?php echo @$data->description_en;?></textarea>
                            </div>
                            
                          </div>
                          
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                          <div class="row">
                           <?php if(!empty($dataWorkout)){
                            
                                foreach($dataWorkout as $key => $item){
                                    $checks = '';
                                    if(!empty($data->workout)){
                                      if(in_array($item->id, $data->workout)){
                                              $checks = 'checked';
                                            }
                                    }
                                    
                                    echo '<div class="mb-3 col-md-3"><input type="checkbox" '.$checks.' name="id_workout[]" value="'.$item->id.'"> <label class="form-label">'.$item->title.'</label></br>
                                            <img src="' . $item->image . '" width="60" />';

                                echo '</div>';
                                }
                            } ?>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">

                        <div class="row">
                          <div class="col-md-12"> 
                            <table class="table table-bordered table-striped table-hover mb-none text-center mb-3">
                             <thead>
                              <tr>
                                <th>tiêu đề giá </th>
                                <th>giá </th>
                                <th>số ngày tập</th>
                                <th>trạng thái giá</th>
                              </tr>
                            </thead>
                            <tbody id="tbodyfeedback">  
                             
                                  <tr class="gradeX" id="trfeedback-">
                                    <td>
                                      <input type="text" class="form-control phone-mask mb-3" name="title_price[1]"  value="<?php echo @$data->price_package[1]['title']; ?>" placeholder=" tiêu đề giá tiếng việt"/>
                                      <input type="text" class="form-control phone-mask" name="title_price_en[1]"  value="<?php echo @$data->price_package[1]['title_en']; ?>" placeholder=" tiêu đề giá tiếng Anh"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="price[1]"  value="<?php echo @$data->price_package[1]['price']; ?>"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="number_day[1]"  value="<?php echo @$data->price_package[1]['number_day']; ?>"/>
                                    </td>
                                    <td>
                                      <select class="form-select" name="status_price[1]" id="status">
                                      <option value="default" <?php if(!empty($data->price_package[1]['status']) && @$data->price_package[1]['status']=='default') echo 'selected'; ?> >Mặc định</option>
                                      <option value="not_default" <?php if(!empty($data->price_package[1]['status']) && @$data->price_package[1]['status']=='not_default') echo 'selected'; ?> >Không mặc định</option>
                                      </select>
                                    </td>
                                  </tr>
                                  <tr class="gradeX" id="trfeedback-">
                                    <td>
                                      <input type="text" class="form-control phone-mask mb-3" name="title_price[2]"  value="<?php echo @$data->price_package[2]['title']; ?>" placeholder=" tiêu đề giá tiếng việt"/>
                                      <input type="text" class="form-control phone-mask" name="title_price_en[2]"  value="<?php echo @$data->price_package[2]['title_en']; ?>" placeholder=" tiêu đề giá tiếng Anh"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="price[2]"  value="<?php echo @$data->price_package[2]['price']; ?>"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="number_day[2]"  value="<?php echo @$data->price_package[2]['number_day']; ?>"/>
                                    </td>
                                    <td>
                                      <select class="form-select" name="status_price[2]" id="status">
                                      <option value="default" <?php if(!empty($data->price_package[2]['status']) && @$data->price_package[2]['status']=='default') echo 'selected'; ?> >Mặc định</option>
                                      <option value="not_default" <?php if(!empty($data->price_package[2]['status']) && @$data->price_package[2]['status']=='not_default') echo 'selected'; ?> >Không mặc định</option>
                                      </select>
                                    </td>
                                  </tr>
                                  <tr class="gradeX" id="trfeedback-">
                                    <td>
                                      <input type="text" class="form-control phone-mask mb-3" name="title_price[3]"  value="<?php echo @$data->price_package[3]['title']; ?>" placeholder=" tiêu đề giá tiếng việt"/>
                                      <input type="text" class="form-control phone-mask" name="title_price_en[3]"  value="<?php echo @$data->price_package[3]['title_en']; ?>" placeholder=" tiêu đề giá tiếng Anh"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="price[3]"  value="<?php echo @$data->price_package[3]['price']; ?>"/>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control phone-mask" name="number_day[3]"  value="<?php echo @$data->price_package[3]['number_day']; ?>"/>
                                    </td>
                                    <td>
                                      <select class="form-select" name="status_price[3]" id="status">
                                      <option value="default" <?php if(!empty($data->price_package[3]['status']) && @$data->price_package[3]['status']=='default') echo 'selected'; ?> >Mặc định</option>
                                      <option value="not_default" <?php if(!empty($data->price_package[3]['status']) && @$data->price_package[3]['status']=='not_default') echo 'selected'; ?> >Không mặc định</option>
                                      </select>
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-vn" role="tabpanel">
                         <div class="row">
                            <div class="col-md-12"> 
                             <label class="form-label">Nội dung gói tập tiếng việt</label>
                            <?php showEditorInput('content', 'content', @$data->content);?>
                          </div>
                         
                         </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-en" role="tabpanel">
                           <div class="row">
                              <div class="col-md-12"> 
                                 <label class="form-label">Nội dung tập Tiếng anh </label>
                                <?php showEditorInput('content_en', 'content_en', @$data->content_en);?>
                              </div>
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