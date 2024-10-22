<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">VEMOI - Home Setting</h4>
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-4">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                    KHỐI BANNER
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-1" aria-controls="navs-top-1" aria-selected="true">
                                    KHỐI NHỮNG CON SỐ ẤN TƯỢNG
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-2" aria-controls="navs-top-2" aria-selected="true">
                                    KHỐI NHÀ TÀI TRỢ
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-3" aria-controls="navs-top-3" aria-selected="true">
                                    KHỐI TẠO SỰ KIỆN
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-5" aria-controls="navs-5" aria-selected="true">
                                    KHỐI LIÊN HỆ
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-4" aria-controls="navs-top-4" aria-selected="true">
                                    KHỐI FOOTER
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">LOGO HEADER</label>
                                    <?php showUploadFile('logo','logo', @$data['logo'],1);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide banner</label>
                                    <input type="text" class="form-control" name="slide_banner" value="<?php echo @$data['slide_banner'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề banner đầu màu đỏ</label>
                                    <input type="text" class="form-control" name="titleredbanner" value="<?php echo @$data['titleredbanner'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề banner đầu màu đen</label>
                                    <input type="text" class="form-control" name="titleblackbanner" value="<?php echo @$data['titleblackbanner'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">mô tả ngắn banner</label>
                                    <input type="text" class="form-control" name="descriptionbanner" value="<?php echo @$data['descriptionbanner'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">image trái banner</label>
                                    <?php showUploadFile('image1','image1', @$data['image1'],2);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">image phải banner</label>
                                    <?php showUploadFile('image2','image2', @$data['image2'],3);?>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-1" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Icon 1</label>
                                    <?php showUploadFile('icon1','icon1', @$data['icon1'],4);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Icon2</label>
                                    <?php showUploadFile('icon2','icon2', @$data['icon2'],5);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Icon3</label>
                                    <?php showUploadFile('icon3','icon3', @$data['icon3'],6);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">con số 1</label>
                                    <input type="text" class="form-control" name="number1" value="<?php echo @$data['number1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">con số 2</label>
                                    <input type="text" class="form-control" name="number2" value="<?php echo @$data['number2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">con số 3</label>
                                    <input type="text" class="form-control" name="number3" value="<?php echo @$data['number3'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề icon 1</label>
                                    <input type="text" class="form-control" name="titleicon1" value="<?php echo @$data['titleicon1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề icon 2</label>
                                    <input type="text" class="form-control" name="titleicon2" value="<?php echo @$data['titleicon2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề icon 3</label>
                                    <input type="text" class="form-control" name="titleicon3" value="<?php echo @$data['titleicon3'];?>" />
                                </div>

                             
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-2" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide nhà tài trợ</label>
                                    <input type="text" class="form-control" name="slidealbumNTT" value="<?php echo @$data['slidealbumNTT'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề to </label>
                                    <input type="text" class="form-control" name="titleNTT" value="<?php echo @$data['titleNTT'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề bé</label>
                                    <input type="text" class="form-control" name="titleNTTsmall" value="<?php echo @$data['titleNTTsmall'];?>" />
                                </div>
                             
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-3" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề to tạo sự kiện</label>
                                    <input type="text" class="form-control" name="titlesukien" value="<?php echo @$data['titlesukien'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề bé tạo sự kiện </label>
                                    <input type="text" class="form-control" name="titlesmallsukien" value="<?php echo @$data['titlesmallsukien'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">image</label>
                                    <?php showUploadFile('imagefull','imagefull', @$data['imagefull'],7);?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-4" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung mô tả footer</label>
                                    <input type="text" class="form-control" name="descriptionfooter" value="<?php echo @$data['descriptionfooter'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                    <input type="text" class="form-control" name="emailfooter" value="<?php echo @$data['emailfooter'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Instagram</label>
                                    <input type="text" class="form-control" name="Instagram" value="<?php echo @$data['Instagram'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Facebook</label>
                                    <input type="text" class="form-control" name="Facebook" value="<?php echo @$data['Facebook'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Twitter</label>
                                    <input type="text" class="form-control" name="Twitter" value="<?php echo @$data['Twitter'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">YouTube</label>
                                    <input type="text" class="form-control" name="YouTube" value="<?php echo @$data['YouTube'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-5" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image tiêu đề liên hệ</label>
                                    <?php showUploadFile('imageheadercontact','imageheadercontact', @$data['imageheadercontact'],11);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image liên hệ</label>
                                    <?php showUploadFile('imagecontact','imagecontact', @$data['imagecontact'],10);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">map</label>
                                    <input type="text" class="form-control" name="map" value="<?php echo @$data['map'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo @$data['phone'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">address</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo @$data['address'];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <button type="submit" class="btn btn-primary" style="width:75px; height: 35px;">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>