<?php
if (!isset($data)) $data = [];
if (!isset($routesPlugin)) $routesPlugin = [];
$dataList = $data["list"];
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách liên hệ</h4>
    <!-- Responsive Table -->
    <div class="card row">
        <h5 class="card-header">Danh sách liên hệ</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Chủ đề</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($dataList as $item) {
                    ?>
                    <tr>
                        <td><?= $item->fullname ?></td>
                        <td><?= $item->email ?></td>
                        <td><?= $item->phone_number ?></td>
                        <td><?= $item->subject ?></td>
                        <td><?= $item->content ?></td>
                        <td><?= date("d-m-Y H:i",$item->created_at) ?></td>
                        <td><a href="/plugins/admin/contact-views-admin-delete.php?id=<?=$item->id?>" class="btn btn-danger">Xóa</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="demo-inline-spacing">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                </ul>
            </nav>
        </div>
        <!--/ Basic Pagination -->
    </div>
    <!--/ Responsive Table -->
</div>

