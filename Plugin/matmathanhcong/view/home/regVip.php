<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký nhận bản luận giải đầy đủ Mật Mã Thành Công</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="myForm" action="/resultvip"  enctype="multipart/form-data" method="post" class="sendContact">
                    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                    <input type="hidden" name="idMessenger" value="<?php echo @$_GET['idMessenger'];?>">
                    
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Chọn ảnh đại diện</label>
                        
                        <input required value="" type="file" class="form-control phone-mask"  name="avatar" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Họ và Tên</label>
                        <input required type="text" class="form-control phone-mask" name="customer_name" id="customer_name" value="<?php echo @$_GET['name'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Ngày sinh dạng ngày/tháng/năm</label>
                        <input required type="text" class="form-control phone-mask datepicker" name="customer_birthdate" id="customer_birthdate" value="" placeholder="Ví dụ: 17/09/1989" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Điện thoại</label>
                        <input required type="text" class="form-control phone-mask" name="customer_phone" id="customer_phone" value="<?php if(!empty($_GET['day'])) echo $_GET['day'].'/'.$_GET['month'].'/'.$_GET['year'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Email</label>
                        <input required type="text" class="form-control phone-mask" name="customer_email" id="customer_email" value="" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                        <input required type="text" class="form-control phone-mask" name="customer_address" id="customer_address" value="" />
                    </div>
                    <div class="mb-3">
                        <button type="button" id="buttonReg" class="btn btn-primary" onclick="submitForm();">ĐĂNG KÝ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function submitForm()
        {
            $('#buttonReg').html('Đang gửi đăng ký');
            $('#buttonReg').prop('disabled', true);

            $('#myForm').submit();
        }
    </script>
    <script type="text/javascript">
    $(function () {  
        $(".datepicker").datepicker({         
                autoclose: true,         
                todayHighlight: true,
                dateFormat: 'dd/mm/yy'
            });
        });
    </script>
</body>
</html>