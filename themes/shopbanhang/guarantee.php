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
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Bảo hành </a></li>
                </ul>
            </div>
        </section>

        <div id="policy">
            <div class="container">

                <ul class="nav nav-tabs">
                     <li class="active" ><a href="chinh_sach_bao_mat" class="active" >Chính sách bảo hành</a></li>
                    <li><a href="huong_dan_kich_hoat_bao_hanh">Hướng dẫn kích hoạt bảo hành</a></li>
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

<?php getFooter();?>