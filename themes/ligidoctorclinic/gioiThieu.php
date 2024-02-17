<?php 
getHeader();
global $themeSetting;
?>
<style>
.wr-content-GT2::-webkit-scrollbar-track,
.wr-content-GT1::-webkit-scrollbar-track
{
	background-color: #e9e9e9;
}

.wr-content-GT2::-webkit-scrollbar,
.wr-content-GT1::-webkit-scrollbar
{
	width: 10px;
	background-color: #F5F5F5;
}

.wr-content-GT2::-webkit-scrollbar-thumb,
.wr-content-GT1::-webkit-scrollbar-thumb
{
	background-color: #00771b;	
}

.wr-content-GT2 > ul li {
	position: relative;
	cursor: pointer;
}

.wr-content-GT2 > ul li[class='']:before {
	transform: rotate(90deg);
}

.wr-content-GT2 > ul li:before {
	content: '';
	position: absolute;
	top: 13px;
	right: 18px;
	height: 15px;
	width: 3px;
	background-color: #fff;
	transition: all 0.2s;
}

.wr-content-GT2 > ul li:after {
	content: '';
	position: absolute;
	top: 19px;
	right: 12px;
	height: 3px;
	width: 15px;
	background-color: #fff;
}


.wr-content-GT1 {
	max-height: 500px;
	overflow: auto;
}
.wr-content-GT2 ul {
	border: none;
	padding-top: 0;
	padding-bottom: 0;
}
.wr-content-GT2 > ul li:not(:last-child) {
	display: flex;
	justify-content: space-between;
	align-items: center;
	background: #00771b;
	color: #fff;
	padding: 8px 35px 8px 15px;
	margin-bottom: 10px;
}
.title-gioi-thieu {
	font-size: 2.5rem;
}

@media only screen and (max-width: 991px) {
	.wr-content-GT2 {
		margin-top: 30px;
		padding-right: 5px;
	}
	.wr-content-GT2 ul {
		padding: 0;
	}
	.title-gioi-thieu {
		font-size: 2.2rem;
	}
}

@media only screen and (max-width: 991px) {
	.title-gioi-thieu {
		font-size: 1.8rem;
	}
}

</style>
<div class="container-fluid set-pd-0 banner">
	<img src="<?php echo @$themeSetting['Option']['value']['bannerGT'] ?>" alt="">
</div>
	<div class="container">
		<div class="path path-detail-notice">
			<a href="/">Trang chủ</a> / <span>VIỆN THẨM MỸ LIGI DOCTOR CLINIC</span>
		</div>
		<div class="row">
			<h1 class="col-12 title-cate title-detail-notice">VIỆN THẨM MỸ LIGI DOCTOR CLINIC</h1>
			<div class="col-12 title-gioi-thieu">Chặng đường và sứ mệnh!</div>
			<div class="col-12 wr-content-notice">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-xl-7 wr-content-GT1">
					<?php echo @$themeSetting['Option']['value']['CTpostGioiThieu1'] ?>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-xl-5 wr-content-GT2">
						<ul>
							<?php
							$i=0;
							if(!empty($themeSetting['Option']['value']['changdg'])) { 
								foreach ($themeSetting['Option']['value']['changdg'] as $key => $value) {
								 	if(!empty($value['changdgTitle1'])) { ?>
								 		<li data-toggle="collapse" data-target="#gioiThieu<?php echo $i ?>"><span><?php echo $value['changdgTitle1'] ?></span></li>
								 		<div class="collapse" id="gioiThieu<?php echo $i ?>">
								 			<?php echo @$value['changdg1'] ?>
										</div>
								 	<?php
								 	}
								 	$i++;
								} 
							} ?>
						</ul>
					</div>
					<div class="col-12">
						<?php echo @$themeSetting['Option']['value']['CTpostGioiThieu2'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php getFooter();?>