<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin bình luận</h4>
  
  <div class="card row">
    <h5 class="card-header">Danh sách Thông tin bình luận</h5>
      <p><?php echo @$mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Sản phẩm</th>
            <th>Khách hàng </th>
            <th>Nội dung</th>
            <th>Nội dung trả lời</th>
            <th>Trả lời</th>
            <th>Xóa</th>

          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              
              foreach ($listData as $item) {
                 $custom =  getCustomer($item->idcustomer);
                    $url = 'product/'.$item->product->slug.'.html';
                  

                echo '<tr>
                        <td><a href="/../../'.@$url.'" target="_blank">'.@$item->product->title.'</a></td>
                        <td>'.$custom->full_name.'</td>
                        <td>'.$item->comment.'</td>
                        <td>'.$item->reply.'</td>
                       <td align="center">
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >
                            <i class="bx bx-message-rounded-dots"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/like_comment-deleleCommentAdmin/?id='.$item->id.'">
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

     <div class="col-lg-4 col-md-6">
                      <!-- <small class="text-light fw-semibold">Default</small> -->
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        
                        <!-- Modal -->
                      <?php  if(!empty($listData)){
              foreach ($listData as $items) {
                 $custom =  getCustomer($item->idcustomer);
               ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Trả lời bính luận  </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                              </div>

                            <div style=" padding: 20px; ">
                              <p><label>Sản phẩn :</label> <?php echo $item->product->title ?></p>
                              <p><label>Khách hàng :</label> <?php echo $custom->full_name ?></p>
                            <form action="/plugins/admin/like_comment-admin-replyCommentAdmin" method="GET">

                              <p><label>bình luận:</label> </p>
                              <div class="modal-footer">
                                <input type="text" class="form-control"  required="" value="<?php echo $items->comment ?>" name="comment">
                              </div>
                               <p><label>Trả lời:</label></p>
                             
                              
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                <input type="text" class="form-control"  required="" value="<?php echo @$item->reply; ?>" name="reply">
                                
                                <button type="submit" class="btn btn-primary">Từ chối</button>
                              </div>
                             </form>
                            </div>
                             
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>
                      </div>
                    </div>
  <!--/ Responsive Table -->
</div>