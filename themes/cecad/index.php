
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
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber1'];?>" data-speed="50"></h1>
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber1'];?>
                            </p>

                        </div>
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber2'];?>" data-speed="100"></h1>
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber2'];?>
                            </p>
                        </div>
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber3'];?>" data-speed="100"></h1>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber3'];?>
                            </p>
                        </div>
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber4'];?>" data-speed="100"></h1>
                            </div>
                            <p>
                                <?= @$settingThemes['contentnumber4'];?>
                            </p>
                        </div>
                        <div class="counter_item count-start">
                            <div>
                                <h1 class="counter" data-number="<?= @$settingThemes['countnumber5'];?>" data-speed="100"></h1>
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
                        <?php if (!empty($listDataslugproject[0])): ?>
                            <a href="category-project/<?php echo  $listDataslugproject[0]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-1">
                                    <p>
                                        <?= $listDataslugproject[0]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDataslugproject[0]->image;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDataslugproject[1])): ?>
                            <a href="category-project/<?php echo  $listDataslugproject[1]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-2">
                                    <p>
                                        <?= $listDataslugproject[1]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDataslugproject[1]->image;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDataslugproject[2])): ?>
                            <a href="category-project/<?php echo  $listDataslugproject[2]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-3">
                                    <p>
                                        <?= $listDataslugproject[2]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDataslugproject[2]->image;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDataslugproject[3])): ?>
                            <a href="category-project/<?php echo  $listDataslugproject[3]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-4">
                                    <p>
                                        <?= $listDataslugproject[3]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDataslugproject[3]->image;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDataslugproject[4])): ?>
                        <a href="category-project/<?php echo  $listDataslugproject[4]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-5">
                                    <p>
                                        <?= $listDataslugproject[4]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDataslugproject[4]->image;?>" alt="">
                                </div>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($listDataslugproject[5])): ?>
                        <a href="category-project/<?php echo  $listDataslugproject[5]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-6">
                                    <p>
                                        <?= $listDataslugproject[5]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDataslugproject[5]->image;?>" alt="">
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

                                <div class="projects-items">
                                    <div class="projects-items-img">
                                        <a href="/project/<?= $item->slug;?>">
                                            <img src="<?php echo $item->image; ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="projects-items-info">
                                        <a href=""><?php echo $item->name; ?></a>
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
                    <?php if(!empty($listDataPost)){
                            foreach($listDataPost as $item){ ?>
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
                        <img src="<?php echo $value->image;?>" alt="">
                    </div>
                <?php } ?>
                </div>
            </div>

        </section>
    </main>

<?php 
    getFooter();
?>
