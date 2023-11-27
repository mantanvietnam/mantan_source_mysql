<?php getHeader();?>
<main class="main-footer">
	<section class="box-gallery">
		<div class="container">
			<div class="title text-center">
				<span>Phòng tranh</span>
				<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#CA2026"/>
				</svg>
			</div>
			<div class="list-gallery">
				<div class="row">
					<?php
					if(!empty($listData)){
						// debug($listData);
						foreach ($listData as $key => $value) {
							$link = '/detailImage/?id='.$value->id;

							echo '	<div class="col-md-3">
										<div class="item-gallery">
											<div class="avarta">
												<div class="avr">
													<a href="'.$link.'"><img src="'.$value->image.'" class="img-fluid w-100" alt=""></a>
												</div>
											</div>
											<div class="info">
												<div class="txt-left">
													<h3><a href="'.$link.'">'.$value->name.'</a></h3>
													<div class="icon"><img src="'.$urlThemeActive.'/images/user.svg" class="img-fluid" alt=""></div>
												</div>
												<div class="heart">
													<span>'.number_format($value->vote).'</span>
													<div class="icon"><img src="'.$urlThemeActive.'/images/heart.svg" class="img-fluid" alt=""></div>
												</div>
												<div class="txt-right">
													<h3>Mã: GODRAW'.$value->id.'</h3>
												</div>
											</div>
										</div>
									</div>';
						}
					}
					?>
				</div>
			</div>

			<div class="pagination">
				<ul>
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
		                  
		                echo '<li><a href="'.$urlPage.'1"><img src="/plugins/go_draw/view/agency/images/arr-left.svg" class="img-fluid" alt=""></a></li>';
		                  
		                for ($i = $startPage; $i <= $endPage; $i++) {
		                    $active= ($page==$i)?'active':'';

		                    echo '<li><a href="'.$urlPage.$i.'" class="'.$active.'">'.$i.'</a></li>';
		                }

		                echo '<li><a href="'.$urlPage.$totalPage.'"><img src="/plugins/go_draw/view/agency/images/arr-right.svg" class="img-fluid"></a></li>';
		            }
		            ?>
				</ul>
			</div>
		</div>
	</section>
</main>
<?php getFooter();?>