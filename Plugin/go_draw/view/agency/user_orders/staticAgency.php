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
                    <span>Thống kê đơn hàng</span>
                    <svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
                    </svg>
                </div>
                <div class="content-cart">
                    <form method="get" action="">
                        <div class="row">
                        
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Từ ngày</label>
                                <input type="text" class="form-control datepicker" name="from_date" value="<?php if(!empty($_GET['from_date'])) echo $_GET['from_date'];?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tới ngày</label>
                                <input type="text" class="form-control datepicker" name="to_date" value="<?php if(!empty($_GET['to_date'])) echo $_GET['to_date'];?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary">Thống kê</button>
                            </div>

                            <div class="col-md-6 mb-3">
                                Tổng tiền: <?php echo number_format($total_money);?>đ
                            </div>
                        
                        </div>
                    </form>
                    <div class="table-cart">
                        <?php
                        if(!empty($listData)){
                            echo '  <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                              <th scope="col" width="50">ID</th>
                                              <th scope="col">Sản phẩm</th>
                                              <th scope="col" width="150">Thành tiền</th>
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
                                                                            <td width="50">'.number_format($product->amount).'</td>
                                                                        </tr>';
                                                            }
                                                            echo '</table>';
                                                          }

                                                echo      '</td>
                                                          <td>'.number_format($value->total_price).'</td>
                                                        </tr>';
                                            }
                                        }
                                        
                                        
                            echo        '</tbody>
                                    </table>';


                            
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
$( function() {
    $( ".datepicker" ).datepicker({
      dateFormat: "dd/mm/yy"
    });

} );
</script>

<?php include __DIR__.'/../footer.php';?>