
<?php getHeader(); ?>
	<section style="border-top: 1px solid #f0f0f0; padding: 50px 0px;">
		<div class="container">
			<div class="text-center">
				<h1 style=" font-size: 3em;"><?php echo $category['name'];?></h1>
			</div>
			<div class="row">
				<?php
					if(!empty($listPosts)){
							foreach($listPosts as $item){
							echo '
							<div style="margin-top: 20px" class="col-12 col-sm-6 col-md-6 col-lg-4">
								<div class="blog_item">
									<div class="blog_item_bg">
										<img src="'.$item->image.'" style="width: 100%; height: 170px;">
									</div>
									<div class="blog_item_text">
										<a href="'.$item->slug.'.html"><p>'.$item->title.'</p></a>
									</div>
								</div>
							</div>';
						}
					}
				?>
			</div>	
		</div>
		<nav aria-label="..." style="margin-top: 50px">
		  	<ul class="pagination justify-content-center">
				<?php
				if($page>5){
					$startPage= $page-5;
				}else{
					$startPage= 1;
				}

				if($totalPage>$page+5){
					$endPage= $page+5;
				}else{
					$endPage= $totalPage;
				}
				
				echo '
				<li class="page-item">
		      		<a href="'.$urlPage.$back.'" class="page-link">Trang trước</a>
		    	</li>
				';
				for($i=$startPage;$i<=$endPage;$i++){
					echo '
					<li class="page-item">
			      		<a href="'.$urlPage.$i.'" class="page-link">'.$i.'</a>
			    	</li>
					';
				}
				echo '
				<li class="page-item">
		      		<a href="'.$urlPage.$next.'" class="page-link">Trang sau</a>
		    	</li>
				';
				?>
			</ul>
		</nav>
	</section>
<?php getFooter();?>