<?php 
    getHeader();
    global $settingThemes;

?>
    <main>
        <div class="register">
            <div class="container d-flex align-items-center">
                <div class="col-lg-6">
                    <div class="back d-flex">
                        <a href="/"><i class="fa-solid fa-chevron-left"></i></a>
                        <p>Quản lý sự kiện</p>
                    </div>
                </div>
                <div class="col-lg-5 share-event d-flex justify-content-end" style="margin-right: 35px;">   
                    <a class="d-flex" href="/editevent?id=<?php echo $id = $_GET['id']; ?>">Chỉnh sửa sự kiện</a>
                </div>
            </div>
        </div>

        <section class="py-4">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-box p-3">
                            <h4><?=$numberdata?></h4>
                            <p>Số người đăng ký tham gia sự kiện</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box p-3">
                            <h4><?php echo $attended_checkin ?></h4>
                            <p>Check in</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box p-3">

                            <label class="form-label" for="basic-default-phone">Mã QR check in</label><br/>
                              <div class="row">
                                <div class="col-md-6">
                                  <img class="mb-3" id="QRURLProfile" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'checkinUser/?id_event='.@$dataEvent->id;?>" width="100">
                                </div>
                                <div class="col-md-6">
                                  <button type="button" class="btn btn-primary mb-3" onclick="copyToClipboard('<?php echo $urlHomes.'checkinUser/?id_event='.@$dataEvent->id;?>', 'Đã copy thành công link liên kết');"><i class='bx bx-link'></i> Sao chép liên kết</button>

                                  <button type="button" class="btn btn-danger mb-3" onclick="downloadImageFromSrc('https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'checkinUser/?id_event='.@$dataEvent->id;?>', '<?php echo $dataEvent->id;?>');"><i class='bx bx-cloud-download'></i> Tải mã QR</button>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>

               
            
                <div class="table-container mt-4">
                     <form method="get" action="">
                    <div class="mb-4">
                        <h5 class="card-header">Tìm kiếm</h5>

                        <div class="card-body">
                            <div class="row gx-3 gy-2 align-items-center">
                                <div class="col-md-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="status" class="form-select color-dropdown">
                                        <option value="">Tất cả </option>
                                        <option value="Arrived" <?php if(!empty($_GET['status']) && $_GET['status'] == 'Arrived') echo 'selected';?>>Check in</option>
                                        <option value="Pending" <?php if(!empty($_GET['status']) && $_GET['status'] == 'Pending') echo 'selected';?>>Chưa check in</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Mã Check in</label>
                                    <input type="number" class="form-control" name="code_checkin" value="<?php if(!empty($_GET['code_checkin'])) echo $_GET['code_checkin'];?>">
                                    <input type="hidden" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Số điện thoại </label>
                                    <input type="number" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
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
                    <?php echo @$mess; ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">số điện thoại</th>
                                <th scope="col">Mã check in</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                <?php
                                if(!empty($listdataattendedevent)){
                                 foreach($listdataattendedevent as $key => $item){
                                    $status ='<p class="text-danger">Chưa check in</p>';
                                    if($item->status=='Arrived'){
                                        $status ='<p class="text_success">Đã check in</p>';
                                    }

                                    ?>
                             <tr>        
                                <td>
                                    <!-- <img src="l" alt="avatar" class="rounded-circle me-2">  -->
                                    <?php echo @$item->name?>
                                </td>
                                <td><?php echo @$item->infoMember->phone; ?></td>
                                <td>
                                    <?php echo @$item->code_checkin; ?>
                                </td>
                                 <td>
                                    <?php echo @$status; ?>
                                </td>
                                 <td>
                                    <?php 
                                        if($item->status=='Pending'){
                                            echo '<a href="/checkinMember?id='.$item->id.'&id_events='.$item->id_events.'" class="btn btn-primary">check in</a>';
                                        }
                                     ?>
                                </td>
                                
                            </tr>
                                <?php }
                                    }
                                ?>
                           
                        </tbody>
                    </table>
                </div>
                <?php if(!empty($listdataattendedevent)):?>
                <div class="container mt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-6">
                            <nav aria-label="Page navigation example">
                            <?php
                              if ($totalPage > 0) {
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
                              ?>
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $urlPage; ?>1" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                    <li class="page-item<?php echo ($page == $i) ? 'active' : ''; ?>" aria-current="page">
                                        <a class="page-link" href="<?php echo $urlPage . $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $urlPage . $totalPage; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            <?php
                                }
                            ?>
                            </nav>
                        </div>
                       <!--  <div class="col-md-6 text-end">
                            <span>Hiển thị 1 đến 8 người trong 50 người</span>
                            <select class="form-select d-inline-block" style="width: auto;">
                                <option selected>Hiện 8</option>
                                <option value="10">Hiện 10</option>
                                <option value="20">Hiện 20</option>
                                <option value="50">Hiện 50</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <?php endif;?>
            </div>
            
        </section>
        
         
    </main>

 <script type="text/javascript">
  function downloadImageFromSrc(url, phone){
      var fileName = 'QR_CHECKIN_'+phone+'.jpg';
      var xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);
      xhr.responseType = "blob";
      xhr.onload = function(){
          var urlCreator = window.URL || window.webkitURL;
          var imageUrl = urlCreator.createObjectURL(this.response);
          var tag = document.createElement('a');
          tag.href = imageUrl;
          tag.download = fileName;
          document.body.appendChild(tag);
          tag.click();
          document.body.removeChild(tag);
      }
      xhr.send();
  }

  function copyToClipboard(text, mess) {
      // Create a temporary input to hold the text to copy
      var $temp = $("<input>");
      $("body").append($temp);
      
      // Select and copy the text
      $temp.val(text).select();
      document.execCommand("copy");
      
      // Remove the temporary input
      $temp.remove();
      
      // Show success message
      alert(mess);
      //$('#copySuccessMessage').show().fadeOut(2000);
  }
 
 </script>

<?php getFooter();?>