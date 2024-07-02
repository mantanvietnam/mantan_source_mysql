
<?php 
    getheader();

?>
<main>

        <section class="section-detail-publication">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="image-title-detail-publication col-lg-11 col-md-12 col-sm-12 col-12">
                        <div class="title-detail-publication">
                            <h1><?= $publication['name'] ?></h1>
                        </div>
                        
                        <div class="iframe-publication" style="height:800px">
                            <iframe src="<?= $publication['file']?>" style="width:100%; height:100%;">
                            </iframe>
                        </div>
                        <div class="button-dowload-detail-publication text-center">
                            <a href="<?= $publication['file']?>" dowload>Dowload</a>
                        </div>
                           <!-- <div class="image-detail-publication">
                            <img src="<?= $publication['image']?>" alt="">
                        </div> -->
                        <!-- <div class="bottom-content d-flex justify-content-between">
                            <ul>
                                <li>Dowload: <span>1852</span></li>
                                <li>File Size: <span>39.36 MB</span></li>
                                <li>File Count: <span>1</span></li>
                                <li>Create Date: <span>15/09/2017</span></li>
                                <li>Last Updated: <span>15/09/2023</span></li>
                            </ul>
                        </div> -->
                        <!-- <div class="button-dowload-detail-publication">
                            <a href="">Dowload</a>
                        </div> -->
                    </div>
                    <!-- <div class="col-lg-3 col-md-12 col-sm-12 col-12 left-border">
                        <div class="input-search">
                            <div class="wrap">
                                <div class="search">
                                    <input type="text" class="searchTerm" placeholder="Search...">
                                    <button type="submit" class="searchButton">
                                     <i class="fa fa-search"></i>
                                  </button>
                                </div>
                            </div>
                        </div>
                        <div class="new-publication">
                            <h2>Ấn phẩm</h2>
                        </div>
                        <div class="row image-and-content-new">
                            <div class="col-lg-5 col-md-2 col-4 image-new-publication">
                                <img src="../Asset/images/news-1.jpg" alt="">
                            </div>
                            <div class="col-lg-7 col-md-9 col-8 content-image">
                                <a href="">
                                    <p>Đối Thoại Chính Sách Về Báo Động Mất An Ninh Nguồn Nước Trên Truyền Hình Quốc Hội Việt Nam </p>
                                </a>
                            </div>
                        </div>
                        <div class="row image-and-content-new">
                            <div class="col-lg-5 col-md-2 col-4 image-new-publication">
                                <img src="../Asset/images/news-1.jpg" alt="">
                            </div>
                            <div class="col-lg-7 col-md-9 col-8 content-image">
                                <a href="">
                                    <p>Đối Thoại Chính Sách Về Báo Động Mất An Ninh Nguồn Nước Trên Truyền Hình Quốc Hội Việt Nam </p>
                                </a>
                            </div>
                        </div>
                        <div class="row image-and-content-new">
                            <div class="col-lg-5 col-md-2 col-4 image-new-publication">
                                <img src="../Asset/images/news-1.jpg" alt="">
                            </div>
                            <div class="col-lg-7 col-md-9 col-8 content-image">
                                <a href="">
                                    <p>Đối Thoại Chính Sách Về Báo Động Mất An Ninh Nguồn Nước Trên Truyền Hình Quốc Hội Việt Nam </p>
                                </a>
                            </div>
                        </div>

                    </div> -->
                </div>
            </div>
            </div>
        </section>
    </main>

<?php 
    getFooter();
?>
