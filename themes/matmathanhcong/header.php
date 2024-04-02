<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">

    <meta http-equiv="content-language" content="vi" />
    <meta name="geo.region" content="VN" />
    <meta name="geo.placename" content="Hà Nội" />
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <link rel="icon" type="image/svg+xml" href="<?php global $settingThemes;echo @$settingThemes['logo'];?>" />
    

    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/lib/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/lib/slick.min.css">
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/lib/slick-theme.min.css"> 
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/aos.css"> 
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/style.css?v=1002"> 
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/stylePlus.css"> 

    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/custom.css"> 
    <script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/lib/jquery.min.js"></script>   
    <script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/lib/bootstrap-datepicker.js"></script> 
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/plugin/jquery.toast.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" ></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    
    <script>
        var base_url = "<?php echo $urlThemeActive;?>";
        var base = "/";
    </script>
    <style type="text/css">

        .main-color {
            color: #f9a25c;
        }
        .tb-wrap {
            position: relative;
            text-align: center;
        }
        .tb-div {
            position: relative;
            margin: 0 auto;
            max-width: 300px;
        }
        .arrow {
            position: absolute;
        }
        #arr1 {
            left: 70px;
            top: 51px;
        }
        #arr2 {
            left: 50px;
            bottom: 10px;
        }
        #arr3 {
            left: 50px;
            bottom: 90px;
        }
        #arr4 {
            left: 50px;
            top: 60px;
        }
        #arr5 {
            left: 40px;
            bottom: 0px;
        }
        #arr6 {
            left: 144px;
            bottom: 0px;
        }
        #arr7 {
            right: 36px;
            bottom: 0px;
        }
        #arr8 {
            left: 70px;
            bottom: 52px;
        }
        @media only screen and (min-width: 1024px) {
            table.inner-border {
                border: 0 !important;
            }
        }
        @media only screen and (min-width: 1360px) {
            #arr1 {
                left: 53px;
                top: 51px;
            }
            #arr2 {
                left: 20px;
                bottom: 10px;
            }
            #arr3 {
                left: 20px;
                bottom: 90px;
            }
            #arr4 {
                left: 20px;
                top: 60px;
            }
            #arr5 {
                left: 125px;
                bottom: 0px;
            }
            #arr6 {
                left: 205px;
                bottom: 0px;
            }
            #arr7 {
                left: 45px;
                bottom: 0px;
            }
            #arr8 {
                left: 50px;
                bottom: 52px;
            }
        }
        table.inner-border {
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid #f9a25c;
            margin: 0 auto;
        }
        table.inner-border td {
            border: 1px solid #f9a25c;
        }

        .cell {
            /*border:1px solid #F9A25C;*/
            width: 80px;
            height: 80px;
            text-align: center;
            font-size: 24px;
            text-shadow: 1px 0px 4px rgba(249, 162, 92, 0.8);
        }
        table.inner-border tr:first-child td {
            border-top: 0;
        }
        table.inner-border tr td:first-child {
            border-left: 0;
        }
        table.inner-border tr:last-child td {
            border-bottom: 0;
        }
        table.inner-border tr td:last-child {
            border-right: 0;
        }
        .header-menu ul li{
            margin-right: 40px !important;
            font-size: 14px;
        }
        input[type="number"]{
            -moz-appearance: textfield;
        }
    </style>
    
    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
</head> 
    <body>
        <header>
            <div class="header-menu">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-2 col-6 col-sm-6">
                            <div class="logo"><a href="/"><img src="<?php echo @$settingThemes['logo'];?>" class="img-fluid" alt="<?php echo @$settingThemes['name_company'];?>"></a></div>
                        </div>
                        <div class="col-md-10 col-6 col-sm-6">
                            <div class="btn-bar text-right d-none"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>/images/bar.svg" class="img-fluid" alt="<?php echo @$settingThemes['name_company'];?>"></a></div>
                            <div class="h-menu">
                                <div class="close-menu d-none"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>/images/close.svg" class="img-fluid" alt="<?php echo @$settingThemes['name_company'];?>"></a></div>
                                <ul>
                                    <?php 
                                        $menu = getMenusDefault();

                                        if(!empty($menu)){
                                            foreach($menu as $key => $value){
                                                echo '  <li>
                                                            <a href="'.$value->link.'" style=" text-transform: uppercase; ">
                                                                <img src="'.$value->description.'" class="img-fluid" alt="'.$value->name.'">'.$value->name.'
                                                            </a>
                                                        </li>';
                                            }
                                        }
                                    ?>
                                    
                                    <li>
                                        <a href="" data-toggle="modal" data-target="#exampleModalheader"><img src="<?php echo $urlThemeActive;?>/images/menu-2.png" class="img-fluid" alt="Mua luận giải MMTC">MUA LUẬN GIẢI MMTC</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModalheader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm thông tin để tải bản luận giải đầy đủ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <form action="/resultvip"  enctype="multipart/form-data" method="post" class="sendContact">
                            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                            
                            <div class="modal-body">
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
                                    <input required type="text" class="form-control phone-mask datepicker" name="customer_birthdate" id="customer_birthdate" value="<?php if(!empty($_GET['day'])) echo $_GET['day'].'/'.$_GET['month'].'/'.$_GET['year'];?>" placeholder="Ví dụ: 17/09/1989" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-phone">Điện thoại</label>
                                    <input required type="text" class="form-control phone-mask" name="customer_phone" id="customer_phone" value="<?php echo @$_GET['phone'];?>" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-phone">Email</label>
                                    <input required type="text" class="form-control phone-mask" name="customer_email" id="customer_email" value="" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                                    <input required type="text" class="form-control phone-mask" name="customer_address" id="customer_address" value="" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">GỬI</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <style type="text/css">
                .datepicker-dropdown{
                    min-width: 15rem !important;
                }
                .datepicker-dropdown .table-condensed{
                    width: 100%;
                    margin: 5px;
                    text-align: center;
                }
            </style>
            <script type="text/javascript">
                $(".datepicker").datepicker({
                   dateFormat: 'dd/mm/yy'
                });
            </script>
        </header>