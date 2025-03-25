<?php

getHeader();
if (!isset($post)) $post = [];
if (!isset($otherPosts)) $otherPosts = [];
?>
<style>
/* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

a {
    color : blue;
}

h1, h2, h3, h4, .card-title {
    font-weight: 700;
    color: #222;
}

p, .author {
    color: #555;
    font-size: 15px;
}

/* Breadcrumb */
.breadcrumb {
    background-color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
}

.breadcrumb-item a {
    color: #007bff;
    font-weight: 500;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Article Section */
#skct-article .head h1 {
    font-size: 28px;
    margin-bottom: 10px;
    color: #222;
    border-left: 5px solid #4caf50;
    padding-left: 10px;
}

#skct-article .author {
    font-size: 14px;
    color: #888;
    margin-bottom: 20px;
}

#skct-article .content {
    font-size: 16px;
    line-height: 1.8;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
}

/* Card Styles */
.card-event {
    border: none;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-event:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
}

.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}

.card-title {
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.card-time {
    font-size: 14px;
    color: #888;
    margin-bottom: 10px;
}

/* Button Style */
.btn {
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.button-outline-primary-custom {
    background-color: #fff;
    color: #4caf50;
    border: 2px solid #4caf50;
}

.button-outline-primary-custom:hover {
    background-color: #4caf50;
    color: #fff;
}

/* Related News Section */
#skct-lien-quan-bottom h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #222;
    border-left: 5px solid #4caf50;
    padding-left: 10px;
}

#skct-lien-quan-bottom .card-event {
    margin-bottom: 15px;
}

/* Footer Section */
footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

footer a {
    color: #4caf50;
    text-decoration: none;
}

footer a:hover {
    color: #fff;
    text-decoration: underline;
}

/* Responsive Adjustments */
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
      style="background-image: url('<?= htmlspecialchars($urlThemeActive) ?>assets/lou_img/su-kien-list-event.png')">
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
                            <h1 class="mb-2"><?= htmlspecialchars($post->title) ?></h1>
                            <span class="author"><?= htmlspecialchars($post->author) ?> - <?= date('d/m/Y', $post->time) ?></span>
                        </div>
                        <div class="body">
                            <div class="content">
                            <?= !empty($post->content) ? $post->content : "Không có nội dung." ?>

                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-lg-4">
                    <aside>
                        <h3 class="mb-4">Tin tức khác</h3>
                        <div class="row g-3">
                            <?php foreach ($otherPosts as $otherPost): ?>
                                <?php 
                                    $shortTitle = mb_strimwidth($otherPost->title, 0, 60, '...');
                                    $link = '/' . htmlspecialchars($otherPost->slug) . '.html';
                                ?>
                                <div class="col-12">
                                    <a href="<?= $link ?>" class="d-block text-decoration-none">
                                        <div class="card card-event">
                                            <img class="card-img-top" src="<?= htmlspecialchars($otherPost->image) ?>" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3"><?= htmlspecialchars($shortTitle) ?></h5>
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
</main>
<?php
getFooter();
?>
