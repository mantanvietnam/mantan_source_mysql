<?php getHeader();?>
<style>
	footer {
		display: none;
	}
</style>
<main>
	<section class="box-gallery">
		<div class="container">
			<div class="wrapper-user">
				<div class="head-tab text-center">
					<ul>
						<li>
							<a href="javascript:void(0)" data-tab="tab-1" class="active">
								<svg xmlns="http://www.w3.org/2000/svg" width="529" height="61" viewBox="0 0 529 61" fill="none">
									<path d="M528.161 60.7202H0.53125V30.6699C0.53125 14.1599 13.9113 0.779785 30.4213 0.779785H498.271C514.781 0.779785 528.161 14.1599 528.161 30.6699V60.7202Z" fill="#003B75"/>
								</svg>
								<span>Kho ảnh của bạn</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="content-user">
					<div class="content-tab active" id="tab-1">
						<div class="list-gallery">
							<div class="row">
								<div class="col-md-12 mb-3">
									<a class="btn btn-primary" href="/addImage"><i class="fa-solid fa-plus"></i> Đăng ảnh mới</a>
								</div>
								<?php
								if(!empty($listData)){
									foreach ($listData as $key => $value) {
										$link = '/detailImage/?id='.$value->id;

										echo '	<div class="col-md-3">
													<div class="item-gallery">
														<div class="avarta">
															<div class="avr">
																<a href="'.$link.'">
																	<img src="'.$value->image.'" class="img-fluid w-100" alt="">
																</a>
															</div>
														</div>
														<div class="info d-block">
															<div class="txt-left">
																<h3><a href="'.$link.'">'.$value->name.'</a></h3>
																<div class="row">
																	<div class="col-md-6">'.number_format($value->vote).' like</div>
																	<div class="col-md-6 text-right"><a class="text-white" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteImage/?id='.$value->id.'"><i class="fa-regular fa-trash-can"></i></a></div>
																</div>
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
				</div>
			</div>
		</div>
	</section>
</main>
<?php getFooter();?>