<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Quản lý chức vụ</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách chức vụ</h5>
                </div>
                <div class="card-body">
                    <?php echo @$mess; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên chức vụ</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Sửa</th>
                                    <th class="text-center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php 
                                if (!empty($listData)) {
                                    foreach ($listData as $item) {
                                        echo '<tr>
                                            <td>' . $item->id . '</td>
                                            <td>' . $item->name . '</td>
                                            <td>' . $item->description . '</td>
                                            <td>' . ($item->status == 'active' ? 'Kích hoạt' : 'Khóa') . '</td>
                                            <td align="center">
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="editData(' . $item->id . ', \'' . $item->name . '\', \'' . $item->description . '\', \'' . $item->type . '\', \'' . $item->status . '\');">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                </a>
                                            </td>
                                            <td align="center">
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="deleteCategory(' . $item->id . ');">
                                                    <i class="bx bx-trash me-1"></i>
                                                </a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '<tr>
                                        <td colspan="6" align="center">Chưa có chức vụ nào</td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thêm hoặc chỉnh sửa chức vụ</h5>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(); ?>
                        <input type="hidden" name="idCategoryEdit" id="idCategoryEdit" value="" />
                        <div class="mb-3">
                            <label class="form-label" for="name">Tên chức vụ</label>
                            <input type="text" class="form-control" name="name" id="name" value="" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Mô tả</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">Trạng thái</label>
                            <select class="form-select" name="status" id="status">
                                <option value="active">Kích hoạt</option>
                                <option value="lock">Khóa</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function editData(id, name, description, type, status) {
        $('#idCategoryEdit').val(id);
        $('#name').val(name);
        $('#description').val(description);
        $('#type').val(type);
        $('#status').val(status);
    }

    function deleteCategory(id) {
        var check = confirm('Bạn có chắc chắn muốn xóa chức vụ này không?');

        if (check) {
            $.ajax({
                method: "GET",
                url: "/deleteCategory?id=" + id,
                data: {}
            })
            .done(function(msg) {
                window.location = '/listCategory';
            })
            .fail(function() {
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            });
        }
    }
</script>
<?php include(__DIR__.'/../footer.php'); ?>
