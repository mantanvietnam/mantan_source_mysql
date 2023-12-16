<?php
getHeader();
global $urlThemeActive;
$Category = getByIdCategory($post->idCategory);
?>
    <?php if($post->type=='post'){ ?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="/news">Bài viết</a></li>
                  <li class="breadcrumb-item active">Chi tiết bài viết</li>
                </ul>
            </div>
        </section>

        <section id="section-blog-detail">
            <div class="container">
                <div class="title-blog-detail">
                    <h1><?php echo $post->title; ?></h1>
                </div>
    
                <div class="blog-detail-meta">
                    <div class="blog-detail-date">
                        <p><?php echo date('H:i d/m/Y',$post->time); ?></p>
                    </div>
                     <div class="list-blog-col-category">
                         <span><?php echo @$Category->name ?></span>
                    </div>
                    <div class="blog-detail-time">
                        <p><?php echo @$item->author ?></p>
                    </div>
                   
                </div>
                <div class="blog-detail-description">
                    <p><?php echo @$post->description ?></p>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-12 big-blog-detai">
                        <div class="blog-detail-content"><?php echo $post->content; ?></div>
                    </div>

                    <div class="col-lg-4 col-12 menu-blog-detail">
                        <div id="table-of-contents">
                            <h2>Mục lục</h2>
                            <ul id="toc-list"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog-like">
            <div class="blog-last-inner">
                <div class="container">
                    <div class="row">
                        <div class="title-blog-like">
                            <p>Có thể bạn sẽ thích</p>
                        </div>
                         <?php
                         	if(!empty($otherPosts)){
                                foreach ($otherPosts as $item) {
                                    ?>
                        <div class="blog-last-item col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="blog-last-title">
                                <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                            </div>

                            <div class="blog-last-meta">
                                <p class="blog-last-date"><?php echo date('H:i d/m/Y',$item->time); ?></p>
                                <p class="blog-last-category"><?php echo @$item->author ?></p>
                            </div>

                            <div class="blog-last-image">
                                <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
                            </div>
                        </div>
                    <?php } } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php }else{ ?>
   <main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#"><?php echo @$post->title ?> </a></li>
                </ul>
            </div>
        </section>

        <div id="policy" class="page-view">
            <div class="container">

                <!-- <ul class="nav nav-tabs">
                     <li class="active" ><a href="chinh_sach_bao_mat" class="active" >Chính sách bảo hành</a></li>
                    <li><a href="huong_dan_kich_hoat_bao_hanh">Hướng dẫn kích hoạt bảo hành</a></li>
                </ul> -->

                <div class="tab-content">
                    <div id="content-policy" class="tab-pane fade show active">
                        <div class="title-content-policy">
                            <h3><?php echo @$post->title ?></h3>
                        </div>
                        <div class="detail-policy">
                           <?php echo $post->content; ?>
                        </div>
                    </div>
                    
                    <!-- <div id="search-polity" class="tab-pane fade">
                        <div class="detail-search">
                            <h3>Tra cứu thông tin bảo hành</h3>

                        </div>
                        <div class="check-box">
                            <form>
                                <label>
                                    <input type="radio" name="choose" value="number-phone"> Tìm theo số điện thoại
                                </label>
                                <label>
                                    <input type="radio" name="choose" value="ID-IMEI"> Tìm theo mã IMEI
                                </label>
                            </form>
                        </div>
                        <div class="input-box">
                            <form>
                                <input type="text" placeholder="Mời nhập số điện thoại hoặc mã IMEI">
                                <button>Tìm kiếm</button>
                            </form>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
    </main>
    <?php } ?>
<?php
getFooter();?>