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
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề header</label>
                                    <input type="text" class="form-control" name="titleheader" value="<?php echo @$data['titleheader'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mô tả ngắn</label>
                                    <input type="text" class="form-control" name="descriptionheader" value="<?php echo @$data['descriptionheader'];?>" />
                                </div>
                              
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">tiêu đề 1</label>
                                    <input type="text" class="form-control" name="titlecontent1" value="<?php echo @$data['titlecontent1'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">tiêu đề 2</label>
                                    <input type="text" class="form-control" name="titlecontent2" value="<?php echo @$data['titlecontent2'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                                    <input type="text" class="form-control" name="titlecontent3" value="<?php echo @$data['titlecontent3'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề 4</label>
                                    <input type="text" class="form-control" name="titlecontent4" value="<?php echo @$data['titlecontent4'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-1" role="tabpanel">
                            <div class="card-body row ">
                    

                             
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-2" role="tabpanel">
                            <div class="card-body row ">
                   
                             
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-3" role="tabpanel">
                            <div class="card-body row ">
                             
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-4" role="tabpanel">
                            <div class="card-body row ">
                                
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-5" role="tabpanel">
                            <div class="card-body row ">
                                
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