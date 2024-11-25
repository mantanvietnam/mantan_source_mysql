
<?php 
    getHeader();
    global $settingThemes;
?>

<section class="schools">
                <div class="container">
                    <!-- Stats Counter -->
                    <div class="schools__stats row text-center mb-5">
                        <h2 class="schools__title col-lg-3"><?=@$settingThemes['titleoperational']?></h2>
                        <div class="parameter col-lg-9">
                            <div class="schools__stat">
                                <h3 class="schools__stat-number"><?=@$settingThemes['numberactive']?></h3>
                                <p class="schools__stat-label"><?=@$settingThemes['yearactive']?></p>
                            </div>
                            <div class="schools__stat">
                                <h3 class="schools__stat-number"><?=@$settingThemes['numbercustomer']?></h3>
                                <p class="schools__stat-label"><?=@$settingThemes['customer']?></p>
                            </div>
                            <div class="schools__stat">
                                <h3 class="schools__stat-number"><?=@$settingThemes['numberevents']?></h3>
                                <p class="schools__stat-label"><?=@$settingThemes['events']?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Schools Grid -->
                    <div class="schools__grid row g-4">
                        <?php foreach ($id_active as $data):?>
                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $data->image;?>" alt="Trường THPT chuyên Lào Cai" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title"><?php echo $data->title;?></h4>
                                    <p class="schools__card-address"><?php echo $data->description;?></p>
                                    <a href="<?php echo $data->link;?>" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>

                    </div>

                </div>
            </section>
<?php getFooter();?>