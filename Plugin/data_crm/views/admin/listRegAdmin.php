<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đăng ký Data CRM</h4>

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
            <label class="form-label">Tên hệ thống</label>
            <input type="text" class="form-control" name="system_name" value="<?php if(!empty($_GET['system_name'])) echo $_GET['system_name'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên người đăng ký</label>
            <input type="text" class="form-control" name="boss_name" value="<?php if(!empty($_GET['boss_name'])) echo $_GET['boss_name'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Điện thoại người đăng ký</label>
            <input type="text" class="form-control" name="boss_phone" value="<?php if(!empty($_GET['boss_phone'])) echo $_GET['boss_phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Mới đăng ký</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã tạo xong</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên miền</label>
            <input type="text" class="form-control" name="domain" value="<?php if(!empty($_GET['domain'])) echo $_GET['domain'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Sắp xếp theo</label>
            <select name="sort" class="form-select color-dropdown">
              <option value="">Mới đăng ký</option>
              <option value="deadline_asc" <?php if(!empty($_GET['sort']) && $_GET['sort']=='deadline_asc') echo 'selected';?> >Sắp hết hạn</option>
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

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <a href="/updateCodeCRM/?version=7" class="btn btn-danger d-block">Nâng cấp code</a>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách đăng ký</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Thời gian</th>
            <th>Người đăng ký</th>
            <th>Tên miền</th>
            <th>Database</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                if($item->status == 'done'){
                  $link = '<a href="https://'.$item->domain.'" target="_blank">'.$item->domain.'</a>';
                }else{
                  $link = $item->domain;
                }

                $status = $item->status;
                if($item->deadline < time()){
                  $status = '<p class="text-danger"><b>Hết hạn</b></p>';
                }
                $last_login = '';
                if(!empty($item->last_login)){
                   $last_login = date('H:i d/m/Y', @$item->last_login);
                }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>
                          <p class="text-success">'.date('d/m/Y', $item->create_at).'</p>
                          <p class="text-danger">'.date('d/m/Y', $item->deadline).'</p>
                        </td>
                        <td>
                            '.$item->boss_name.'<br/>
                            '.$item->boss_phone.'<br/>
                            '.$item->boss_email.'<br/>
                            Đăng nhập: '.@$last_login.'<br/>
                            <a class="btn btn-primary" style="color: #fff;" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >Gia hạn cho đại lý</a>

                           
                        </td>
                        <td>'.$link.'<br/><br/>'.$status.'<br/><br/> 
                        <a class="btn btn-success" style="color: #fff;" data-bs-toggle="modal" data-bs-target="#addMoney'.$item->id.'" > + Nạp tiền cho đại lý</a>
                        </td>
                        <td>
                            '.$item->user_db.'<br/>
                            '.$item->pass_db.'
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/data_crm-views-admin-deleteRegAdmin/?id='.$item->id.'">
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
    </div >

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
    <?php 
      if(!empty($listData)){
        foreach ($listData as $item) {?>
          <div class="modal fade" id="basicModal<?php echo $item->id; ?>"  name="id">

            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header form-label border-bottom">
                  <h5 class="modal-title" id="exampleModalLabel1">Gia hạn cho đại lý </h5>
                  <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                 <div class="modal-footer">
                  <input type="hidden" value="<?php echo $item->id; ?>"  name="id">
                  <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                      <div class="col-md-12">
                        <label class="form-label"><b>Thông tin Boss</b></label>
                        <?php echo '<p>Tên boss :'.$item->boss_name.'</p>
                        <p>Điện thoại boss:'.$item->boss_phone.'</p>
                        <p>Emai boss: '.$item->boss_email.'</p>';
                        ?>
                      </div>

                      <div class="col-md-12">
                        <label class="form-label">Số điện thoại đại lý gia hạn</label>
                        <input type="text" class="form-control " id="phone_<?php echo $item->id; ?>" name="phone" value="<?php echo $item->boss_phone;?>">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Ngày gia hạn</label>
                        <input type="text" class="form-control datetimepicker" id="deadline_<?php echo $item->id; ?>" name="deadline" value="">

                      </div>
                      <div class="col-md-12" id="messAddCustom<?php echo $item->id; ?>"></div>
                    </div>
                  </div>
                  <a class="btn btn-primary" style="color: #fff;" onclick="extend(<?php echo $item->id; ?>,'<?php echo $item->domain; ?>')">Gia hạn </a>
                </div>
              </form>

            </div>
          </div>
        </div>

         <div class="modal fade" id="addMoney<?php echo $item->id; ?>"  name="id">

            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header form-label border-bottom">
                  <h5 class="modal-title" id="exampleModalLabel1">Nạp tiền cho đại lý </h5>
                  <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                 <div class="modal-footer">
                  <input type="hidden" value="<?php echo $item->id; ?>"  name="id">
                  <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                      <div class="col-md-12">
                        <label class="form-label"><b>Thông tin Boss</b></label>
                        <?php echo '<p>Tên boss :'.$item->boss_name.'</p>
                        <p>Điện thoại boss:'.$item->boss_phone.'</p>
                        <p>Emai boss: '.$item->boss_email.'</p>';
                        ?>
                      </div>

                      <div class="col-md-12">
                        <label class="form-label">Số điện thoại đại lý Nạp tiền</label>
                        <input type="text" class="form-control " id="moneyphone_<?php echo $item->id; ?>" name="moneyphone" value="<?php echo $item->boss_phone;?>">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Số tiền nạp</label>
                        <input type="number" class="form-control "  id="total_<?php echo $item->id; ?>" name="" value="">

                      </div>
                      <div class="col-md-12" id="messAddMoney<?php echo $item->id; ?>"></div>
                    </div>
                  </div>
                  <a class="btn btn-primary" style="color: #fff;" onclick="addMoney(<?php echo $item->id; ?>,'<?php echo $item->domain; ?>')">Nạp tiền </a>
                </div>
              </form>

            </div>
          </div>
        </div>

        <?php }
      } ?>
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>
 <script>
    $(document).ready(function() {
     
      $('.datetimepicker').datetimepicker({
        format:'d/m/Y'
      });
    });

    function extend(id,link){
        var phone = $('#phone_'+id).val();
        var deadline = $('#deadline_'+id).val();
        link = "https://"+link+"/apis/extendMemberAPI";

        if(phone != '' && deadline!=''){
          extendRoot(id,deadline,phone);
          extendCRM(phone,deadline,link,id);
        }
    }

    function extendRoot(id,deadline,phone)
    {
        $.ajax({
              method: "POST",
              url: '/apis/extendMemberDeadlineAPI',
              data: { 
                id: id,
                deadline: deadline,
                phone: phone,
            }
        })
        .done(function( msg ) {
            
        })
    }

    function extendCRM(phone,deadline,link,id){
        $.ajax({
              method: "POST",
              url: link,
              data: { 
                phone: phone,
                deadline: deadline,
            }
        })
        .done(function( msg ) {
            $('#messAddCustom'+id).html(msg.mess);
            
        })
    }


    function addMoney(id,link){
        var phone = $('#moneyphone_'+id).val();
        var total = $('#total_'+id).val();
        link = "https://"+link+"/apis/addMoneyToIcham";

        if(phone != ''){
            $.ajax({
                method: "POST",
                url: link,
                data: { 
                  total: total,
                  phone: phone,
              }
          })
          .done(function( msg ) {
              $('#messAddMoney'+id).html(msg.mess);
          })
        }
    }
    </script>