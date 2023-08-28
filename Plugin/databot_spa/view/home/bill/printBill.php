<!DOCTYPE html>
<html>
<head>
    <title>Phiếu thu</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <style type="text/css">
    .rs{
        margin: 0;
        padding: 0;
    }
    .mt_6{
        margin-top: 6px;
    }
    .mt_15{
        margin-top: 15px;
    }
    .f1{
        margin-bottom: 95px;
    }
    .main{
        max-width: 800px;
        margin: 0 auto;
        margin-top: 15px;
        padding: 0 10px 30px;
    }
    .display_flex{
        display: flex;
        -webkit-display: flex;
        -moz-display: flex;
    }
    .header1{
        width: 50%;
    }
    .f1{
        width: 20%;
        text-align: center;
    }
    .p_bao{
        width: 100%;
        overflow: hidden;
        height: 20px;
    }
    .p_bao1{
        height: 41px;
    }
    .hide_mb{
        display: block;
    }
    .show_mb{
        display: none;
    }
    @media screen and (max-width: 767px){
        .hide_mb{
            display: none;
        }
        .show_mb{
            display: block;
        }
        .p_bao{
            height: 41px;
        }
        .header{
            flex-direction: column;
        }
        .header1{
            width: 100%;
            text-align: center;
        }
        .h_left{
            margin-bottom: 7px;
        }
        .f1{
            width: 33.33%;
        }
        .dongdau{
            justify-content: center;
        }
    }
</style>
<div class="main">
    <div class="header display_flex">
        <div class="header1 h_left">
            <p class="rs"><strong>Đơn vị: </strong><?php echo $data->spa->name;?></p>
            <p class="rs"><strong>Địa chỉ: </strong><?php echo $data->spa->address;?></p>
        </div>
        <div class="header1 h_right text-center">
            <p class="rs"><strong>Mẫu số 01 - TT</strong></p>
            <p class="rs">(Ban hành theo TT số: 200/2014/QĐ-BTC ngày 20/3/2006 của Bộ trưởng BTC)</p>
        </div>
    </div>
    <h3 class="text-center">PHIẾU CHI</h3>
    <p class="rs text-center"><em><?php echo 'Ngày '.$data->date['mday'] . ' tháng ' . $data->date['mon'] . ' năm ' . $data->date['year'];?></em></p>
    <div class="quyenso text-right">
        <p class="rs">Quyển số: . . . . . . . . . . . . . . </p>
        <p class="rs">Số: . . . . . . . . . . . . . . . . . . . </p>
        <p class="rs">Nợ: . . . . . . . . . . . . . . . . . . . </p>
        <p class="rs">Có: . . . . . . . . . . . . . . . . . . . </p>
    </div>
    <div class="content">
        <p class="rs p_bao">Họ và tên người nhận tiền: <?php echo @$data->full_name;?></p>
        <p class="rs p_bao">Địa chỉ: . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</p>
        <p class="rs">Lý do nộp: <?php echo @$data->note;?></p>
        <p class="rs p_bao p_bao1">Số tiền: <?php echo number_format(@$data->total);?>đ (Viết bằng chữ): <?php echo convert_number_to_words($data->total).' đồng';?></p>
        <p class="rs p_bao p_bao1">Kèm theo:  . . . . . . . . . . . . . . . . . . . . . . . . . . Chứng từ gốc: . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</p>
        <div class="text-right mt_6">
            <em><?php echo 'Ngày '.$data->date['mday'] . ' tháng ' . $data->date['mon'] . ' năm ' . $data->date['year'];?></em>
        </div>
    </div>
   <div class="dongdau display_flex mt_6">
        <div class="f1">
            <p class="rs"><strong>Giám đốc</strong></p>
            <p class="rs"><em>(Ký, họ tên, đóng dấu)</em></p>
        </div>
        <div class="f1">
            <p class="rs"><strong>Kế toán trưởng</strong></p>
            <p class="rs"><em>(Ký, họ tên)</em></p>
        </div>
        <div class="f1">
            <p class="rs"><strong>Thủ quỹ</strong></p>
            <p class="rs"><em>(Ký, họ tên)</em></p>
        </div>
        <div class="f1 hide_mb">
            <p class="rs"><strong>Người lập phiếu</strong></p>
            <p class="rs"><em>(Ký, họ tên)</em></p>
        </div>
        <div class="f1 hide_mb">
            <p class="rs"><strong>Người nhận tiền</strong></p>
            <p class="rs"><em>(Ký, họ tên)</em></p>
        </div>
    </div>
    <div class="show_mb">
        <div class="dongdau display_flex mt_6 ">
            <div class="f1">
                <p class="rs"><strong>Người lập phiếu</strong></p>
                <p class="rs"><em>(Ký, họ tên)</em></p>
            </div>
            <div class="f1">

                <p class="rs"><strong>Thủ quỹ</strong></p>
                <p class="rs"><em>(Ký, họ tên)</em></p>
            </div>
        </div>
    </div>
    
    <p class="rs p_bao mt_95">Đã nhận đủ số tiền (viết bằng chữ): <?php echo convert_number_to_words($data->total).' đồng';?></p>
    <p class="rs p_bao">+ Tỷ giá ngoại tệ (vàng bạc, đá quý):  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</p>
    <p class="rs p_bao">+ Số tiền quy đổi:  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</p>


</div>
</body>
<div id="dialog-confirm" title="Thông báo" style="display: none;">
            <p>Bạn muốn in phiếu chi này không</p>
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
                                    window.location= '/listBill';
                                },
                                Cancel: function() {
                                      //$( this ).dialog( "close" );
                                      window.location= '/listBill';
                                  }
                              }
                          });
        </script>
</html>