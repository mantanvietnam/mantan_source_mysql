<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    AI tìm ảnh sự kiện
  </h4>

  <p><a href="javascript:void(0);" class="btn btn-primary" onclick="add();" data-bs-toggle="modal" data-bs-target="#addNewData"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header" style="display: none;">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên sự kiện</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
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
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách sự kiện</h5>

    <!-- Giao diện Desktop -->
    <div id="desktop_view">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sự kiện</th>
                        <th>Link drive ảnh</th>
                        <th>Trạng thái</th>
                        <th>Link AI</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listData)): ?>
                        <?php foreach ($listData as $item): ?>
                            <?php
                                $status = '<span class="text-danger">Khóa</span>';
                                $linkAI = '';
                                $showLinkAI = 'Hệ thống đang tạo AI tìm ảnh cho bạn';

                                if ($item->status == 'active'):
                                    $status = '<span class="text-success">Kích hoạt</span>';
                                    $linkAI = 'https://ai.phoenixtech.vn/ai-search-image/?idCollection=' . $item->collection_ai . '&idDrive=' . $item->id_drive;
                                    $showLinkAI = '<a class="mb-3" href="' . $linkAI . '" target="_blank">' . $linkAI . '</a>
                                        <p><img id="" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' . urlencode($linkAI) . '" width="100"></p>';
                                endif;

                                $linkDrive = 'https://drive.google.com/drive/folders/' . $item->id_drive . '?usp=drive_link';
                            ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td width="300"><?= $item->name ?></td>
                                <td><a href="<?= $linkDrive ?>" target="_blank">Xem ảnh</a></td>
                                <td><?= $status ?></td>
                                <td><?= $showLinkAI ?></td>
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
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" align="center">Chưa có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Giao diện Mobile -->
    <div id="mobile_view">
        <?php if (!empty($listData)): ?>
            <?php foreach ($listData as $item): ?>
                <?php
                    $status = '<span class="text-danger">Khóa</span>';
                    if ($item->status == 'active'):
                        $status = '<span class="text-success">Kích hoạt</span>';
                    endif;
                ?>
                <div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                    <p><strong>ID:</strong> <?= $item->id ?></p>
                    <p><strong>Tên sự kiện:</strong> <?= $item->name ?></p>
                    <p><strong>Link drive:</strong> <a href="https://drive.google.com/drive/folders/<?= $item->id_drive ?>?usp=drive_link" target="_blank">Xem ảnh</a></p>
                    <p><strong>Trạng thái:</strong> <?= $status ?></p>
                    <p><strong>Link AI:</strong></p>
                    <p class="text-center mt-3">
                        <a title="Sửa" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewData" href="javascript: void();" onclick="edit(<?= $item->id ?>, '<?= addslashes($item->name) ?>', '<?= $item->collection_ai ?>');">
                            <i class="bx bx-edit-alt me-1"></i>
                        </a>
                        <a title="Xóa" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="/deleteSearchImageEvent/?id=<?= $item->id ?>">
                            <i class="bx bx-trash me-1"></i>
                        </a>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-sm-12 item">
                <p class="text-danger">Chưa có dữ liệu</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!--/ Responsive Table -->
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