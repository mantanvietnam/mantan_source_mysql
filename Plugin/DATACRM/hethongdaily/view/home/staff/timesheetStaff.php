<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
<style type="text/css">
  .sticky {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            background-color: #ecfbf7 !important;
            z-index: 2;
            border-color: inherit;
            border-style: solid;
        }

</style>
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listStaff">Nhân viên</a> /</span>
    Bảng chấm công nhân viên
  </h4>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="mb-3 col-md-4">
            <label class="form-label" for="basic-default-phone">Tháng</label>
            <select name="month" class="form-select color-dropdown">
              <option value="0">Tháng</option>
              <?php
              for ($i=1; $i <= 12 ; $i++) { 
                if(!empty($_GET['month']) && $_GET['month']==$i){
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
              ?>
            </select>
          </div>

          <div class="mb-3 col-md-4">
            <label class="form-label" for="basic-default-phone">năm</label>
            <select name="year" class="form-select color-dropdown">
              <option value="0">Năm</option>
              <?php
              for ($i = date("Y"); $i >= 1950; $i--) { 
                if(!empty($_GET['year']) && $_GET['year']==$i){
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
              ?>
            </select>
          </div>
                   
          <div class="col-md-2">
          <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <div class="col-md-2">
          <label class="form-label">&nbsp;</label></br>
            <a class="btn btn-primary"  data-bs-toggle="modal" style="color: white;" data-bs-target="#basicModal" ><i class='bx bx-plus'></i>Chấm công</a>
          </div> 
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Bảng chấm công nhân viên - <span class="text-danger"></h5>
    <?php echo @$mess;?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th class="sticky">Nhân viên</th>
              <?php foreach($date as $key => $item){
                echo ' <th align="center" class="" style="text-align: -webkit-center;">'.$key.'</br>'.$item.'</th>';

              } ?>
             
              
            </tr>
          </thead>
          <tbody>
             <?php 
            if(!empty($listStaff)){
              foreach ($listStaff as $item) {
                
                
                echo '<tr>
                <td class="sticky">'.$item->name.'</td>';
                foreach($date as $key => $item){
                  echo ' <td align="center"> </td>';

                } 
                echo '</tr>';
              }
            }else{
              $total = count($date);
              $total++;
              echo '<tr>
              <td colspan="'.$total.'" align="center">Chưa có dữ liệu</td>
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
                $status= '<span class="text-danger">Khóa</span>';
                if($item->status=='active'){ 
                  $status= '<span class="text-success">Kích hoạt</span>';
                }

               

                $infoStaff = $item->full_name.'<br/>'.$item->phone;
                if(!empty($item->address)) $infoStaff .= '<br/>'.$item->address;
                if(!empty($item->email)) $infoStaff .= '<br/>'.$item->email;
                if(!empty($item->facebook)) $infoStaff .= '<br/><a href="'.@$item->facebook.'" target="_blank"><i class="bx bxl-facebook-circle"></i></a>';
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <center><img class="img_avatar" src="'.$item->avatar.'" style=" width:50%" /></center><br/>
                        <p><strong> Nhân viên: </strong>: '.$item->full_name.' (ID: '.$item->id.')</p>
                        <p><strong> Điện thoại: </strong>: '.$item->phone.'</p>
                        <p><strong> Địa chỉ: </strong>: '.$item->address.'</p>
                        <p  class="text-center mt-3">
                          <a title="Sửa" class="btn btn-success" href="/addStaff/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a> 

                          <a title="Xóa" class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteStaff/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
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
       
      </ul>
    </nav>
  </div>
  <!--/ Basic Pagination -->
</div>
<!--/ Responsive Table -->
</div>

<?php include(__DIR__.'/../footer.php'); ?>