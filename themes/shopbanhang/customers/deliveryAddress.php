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
                                <p>Địa chỉ giao hàng </p>
                            </div>
                            <div class="detail-file">
                                <form>
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                   <!--  <div class="top mt-4">
                                        <div class="d-flex">
                                            <div class="edit-user-photo me-3">
                                                <label for="" style="font-size: 23px; margin-bottom: 10px;">Ảnh đại
                                                    diện</label>
                                                    <img id="img1" src="<?php echo @$info->avatar ?>"
                                                        style="width: 110px" class="img-responsive">
                                             
                                            </div>
                                        </div>
                                    </div> -->
                                    <?php if(!empty($data)){
                                        foreach($data as $key => $item){
                                     ?>
                                    <div class="item-detail">
                                        <label for="hoTen">Địa chỉ <?php echo $key+1 ?>:</label>
                                        <label for="soDienThoai"></label>
                                    </div>
                                     <div class="address">
                                    <div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <div class="content-addr">
                                                <!-- <div class="infor-addr">
                                                    <span>Lê Viết Hiếu</span>
                                                    <p>0912345678</p>
                                                </div> -->
                                                <div class="detail-addr">
                                                    <p><?php echo $item->address_name ?></p>
                                                </div>
                                                <div class="btn-address">
                                                    <button class="lay">Địa chỉ lấy hàng</button>
                                                    <button class="tra">Địa chỉ trả hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 up-address">
                                            <div class="btn-group">
                                                <a data-bs-toggle="modal" data-bs-target="#basicModal<?php echo $item->id ?>">Cập nhật</a>
                                                <a href="/deleteAddress?id=<?php echo $item->id; ?>" class="delete-addr">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                    <?php }} ?>
                                </form>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

     <?php if(!empty($data)){
        foreach($data as $key => $items){?>
        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">                    
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Cập nhập địa chỉ </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                              </div>
                             <form action="/updateAddress" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                <input type="hidden" value="0"  name="status">
                                <input type="hidden"   name="page">
                                <div class="card-body">
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-12">
                                      <label class="form-label">Địa chỉ </label>
                                      <input type="text" value="<?php echo $items->address_name ?>" class="form-control"  name="address_name">
                                    </div>
                                    
                                  </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Cập nhập</button>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>
<?php }} ?>

</main>



<?php
getFooter();
?>