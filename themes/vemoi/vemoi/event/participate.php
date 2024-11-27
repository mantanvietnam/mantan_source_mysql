<?php 
    getHeader();
    global $settingThemes;
    global $session;
    $info = $session->read('infoUser');
?>
<main>
        <div class="register">
            <div class="container d-flex align-items-center">
                <div class="back d-flex">
                    <a href="/detailevent/<?php echo $infoEvent->slug;?>.html"><i class="fa-solid fa-chevron-left"></i></a>
                    <p>Đăng kí tham gia</p>
                </div>
                <div class="step">
                    <div class="progress-container">
                        <div class="step-container">
                            <a href="" class="step-link active hot">
                                <div class="step step1">
                                    <span class="step-number step-number-1">1</span>
                                </div>
                            </a>
                            <div class="step-line"></div>
                            <a href="" class="step-link">
                                <div class="step">
                                    <span class="step-number">2</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <div class="form pt-3 pb-3">
                <div class="form-container">
                    <form id="registerForm" method="post"  enctype="multipart/form-data">
                        <!-- <p><?=$mess?></p> -->
                        <input type="hidden" value="<?php echo $csrfToken;?>"  name="_csrfToken">

                        <div class="row">
                             <?php if(!empty($infoEvent)){ ?>
                            <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="edit-user-photo me-3">
                                            <label for="" style="font-size: 23px; margin-bottom: 10px;">Ảnh đại diện in vè mười </label>

                                            <div class="m_bg_img" style="">
                                                <input type="file" onchange="readURL1(this);" name="avatar">

                                                <img id="img1" src="<?php echo @$info['avatar'] ?>" style="width: 110px" class="img-responsive">
                                            </div>
                                        </div>
                                        <div>
                                          
                                        </div>
                                    </div>
                                </div>

                        <?php } ?>
                            <div class="col-md-6">
                                <label for="name">Họ tên đầy đủ *</label>
                                <input class="form-control" type="text" id="name" name="name" value="<?php echo @$info['name'];?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone">Điện thoại *</label>
                                <input class="form-control" type="text" id="phone" name="phone" value="<?php echo @$info['phone'];?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo @$info['email'];?>">
                            </div>

                            <div class="col-md-6">
                                <label for="city">Bạn đến từ tỉnh/thành phố nào?</label>
                                <input class="form-control" type="text" id="city" name="city" placeholder="">
                            </div>


                            <div class="col-md-6">
                                <label for="sex">Giới tính</label>
                                <select id="sex" name="sex" class="form-select">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="date">Ngày sinh</label>
                                <input class="form-control" type="date" id="date" name="date">
                            </div>
                        </div>
                       

                        <button type="submit" class="submit-btn">Đăng ký thông tin</button>
                    </form>
                </div>
            </div>
        </section>
        <?php if(!empty($data)){?>
            <div class="modal fade show" id="basicModal" style="display: block;"  name="id">

              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1"><?php echo @$mess?> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    </div>
                    <div>
                        <?php if(!empty($data->invitation)){
                            echo ' <img id="imageToDownload" src="'.$data->invitation.'" style="width: 100%;">';
                        } ?>
                       
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
</main>
<script>
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img1')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    .thaydoi {
        padding: 0 20px;
    }

    .m_bg_img {
        width: 140px;
        height: 140px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ddd;
        max-width: 100%;
        border-radius: 50%;
        overflow: hidden;
        background: white;
    }

    input[type=file] {
        display: block;
        filter: alpha(opacity = 0);
        height: 220px;
        width: 300px;
        opacity: 0;
        position: absolute;
        left: 79px;
        text-align: right;
        top: 408px;
        cursor: pointer;
        z-index: 5;
    }

    .m_bg_img img {
        max-width: 100% !important;
    }


    .button-submit-custom {
        width: 200px;
    }
</style>
<?php getFooter();?>