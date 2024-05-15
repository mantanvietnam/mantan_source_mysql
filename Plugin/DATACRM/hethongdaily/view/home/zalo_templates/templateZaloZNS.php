<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/templateZaloZNS">Zalo ZNS</a> /</span>
    Danh sách mẫu tin ZNS
  </h4>

  <p><a href="/addTemplateZaloZNS" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mẫu tin</a></p>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách mẫu tin nhắn ZNS</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Tên mẫu</th>
            <th>ID ZNS</th>
            <th>Nội dung mẫu</th>
            <th>Gửi</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
               echo '<tr>
              <td>'.$item->id.'</td>
              <td>'.$item->name.'</td>
              <td>'.$item->id_zns.'</td>
              <td>'.$item->content_example.'</td>
              <td align="center">
                <a class="dropdown-item" href="/sendMessZaloZNS/?id_template='.$item->id.'">
                  <i class="bx bx-send me-1"></i>
                </a>
              </td>

              <td align="center">
                <a class="dropdown-item" href="/addTemplateZaloZNS/?id='.$item->id.'">
                  <i class="bx bx-edit-alt me-1"></i>
                </a>
              </td>

              <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteTemplateZaloZNS/?id='.$item->id.'">
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