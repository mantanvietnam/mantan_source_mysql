<?php include __DIR__.'/../header.php';?>

<style>
	footer {
		display: none;
	}
	@media (max-width: 767px) {
		.view-all {
			display: none;
		}
	}
</style>
<main>
	<section class="box-gallery">
		<div class="container">
			<div class="content-detail-gallery">
				<div class="title text-center">
					<span>Thông tin combo</span>
					<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
					</svg>
				</div>
				<div class="content-gallery-detail">
					<div class="row">
						<div class="col-md-6">
							<div class="avar-detail">
								<div class="avr"><img src="<?php echo $infoCombo->image;?>" class="img-fluid w-100" alt=""></div>
							</div>
							<div class="title-detail">
								<div class="content-head-title">
									<h1><?php echo $infoCombo->name;?></h1>
									<div class="price"><?php echo number_format($infoCombo->price);?>đ</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="txt-detail-gallery">
								<div class="detail">
									<div class="top-detail">
										<h2>Combo gồm có:</h2>
										<div class="desc">
											<table class="table table-bordered">
											  <thead>
											    <tr>
											      <th scope="col">STT</th>
											      <th scope="col">Sản phẩm</th>
											      <th scope="col">Số lượng</th>
											    </tr>
											  </thead>
											  <tbody>
											    <tr>
											      <th scope="row">1</th>
											      <td>Mark</td>
											      <td>Otto</td>
											    </tr>
											  </tbody>
											</table>
										</div>
									</div>
									<div class="social text-right">
										<div class="btn-main">
											<a href="">ĐẶT MUA</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php include __DIR__.'/../footer.php';?>