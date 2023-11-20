<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $info->name;?></title>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/assert/css/style.css">
    
    <?php mantan_header();?>
    
    <meta name="zalo-platform-site-verification" content="HStlBfNSVXblpAGlc-CLDKtbnmEXcnnKEJa" />

    <link rel="icon" type="image/x-icon" href="https://id.phoenixcamp.vn/upload/admin/images/logovuong.png" />
</head>

<body>
    <div class="p-3 text-white">
        <div class="modal-note mt-1">
            LƯU Ý: CHỈ CÁC THÀNH VIÊN ĐƯỢC XÁC NHẬN TẠI ĐÂY MỚI LÀ THÀNH VIÊN CHÍNH THỨC CỦA CỘNG ĐỒNG PHOENIX, HÃY XÁC NHẬN ĐÚNG MẶT THÀNH VIÊN PHOENIX ĐỂ TRÁNH CÁC TRƯỜNG HỢP MẠO DANH.
        </div>

        <div class="mb-3">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/icd3mBlSr0c?si=VPUNWQDRF8n25hDb&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

        <div class="row" id="infoAgency">
            <div class="col-lg-5 col-12 modal-image mb-3">
                <div class="image-character">
                    <img src="<?php echo $info->avatar;?>" alt="">
                </div>

                <div class="image-bottom">
                    <img src="<?php echo $urlThemeActive;?>/assert/img/check.png" alt="">
                </div>
            </div>

            <div class="col-lg-7 col-12 modal-info">
                <div class="modal-name">
                    <p><?php echo $info->name;?></p>
                </div>

                <div class="modal-detail">
                    <p><strong>Cấp bậc:</strong> <?php echo $info->name_position;?></p>
                    <p><strong>Điện thoại:</strong> <?php echo $info->phone;?></p>
                    <p><strong>Email:</strong> <?php echo $info->email;?></p>
                    <p><strong>Địa chỉ:</strong> <?php echo $info->address;?></p>
                    <p><button type="button" class="main-below-btn" onclick="window.open('<?php echo $info->facebook;?>' , '_blank')">XEM FACEBOOK</button></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>