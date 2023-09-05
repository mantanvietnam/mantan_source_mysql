<?php global $type_ingredient; ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin thư viện ảnh</h4>
 <p><a href="/plugins/admin/ezpics_admin-view-admin-ingredient-addIngredientAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <form action="" method="GET">
           <table class="table table-bordered" style="border: 1px solid #ddd!important; margin-top: 10px;">  
            <tbody><tr>
                <td>
                    <label>Từ khóa </label>
                    <input type="" name="keyword" class="form-control" placeholder="Từ khóa" value="<?php echo @$_GET['keyword'] ?>">
                </td>
                <td>
                  <label >Thể loại</label>
                    <select class="form-select" name="type" id="type">
                        <option value="">Chọn thể loại</option>
                        <?php 
                            foreach($type_ingredient as $key => $value){
                               if($key == @$_GET['type']){
                                echo '<option selected  value="'.$key.'">'.$value.'</option>';
                              }else{
                                echo '<option  value="'.$key.'">'.$value.'</option>';
                              }
                            }
                        ?>
                      </select>
                </td>
               <td >
                    <button type="submit" class="btn btn-primary d-block">Lọc</button>
                </td> 
            </tr>
        
        </tbody></table>
    </form>
  <div class="card row">
    <h5 class="card-header">Thông tin thư viện ảnh</h5>
      <p><?php echo @$mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>ảnh</th>
            <th>từ khóa</th>
            <th>thể loại</th>
            <th>trạng thái</th>
            <th>sữa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status = '<span style="color: #60bc2f;">Hiện</span>';
                if(@$item->status==0){
                  $status = '<span style="color: red;">Ẩn</span>';
                }
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td><img src="'.@$item->image.'" width="100"></td>
                        <td>'.$item->keyword.'</td>
                        <td>'.$type_ingredient[$item->type].'</td>
                        <td>'.$status.'</td>
                         <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/ezpics_admin-view-admin-ingredient-addIngredientAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/ezpics_admin-view-admin-ingredient-deleteIngredientAdmin.php/?id='.$item->id.'">
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
            if(@$totalPage>0){
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