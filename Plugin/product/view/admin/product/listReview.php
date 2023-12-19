<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"> <span class="text-muted fw-light"><a href="/plugins/admin/product-view-admin-product-listProduct.php">Sản phẩm</a></span> / video đập hộp</h4>

  <!-- Form Search -->
 <!--  <form method="get" action="">
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
  </form> -->
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách video đập hộp</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Khách hàng</th>
            <th>link</th>
            <th>sản phẩn </th>
            <th>ảnh</th>
            <th>duyệt</th>
            <th>Xóa</th>
          </tr>
        </thead>

        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->user->full_name.'</td>
                        <td> <a href="'.$item->note.'" target="_blank" >'.$item->note.'</a></td>
                        <td><a href="/product/'.@$item->product->slug.'.html" target="_blank" >'.@$item->product->title.'</td>
                        <td><img src="'.@$item->image.'" width="100"></td>
                        
                        <td align="center">
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                            <i class="bx bxs-show"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/product-view-admin-product-deleteReview.php/?id='.$item->id.'">
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
<?php 
            if(!empty($listData)){
              foreach ($listData as $key => $item) {?>
    <div class="modal fade" id="basicModal<?php echo $item->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">video đập hộp của khách : <?php echo $item->user->full_name; ?> </h5><br>
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                              </div>
                              <h5 class="modal-title modal-header" id="exampleModalLabel1">Id khách hàng : <?php echo $item->user->id; ?> </h5>
                             <form action="/plugins/admin/product-view-admin-product-upReview.php" method="GET">
                               <div class="modal-footer">

                                <input type="hidden" value="<?php echo $item->id; ?>"  name="id">
                                <iframe width="360" height="220" src="https://www.youtube.com/embed/<?php echo $item->note; ?>?si=4iryEOiZIA0Krkpn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                <div class="card-body">
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-12">
                                      <label class="form-label">MÃ sản phẩm </label>
                                      <input type="text" value="<?php echo @$item->id_product ?>" name="id_product" class="form-control" placeholder="" name="price">
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">ảnh</label>
                                      <?php showUploadFile('image'.$key,'image',@$item->image,$key);?>
                                    </div>
                                  </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">duyệt</button>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>
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