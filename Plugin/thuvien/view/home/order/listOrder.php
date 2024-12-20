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
    <h5 class="card-header">Tìm kiếm đơn mượn</h5>
    <div class="card-body">
      <div class="row gx-3 gy-2 align-items-center">
        <div class="col-md-1">
          <label class="form-label">ID</label>
          <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id']; ?>">
        </div>

        <div class="col-md-2">
          <label class="form-label">Tên khách hàng</label>
          <input type="text" class="form-control" name="customer_name" value="<?php if(!empty($_GET['customer_name'])) echo $_GET['customer_name']; ?>">
        </div>

        <div class="col-md-2">
          <label class="form-label">Số điện thoại</label>
          <input type="text" class="form-control" name="customer_phone" value="<?php if(!empty($_GET['customer_phone'])) echo $_GET['customer_phone']; ?>">
        </div>

        <div class="col-md-2">
          <label class="form-label">Trạng thái</label>
          <select name="status" class="form-select color-dropdown">
            <option value="">Tất cả</option>
            <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected'; ?>>Đang mượn</option>
            <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected'; ?>>Đã trả</option>
          </select>
        </div>

        <div class="col-md-2">
                <label class="form-label">Ngày mượn từ</label>
                <input autocomplete="off" type="text" class="form-control datepicker" name="borrow_date_from" id="borrow_date_from" value="<?php if(!empty($_GET['borrow_date_from'])) echo $_GET['borrow_date_from']; ?>" placeholder="dd/mm/yyyy">
        </div>

        <div class="col-md-2">
                <label class="form-label">Ngày mượn đến</label>
                <input autocomplete="off" type="text" class="form-control datepicker" name="borrow_date_to" id="borrow_date_to" value="<?php if(!empty($_GET['borrow_date_to'])) echo $_GET['borrow_date_to']; ?>" placeholder="dd/mm/yyyy">
        </div>

        <div class="col-md-2">
          <label class="form-label">&nbsp;</label>
          <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
        </div>

          <div class="col-md-1">
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
      </div>
    </div>
  </div>
</form>
<!--/ Form Search -->

<!-- Responsive Table -->
<div class="card row">
  <h5 class="card-header">Danh sách đơn mượn - <span class="text-danger"><?php echo number_format(@$totalData); ?> đơn</span></h5>
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

            $customerName = !empty($order->customer) ? htmlspecialchars($order->customer->name, ENT_QUOTES) : 'N/A';
            $customerPhone = !empty($order->customer) ? htmlspecialchars($order->customer->phone, ENT_QUOTES) : 'N/A';
            $buildingName = !empty($order->building) ? htmlspecialchars($order->building->name, ENT_QUOTES) : 'N/A';
            $createdAt = !empty($order->created_at) ? date('d-m-Y H:i:s', $order->created_at) : 'N/A';
            $returnDeadline = !empty($order->return_deadline) ? date('d-m-Y H:i:s', $order->return_deadline) : 'N/A';

            echo '<tr>
                <td>' . htmlspecialchars($order->id, ENT_QUOTES) . '</td>
                <td>' . $customerName . '</td>
                <td>' . $customerPhone . '</td>
                <td>' . $buildingName . '</td>
                <td>' . $createdAt . '</td>
                <td>' . $returnDeadline . '</td>
                <td>
                    <select class="status-dropdown" onchange="updateOrderStatus(' . htmlspecialchars($order->id, ENT_QUOTES) . ', this.value)" ' . $disabled . '>';
                        if (!empty($order->return_deadline) && is_numeric($order->return_deadline) && $order->return_deadline < time() && $order->status == 1) {
                            echo '<option value="1" class="status-late" selected>Trễ hẹn</option>';
                        } elseif ($order->status == 1) {
                            echo '<option value="1" class="status-borrowing" selected>Đang mượn</option>';
                        }
                        echo '<option value="2" class="status-returned" ' . ($order->status == 2 ? 'selected' : '') . '>Đã trả</option>';
                    echo '</select>
                </td>
                <td width="5%" align="center">
                    <a class="dropdown-item" href="javascript:void(0);" onclick="fetchOrderDetails(' . htmlspecialchars($order->id, ENT_QUOTES) . ')">
                        <i class="bx bx-show me-1"></i>
                    </a>
                </td>
                <td width="5%" align="center">';
                    if ($order->status != 2) {
                        echo '<a class="dropdown-item" href="/addOrder/?id=' . htmlspecialchars($order->id, ENT_QUOTES) . '">
                                <i class="bx bx-edit-alt me-1"></i>
                              </a>';
                    } else {
                        echo '<span class="dropdown-item">
                                <i class="fa-solid fa-ban"></i>
                              </span>';
                    }
                echo '</td>
                <td align="center">
                    <a class="dropdown-item" onclick="deleteOrder(' . htmlspecialchars($order->id, ENT_QUOTES) . ')">
                        <i class="bx bx-trash me-1"></i>
                    </a>
                </td>
            </tr>';
        }
    } else {
        echo '<tr>
            <td colspan="10" align="center"><em class="text-muted">Chưa có dữ liệu</em></td>
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

<!-- Dialog -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Chi tiết đơn hàng</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                    <!-- <span aria-hidden="true">&times;</span> -->
                <!-- </button> -->
            </div>
            <div class="modal-body">
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div> -->
        </div>
    </div>
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
    var confirmation = confirm('Bạn có chắc chắn muốn cập nhật trạng thái đơn mượn này không?');
        $.ajax({
            method: "POST",
            url: "/apis/updateOrderStatus",
            data: {
                id: orderId,
                status: newStatus
            },
            success: function(response) {
                try {
                    response = typeof response === 'string' ? JSON.parse(response) : response;

                    if (response.success === true) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message || 'Cập nhật không thành công.');
                    }
                } catch (error) {
                    console.error('Lỗi khi xử lý phản hồi JSON:', error);
                    alert('Phản hồi không hợp lệ từ server.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Có lỗi xảy ra khi gửi yêu cầu AJAX:', textStatus, errorThrown);
                alert('Có lỗi xảy ra khi kết nối đến server. Vui lòng thử lại.');
            }
        });
}

function deleteOrder(id) {
    var check = confirm('Bạn có chắc chắn muốn xóa đơn mượn này không?');

    if (check) {
        $.ajax({
            method: "GET",
            url: "/deleteOrder?id=" + id,
            data: {}
        })
        .done(function( msg ) {
            window.location = '/listOrder';
          })
          .fail(function() {
            window.location = '/listOrder';
          });
    }
}



function fetchOrderDetails(orderId) {
    $.ajax({
        url: `/apis/getOrderDetailsByOrderIdAPI`,
        method: 'GET',
        data: { order_id: orderId },
        beforeSend: function() {
        },
        success: function(response) {

            if (response.order_info.length > 0) {
                let orderInfo = response.order_info[0]; 
                let orderDetails = response.order_details;

                let customerName = orderInfo.customer_name || 'N/A';
                let customerPhone = orderInfo.customer_phone || 'N/A';
                let customerEmail = orderInfo.customer_email || '';
                let returnDeadline = orderInfo.return_deadline || 'N/A';

                let orderInfoHtml = `
                    <p><strong>ID:</strong> ${orderInfo.order_id}</p>
                    <p><strong>Tên khách hàng:</strong> ${customerName}</p>
                    <p><strong>Điện thoại:</strong> ${customerPhone}</p>
                    <p><strong>Email:</strong> ${customerEmail}</p>
                    <p><strong>Hạn trả:</strong> ${returnDeadline}</p>
                `;

                let detailsHtml = '<table class="table"><thead><tr><th>Sản phẩm</th><th>Số lượng</th></tr></thead><tbody>';
                
                orderDetails.forEach(detail => {
                    detailsHtml += `
                        <tr>
                            <td>${detail.book_name}</td>
                            <td>${detail.quantity}</td>
                        </tr>
                    `;
                });

                detailsHtml += '</tbody></table>';
                $('#orderDetailsModal .modal-body').html(orderInfoHtml + detailsHtml);
                $('#orderDetailsModal').modal('show');
            } else {
                alert('Không tìm thấy chi tiết đơn hàng.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error occurred:', {
                status: status,
                error: error,
                responseText: xhr.responseText
            });
            alert('Đã xảy ra lỗi khi gọi API.');
        },
        complete: function() {
        }
    });
}

$('#orderDetailsModal').on('hidden.bs.modal', function () {
});

</script>

<?php include(__DIR__.'/../footer.php'); ?>
