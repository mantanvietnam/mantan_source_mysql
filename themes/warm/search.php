<?php getHeader();
global $urlThemeActive;
?>  
<main>
        <section id="search-news">
            <div class="container">
                <div class="search-news-title">
                    <h1>Search Results</h1>
                    <div class="title-divide-section"></div>
                </div>
                <div class="list-search-news">
                    <div class="row">
                    	 <?php if(!empty($listPosts)){ 
                        		foreach($listPosts as $key => $item){
                        		?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="search-news-item">
                                <div class="search-news-item-img">
                                    <img src="<?php echo @$item->image ?>" alt="">
                                </div>

                                <div class="search-news-item-content">
                                    <p><?php echo @$item->title ?></p>
                                </div>

                                <div class="search-news-button">
                                    <a href="/<?php echo @$item->slug ?>.html" tabindex="0">Read more <img src="../asset/img/arow.png" alt=""></a>
                                </div>
                            </div>
                        </div>

                         <?php }} ?>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>



<?php getFooter();?>