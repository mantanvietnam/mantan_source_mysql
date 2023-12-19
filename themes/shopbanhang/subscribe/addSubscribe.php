<?php getHeader();?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Đăng ký nhận thông báo</li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-news">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 detailNews-left">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 detailNews-content-box">
                                <div class="detailNews-heading">
                                    <div class="detailNews-title">
                                        <h1>Đăng ký nhận thông báo</h1>
                                    </div>
                                </div>

                                <div class="detailNews-content">
                                    <div class="detailNews-word"><?php echo $mess;?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </section>
    </main>

<?php getFooter();?>