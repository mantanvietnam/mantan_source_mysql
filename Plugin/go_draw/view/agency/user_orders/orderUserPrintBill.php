<!DOCTYPE html>
<html>
    <head>
        <title>Phiếu thu</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!--
        <link rel="stylesheet" href="<?php echo $urlHomes . 'app/Plugin/mantanHotelVer2/view/manager'; ?>/css/bootstrap-theme.min.css"/>     
        <link rel="stylesheet" href="<?php echo $urlHomes . 'app/Plugin/mantanHotelVer2/view/manager'; ?>/css/style.css"/>     
        -->
        
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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
        </style>
    </head>
    <body>
        <div class="container">
            <header class="text-center">
                <h3><?php echo $infoAgency->name;?></h3>
                <h4>Đ/c: <?php echo $infoAgency->address;?></h4>
                <h4>ĐT: <?php echo $infoAgency->phone;?></h4>
            </header>
            <section>
                <div class="text-center">
                    <h2>Hóa đơn thanh toán</h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">Thời gian: <?php echo date('H:i:s d/m/Y');?></div>
                        <div class="col-md-12 col-sm-12 col-xs-12">Tên khách hàng: <?php echo $infoUser->name; ?></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><b>Sản phẩm</b></td>
                                    <td><b>Số lượng</b></td>
                                    <td><b>Chi phí</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($infoOrder->product)){
                                        foreach ($infoOrder->product as $keyProduct=>$product) {
                                            echo '  <tr>
                                                        <td>'.$product->name.'</td>
                                                        <td>'.number_format($product->amount).'</td>
                                                        <td>'.number_format($product->unit_price).'</td>
                                                    </tr>';
                                        }
                                    }
                                ?>
                                
                                <tr>
                                    <td class="text-right" colspan="">Tổng tiền:</td>
                                    <td colspan="2"><b><?php echo number_format($infoOrder->total_price);?>đ</b></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <p><b>Bằng chữ:</b> <em><?php echo convert_number_to_words($infoOrder->total_price).' đồng';?></em></p>
                    
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
                                    window.location= '/orderUserProcess';
                                },
                                Cancel: function() {
                                      //$( this ).dialog( "close" );
                                      window.location= '/orderUserProcess';
                                  }
                              }
                          });
        </script>
    </body>
</html>