<div class="col-3 tab-intro-right">
    <form class="d-flex form-search">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
        <button class="btn btn-outline-success" pac type="submit">Search</button>
    </form>

    <div class="contact">
        <h3 class="text-uppercase">Liên hệ tư vấn</h3>
        <div class="text-contact">
            <p><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
            </svg>
            
            </span><?php echo $contactSite['email'];?></p>
            <p><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
            </svg>
            
            </span><?php echo $contactSite['phone'];?></p>
        </div>
    </div>

    <div class="title-small-right">
        <h4 class="text-uppercase">hạng mục tin tức</h4>
    </div>

    <div class="nav-small-right">
        <?php 
            if(!empty($category_post)){
                foreach ($category_post as $key => $value){
                    echo'
                    <div class="nav-item">
                        <a href="'.$value->slug.'.html">'.$value->name.'</a>
                    </div>';
                }
            }
        ?>
    </div>

    <div class="title-small-right">
        <h4 class="text-uppercase">Tin tức mới</h4>
    </div>

    <div class="list-news-right">
        <div class="list-news-small">
            <div class="intro-news-small">
            <?php 
                if(!empty($news)){
                    foreach ($news as $key => $value){
                        echo'
                        <a href="'.$value->slug.'.html" class="link-news">
                            <img src="'.$value->image.'" alt="">
                            <div class="info-news-small">
                                <div class="author">
                                    <span>Đăng bởi:</span>
                                    <span class="name-author">'.$value->author.'</span>
                                </div>
                                <p class="title-news ellipsis block-ellipsis-title-news">'.$value->title.'</p>
                                <p class="description-news ellipsis block-ellipsis">'.$value->description.'</p>
                                <p class="btn-news">Chi tiết <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                                </span></p>
                            </div>
                        </a> ';
                    }
                }
            ?>
                                                        
            </div>
        </div>
    </div>

    <!-- <div class="banner-ads">
        <a href="">
            <img src="./asset/image/images1920558_4053279_16.jpg" alt="">
        </a>
    </div> -->

</div>