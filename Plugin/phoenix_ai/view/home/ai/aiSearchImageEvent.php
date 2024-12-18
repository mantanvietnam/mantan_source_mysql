<?php include(__DIR__.'/../header.php'); ?>
<div class="aiva-document container-fluid">
    <div class="document-search" style="width:98%;margin-bottom:0px">
        <div class="title-aiva-document" style="text-align: center;">
            <h2>AI tìm ảnh sự kiện</h2>
        </div>
        <div class="" style="width: 96%;margin: auto;"><p><a href="javascript:void(0);" class="btn btn-primary" onclick="add();" data-bs-toggle="modal" data-bs-target="#addNewData"><i class='bx bx-plus'></i> Thêm mới</a></p></div>
        <div class="list-document-search row" style="width:100%; margin:0 13px;">
            <div class=" col-md-12 col-12">
                <form method="get" action="">
                    <div class="card mb-4" style="padding:0;border-radius:10px">
                        <h5 class="card-header" style="display: none;">Tìm kiếm dữ liệu</h5>
                        <div class="card-body">
                            <div class="row gx-3 gy-2 align-items-center">
                              <div class="col-md-2">
                                <label class="form-label">ID</label>
                                <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Tên sự kiện</label>
                                <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select color-dropdown" style="padding: 0.375rem 0.75rem;">
                                  <option value="">Tất cả</option>
                                  <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
                                  <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
                              </select>
                          </div>
                          
                          <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<div class="table-aiva-document" style="width: 98%;margin: auto; max-height:510px">
    <table class="table-create-document" style="padding:20px">
        <thead class="colum-header">
            <tr>
                <th class="table-column" scope="col">ID</th>
                <th class="table-column" scope="col">Tên sự kiện</th>
                <th class="table-column" scope="col">Link drive ảnh</th>
                <th class="table-column" scope="col">Trạng thái</th>
                <th class="table-column" scope="col">Link AI</th>
                <th class="table-column" scope="col">QR code</th>
                <th class="table-column" scope="col">Sửa</th>
                <th class="table-column" scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody>
          <?php if (!empty($listData)){ ?>
            <?php foreach ($listData as $item){ ?>
                <?php
                $status = '<span class="text-danger">Khóa</span>';
                $linkAI = '';
                $image = '';
                $showLinkAI = 'Hệ thống đang tạo AI tìm ảnh cho bạn';

                if ($item->status == 'active'){
                    $status = '<span class="text-success">Kích hoạt</span>';
                    $linkAI = 'https://ai.phoenixtech.vn/ai-search-image/?idCollection=' . $item->collection_ai . '&idDrive=' . $item->id_drive;
                    $showLinkAI = '<a class="mb-3" href="' . $linkAI . '" target="_blank">' . $linkAI . '</a>';

                    $image ='<img id="" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' . urlencode($linkAI) . '" width="100">';
                }

                $linkDrive = 'https://drive.google.com/drive/folders/' . $item->id_drive . '?usp=drive_link';
                ?>
                <tr>
                    <td><?= $item->id ?></td>
                    <td width="300"><?= $item->name ?></td>
                    <td><a href="<?= $linkDrive ?>" target="_blank">Xem ảnh</a></td>
                    <td><?= $status ?></td>
                    <td><?= $showLinkAI ?></td>
                    <td><?= $image ?></td>
                    <td width="5%" align="center">
                        <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#addNewData" onclick="edit(<?= $item->id ?>, '<?= addslashes($item->name) ?>', '<?= $item->id_drive ?>');">
                            <i class="bx bx-edit-alt me-1"></i>
                        </a>
                    </td>
                    <td align="center">
                        <a class="dropdown-item" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="/deleteSearchImageEvent/?id=<?= $item->id ?>">
                            <i class="bx bx-trash me-1"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="7" align="center">Chưa có dữ liệu</td>
            </tr>
        <?php } ?> 
    </tbody>
</table>
</div>
</div>
<div class="demo-inline-spacing">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
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

                echo '<li class="page-item first">
                <a class="page-link" href="'.$urlPage.'1">
                <i class="tf-icon bx bx-chevrons-left"></i>
                </a>
                </li>';

                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = ($page == $i) ? 'active' : '';

                    echo '<li class="page-item '.$active.'">
                    <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                    </li>';
                }

                echo '<li class="page-item last">
                <a class="page-link" href="'.$urlPage.$totalPage.'">
                <i class="tf-icon bx bx-chevrons-right"></i>
                </a>
                </li>';
            }
            ?>
        </ul>
    </nav>
</div>


<div class="modal fade" id="addNewData">          
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Tạo mới AI tìm ảnh</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="/addSearchImageEvent" method="post">
        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
        <div class="modal-footer">
          <input type="hidden" value=""  name="id" id="id">
          <div class="card-body">
            <div class="row gx-3 gy-2 align-items-center">
              <div class="col-md-12">
                Bạn sẽ được miễn phí <b class="text-danger">10</b> lượt tìm kiếm đầu tiên, mỗi lượt tìm kiếm tiếp theo sẽ bị tính phí <b class="text-danger">1.000đ/lần</b>, hãy <a href="/addMoney">NẠP TIỀN</a> để đảm bảo chức năng chạy ổn định
            </div>
            <div class="col-md-12">
                <label class="form-label">Tên sự kiện</label>
                <input type="text" value="" class="form-control" required placeholder="" name="name" id="name">
            </div>
            <div class="col-md-12">
                <label class="form-label">ID drive thư mục chứa ảnh</label>
                <input type="text" value="" class="form-control" required placeholder="" name="id_drive" id="id_drive">
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Lưu</button>
</div>
</form>

</div>
</div>
</div>
<script>
    function toggleView() {
        const desktopView = document.getElementById('desktop_view');
        const mobileView = document.getElementById('mobile_view');
        
        if (window.innerWidth <= 800) {
            desktopView.style.display = 'none';
            mobileView.style.display = 'block';
        } else {
            desktopView.style.display = 'block';
            mobileView.style.display = 'none';
        }
    }

    // Kiểm tra khi tải trang
    window.addEventListener('load', toggleView);

    // Kiểm tra khi thay đổi kích thước màn hình
    window.addEventListener('resize', toggleView);
</script>

<script type="text/javascript">
  function add()
  {
    $('#id').val('');
    $('#name').val('');
    $('#id_drive').val('');
}

function edit(id, name, id_drive)
{
    $('#id').val(id);
    $('#name').val(name);
    $('#id_drive').val(id_drive);
}
</script>

<?php include(__DIR__.'/../footer.php'); ?>