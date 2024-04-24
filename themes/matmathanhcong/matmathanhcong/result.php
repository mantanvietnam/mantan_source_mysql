<?php 
    global $settingThemes;
    getHeader();
?>

<main>
    <section class="result-banner screen-result">
        <?php 
            if($age < 13){
                echo '<div class="old-res old-1"><img src="'.$urlThemeActive.'/images/bn-result-1.png" class="img-fluid w-100" alt=""></div>';
            }elseif($age > 12 && $age < 19){
                echo '<div class="old-res old-2"><img src="'.$urlThemeActive.'/images/bn-result-2.png" class="img-fluid w-100" alt=""></div>';
            }elseif($age > 18 && $age < 30){
                echo '<div class="old-res old-3"><img src="'.$urlThemeActive.'/images/bn-result-3.png" class="img-fluid w-100" alt=""></div>';
            }elseif($age > 29 && $age < 50){
                echo '<div class="old-res old-4"><img src="'.$urlThemeActive.'/images/bn-result-4.png" class="img-fluid w-100" alt=""></div>';
            }else{
                echo '<div class="old-res old-5"><img src="'.$urlThemeActive.'/images/bn-result-5.png" class="img-fluid w-100" alt=""></div>';
            }
        ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="result-step">
                    <div class="container">
                        <div class="content-home text-center">
                            <div class="">
                                <div class="item-slide">
                                    <div class="txt-result">
                                        <div class="title-result text-center" data-aos="fade-up">
                                            <h3>Kết Quả Tra Cứu</h3>
                                            <ul>
                                                <li>Họ và tên: <span><?php echo $_GET['name'];?></span></li>
                                                <li>Ngày sinh: <span><?php echo $_GET['day'].'/'.$_GET['month'].'/'.$_GET['year'];?></span></li>
                                            </ul> 
                                        </div>
                                        
                                        <div class="content-result text-center">
                                            <div class="box-number-result">
                                                <div class="add-number">
                                                    <ul>
                                                        <li data-aos="fade-left" data-aos-delay="100"><input type="text" class="txt_number_result" value="Ngày <?php echo $_GET['day'];?>" readonly></li>
                                                        <li data-aos="fade-left" data-aos-delay="300"><input type="text" class="txt_number_result" value="<?php echo $data_day;?>" readonly></li>
                                                        <li data-aos="fade-left" data-aos-delay="500"><input type="text" class="txt_number_result" value="<?php echo $kq_day;?>" readonly></li>
                                                    </ul>
                                                    <ul>
                                                        <li data-aos="fade-left" data-aos-delay="700"><input type="text" class="txt_number_result" value="Tháng <?php echo $_GET['month'];?>" readonly></li>
                                                        <li data-aos="fade-left" data-aos-delay="900"><input type="text" class="txt_number_result" value="<?php echo $data_month;?>" readonly></li>
                                                        <li data-aos="fade-left" data-aos-delay="1100"><input type="text" class="txt_number_result" value="<?php echo $kq_month;?>" readonly></li>
                                                    </ul>
                                                    <ul>
                                                        <li data-aos="fade-left" data-aos-delay="1300"><input type="text" class="txt_number_result" value="<?php echo $_GET['year'];?>" readonly></li>
                                                        <li data-aos="fade-left" data-aos-delay="1500"><input type="text" class="txt_number_result" value="<?php echo $data_year;?>" readonly></li>
                                                        <li data-aos="fade-left" data-aos-delay="1700"><input type="text" class="txt_number_result" value="<?php echo $kq_year;?>" readonly></li>
                                                    </ul>
                                                </div>
                                                <div class="total-result">
                                                    <div class="numb-total" data-aos="fade-left" data-aos-delay="1900"><input type="text" class="txt_total" readonly value="<?php echo $consoduongdoi;?>"></div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="display: contents;">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalheader">XEM BẢN ĐẦY ĐỦ</button> 
            </div>
        </div>

        <div class="resulf-text">
            <div class="container">
                <div class="intro-result-text">

                    <div class="intro-result-hiden">
                        <div id="tinhcach" class="mg-10 bg-f6f6f6">
                           <h4 class="title-tinhcach title-everyone">Con số chủ đạo đường đời là số <?php echo @$infoNumber[0]['Values']['ConSoChuDaoDuongDoi'];?></h4> 
                            <p class="description"><?php echo @$infoNumber[0]['Values']['ConSoChuDaoDuongDoi_NoiDung'];?></p>
                            <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                         <div id="duongdoi" class="mg-10 bd-10 bg-f6f6f6">
                            <h4 class="title-duongdoi title-everyone">Năng Lực Tự Nhiên Sẵn Có là số: <span >  <?php echo @$infoNumber[1]['Values']['NangLucTuNhienSanCo'];?></span></h4>
                            <p class="description"> <?php echo @$infoNumber[1]['Values']['NangLucTuNhienSanCo_NoiDung'];?></p>
                            <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                        <div id="chuky" class="mg-10 bd-10 bg-f6f6f6">
                            <h4 class="title-everyone">Chu Kỳ Vòng Đời là số: <span ><?php echo @$infoNumber[11]['Values']['ChuKyVongDoi1'];?></span></h4>
                            <p class="description"><?php echo @$infoNumber[11]['Values']['ChuKyVongDoi1_NoiDung'];?></p>
                            <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                            
                            <div class="box-text-chuky">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ckdd-img">
                                            <img src="<?php echo $urlThemeActive;?>images/chuky1.png">
                                            <div class="ckdd_number ckdd-1">
                                                <p>3</p>
                                            </div>
                                        </div>
                                        <div class="ckdd-title text-center">
                                            <p class="ckdd-text-1">Chu kỳ 1</p>
                                            <p class="ckdd-text-1">GIEO HẠT</p>
                                            <P class="ckdd-desc">Đầu đời - 30 tuổi (2030)</P>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="ckdd-img">
                                            <img src="<?php echo $urlThemeActive;?>images/chuky2.png">
                                                <div class="ckdd_number ckdd-2">
                                                    <p>1</p>
                                                </div>
                                        </div>

                                        <div class="ckdd-title text-center">
                                            <p class="ckdd-text-2">Chu kỳ 1</p>
                                            <p class="ckdd-text-2">GIEO HẠT</p>
                                            <P class="ckdd-desc">Đầu đời - 30 tuổi (2030)</P>
                                        </div>
                                    </div>
                                        
                                    <div class="col-4">
                                        <div class="ckdd-img">
                                            <img src="<?php echo $urlThemeActive;?>images/chuky3.png">
                                                <div class="ckdd_number ckdd-3">
                                                    <p>2</p>
                                                </div>
                                        </div>
                                        <div class="ckdd-title text-center">
                                            <p class="ckdd-text-3">Chu kỳ 1</p>
                                            <p class="ckdd-text-3">GIEO HẠT</p>
                                            <P class="ckdd-desc">Đầu đời - 30 tuổi (2030)</P>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                        </div> 

                        <div id="kimtuthap" class="mg-10 bd-10 bg-f6f6f6">
                           <h4>Kim tự tháp Thần số học</h4>
                           <p class="description">Kim tự tháp cho thấy 4 giai đoạn trong cuộc đời bạn sẽ tương ứng với đỉnh cao là số nào và thử thách là con số nào, tức là bạn nên tập trung phát triển số nào trong những năm này để đạt được nhiều thành công và hạnh phúc nhất. Từ tuổi đỉnh cao đầu tiên đến tuổi đỉnh cao cuối cùng (36 năm) chính là khoảng thời gian gặt hái nhiều thành công trong cuộc đời của bạn. Tuy vậy, trong 4 giai đoạn này cũng sẽ có những thách thức cụ thể mà cuộc đời muốn bạn vượt qua - những con số thử thách sẽ nói lên điều đó.</p>
                           <div class="intro-kimtuthap">
                                <div class="diagonal">
                                    <div class="diagonal-box">
                                        <div class="diagonal-detail" id="diagonal-step-1">
                                            <b>Tháng 10</b>
                                        </div>
                                        <div class="diagonal-circle-small" id="diagonal-step-2">
                                            <b>1</b>
                                        </div>
                                        <div class="diagonal-detail" id="diagonal-step-3">
                                            <b>Ngày 03</b>
                                        </div>
                                        <div class="diagonal-circle-small" id="diagonal-step-4">
                                            <b>3</b>
                                        </div>
                                        <div class="diagonal-detail" id="diagonal-step-5">
                                            <b>2000</b>
                                        </div>
                                        <div class="diagonal-circle-small" id="diagonal-step-6">
                                            <b>2</b>
                                        </div>
                                        <div class="diagonal-line-bottom-right" id="diagonal-step-7">
                                           
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-8">
                                           
                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-9">
                                            <b>4</b>
                                        </div>
                                        <div class="diagonal-detail" id="diagonal-step-10">
                                            <b>22-30 tuổi</b>
                                        </div>
                                        <div class="diagonal-line-bottom-right" id="diagonal-step-11">

                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-12">
                                            <b>5</b>
                                        </div>
                                        <div class="diagonal-detail" id="diagonal-step-13">
                                            <b>31-39 tuổi</b>
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-14">
                                           
                                        </div>

                                        <div class="diagonal-line-bottom-right" id="diagonal-step-15">
                                           
                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-16">
                                            <b>9</b>
                                        </div>
                                        <div class="diagonal-line-bottom-right" id="diagonal-step-17">
                                           
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-18">
                                           
                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-19">
                                            <b>3</b>
                                        </div>
                                        <div class="diagonal-detail" id="diagonal-step-20">
                                            <b>31-39 tuổi</b>
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-21">
                                           
                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-22">
                                            <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">       
                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-23">
                                            <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">       
                                        </div>
                                        <div class="diagonal-line-bottom-right" id="diagonal-step-24">
                                           
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-25">
                                           
                                        </div>
                                        <div class="diagonal-line-bottom-right" id="diagonal-step-26">
                                           
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-27">
                                           
                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-28">
                                            <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">       
                                        </div>
                                        <div class="diagonal-line-bottom-right" id="diagonal-step-29">
                                           
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-30">
                                           
                                        </div>
                                        <div class="diagonal-circle-big pulse animated" id="diagonal-step-31">
                                            <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">       
                                        </div>
                                        <div class="diagonal-line-bottom-right" id="diagonal-step-32">
                                           
                                        </div>
                                        <div class="diagonal-line-top-right" id="diagonal-step-33">
                                           
                                        </div>

                                    </div>
                                </div>
                                <p class="text-center font-weight">Kim tự tháp thần số học của bạn</p>
                                <p class="content fs-13 text-left pd-10">
                                    <em class="font-weight">
                                    5.1. GIAI ĐOẠN TỪ ĐẦU ĐỜI TỚI NĂM 30 TUỔI, BẠN CÓ ĐỈNH CAO LÀ SỐ 4 VÀ THỬ THÁCH LÀ SỐ <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">
                                    </em></br>
                                    <span class="text-red" data-toggle="modal" data-target="#exampleModalheader"> Bấm vào đây để xem luận giải của mục này!</span>
                                </p>
                                <p class="content fs-13 text-left pd-10">
                                    <em class="font-weight">
                                    5.2. GIAI ĐOẠN HAI TỪ NĂM 31 TUỔI TỚI 39 TUỔI, BẠN CÓ ĐỈNH CAO LÀ SỐ 5 VÀ THỬ THÁCH LÀ SỐ  <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">
                                    </em></br>
                                    <span class="text-red" data-toggle="modal" data-target="#exampleModalheader"> Bấm vào đây để xem luận giải của mục này!</span>
                                </p>
                                <p class="content fs-13 text-left pd-10">
                                    <em class="font-weight">
                                    5.3. GIAI ĐOẠN BA TỪ NĂM 40 TUỔI TỚI 48 TUỔI, BẠN CÓ ĐỈNH CAO LÀ SỐ 9 VÀ THỬ THÁCH LÀ SỐ   <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">
                                    </em></br>
                                    <span class="text-red" data-toggle="modal" data-target="#exampleModalheader"> Bấm vào đây để xem luận giải của mục này!</span>
                                </p>
                                <p class="content fs-13 text-left pd-10">
                                    <em class="font-weight">
                                    5.4. GIAI ĐOẠN TỪ NĂM 49 TUỔI TỚI CUỐI ĐỜI, BẠN CÓ ĐỈNH CAO LÀ SỐ 3 VÀ THỬ THÁCH LÀ SỐ <img src="<?php echo $urlThemeActive;?>images/eye-slash.svg">
                                    </em></br>
                                    <span class="text-red" data-toggle="modal" data-target="#exampleModalheader"> Bấm vào đây để xem luận giải của mục này!</span>
                                </p>
                           </div>
                        </div>

                        <div id="chi-so-nam" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Các chỉ số năm</h4>
                            <p class="description">Những con số này cho biết ở mỗi năm bạn nên tập trung định hướng phát triển theo con số nào. Thường thì cuộc đời sẽ tự đẩy bạn đi theo những con số này. Nếu đi lệch ra bạn thường sẽ bị cảm thấy cuộc sống mất cân bằng hoặc bất an. Còn nếu đi đúng hướng bạn thường cảm thấy rất bình an và thuận lợi.</br>
                            Lưu ý: Sau khi sử dụng VIP, mỗi năm bạn vào lại website tra cứu hoặc tải lại file để xem luận giải 3 năm tiếp theo và các nội dung luận giải mới nếu có!</p>
                            <div class="intro-chi-so-nam pd-20">
                                <table class="text-center mg-auto">
                                    <tbody>
                                        <tr>
                                            <td class="tt">Năm <?php echo getdate()['year'];?></td>
                                            <td class="tn text-success"><img src="<?php echo $urlThemeActive;?>images/eye-slash.svg"></td>
                                        </tr>
                                        <tr>
                                            <td class="tt">Năm  <?php echo getdate()['year']+1;?></td>
                                            <td class="tn text-success"><img src="<?php echo $urlThemeActive;?>images/eye-slash.svg"></td>
                                        </tr>
                                        <tr>
                                            <td class="tt">Năm  <?php echo getdate()['year']+2;?></td>
                                            <td class="tn text-success"><img src="<?php echo $urlThemeActive;?>images/eye-slash.svg"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="cl-red text-center mg-t-20" data-toggle="modal" data-target="#exampleModalheader"> Bấm vào đây để xem luận giải của mục này!</p>
                            </div>

                        </div>

                        <div id="chi-so-thang" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Các chỉ số tháng</h4>
                            <p class="description">Những con số này cho biết ở mỗi tháng sẽ có những điều gì có khả năng xảy ra và bạn nên tập trung làm việc như thế nào, theo con số nào nhưng ở mức độ bao quát thấp hơn chỉ số năm.</br>
                            Lưu ý: Sau khi sử dụng VIP, mỗi tháng bạn vào lại website tra cứu hoặc tải lại file để xem luận giải 3 tháng tiếp theo và các nội dung luận giải mới nếu có!</p>
                            <div class="intro-chi-so-nam pd-20">
                                <table class="text-center mg-auto">
                                    <tbody>
                                        <tr>
                                            <td class="tt">Tháng <?php echo getdate()['mon'].'/'.getdate()['year'];?></td>
                                            <td class="tn text-success"><img src="<?php echo $urlThemeActive;?>images/eye-slash.svg"></td>
                                        </tr>
                                        <tr>
                                            <td class="tt">Tháng <?php echo getdate()['mon']+1 .'/'.getdate()['year'];?></td>
                                            <td class="tn text-success"><img src="<?php echo $urlThemeActive;?>images/eye-slash.svg"></td>
                                        </tr>
                                        <tr>
                                            <td class="tt">Tháng <?php echo getdate()['mon']+2 .'/'.getdate()['year'];?></td>
                                            <td class="tn text-success"><img src="<?php echo $urlThemeActive;?>images/eye-slash.svg"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="cl-red text-center mg-t-20" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                            </div>

                        </div>

                        <div id="chi-so-su-menh" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Năng Lực Bên Trong:</h4>
                            <p class="description"><?php echo @$infoNumber[2]['Values']['NangLucBenTrong_NoiDung'];?></p>
                             <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                        <div id="thu-thach-su-menh" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Năng Lực Thể Hiện Bên Ngoài:</h4>
                            <p class="description"><?php echo @$infoNumber[3]['Values']['NangLucTheHienBenNgoai_NoiDung'];?></p>
                            <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                        <div id="chi-so-truong-thanh" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Trưởng Thành: </h4>
                            <p class="description"><?php echo @$infoNumber[4]['Values']['TruongThanh_NoiDung'];?></p>
                            <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                        <div id="nang-luc-truong-thanh" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Khả Năng:</h4>
                            <p class="description"><?php echo @$infoNumber[5]['Values']['KhaNang_NoiDung'];?></p>
                            <p class="cl-red"data-toggle="modal" data-target="#exampleModalheader" >Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                        <div id="chi-so-thu-thach-linh-hon" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Phản Hồi Tiềm Thức:</h4>
                            <p class="description"><?php echo @$infoNumber[6]['Values']['PhanHoiTiemThuc_NoiDung'];?></p>
                            <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader" >Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                        <div id="chi-so-nhan-cach" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Năng Lượng Vượt Trội:</h4>
                            <p class="description"><?php echo @$infoNumber[10]['Values']['NangLuongVuotTroi_NoiDung'];?></p>
                            <p class="cl-red" data-toggle="modal" data-target="#exampleModalheader"> Bấm vào đây để xem luận giải của mục này!</p>
                        </div>

                        <div id="chi-so-suc-manh" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Chỉ chố sức mạnh của bạn (rất quan trọng) </h4>
                            <p class="description">Biểu đồ này còn được gọi là biểu đồ ngày sinh do được tạo ra từ ngày sinh, biểu đồ này thể hiện sức mạnh nguyên thủy của bạn. Nó cho thấy tổng quan các ưu nhược điểm về năng lực, sức mạnh của bạn (thể chất, tinh thần, trí tuệ) và cho biết rất nhiều các điểm mạnh điểm yếu của bạn.</br>
                            Tóm lại biểu đồ này giống như đề bài toán mà vũ trụ gửi cho bạn, bạn cần hiểu đề để giải được bài toán thì cuộc sống của bạn sẽ cân bằng và tốt đẹp hơn nhiều.</br>
                            Lưu ý rằng tên thường dùng của bạn có thể bù trừ vào những điểm yếu của biểu đồ này, vì vậy hãy tìm hiểu thêm biểu đồ tổng hợp để đặt một tên mới cho bạn nếu cần thiết. Tên mới này có thể dùng ở facebook, zalo,...</p>
                            <div class="intro-suc-manh text-center">
                                <table class="inner-border">
                                    <tr class="inner-border-tr">
                                        <td id="td3" class="local-number local-n-3 cell animated pulse infinite"><?php  echo @$full_number[3]?></td>
                                        <td id="td6" class="local-number local-n-6 cell animated pulse infinite"><?php  echo @$full_number[6]?></td>
                                        <td id="td9" class="local-number local-n-9 cell animated pulse infinite"><?php  echo @$full_number[9]?></td>
                                    </tr>
                                    <tr class="inner-border-tr">
                                        <td id="td2" class="local-number local-n-2 cell animated pulse infinite"><?php  echo @$full_number[2]?></td>
                                        <td id="td5" class="local-number local-n-5 cell animated pulse infinite"><?php  echo @$full_number[5]?></td>
                                        <td id="td8" class="local-number local-n-8 cell animated pulse infinite"><?php  echo @$full_number[8]?></td>
                                    </tr>
                                    <tr class="inner-border-tr">
                                        <td id="td1" class="local-number local-n-1 cell animated pulse infinite"><?php  echo @$full_number[1]?></td>
                                        <td id="td4" class="local-number local-n-4 cell animated pulse infinite"><?php  echo @$full_number[4]?></td>
                                        <td id="td7" class="local-number local-n-7 cell animated pulse infinite"><?php  echo @$full_number[7]?></td>
                                    </tr>
                                </table>

                                <p class="font-weight pd-10">Biểu đồ sức mạnh (Biểu đồ ngày sinh) của bạn</p>
                                <p class="cl-red pd-10" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                            </div>
                            
                        </div>

                        <div id="bieudo-ten-tonghop" class="mg-10 bd-10 bg-f6f6f6">
                            <h4>Biểu đồ tiên và biểu đồ tổng hợp </h4>
                            <p class="description">Biểu đồ này còn được gọi là biểu đồ ngày sinh do được tạo ra từ ngày sinh, biểu đồ này thể hiện sức mạnh nguyên thủy của bạn. Nó cho thấy tổng quan các ưu nhược điểm về năng lực, sức mạnh của bạn (thể chất, tinh thần, trí tuệ) và cho biết rất nhiều các điểm mạnh điểm yếu của bạn.</br>
                            Tóm lại biểu đồ này giống như đề bài toán mà vũ trụ gửi cho bạn, bạn cần hiểu đề để giải được bài toán thì cuộc sống của bạn sẽ cân bằng và tốt đẹp hơn nhiều.</br>
                            Lưu ý rằng tên thường dùng của bạn có thể bù trừ vào những điểm yếu của biểu đồ này, vì vậy hãy tìm hiểu thêm biểu đồ tổng hợp để đặt một tên mới cho bạn nếu cần thiết. Tên mới này có thể dùng ở facebook, zalo,...</p>
                            <div class="intro-suc-manh text-center">
                                <table class="inner-border">
                                    <tr class="inner-border-tr">
                                        <td id="tdt3" class="local-number local-n-3 cell animated pulse infinite"><?php  echo @$full_number[3]?></td>
                                        <td id="tdt6" class="local-number local-n-6 cell animated pulse infinite"><?php  echo @$full_number[6]?></td>
                                        <td id="tdt9" class="local-number local-n-9 cell animated pulse infinite"><?php  echo @$full_number[9]?></td>
                                    </tr>
                                    <tr class="inner-border-tr">
                                        <td id="tdt2" class="local-number local-n-2 cell animated pulse infinite"><?php  echo @$full_number[2]?></td>
                                        <td id="tdt5" class="local-number local-n-5 cell animated pulse infinite"><?php  echo @$full_number[5]?></td>
                                        <td id="tdt8" class="local-number local-n-8 cell animated pulse infinite"><?php  echo @$full_number[8]?></td>
                                    </tr>
                                    <tr class="inner-border-tr">
                                        <td id="tdt1" class="local-number local-n-1 cell animated pulse infinite"><?php  echo @$full_number[1]?></td>
                                        <td id="tdt4" class="local-number local-n-4 cell animated pulse infinite"><?php  echo @$full_number[4]?></td>
                                        <td id="tdt7" class="local-number local-n-7 cell animated pulse infinite"><?php  echo @$full_number[7]?></td>
                                    </tr>
                                </table>

                                <p class="cl-red pd-10" data-toggle="modal" data-target="#exampleModalheader">Bấm vào đây để xem luận giải của mục này!</p>
                            </div>
                            
                        </div>
                </div>
            </div>
        </div>

        <div class="result-end mt-3" style="display: contents;">
            <div class="container">
                <div class="title-res-end text-center">
                    <p>Bạn vừa trải nghiệm xong <span>Bài Số Học Miễn Phí 14 Chỉ Số</span></p>
                    <p>Để có bức tranh tổng quan hơn về cuộc đời bạn, vui lòng mua <span>Bài Số Học đầy đủ 26 Chỉ Số</span> dưới đây!</p>
                    <div class="btn-buy"><a href="javascript: void(0);" data-toggle="modal" data-target="#exampleModalheaderheader">ĐĂNG KÝ NGAY</a></div>
                </div>
            </div>
        </div>
    </section>
</main>

<style type="text/css">
    ul {
        list-style: none outside;
    }
    ol, ul {
        padding-left: 0 !important;
        list-style: none;
    }
    blockquote, q {
        quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    strong {
        font-weight: bold;
    }

    h1 {
        font-size: 2.25em;
        margin: 0.67em 0 0.5em;
        line-height: 1.25;
        letter-spacing: -.02em;
    }

    h2 {
        font-size: 1.75em;
        margin: 0.83em 0 0.5em;
        line-height: 1.35;
    }

    em, i {
        font-style: italic;
    }

    ul {
        list-style-type: none;
    }

    .page-tnam1 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/betrai.png"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .page-tnu1 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/begai.png"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .page-t2 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/chung.png"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .page-tnam3 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/nam.png"))) }}');
        background-size:100% 100%;
        background-repeat:no-repeat;
    }

    .page-tnu3 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/nu.png"))) }}');
        background-size:100% 100%;
        background-repeat:no-repeat;
    }

    .page-1 {
        position: relative;
    }

    .page-1 .author .name {
        text-transform: uppercase;
        font-size: 25px;
        color: #ffde32;
        position: absolute;
        bottom: 56%;
        right: 32.5%;
        letter-spacing: 1.5px;
    }

    .page-1 .author .number {
        text-transform: uppercase;
        font-size: 55px;
        color: #ffde32;
        line-height: 2;
        padding-left: 167px !important;
        margin-left: 167px !important;
        margin-top: 270px !important;
        padding-top: 275px !important;
    }

    .c00000 {
        color: #c00000 !important;
    }

    .ffc000 {
        color: #ffc000 !important;
    } 

    .mg-page .content-page div .c00000 {
        color: #c00000 !important;
        font-weight: bold;
    }

    p, ul, label {
        font-size: 18px;
        line-height: 1.2;
    }

    .title-page-1 {
        text-align: center;
        color: #630;
        text-transform: uppercase;
    }

    .title-page p {
        font-size: 24px;
        text-transform: uppercase;
        text-align: center;
        color: #630;
        border-bottom: 10px solid #ffc000;
        font-weight: 700;
        width: 75%;
        margin: auto;
        line-height: 1.2;
    }

    .page-3 .content-page .img-left {
        width: 40%;
        float: left;
        margin-right: 20px;
    }

    .page-3 .content-page .img-left img {
        width: 100%;
    }

    .size-number {
        font-size: 70px;
    }

    .logo-page {
        width: 50%;
        margin: auto;
    }

    .logo-page p {
        text-align: center;
        text-transform: uppercase;
        font-weight: bold;
        border-bottom: 3px solid #c00000;
    }

    .content-page .box-image {
        width: 50%;
        margin: auto;
        padding: 10px 0;
    }

    .content-page .box-image img {
        width: 100%;
    }

    .ending-page {
        text-align: center;
    }

    /*.page-5 {
        background: no-repeat url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/pdf/img/bgpage5.png"))) }}');
        background-size:100% 100%;
    }*/

    .pagetnam1 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/bgpage2.jpg"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .pagetnu1 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/bgpage3.jpg"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .paget2 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/bgpage4.jpg"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .pagetnam3 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/bgpage1.jpg"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .pagetnu3 {
        background:url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path("/frontend/images/bgpage5.jpg"))) }}');
        background-repeat:no-repeat;
        background-size:100% 100%;
    }

    .page-5 .name-user,
    .text-main-col {
        /* display: flex; */
        text-transform: uppercase;
        font-size: 20px;
    }

    .page-5 table {
        width: 75%;
        padding-top: 20px
    }

    .page-5 .table-birthday,
    .page-5 .table-name {
        width: 49% !important;
    }

    .page-5 .table-birthday table .cell,
    .page-5 .table-name table .cell {
        width: 110px;
        height: 110px;
    }

    .table-birthday .inner-border .inner-border-tr .local-n-2, 
    .table-name .inner-border .inner-border-tr .local-n-2,
    .table-birthday .inner-border .inner-border-tr .local-n-1, 
    .table-name .inner-border .inner-border-tr .local-n-1,
    .table-name .inner-border .inner-border-tr .local-n-3,
    .table-birthday .inner-border .inner-border-tr .local-n-3,
    .table-name .inner-border .inner-border-tr .local-n-6,
    .table-birthday .inner-border .inner-border-tr .local-n-6,
    .table-name .inner-border .inner-border-tr .local-n-5,
    .table-birthday .inner-border .inner-border-tr .local-n-5,
    .table-name .inner-border .inner-border-tr .local-n-8,
    .table-birthday .inner-border .inner-border-tr .local-n-8,
    .table-name .inner-border .inner-border-tr .local-n-7,
    .table-birthday .inner-border .inner-border-tr .local-n-7,
    .table-name .inner-border .inner-border-tr .local-n-4,
    .table-birthday .inner-border .inner-border-tr .local-n-4,
    .table-name .inner-border .inner-border-tr .local-n-9,
    .table-birthday .inner-border .inner-border-tr .local-n-9 {
        padding: 0 !important;
    }

    .name-user,.text,.text-main-col {
        color: #630;
    }

    .text-main-col {
        /* border-bottom: 3px solid #630; */
        padding-bottom: 10px;
    }

    .number {
        color: #c00000 !important;
    }


    .col-table .text {
        font-size: 20px;
        padding-left: 10px;
    }

    .col-table .number {
        font-size: 32px;
        padding-right: 10px;
    }
    .col-table ul li {
        display: flex;
        border-bottom: 3px solid #ffffff;
    }

    body {
        font-family: 'Philosopher';
    }

    .cot-moc li {
        padding: 0 20px;
        position: relative;
        text-align: center;
    }

    .cot-moc li {
        display: block !important;
    }

    .col-lg-8 {
        width: 66.67%;
        margin: auto;
    }

    .col-lg-12 {
        width: 100%;
    }

    .flex {
        display: flex;
    }

    .col-lg-6 {
        width: 50%;
        padding: 0 15px;
    }

    .column {
        float: left;
        width: 50%;
        height: 250px;
    }

    .column2 {
        float: left;
        width: 50%;
        height: 50px;
    }

    .column3 {
        float: left;
        width: 25%;
        height: 150px;
    }

    .row:after {
        clear: both;
    }
    
    .page-break {
        page-break-after: always;
    }

    .old {
        position: relative;
    }

    .old span {
        position: relative;
        display: block;
        text-align: center;
        left: 0;
        top: -20px;
        margin-top: -25px;
    }
    

    /* css biểu đồ*/


    /* mũi tên hướng lên trên */
    .to-top-all {
        position: absolute;
        top: 70px;
    }

    .to-top-1 {
        left: 130px;
    }

    .to-top-2 {
        left: 180px;
    }

    .to-top-3 {
        left: 230px;
    }

    /* mũi tên hướng sang phải */
    .to-right-all {
        position: absolute;
        left: 80px;
    }

    .to-right-1 {
        top: 105px;
    }

    .to-right-2 {
        top: 155px;
    }

    .to-right-3 {
        top: 205px;
    }

    /* mũi tên chéo hướng trái */
    .to-top-left {
        position: absolute;
        top: 86px;
        left: 111px;
    }

    /* mũi tên chéo hướng phải */
    .to-top-right {
        position:absolute;
        top: 86px;
        left: 111px;
    }

    .table-birthday,.table-name {
        margin-left: 10px;
    }

    .table-birthday .inner-border {
        /* margin-left:20px; */
        position: relative;
    }

    .table-name .inner-border {
        margin-left:20px;
        position: relative;
    }

    .table-birthday .inner-border .local-number,
    .table-name .inner-border .local-number {
        margin: 50px;
        color: #ffffff;
    }

    /* css số 1 */
    .table-birthday .inner-border .inner-border-tr .local-n-1,
    .table-name .inner-border .inner-border-tr .local-n-1 {
        padding-top: 25px;
        padding-left: 101px;
    }

    /* css số 2 */
    .table-birthday .inner-border .inner-border-tr .local-n-2,
    .table-name .inner-border .inner-border-tr .local-n-2 {
        padding-top: 25px;
        padding-left: 101px;
    }

    /* css số 3 */
    .table-birthday .inner-border .inner-border-tr .local-n-3 {
        padding-top: 44px;
        padding-left: 101px;
    }

    .table-name .inner-border .inner-border-tr .local-n-3 {
        padding-top: 24px;
        padding-left: 101px;
    }

    /* css số 4 */
    .table-name .inner-border .inner-border-tr .local-n-4 {
        padding-top: 25px;
        padding-left: 23px;
    }

    .table-birthday .inner-border .inner-border-tr .local-n-4 {
        padding-top: 25px;
        padding-left: 23px;
    }


    /* css số 5 */
    .table-name .inner-border .inner-border-tr .local-n-5 {
        padding-top: 25px;
        padding-left: 23px;
    }

    .table-birthday .inner-border .inner-border-tr .local-n-5 {
        padding-top: 25px;
        padding-left: 23px;
    }

    /* css số 6 */
    .table-name .inner-border .inner-border-tr .local-n-6 {
        padding-top: 24px;
        padding-left: 23px;
    }

    .table-birthday .inner-border .inner-border-tr .local-n-6 {
        padding-top: 24px;
        padding-left: 23px;
    }

    /* css số 7 */
    .table-name .inner-border .inner-border-tr .local-n-7 {
        padding-top: 25px;
        padding-left: 23px;
    }

    .table-birthday .inner-border .inner-border-tr .local-n-7 {
        padding-top: 25px;
        padding-left: 23px;
    }

    /* css số 8 */
    .table-name .inner-border .inner-border-tr .local-n-8 {
        padding-top: 25px;
        padding-left: 23px;
    }

    .table-birthday .inner-border .inner-border-tr .local-n-8 {
        padding-top: 25px;
        padding-left: 23px;
    }

    /* css số 9 */
    .table-name .inner-border .inner-border-tr .local-n-9 {
        padding-top: 24px;
        padding-left: 23px;
    }

    .table-birthday .inner-border .inner-border-tr .local-n-9 {
        padding-top: 24px;
        padding-left: 23px;
    }

</style>

<?php getFooter();?>  