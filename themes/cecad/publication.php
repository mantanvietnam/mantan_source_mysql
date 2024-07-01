<?php getHeader();?>
    <main>
        <section class="section-publication">
            <div class="container">
                <div class="publication-title text-center">
                    <h1>DANH SÁCH ẤN PHẨM</h1>
                </div>
                <div class="search-publication">
                    <form action="" method="get">
                        <div class="wrap">
                            <div class="search">
                                <input type="text" class="searchTerm" placeholder="What are you looking for?" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
                                <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">

                <?php foreach ($listDatapublication as $key => $value) { ?>
                    <div class=" col-lg-4 col-md-6 col-sm-6 col-12 ">
                        <div class="publication-card">
                            <div class="image-publication">
                                <a href="/detailpublication/<?php echo $value->slug;?>.html"><img src="<?php echo $value->image;?>" alt=""></a>
                            </div>
                            <div class="infor-publication-title">
                                <a href="/detailpublication/<?php echo $value->slug;?>.html">
                                    <h2><?php echo $value->name;?></h2>
                                </a>
                            </div>
                            <div class="infor-publication-meta">
                                <div class="d-flex justify-content-between infor-publication-information">
                                    <div><i class="fa-solid fa-location-dot"></i><span>Địa Điểm</span></div>
                                    <div><?php echo $value->address;?></div>
                                </div>
                                <div class="d-flex justify-content-between infor-publication-information ">
                                    <div><i class="fa-regular fa-clock"></i><span>Thời gian</span></div>
                                    <div><?php echo $value->time_create;?></div>
                                </div>

                                <div class="infor-detail-publication d-flex justify-content-between">
                                    <div class="detail-publication"><a href="/detailpublication/<?php echo $value->slug;?>.html">Xem Chi Tiết</a></div>
                                    <div class="button-dowload-detail"><a href="<?php echo $value->file;?>" Dowload>Dowload</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="pagination">
                    <nav aria-label="Page navigation">
                    <?php
                    if ($totalPage > 0) {
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
                    ?>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $urlPage; ?>1" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>
                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="<?php echo $urlPage . $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $urlPage . $totalPage; ?>" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                    </nav>
                </div>
                </div>
            </div>
        </section>
    </main>
<?php 
    getFooter();
?>
