<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">cecad - Home Setting</h4>
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-4">
                    <div class="card-body tab-content">
                        <div class="tab-pane active " id="navs-top-home" role="tabpanel">
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
                                    <label class="form-label" for="basic-default-fullname">Nội dung banner</label>
                                    <input type="text" class="form-control" name="contentbanner" value="<?php echo @$data['contentbanner'];?>" />
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
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề 1 lớn</label>
                                    <input type="text" class="form-control" name="titledeepbanner2" value="<?php echo @$data['titledeepbanner2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề 2 nhỏ</label>
                                    <input type="text" class="form-control" name="titlesmall" value="<?php echo @$data['titlesmall'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                                    <input type="text" class="form-control" name="contentshort1" value="<?php echo @$data['contentshort1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề 3 lớn</label>
                                    <input type="text" class="form-control" name="titlelarge" value="<?php echo @$data['titlelarge'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                                    <input type="text" class="form-control" name="contentshort2" value="<?php echo @$data['contentshort2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image home 1</label>
                                    <?php showUploadFile('imagehome1','imagehome1', @$data['imagehome1'],41);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề image 1</label>
                                    <input type="text" class="form-control" name="titleimagehome1" value="<?php echo @$data['titleimagehome1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image home 2</label>
                                    <?php showUploadFile('imagehome2','imagehome2', @$data['imagehome2'],42);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề image 2</label>
                                    <input type="text" class="form-control" name="titleimagehome2" value="<?php echo @$data['titleimagehome2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Image home 3</label>
                                    <?php showUploadFile('imagehome3','imagehome3', @$data['imagehome3'],43);?>
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề image 3</label>
                                    <input type="text" class="form-control" name="titleimagehome3" value="<?php echo @$data['titleimagehome3'];?>" />
                                </div>
                                <!--  -->
                                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide trang about 1</label>
                                    <input type="text" class="form-control" name="idslidenumber1" value="<?php echo @$data['idslidenumber1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề albums slide 1</label>
                                    <input type="text" class="form-control" name="titleidside1" value="<?php echo @$data['titleidside1'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">ID album slide trang about 2</label>
                                    <input type="text" class="form-control" name="idslidenumber2" value="<?php echo @$data['idslidenumber2'];?>" />
                                </div>
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề albums slide 2</label>
                                    <input type="text" class="form-control" name="titleidside2" value="<?php echo @$data['titleidside2'];?>" />
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