<?php
getHeader();
global $urlThemeActive;

?>
<style>
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

h1 {
    color: #333;
    font-size: 36px;
    font-weight: bold;
    margin: 0;
}

/* Section Heading */
.section-heading h1 {
    color: #4CAF50;
    margin-bottom: 20px;
}

/* Container Styles */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 15px;
}

/* Card Styles */
.card-event {
    border: none;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: #fff;
}

.card-event:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
}

.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 3px solid #4CAF50;
}

.card-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.card-time {
    font-size: 14px;
    color: #888;
    margin-bottom: 15px;
}

.card-body {
    padding: 15px;
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 10px 15px;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    color: #4CAF50;
    background-color: transparent;
    border: 2px solid #4CAF50;
    border-radius: 5px;
    text-align: center;
    transition: all 0.3s ease;
}

.btn:hover {
    background-color: #4CAF50;
    color: #fff;
    text-decoration: none;
}

/* Pagination Styles */
.page-number {
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 50%;
    background-color: #fff;
    transition: all 0.3s ease;
}

.page-number a {
    text-decoration: none;
    color: #333;
}

.page-number.active {
    background-color: #4CAF50;
    border-color: #4CAF50;
    color: #fff;
}

.page-number:hover {
    background-color: #4CAF50;
    color: #fff;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-event {
        margin-bottom: 20px;
    }

    .btn {
        width: 100%;
    }
}

</style>
<main class="">
    <section id="su-kien-list-event">
        <div class="background" style="background-image: url('<?= $urlThemeActive ?>assets/lou_img/su-kien-list-event.png')">
            <section class="section-heading mt-4">
                <h1 class="text-uppercase text-center">TIN TỨC</h1>
                <br></br>
            </section>
            <div class="container">
                <div class="row g-3">
                    <?php
                    if (!empty($listPosts)) {
                        foreach ($listPosts as $item) { ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card card-event">
                                    <img class="card-img-top" src="<?php echo $item->image ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">
                                            <?php echo $item->title ?>
                                        </h5>
                                        <p class="card-time">
                                             <?php echo date('d/m/Y', $item->time) ?>
                                        </p>
                                        <a href="/<?php echo $item->slug ?>.html" class="btn button-outline-primary-custom">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>

                <div class='container mt-4 d-flex gap-2'>
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
        for ($i = $startPage; $i <= $endPage; $i++) {
            $activeClass = ($page == $i) ? 'active' : '';
            echo '<div class="d-flex align-items-center justify-content-center page-number ' . $activeClass . '">
                    <a href="' . $urlPage . $i . '">' . $i . '</a>
                  </div>';
        }

    }
    ?>
</div>

            </div>
        </div>
    </section>
</main>

<?php
getFooter(); ?>