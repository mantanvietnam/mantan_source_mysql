<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProject">Dự án</a> /</span>
    Danh sách dự án
  </h4>

  <p><a href="/addTask" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p> 

  </p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          

          

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
            </select>
          </div>
                   
          <div class="col-md-2">
          <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
     
        </div>
      </div>
    </div>
  </form> 
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách dự án</h5>
    <?php echo @$mess;?>
    <div id="desktop_view">
      <div class="table-responsive">
       
      </div>
    </div>
    <div id="mobile_view">
      <?php 
        if(!empty($listData)){
              foreach ($listData as $item) {

                $state = '';
                if($item->state=='new'){
                   $state = 'Mới tạo'; 
                }elseif($item->state=='process'){
                  $state = 'Đang xử lý'; 
                }elseif($item->state=='done'){
                  $state = 'Hoàn thành'; 
                }elseif($item->state=='bug'){
                  $state = 'Có lỗi'; 
                }elseif($item->state=='cancel'){
                  $state = 'Hủy bỏ'; 
                }

                $status = 'khóa';
                if($item->status=='active'){
                   $status = 'Kích hoạt'; 
                }
              
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                <p><strong>ID: </strong>:'.$item->id.'</p>
                <p><strong>Tên dự án: </strong>:'.$item->name.'</p>
                <p><strong>Leader: </strong>:'.$item->leader->name.'</p>
                <p><strong>số lượng nhận viên: </strong>:'.$item->number_staff.'</p>
                <p><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</p>
                <p><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</p>
                <p><strong>trạng thái: </strong>:'.$status.'</p>
                <p><strong>Hành động: </strong>:'.$state.'</p>
               

                <p width="5%" align="center">
                <a  class="btn btn-success" href="/addProject/?id='.$item->id.'">
                <i class="bx bx-edit-alt me-1"></i>
                </a>
                <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleProject/?id='.$item->id.'">
                <i class="bx bx-trash me-1"></i>
                </a>
                </p>
                </div>';
              }
            }else{
              echo '<tr>
              <td colspan="10" align="center">Chưa có dữ liệu</td>
              </tr>';
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
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>