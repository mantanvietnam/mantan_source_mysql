<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();
?>

<main>
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <a href="/"><img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-opportunities">
            <div class="container">
                <div class="title-section">
                    <h1>Opportunities</h1>
                    <div class="title-divide-section"></div>
                </div>
    
                <div class="title-sub-section">
                    <h2>Terms of reference/ Call for biddings</h2>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <?php if(!empty($listData)){
                        foreach($listData as $key => $item){
                     ?>

                     <div class="col-lg-4 col-md-4 col-sm-6 col-12 opportunity-box">
                        <div class="opportunity-box-inner">
                            <div class="opportunity-text">
                                <div class="opportunity-date">
                                    <p><?php echo  $item->time_create; ?></p>
                                </div>
    
                                <div class="opportunity-title">
                                    <p>Request for Quotations: </p>
                                </div>
    
    
                                <div class="opportunity-title-sub">
                                    <p><?php echo $item->name; ?></p>
                                </div>
    
                                <div class="opportunity-content">
                                    <p>Description: </p>
                                </div>
    
                                <div class="opportunity-content-sub">
                                    <p><?php echo $item->description; ?></p>
                                </div>
                            </div>

                            <div class="opportunity-button">
                                <a href="<?php echo $item->link; ?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/asset/img/down-arrow_2989995.svg" alt=""></a>
                            </div>
                        </div>
                    </div> 
                <?php }} ?>
                    
                </div>

                <div class="button-loadmore">
                    <button id="loadMoreBtn" onclick="loadMore()">Load more</button>
                </div>
            </div>
        </section>
    </main>
    

    <script>
        // Ẩn phần tử
        var listContainer = document.querySelector('#section-opportunities .row');
        var items = listContainer.querySelectorAll('.opportunity-box');
        var isExpanded = false;

        // Ẩn tất cả phần tử trừ 3 phần tử đầu tiên
        for (var i = 3; i < items.length; i++) {
        items[i].classList.add('hidden');
        }

        function loadMore() {
        if (!isExpanded) {
            // Loại bỏ lớp 'hidden' từ tất cả các phần tử nếu chúng đã được ẩn
            items.forEach(function (item) {
            item.classList.remove('hidden');
            });
            isExpanded = true;
            // document.getElementById('loadMoreBtn').textContent = 'Rút gọn';
        } else {
            // Ẩn bớt các phần tử sau 3 phần tử đầu tiên
            for (var i = 3; i < items.length; i++) {
            items[i].classList.add('hidden');
            }
            isExpanded = false;
            // document.getElementById('loadMoreBtn').textContent = 'Xem thêm';
        }
    }

    </script>
<?php getFooter();?>