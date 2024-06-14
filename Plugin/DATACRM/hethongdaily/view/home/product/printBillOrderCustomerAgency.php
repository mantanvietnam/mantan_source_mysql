<!DOCTYPE html>
<html>
    <head>
        <title>Phiếu thu</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/css/print.css?time=<?php echo time(); ?>"/>   
  
          
          
        
        <style type="text/css">
            @media print {
                @page {
                    size: 80mm 297mm;
                    margin: 0;
                }
            }
            .ui-dialog-titlebar-close{
                    display: none;
            }

            /*.text-center h2{
                text-transform: uppercase;
                font-family: sans-serif;
                font-weight: 600;
                padding: 16px;
            }*/
        </style>
    </head>
    <body>
        <div class="container">
            <header class="text-center mt-3">
                <h3><?php echo $system->name;?></h3>
                <h5>Đ/c: <?php echo  $member_sell->address;?></h5>
                <h5>ĐT: <?php echo $member_sell->phone;?></h5>
            </header>
            <section>
                <div class="text-center">
                    <h2>Phiếu thanh toán</h2>
                    <h5><b>Mã hóa đơn:</b> OC<?php echo($order->id); ?></h5>
                </div>
                <div class="content text-center">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">Thời gian: <?php echo date('H:i:s d/m/Y', $order->create_at);?></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><b>Sản phẩm</b></td>
                                    <td><b>SL</b></td>
                                    <td><b>Giá</b></td>
                                    <td><b>Giảm giá</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($order->detail)){
                                        foreach($order->detail as $item){
                                            $discount= '';                        
                                            if($item->discount>100){
                                              $discount= number_format($item->discount).'đ';
                                            }elseif($item->discount>0){
                                              $discount= $item->discount.'%';
                                            }
                                            echo '  <tr>
                                                        <td>'.$item->product->title.'</td>
                                                        <td>'.$item->quantity.'</td>
                                                        <td>'.number_format($item->price).'</td>
                                                        <td>'.$discount.'</td>
                                                    </tr>';
                                        }
                                    }
                                ?>
                                
                                <tr>
                                    <td class="text-right" colspan="">Tổng tiền:</td>
                                    <td colspan="3"><b><?php echo number_format($order->money);?>đ</b></td>
                                </tr>

                                <tr>
                                    <td class="text-right" colspan="">Giảm giá:</td>
                                    <td colspan="3"><?php echo (int) $order->promotion;?>%</td>
                                </tr>
                            
                                
                                <tr>
                                    <td class="text-right" colspan="">Tổng thanh toán:</td>
                                    <td colspan="3"><b><?php echo number_format($order->total);?>đ</b></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <p><b>Bằng chữ:</b> <em><?php echo convert_number_to_words($order->total).' đồng';?></em></p>
                    
                    <?php 
                    if(!empty($order->note_user)){
                        echo '<p><b>Ghi chú:</b> '.$order->note_user.'</p>';
                    }
                    ?>
                   
                    <div class="row footer">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                            Người mua<br/><?php echo $order->full_name;?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            Người bán<br/><?php echo $member_sell->name;?>
                        </div>
                    </div>
                    <?php if(!empty($member_sell->image_qr_pay)){ ?>
                    <div class=" footer " style="padding-top: 5px;">
                            <h5>Mã QR thanh toán</h5>
                            <img src="<?php echo $member_sell->image_qr_pay; ?>" style="width: 80%;">
                    </div>
                <?php } ?>
            </section>
        </div>
        <div id="dialog-confirm" title="Thông báo" style="display: none;">
            <p>Thanh toán thành công</p>
        </div>
        
        <?php   
            $url = '/orderCustomerAgency';

            if(!empty($_GET['type']) && $_GET['type']=="addOrderCustomer"){
                $url = '/addOrderCustomer';
            }
        ?>

        <script type="text/javascript">
            function closeFunction()
            {
                
            }

            $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                height: "auto",
                                width: 400,
                                modal: true,
                                close: closeFunction,
                                buttons: {
                                  "In hóa đơn": function() {
                                    $( this ).dialog( "close" );
                                    window.print();
                                    window.location= '<?php echo $url; ?>';
                                },
                                Cancel: function() {
                                      //$( this ).dialog( "close" );
                                      window.location= '<?php echo $url; ?>';
                                  }
                              }
                          });
        </script>
    </body>
</html>