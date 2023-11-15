<?php getHeader(); ?>

    <section class="category">

        <div class="bg-path-category">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="path-category">
                            <p class="path-text">
                                <a href="index.php">
                                    <i>Trang chủ</i>
                                </a> 
                                / 
                                <a href="<?php echo $category->slug;?>.html">
                                    <i><?php echo $category->name;?></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h1 class="h1-color-title-category">
                            <?php echo $category->name;?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 category-list">
                    <div class="all-category">
                        <div class="main-category container">
                            <?php
                            if(!empty($listPosts)){
	                            foreach($listPosts as $notice){   
                                    $link = '/'.$notice->slug.'.html';

                                    echo                               
                                       '
                                       <div class="in-main-category row">
                                            <div class="image-category col-5" style="padding: 0;">
                                                <div class="border-custom-image-2">
                                                    <a href="'.$link.'">
                                                        <img src="'.$notice->image.'" width="100%" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="text-category col-7">
                                                <div class="title-category">
                                                    <div class="border-custom-title">
                                                        <a href="'.$link.'">
                                                            <h6>'.$notice->title.'</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="time-and-author">
                                                    <div class="border-custom-taa">
                                                        <span class="blog-meta-secondary">
                                                            <!-- <span class="blog-author">Author Name</span> -->
                                                            <i class="fa-solid fa-calendar"></i>
                                                            <time class="blog-date" pubdate="" data-animation-role="date">'.date('d/m/Y',$notice->time).'</time>
                                                        </span>
                                                        <span class="view-eye">
                                                            <i class="fa-solid fa-eye"></i>
                                                            <span>'.$notice->view.' lượt xem</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="description-infor">
                                                    <div class="border-custom-di4">
                                                        <span>
                                                        '.$notice->description.'
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-empty" style="height: 25px; border-bottom: 2px solid #ccc; margin-bottom: 20px" ></div>
                                        ';  
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <?php
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

                        if($totalPage>1){
                        ?>
                        <div class="col-sm-12">
                            <div class="direc">
                                <ul class="pagination">
                                    <li class="disabled"><a href="<?php $urlPage . $back ?>">&laquo;</a></li>
                                    <?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
                                        <li class="<?php
                                        if ($i == $page) {
                                            echo 'active';
                                        }
                                        ?>"><a href="<?php echo $urlPage . $i; ?>"><?php echo $i; ?></a></li>
                                    <?php } ?>

                                    <li><a href="<?php $urlPage . $next ?>">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php }?>
                </div>

            </div>
            
        </div>
    </section>

<?php getFooter(); ?>