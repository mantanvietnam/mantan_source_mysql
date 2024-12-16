<?php include(__DIR__.'/../header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listOrder">Mượn sách</a> /</span>
  Thông tin mượn sách
  </h4>

  <p><a href="/addOrder" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

<!-- Form Search -->
<form method="get" action="">
  <div class="card mb-4">
    <h5 class="card-header">Tìm kiếm đơn hàng</h5>
    <div class="card-body">
      <div class="row gx-3 gy-2 align-items-center">
        <div class="col-md-2">
          <label class="form-label">ID</label>
          <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id']; ?>">
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
      <tbody>
          <?php 
          if (!empty($listData)) {
              foreach ($listData as $order) {
                  $disabled = ($order->status == 2) ? 'disabled' : '';
                  $statusId = $order->status;

                  echo '<tr>
                      <td>' . $order->id . '</td>
                      <td>' . ($order->customer->name ?? 'N/A') . '</td>
                      <td>' . ($order->customer->phone ?? 'N/A') . '</td>
                      <td>' . ($order->building->name ?? 'N/A') . '</td>
                      <td>' . date('d-m-Y H:i:s', $order->created_at) . '</td>
                      <td>' . date('d-m-Y H:i:s', $order->return_deadline) . '</td>
                      <td>
                          <select class="status-dropdown" onchange="updateOrderStatus(' . $order->id . ', this.value)" ' . $disabled . '>';
                              if (!empty($order->return_deadline) && $order->return_deadline < time() && $order->status == 1) {
                                  echo '<option value="1" class="status-late" selected>Trễ hẹn</option>';
                              } elseif ($order->status == 1) {
                                  echo '<option value="1" class="status-borrowing" selected>Đang mượn</option>';
                              }

                              echo '<option value="2" class="status-returned" ' . ($order->status == 2 ? 'selected' : '') . '>Đã trả</option>';
                          echo '</select>
                      </td>
                      <td width="5%" align="center">
                          <a class="dropdown-item" href="/orderDetail/?id=' . $order->id . '">
                              <i class="bx bx-show me-1"></i>
                          </a>
                      </td>
                      <td width="5%" align="center">';
                          if ($order->status != 2) {
                              echo '<a class="dropdown-item" href="/addOrder/?id=' . $order->id . '">
                                      <i class="bx bx-edit-alt me-1"></i>
                                    </a>';
                          } else {
                              echo '<span class="dropdown-item">
                                      <i class="fa-solid fa-ban "></i>
                                    </span>';
                          }
                      echo '</td>
                      <td align="center">
                          <a class="dropdown-item" onclick="deleteOrder(' . $order->id . ')">
                              <i class="bx bx-trash me-1"></i>
                          </a>
                      </td>
                  </tr>';
              }
          } else {
              echo '<tr>
                  <td colspan="10" align="center">Chưa có dữ liệu</td>
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

<style>
.status-dropdown {
    font-weight: bold;
    color: black;
}

.status-late {
    color: red;
    background-color: #ffe6e6;
}

.status-borrowing {
    color: orange;
    background-color: #fff5e6;
}

.status-returned {
    color: green;
    background-color: #e6ffe6;
}

</style>



<script>
  $(document).ready(function () {
    $('.status-dropdown').each(function () {
        updateDropdownColor($(this));
    });

    $('.status-dropdown').change(function () {
        updateDropdownColor($(this));
    });

    function updateDropdownColor(selectElement) {
        var selectedOption = selectElement.find(':selected');
        selectElement.removeClass('status-late status-borrowing status-returned');
        if (selectedOption.hasClass('status-late')) {
            selectElement.addClass('status-late');
        } else if (selectedOption.hasClass('status-borrowing')) {
            selectElement.addClass('status-borrowing');
        } else if (selectedOption.hasClass('status-returned')) {
            selectElement.addClass('status-returned');
        }
    }
});


function updateOrderStatus(orderId, newStatus) {
    // Log chi tiết thông tin đầu vào
    console.log('Cập nhật trạng thái đơn hàng');
    console.log('Order ID:', orderId);
    console.log('New Status:', newStatus);

    // Hiển thị hộp thoại xác nhận
    var confirmation = confirm('Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng này không?');

    if (confirmation) {
        console.log('Xác nhận đã được đồng ý. Gửi yêu cầu AJAX để cập nhật trạng thái...');

        // Gửi AJAX request
        $.ajax({
            method: "POST",
            url: "/apis/updateOrderStatus", // Đường dẫn đến API
            data: {
                id: orderId,
                status: newStatus
            },
            success: function(response) {
                console.log('Response từ server:', response);

                try {
                    // Nếu phản hồi từ server là chuỗi, parse thành JSON
                    response = typeof response === 'string' ? JSON.parse(response) : response;

                    // Log phản hồi thành công hoặc thất bại
                    if (response.success === true) {
                        console.log('Cập nhật trạng thái thành công:', response.message);
                        alert(response.message); // Hiển thị thông báo thành công
                        location.reload(); // Tải lại trang để cập nhật dữ liệu
                    } else {
                        console.log('Cập nhật không thành công:', response.message || 'Không có thông báo chi tiết.');
                        alert(response.message || 'Cập nhật không thành công.'); // Thông báo lỗi từ server
                    }
                } catch (error) {
                    console.error('Lỗi khi xử lý phản hồi JSON:', error);
                    alert('Phản hồi không hợp lệ từ server.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Log lỗi xảy ra trong quá trình gửi request
                console.error('Có lỗi xảy ra khi gửi yêu cầu AJAX:', textStatus, errorThrown);
                alert('Có lỗi xảy ra khi kết nối đến server. Vui lòng thử lại.');
            }
        });
    } else {
        console.log('Người dùng hủy bỏ hành động cập nhật trạng thái.');
    }
}

</script>

<?php include(__DIR__.'/../footer.php'); ?>
