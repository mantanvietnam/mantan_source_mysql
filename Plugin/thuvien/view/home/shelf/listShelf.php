<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listBuilding">Huyện <?php echo @$data->building->name; ?> </a> / <a href="/listFloor?id_building=<?php echo $data->id_building; ?>">Tầng <?php echo @$data->floor->name; ?></a> / <a href="/listRoom?id_floor=<?php echo $data->id_floor; ?>">Phòng <?php echo @$data->floor->name; ?></a> / <a href="/listShelf?id_room=<?php echo $data->id; ?>">Kệ sách</a> / </span>
    Danh sách kệ sách
  </h4>

  <p><a href="/addShelf?id_room=<?php echo $data->id; ?>" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

</p>

<!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
            <input type="hidden" class="form-control" name="id_room" value="<?php if(!empty($_GET['id_room'])) echo $_GET['id_room'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên kệ sách</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>

           <!--  <div class="col-md-1">
              <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
            </div> -->
          </div>
        </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách kệ sách </h5><!-- - <span class="text-danger"><?php echo number_format(@$totalData);?> tòa nhà</span></h5> -->
    <?php echo @$mess;?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>tên Kệ sách</th>
            <th>sách</th> 
            <th>Sửa</th>
            <th>Xoá</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              echo '<tr>
              <td>'.$item->id.'</td>
              <td>'.$item->name.'</td>
              <td><a href="/listWarehouse?id_building='.$item->id_building.'&id_floor='.$item->id_floor.'&id_room='.$item->id_room.'&id_shelf='.$item->id.'">'.$item->total_book.' đầu sách</a></td>             
              <td width="5%" align="center">
              <a class="dropdown-item" href="/addShelf/?id='.$item->id.'&id_room='.$data->id.'">
              <i class="bx bx-edit-alt me-1"></i>
              </a>
              </td>

              <td align="center">
              <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteShelf/?id='.$item->id.'&id_room='.$data->id.'">
              <i class="bx bx-trash me-1"></i>
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

<?php include(__DIR__.'/../footer.php'); ?>