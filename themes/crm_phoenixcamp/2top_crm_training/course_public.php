<?php getHeader();?>
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/css/training.css" />
    <main>
        <section id="section-post" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="post-title">
                            <h1><?php echo @$data->title;?></h1>
                        </div>

                        <div class="post-date">
                            Lĩnh vực: <span class="author text-primary-custom"><?php echo @$data->name_category;?></span>
                        </div>

                        <div class="post-content" id="video-learning">
                            <div class="video-learning-iframe mb-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="iframe-contain d-flex justify-content-center">
                                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo @$data->youtube_code;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <section class="list-bai-hoc-contain rounded-4 p-4">
                                                <div class="head d-flex align-items-center mb-3">
                                                    <h5 class="mb-0 text-primary-custom"><?php echo count($lesson);?> bài học</h5>
                                                </div>
                                                <div class="list">
                                                  <ul class="list-unstyled" loop="30">
                                                    <?php 
                                                      if(!empty($lesson)){
                                                          foreach ($lesson as $key => $value) {
                                                              echo '<li class="mb-3">
                                                                          <a href="/lesson-public/'.$value->slug.'.html">
                                                                              <div class="lesson-item active">
                                                                                  <div class="d-flex align-items-center">
                                                                                      <img src="'.$value->image.'" class="thumb me-3" alt="">
                                                                                      <div>
                                                                                          <p class="mb-0">'.$value->title.'</p>
                                                                                          <span>'.$value->time_learn.' phút</span>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </a>
                                                                      </li>';
                                                          }
                                                      }
                                                    ?>
                                                  </ul>
                                                </div>
                                                <p></p>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                                if(!empty($data->content)){
                                  echo '<div class="row">
                                            <div class="col-12 col-lg-12">
                                                <h3 class="text-primary-custom">Nội dung đào tạo</h3>
                                                <div class="content">'.$data->content.'</div>
                                            </div>
                                        </div>';
                                }
                            ?>
                        </div>

                        <div id="section-blog-other" class="section-padding">
                            <div class="section-blog-other-inner">
                                <h2 class="section-title" data-aos="zoom-in">
                                    <span> Các bài học khác</span>
                                    <div class="title-divide-section"></div>
                                </h2>
                
                                <div class="blog-list" data-aos="zoom-out-right">
                                    <?php
                                    if(!empty($otherData)){
                                        foreach ($otherData as $item) {
                                            echo '  <div class="blog-item">
                                                        <div class="blog-img">
                                                             <a href="/course-public/'.@$item->slug.'.html"><img src="'.@$item->image.'" alt=""></a>
                                                        </div>
                                
                                                        <div class="blog-detail">
                                                            <div class="blog-title">
                                                                <a href="/course-public/'.@$item->slug.'.html">
                                                                    <h4>'.@$item->title.'</h4>
                                                                </a>
                                                            </div>
                                
                                                            <div class="blog-meta">
                                                                <span>'.number_format($item->view).' lượt xem</span>
                                                            </div>
                                
                                                            <div class="blog-devide">
                                                                <hr class="solid">
                                                            </div>
                                
                                
                                                            <div class="blog-description">
                                                                <p>'.@$item->description.'</p>
                                                            </div>
                                                        </div>
                                                    </div>';
                                        } 
                                    } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      
    </main>

<?php getFooter();?>