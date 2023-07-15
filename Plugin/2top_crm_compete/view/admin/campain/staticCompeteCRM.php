<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/2top_crm_compete-view-admin-campain-listCompeteCRM.php">Chiến dịch thi đua</a> /</span>
    Thống kê thi đua
  </h4>
  
  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header"><?php echo $data->title;?></h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>STT</th>
            <th>Ảnh đại diện</th>
            <th>Người thực hiện</th>
            <th>Điểm thưởng</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($staticPoint)){
              $number = 0;
              foreach ($staticPoint as $idCustomer=>$point) {
                $number ++;
                echo '<tr>
                        <td>'.number_format($number).'</td>
                        <td><img src="'.$customers[$idCustomer]->avatar.'" width="100" /></td>
                        <td>
                          '.$customers[$idCustomer]->full_name.'<br/>
                          '.$customers[$idCustomer]->phone.'<br/>
                          '.$customers[$idCustomer]->email.'
                        </td>
                        <td><a href="/plugins/admin/2top_crm_compete-view-admin-report-listReportCRM.php/?id_customer='.$idCustomer.'">'.number_format($point).'</a></td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có thống kê</td>
                    </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>