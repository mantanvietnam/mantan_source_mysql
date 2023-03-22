<?php getHeader();?>

<main class="container mt-3 mt-lg-5">
    <div class="row mb-2">
        <section class="more-news">
            <div class="container">
                <article class="blog-post">
	                <h1 class="blog-post-title text-primary-custom border-bottom"><b><?php echo $category->name;?></b></h1>
	            </article>

	            <div class="row g-3" loop="6">
	                <?php 
	                    if(!empty($listAlbums)){
	                        foreach ($listAlbums as $item) {
	                            echo '  
	                                    <div class="col-12 col-md-6 col-lg-4">
	                                        <a href="/'.$item->slug.'.html">
	                                            <div class="card-ne-contain">
	                                                <div class="card">
	                                                    <img src="'.$item->image.'" class="card-img-top" alt="'.$item->title.'">
	                                                    <div class="card-body">
	                                                        <div class="d-flex align-items-center card-head">
	                                                            <div class="title">
	                                                                <h5 class="mb-0">'.$item->title.'</h5>
	                                                            </div>
	                                                        </div>
	                                                        <p class="card-text mb-0">'.$item->description.'</p>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </a>
	                                    </div>
	                                    ';
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


    </div>

</main>

<?php getFooter();?>