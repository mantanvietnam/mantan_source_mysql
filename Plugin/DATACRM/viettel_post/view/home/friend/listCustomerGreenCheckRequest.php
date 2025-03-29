<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomerAgency">Khách hàng</a> /</span>
    Danh sách khách hàng yêu cấu lên tích xanh
  </h4>


  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
         <!--  <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>
 -->
          <div class="col-md-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

         
          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="blue_check" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="request" <?php if(!empty($_GET['blue_check']) && $_GET['blue_check']=='request') echo 'selected';?> >Yêu cầu</option>
              <option value="active" <?php if(!empty($_GET['blue_check']) && $_GET['blue_check']=='active') echo 'selected';?> >Đã tích xanh</option>
            </select>
          </div>
        
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label> 
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <div class="col-md-1">
            <!-- s<label class="form-label">&nbsp;</label> -->
            <!-- <input type="submit" class="btn btn-danger d-block" value="Excel" name="action"> -->
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách khách hàng yêu cầu lên tích - <span class="text-danger"><?php echo number_format($totalData);?> khách hàng</span></h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Hình đại diện</th>
              <th>Thông tin Khách hàng</th>
              <th>bạn bè</th>
              <th>Điểm</th>
              <th>Link bài báo</th>
              <th>Xem</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status= '<span class="text-danger">Yêu cầu</span>';
                if($item->blue_check=='active'){ 
                  $status= '<span class="text-success">Đã tích xanh</span>';
                }

               
                $infoCustomer = $item->full_name.'<br/>'.$item->phone;
                if(!empty($item->address)) $infoCustomer .= '<br/>'.$item->address;
                if(!empty($item->email)) $infoCustomer .= '<br/>'.$item->email;
                $infoCustomer .= '<br/>'.$status;
                if(!empty($item->facebook)) $infoCustomer .= '<br/><a href="'.@$item->facebook.'" target="_blank"><i class="bx bxl-facebook-circle"></i></a>';
                
                echo '<tr>
                <td>'.$item->id.'</td>
                <td><img class="img_avatar" src="'.$item->avatar.'" width="80" height="80" /></td>
                <td>'.$infoCustomer.'</td>
                <td>'.$item->total_friend.'</td>
                <td>'.$item->point.'</td>
                <td> <a target="_blank" href="'.@$item->verify->link_news.'">'.@$item->verify->link_news.'</a></td>
                <td width="5%" align="center">
                <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >
                <i class="bx bx-edit-alt me-1"></i>
                </a>
                </td>
                </tr>';
              }
            }else{
              echo '<tr>
              <td colspan="10" align="center">Chưa có dữ liệu</td>
              </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="mobile_view">
      <?php 
         if(!empty($listData)){
              foreach ($listData as $item) {
                $status= '<span class="text-danger">Yêu cầu</span>';
                if($item->blue_check=='active'){ 
                  $status= '<span class="text-success">Đã tích xanh</span>';
                }

               
                $infoCustomer = $item->full_name.'<br/>'.$item->phone;
                if(!empty($item->address)) $infoCustomer .= '<br/>'.$item->address;
                if(!empty($item->email)) $infoCustomer .= '<br/>'.$item->email;
                $infoCustomer .= '<br/>'.$status;
                if(!empty($item->facebook)) $infoCustomer .= '<br/><a href="'.@$item->facebook.'" target="_blank"><i class="bx bxl-facebook-circle"></i></a>';
                
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                <p>'.$item->id.'</p>
                <p><img class="img_avatar" src="'.$item->avatar.'" width="80" height="80" /></p>
                <p>'.$infoCustomer.'</p>
                <p>'.$item->total_friend.'</p>
                <p>'.$item->point.'</td>
                <p> <a target="_blank" href="'.$item->verify->link_news.'">'.$item->verify->link_news.'</a></p>
                <p width="5%" align="center">
                <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >
                <i class="bx bx-edit-alt me-1"></i>
                </a>
                </p>
                </div>';

          }
         
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
                </div>';
        }
      ?>
    </div>

  <!-- Phân trang -->
  <div class="demo-inline-spacing">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <?php
        if($totalPage>0){
          if ($page > 5) {
            $startPage = $page - 5;
          } else {
            $startPage = 1;
          }

          if ($totalPage > $page + 5) {
            $endPage = $page + 5;
          } else {
            $endPage = $totalPage;
          }

          echo '<li class="page-item first">
          <a class="page-link" href="'.$urlPage.'1"
          ><i class="tf-icon bx bx-chevrons-left"></i
          ></a>
          </li>';

          for ($i = $startPage; $i <= $endPage; $i++) {
            $active= ($page==$i)?'active':'';

            echo '<li class="page-item '.$active.'">
            <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
            </li>';
          }

          echo '<li class="page-item last">
          <a class="page-link" href="'.$urlPage.$totalPage.'"
          ><i class="tf-icon bx bx-chevrons-right"></i
          ></a>
          </li>';
        }
        ?>
      </ul>
    </nav>
  </div>
  <!--/ Basic Pagination -->
</div>
<!--/ Responsive Table -->
</div>

    <?php  if(!empty($listData)){
              foreach ($listData as $item) { ?>
                        <div class="modal fade" id="basicModal<?php echo @$item->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header form-label border-bottom">
                                <h5 class="modal-title" id="exampleModalLabel1">Thông tin phê duyệt tích xanh </h5>
                                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                             <form action="paymentBill" method="GET">
                               <div style="padding: 24px;">
                                <p><label>Tên khách hàng:</label> <?php echo @$item->full_name ?></p>
                                <p><label>Số điện thoại:</label> <?php echo @$item->phone ?></p>
                                <p><label>Địa chỉ :</label> <?php echo @$item->address ?></p>
                                <p><label>Email:</label> <?php echo @$item->email ?></p>
                                <p><label>Điểm:</label> <?php echo @$item->point ?></p>
                                <p><label>Bạn bè :</label> <?php echo @$item->total_friend ?></p>
                                <p><label>Link bài báo: </label><a target="_blank" href="><?php echo @$item->verify->link_news ?>"><?php echo @$item->verify->link_news ?></a></p>
                                <div class="row">
                                  <div class="col-md-6 mb-4">
                                <p><label>Ảnh đại diện:</label></p>
                                  <img  src="<?php echo @$item->avatar; ?>" width="150" height="150" />
                                </div>
                                 <div class="col-md-6 mb-4">

                                <p><label>Ảnh khuôn mặt:</label></p>
                                  <img  src="<?php echo @$item->verify->image_face; ?>" width="150" height="150" />
                                </div>
                                <div class="col-md-6 mb-4">
                                  <p><label>Ảnh căn cước công dân mặt trước:</label></p>
                                  <img  src="<?php echo @$item->verify->image_card_before; ?>" width="200" height="150" />
                                </div>
                                 <div class="col-md-6 mb-4">
                                  <p><label>Ảnh căn cưới công dân mặt sau:</label></p>
                                  <img  src="<?php echo @$item->verify->image_card_after; ?>" width="200" height="150" />
                                </div>
                                <div class="col-md-6 mb-4">
                                  <p><label>Ảnh căn giấy phét kinh doanh mặt trước:</label></p>
                                  <img  src="<?php echo @$item->verify->image_license_before; ?>" width="200" height="150" />
                                </div>
                                 <div class="col-md-6 mb-4">
                                  <p><label>Ảnh căn giấy phét kinh doanh mặt sau:</label></p>
                                  <img  src="<?php echo @$item->verify->image_license_after; ?>" width="200" height="150" />
                                </div>
                              </div>
                              <?php if($item->blue_check=='request'){?>
                                <a  href="/updateGreenCheckRequest?id=<?php echo @$item->id ?>&blue_check=active" class="btn btn-primary" style="color: white;">Duyệt </a>
                              <?php } ?>

                                <a href="/updateGreenCheckRequest?id=<?php echo @$item->id ?>&blue_check=lock"  class="btn btn-danger" style="color: white;">Hủy </a>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>

<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>