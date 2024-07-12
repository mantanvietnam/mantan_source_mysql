<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <a href="/list<?php echo $slug ?>"><?php echo $title ?></a> / <?php echo $data->title ?> / Danh sách <?php echo $title ?>
  </h4>

  
     <?php if($data->id_parent==$session->read('infoUser')->id){
                    echo '<p><a href="/add'.$slug.'info?id_document='.$data->id.'" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>';
              } ?>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
            <input type="hidden" class="form-control" name="id_document" value="<?php if(!empty($_GET['id_document'])) echo $_GET['id_document'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="<?php if(!empty($_GET['title'])) echo $_GET['title'];?>">
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách <?php echo $title ?></h5>

    <div class="card-body row">
      <div class="table-responsive row">
        <?php  if($type=='document'){ ?>
          <div id="desktop_view"> 
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Tiêu đề</th>
              <th><?php echo $title ?></th>
              <?php if($data->id_parent==$session->read('infoUser')->id){
                    echo '<th>Sửa</th>
                          <th>Xóa</th>';
              } ?>
              
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $types ='';
                  if($type=='album'){
                    $types='<img src="'.$item->file.'" width="100">';
                  }elseif($type=='video'){
                    $types='<iframe width="300" height="150" src="https://www.youtube.com/embed/'.$item->file.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                  }else{
                    $types='<a  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >'.$item->file.'</a>';
                  }

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>
                            '.$item->title.'
                          </td>
                          <td>'.$types.'</td>';
                          if($data->id_parent==$session->read('infoUser')->id){
                         echo' <td align="center">
                            <a class="dropdown-item" href="/add'.$slug.'info?id_document='.$data->id.'&id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteDocumentinfo/?id_document='.$data->id.'&id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>';
                        }
                        echo '</tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="5" align="center">Chưa có dữ liệu nào! </td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
        </div>
    <div id="mobile_view">
      <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $types ='';
                  if($type=='album'){
                    $types='<img src="'.$item->file.'" width="100">';
                  }elseif($type=='video'){
                    $types='<iframe width="300" height="150" src="https://www.youtube.com/embed/'.$item->file.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                  }else{
                    $types='<a  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >'.$item->file.'</a>';
                  }

                  echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                          <p><strong>ID: </strong>'.$item->id.'</td>
                          <p><strong>Tiêu đề: </strong>'.$item->title.'</p>
                          <p><strong>'.$title.' </strong>'.$types.'</td>';
                          if($data->id_parent==$session->read('infoUser')->id){
                         echo' <p align="center">
                            <a class="dropdown-item" href="/add'.$slug.'info?id_document='.$data->id.'&id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteDocumentinfo/?id_document='.$data->id.'&id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </p>';
                        }
                        echo '</div>';
                }
              }else{
                echo '<div>
                        <p colspan="5" align="center">Chưa có dữ liệu nào! </p>
                      </div>';
              }
            ?>

    </div>

        <?php 
      }else{
           if(!empty($listData)){
                foreach ($listData as $item) {
                  $types ='';
                  if($type=='album'){
                    $types='<img src="'.$item->file.'" style="width:100%">';
                  }elseif($type=='video'){
                    $types='<iframe style="width:100%" height="300" src="https://www.youtube.com/embed/'.$item->file.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                  }else{
                    $types='<embed src="'.$item->file.'"  style="width:100%" height="250" type="application/pdf">';
                  }

                  echo '<div class="col-md-4" >
                      <div style="border: 1px solid #F0F1F1;">
                       <a  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">'.$types.'
                        <h4 style="text-align: center;">'.$item->title.'</h4>
                        </a>';
                      if($data->id_parent==$session->read('infoUser')->id){
                         echo'
                        <div class="row">
                         <div class="col-md-6">
                            <a class="dropdown-item" style="text-align: center;"  href="/add'.$slug.'info?id_document='.$data->id.'&id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"> Sửa</i>
                            </a>
                          </div>
                          <div class="col-md-6">
                            <a class="dropdown-item" style="text-align: center;" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteDocumentinfo/?id_document='.$data->id.'&id='.$item->id.'">
                              <i class="bx bx-trash me-1"> Xóa</i>
                            </a>
                          </div>
                        </div>';
                      }
                       echo 's</div>
                  </div>';

                }
            }
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

      <?php  if(!empty($listData)){
              foreach ($listData as $items) {
                 $types ='';
                  if($type=='album'){
                    $types='<img src="'.$item->file.'" style="width: 40%;display: block;margin-left: 20%;margin-right: 20%;">';
                  }elseif($type=='video'){
                    $types='<iframe style="width:100%; height: 760px;" src="https://www.youtube.com/embed/'.$item->file.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                  }else{
                    $types='<embed src="'.$item->file.'"  style="width:100%; height: 800px;" type="application/pdf">';
                  }


               ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document" style="margin: 36px 10%; max-width: 100%; ">

                            <div class="modal-content" style="background-color: #fff0; box-shadow: none;">
                              <?php echo $types ?>
                            </div>
                          </div>
                        </div>
                      <?php }} ?>


    </div>
  </div>
  <!--/ Responsive Table -->
</div>

<?php include(__DIR__.'/../footer.php'); ?>