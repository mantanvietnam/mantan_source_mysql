<?php getHeader();?>
<main id="courses-page">
    <section class="courses-header">
        <div class="container">
            <h1>
                <?php 
                    echo (!empty($category->name))?$category->name:'Hãy bắt đầu khóa học để <span class="text-secondary-custom">phát triển</span> bản thân';
                ?>
            </h1>
            <div class="header-search-contain">
                <div class="header-search">
                    <form action="/search-lesson" method="key" id="form_search">
                        <input name="key" onchange="$('#form_search').submit();" type="text" class="form-control" value="<?php echo @$_GET['key'];?>">
                        <button type="submit" class="btn-circle">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <section class="all-courses mb-3">
        <div class="container">
            <div class="row g-4" loop="3">
                <?php 
                if(!empty($listLessons)){
                    foreach ($listLessons as $key => $value) {
                        $popupLogin = (empty($session->read('infoUser')))?'return showPopup(\'login-check\');':'';

                        echo '<div class="col-12 col-md-6 col-lg-4">
                                <a href="/course/'.$value->slug.'.html" onclick="'.$popupLogin.'">
                                    <div class="card-course-contain-index">
                                        <div class="card">
                                            <div class="card-top">
                                                <img src="'.$value->image.'" class="card-img-top" alt="">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">'.$value->title.'</h5>
                                                <p class="card-text">
                                                    <span>Thời gian học: </span>
                                                    <b>'.$value->time_learn.' phút</b>
                                                </p>
                                                <p class="card-text">
                                                    <span>Số lượt xem: </span>
                                                    <b>'.number_format($value->view).'</b>
                                                </p>
                                            </div>
                                            <div class="card-bottom">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-custom-primary">Tham gia ngay</button>
                                                        
                                                    <button class="btn text-primary-custom">
                                                        Làm bài thi
                                                    </button>
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
    </section>
    
    <section class="paginate">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
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
                            
                            echo '<li class="page-item prev">
                                    <a class="page-link" href="'.$urlPage.'1" aria-label="Previous">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </a>
                                </li>';
                            
                            for ($i = $startPage; $i <= $endPage; $i++) {
                                $active= ($page==$i)?'active':'';

                                echo '<li class="page-item">
                                        <a class="page-link '.$active.'" href="'.$urlPage.$i.'">'.$i.'</a>
                                      </li>';
                            }

                            echo '<li class="page-item next">
                                        <a class="page-link" href="'.$urlPage.$totalPage.'" aria-label="Next">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                    </li>';
                        }
                        ?>
                        
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</main>
<?php getFooter();?>
