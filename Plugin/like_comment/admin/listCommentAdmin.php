<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin Binh luận</h4>
  <!-- <p><a href="/plugins/admin/tayho360-admin-festival-addFestivalAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->
  <!-- Responsive Table -->
 <!--  <form action="" method="GET">
           <table class="table table-bordered" style="border: 1px solid #ddd!important; margin-top: 10px;">  
            <tbody><tr>
                <td>
                    <label>Tên Binh luận</label>
                    <input type="" name="name" class="form-control" placeholder="Tên lễ hội" value="">
                </td>
                 <td >
                    <br>
                    <input type="submit" name="" style="margin-top: 7px;" value="Tìm kiếm">
                </td>
              
            </tr>
        
        </tbody></table>
    </form> -->
  <div class="card">
    <h5 class="card-header">Danh sách Thông tin Binh luận</h5>
      <p><?php echo @$mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Điểm đến</th>
            <th>Khách hàng </th>
            <th>Nội dung</th>
            <th>Khiểu</th>
            <th>Xóa</th>

          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                 $custom =  getCustomer($item->idcustomer);
                  if($item->tiype=="co_quan_hanh_chinh"){
                    $title = getGovernanceAgency($item->idobject);
                    $type= 'Cơ quan hành chính';
                    $url= 'chi_tiet_co_quan_hanh_chinh/'.$title->urlSlug.'.html';
                    $name = $title->name;

                  }elseif($item->tiype=="dich_vu_ho_tro_du_lich"){
                    $title = getService($item->idobject);
                    $type= 'Dịch vụ hỗ trợ du lịch';
                    $url= 'chi_tiet_dich_vu_ho_tro_du_lich/'.$title->urlSlug.'.html';
                    $name = $title->name;
                  }elseif($item->tiype=="danh_lam"){
                    $title = getPlace($item->idobject);
                    $type= 'Danh lam thắng cảnh';
                    $url= 'chi_tiet_danh_lam/'.$title->urlSlug.'.html';
                    $name = $title->name;
                  }elseif($item->tiype=="le_hoi"){
                    $title = getFestival($item->idobject);
                    $type= 'Lễ hội';
                    $url= 'chi_tiet_le_hoi/'.$title->urlSlug.'.html';
                    $name = $title->name;
                  }elseif($item->tiype=="nha_han"){
                    $title = getRestaurant($item->idobject);
                    $type= 'Nhà hàng';
                    $url= 'chi_tiet_nha_han/'.$title->urlSlug.'.html';
                    $name = $title->name;
                  }elseif($item->tiype=="nha_hang"){
                    $title = getRestaurant($item->idobject);
                    $type= 'Nhà hàng';
                    $url= 'chi_tiet_nha_hang/'.$title->urlSlug.'.html';
                    $name = $title->name;
                  }elseif($item->tiype=="tung_tam_hoi_nghi_su_kien"){
                    $title = getEventcenter($item->idobject);
                    $type= 'Nhà hàng';
                    $url= 'chi_tiet_tung_tam_hoi_nghi_su_kien/'.$title->urlSlug.'.html';
                    $name = $title->name;
                  }elseif($item->tiype=="khach_san"){
                    $title = getHotel($item->idobject);
                    $type= 'Khách sạn';
                    $url= 'chi_tiet_khach_san/'.$title['data']['Hotel']['slug'].'.html';
                    $name = $title['data']['Hotel']['name'];
                  }

                echo '<tr>
                        <td><a href="/../../'.@$url.'" target="_blank">'.@$name.'</a></td>
                        <td>'.$custom->full_name.'</td>
                        <td>'.$item->comment.'</td>
                        <td>'.$type.'</td>
                       
                        
                       
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/like_comment-deleleCommentAdmin.php/?id='.$item->id.'">
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