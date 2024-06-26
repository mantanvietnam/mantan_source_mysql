<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/courses">Khóa học </a> /</span>
    Danh sách khóa học
  </h4>
  <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách khóa học</h5>
              </div>
              <div class="card-body">
                <div class="row g-4" loop="3">
                    <?php 
                        if(!empty($listData)){
                            foreach ($listData as $key => $value) {
                                echo '<div class="col-12 col-md-6 col-lg-4">
                                        <a href="/course/'.$value->slug.'.html">
                                            <div class="card-course-contain-index">
                                                <div class="card">
                                                    <div class="card-top">
                                                        <img src="'.$value->image.'" class="card-img-top" alt="">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">'.$value->title.'</h5>
                                                        <p class="card-text">
                                                            <span>Chủ đề: </span>
                                                            <b>'.$value->name_category.'</b>
                                                        </p>
                                                        <p class="card-text">
                                                            <span>Số bài học: </span>
                                                            <b>'.number_format($value->number_lesson).' bài</b>
                                                        </p>
                                                        <p class="card-text">
                                                            <span>Số lượt xem: </span>
                                                            <b>'.number_format($value->view).'</b>
                                                        </p>
                                                    </div>
                                                    <div class="card-bottom">
                                                        <div class="text-center mb-3">
                                                            <button class="btn btn-primary">Học ngay</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
                            }
                        }
                    ?>
                             
                </div>
                
              </div>
            </div>
        </div>

        <!-- Phân trang -->
        <div class="demo-inline-spacing">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <?php
                if($totalPage>0){
                    if ($page > 5) {
                        $startPage = $page - 5;
                    } else {
                        $startPage = 1;
                    }

                    if ($totalPage > $page + 5) {
                        $endPage = $page + 5;
                    } else {
                        $endPage = $totalPage;
                    }
                    
                    echo '<li class="page-item first">
                            <a class="page-link" href="'.$urlPage.'1"
                              ><i class="tf-icon bx bx-chevrons-left"></i
                            ></a>
                          </li>';
                    
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $active= ($page==$i)?'active':'';

                        echo '<li class="page-item '.$active.'">
                                <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                              </li>';
                    }

                    echo '<li class="page-item last">
                            <a class="page-link" href="'.$urlPage.$totalPage.'"
                              ><i class="tf-icon bx bx-chevrons-right"></i
                            ></a>
                          </li>';
                }
              ?>
            </ul>
          </nav>
        </div>
        <!--/ Basic Pagination -->

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>