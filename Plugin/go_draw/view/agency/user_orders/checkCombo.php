<?php include __DIR__.'/../header.php';?>
<style>
	footer {
		/* display: none; */
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
								<span>COMBO SẢN PHẨM BÁN</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="content-user">
					<div class="content-tab active" id="tab-1">
						<div class="list-gallery">
							<div class="row">
								<?php
								if(!empty($list_combo)){
									foreach ($list_combo as $key => $value) {
										echo '	<div class="col-md-3">
													<div class="item-gallery">
														<div class="avarta">
															<div class="avr">
																<a href="/viewComboAgency/?id='.$value->id.'">
																	<img src="'.$value->image.'" class="img-fluid w-100" alt="">
																</a>
															</div>
														</div>
														<div class="info d-block">
															<div class="txt-left">
																<h3><a href="/viewComboAgency/?id='.$value->id.'">'.$value->name.'</a></h3>
																<div class="row">
																	<div class="col-md-8">'.number_format($value->price).'đ</div>
																</div>
															</div>
														</div>
													</div>
												</div>';
									}
								}else{
									echo '<p class="text-danger">Trong kho đã hết combo sản phẩm</p>';
								}
								?>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include __DIR__.'/../footer.php';?>