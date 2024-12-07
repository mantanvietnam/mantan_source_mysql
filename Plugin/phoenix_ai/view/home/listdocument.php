<?php include('header.php'); ?>
  <div class="aiva-document container-fluid">
                    <div class="document-search">
                        <div class="title-aiva-document"><h2>Phoenix Tài liệu</h2></div>
                        <div class="list-document-search row">
                            <div class="left-document col-md-2 col-12">
                                <div class="tag">
                                    <p>Tag</p>
                                </div>
                                <div class="select">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Tất cả</option>
                                        <option value="">tag1</option>
                                        <option value="">tag2</option>
                                        <option value="">tag3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="right-document col-md-8 col-12">
                                <a href="/dashboard">
                                    <div class="creat-document">
                                        <i class="fa-regular fa-folder"></i>
                                        <div class="name-button-document">
                                            Tạo tài liệu mới
                                        </div>
                                    </div>
                                </a>
                                <div class="filter" onclick="toggleSearchForm()">
                                    <i class="fa-regular fa-folder"></i>
                                    <div class="name-two">
                                        Filters
                                    </div>
                                    <div id="formSearchDate" class="form-search-date" style="display: none;">
                                        <form action="">
                                            <div class="dateform">
                                                <p>Ngày tạo</p>
                                                <input type="date" name="" id="">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="name-input-search">
                                    <div class="detail-input-search">
                                        <div class="icon-input-search">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                        <input placeholder="Nhập từ khóa tìm kiếm" type="text" aria-label="search" class="" value="">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="table-aiva-document">
                        <table class=" table-create-document">
                            <thead class="colum-header">
                                <tr>
                                    <th class="table-column" scope="col" style="width:32%">Tài liệu</th>
                                    <!-- <th class="table-column" scope="col">Tag</th> -->
                                    <th class="table-column" scope="col">Ngày tạo</th>
                                    <th class="table-column" scope="col">Ngày cập nhật</th>
                                    <th class="table-column" scope="col">Số chữ</th>
                                    <th class="table-column" scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listdatacontent as $data):?>
                                  <tr>
                                    <td>
                                        <a href=""><?=$data->title?></a>
                                        <p class="set-widthcontent"><?=$data->content_ai?></p>
                                    </td>
                                    <!-- <td>Jacob</td> -->
                                    <td><?= date('d-m-Y', $data->created_at) ?></td>

                                    <td><?= date('d-m-Y', $data->updated_at) ?></td>
                                    <td><i class='bx bx-signal-4'></i><?=str_word_count($data->content_ai)?></td>
                                    <td>
                                        <!-- <a href=""><i class="fa-solid fa-cloud-arrow-down"></i></a> -->
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="/plugins/admin/phoenix_ai-controller-admin-deletecontent/?id=<?php echo $data->id?>"><i class="fa-regular fa-trash-can"></i></a>  
                                    </td>
                                  </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
<?php include('footer.php'); ?>