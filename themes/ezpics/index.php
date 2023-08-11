<?php 
    global $settingThemes;
    getHeader();
?>

<main>
        <section id="section-banner">
            <div class="background-banner-img">
                <?php 
        if(!empty($slide_home)){  
         foreach ($slide_home as $key => $value) {?>
                <div class="background-banner-box">
                    <img src="<?php echo $value->image ?>" alt="">
                </div>
            <?php }}?>
            </div>
            <div class="background-banner-overlay"></div>
        </section>

    
        
        <!-- Xu hướng -->
        <section id="section-product">
            <div class="section-title">
                <h1>Xu hướng</h1>
            </div>

            <div class="container">
                    <div class="row">
                        <div class="slide-home-product">

                          <?php  if(!empty($listTrendProduct)){  
                            foreach ($listTrendProduct as $key => $value) {
                                 $price = '';
                                if($value->sale_price==0){
                                    $price = ' <span>Miễn phí</span>';
                                }else{
                                    $price =  '<span>'.number_format($value->sale_price).'đ</span>';
                                }

                                if($value->price>0){
                                    $price .= '  <del>'.number_format($value->price).'đ</del>';
                                }

                                $thumbnail = (!empty($value->thumbnail))?$value->thumbnail:$value->image;
                                ?>
                            <div class="product-item">
                                <div class="product-item-img">
                                    <a href="/detail/<?php echo @$value->slug.'-'.@$value->id ?>.html"><img src="<?php echo $thumbnail ?>" alt=""></a>
                                </div>
        
                                <div class="product-item-info">
                                    <div class="product-item-title">
                                        <h3>
                                            <a href="/detail/<?php echo @$value->slug.'-'.@$value->id ?>.html"><?php echo $value->name ?></a>
                                        </h3>
                                    </div>
                
                                    <div class="product-item-price">
                                        <p><?php echo $price; ?></p>
                                    </div>
                
                                    <div class="product-item-selled">
                                        <p>Đã bán: <span> <?php echo @$value->sold ?></span></p>
                                    </div>
                                </div>
                            </div>
                        <?php }}?>
                           
                        </div>
                    </div>
            </div>
        </section>

        <!-- Kho -->
        <section id="section-warehouse">
            <div class="section-title">
                <h1>Kho nổi bật</h1>
            </div>

            <div class="container">
                <div class="row">
                    <div class="slide-home-warehouse">
                     <?php
                        if(!empty($listWarehouse)){
                    foreach ($listWarehouse as $key => $value) {
                        $price = '';
                         if($value->sale_price==0){
                                    $price = ' <span>Miễn phí</span>';
                                }else{
                                    $price =  '<span>'.number_format($value->sale_price).'đ</span>';
                                }

                                if($value->price>0){
                                    $price .= '  <del>'.number_format($value->price).'đ</del>';
                                }

                                $thumbnail = (!empty($value->thumbnail))?$value->thumbnail:$value->image;
                        ?>
                        <div class="warehouse-item">
                            <div class="warehouse-item-img">
                                <div class="deadline-warehouse">
                                    <p><i class="fa-solid fa-clock"></i><?php echo @$value->date_use ?> ngày</p>
                                </div>
                                <a href="/detailWarehouse/<?php echo @$value->slug.'-'.@$value->id ?>.html"><img src="<?php echo $value->thumbnail ?>" alt=""></a>
                            </div>

                            <div class="warehouse-item-info">
                                <div class="warehouse-item-title">
                                    <h3>
                                        <a href="/detailWarehouse/<?php echo @$value->slug.'-'.@$value->id ?>.html"><?php echo $value->name ?></a>
                                    </h3>
                                </div>
            
                                <div class="warehouse-item-price">
                                    <p><?php echo $price; ?></p>
                                </div>
            
                                <div class="warehouse-item-selled">
                                    <p>Đã bán: <span><?php echo @$item->number_user ?></span></p>
                                </div>
                            </div>
                        </div>

                      <?php }} ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Top rank -->
        <section id="section-ranking">
            <div class="section-title">
                <h1>Top Designer</h1>
            </div>
            <div class="container">
                <div class="row"> 
                    <!-- Bán nhiều mẫu nhất -->
                    <div class="col-lg-4 col-md-4 col-12 ranking-item rank-yeallow">
                        <div class="ranking-title">
                            <h2>Bán nhiều mẫu nhất</h2>
                        </div>
                        <?php if(!empty(getSellTopDesigner())){
                            foreach(getSellTopDesigner() as $key => $item){
                            ?>
                        <div class="ranking-info-content">
                            <div class="ranking-number">
                                <p>Top <?php echo $key+1 ?></p>
                            </div>
        
                            <div class="ranking-info-intro">
                                <div class="avatar-designer">
                                    <img src="<?php echo @$item->avatar ?>" alt="">
                                </div>
                                <div class="ranking-right">
                                    <div class="name-designer">
                                        <p><?php echo @$item->name ?></p>
                                    </div>
                
                                    <div class="criteria-designer">
                                        <p><?php echo @$item->sold ?> lượt bán</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
                        
                    </div>
                    
                    <!-- Thu nhập cao nhất -->
                    <div class="col-lg-4 col-md-4 col-12 ranking-item rank-gray">
                        <div class="ranking-title">
                            <h2>Thu nhập cao nhất</h2>
                        </div>

                        <?php if(!empty(getIncomeTopDesigner())){
                            foreach(getIncomeTopDesigner() as $key => $item){
                            ?>
                        <div class="ranking-info-content">
                            <div class="ranking-number">
                                <p>Top <?php echo $key+1 ?></p>
                            </div>
        
                            <div class="ranking-info-intro">
                                <div class="avatar-designer">
                                    <img src="<?php echo @$item->avatar ?>" alt="">
                                </div>
                                <div class="ranking-right">
                                    <div class="name-designer">
                                        <p><?php echo @$item->name ?></p>
                                    </div>
                
                                    <div class="criteria-designer">
                                        <p><?php echo @$item->sold ?> lượt bán</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>

                        
                    </div>

                    <!-- Tạo được nhiều mẫu nhất -->
                    <div class="col-lg-4 col-md-4 col-12 ranking-item rank-black">
                        <div class="ranking-title">
                            <h2>Tạo nhiều mẫu nhất</h2>
                        </div>

                         <?php if(!empty(getIncomeTopDesigner())){
                            foreach(getIncomeTopDesigner() as $key => $item){
                            ?>
                        <div class="ranking-info-content">
                            <div class="ranking-number">
                                <p>Top <?php echo $key+1 ?></p>
                            </div>
        
                            <div class="ranking-info-intro">
                                <div class="avatar-designer">
                                    <img src="<?php echo @$item->avatar ?>" alt="">
                                </div>
                                <div class="ranking-right">
                                    <div class="name-designer">
                                        <p><?php echo @$item->name ?></p>
                                    </div>
                
                                    <div class="criteria-designer">
                                        <p><?php echo @$item->sold ?> lượt bán</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- Tin tức -->
        <section id="section-news">
            <div class="section-title">
                <h1>Tin tức</h1>
            </div>
            <div class="container">
                <div class="row">
                    <div class="slide-home-news">
                        <?php 
                if(!empty($listDataPost)){
                    foreach ($listDataPost as $key => $value) {
                         $link = '/'.$value->slug.'.html';
                        ?>
                        <div class="news-item">
                            <div class="news-item-img">
                                <img src="<?php echo $value->image ?>" alt="">
                            </div>
        
                            <div class="news-item-info">
                                <div class="news-item-title">
                                    <h3>
                                        <a href=""><?php echo $value->title ?></a>
                                    </h3>
                                </div>
            
                                <div class="news-item-description">
                                    <p><?php echo $value->description ?> </p>
                                </div>
            
                                <div class="news-item-meta">
                                    <p><i class="fa-solid fa-calendar-days"></i><?php echo date('d/m/Y', $value->time) ?></p>
                                    <a href="<?php echo $link ?>">Xem thêm</a>
                                </div>
                            </div>
                        </div>
        
                        <?php }} ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php getFooter();?>    