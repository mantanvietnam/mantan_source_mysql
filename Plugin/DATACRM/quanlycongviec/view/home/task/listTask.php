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
    <!-- <div id="desktop_view"> -->
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
                    }elseif($item->level==3){
                      $level = 'Khẩn cấp';
                    }

                     $update = '';
                    if(($user->type=='member') OR ($user->id_staff==$item->id) OR ($user->id_staff==$item->project->id)){
                      $update = '<p width="5%" align="center">
                            <a  class="btn btn-success" href="javascript:void(0);" onclick="getTask('.$item->id.')">
                            <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleTask/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                            </a>
                          </p>';
                    }


                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhân viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                          '.$update.'
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
                    }elseif($item->level==3){
                      $level = 'Khẩn cấp';
                    }

                    $update = '';
                    if(($user->type=='member') OR ($user->id_staff==$item->id) OR ($user->id_staff==$item->project->id)){
                      $update = '<p width="5%" align="center">
                            <a  class="btn btn-success" href="javascript:void(0);" onclick="getTask('.$item->id.')">
                            <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleTask/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                            </a>
                          </p>';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhân viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                          '.$update.'
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
                    }elseif($item->level==3){
                      $level = 'Khẩn cấp';
                    }
                     $update = '';
                    if(($user->type=='member') OR ($user->id_staff==$item->id) OR ($user->id_staff==$item->project->id)){
                      $update = '<p width="5%" align="center">
                            <a  class="btn btn-success" href="javascript:void(0);" onclick="getTask('.$item->id.')">
                            <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleTask/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                            </a>
                          </p>';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhân viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                          '.$update.'
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
                    }elseif($item->level==3){
                      $level = 'Khẩn cấp';
                    }
                     $update = '';
                    if(($user->type=='member') OR ($user->id_staff==$item->id) OR ($user->id_staff==$item->project->id)){
                      $update = '<p width="5%" align="center">
                            <a  class="btn btn-success" href="javascript:void(0);" onclick="getTask('.$item->id.')">
                            <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleTask/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                            </a>
                          </p>';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhân viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                          '.$update.'
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
                    }elseif($item->level==3){
                      $level = 'Khẩn cấp';
                    }

                     $update = '';
                    if(($user->type=='member') OR ($user->id_staff==$item->id) OR ($user->id_staff==$item->project->id)){
                      $update = '<p width="5%" align="center">
                            <a  class="btn btn-success" href="javascript:void(0);" onclick="getTask('.$item->id.')">
                            <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleTask/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                            </a>
                          </p>';
                    }

                    echo '<div class="col-sm-12" style="padding:  10px;">
                             <div class=" border-css">
                          <span><strong>Tên dự án: </strong>:'.$item->project->name.'</span><br>
                          <span><strong>nhân viên: </strong>:'.$item->staff->name.'</span><br>
                          <span><strong>tên nhiêu vụ: </strong>:'.$item->name.'</span><br>
                          <span><strong>thời gian bắt đầu: </strong>:'.date('d/m/Y', @$item->start_date).'</span><br>
                          <span><strong>thời gian kết thúc: </strong>:'.date('d/m/Y', @$item->end_date).'</span><br>
                          <span><strong>Mức độ ưu tiên: </strong>:'.$level.'</span><br>
                          <span><strong>nội dung : </strong>:'.$item->content.'</span><br>
                          '.$update.'
                           </div>
                          </div>';
                  }
                } ?>
              </div>
            </div>
        </div>


      </div>
    <!-- </div> -->
   <!--  <div id="mobile_view">
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
                <a  class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleTask/?id='.$item->id.'">
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
    </div> -->

<div class="modal fade" id="getinfoTask"  name="getinfoTask">         
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
         <div class="modal-body mb-3">
            <form action="editTask" method="GET">
              <div class="row">
                 
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Dự án </label>
                    <input disabled="" type="text" class="form-control phone-mask" name="name_project" id="name_project" value="" />
                    <input  type="hidden" class="form-control phone-mask" name="id" id="id" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Nhân viên </label>
                    <input disabled="" type="text" class="form-control phone-mask" name="name_staff" id="name_staff" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Ngày bắt đầu (*)</label>
                    <input type="text" required  class="form-control datepicker" placeholder="" name="start_date" id="start_date" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Ngày Kết thúc (*)</label>
                    <input type="text" required  class="form-control datepicker" placeholder="" name="end_date" id="end_date" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Hành động:</label>
                    <select class="form-control" id="status" name="status">
                      <option value="new" >Mới tạo</option>
                      <option value="process" >Đang xử lý</option>
                      <option value="done">Hoàn thành</option>
                      <option value="bug" >Có lỗi</option>
                      <option value="cancel">Hủy bỏ</option>                  
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Mức độ ưu tiên:</label>
                     <select class="form-control" id="level" name="level">
                      <option value="1">Bình thường</option>
                      <option value="2">Quan trọng</option>
                      <option value="3">Khẩn cấp</option>
                    </select>
                  </div>
                  <div class="mb-3 col-md-12">
                    <label class="form-label" for="basic-default-phone">Tên nhiệm vụ  (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="" />
                  </div>

                  

                   
                   <div class="mb-3 col-md-12">
                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                     <textarea class="form-control" name="content" id="content"></textarea>
                  </div>
                  
                </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
      </div>
     
      
     
      
    </div>
  </div>
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

<script type="text/javascript">
  function getTask(id){
     $.ajax({
            type: "POST",
            url: "/apis/getTasksAPI",
            data: {id: id}
        }).done(function (msg) {
        $('#getinfoTask').modal('show');
          var data = msg.data
           let enddate = data.end_date * 1000;
           let date = new Date(enddate);

            // Lấy ngày, tháng và năm
            let day = date.getUTCDate();
            let month = date.getUTCMonth() + 1; // getUTCMonth() trả về tháng từ 0-11, nên cần +1
            let year = date.getUTCFullYear();

            // Định dạng thành d/m/Y
            let end_date = `${day}/${month}/${year}`;

           let startdate = data.start_date * 1000;
           date = new Date(startdate);

            // Lấy ngày, tháng và năm
           day = date.getUTCDate()+1;
           month = date.getUTCMonth() + 1; // getUTCMonth() trả về tháng từ 0-11, nên cần +1
           year = date.getUTCFullYear();

            // Định dạng thành d/m/Y
            let start_date = `${day}/${month}/${year}`;

          $('#id').val(data.id);
          $('#name_project').val(data.infoProject.name);
          $('#name_staff').val(data.infoStaff.name);
          $('#start_date').val(start_date);
          $('#end_date').val(end_date);
          $('#name').val(data.name);
          $('#status').val(data.status);
          $('#level').val(data.level);
          $('#content').val(data.content);
        }) 
  }
</script>
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>