<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();?>
 <main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">chính sách bảo mật </a></li>
                </ul>
            </div>
        </section>

        <div id="policy">
            <div class="container">

                <ul class="nav nav-tabs">
                    <li class="active"><a aria-selected="true" data-bs-toggle="tab" href="#content-policy" class="active">Chính sách bảo hành</a></li>
                    <li><a data-bs-toggle="tab" href="#video-policy">Hướng dẫn kích hoạt bảo hành</a></li>
                    <li><a data-bs-toggle="tab" href="#search-polity">Tra cứu bảo hành</a></li>
                </ul>

                <div class="tab-content">
                    <div id="content-policy" class="tab-pane fade show active">
                        <div class="title-content-policy">
                            <h3><?php echo $setting['title']; ?></h3>
                        </div>
                        <div class="detail-policy">
                            <?php echo $setting['content']; ?>
                        </div>
                    </div>
                    <div id="video-policy" class="tab-pane fade">
                        <div class="detail-video">
                            <h3>Video hướng dẫn kích hoạt bảo hành</h3>
                            <p><?php echo $setting['title_video']; ?></p>
                        </div>
                        <div class="box-video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $setting['title']; ?>?si=HyWfputq73ME4I7e&amp;start=23" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <div id="search-polity" class="tab-pane fade">
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
                    </div>
                </div>

            </div>
        </div>
    </main>

<?php getFooter();?>