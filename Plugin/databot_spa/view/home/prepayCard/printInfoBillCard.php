<!DOCTYPE html>
<html>
    <head>
        <title>Phiếu thu</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/css/bootstrap.min.css?time=<?php echo time(); ?>"/>
        <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/css/bootstrap-theme.min.css?time=<?php echo time(); ?>"/>     
        <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/css/style.css?time=<?php echo time(); ?>"/>     
             
        <script type="text/javascript" src="/plugins/databot_spa/view/home/assets/js/bootstrap.min.js?time=<?php echo time(); ?>"></script>
        <script src="/plugins/databot_spa/view/home/assets/vendor/js/bootstrap.js?time=<?php echo time(); ?>"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

            .text-center h2{
                text-transform: uppercase;
                font-family: sans-serif;
                font-weight: 600;
                padding: 16px;
            }
        </style>
    </head>
   
    <body>
        <div class="container">
            <header class="text-center">
                <h3><?php echo $data->spa->name;?></h3>
                <h5>Đ/c: <?php echo  $data->spa->address;?></h5>
                <h5>ĐT: <?php echo $data->spa->phone;?></h5>
            </header>
            <section>
                <div class="text-center">
                    <h2>Phiếu thanh toán</h2>
                    <h5><b>Mã hóa đơn:</b> <?php echo($data->id); ?></h5>
                </div>
                <div class="content text-center">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">Thời gian: <?php echo date('H:i:s d/m/Y', time());?></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><b>Sản phẩm</b></td>
                                    <td><b>Số lượng</b></td>
                                    <td><b>Giá</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($data->CustomerCard)){
                                        foreach($data->CustomerCard as $item){
                                            echo '  <tr>
                                                        <td>'.$item->infoPrepayCard->name.'</td>
                                                        <td>'.$item->quantity.'</td>
                                                        <td>'.number_format($item->price_sell).'</td>
                                                    </tr>';
                                        }
                                    }
                                ?>
                                
                                
                            
                                
                                <tr>
                                    <td class="text-right" colspan="">Tổng thanh toán:</td>
                                    <td colspan="2"><b><?php echo number_format($data->total);?>đ</b></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-right" colspan="">Tiền khách đưa:</td>
                                    <td colspan="2"><b><?php echo number_format($data->bill->moneyCustomerPay);?>đ</b></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="">Tiền trả lại:</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <p><b>Bằng chữ:</b> <em><?php echo convert_number_to_words($data->total).' đồng';?></em></p>
                    
                   
                    <div class="row text-right footer">
                        <div class="col-md-6 col-sm-6 col-xs-6"></div>
                        <div class="col-md-6 col-sm-6 col-xs-6">Nhân viên<br/><?php echo $user->name;?></div>
                    </div>
                </div>
            </section>
        </div>
        <div id="dialog-confirm" title="Thông báo" style="display: none;">
            <p>Thanh toán thành công</p>
        </div>
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
                                    window.location= '/';
                                },
                                Cancel: function() {
                                      //$( this ).dialog( "close" );
                                      window.location= '/';
                                  }
                              }
                          });
        </script>
    </body>
</html>