<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCampaign">Chiến dịch</a> /</span> <?php echo $infoCampaign->name;?>
  </h4>

  <p><a href="/addCustomerCampaign/?id_campaign=<?php echo $infoCampaign->id;?>" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới khách sự kiện</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <input type="hidden" name="id" value="<?php echo @$_GET['id'];?>">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">Mã khách</label>
            <input type="text" class="form-control" name="id_customer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại khách</label>
            <input type="text" class="form-control" name="phone_customer" value="<?php if(!empty($_GET['phone_customer'])) echo $_GET['phone_customer'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Khu vực</label>
            <select name="id_location" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if(!empty($infoCampaign->location)){
                foreach($infoCampaign->location as $key=>$location){
                  if(!empty($location)){
                    if(empty($_GET['id_location']) || $_GET['id_location']!=$key){
                      echo '<option value="'.$key.'">'.$location.'</option>';
                    }else{
                      echo '<option selected value="'.$key.'">'.$location.'</option>';
                    }
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Đội nhóm</label>
            <select name="id_team" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if(!empty($infoCampaign->team)){
                foreach($infoCampaign->team as $key=>$team){
                  if(!empty($team['name'])){
                    if(empty($_GET['id_team']) || $_GET['id_team']!=$key){
                      echo '<option value="'.$key.'">'.$team['name'].'</option>';
                    }else{
                      echo '<option selected value="'.$key.'">'.$team['name'].'</option>';
                    }
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Hạng vé</label>
            <select name="id_ticket" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if(!empty($infoCampaign->ticket)){
                foreach($infoCampaign->ticket as $key=>$ticket){
                  if(!empty($ticket['name'])){
                    if(empty($_GET['id_ticket']) || $_GET['id_ticket']!=$key){
                      echo '<option value="'.$key.'">'.$ticket['name'].'</option>';
                    }else{
                      echo '<option selected value="'.$key.'">'.$ticket['name'].'</option>';
                    }
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Checkin</label>
            <select name="checkin" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(!empty($_GET['checkin']) && $_GET['checkin']==1) echo 'selected';?>>Đã checkin</option>
              <option value="2" <?php if(!empty($_GET['checkin']) && $_GET['checkin']==2) echo 'selected';?>>Chưa checkin</option>
              
            </select>
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>

          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách khách đăng ký - <?php echo number_format($totalData)?></h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50">Mã khách</th>
              <th>Checkin</th>
              <th>Khách đăng ký</th>
              <th>Khu vực</th>
              <th>Đội nhóm</th>
              <th>Hạng vé</th>
              <th width="250">Chăm sóc</th>
              <th width="50">Sửa</th>
              <th width="50">Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $checkin = '<a class="btn btn-primary" href="/checkinCampaign/?id='.$item->id.'&checkin=true">Checkin</a>';
                if(!empty($item->time_checkin)){
                  $checkin = '<p class="text-danger">'.date("H:i d/m/Y", $item->time_checkin).'</p><br/><a onclick="return confirm(\'Bạn có chắc chắn muốn hủy checkin không?\');" class="btn btn-danger" href="/checkinCampaign/?id='.$item->id.'">Hủy checkin</a>';
                }

                $history = '';
                if(!empty($item->history)){
                  $status_history = 'text-danger';

                  if($item->history->status == 'done'){
                    $status_history = 'text-success';
                  }

                  $history = '<span class="'.$status_history.'">'.date('H:i d/m/Y', $item->history->time_now).'</span>: '.$item->history->note_now;
                }

                echo '<tr>
                        <td>'.$item->id_customer.'</td>
                        <td><p class="text-success">'.date("d/m/Y", $item->create_at).'</p>'.$checkin.'</td>
                        <td>'.$item->customer_name.'<br/>'.$item->customer_phone.'</td>
                        <td>'.@$infoCampaign->location[$item->id_location].'</td>
                        <td>'.@$infoCampaign->team[$item->id_team]['name'].'</td>
                        <td>'.@$infoCampaign->ticket[$item->id_ticket]['name'].'</td>

                        <td>
                          '.$history.'
                          <p class="text-center mt-3">
                            <a href="/addCustomerHistoriesAgency/?id_customer='.$item->id_customer.'" class="btn btn-primary"><i class="bx bx-plus-medical"></i></a> 
                            <a href="/listCustomerHistoriesAgency/?id_customer='.$item->id_customer.'" class="btn btn-danger"><i class="bx bx-list-ul" ></i></a>
                          </p>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" href="/addCustomerCampaign/?id='.$item->id.'&id_campaign='.$infoCampaign->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteCustomerCampaign/?id='.$item->id.'">
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
    </div>
    <div id="mobile_view">
      <?php 
         if(!empty($listData)){
              foreach ($listData as $item) {
                 $checkin = '<a class="btn btn-primary" href="/checkinCampaign/?id='.$item->id.'&checkin=true">Checkin</a>';
                if(!empty($item->time_checkin)){
                  $checkin = '<p class="text-danger">'.date("H:i d/m/Y", $item->time_checkin).'</p><br/><a onclick="return confirm(\'Bạn có chắc chắn muốn hủy checkin không?\');" class="btn btn-danger" href="/checkinCampaign/?id='.$item->id.'">Hủy checkin</a>';
                }

                $history = '';
                if(!empty($item->history)){
                  $status_history = 'text-danger';

                  if($item->history->status == 'done'){
                    $status_history = 'text-success';
                  }

                  $history = '<span class="'.$status_history.'">'.date('H:i d/m/Y', $item->history->time_now).'</span>: '.$item->history->note_now;
                }
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                       <p><strong>ID: </strong>'.$item->id_customer.'</p>
                       <p><strong>Checkin: </strong>'.date("d/m/Y", $item->create_at).' '.$checkin.'</p>
                       <p><strong>Khách đăng ký: </strong>'.$item->customer_name.'<br/>'.$item->customer_phone.'</p>
                       <p><strong>Khu vực: </strong>'.@$infoCampaign->location[$item->id_location].'</p>
                       <p><strong>Đội nhóm: </strong>'.@$infoCampaign->team[$item->id_team]['name'].'</p>
                       <p><strong>Hạng vé:  </strong>'.@$infoCampaign->ticket[$item->id_ticket]['name'].'</p>

                       <p><strong>Chăm sóc </strong>
                        '.$history.'
                        <p class="text-center mt-3">
                          <a href="/addCustomerHistoriesAgency/?id_customer='.$item->id_customer.'" class="btn btn-primary"><i class="bx bx-plus-medical"></i></a> 
                          <a href="/listCustomerHistoriesAgency/?id_customer='.$item->id_customer.'" class="btn btn-info"><i class="bx bx-list-ul" ></i></a>
                        </p>
                      </p>

                        <p align="center">
                        <a class="btn btn-success" href="/addCustomerCampaign/?id='.$item->id.'&id_campaign='.$infoCampaign->id.'">
                          <i class="bx bx-edit-alt me-1"></i>
                        </a>  <a class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteCustomerCampaign/?id='.$item->id.'">
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