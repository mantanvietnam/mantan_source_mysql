<?php 
    getHeader();
    global $settingThemes;

?>
    <main>
        <div class="register">
            <div class="container d-flex align-items-center">
                <div class="col-lg-6">
                    <div class="back d-flex">
                        <a href="./event.html"><i class="fa-solid fa-chevron-left"></i></a>
                        <p>Quản lý sự kiện</p>
                    </div>
                </div>
                <div class="col-lg-5 share-event d-flex justify-content-end" style="margin-right: 35px;">   
                    <a class="d-flex" href="">Chia sẻ sự kiện</a>
                </div>
            </div>
        </div>

        <section class="py-4">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-box p-3">
                            <h4><?=$numberdata?></h4>
                            <p>Số người tham gia sự kiện</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box p-3">
                            <h4>2,400</h4>
                            <p>Số vé mới đã được tạo</p>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="stat-box p-3">
                            <h4>8,000</h4>
                            <p>Số lượng người tiếp cận</p>
                        </div>
                    </div> -->
                </div>
            
                <div class="table-container mt-4">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="date" class="form-control" placeholder="Select date range">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option selected>Nam</option>
                                <option value="1">Nữ</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option selected>Trạng thái vé mới</option>
                                <option value="1">Đã đến</option>
                                <option value="2">Đang chờ</option>
                                <option value="3">Không đến</option>
                            </select>
                        </div>
                    </div>
            
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Ngày sinh</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach($listdataattendedevent as $data):?>
                                <td>
                                    <!-- <img src="https://via.placeholder.com/40" alt="avatar" class="rounded-circle me-2"> -->
                                    <?=$data->name?>
                                </td>
                                <td><?= date('d/m/Y', $data->date) ?></td>
                                <td>
                                    <?=$data->status?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Chọn hành động
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="/infomanagerevent?id=<?=$data->id?>">Xem chi tiết</a></li>
                                            <li><a class="dropdown-item" href="/editmanagerevent?id=<?=$data->id?>">Sửa thông tin</a></li>
                                            <li><a class="dropdown-item" href="#">Xóa</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <?php endforeach;?>
                            </tr>
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
                        <div class="col-md-6 text-end">
                            <span>Hiển thị 1 đến 8 người trong 50 người</span>
                            <select class="form-select d-inline-block" style="width: auto;">
                                <option selected>Hiện 8</option>
                                <option value="10">Hiện 10</option>
                                <option value="20">Hiện 20</option>
                                <option value="50">Hiện 50</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
            
        </section>
        
         
    </main>

<?php getFooter();?>