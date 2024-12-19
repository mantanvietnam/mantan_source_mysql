<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listOrder">Thông tin mượn sách</a> /</span>
    <?php echo !empty($order->id) ? 'Chỉnh sửa đơn mượn' : 'Thêm đơn mượn'; ?>
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-12">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Thông tin đơn mượn</h5>
        </div>
        <div class="card-body">
          <p><?php echo @$mess; ?></p>
          <form enctype="multipart/form-data" method="post" action="">
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>" />
            <div class="row">
              <div class="col-12">
                <div class="mb-4">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label class="form-label" for="customer-search">Khách Hàng (*)</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="customer-search" placeholder="Tìm kiếm khách hàng..." 
                                value="<?php 
                                    if (!empty($order->customer_id)) {
                                        foreach ($customer as $cust) {
                                            if ($cust->id == $order->customer_id) {
                                                echo htmlspecialchars($cust->name, ENT_QUOTES, 'UTF-8');
                                                break;
                                            }
                                        }
                                    } 
                                ?>" />                                
                                <input type="hidden" name="customer_id" id="customer-id" value="<?php echo @$order->customer_id; ?>" />
                                <div id="customer-search-results" class="search-results" 
                                style="position: absolute; z-index: 1000; background: white; border: 1px solid #ddd; max-height: 200px; overflow-y: auto; display: none;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                        <label class="form-label" for="building-id">Tòa Nhà (*)</label>
                        <select 
                            required 
                            class="form-select" 
                            name="building_id" 
                            id="building-id">
                            <option value="">-- Chọn Tòa Nhà --</option>
                            <?php foreach ($buildings as $building): ?>
                            <option value="<?php echo $building->id; ?>" 
                                <?php echo (!empty($order->building_id) && $order->building_id == $building->id) ? 'selected' : ''; ?>>
                                <?php echo $building->name; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                        <label class="form-label" for="return-deadline">Hạn Trả (*)</label>
                        <input 
                            type="text" 
                            autocomplete="off" 
                            required 
                            class="form-control datetimepicker" 
                            name="return_deadline" 
                            id="return-deadline"
                            value="<?php echo !empty($order->return_deadline) ? date('H:i d/m/Y', $order->return_deadline) : ''; ?>" 
                        />
                        </div>

                        <div class="mb-3">
                        <label class="form-label" for="status">Trạng Thái</label>
                        <select class="form-select" name="status" id="status">
                            <option value="1" <?php echo (!empty($order->status) && $order->status == 1) ? 'selected' : ''; ?>>Đang Mượn</option>
                            <option value="2" <?php echo (!empty($order->status) && $order->status == 2) ? 'selected' : ''; ?>>Đã Trả</option>
                        </select>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                  <h6>Chi Tiết Đơn Mượn</h6>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sách</th>
                        <th>Số Lượng</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="order-details-container">
                      <?php if (!empty($orderDetails)): ?>
                        <?php foreach ($orderDetails as $detail): ?>
                          <tr>
                          <td>
                                <div class="position-relative">
                                    <input 
                                        type="text" 
                                        class="form-control book-search" 
                                        placeholder="Tìm kiếm sách..." 
                                        autocomplete="off" 
                                        value="<?php 
                                            if (!empty($detail->book_id)) {
                                                foreach ($books as $book) {
                                                    if ($book->id == $detail->book_id) {
                                                        echo htmlspecialchars($book->name, ENT_QUOTES, 'UTF-8');
                                                        break;
                                                    }
                                                }
                                            } 
                                        ?>" />
                                    <input 
                                        type="hidden" 
                                        name="order_books[<?php echo $detail->id; ?>][book_id]" 
                                        class="book-id" 
                                        value="<?php echo $detail->book_id; ?>" 
                                    />
                                    <div class="search-results"></div>
                                </div>
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    class="form-control quantity-input" 
                                    name="order_books[<?php echo $detail->id; ?>][quantity]" 
                                    value="<?php echo $detail->quantity; ?>" 
                                />
                            </td>
                            <td>
                                <input 
                                    type="hidden" 
                                    class="warehouse" 
                                    name="order_books[<?php echo $detail->id; ?>][warehouse_id]" 
                                    value="<?php echo $detail->warehouse_id; ?>">
                            </td>

                            <td>
                                <button 
                                    type="button" 
                                    class="btn btn-danger btn-sm remove-detail" 
                                    value="<?php echo $detail->id; ?>" 
                                    data-warehouse-id="<?php echo $detail->warehouse_id; ?>"
                                    data-quantity="<?php echo $detail->quantity; ?>">
                                    Xóa
                                </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                  <button type="button" class="btn btn-secondary" id="add-detail">Thêm Chi Tiết</button>
                </div>

              </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 70px;">Lưu</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.search-results {
    width: 100%;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.search-item {
    padding: 8px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}

.search-item:hover {
    background-color: #f5f5f5;
}

.search-item.disabled {
    color: #999;
    cursor: default;
}
</style>


<script type="text/javascript">
    $(document).ready(function () {
        // Tìm kiếm khách hàng
        $("#customer-search").on("input", function () {
            let searchQuery = $(this).val();
            if (searchQuery.length >= 2) { 
                $.ajax({
                    url: "/apis/searchCustomerAPI",
                    method: "GET",
                    data: { term: searchQuery }, 
                    success: function (response) {
                        let resultHTML = "";
                        if (response && response.length > 0) {
                            response.forEach(function (customer) {
                                resultHTML += `
                                    <div class="search-item customer-item" 
                                        data-id="${customer.id}" 
                                        data-name="${customer.name}">
                                        ${customer.label}
                                    </div>`;
                            });
                        } else {
                            resultHTML = '<div class="search-item disabled">Không tìm thấy khách hàng</div>';
                        }
                        $("#customer-search-results").html(resultHTML).show();
                    },
                    error: function () {
                        $("#customer-search-results").html('<div class="search-item disabled">Lỗi khi tìm kiếm</div>').show();
                    },
                });
            } else {
                $("#customer-search-results").hide();
            }
        });
        

        $(document).on("click", ".customer-item:not(.disabled)", function () {
            let customerId = $(this).data("id");
            let customerName = $(this).data("name");

            $("#customer-id").val(customerId);
            $("#customer-search").val(customerName);
            $("#customer-search-results").hide();
        });

        $(document).on("click", function (e) {
            if (!$(e.target).closest("#customer-search-results, #customer-search").length) {
                $("#customer-search-results").hide();
            }
        });

        // Tìm kiếm sách
        
        $(document).on("input", ".book-search", function () {
            let searchInput = $(this);
            let searchQuery = searchInput.val();
            let resultBox = searchInput.siblings(".search-results");
            let buildingId = $("#building-id").val();

            if (!buildingId) {
                alert("Vui lòng chọn tòa nhà trước khi tìm sách.");
                return;
            }

            if (searchQuery.length >= 2) {
                $.ajax({
                    url: "/apis/searchBookAPI",
                    method: "GET",
                    data: { term: searchQuery, id_building: buildingId },
                    success: function (response) {
                        let resultHTML = "";
                        if (response && response.length > 0) {
                            response.forEach(function (book) {
                                resultHTML += `
                                    <div class="search-item book-item" 
                                        data-id="${book.id}" 
                                        data-name="${book.name}"
                                        data-quantity="${book.quantity}"
                                        data-quantity-borrow="${book.quantity_borrow}"
                                        id_shelf="${book.id_shelf}">
                                        ${book.label}
                                    </div>`;
                            });
                        } else {
                            resultHTML = '<div class="search-item disabled">Không tìm thấy sách</div>';
                        }
                        resultBox.html(resultHTML).show();
                    },
                    error: function () {
                        resultBox.html('<div class="search-item disabled">Lỗi khi tìm kiếm</div>').show();
                    },
                });
            } else {
                resultBox.hide();
            }
        });

        $(document).on("click", ".book-item:not(.disabled)", function () {
            let selectedItem = $(this);
            let bookId = selectedItem.data("id");
            let bookName = selectedItem.data("name");
            let bookQuantity = parseInt(selectedItem.data("quantity"), 10);
            let bookQuantityBorrow = parseInt(selectedItem.data("quantity-borrow"), 10);
            let idShelf = selectedItem.attr("id_shelf");
            let parentRow = selectedItem.closest("tr");

            parentRow.find(".book-search").val(bookName);
            parentRow.find(".book-id").val(bookId);
            parentRow.find(".book-search").data("max-quantity", bookQuantity - bookQuantityBorrow); 
            parentRow.find(".warehouse").val(idShelf);
            parentRow.find(".search-results").hide();
        });

        $(document).on("input", ".quantity-input", function () {
        let inputField = $(this);
        let parentRow = inputField.closest("tr");
        let maxQuantity = parentRow.find(".book-search").data("max-quantity");

        if (parseInt(inputField.val(), 10) > maxQuantity) {
            alert(`Số lượng không được vượt quá ${maxQuantity}`);
            inputField.val(maxQuantity);
        }
    });

        $(document).on("click", function (e) {
            if (!$(e.target).closest(".search-results, .book-search").length) {
                $(".search-results").hide();
            }
        });

        // Thêm chi tiết 
        document.getElementById('add-detail').addEventListener('click', function () {
            const container = document.getElementById('order-details-container');
            const uniqueId = Date.now();
            const newRow = `
            <tr>
                <td>
                    <div class="position-relative">
                        <input 
                            type="text" 
                            class="form-control book-search" 
                            placeholder="Tìm kiếm sách..." 
                            autocomplete="off" 
                        />
                        <input 
                            type="hidden" 
                            name="order_books[new_${uniqueId}][book_id]" 
                            class="book-id" 
                        />
                        <div class="search-results"></div>
                    </div>
                </td>
                <td>
                    <input 
                        type="number" 
                        class="form-control quantity-input" 
                        name="order_books[new_${uniqueId}][quantity]" 
                        value="1"
                        min="1"
                    />
                </td>
                <td>
                    <input 
                        type="hidden" 
                        class="warehouse" 
                        name="order_books[new_${uniqueId}][warehouse_id]" 
                        value="">
                </td>
                <td>
                    <button 
                        type="button" 
                        class="btn btn-danger btn-sm remove-detail"
                    >
                        Xóa
                    </button>
                </td>
            </tr>`;
            container.insertAdjacentHTML('beforeend', newRow);
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-detail')) {
                const button = e.target;
                const detailId = button.value;
                const warehouseId = button.getAttribute('data-warehouse-id');
                const quantity = button.getAttribute('data-quantity');

                if (!detailId) {
                    button.closest('tr').remove();
                    return; 
                }

                $.ajax({
                    method: "POST",
                    url: "/apis/deleteOrderDetail",
                    data: { id: detailId, warehouse_id: warehouseId, quantity: quantity},
                    success: function(response) {

                        if (response.success == true) {
                            button.closest('tr').remove();
                            alert(response.message); 
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Có lỗi xảy ra:', textStatus, errorThrown);
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            }
        });
    });

</script>

<?php include(__DIR__.'/../footer.php'); ?>
