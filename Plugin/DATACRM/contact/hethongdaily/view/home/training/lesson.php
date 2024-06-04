<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/courses">Khóa học</a> /</span>
    Bài học / <?php echo @$data->title;?>
  </h4>
  <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
              <div class="card-body" id="video-learning">
                <div class="video-learning-title">
                    <div class="container text-left">
                        <h3><?php echo @$data->title;?></h3>
                        <p>
                            Diễn giả: <span class="author text-primary-custom"><?php echo @$data->author;?></span>
                        </p>
                    </div>
                </div>

                <div class="video-learning-iframe mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="iframe-contain d-flex justify-content-center">
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo @$data->youtube_code;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                if(!empty($tests)){
                  echo '<div class="row">
                          <div class="col-lg-12 text-center">
                            <a class="btn btn-danger" href="/test/'.$tests[0]->slug.'.html">LÀM BÀI THI</a>
                          </div>
                        </div>';
                }
                ?>

                <?php 
                if(!empty($data->content)){
                  echo '<div class="video-learning-detail">
                            <div class="container">
                                <div class="row g-3 g-lg-0 justify-content-lg-between">
                                    <div class="col-12 col-lg-12">
                                        <div class="contain pe-lg-5">
                                            <h3 class="text-primary-custom">Nội dung bài học</h3>
                                            <div class="nav-content">
                                                <div class="course-detail">
                                                    <div class="content">'.$data->content.'</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                ?>
                
                <?php if(!empty($otherData)){ ?>
                <div class="more-courses">
                    <div class="container">
                        <h3 class="">Các bài học liên quan</h3>
                        
                        <div class="my-slider-more-courses" loop="3">
                            <?php
                              foreach ($otherData as $key => $item) {
                                  
                                  echo '<div class="item p-3">
                                              <div class="card-course-contain-index">
                                                  <a href="/lesson/'.$item->slug.'.html">
                                                      <div class="card">
                                                          <div class="card-top">
                                                              <img src="'.$item->image.'" alt="'.$item->title.'">
                                                          </div>
                                                          <div class="card-body">
                                                              <h5 class="card-title">'.$item->title.'</h5>
                                                              <p class="card-text">
                                                                  <span>Diễn giả: </span>
                                                                  <b>'.$item->author.'</b>
                                                              </p>
                                                              <p class="card-text">
                                                                  <span>Thời gian: </span>
                                                                  <b>'.$item->time_learn.' phút</b>
                                                              </p>
                                                              <p class="card-text">
                                                                  <span>Số lượt xem: </span>
                                                                  <b>'.number_format($item->view).'</b>
                                                              </p>
                                                          </div>
                                                          <div class="card-bottom">
                                                              <div class="text-center justify-content-between align-items-center">
                                                                  <button class="btn btn-primary">Học ngay</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </a>
                                              </div>
                                          </div>';
                              }
                            ?>
                        </div>
                    </div>
                </div>
                <?php }?>
                
              </div>
            </div>
        </div>


    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>