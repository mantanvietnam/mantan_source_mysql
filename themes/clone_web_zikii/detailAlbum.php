<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
?>
  <main>
        <section id="section-page-heading">
            <div class="container">
                <div class="background-title">
                    <h1>Album ảnh</h1>
                </div>
                
                <div class="breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><?php echo $album->title; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section id="section-library">
            <div class="container">
                <div class="library-list" data-aos="">
                    <div class="row">
                        <?php if(!empty($listData)){
                        	foreach($listData as $key => $item){
                        		echo '<div class="col-md-2 col-sm-3 col-xs-6 library-item">
                            <div class="library-image">
                                <a href="'.$item->image.'">
                                    <img src="'.$item->image.'" alt="">
                                </a>
                            </div>
                        </div>';
                        	}
                        } ?>
                        

                        
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>