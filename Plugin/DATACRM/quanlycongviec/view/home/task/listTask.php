<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<style type="text/css">
  .border-css{
    padding: 15px;
    border-radius: 23px;
    border-color: #0b0b0c;
    background: white;
  }
  .task-vu{
        background: #9cbeee;
    border-radius: 20px;
  }

  .task-vu .card-header{
    text-align: center;
    text-transform: uppercase;
    background: #a7d3ee;
    border-radius: 20px;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProject">Dự án</a> /</span>
    Nhiệm vụ 
  </h4>
  <p><a href="/addTask" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p> 
  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          
          <div class="mb-3 col-md-3">
            <label class="form-label" for="basic-default-fullname">Dự án </label>
            <select class="form-control" id="id_project" name="id_project" onchange="getstaff()">
              <option value="" >Chọn dự án</option>
              <?php if(!empty($listProject)){
                foreach($listProject as $key => $item){
                  $selected = '';
                  if($item->id== @$data->id_project){
                    $selected = 'selected';
                  }
                  echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                }
              } ?>


            </select>
          </div>
          <div class="mb-3 col-md-3">
            <label class="form-label" for="basic-default-fullname">Nhân viên </label>
            <select class="form-control" id="id_staff" name="id_staff">
              <option value="" >Chọn nhân viên</option>
              <?php if(!empty($liststaff)){
                foreach($liststaff as $key => $item){
                  $selected = '';
                  if($item->id== @$data->id_staff){
                    $selected = 'selected';
                  }
                  echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                }
              } ?>


            </select>
          </div>
                   
          <div class="col-md-2">

            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
     
        </div>
      </div>
    </div>
  </form> 
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách dự án</h5>
    <?php echo @$mess;?>
    <div id="desktop_view">
      <div class="table-responsive">
        <div class="row">
            <div class="col-md-3 mb-3">
              <div class="task-vu">
                <h5 class="card-header">Mới tạo</h5>
                <?php if(!empty($listTasknew)){
                  foreach($listTasknew as $key => $item){
                    $level = '';
                    if($item->level==1){
                      $level = 'Bình thường';
                    }elseif($item->level==2){
                      $level = 'Quan trọng';
                    }elseif($item->level==2){
                      $level = 'Khẩn cấp';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhận viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                           </div>
                          </div>';
                  }
                } ?>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="task-vu"  >
                <h5 class="card-header">Đang xử lý</h5>
                <?php if(!empty($listTaskprocess)){
                  foreach($listTaskprocess as $key => $item){
                    $level = '';
                    if($item->level==1){
                      $level = 'Bình thường';
                    }elseif($item->level==2){
                      $level = 'Quan trọng';
                    }elseif($item->level==2){
                      $level = 'Khẩn cấp';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhận viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                           </div>
                          </div>';
                  }
                } ?>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="task-vu"  >
                <h5 class="card-header">Hoàn thành</h5>
                <?php if(!empty($listTaskdone)){
                  foreach($listTaskdone as $key => $item){
                    $level = '';
                    if($item->level==1){
                      $level = 'Bình thường';
                    }elseif($item->level==2){
                      $level = 'Quan trọng';
                    }elseif($item->level==2){
                      $level = 'Khẩn cấp';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhận viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                           </div>
                          </div>';
                  }
                } ?>
              </div>
            </div>
           
            <div class="col-md-3 mb-3">
              <div class="task-vu"  >
                <h5 class="card-header">Có lỗi</h5>
                <?php if(!empty($listTaskbug)){
                  foreach($listTaskbug as $key => $item){
                    $level = '';
                    if($item->level==1){
                      $level = 'Bình thường';
                    }elseif($item->level==2){
                      $level = 'Quan trọng';
                    }elseif($item->level==2){
                      $level = 'Khẩn cấp';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhận viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                           </div>
                          </div>';
                  }
                } ?>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="task-vu"  >
                <h5 class="card-header">Hủy bỏ</h5>
                <?php if(!empty($listTaskcancel)){
                  foreach($listTaskcancel as $key => $item){
                    $level = '';
                    if($item->level==1){
                      $level = 'Bình thường';
                    }elseif($item->level==2){
                      $level = 'Quan trọng';
                    }elseif($item->level==2){
                      $level = 'Khẩn cấp';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhận viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                           </div>
                          </div>';
                  }
                } ?>
              </div>
            </div>
        </div>


      </div>
    </div>
    <div id="mobile_view">
      <?php 
        if(!empty($listData)){
              foreach ($listData as $item) {
                $state = '';
                if($item->state=='new'){
                   $state = 'Mới tạo'; 
                }elseif($item->state=='process'){
                  $state = 'Đang xử lý'; 
                }elseif($item->state=='done'){
                  $state = 'Hoàn thành'; 
                }elseif($item->state=='bug'){
                  $state = 'Có lỗi'; 
                }elseif($item->state=='cancel'){
                  $state = 'Hủy bỏ'; 
                }

                $status = 'khóa';
                if($item->status=='active'){
                   $status = 'Kích hoạt'; 
                }
              
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                <p><strong>ID: </strong>:'.$item->id.'</p>
                <p><strong>Tên dự án: </strong>:'.$item->name.'</p>
                <p><strong>Leader: </strong>:'.$item->leader->name.'</p>
                <p><strong>số lượng nhận viên: </strong>:'.$item->number_staff.'</p>
                <p><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</p>
                <p><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</p>
                <p><strong>trạng thái: </strong>:'.$status.'</p>
                <p><strong>Hành động: </strong>:'.$state.'</p>
               

                <p width="5%" align="center">
                <a  class="btn btn-success" href="/addProject/?id='.$item->id.'">
                <i class="bx bx-edit-alt me-1"></i>
                </a>
                <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleProject/?id='.$item->id.'">
                <i class="bx bx-trash me-1"></i>
                </a>
                </p>
                </div>';
              }
            }else{
              echo '<tr>
              <td colspan="10" align="center">Chưa có dữ liệu</td>
              </tr>';
            }
        ?>
    </div>

  <!-- Phân trang -->
  <!--/ Basic Pagination -->
</div>
<!--/ Responsive Table -->
</div>
<script type="text/javascript">
  function getstaff(){
     var id_project = $('#id_project').val();

     $.ajax({
            type: "POST",
            url: "/apis/getStaffProjectAPI",
            data: {id_project: id_project}
        }).done(function (msg) {
          var users = msg.data;

            let htmlContent = '<option value="" >Chọn nhân viên</option>'; 

    for (let i = 0; i < users.length; i++) {
        let user = users[i];

       htmlContent += '<option value="'+user.id+'">'+user.name+'</option>'; 
    }

    $('#id_staff').html(htmlContent);
        }) 
  }
</script>
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>