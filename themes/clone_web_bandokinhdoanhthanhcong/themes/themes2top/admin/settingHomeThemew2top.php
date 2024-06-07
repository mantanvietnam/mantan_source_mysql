<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */


?>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">wesite2top - Home Setting</h4>

    <!-- Basic Layout -->
    
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class=" mb-4">
            <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                            KHỐI ĐẦU
                            </button>
                        </li>
                        
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                                GIỚI THIỆU
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                            DỊCH VỤ
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                            NHÂN SỰ
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-evaluate" aria-controls="navs-top-image" aria-selected="false">
                                GIÁ TRỊ KHÁC BIỆT
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-information" aria-controls="navs-top-image" aria-selected="false">
                                ĐỐI TÁC NÓI 
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-news" aria-controls="navs-top-image" aria-selected="false">
                               TIN TỨC NỔI BẬT 
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contact" aria-controls="navs-top-image" aria-selected="false">
                               LIÊN HỆ
                            </button>
                        </li>
                    </ul>
            </div>
            <!-- 0 -->
            <div class="card-body tab-content ">
                <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                    <div class="card-body row ">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Logo</label>
                            <?php showUploadFile('logo','logo', @$data['logo'],1);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">ten nut bam</label>
                            <input class="form-control" type="text" name="buttontest" value="<?php echo @$data['buttontest'];?>" />
                        </div>
                       
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">ID album slide</label>
                            <input type="text" class="form-control" name="id_slide" value="<?php echo @$data['id_slide'];?>" />
                        </div>
                    </div>
                </div>
                <!-- 1 -->
                <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                    <div class="card-body row ">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">titleselft</label>
                            <input class="form-control" type="text" name="titleselft" value="<?php echo @$data['titleselft'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">title1</label>
                            <input class="form-control" type="text" name="title1" value="<?php echo @$data['title1'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">title2</label>
                            <input class="form-control" type="text" name="title2" value="<?php echo @$data['title2'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">button 1</label>
                            <input class="form-control" type="text" name="button1" value="<?php echo @$data['button1'];?>" />
                        </div>
                    </div>
                </div>
                <!-- 2 -->
                <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
                    <div class="card-body row ">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">title dich vu </label>
                            <input class="form-control" type="text" name="dichvu" value="<?php echo @$data['dichvu'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">nhieu dich vu</label>
                            <input class="form-control" type="text" name="moredichvu" value="<?php echo @$data['moredichvu'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image dich vu</label>
                            <?php showUploadFile('logodichvu','logodichvu', @$data['logodichvu'],1);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">title dich vu</label>
                            <input class="form-control" type="text" name="titledichvu" value="<?php echo @$data['titledichvu'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">van ban dich vu</label>
                            <input class="form-control" type="text" name="paragrapdichvu" value="<?php echo @$data['paragrapdichvu'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">button xem chi tiet</label>
                            <input class="form-control" type="text" name="buttonxem" value="<?php echo @$data['buttonxem'];?>" />
                        </div>
                    </div>
                </div>
                <!-- 3 -->
                <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                    <div class="card-body row ">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">title nhan su</label>
                            <input class="form-control" type="text" name="nhansu" value="<?php echo @$data['nhansu'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">title nhan su</label>
                            <input class="form-control" type="text" name="questionnhansu" value="<?php echo @$data['questionnhansu'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image nhan su</label>
                            <?php showUploadFile('imagenhansu','imagenhansu', @$data['imagenhansu'],1);?>
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">chức vụ nhân sự</label>
                            <input class="form-control" type="text" name="chucvu" value="<?php echo @$data['chucvu'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">tên nhân sự </label>
                            <input class="form-control" type="text" name="namenhansu" value="<?php echo @$data['namenhansu'];?>" />
                        </div>
                    </div>
                </div>
                <!-- 4 -->
                <div class="tab-pane fade" id="navs-top-evaluate" role="tabpanel">
                    <div class="card-body row ">
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">Giá trị khác biệt</label>
                            <input class="form-control" type="text" name="giatrikhacbiet" value="<?php echo @$data['giatrikhacbiet'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">paragrap 1</label>
                            <input class="form-control" type="text" name="parag1" value="<?php echo @$data['parag1'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">paragrap 2</label>
                            <input class="form-control" type="text" name="parag2" value="<?php echo @$data['parag2'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">paragrap 3</label>
                            <input class="form-control" type="text" name="parag3" value="<?php echo @$data['parag3'];?>" />
                        </div>
                    </div>
                    <div class="card-body row ">

                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">uy tin</label>
                            <input class="form-control" type="text" name="uytin" value="<?php echo @$data['uytin'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image 1</label>
                            <?php showUploadFile('image1','image1', @$data['image1'],1);?>
                        </div>
                     

                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">chuyen nghiep</label>
                            <input class="form-control" type="text" name="chuyennghiep" value="<?php echo @$data['chuyennghiep'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image 2</label>
                            <?php showUploadFile('image2','image2', @$data['image2'],1);?>
                        </div>


                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">sang tao</label>
                            <input class="form-control" type="text" name="sangtao" value="<?php echo @$data['sangtao'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image nhan su</label>
                            <?php showUploadFile('image3','image3', @$data['image3'],1);?>
                        </div>



                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">tong the</label>
                            <input class="form-control" type="text" name="tongthe" value="<?php echo @$data['tongthe'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image nhan su</label>
                            <?php showUploadFile('image4','image4', @$data['image4'],1);?>
                        </div>


                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">tien phong</label>
                            <input class="form-control" type="text" name="tienphong" value="<?php echo @$data['tienphong'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image nhan su</label>
                            <?php showUploadFile('image5','image5', @$data['image5'],1);?>
                        </div>



                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">baomat</label>
                            <input class="form-control" type="text" name="baomat" value="<?php echo @$data['baomat'];?>" />
                        </div>
                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">image nhan su</label>
                            <?php showUploadFile('image6','image6', @$data['image6'],1);?>
                        </div>

                        <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">paragarap</label>
                            <input class="form-control" type="text" name="paragrap1" value="<?php echo @$data['paragrap1'];?>" />
                        </div>
                    </div>
                </div>  
                
                <div class="tab-pane fade" id="navs-top-information" role="tabpanel">

                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Tên khách hàng </label>
                        <input class="form-control" type="text" name="namekhachhang" value="<?php echo @$data['namekhachhang'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Khách hàng đã nói j </label>
                        <input class="form-control" type="text" name="whatabout" value="<?php echo @$data['whatabout'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">ID album slide</label>
                            <input type="text" class="form-control" name="idsideyourself" value="<?php echo @$data['idsideyourself'];?>" />
                    </div>

                </div> 


                <div class="tab-pane fade" id="navs-top-news" role="tabpanel">
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">tin tức </label>
                        <input class="form-control" type="text" name="news" value="<?php echo @$data['news'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Các tin tức nổi bật </label>
                        <input class="form-control" type="text" name="newsnoibat" value="<?php echo @$data['newsnoibat'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">ID tin tuc</label>
                            <input type="text" class="form-control" name="idnews" value="<?php echo @$data['idnews'];?>" />
                    </div>

                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Ngày đăng</label>
                        <input class="form-control" type="text" name="time" value="<?php echo @$data['time'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Title slide tin tức </label>
                        <input class="form-control" type="text" name="titletintuc" value="<?php echo @$data['titletintuc'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">nội dung slide tin tức  </label>
                        <input class="form-control" type="text" name="contenttintuc" value="<?php echo @$data['contenttintuc'];?>" />
                    </div>

                </div> 
                <div class="tab-pane fade" id="navs-top-contact" role="tabpanel">
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Địa chỉ </label>
                        <input class="form-control" type="text" name="diachi" value="<?php echo @$data['diachi'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Số Điện thoại</label>
                        <input class="form-control" type="text" name="sdt" value="<?php echo @$data['sdt'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input class="form-control" type="text" name="email" value="<?php echo @$data['email'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <label class="form-label" for="basic-default-fullname">Thời gian hoạt động</label>
                        <input class="form-control" type="text" name="timeaction" value="<?php echo @$data['timeaction'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">facebook</label>
                            <input type="text" class="form-control" name="facebook" value="<?php echo @$data['facebook'];?>" />
                    </div>
                    <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <label class="form-label" for="basic-default-fullname">youtube</label>
                            <input type="text" class="form-control" name="youtube" value="<?php echo @$data['youtube'];?>" />
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