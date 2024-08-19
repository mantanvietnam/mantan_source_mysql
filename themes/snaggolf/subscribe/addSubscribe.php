<?php
    getHeader();
?>
    <main>
        <section class="form-custom">
            <div class="container">
                <h3>ĐĂNG KÝ NHẬN ƯU ĐÃI</h3>
                <div class="form-contain">
                    <form action="/subscribe" method="post">
                        <div class="row g-3">
                            <div class="col-12 col-lg-12 mt-0 mb-2 justify-content-center">
                                <?php echo $mess?>
                                <div class="form-field">
                                    <label for="">Email <sup>*</sup></label>
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <input required type="text" name="email" class="form-control" placeholder="">
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
<?php
getFooter();
?>