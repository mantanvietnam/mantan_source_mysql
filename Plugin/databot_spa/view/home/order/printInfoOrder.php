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

        <link rel="stylesheet" href="/plugins/databot_spa/view/home-icon/assets/css/print.css?time=<?php echo time(); ?>"/>   
  
          
          
        
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
                                    if(!empty($data->product)){
                                        foreach($data->product as $item){
                                            echo '  <tr>
                                                        <td>'.$item->product->name.'</td>
                                                        <td>'.$item->quantity.'</td>
                                                        <td>'.number_format($item->price).'</td>
                                                    </tr>';
                                        }
                                    }
                                ?>
                                <?php
                                    if(!empty($data->combo)){
                                        foreach($data->combo as $item){
                                            echo '  <tr>
                                                        <td>'.$item->combo->name.'</td>
                                                        <td>'.$item->quantity.'</td>
                                                        <td>'.number_format($item->price).'</td>
                                                    </tr>';
                                        }
                                    }
                                ?>
                                <?php
                                    if(!empty($data->service)){
                                        foreach($data->service as $item){
                                            echo '  <tr>
                                                        <td>'.$item->service->name.'</td>
                                                        <td>'.$item->quantity.'</td>
                                                        <td>'.number_format($item->price).'</td>
                                                    </tr>';
                                        }
                                    }
                                ?>
                                <tr>
                                    <td class="text-right" colspan="">Giảm giá:</td>
                                    <?php if($data->promotion<=100){?>
                                    <td colspan="2"><?php echo number_format($data->promotion);?>%</td>
                                     <?php }else{?>
                                    <td colspan="2"><?php echo number_format($data->promotion);?></td>
                                    <?php }?>
                                </tr>
                            
                                
                                <tr>
                                    <td class="text-right" colspan="">Tổng thanh toán:</td>
                                    <td colspan="2"><b><?php echo number_format($data->total_pay);?>đ</b></td>
                                </tr>
                                <?php if($data->bill->type_collection_bill=='tien_mat'){ ?>
                                <tr>
                                    <td class="text-right" colspan="">Tiền khách đưa:</td>
                                    <td colspan="2"><b><?php echo number_format($data->bill->moneyCustomerPay);?>đ</b></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="">Tiền trả lại:</td>
                                     <td colspan="2"><b><?php echo number_format($data->bill->moneyReturn);?>đ</b></td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td class="text-right" colspan="">hình thức thanh toán:</td>
                                     <td colspan="2"><b><?php echo $data->bill->typecollectionbill;?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p><b>Bằng chữ:</b> <em><?php echo convert_number_to_words($data->total_pay).' đồng';?></em></p>
                    
                   
                    <div class="row text-right footer">
                        <div class="col-md-6 col-sm-6 col-xs-6">khách hàng <br/><?php echo @$data->customer->name;?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6">Nhân viên<br/><?php echo $user->name;?></div>
                    </div>
                </div>
            </section>
        </div>
        <div id="dialog-confirm" title="Thông báo" style="display: none;">
            <p>Thanh toán thành công</p>
        </div>
<?php   
    $url = '/'.@$_GET['url'];
    if(@$_GET['type']=="checkout"){
         $url = '/listRoomBed';
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