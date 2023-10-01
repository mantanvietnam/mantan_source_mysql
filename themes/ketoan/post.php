<?php getHeader();?>
    <article>
        <div class="container setting-news-detail">
            <div class="row">
                <div class="col-9">
                    <form class="d-flex form-search search-mobile">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                        <button class="btn btn-outline-success" pac type="submit">Search</button>
                    </form>
                    <nav class="breadcrumb-news-detail" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item color-post"><a href="#">Tin tức</a></li>
                          <li class="breadcrumb-item color-post active" aria-current="page"><a href="#"><?php echo @$category->name;?></a></li>
                          <li class="breadcrumb-item post-now" aria-current="page"><a href="#"></a></li>

                        </ol>
                    </nav>
                    <div class="titel-news-detail">
                        <h1 class="text-title"> <?php echo $post->title; ?></h1>
                        <div class="time-news-detail">
                            <p>Đăng bởi: <span><?php echo $post->author; ?></span>  <span><?php echo date('d/m/Y', $post->time); ?></span> - <span><?php echo $post->view; ?></span> lượt xem</p>
                        </div>                        
                    </div>
                    <div class="intro-news-detail">
                        <?php echo $post->content; ?>
                    </div>
                    <div class="related-news">
                        <h4>Bài viết liên quan</h4>
                        <?php 
                            if(!empty($otherPosts)){
                                foreach($otherPosts as $key => $value){
                                    echo '<a href="'.$value->slug.'.html"><p>'.$value->title.'</p></a>';
                                }
                            }

                        ?>

                    </div>
                </div>
                <div class="col-3 tab-intro-right">
                    <form class="d-flex form-search search-desktop">
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
                              
                              </span>prohoadon1113@gmail.com</p>
                              <p><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                              </svg>
                              
                              </span>0988607410</p>
                        </div>
                    </div>

                    <div class="title-small-right">
                        <h4 class="text-uppercase">hạng mục tin tức</h4>
                    </div>

                    <div class="nav-small-right">
                        <div class="nav-item">
                            <a href="">Kế toán thuế</a>
                        </div>
                        <div class="nav-item">
                            <a href="">Kế toán tổng hợp</a>
                        </div>
                        <div class="nav-item">
                            <a href="">Nghề Nghiệp - Việc Làm</a>
                        </div>
                        <div class="nav-item">
                            <a href="">Chế độ kế toán</a>
                        </div>
                        <div class="nav-item">
                            <a href="">Đào tạo kế toán</a>
                        </div>
                        <div class="nav-item">
                            <a href="">Mẫu biểu chứng từ</a>
                        </div>
                        <div class="nav-item">
                            <a href="">Văn bản pháp luật mới</a>
                        </div>
                        <div class="nav-item">
                            <a href="">Về chúng tôi</a>
                        </div>
                    </div>

                    <div class="title-small-right">
                        <h4 class="text-uppercase">Tin tức mới</h4>
                    </div>

                    <div class="list-news-right">
                        <div class="list-news-small">
                            <div class="intro-news-small">
                                <a href="" class="link-news">
                                    <img src="./asset/image/images1920558_4053279_16.jpg" alt="">
                                    <div class="info-news-small">
                                        <div class="author">
                                            <span>Đăng bởi:</span>
                                            <span class="name-author">Thư Phạm</span>
                                        </div>
                                        <p class="title-news ellipsis block-ellipsis-title-news">MỞ TÀI KHOẢN DOANH NGHIỆP M-SMART | MSB</p>
                                        <p class="description-news ellipsis block-ellipsis">Hội thảo cập nhật chính sách Thuế là sự kiện được lắng nghe, vấn đáp
                                            trực tiếp cùng Luật sư Vũ Đức Hiển, với sự tin tưởng tham gia dài hạn,
                                            lâu năm của hội viên từ các công ty,...</p>
                                        <p class="btn-news">Chi tiết <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                        </span></p>
                                    </div>
                                </a>    
                                <a href="" class="link-news">
                                    <img src="./asset/image/images1920558_4053279_16.jpg" alt="">
                                    <div class="info-news-small">
                                        <div class="author">
                                            <span>Đăng bởi:</span>
                                            <span class="name-author">Thư Phạm</span>
                                        </div>
                                        <p class="title-news">MỞ TÀI KHOẢN DOANH NGHIỆP M-SMART | MSB</p>
                                        <p class="description-news ellipsis block-ellipsis">Hội thảo cập nhật chính sách Thuế là sự kiện được lắng nghe, vấn đáp
                                            trực tiếp cùng Luật sư Vũ Đức Hiển, với sự tin tưởng tham gia dài hạn,
                                            lâu năm của hội viên từ các công ty,...</p>
                                        <p class="btn-news">Chi tiết <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                        </span></p>
                                    </div>
                                </a>   
                                <a href="" class="link-news">
                                    <img src="./asset/image/images1920558_4053279_16.jpg" alt="">
                                    <div class="info-news-small">
                                        <div class="author">
                                            <span>Đăng bởi:</span>
                                            <span class="name-author">Thư Phạm</span>
                                        </div>
                                        <p class="title-news">MỞ TÀI KHOẢN DOANH NGHIỆP M-SMART | MSB</p>
                                        <p class="description-news ellipsis block-ellipsis">Hội thảo cập nhật chính sách Thuế là sự kiện được lắng nghe, vấn đáp
                                            trực tiếp cùng Luật sư Vũ Đức Hiển, với sự tin tưởng tham gia dài hạn,
                                            lâu năm của hội viên từ các công ty,...</p>
                                        <p class="btn-news">Chi tiết <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                        </span></p>
                                    </div>
                                </a>                                         
                            </div>
                        </div>
                    </div>

                    <div class="banner-ads">
                        <a href="">
                            <img src="./asset/image/images1920558_4053279_16.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>   
<?php getFooter();?>