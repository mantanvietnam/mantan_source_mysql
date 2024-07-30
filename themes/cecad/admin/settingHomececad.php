<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">cecad - Home Setting</h4>
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
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-2" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI NHỮNG CON SỐ ẤN TƯỢNG
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-3" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI MẠNG XÃ HỘI
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-4" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI LĨNH VỰC HOẠT ĐỘNG
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-5" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI DỰ ÁN
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-6" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI TIN TỨC
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-7" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI ĐỐI TÁC
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-8" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI FOOTER
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-9" aria-controls="navs-top-info" aria-selected="false">
                                    TRANG LIÊN HỆ
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">LOGO HEADER</label>
                                    <?php showUploadFile('logo','logo', @$data['logo'],8);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">LOGO footer</label>
                                    <?php showUploadFile('logofooter','logofooter', @$data['logofooter'],80);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide</label>
                                    <input type="text" class="form-control" name="slide_home" value="<?php echo @$data['slide_home'];?>" />
                                </div>
                                <!-- <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide albums</label>
                                    <input type="text" class="form-control" name="slide_albums" value="<?php echo @$data['slide_albums'];?>" />
                                </div> -->
                            </div>
                        </div>
                        <div class="tab-pane fade  show" id="navs-2" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title khối thứ 2</label>
                                    <input type="text" class="form-control" name="title2" value="<?php echo @$data['title2'];?>" />
                                </div>
                                <!--  -->
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số tăng thứ nhất</label>
                                    <input type="text" class="form-control" name="countnumber1" value="<?php echo @$data['countnumber1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung số tăng thứ nhất</label>
                                    <input type="text" class="form-control" name="contentnumber1" value="<?php echo @$data['contentnumber1'];?>" />
                                </div>
                                <!--  -->
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số tăng thứ hai</label>
                                    <input type="text" class="form-control" name="countnumber2" value="<?php echo @$data['countnumber2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung số tăng thứ hai</label>
                                    <input type="text" class="form-control" name="contentnumber2" value="<?php echo @$data['contentnumber2'];?>" />
                                </div>
                                <!--  -->
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số tăng thứ ba</label>
                                    <input type="text" class="form-control" name="countnumber3" value="<?php echo @$data['countnumber3'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung số tăng thứ ba</label>
                                    <input type="text" class="form-control" name="contentnumber3" value="<?php echo @$data['contentnumber3'];?>" />
                                </div>
                                <!--  -->
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số tăng thứ tư</label>
                                    <input type="text" class="form-control" name="countnumber4" value="<?php echo @$data['countnumber4'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung số tăng thứ tư</label>
                                    <input type="text" class="form-control" name="contentnumber4" value="<?php echo @$data['contentnumber4'];?>" />
                                </div>
                                <!--  -->
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số tăng thứ năm</label>
                                    <input type="text" class="form-control" name="countnumber5" value="<?php echo @$data['countnumber5'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung số tăng thứ năm</label>
                                    <input type="text" class="form-control" name="contentnumber5" value="<?php echo @$data['contentnumber5'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-3" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" value="<?php echo @$data['facebook'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Instagram</label>
                                    <input type="text" class="form-control" name="instagram" value="<?php echo @$data['instagram'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Youtube</label>
                                    <input type="text" class="form-control" name="youtube" value="<?php echo @$data['youtube'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-4" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title chữ nhỏ khối tư</label>
                                    <input type="text" class="form-control" name="titlesmall" value="<?php echo @$data['titlesmall'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title chữ to khối tư</label>
                                    <input type="text" class="form-control" name="titlelarge" value="<?php echo @$data['titlelarge'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung tiêu đề</label>
                                    <input type="text" class="form-control" name="contenttitle4" value="<?php echo @$data['contenttitle4'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Hoạt động thứ nhất</label>
                                    <input type="text" class="form-control" name="action1" value="<?php echo @$data['action1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image hoạt động thứ nhất</label>
                                    <?php showUploadFile('imageaction1','imageaction1', @$data['imageaction1'],1);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Hoạt động thứ hai</label>
                                    <input type="text" class="form-control" name="action2" value="<?php echo @$data['action2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image hoạt động thứ hai</label>
                                    <?php showUploadFile('imageaction2','imageaction2', @$data['imageaction2'],2);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Hoạt động thứ ba</label>
                                    <input type="text" class="form-control" name="action3" value="<?php echo @$data['action3'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image hoạt động thứ ba</label>
                                    <?php showUploadFile('imageaction3','imageaction3', @$data['imageaction3'],3);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Hoạt động thứ tư</label>
                                    <input type="text" class="form-control" name="action4" value="<?php echo @$data['action4'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image hoạt động thứ tư</label>
                                    <?php showUploadFile('imageaction4','imageaction4', @$data['imageaction4'],4);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Hoạt động thứ năm</label>
                                    <input type="text" class="form-control" name="action5" value="<?php echo @$data['action5'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image hoạt động thứ năm</label>
                                    <?php showUploadFile('imageaction5','imageaction5', @$data['imageaction5'],5);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Hoạt động thứ sáu</label>
                                    <input type="text" class="form-control" name="action6" value="<?php echo @$data['action6'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image hoạt động thứ sáu</label>
                                    <?php showUploadFile('imageaction6','imageaction6', @$data['imageaction6'],6);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image hoạt động giữa</label>
                                    <?php showUploadFile('imageactionbeetween','imageactionbeetween', @$data['imageactionbeetween'],7);?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-5" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title nhỏ khối 5</label>
                                    <input type="text" class="form-control" name="titlesmal5" value="<?php echo @$data['titlesmal5'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title lớn khối 5</label>
                                    <input type="text" class="form-control" name="titlelarge5" value="<?php echo @$data['titlelarge5'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image banner dự án</label>
                                    <?php showUploadFile('imagebannerproject','imagebannerproject', @$data['imagebannerproject'],50);?>
                                </div>
                            </div>
                        </div>
                         <div class="tab-pane fade show" id="navs-6" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title nhỏ khối thứ 6 </label>
                                    <input type="text" class="form-control" name="titlesmal6" value="<?php echo @$data['titlesmal6'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title lớn khối thứ 6 </label>
                                    <input type="text" class="form-control" name="titlelarge6" value="<?php echo @$data['titlelarge6'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image banner tin tức</label>
                                    <?php showUploadFile('imagebannernews','imagebannernews', @$data['imagebannernews'],51);?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-7" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title khối thứ 7 </label>
                                    <input type="text" class="form-control" name="titlenlock7" value="<?php echo @$data['titlenlock7'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Slide partner</label>
                                    <input type="text" class="form-control" name="slide_partner" value="<?php echo @$data['slide_partner'];?>" />
                                </div>
                              
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-8" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title Logo </label>
                                    <input type="text" class="form-control" name="titlelogofooter" value="<?php echo @$data['titlelogofooter'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Địa chỉ </label>
                                    <input type="text" class="form-control" name="address" value="<?php echo @$data['address'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo @$data['email'];?>"/>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo @$data['phone'];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-9" role="tabpanel">
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