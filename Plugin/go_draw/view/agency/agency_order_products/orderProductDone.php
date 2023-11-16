<?php include __DIR__.'/../header.php';?>
<style>
    footer {
        display: none;
    }
    main {
        overflow: hidden;
    }
</style>
<main>
    <section class="box-gallery">
        <div class="container">
            <div class="content-detail-gallery detail-cart">
                <div class="title text-center" style="display: flex;">
                    <span>Yêu cầu mua hàng đã thanh toán</span>
                    <svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
                    </svg>
                </div>
                <div class="content-cart">
                    <div class="table-cart">
                        <?php
                        if(!empty($listData)){
                            echo '  <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                              <th scope="col" width="50">ID</th>
                                              <th scope="col">Sản phẩm</th>
                                              <th scope="col" width="150">Thành tiền</th>
                                              <th scope="col" width="150">Thanh toán</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        
                                        if(!empty($listData)){
                                            foreach ($listData as $key => $value) {
                                                echo '  <tr>
                                                          <td scope="row">'.$value->id.'</td>
                                                          <td>';
                                                          
                                                          if(!empty($value->product)){
                                                            echo '<table class="noborder">';
                                                            foreach ($value->product as $keyProduct=>$product) {
                                                                echo '  <tr>
                                                                            <td>'.$product->name.'</td>
                                                                            <td width="150">'.number_format($product->amount).' x '.number_format($product->price).'đ</td>
                                                                        </tr>';
                                                            }
                                                            echo '</table>';
                                                          }

                                                echo      '</td>
                                                          <td>'.number_format($value->total_price).'</td>
                                                          <td>'.date_format($value->updated_at, "H:i:s d/m/Y").'</td>
                                                        </tr>';
                                            }
                                        }
                                        
                                        
                            echo        '</tbody>
                                    </table>';


                            
                        }
                        ?>
                    </div>

                    <div class="pagination">
                        <ul>
                            <?php
                            if($totalPage>0){
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
                                  
                                echo '<li><a href="'.$urlPage.'1"><img src="/plugins/go_draw/view/agency/images/arr-left.svg" class="img-fluid" alt=""></a></li>';
                                  
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active= ($page==$i)?'active':'';

                                    echo '<li><a href="'.$urlPage.$i.'" class="'.$active.'">'.$i.'</a></li>';
                                }

                                echo '<li><a href="'.$urlPage.$totalPage.'"><img src="/plugins/go_draw/view/agency/images/arr-right.svg" class="img-fluid"></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include __DIR__.'/../footer.php';?>