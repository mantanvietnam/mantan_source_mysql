<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">TRUYENTHONGAO - Home Setting</h4>
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
        <div class="row">
            <div class="bg-white col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
                                    KHỐI KHÁCH HÀNG CỦA CHÚNG TÔI
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-2" aria-controls="navs-top-2" aria-selected="true">
                                    KHỐI GIỚI THIỆU
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-3" aria-controls="navs-top-3" aria-selected="true">
                                     KẾT QUẢ HOẠT ĐỘNG
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-4" aria-controls="navs-4" aria-selected="true">
                                    BẢNG GIÁ
                                </button>
                            </li>
                            <!-- <li class="nav-item">
                                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-6" aria-controls="navs-6" aria-selected="true">
                                    KHỐI KHÁCH HÀNG NÓI 
                                </button>
                            </li> -->
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
                                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label class="form-label" for="basic-default-fullname">Banner</label>
                                    <?php showUploadFile('banner','banner', @$data['banner'],2);?>
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
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                                    <input type="text" class="form-control" name="titlecustomer" value="<?php echo @$data['titlecustomer'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">id_slide albums khách hàng</label>
                                    <select class="form-control" name="id_slidelistcustomer">
                                        <option value="">-- Chọn album --</option>
                                        <?php foreach ($dataalbums as $album): ?>
                                            <option value="<?php echo $album->id; ?>" 
                                                <?php echo (@$data['id_slidelistcustomer'] == $album->id) ? 'selected' : ''; ?>>
                                                <?php echo $album->title; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                             
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-2" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề in đậm giới thiệu</label>
                                    <input type="text" class="form-control" name="titleintroduce" value="<?php echo @$data['titleintroduce'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mô tả ngắn giới thiệu</label>
                                    <input type="text" class="form-control" name="descriptionintroduce" value="<?php echo @$data['descriptionintroduce'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">tiêu đề 1</label>
                                    <input type="text" class="form-control" name="vision" value="<?php echo @$data['vision'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mô tả tiêu đề 1</label>
                                    <input type="text" class="form-control" name="descriptionvision" value="<?php echo @$data['descriptionvision'];?>" />
                                </div>

                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">tiêu đề 2</label>
                                    <input type="text" class="form-control" name="mission" value="<?php echo @$data['mission'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mô tả tiêu đề 2</label>
                                    <input type="text" class="form-control" name="descriptionmission" value="<?php echo @$data['descriptionmission'];?>" />
                                </div>
                                
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                                    <input type="text" class="form-control" name="target" value="<?php echo @$data['target'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mô tả Tiêu đề 3</label>
                                    <input type="text" class="form-control" name="descriptiontarget" value="<?php echo @$data['descriptiontarget'];?>" />
                                </div>

                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">triết lý tiêu đề 4</label>
                                    <input type="text" class="form-control" name="business" value="<?php echo @$data['business'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mô tả triết lý tiêu đề 4</label>
                                    <input type="text" class="form-control" name="descriptionbusiness" value="<?php echo @$data['descriptionbusiness'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-3" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề khối</label>
                                    <input type="text" class="form-control" name="titleoperational" value="<?php echo @$data['titleoperational'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Năm hoạt động</label>
                                    <input type="text" class="form-control" name="yearactive" value="<?php echo @$data['yearactive'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số năm hoạt động</label>
                                    <input type="text" class="form-control" name="numberactive" value="<?php echo @$data['numberactive'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Khách hàng</label>
                                    <input type="text" class="form-control" name="customer" value="<?php echo @$data['customer'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số khách hàng</label>
                                    <input type="text" class="form-control" name="numbercustomer" value="<?php echo @$data['numbercustomer'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Sự kiện</label>
                                    <input type="text" class="form-control" name="events" value="<?php echo @$data['events'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Số khách hàng</label>
                                    <input type="text" class="form-control" name="numberevents" value="<?php echo @$data['numberevents'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Link youtube</label>
                                    <input type="text" class="form-control" name="video" value="<?php echo @$data['video'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">id_slide albums khách hàng</label>
                                    <select class="form-control" name="id_active">
                                        <option value="">-- Chọn album --</option>
                                        <?php foreach ($dataalbums as $album): ?>
                                            <option value="<?php echo $album->id; ?>" 
                                                <?php echo (@$data['id_active'] == $album->id) ? 'selected' : ''; ?>>
                                                <?php echo $album->title; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                          
                        </div>
                        <div class="tab-pane fade show" id="navs-4" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề lớn bảng giá</label>
                                    <input type="text" class="form-control" name="pricelist" value="<?php echo @$data['pricelist'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mô tả ngắn bảng giá</label>
                                    <input type="text" class="form-control" name="descriptionpricelist" value="<?php echo @$data['descriptionpricelist'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Tiêu đề dưới cùng khối</label>
                                    <input type="text" class="form-control" name="prilistfooter" value="<?php echo @$data['prilistfooter'];?>" />
                                </div>
                            </div>
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề lớn bảng giá 1</label>
                                    <input type="text" class="form-control" name="pricelistbasic" value="<?php echo @$data['pricelistbasic'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề bé bảng giá 1</label>
                                    <input type="text" class="form-control" name="pricelistsmallbasic" value="<?php echo @$data['pricelistsmallbasic'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">giá giảm</label>
                                    <input type="text" class="form-control" name="pricelistreducebasic" value="<?php echo @$data['pricelistreducebasic'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">giá hiện tại</label>
                                    <input type="text" class="form-control" name="pricelistPresentbasic" value="<?php echo @$data['pricelistPresentbasic'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề nhỏ</label>
                                    <input type="text" class="form-control" name="pricelistbasicvat" value="<?php echo @$data['pricelistbasicvat'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 1</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic1" value="<?php echo @$data['pricelistreceivebasic1'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 2</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic2" value="<?php echo @$data['pricelistreceivebasic2'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 3</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic3" value="<?php echo @$data['pricelistreceivebasic3'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 4</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic4" value="<?php echo @$data['pricelistreceivebasic4'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 5</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic5" value="<?php echo @$data['pricelistreceivebasic5'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 6</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic6" value="<?php echo @$data['pricelistreceivebasic6'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 7</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic7" value="<?php echo @$data['pricelistreceivebasic7'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 8</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic8" value="<?php echo @$data['pricelistreceivebasic8'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 9</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic9" value="<?php echo @$data['pricelistreceivebasic9'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 10</label>
                                    <input type="text" class="form-control" name="pricelistreceivebasic10" value="<?php echo @$data['pricelistreceivebasic10'];?>" />
                                </div>
                            </div>
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề lớn bảng giá 2</label>
                                    <input type="text" class="form-control" name="pricelistfull" value="<?php echo @$data['pricelistfull'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề bé bảng giá 2</label>
                                    <input type="text" class="form-control" name="pricelistsmallfull" value="<?php echo @$data['pricelistsmallfull'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">giá giảm</label>
                                    <input type="text" class="form-control" name="pricelistreducefull" value="<?php echo @$data['pricelistreducefull'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">giá hiện tại</label>
                                    <input type="text" class="form-control" name="pricelistPresentfull" value="<?php echo @$data['pricelistPresentfull'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Tiêu đề nhỏ</label>
                                    <input type="text" class="form-control" name="pricelistfullvat" value="<?php echo @$data['pricelistfullvat'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 1</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull1" value="<?php echo @$data['pricelistreceivefull1'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 2</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull2" value="<?php echo @$data['pricelistreceivefull2'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 3</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull3" value="<?php echo @$data['pricelistreceivefull3'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 4</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull4" value="<?php echo @$data['pricelistreceivefull4'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 5</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull5" value="<?php echo @$data['pricelistreceivefull5'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 6</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull6" value="<?php echo @$data['pricelistreceivefull6'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 7</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull7" value="<?php echo @$data['pricelistreceivefull7'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 8</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull8" value="<?php echo @$data['pricelistreceivefull8'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 9</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull9" value="<?php echo @$data['pricelistreceivefull9'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Nhận được 10</label>
                                    <input type="text" class="form-control" name="pricelistreceivefull10" value="<?php echo @$data['pricelistreceivefull10'];?>" />
                                </div>
                            </div>
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Tiêu đề lớn bảng giá 3</label>
                                    <input type="text" class="form-control" name="pricelistadvanced" value="<?php echo @$data['pricelistadvanced'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Tiêu đề bé bảng giá 3</label>
                                    <input type="text" class="form-control" name="pricelistsmalladvanced" value="<?php echo @$data['pricelistsmalladvanced'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">giá giảm</label>
                                    <input type="text" class="form-control" name="pricelistreduceadvanced" value="<?php echo @$data['pricelistreduceadvanced'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">giá hiện tại</label>
                                    <input type="text" class="form-control" name="pricelistPresentadvanced" value="<?php echo @$data['pricelistPresentadvanced'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Tiêu đề nhỏ</label>
                                    <input type="text" class="form-control" name="pricelistadvancedvat" value="<?php echo @$data['pricelistadvancedvat'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 1</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced1" value="<?php echo @$data['pricelistreceiveadvanced1'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 2</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced2" value="<?php echo @$data['pricelistreceiveadvanced2'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 3</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced3" value="<?php echo @$data['pricelistreceiveadvanced3'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 4</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced4" value="<?php echo @$data['pricelistreceiveadvanced4'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 5</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced5" value="<?php echo @$data['pricelistreceiveadvanced5'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 6</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced6" value="<?php echo @$data['pricelistreceiveadvanced6'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 7</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced7" value="<?php echo @$data['pricelistreceiveadvanced7'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 8</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced8" value="<?php echo @$data['pricelistreceiveadvanced8'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 9</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced9" value="<?php echo @$data['pricelistreceiveadvanced9'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fâullname">Nhận được 10</label>
                                    <input type="text" class="form-control" name="pricelistreceiveadvanced10" value="<?php echo @$data['pricelistreceiveadvanced10'];?>" />
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-6" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">id_albums</label>
                                    <input type="text" class="form-control" name="id_albumcustomer" value="<?php echo @$data['id_albumcustomer'];?>" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-4" role="tabpanel">
                            <div class="card-body row ">
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Title bên trái footer</label>
                                    <input type="text" class="form-control" name="titlefooterleft" value="<?php echo @$data['titlefooterleft'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo @$data['address'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo @$data['phone'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">email</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo @$data['email'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">facebook</label>
                                    <input type="text" class="form-control" name="facebook" value="<?php echo @$data['facebook'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">youtube</label>
                                    <input type="text" class="form-control" name="youtube" value="<?php echo @$data['youtube'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">instagram</label>
                                    <input type="text" class="form-control" name="instagram" value="<?php echo @$data['instagram'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">twiter</label>
                                    <input type="text" class="form-control" name="twiter" value="<?php echo @$data['twiter'];?>" />
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">image dưới cùng</label>
                                    <?php showUploadFile('imagedeep','imagedeep', @$data['imagedeep'],3);?>
                                </div>
                                <div class="mb-3 col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <label class="form-label" for="basic-default-fullname">Mã số doanh nghiệp</label>
                                    <input type="text" class="form-control" name="codebusiness" value="<?php echo @$data['codebusiness'];?>" />
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