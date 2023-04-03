<?php getHeader();?>

<main class="container mt-3 mt-lg-5">
    <div class="row g-4" id="main-post">
        <div class="col-lg-8">
            <h6 class="pb-4 mb-3 fst-italic border-bottom d-flex justify-content-between">
                <span><?php echo date('d/m/Y', $video->time_create);?></span>
                <span><?php echo $video->author;?></span>
            </h6>

            <article class="blog-post">
                <h1 class="blog-post-title text-primary-custom"><?php echo $video->title;?></h1>
                <!-- Content bài viết -->
                <div class="content-here">
                    <?php 
                        if(!empty($video->youtube_code)){
                            echo '<iframe width="100%" height="515" src="https://www.youtube.com/embed/'.$video->youtube_code.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                        }
                    ?>
                </div>
            </article>
        </div>

        <div class="col-lg-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-light rounded">
                    <form action="/search" id="form_search">
                        <div class="form-contain">
                            <label for="">Tìm kiếm</label>
                            <input name="key" onchange="$('#form_search').submit();" type="text" class="form-control" value="<?php echo @$_GET['key'];?>">
                        </div>
                    </form>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Chủ đề đào tạo</h4>
                    <ol class="list-unstyled mb-0">
                    	<?php 
                    	if(!empty($listCategoryLessons)){
                    		foreach ($listCategoryLessons as $key => $value) {
                    			echo '<li><a href="/training/'.$value->slug.'.html">'.$value->name.'</a></li>';
                    		}
                    	}
                    	?>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Khóa học mới nhất</h4>
                    <ol class="list-unstyled" loop="5">
                    	<?php 
                    	if(!empty($listLessons)){
                    		foreach ($listLessons as $key => $value) {
                                $popupLogin = (empty($session->read('infoUser')))?'return showPopup(\'login-check\');':'';
                                
                    			echo '	<li class="mb-2">
				                            <a href="/course/'.$value->slug.'.html" onclick="'.$popupLogin.'">
				                                <div class="more-courses-in-news p-1">
				                                    <div class="d-flex align-items-center">
				                                        <img src="'.$value->image.'" alt="" class="me-2">
				                                        <div class="more-content">
				                                            <h6 class="mb-0">'.$value->title.'</h6>
				                                        </div>
				                                    </div>
				                                </div>
				                            </a>
				                        </li>';
                    		}
                    	}
                    	?>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <section class="chuong-trinh-dao-tao more-news">
            <div class="container">
                <h2 class="text-center text-secondary-custom">Video khác</h2>
                <div class="my-slider" loop="5">
                	<?php 
                	if(!empty($otherVideos)){
                		foreach ($otherVideos as $key => $value) {
                			echo '<div class="item p-3">
                					<a href="/'.$value->slug.'.html">
				                        <div class="card-ne-contain">
				                            <div class="card">
				                                <img src="'.$value->image.'" class="card-img-top" alt="'.$value->title.'">
				                                <div class="card-body">
			                                        <div class="d-flex align-items-center card-head">
			                                            <div class="title">
			                                                <h5 class="mb-0">'.$value->title.'</h5>
			                                            </div>
			                                        </div>
			                                        <p class="card-text mb-0">'.$value->description.'</p>
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
    </div>

</main>

<?php getFooter();?>