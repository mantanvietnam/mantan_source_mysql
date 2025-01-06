<?php

getHeader();
if (!isset($post)) $post = [];
if (!isset($otherPosts)) $otherPosts = [];
?>
<style>
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 0;
}

h1, h2, h3, .card-title {
    font-weight: bold;
    color: #333;
}

p, .author {
    color: #555;
}

/* Breadcrumb */
.breadcrumb {
    background-color: transparent;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: #4CAF50;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

/* Article Section */
#skct-article .head h1 {
    font-size: 28px;
    margin-bottom: 10px;
}

#skct-article .author {
    font-size: 14px;
    color: #777;
}

#skct-article .content {
    font-size: 16px;
    line-height: 1.8;
}

/* Card Styles */
.card-event {
    border: none;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
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
    margin-bottom: 10px;
}

.card-time {
    font-size: 14px;
    color: #777;
}

/* Related News Section */
#skct-lien-quan-bottom h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    #skct-article .content {
        font-size: 14px;
    }

    .card-event {
        margin-bottom: 20px;
    }
}

</style>
<main class="background-pt"
      style="background-image: url('<?= $urlThemeActive ?>assets/lou_img/su-kien-list-event.png')">
    <section class="breadcrumb-custom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="/tin-tuc.html" class="text-decoration-none">Tin tức</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                </ol>
            </nav>
        </div>
    </section>
    <section id="skct-article">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <article>
                        <div class="head mb-4">
                            <h1 class="mb-2"><?= $post->title ?></h1>
                            <span class="author"><?= $post->author ?> - <?= date('d/m/Y', $post->time) ?></span>
                        </div>
                        <div class="body">
                            <div class="content">
                                <?= nl2br(htmlspecialchars_decode($post->content)) ?>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-lg-4">
                    <aside>
                        <h3 class="mb-4">Tin tức khác</h3>
                        <div class="row g-3">
                            <?php foreach ($otherPosts as $otherPost): ?>
                                <div class="col-12">
                                    <a href="/<?= $otherPost->slug ?>.html" class="d-block text-decoration-none">
                                        <div class="card card-event">
                                            <img class="card-img-top" src="<?= $otherPost->image ?>" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3"><?= $otherPost->title ?></h5>
                                                <p class="card-time"><?= date('d/m/Y', $otherPost->time) ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <section id="skct-lien-quan-bottom" class="mt-5">
        <div class="container">
            <h2 class="mb-4">Tin tức liên quan</h2>
            <div class="row g-3 g-lg-4">
                <?php foreach ($otherPosts as $relatedPost): ?>
                    <div class="col-12 col-lg-4">
                        <a href="/<?= $relatedPost->slug ?>.html" class="d-block text-decoration-none">
                            <div class="card card-event">
                                <img class="card-img-top" src="<?= $relatedPost->image ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title mb-3"><?= $relatedPost->title ?></h5>
                                    <p class="card-time"><?= date('d/m/Y', $relatedPost->time) ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php
getFooter();
?>
