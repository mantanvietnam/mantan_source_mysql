<?php getHeader();?>
<main>
    <section class="head-component">
        <div class="container">
            <h1>Phương pháp SNAG</h1>
        </div>
    </section>

    <section class="form-custom">
        <div class="container">
            <h3>ĐĂNG KÝ NHẬN ƯU ĐÃI</h3>
            <div class="form-contain">
                <form action="/contact" method="POST">
                    <div class="row g-3">
                        <div class="col-12 col-lg-12 mt-0 mb-2 justify-content-center">
                            <div class="form-field">
                                <label for="">Họ và tên <sup>*</sup></label>
                                <input required type="text" name="name" class="form-control" placeholder="">
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                <input type="hidden" class="form-control" name="content" value=" "></input> 
                                <input type="hidden" placeholder="" name="email" value=" " required class="form-control">
                                <input type="hidden" placeholder="" name="address" value=" " required class="form-control">
                                <input type="hidden" placeholder="" name="phone" value=" " required class="form-control">
                                <input type="hidden" placeholder="" name="subject" value="ĐĂNG KÝ NHẬN ƯU ĐÃI" class="form-control">   
                            </div>
                        </div>
                       
                    
                        
                                   
                                        
                                 
                                   
                            
                                                     
                      
                    </div>
                    <div class="submit d-flex justify-content-center">
                        <button type="submit" class="custom-button button-reg">ĐĂNG KÝ NGAY</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php getFooter();?>