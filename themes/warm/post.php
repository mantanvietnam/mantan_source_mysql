
<?php getHeader();?>  
    <main>
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <img src="<?php echo $urlThemeActive; ?>/asset/img/WARM-horz-EN-_1_.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-page-title">
            <div class="title-section">
                <h1>NEWS & EVENTS</h1>
                <div class="title-divide-section"></div>
            </div>
        </section>

        <!-- main -->
        <section id="section-newsDetail">
            <div class="news-detail-top">
                <div class="container">
                    <div class="news-detail-top-inner">
                        <div class="detail-top-left">
                            <a href="/news-and-events.html" class=""><i class="fa-solid fa-angle-left"></i> Back</a>
                        </div>
    
                        <div class="detail-top-right">
                            <div class="detail-share pdf-share">
                                <a href="javascript:void(0)" id="generate-pdf"><img src="<?php echo $urlThemeActive; ?>/asset/img/pdf-fix.png" alt=""></a>
                            </div>
    
                            <div class="detail-share twitter-share">
                                <a href="https://twitter.com/share?text=&url=<?php echo $post->slug; ?>.html" target="_blank"><img src="<?php echo $urlThemeActive; ?>/asset/img/twittershare.png" alt=""></a>
                            </div>
    
                            <div class="detail-share face-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post->slug; ?>.html" target="_blank"><img src="<?php echo $urlThemeActive; ?>/asset/img/faceshare.png" alt=""></a>
                            </div>
    
                            <div class="detail-share in-share">
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $post->slug; ?>.html" target="_blank"><img src="<?php echo $urlThemeActive; ?>/asset/img/inshare.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="news-detail-content">
                <div class="news-img" style="background-image: url(<?php echo $post->image; ?>);">
                    <div class="news-introduction">
                        <div class="container">
                            <div class="news-introduction-inner">
                                <div class="news-detail-date">
                                    <span><?php echo date('d F Y', $post->time);?></span>
                                </div>

                                <div class="news-details-title">
                                    <h2><?php echo $post->title;?></h2>
                                </div>

                                <div class="news-details-description">
                                    <?php echo $post->description; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="news-opacity-background"></div>
            </div>

            <div class="news-detail-description">
                <div class="container">
                    <div class="news-detail-description-inner">
                        <div class="news-detail-description-text">
                            <?php echo $post->content; ?>
                        </div>
               

                        <div class="news-detail-border">
                            <p>The content of this publication falls under the sole responsibility of the AFD and does not necessarily reflect the opinions of the European Union.</p>
                        </div>

                        <div class="news-view">
                            <p> <i class="fa-solid fa-eye"></i> <?php echo $post->view;?> views</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-page-title" style="margin-top: 60px;">
            <div class="title-section">
                <h1>FURTHER READING</h1>
                <div class="title-divide-section"></div>
            </div>
        </section>

        <section id="section-page-further">
            <div class="news-slide">
                <?php 
                    if(!empty($otherPosts)){
                        foreach($otherPosts as $key => $value){
                            echo' 
                            <div class="news-slide-item">
                                <div class="news-slide-item-inner">
                                    <div class="news-item-img">
                                        <img src="'.$value->image.'" alt="">
                                    </div>
            
                                    <div class="news-item-content">
                                        <p>'.$value->title.'</p>
                                    </div>
        
                                    <div class="news-right-button-news">
                                        <a href="'.$value->slug.'.html">Read more </a> 
                                        <img src="'.$urlThemeActive.'/asset/img/arow.png" alt="">
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                ?>
            </div>
        </section>
    </main>



<?php getFooter();?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
    <script>
        const options = {
        margin: 0.3,
        filename: 'file.pdf',
        image: { 
            type: 'jpeg', 
            quality: 0.98 
        },
        html2canvas: { 
            scale: 1 
        },
        jsPDF: { 
            unit: 'mm', 
            format: 'a3', 
            orientation: 'portrait' 
        }
        }

        var objstr = document.getElementById('section-newsDetail').innerHTML;
        var strr = '<html><head><title>Testing</title>';   
        strr += '</head><body>';
        strr += '<div style="border:0.1rem solid #ccc!important;padding:0.5rem 1.5rem 0.5rem 1.5rem;margin-top:1.5rem">'+objstr+'</div>';
        // strr += '<div style="border:0.1rem solid #ccc!important;padding:0.5rem 1.5rem 0.5rem 1.5rem;margin-top:1.5rem">'+objstr1+'</div>';
        strr += '</body></html>';

        $('#generate-pdf').click(function(e){
        e.preventDefault();
        var element = document.getElementById('demo');
        //html2pdf().from(element).set(options).save();
        //html2pdf(element);
        html2pdf().from(strr).set(options).save();
        });
    </script>