<?php
    getHeader();
?>
<?php 
$classes = [ 'adult','kid', 'tour']; 
$totalClasses = count($classes); 
$index = 0;
?>
    <main>
    <?php foreach ($listDatacourse as $key => $value): ?>
        <?php 
             $currentClass = $classes[$index];    
             $index = ($index + 1) % $totalClasses; 
        ?>
        <section class="page-course <?php echo $currentClass; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="contain">
                            <h1 class="heading-custom <?php echo $currentClass; ?>"><?php echo  $value->name?></h1>
                            <p><?php echo  $value->description ?></p>
                            <a href="/detailcourse/<?php echo  $value->slug ?>.html" class="d-none d-lg-block">
                                <button class="custom-button button-reg">CHI TIẾT</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="img-contain d-flex justify-content-end ">
                            <img src="<?php echo  $value->image?>" alt="">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="/detailcourse/<?php echo  $value->slug ?>.html" class="d-block d-lg-none btn-mobile">
                            <button class="custom-button button-reg">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
    </main>
<?php
getFooter();
?>