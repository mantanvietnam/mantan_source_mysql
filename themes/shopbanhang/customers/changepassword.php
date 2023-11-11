<?php
global $session;
$info = $session->read('infoUser');
getHeader();
?>

<main>
    <div id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php include('menu.php'); ?>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab-content" style="height:100%">
                        <div id="super-sale" class="tab-pane active" style="border:1px solid #ccc">
                            <div class="title-file">
                                <p>Đổi mật khẩu</p>
                                <?php echo @$mess; ?>
                            </div>
                                <div class="detail-file detail-change-password">
                                <form action="" method="post">
                                        <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                        <div class="col-12">
                                            <div class="form-group-user mb-4">
                                                <label class="mb-2 mt-3"  for="" >Mật khẩu hiện tại</label>
                                                <div class="d-flex align-items-center input-password">
                                                    <input type="password" placeholder="Vui lòng nhập mật khẩu hiện tại"
                                                        name="oldpass" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group-user mb-4">
                                                <label class="mb-2" for="">Mật khẩu mới</label>
                                                <div class="d-flex align-items-center input-password">
                                                    <input type="password" placeholder="Vui lòng nhập mật khẩu mới" name="pass"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <label class="mb-2" for="">Nhập lại mật khẩu</label>
                                                    <div class="d-flex align-items-center input-password">
                                                        <input type="password" placeholder="Vui lòng nhập lại mật khẩu mới"
                                                            name="passAgain" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit"
                                                class="mt-3 btn btn-primary button-submit-custom" style="width:100px">Lưu</button>
                                    </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
getFooter();
?>