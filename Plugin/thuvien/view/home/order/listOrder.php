<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listOrder">Đơn hàng</a> /</span>
    Quản lý đơn hàng
  </h4>

  <p><a href="/addOrder" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

<!-- Form Search -->
<form method="get" action="">
  <div class="card mb-4">
    <h5 class="card-header">Tìm kiếm đơn hàng</h5>
    <div class="card-body">
      <div class="row gx-3 gy-2 align-items-center">
        <div class="col-md-2">
          <label class="form-label">ID Đơn hàng</label>
          <input type="text" class="form-control" name="order_id" value="<?php if(!empty($_GET['order_id'])) echo $_GET['order_id']; ?>">
        </div>

        <div class="col-md-3">
          <label class="form-label">Tên khách hàng</label>
          <input type="text" class="form-control" name="customer_name" value="<?php if(!empty($_GET['customer_name'])) echo $_GET['customer_name']; ?>">
        </div>

        <div class="col-md-3">
          <label class="form-label">Số điện thoại</label>
          <input type="text" class="form-control" name="customer_phone" value="<?php if(!empty($_GET['customer_phone'])) echo $_GET['customer_phone']; ?>">
        </div>

        <div class="col-md-2">
          <label class="form-label">Trạng thái</label>
          <select name="status" class="form-select color-dropdown">
            <option value="">Tất cả</option>
            <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected'; ?>>Đang hoạt động</option>
            <option value="completed" <?php if(!empty($_GET['status']) && $_GET['status']=='completed') echo 'selected'; ?>>Hoàn thành</option>
            <option value="cancelled" <?php if(!empty($_GET['status']) && $_GET['status']=='cancelled') echo 'selected'; ?>>Hủy</option>
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
  <h5 class="card-header">Danh sách đơn hàng - <span class="text-danger"><?php echo number_format(@$totalData); ?> đơn</span></h5>
  <?php echo @$mess; ?>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID </th>
          <th>Tên khách hàng</th>
          <th>Số điện thoại</th>
          <th>Tòa nhà</th>
          <th>Ngày mượn</th>
          <th>Hạn trả</th>
          <th>Trạng thái</th>
          <th>Chi tiết</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
            <?php 
            if (!empty($listData)) {
                foreach ($listData as $order) {
                    $statusText = '';
                    switch ($order->status) {
                        case 1:
                            $statusText = '<span class="text-warning">Đang mượn</span>';
                            break;
                        case 2: 
                            $statusText = '<span class="text-success">Đã trả</span>';
                            break;
                        case 3:
                            $statusText = '<span class="text-muted">Không xác định</span>';
                            break;
                        default:
                            $statusText = '<span class="text-secondary">Chưa xác định</span>';
                            break;
                    }

                    $disabled = ($order->status == 2) ? 'disabled' : '';
                    $statusId = $order->status;
                    echo '<tr>
                    <td>' . $order->id . '</td>
                    <td>' . ($order->customer->name ?? 'N/A') . '</td>
                    <td>' . ($order->customer->phone ?? 'N/A') . '</td>
                    <td>' . ($order->building->name ?? 'N/A') . '</td>
                    <td>' . date('d-m-Y H:i:s', strtotime($order->created_at)) . '</td>
                    <td>' . date('d-m-Y', strtotime($order->return_deadline)) . '</td>
                    <td>
                        <select class="status-dropdown ' . ($order->status == 1 ? 'status-active' : ($order->status == 2 ? 'status-completed' : 'status-unknown')) . '" data-order-id="' . $order->id . '" ' . $disabled . '>
                            <option value="1" ' . ($statusId == 1 ? 'selected' : '') . '>Đang mượn</option>
                            <option value="2" ' . ($statusId == 2 ? 'selected' : '') . '>Đã trả</option>
                            <option value="3" ' . ($statusId == 3 ? 'selected' : '') . '>Không xác định</option>
                        </select>
                    </td>
                    <td width="5%" align="center">
                        <a class="dropdown-item" href="/orderDetail/?id=' . $order->id . '">
                            <i class="bx bx-show me-1"></i>
                        </a>
                    </td>
                    <td width="5%" align="center">
                        <a class="dropdown-item" href="/editOrder/?id=' . $order->id . '">
                            <i class="bx bx-edit-alt me-1"></i>
                        </a>
                    </td>
                    <td align="center">
                        <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteOrder/?id=' . $order->id . '">
                            <i class="bx bx-trash me-1"></i>
                        </a>
                    </td>
                    </tr>';
                }
            } else {
                echo '<tr>
                <td colspan="8" align="center">Chưa có dữ liệu</td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
  </div>

<!-- Phân trang -->
<div class="demo-inline-spacing">
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <?php
      if (@$totalPage > 0) {
        if ($page > 5) {
          $startPage = $page - 5;
        } else {
          $startPage = 1;
        }

        if (@$totalPage > $page + 5) {
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
<!--/ Basic Pagination -->
</div>
<!--/ Responsive Table -->
</div>

<script>
</script>

<?php include(__DIR__.'/../footer.php'); ?>
