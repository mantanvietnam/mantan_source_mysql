<?php include('header.php'); ?>
            <div class="aiva-document container-fluid">
                    <div class="document-search" style="width:98%">
                        <div class="title-aiva-document" style="text-align: center;"><h2>Phoenix Tài liệu</h2></div>
                        <div class="list-document-search row" style="width:97%; margin:auto;">
                            <div class="left-document col-md-3 col-12">
                                <a href="/dashboard">
                                    <div class="creat-document" style="color: #ffffff;
    width: auto;
    cursor: pointer;
    height: 46px;
    display: flex
;
    padding: 12px 27px;
    align-items: center;
    margin-right: 18px;
    border-radius: 10px;
    background-color: #5242F3;">
                                        <i class="fa-regular fa-folder"></i>
                                        <div class="name-button-document ms-1">
                                            Tạo tài liệu mới
                                        </div>
                                    </div>
                                </a>
                                <!-- <div class="select">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Tất cả</option>
                                        <option value="">tag1</option>
                                        <option value="">tag2</option>
                                        <option value="">tag3</option>
                                    </select>
                                </div> -->
                            </div>
                            <div class="right-document col-md-8 col-12">
                                <!-- <a href="/dashboard">
                                    <div class="creat-document">
                                        <i class="fa-regular fa-folder"></i>
                                        <div class="name-button-document ms-1">
                                            Tạo tài liệu mới
                                        </div>
                                    </div>
                                </a> -->
                                <!-- <div class="filter" onclick="toggleSearchForm()">
                                    <i class="fa-regular fa-folder"></i>
                                    <div class="name-two ms-1">
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
                                </div> -->
                              <form action="" method="get">
                                <div class="name-input-search">
                                    <div class="detail-input-search">
                                        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
                                        <button type="submit" class="icon-input-search" style="border: none;background: none;">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                        <input placeholder="Nhập từ khóa tìm kiếm" type="text" name="title" id="title" class="" value="<?php if(!empty($_GET['title'])) echo $_GET['title'];?>">
                                    </div>
                                </div>
                              </form>
                                
                            </div>
                        </div>
                    </div>
                    <div class="table-aiva-document" style="width: 97%;margin: auto; ">
                        <table class=" table-create-document">
                            <thead class="colum-header">
                                <tr>
                                    <th class="table-column" scope="col" style="width:32%">Tài liệu</th>
                                    <!-- <th class="table-column" scope="col">Tag</th> -->
                                    <th class="table-column" scope="col">Ngày tạo</th>
                                    
                                    <th class="table-column" scope="col">Số chữ</th>
                                    <th class="table-column" scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($info)):?>
                                    <?php foreach ($listdatacontent as $data):?>
                                    <tr>
                                        <td>
                                            <a href="<?=$data->link?>?id=<?php echo $data->id?>"><?=$data->title?></a>
                                            <div class="set-widthcontent"><?= htmlspecialchars($data->content_ai); ?></div>
                                        </td>
                                        <!-- <td>Jacob</td> -->
                                        <td><?= date('d-m-Y', $data->created_at) ?></td>

                                        
                                        <td><i class='bx bx-signal-4'></i><?=str_word_count($data->content_ai)?></td>
                                        <td style="text-align: center;">
                                            <!-- <a href=""><i class="fa-solid fa-cloud-arrow-down"></i></a> -->
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="deletecontent/?id=<?php echo $data->id?>"><i class="fa-regular fa-trash-can"></i></a>  
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
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
<?php include('footer.php'); ?>