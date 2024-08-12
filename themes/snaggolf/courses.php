<?php
    getHeader();
?>
<main>
    <section class="page-course adult">
        <div class="container">
            <div class="row">
            <?php if (!empty($listDatacourse[0])): ?>
                <div class="col-12 col-lg-6">
                    <div class="contain">
                        <h1 class="heading-custom adult"><?php echo  $listDatacourse[0]->name?></h1>
                        <p><?php echo  $listDatacourse[0]->description ?></p>
                        <a href="/detailcourse/<?php echo  $listDatacourse[0]->slug ?>.html" class="d-none d-lg-block">
                            <button class="custom-button button-reg">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="img-contain d-flex justify-content-end ">
                        <img src="<?php echo  $listDatacourse[0]->image?>" alt="">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="/detailcourse/<?php echo  $listDatacourse[0]->slug ?>.html" class="d-block d-lg-none btn-mobile">
                        <button class="custom-button button-reg">CHI TIẾT</button>
                    </a>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </section>
    <section class="page-course kid">
        <div class="container">
            <div class="row">
            <?php if (!empty($listDatacourse[1])): ?>
                <div class="col-12 col-lg-6">
                    <div class="contain">
                        <h1 class="heading-custom kid"><?php echo  $listDatacourse[1]->name?></h1>
                        <p><?php echo  $listDatacourse[1]->description ?></p>
                        <a href="/detailcourse/<?php echo  $listDatacourse[1]->slug ?>.html" class="d-none d-lg-block">
                            <button class="custom-button button-reg kid">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="img-contain d-flex justify-content-end ">
                        <img src="<?php echo  $listDatacourse[1]->image?>" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="/detailcourse/<?php echo  $listDatacourse[1]->slug ?>.html" class="d-block d-lg-none btn-mobile">
                            <button class="custom-button button-reg kid">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </section>
    
    <section class="page-course tour">
    <?php if (!empty($listDatacourse[2])): ?>
        <div class="container">
            <div class="row">
           
                <div class="col-12 col-lg-6">
                    <div class="contain">
                        <h1 class="heading-custom tour"><?php echo  $listDatacourse[2]->name?></h1>
                        <p><?php echo  $listDatacourse[2]->description ?></p>
                        <a href="/detailcourse/<?php echo  $listDatacourse[2]->slug ?>.html" class="d-none d-lg-block">
                            <button class="custom-button button-reg tour">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="img-contain d-flex justify-content-end ">
                        <img src="<?php echo  $listDatacourse[2]->image?>" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="/detailcourse/<?php echo  $listDatacourse[2]->slug ?>.html" class="d-block d-lg-none btn-mobile">
                            <button class="custom-button button-reg tour">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </section>
</main>
<?php
getFooter();
?>