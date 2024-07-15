<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Sản phẩm</h4>
  <p><a href="/addProductAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a> <a href="/addDataProductAgency" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới bằng Excel</a>
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
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="title" value="<?php if(!empty($_GET['title'])) echo $_GET['title'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Danh mục</label>
            <select name="id_category" class="form-control">
              <option value="">Tất cả</option>
              <?php
                if(!empty($categories)){
                  foreach($categories as $item){
                    if(empty($_GET['id_category']) || $_GET['id_category']!=$item->id){
                      echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                    }else{
                      echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                    }
                  }
                }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Ghim lên đầu</label>
            <select name="hot" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="0" <?php if(isset($_GET['hot']) && $_GET['hot']=='0') echo 'selected';?> >Không ghim</option>
              <option value="1" <?php if(!empty($_GET['hot']) && $_GET['hot']=='1') echo 'selected';?> >Có ghim</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Mã sản phẩm</label>
            <input type="text" class="form-control" name="code" value="<?php if(!empty($_GET['code'])) echo $_GET['code'];?>">
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
    <h5 class="card-header">Danh sách sản phẩm</h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Hình minh họa</th>
              <th>Danh mục</th>
              <th>Tên sản phẩm</th>
              <th>Giá bán</th>
              <th>Đơn vị</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $category_name = [];
                  if(!empty($item->category)){
                    foreach($item->category as $value){
                       if(!empty($value->name_category)){
                        $category_name[]= $value->name_category;
                       }
                    }
                  }
                 
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td><img src="'.$item->image.'" width="100" /></td>
                          <td>'.implode(', ', $category_name).'</td>
                          <td><a target="_blank" href="/product/'.$item->slug.'.html">'.$item->title.'</a><br/><br/>Mã: '.$item->code.'</td>
                          <td> '.number_format($item->price).' đ</td>
                          <td align="center" >'.$item->unit.'<br/>
                          <a class="dropdown-item" href="/listUnitConversion/?id_product='.$item->id.'" title="Quy đổi đơn vị">
                             <i class="bx bx-transfer"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" href="/addProductAgency/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn khóa không?\');" href="/deleteProductAgency/?id='.$item->id.'">
                              <i class="bx bxs-trash me-1"></i>
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
                  $category_name = [];
                  if(!empty($item->category)){
                    foreach($item->category as $value){
                       if(!empty($value->name_category)){
                        $category_name[]= $value->name_category;
                       }
                    }
                  }
                   echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <center><img src="'.$item->image.'" style=" width:50%" /></center><br/>
                        <p><strong> Tên sản phẩm: </strong>'.$item->title.'</p>
                        <p><strong> Mã sản phẩm: </strong>'.$item->code.'</p>
                        <p><strong> Danh mục: </strong>'.implode(', ', $category_name).'</p>
                        <p><strong> Giá: </strong>'.number_format($item->price).'đ</p>
                        <p align="center">
                        
                          <a class="btn btn-success" href="/addProductAgency/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                          </a>
                             &nbsp;&nbsp;&nbsp;&nbsp;
                          
                          <a class=" btn btn-danger" title="Xóa sản phẩm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteProductAgency/?id='.$item->id.'">
                              <i class="bx bxs-trash me-1" style="font-size: 22px;"></i>
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
<?php include(__DIR__.'/../footer.php'); ?>