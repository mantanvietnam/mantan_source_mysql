<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Sản phẩm</h4>
  <p><a href="/plugins/admin/product-view-admin-product-addProduct.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a>
  &ensp;&ensp; <a href="/plugins/admin/product-view-admin-product-ListQuestion.php?id_product=0" class="btn btn-primary"><i class='bx bx-plus'></i> câu hỏi chung</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">Mã SP</label>
            <input type="text" class="form-control" name="code" value="<?php if(!empty($_GET['code'])) echo $_GET['code'];?>">
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
            <label class="form-label">Nhà sản xuất</label>
            <select name="id_manufacturer" class="form-control">
              <option value="">Tất cả</option>
              <?php
                if(!empty($manufacturers)){
                  foreach($manufacturers as $item){
                    if(empty($_GET['id_manufacturer']) || $_GET['id_manufacturer']!=$item->id){
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
    <h5 class="card-header">Danh sách sản phẩm</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Mã SP</th>
            <th>Hình minh họa</th>
            <th>Danh mục</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>câu hỏi</th>
            <th>Flash sale</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $category_name = '';
                if(!empty($item->category)){
                  foreach($item->category as $value){
                     if(!empty($value->name_category)){
                      $category_name .= $value->name_category.',</br> ';
                     }
                  }
                }
                $flash_sale = '';
                if(@$item->flash_sale==1){
                  $flash_sale = '<a class="dropdown-item" onclick="return confirm(\'Bạn có chắc bỏ Flash sale không?\');" href="/plugins/admin/product-view-admin-product-addFlashSale.php/?id='.$item->id.'&flash_sale=0"><i class="bx bx-check-square"></i></a>';
                }else{
                  $flash_sale = '<a class="dropdown-item" onclick="return confirm(\'Bạn có chắc áp Flash sale không?\');" href="/plugins/admin/product-view-admin-product-addFlashSale.php/?id='.$item->id.'&flash_sale=1"><i class="bx bxs-check-square"></i></a>';
                }
                echo '<tr>
                        <td>'.$item->code.'</td>
                        <td><img src="'.$item->image.'" width="100" /></td>
                        <td>'.$category_name.'</td>
                        <td><a target="_blank" href="/product/'.$item->slug.'.html">'.$item->title.'</a></td>
                        <td> Sl ban đầu:'.$item->number_like.'<br/>
                              Sl còn:'.$item->quantity.'<br/>
                            SL đã bán:'.$item->sold.'<br/>
                        </td>
                        <td>'.$item->status.'</td>
                        <td align="center">
                        câu hỏi<br/>
                        <a class="dropdown-item"  href="/plugins/admin/product-view-admin-product-ListQuestion.php/?id_product='.$item->id.'"><i class="bx bxs-message-dots"></i></a><br/>
                        đánh giá <br/>
                        <a class="dropdown-item"  href="/plugins/admin/product-view-admin-evaluate-listEvaluate.php/?id_product='.$item->id.'"><i class="bx bxs-comment-detail"></i></a></td>
                        <td align="center">'.$flash_sale.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/product-view-admin-product-addProduct.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/product-view-admin-product-deleteProduct.php/?id='.$item->id.'">
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