<?php
getHeader();
global $urlThemeActive;
?>
 <main>
        <section class="section-background-index">
            <div class="container-fluid background-index">
                <img src="<?= $urlThemeActive ?>img/background-index.jpg" alt="">
            </div>
        </section>

        <section class="breadcrumb-page">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ </a></li>
                        <li class="breadcrumb-item"><a href="#">Tin tức </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hiện vật
                        </li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-artifacts">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 artifacts-slide">
                        <div class="artifacts-slide-top">
                            <?php if(!empty($data->image)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image2)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image2 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image3)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image3 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image4)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image4 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image5)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image5 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image6)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image6 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image7)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image7 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image8)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image8 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image9)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image9 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image10)){ ?>
                            <div class="artifacts-slide-top-img">
                           		<img src="<?php echo $data->image10 ?>" alt="">
                        	</div>
                        	<?php } ?>
                            
                        </div>

                        <div class="artifacts-slide-bot">
							<?php if(!empty($data->image)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image2)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image2 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image3)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image3 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image4)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image4 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image5)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image5 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image6)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image6 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image7)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image7 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image8)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image8 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image9)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image9 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        	<?php if(!empty($data->image10)){ ?>
                            <div class="artifacts-slide-bot-img">
                           		<img src="<?php echo $data->image10 ?>" alt="">
                        	</div>
                        	<?php } ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 introduc-col">
                        <div class="title-artifacts">
                            <h1><?php echo $data->name ?></h1>
                        </div>
                        <div class="detail-artifacts">
                            <p><span>Người lập phiếu: </span><?php echo $data->voter ?></p>
                            <p><span>Tên di tích: </span><?php echo getHistoricalSite($data->idHistoricalsite)->name; ?></p>
                            <p><span>Địa chỉ: </span><?php echo $data->address ?></p>
                            <p><span>Kí hiệu, mã số ảnh: </span><?php echo $data->sign ?></p>
                            <p><span>Vị trí: </span><?php echo $data->sign ?></p>
                            <p><span>Số lượng: </span><?php echo $data->location ?></p>
                            <p><span>Tờ số: </span><?php echo $data->number ?></p>
                            <p><span>Màu sắc: </span><?php echo $data->color ?></p>
                            <p><span>Chất liệu: </span><?php echo $data->material ?></p>
                            <p><span>Sưu tập: </span><?php echo $data->file ?></p>
                            <p><span>Niên đại: </span><?php echo $data->period ?></p>
                            <p><span>Kỹ thuật chế tác: </span><?php echo $data->technique ?></p>
                            <div class="size-artifacts">
                                <div class="title-artifact-size">Kích thước:&nbsp; </div>
                                <p><?php echo $data->size ?></p>
                            </div>
                            
                            <p><span>Hiện trạng: </span><?php echo $data->current ?></p>
                            <p><span>Phân loại giá trị hiện vật: </span><?php echo $data->classify ?></p>
                            <p><span>Ngày đăng ký: </span><?php echo  date('d-m-Y', $data->registrationdate);  ?></p>
                        </div> 
                    </div>
                </div>
            </div>
        </section>

        <section id="section-introduct" class="mgt-80">
            <div class="container">
                <div class="row">
                    <div class="title-information mgb-32">
                        <p>Khảo tả đặc điểm</p>
                    </div>

                    <div class="content-information">
                        <?php echo $data->introductory ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>