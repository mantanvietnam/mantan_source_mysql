<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();?>

   <main>
        <!--  -->
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                        <a href="/"><img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-form-contact">
            <div class="container">
                <form  id="formContact" onsubmit="" action="<?= $routesPlugin["contact"] ?>" method="post" class="form-custom-1 py-3">
                <div class="row row-form-contact">
                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                        <div class="form-contact-inner col-lg-9 col-md-8 col-sm-8 col-12">
                            <div class="title-form">
                                <p>For more information about WARM facility or to find out how you can help be a part of the solution, please fill in the form below.</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-contact-box">
                                <label for="name" class="form-label">Name <span>Please enter your full name</span></label>
                                <input id="name" type="text" name="name" class="form-control">
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-contact-box">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>
        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-contact-box">
                                <label for="organization" class="form-label">Organization</label>
                                <input type="text" id="organization" name="organization" class="form-control">
                            </div>
        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-contact-box">
                                <label for="email" class="form-label required-input">Your E-Mail Address</label>
                                <input type="email" id="email"  name="email" class="form-control" required>
                            </div>
        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-contact-box">
                                <label for="subject" class="form-label required-input">Subject</label>
                                <input type="text" id="subject"  name="subject" class="form-control" required>
                            </div>
        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-contact-box form-contact-comment">
                                <label for="comments" class="form-label required-input">Comments</label>
                                <textarea required id="content" name="content" rows="8"></textarea>                    
                            </div>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                    
          
                </div>
            </div>
        </section>
    </main>

  <?php getFooter();?>