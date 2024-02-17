<?php getHeader();?>
	<!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="rs clsH3Blog">Đơn hàng</h1>
                    <ul class="list-inline rs">
                        <li class="list-inline-item"><a href="/">Trang chủ</a></li>

                        
                        <li class="list-inline-item"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li class="list-inline-item">Đơn hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ::::::  End  Breadcrumb Section  ::::::  -->

     <!-- ::::::  Start  Main Container Section  ::::::  -->
     <main id="main-container" class="main-container">
        <div class="container">
        	<?php if(!empty($tmpVariable['listData'])) { ?>
            <div class="row">
                <div class="col-12">
                    <!-- Start Cart Table -->
                    <div class="table-content table-responsive cart-table-content m-t-30">
                        <table>
                            <thead class="gray-bg" >
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Tích lũy</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
									foreach($tmpVariable['listData'] as $item){
                                        $n= count($item['OrderMerchandise']['listMerchandise'])+1;
                                        $total= 0;
                                        $totalPoint= 0;
                                        $status= '';
                                        if($item['OrderMerchandise']['status']=='new'){
                                            $status= 'Đơn hàng mới';
                                        }elseif($item['OrderMerchandise']['status']=='done'){
                                            $status= 'Hoàn thành';
                                        }elseif($item['OrderMerchandise']['status']=='cancel'){
                                            $status= 'Bị từ chối';
                                        }

										echo '  <tr>
                                                    <td>'.$item['OrderMerchandise']['code'].'</td>
                                                    <td>';
                                                    if(!empty($item['OrderMerchandise']['listMerchandise'])){
                                                        foreach($item['OrderMerchandise']['listMerchandise'] as $product){
                                                            echo '<p>'.$product['number'].' '.$product['name'].'</p>';

                                                            $total+= $product['number']*$product['price'];
                                                            $totalPoint+= $product['number']*$product['point'];
                                                        }
                                                    }
                                        echo        '</td>
                                                    <td>'.number_format($total).'đ</td>
                                                    <td>'.number_format($totalPoint).' điểm</td>
                                                    <td>'.$status.'</td>
                                                </tr>';
                                        
                                    }
								?>
                            </tbody>
                        </table>
                    </div>  <!-- End Cart Table -->
                     <!-- Start Cart Table Button -->
                    
                </div>
            </div>

                <!-- post pagination -->

                <?php

                $page = $tmpVariable['page'];
                $totalPage = $tmpVariable['totalPage'];
                $startPage = $tmpVariable['headPage'];
                $endPage = $tmpVariable['endPage'];
                $back = $tmpVariable['back'];
                $next = $tmpVariable['next'];
                $urlPage = $tmpVariable['urlPage'];
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
                
                if($totalPage>1){
                ?>
             
                <!-- post pagination --> 

                <div class="page-pagination">
                    <ul class="page-pagination__list">
                        <li class="page-pagination__item"><a class="page-pagination__link"  href="<?php echo $urlPage . $back ?>">Trước</a>
                        </li>
                        <?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
                                <li class="page-pagination__item"><a class="page-pagination__link <?php echo $i==$page?'active" ':'" href="'.$urlPage.$i.'"' ?>"><?php echo $i; ?></a></li>
                        <?php 
                        } ?>

                        <li class="page-pagination__item"><a class="page-pagination__link"  href="<?php echo $urlPage . $next ?>">Sau</a>
                        </li>
                      </ul>
                </div>
            <?php } ?>
            <?php }else {
                echo '<p>Bạn chưa có đơn hàng nào.</p>'; 
    	    }
            ?>
        </div>
    </main> <!-- ::::::  End  Main Container Section  ::::::  -->

<?php getFooter(); ?>