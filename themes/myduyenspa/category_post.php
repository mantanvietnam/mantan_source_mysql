<?php global $themeSettings;getHeader();?>
		

		<section class="section5">
			<div class="container">
				<div class="baiviet">
					<h1><?php echo $category['name'];?></h1>
				</div>
				<div class="row">
					<?php
						if(!empty($listPosts)){
							foreach($listPosts as $item){
								
								echo '<div class="col-md-4">
										<div class = "thumbnail">
											<img src = "'.$item->image.'" alt ="" style="width:100%;">
										</div>

										<div class ="item">
											<h5>'.$item->title.'</h5>
											<p>'.$item->description.'</p>
											<a href="/'.@$item->slug.'.html" title="">Xem tiếp >></a>
										</div>	
									</div>';
							}
						}
					?>
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
		</section>
<?php getFooter();?>