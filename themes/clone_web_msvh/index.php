
<?php 
    getheader();
    global $settingThemes;
?>
       
    <main>
        <section class="section-background-portrait" style="background-image: url(<?php echo @$settingThemes['backgound'];?>)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="left-header-portrait col-lg-3 col-md-6">
                        <div class="portrait-people">
                            <img src="<?php echo @$settingThemes['image1'];?>" alt="">
                        </div>
                        <div class="portraint-tagname">
                            <img src="<?php echo @$settingThemes['image2'];?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="title-image-postrain">
                            <div class="image-information-map"><img src="<?php echo @$settingThemes['image3'];?>" alt=""></div>
                            <div class="image-business"><img src="<?php echo @$settingThemes['image4'];?>" alt=""></div>
                            <div class="image-success"><img src="<?php echo @$settingThemes['image5'];?>" alt=""></div>
                            <div class="slogan-inspire"><img src="<?php echo @$settingThemes['image6'];?>" alt=""></div>
                            <div class="ladi-image-background"><img src="<?php echo @$settingThemes['image7'];?>" alt=""></div>
                            <div class="ladi-image-partner"><img src="<?php echo @$settingThemes['image8'];?>" alt=""></div>
                            <div class="ladi-button-submit">
                                <div class="background-button-submit"><a href=""><p><?php echo @$settingThemes['button1']; ?></p></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-schedule" style="background-image:url(<?php echo @$settingThemes['backgound2'];?>)">
            <div class="container">
                <div class="content-class">
                    <h2><?php echo @$settingThemes['title1'];?></h2>
                    <p><?php echo @$settingThemes['noidung1'];?></p>
                    <p><?php echo @$settingThemes['noidung2'];?></p>
                    <p><?php echo @$settingThemes['noidung3'];?></p>
                </div>
            </div>
        </section>
        <section class="section-more-learn" >
            <div class="container">
                <div class="embrave-two-row row justify-content-center">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-7">
                        <div class="image-people-teach">
                            <img src="<?php echo @$settingThemes['image9'];?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6 col-8 mt-3">
                        <div class="more-learn-title">
                            <h2><?php echo @$settingThemes['title2'];?></h2>
                            <h2><?php echo @$settingThemes['title3'];?></h2>
                        </div>
                        <div class="left-more-learn row">
                            <div class="image-more-learn col-lg-1 col-md-2 col-sm-2 col-2"><img src="<?= $urlThemeActive?>/asset/image/layer-2-20240417090758-uduf5.png" alt=""></div>
                            <div class="paragrap-more-learn col-md-10 col-sm-9  col-8"><p><?php echo @$settingThemes['noidungbuoc1'];?></p></div>
                        </div>
                        <div class="left-more-learn row">
                            <div class="image-more-learn col-lg-1 col-md-2 col-sm-2 col-2"><img src="<?= $urlThemeActive?>/asset/image/layer-2-20240417090758-uduf5.png" alt=""></div>
                            <div class="paragrap-more-learn col-md-10 col-sm-9 col-8"><p><?php echo @$settingThemes['noidungbuoc2'];?></p></div>
                        </div>
                        <div class="left-more-learn row">
                            <div class="image-more-learn col-lg-1 col-md-2 col-sm-2 col-2"><img src="<?= $urlThemeActive?>/asset/image/layer-2-20240417090758-uduf5.png" alt=""></div>
                            <div class="paragrap-more-learn col-md-10 col-sm-9 col-8"><p><?php echo @$settingThemes['noidungbuoc3'];?></p></div>
                        </div>
                        <div class="left-more-learn row">
                            <div class="image-more-learn col-lg-1 col-md-2 col-sm-2 col-2"><img src="<?= $urlThemeActive?>/asset/image/layer-2-20240417090758-uduf5.png" alt=""></div>
                            <div class="paragrap-more-learn col-md-10 col-sm-9 col-8"><p><?php echo @$settingThemes['noidungbuoc4'];?></p></div>
                        </div>
                   
                        <div class="left-more-learn row">
                            <div class="image-more-learn col-lg-1 col-md-2 col-sm-2 col-2"><img src="<?= $urlThemeActive?>/asset/image/layer-2-20240417090758-uduf5.png" alt=""></div>
                            <div class="paragrap-more-learn col-md-10 col-sm-9 col-8"><p><?php echo @$settingThemes['noidungbuoc5'];?></p></div>
                        </div>
                        <div class="button-submit-schedule">
                            <div class="div-cover-button"><a href=""><p><?php echo @$settingThemes['button3'];?></p></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-produce-services">
            <div class="container">
                <div class="top-introduce">
                    <h2><?php echo @$settingThemes['noidung4'];?></h2>
                </div>
                
                <div class="bottom-introduce">
                    <p><?php echo @$settingThemes['noidung5'];?></p>
                </div>
            </div>
        </section>
        <section class="section-title-guide" style="background-color: <?php echo @$settingThemes['backgound3'];?>;">
            <div class="container ">
                <div class="button-cover d-flex justify-content-center">
                    <div class="button-guide">
                        <a href=""><p><?php echo @$settingThemes['button4'];?></p></a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-7 col-md-6 col-12 pt-4 mb-3">
                        <div class="title-guild">
                            <h2 class="introduce-guild"><?php echo @$settingThemes['title4'];?></h2>
                            <h2 class="name-guild"><?php echo @$settingThemes['title5'];?></h2>
                        </div>
                        <div class="list-job">
                            <ul>
                                <li><?php echo @$settingThemes['step1'];?></li>
                                <li><?php echo @$settingThemes['step2'];?></li>
                                <li><?php echo @$settingThemes['step3'];?></li>
                                <li><?php echo @$settingThemes['step4'];?></li>
                                <li><?php echo @$settingThemes['step5'];?></li>
                                <li><?php echo @$settingThemes['step6'];?></li>
                                <li><?php echo @$settingThemes['step7'];?></li>
                                <li><?php echo @$settingThemes['step8'];?></li>
                                <li><?php echo @$settingThemes['step9'];?></li>
                                <li><?php echo @$settingThemes['step10'];?></li>
                                <li><?php echo @$settingThemes['step11'];?></li>
                                <li><?php echo @$settingThemes['step12'];?></li>
                                <li><?php echo @$settingThemes['step13'];?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5 col-9">
                        <div class="image-people-guild">
                            <img src="<?php echo @$settingThemes['image10'];?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-reason-submit">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-7 col-md-6">
                        <div class="title-reason">
                            <h2><?php echo @$settingThemes['title6'];?></h2>
                        </div>
                        <div class="step-business-start-people">
                            <p> <?php echo @$settingThemes['ih1'];?><?php echo @$settingThemes['chuvang'];?></span><?php echo @$settingThemes['noidungkhoi71'];?></p>
                        </div>
                        <div class="step-business">
                            <p><?php echo @$settingThemes['ih2'];?><?php echo @$settingThemes['noidungkhoi72'];?></p>
                        </div>
                        <div class="step-business">
                            <p><?php echo @$settingThemes['ih3'];?><?php echo @$settingThemes['noidungkhoi73'];?></p>
                        </div>
                        <div class="button-your-want-submit">
                            <div class="button">
                                <a href=""><p></p><?php echo @$settingThemes['button7'];?></a>
                            </div>
                        </div>
                    </div>      
                    <div class="col-xl-3 col-lg-4 col-md-5 col-8 p-4">
                        <div class="image-reason-bia">
                            <img src="<?php echo @$settingThemes['image11'];?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-price">
            <div class="container">
                <div class="header-title-price">
                    <h2><?php echo @$settingThemes['tieudevang'];?></h2>
                    <h3><?php echo @$settingThemes['tieudetrang'];?></h3>
                </div>
                <div class="gold-price">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-12 ">
                           <div class="gold-price-border-outside">
                                <div class="gold-price-background-image">
                                    <img src="<?= $urlThemeActive?>/asset/image/ve-gold-1-20210127060522.png" alt="">
                                    <div class="position-price-gold">
                                        <div class="price-vnd-gold">
                                            <h2><?php echo @$settingThemes['priceleft'];?><span>VND</span></h2>
                                        </div>
                                        <div class="free-title">
                                            <h2><?php echo @$settingThemes['tieudegia'];?></h2>
                                        </div>
                                        <div class="list-information-course">
                                            <ul>
                                                <li><?php echo @$settingThemes['dsdautien'];?></li>
                                                <li><?php echo @$settingThemes['dsdauhai'];?></li>
                                                <li><?php echo @$settingThemes['dsdauba'];?></li>
                                                <li><?php echo @$settingThemes['dsdautu'];?></li>
                                                <li><?php echo @$settingThemes['dsdaunam'];?></li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                    <div class="button-submit-course">
                                        <a href=""><?php echo @$settingThemes['btchung'];?></a>
                                    </div>
                                </div>
                               
                           </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-12 ">
                            <div class="gold-price-border-outside">
                                 <div class="gold-price-background-image">
                                     <img src="<?= $urlThemeActive?>/asset/image/vip.png" alt="">
                                     <div class="position-price-gold">
                                         <div class="price-vnd-gold">
                                             <h2><?php echo @$settingThemes['priceright'];?><span>VND</span></h2>
                                         </div>
                                         <div class="free-title">
                                             <h2><?php echo @$settingThemes['tieudegiavip'];?></h2>
                                         </div>
                                         <div class="list-information-course">
                                             <ul>
                                                 <li><?php echo @$settingThemes['dsdautienp'];?></li>
                                                 <li><?php echo @$settingThemes['dsdauhaip'];?></li>
                                                 <li><?php echo @$settingThemes['dsdaubap'];?></li>
                                                 <li><?php echo @$settingThemes['dsdautup'];?></li>
                                                 <li><?php echo @$settingThemes['dsdaunamp'];?></li>
                                                 <li><?php echo @$settingThemes['dsdausaup'];?></li>
                                             </ul>
                                         </div>
                                        
                                     </div>
                                     <div class="button-submit-course">
                                        <a href=""><?php echo @$settingThemes['btchung'];?></a>
                                    </div>
                                 </div>
                                
                            </div>
                         </div>
                    
                    </div>
                </div>
                <div class="power-success text-center">
                    <div class="paragrap-information-power">
                        <p><?php echo @$settingThemes['noidungnho1'];?></p>
                    </div>
                    <div class="map-information-power">
                        <h2><?php echo @$settingThemes['noidungnho2'];?></h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-form-buy">
            <div class="container">
                <div class="title-form-buy text-center">
                    <h3><?php echo @$settingThemes['titlevangk9'];?></h3>
                    <h2><?php echo @$settingThemes['tieudetrangk9'];?></h2>
                </div>
                <div class="border-form-buy">
                    <div class="title-form-main text-center">
                        <h2><?php echo @$settingThemes['tieudevangtrang'];?></h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-10 address-buy">
                            <p class="time-price-address"><?php echo @$settingThemes['diadiem'];?></p>
                            <p class="time-price-address"><?php echo @$settingThemes['thoigian'];?></p>
                            <p class="time-price-address"><?php echo @$settingThemes['phithamdu'];?></p>
                            <div class="price-free-element">
                                <h3><?php echo @$settingThemes['pricethamdu'];?></h3>
                                <h2><?php echo @$settingThemes['uudaigia'];?></h2>
                            </div>
                            <div class="form-time-down row">
                                <div class="clock-container">
                                    <div id="clockdiv">
                                        <!-- <div>
                                            <span class="days" data-unit="days" data-initial-value="<?php echo @$settingThemes['timedownngay']; ?>">00</span>
                                            <div class="smalltext">days</div>
                                        </div> -->
                                        <div>
                                            <span class="hours" data-unit="hours" data-initial-value="<?php echo @$settingThemes['hour']; ?>">00</span>
                                            <div class="smalltext">Hours</div>
                                        </div>
                                        <div>
                                            <span class="minutes" data-unit="minutes" data-initial-value="<?php echo @$settingThemes['minutes']; ?>">00</span>
                                            <div class="smalltext">Minutes</div>
                                        </div>
                                        <div>
                                            <span class="seconds" data-unit="seconds" data-initial-value="<?php echo @$settingThemes['seconds']; ?>">00</span>
                                            <div class="smalltext">Seconds</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="form-time-down-detail col-md-2 col-3"  data-unit="days" data-initial-value="3">00</p>
                                <p class="form-time-down-detail col-md-2 col-3" data-unit="hours" data-initial-value="12">00</p>
                                <p class="form-time-down-detail col-md-2 col-3" data-unit="minutes" data-initial-value="30">00</p>
                                <p class="form-time-down-detail col-md-2 col-3"  data-unit="seconds" data-initial-value="45">00</p> -->
                              
                            </div>
                            
                            
                        </div>
                        <div class="col-lg-4 col-md-4 col-11">
                            <div class="detail-form">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required  id="" placeholder="Họ Và Tên">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required  id="" placeholder="Số Điện Thoại">
                                    </div>
                                    <div class="form-check-box row">
                                        <div class="left-check-box col-lg-6 col-md-6 col-6">
                                            <div>
                                                <input type="radio" name="location" id="">
                                            </div>
                                            <div>
                                                <p><?php echo @$settingThemes['checkboxleftdd'];?></p>
                                            </div>
                                            
                                        </div>
                                        <div class="right-check-box col-lg-6 col-md-6 col-6">
                                            <div>
                                                <input type="radio" name="location" id="">
                                            </div>
                                            <div>
                                                <p><?php echo @$settingThemes['checkboxrightdd'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check-box row">
                                        <div class="left-check-box col-lg-6 col-md-6 col-6">
                                            <div>
                                                <input type="radio" name="ticket" id="">
                                            </div>
                                            <div>
                                                <p><?php echo @$settingThemes['checkboxleftprice'];?></p>
                                            </div>
                                        </div>
                                        <div class="right-check-box col-lg-6 col-md-6 col-6">
                                            <div>
                                                <input type="radio" name="ticket" id="">
                                            </div>
                                            <div>
                                                <p><?php echo @$settingThemes['checkboxrightprice'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-form-submit">
                                        
                                        <button type="submit" class="btn btn-primary">TÔI ĐĂNG KÝ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-some-student">
            <div class="container">
                <div class="section-title-some-student">
                    <h2><?php echo @$settingThemes['titlek10'];?>
                        <br>
                        <?php echo @$settingThemes['titlek10bd'];?>
                    </h2>
                </div>
                <div class="member-student">
                    <div class="row set-between">
                    <?php if(!empty($listFeedback)){
                                        foreach($listFeedback as $item){ ?>
                        <div class="border-student col-lg-5 col-md-7 col-sm-7 col-12">
                            <div class="parent-box d-flex">
                                <div class="image-people-member">
                                    <img src="<?php echo $item->avatar; ?>" alt="">
                                </div>
                                <div class="information-member-parent">
                                    <div class="information-member">
                                        <h2><?php echo $item->full_name; ?></h2>
                                        <h3><?php echo $item->position; ?></h3>
                                        <p><?php echo $item->content; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>        
                    </div>
                    
                </div>
                <div class="title-submit-today">
                    <div class="today-background-information">
                        <h2><?php echo @$settingThemes['titleb10'];?></h2>
                        <h3><?php echo @$settingThemes['titleb11'];?></h3>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php 
    getFooter();
?>
