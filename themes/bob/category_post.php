<?php 
    global $settingThemes;
?>

<?php getHeader();?>
    <main>
        <section id="product" class="">
            <div class="banner-product max-h-70vh max-h-80vh maxheight-480 overflow-hiden">
                <img src="http://bobdecor.com.vn/upload/admin/files/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                <div class="absolute bottom-0 w-100 linear-background--banner" >
                    <div class="container">
                        <div class="title-banner-product">
                            <h1><?php echo $category->name ?></h1>
                        </div>                    
                    </div>
                </div>
            </div>
        </section>

        <div class="navbar-project bg-gray-50">
            <div class="container">                      
                <div class="tab-content list-library" id="">
                    <div class="tab-pane active" id="thuvien" role="tabpanel" aria-labelledby="thuvien-tab">
                        <div class="grid grid-col-3 gap-32 mt-3">
                            <?php 
                            if(!empty($listPosts)){
                                foreach ($listPosts as $key => $value) {
                                    $link = '/'.$value->slug.'.html';

                                    echo '  <div class="library-item">
                                                <a href="'.$link.'" class="relative image-list-library ds-block">
                                                    <div class="cursor-pointer setting-img-library overflow-hidden">
                                                        <img src="'.$value->image.'" alt="">
                                                    </div>
                                                </a>
                                                <div class="blog-news mg-top-20 hover-left">
                                                    <span class="time-news-main">'.date('d/m/Y', $value->time).'</span>
                                                </div>
                                                <div class="text-new-main mg-top-8">
                                                    <a href="'.$link.'" class="mg-bottom-8 ds-block title-news-main">
                                                        <span class="duration-700 ease-linear bg-no-repeat hover-underline">'.$value->title.'</span>
                                                    </a>
                                                    <p class="description-news-main">'.$value->description.'</p>
                                                </div>
                                            </div>';
                                }
                            }
                            ?>
                        </div>

                        <nav aria-label="Page navigation" class="mg-top-64">
                            <ul class="pagination justify-center gap-10">
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
                                              ><i class="fa-solid fa-chevron-left"></i></a>
                                          </li>';
                                    
                                    for ($i = $startPage; $i <= $endPage; $i++) {
                                        $active= ($page==$i)?'active':'';

                                        echo '<li class="page-item '.$active.'">
                                                <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                              </li>';
                                    }

                                    echo '<li class="page-item last">
                                            <a class="page-link" href="'.$urlPage.$totalPage.'"
                                              ><i class="fa-solid fa-chevron-right"></i></a>
                                          </li>';
                                }
                              ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>                
        </div>
    </main>

<?php getFooter();?>