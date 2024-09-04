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
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-banner" aria-controls="navs-top-banner" aria-selected="true">
                                    KHỐI BANNER
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-team" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI TEAMS
                                </button>
                                
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-volunteer" aria-controls="navs-top-info" aria-selected="false">
                                    KHỐI VOLUNTEERS
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane active fade show" id="navs-top-banner" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Banner home</label>
                                    <?php showUploadFile('bannerhome','bannerhome', @$data['bannerhome'],40);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề số 1</label>
                                    <input type="text" class="form-control" name="titlebanner1" value="<?php echo @$data['titlebanner1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề số 2</label>
                                    <input type="text" class="form-control" name="titlebanner2" value="<?php echo @$data['titlebanner2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tên button banner</label>
                                    <input type="text" class="form-control" name="buttonbanner" value="<?php echo @$data['buttonbanner'];?>" />
                                </div>
                                <!--  -->

                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                                    <input type="text" class="form-control" name="contentdeepbanner1" value="<?php echo @$data['contentdeepbanner1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề 2 nhỏ</label>
                                    <input type="text" class="form-control" name="titlesmall" value="<?php echo @$data['titlesmall'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                                    <input type="text" class="form-control" name="contentshort1" value="<?php echo @$data['contentshort1'];?>" />
                                </div>
                                <!--  -->
                                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide trang about 1</label>
                                    <input type="text" class="form-control" name="idslidenumber1" value="<?php echo @$data['idslidenumber1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide trang about 2</label>
                                    <input type="text" class="form-control" name="idslidenumber2" value="<?php echo @$data['idslidenumber2'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-team" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Banner team</label>
                                    <?php showUploadFile('bannerteam','bannerteam', @$data['bannerteam'],60);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                                    <input type="text" class="form-control" name="titleteam" value="<?php echo @$data['titleteam'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                                    <input type="text" class="form-control" name="contenteam" value="<?php echo @$data['contenteam'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tên nút</label>
                                    <input type="text" class="form-control" name="namebuttonteam" value="<?php echo @$data['namebuttonteam'];?>" />
                                </div>
<!--  -->
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID slide đầu</label>
                                    <input type="text" class="form-control" name="idslidedau" value="<?php echo @$data['idslidedau'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID slide hai</label>
                                    <input type="text" class="form-control" name="idslidehai" value="<?php echo @$data['idslidehai'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID slide ba</label>
                                    <input type="text" class="form-control" name="idslideba" value="<?php echo @$data['idslideba'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-volunteer" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Banner tình nguyện viên</label>
                                    <?php showUploadFile('bannervolunteers','bannervolunteers', @$data['bannervolunteers'],61);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                                    <input type="text" class="form-control" name="titlevolunteers" value="<?php echo @$data['titlevolunteers'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                                    <input type="text" class="form-control" name="contenvolunteer" value="<?php echo @$data['contenvolunteer'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tên nút</label>
                                    <input type="text" class="form-control" name="namebuttonvolunteer" value="<?php echo @$data['namebuttonvolunteer'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                        <label class="form-label" for="basic-default-fullname">ID slide tình nguyện viên</label>
                                        <input type="text" class="form-control" name="idslidevolunteers" value="<?php echo @$data['idslidevolunteers'];?>" />
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