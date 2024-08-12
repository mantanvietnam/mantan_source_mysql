<?php
    getHeader();
?>
<main>
    <section>
        <div class="mt-2">
            <div class="modal-dialog">
                <div class="container modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    </div>
                    <div class="modal-body p-lg-5 pt-lg-2">
                        <h2 class="text-center mb-4">
                            FORM ĐĂNG KÝ TƯ VẤN NGAY
                        </h2>
                        <p><?= $mess; ?></p>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-component">
                                        <label for="" class="mb-1">Họ và tên <sup class="text-custom-red">*</sup></label>
                                        <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                        <input type="text" placeholder="" name="name" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-component">
                                        <label for="" class="mb-1">Email <sup class="text-custom-red">*</sup></label>
                                        <input type="text" placeholder="" name="email" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-component">
                                        <label for="" class="mb-1">Địa chỉ <sup class="text-custom-red">*</sup></label>
                                        <input type="text" placeholder="" name="address" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-component">
                                        <label for="" class="mb-1">Số điện thoại <sup class="text-custom-red">*</sup></label>
                                        <input type="text" placeholder="" name="phone" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-component">
                                <label for="" class="mb-1">Ghi chú</label>
                                <textarea class="form-control" name="content"></textarea> 
                                <input type="hidden" placeholder="" name="subject" value=" " class="form-control">                            
                            </div>
                            <div class="d-flex justify-content-center mt-5 mb-4">
                                <button class="btn custom-button button-reg">
                                    Đăng kí ngay
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
getFooter();
?>