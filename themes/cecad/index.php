
<?php 
    getheader();
    global $settingThemes;
?>
    <main>
        <section id="banner-section">
            <div class="container">
                <div class="swiper-block">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                        <?php foreach ($slide_home as $key => $value) { ?>  
                            <div class="swiper-slide">
                                <img src="<?php echo $value->image; ?>" alt="">

                                <div class="banner-title">
                                    <h2><?php echo $value->title; ?></h2>
                                    <p><?php echo $value->description; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <div class="banner-icon">
                        <a style="display: none;" href="<?php echo !empty(@$settingThemes['instagram']) ? htmlspecialchars(@$settingThemes['instagram']) : ''; ?>"><i class="fa-brands fa-instagram"></i></>
                        <a href="<?php echo !empty(@$settingThemes['facebook']) ? htmlspecialchars(@$settingThemes['facebook']) : ''; ?>"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="<?php echo !empty(@$settingThemes['youtube']) ? htmlspecialchars(@$settingThemes['youtube']) : ''; ?>"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>

        </section>

        <section id="count-section">
            <div class="container">
                <div class="count">
                    <div class="title-section">
                        <h2><?= @$settingThemes['title2'];?></h2>
                    </div>
                    <div class="counter_wrapper">
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber1'];?>" data-increment="300"></h1>
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber1'];?>
                            </p>

                        </div>
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber2'];?>" data-increment="10"></h1>
                                
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber2'];?>
                            </p>
                        </div>
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber3'];?>" data-increment="1"></h1>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber3'];?>
                            </p>
                        </div>
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber4'];?>" data-increment="1"></h1>
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber4'];?>
                            </p>
                        </div>
                        <div class="counter_item count-start" style="display:none;">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber5'];?>" data-increment="20"></h1>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber5'];?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="majors-section">
            <div class="container">
                <div class="title-section">
                    <h3><?= @$settingThemes['titlesmall'];?></h3>
                    <h2><?= @$settingThemes['titlelarge'];?></h2>
                    <p><?= @$settingThemes['contenttitle4'];?></p>
                </div>
                <div class="majors">
                    <div class="majors-img">
                        <img src="<?= @$settingThemes['imageactionbeetween'];?>" alt="">
                    </div>

                    <div class="majors-list">
                        <?php if (!empty($listDatafield[5])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[5]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-1">
                                    <p>
                                        <?= $listDatafield[5]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[5]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[4])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[4]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-2">
                                    <p>
                                        <?= $listDatafield[4]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[4]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[0])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[0]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-3">
                                    <p>
                                        <?= $listDatafield[0]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[0]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[2])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[2]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-4">
                                    <p>
                                        <?= $listDatafield[2]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[2]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[1])): ?>
                        <a href="/detailfield/<?php echo  $listDatafield[1]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-5">
                                    <p>
                                        <?= $listDatafield[1]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[1]->icon;?>" alt="">
                                </div>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[3])): ?>
                        <a href="/detailfield/<?php echo  $listDatafield[3]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-6">
                                    <p>
                                        <?= $listDatafield[3]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[3]->icon;?>" alt="">
                                </div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="projects-section">
            <div class="container">
                <div class="bg-section">
                    <div class="title-section">
                        <h3><?= @$settingThemes['titlesmal5'];?></h3>
                        <h2><?= @$settingThemes['titlelarge5'];?></h2>
                    </div>
                    <div class="swiper1">
                        <div class="swiper-wrapper">
                        <?php if(!empty($listDataproduct_projects)){
                                        foreach($listDataproduct_projects as $item){ ?>
                            <div class="swiper-slide">
                
                                <a href="/project/<?= $item->slug;?>">
                                    <div class="projects-items">
                                        
                                            <div class="projects-items-img">
                                                    <img src="<?php echo $item->image; ?>" alt=""> 
                                            </div>
                                            <div class="projects-items-info">
                                                <p><?php echo $item->name; ?></p>
                                                <ul>
                                                    <li>
                                                        Thời gian thực hiện: <span><?php echo $item->year; ?></span>
                                                    </li>
                                                    <li>
                                                        Địa điểm: <span><?php echo $item->address; ?></span>
                                                    </li>
                                                    <li>
                                                        Cơ quan tài trợ: <span><?php echo $item->donor; ?></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        
                                    </div>
                                </a>

                            </div>
                        <?php }} ?>

                        </div>

                        <div class="swiper-button-next swiper-button">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="swiper-button-prev swiper-button">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>

                </div>
            </div>
        </section>

        <section id="news-section">
            <div class="container">
                <div class="bg-section">
                    <div class="title-section">
                        <h3><?= @$settingThemes['titlesmal6'];?></h3>
                        <h2><?= @$settingThemes['titlelarge6'];?></h2>
                    </div>

                    <div class="home-news-list">
                    <?php if(!empty($listDatatop)){
                            foreach($listDatatop as $item){ ?>
                        <div class="home-news-items">
                            <a href="<?php echo @$item->slug ?>.html">
                                <div class="home-news-img">
                                    <img src="<?= $item->image;?>" alt="">
                                </div>
                                <div class="home-news-content">
                                    <div class="home-news-thum">
                                        <p><?= $item->keyword;?></p>
                                        <span><?php echo date('d/m/Y', $item->time);?></span>
                                    </div>
                                    <div class="home-news-name">
                                        <p>
                                            <?= $item->title;?>
                                        </p>
                                    </div>
                                    <div class="home-news-sub">
                                        <p> <?= $item->description;?></p>
                                    </div>
                                    <div class="home-news-btn">
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }} ?>

                    </div>
                </div>
            </div>
            </div>
        </section>

        <section id="partner-section">
            <div class="container">
                <div class="title-section">
                    <h3>
                        <?= @$settingThemes['titlenlock7'];?>
                    </h3>
                </div>
                <div class="partner-list">
                <?php foreach ($slide_partner as $key => $value) { ?> 
                    <div class="partner-items">
                        <a href="<?php echo $value->link?>"><img src="<?php echo $value->image;?>" alt=""></a>
                    </div>
                <?php } ?>
                </div>
            </div>

        </section>
    </main>

<?php 
    getFooter();
?>
