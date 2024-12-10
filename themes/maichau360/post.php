<?php


getHeader();
if (!isset($post)) $post = [];
if (!isset($otherPosts)) $otherPosts = [];
?>
    <main class="background-pt"
          style="background-image: url('<?= $urlThemeActive ?>assets/lou_img/su-kien-list-event.png')">
        <section class="breadcrumb-custom">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="/tin-tuc.html">Tin tức</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Bài viết
                        </li>
                    </ol>
                </nav>
            </div>
        </section>
        <section id="skct-article">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12 col-lg-8">
                        <article class="pe-0 pe-lg-5">
                            <div class="head">
                                <h1 class="mb-1"><?= $post->title ?></h1>
                                <span
                                    class="author"><?= $post->author ?> - <?= convert_timestamp($post->time) ?></span>
                            </div>
                            <div class="body">
                                <div class="content">
                                    <p>
                                        <?= str_replace(array("&nbsp;", "&nbsp;", "\t"), "",$post->content); ?>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 col-lg-4">
                        <aside class="">
                            <h3 class="fs-3 mb-4">Tin tức khác</h3>
                            <div class="row g-3">
                                <?php
                                foreach ($otherPosts as $post) {
                                    ?>
                                    <div class="col-12">
                                        <a href="/<?= $post->slug ?>.html" class="d-block text-decoration-none">
                                            <div class="card card-event">
                                                <img class="card-img-top" src="<?= $post->image ?>"
                                                     alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">
                                                        <?= limit_words($post->title) ?>
                                                    </h5>
                                                    <p class="card-time">
                                                        <?= distance_from_now($post->time) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <section class="" id="skct-lien-quan-bottom">
            <div class="container mt-5">
                <h2 class="mb-4">Tin tức liên quan</h2>
                <div class="row g-3 g-lg-4">
                    <?php
                    foreach ($otherPosts as $oPost) {
                        ?>
                        <div class="col-12 col-lg-4  ">
                            <a href="/<?= $oPost->slug ?>.html" class="d-block text-decoration-none">
                                <div class="card card-event">
                                    <img class="card-img-top" src="<?= $oPost->image ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">
                                            <?= limit_words($oPost->title) ?>
                                        </h5>
                                        <p class="card-time">
                                            <?= distance_from_now($oPost->time) ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();
