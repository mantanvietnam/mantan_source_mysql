<script language="javascript" type="text/javascript" src="/plugins/ezpics_admin/view/admin/js/ezpics_admin.js"></script>
<link rel="stylesheet" href="/plugins/ezpics_admin/view/admin/css/ezpics_admin.css" />
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Kho mẫu thiết kế</h4>
  <p><a  href="/plugins/admin/ezpics_admin-view-admin-warehouse-addWarehouseAdmin" style=" color: white; " class="btn btn-primary"><i class='bx bx-plus'></i> Thêm kho mẫu thiết kế</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tên kho mẫu</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">SĐT designer</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tạo từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách kho mẫu thiết kế - <b class="text-danger"><?php echo number_format($totalData);?></b> Kho</h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Ảnh đại diện</th>
              <th>Tên kho</th>
               <th>Chủ kho</th> 
              <th>Giá bán</th>
              <th>Hết hạn</th>
              <th>Sửa</th>
              <th>Xóa</th>
              <th>Trạng thái</th>
             
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';

                   $status = 'Kích hoạt <br/>
                   <a class="dropdown-item"  title="Khóa kho" onclick="return confirm(\'Bạn có chắc chắn muốn khóa kho không?\');" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                              <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  if($item->status==0){
                    $status = 'Khóa <br/>
                   <a class="dropdown-item"  title="Kích hoạt kho" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt kho không?\');" href="/plugins/admin/ezpics_admin-view-admin-warehouse-lockWarehouse/?id='.$item->id.'&status=1">
                              <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  }
                  ?>
                    <tr>
                      <td><?php echo @$item->id ?></td>
                      <td><img src="<?php echo @$item->thumbnail ?>" width="100" /></td>
                      <td><a href="<?php echo $link_share ?>" target="_blank" ><?php echo $item->name ?></a></td>
                      <td>
                        <?php echo  $item->designer->name ?><br/>
                        <?php echo  $item->designer->phone ?><br/>
                        <?php echo  $item->designer->email ?>
                      </td>
                      <td><?php echo number_format($item->price); ?></td>
                      <td><?php echo date('H:i d/m/Y', strtotime($item->deadline_at)); ?></td>
                      <td><a class="dropdown-item"  title="Sửa" onclick="return confirm('Bạn có chắc chắn muốn Kích hoạt kho không?');" href="/plugins/admin/ezpics_admin-view-admin-warehouse-addWarehouseAdmin/?id=<?php echo $item->id ?>">
                              <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                            </a></td>
                      <td><a  class="dropdown-item"  title="Xóa kho" data-bs-toggle="modal" data-bs-target="#deteleWarehouses<?php echo $item->id ?>">
                              <i class="bx bx-trash" style="font-size: 22px;"></i>
                            </a></td>
                      <td align="center"><?php echo $status ?></td>
                    </tr>
             <?php   }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có mẫu thiết kế</td>
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
                  $link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';
                  $status = 'Kích hoạt <br/>
                   <a class="btn btn-danger"  title="Khóa kho" style="color: #fff;" onclick="return confirm(\'Bạn có chắc chắn muốn khóa kho không?\');" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                              Khóa
                            </a>';
                  if($item->status==0){
                    $status = 'Khóa <br/>
                   <a class="btn btn-success"  title="Kích hoạt kho" style="color: #fff;" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt kho không?\');" href="/plugins/admin/ezpics_admin-view-admin-warehouse-lockWarehouse/?id='.$item->id.'&status=1">
                             Kích hoạt
                            </a>';
                  }
                  ?>
                    <div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><b>Kho <?php echo @$item->id ?>:</b> <a href="<?php echo $link_share ?>" target="_blank" ><?php echo $item->name ?></a></p>
                      <p><img src="<?php echo @$item->thumbnail ?>" style="width: 100%;" /></p>
                      <p><b>Chủ kho:  </b></br>
                        <?php echo  $item->designer->name ?><br/>
                        <?php echo  $item->designer->phone ?><br/>
                        <?php echo  $item->designer->email ?>
                      </p>

                      <p><b>Giá:  </b><?php echo number_format($item->price); ?></p>
                      <p><b>trạng thái: <?php echo $status; ?> &nbsp; &nbsp; &nbsp;  <a class="btn btn-success"  title="Sửa" onclick="return confirm('Bạn có chắc chắn muốn Kích hoạt kho không?');" href="/plugins/admin/ezpics_admin-view-admin-warehouse-addWarehouseAdmin/?id=<?php echo $item->id ?>">
                             sửa
                            </a>  &nbsp; &nbsp; &nbsp;  <a  class="btn btn-danger" style="color: #fff;"  title="Xóa kho" data-bs-toggle="modal" data-bs-target="#deteleWarehouses<?php echo $item->id ?>">
                              Xóa
                            </a></p>
                    </div>
             <?php   }
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
 <div class="col-lg-4 col-md-6">
                      <!-- <small class="text-light fw-semibold">Default</small> -->
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        
                        <!-- Modal -->
                      <?php  if(!empty($listData)){
              foreach ($listData as $items) { ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Nội dung Khóa kho của Kho ID: <?php echo $items->id; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                             <form action="/plugins/admin/ezpics_admin-view-admin-warehouse-lockWarehouse" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                <input type="hidden" value="0"  name="status">
                                <input type="hidden" value="<?php echo @$_GET['page']; ?>"  name="page">
                                <input type="text" value="" class="form-control"  required="" name="note">
                                
                                <button type="submit" class="btn btn-primary">Từ chối</button>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>

                         <div class="modal fade" id="deteleWarehouses<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Bạn xác nhận xóa kho của Kho ID: <?php echo $items->id; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                             <form action="/plugins/admin/ezpics_admin-view-admin-warehouse-deteleWarehouses" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                
                                
                                <button type="submit" class="btn btn-primary">xác nhận</button>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>
                      </div>
                    </div>


  <!--/ Responsive Table -->
</div>
<script type="text/javascript">
  function copyToClipboard(textCopy,messId) {
    // Create a "hidden" input
    var aux = document.createElement("input");

    // Assign it the value of the specified element
    aux.setAttribute("value", textCopy);

    // Append it to the body
    document.body.appendChild(aux);

    // Highlight its content
    aux.select();

    // Copy the highlighted text
    document.execCommand("copy");

    // Remove it from the body
    document.body.removeChild(aux);

    // show mess
    $('#'+messId).html('Đã sao chép');

    setInterval(emptyMess, 3000,messId);

}
</script>