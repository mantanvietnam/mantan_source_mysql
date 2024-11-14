
<?php 
    getHeader();
    global $settingThemes;
?>
<main>
        <!--
        <div class="bgr-event">
            <div class="container-fluid">
                <img src="<?=$events['banner']?>" style="width: 100%;" alt="">
            </div>
        </div>
        -->

        <div class="information">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text-information">
                            <p class="line"><?=$events['name']?></p>
                            <div class="btn-info">
                                <p class="gr">
                                    <?php if ($events['status'] === 'active'): ?>
                                        MỞ ĐĂNG KÝ
                                    <?php else: ?>
                                        HẾT HẠN ĐĂNG KÝ
                                    <?php endif; ?>
                                </p>
                                <p class="or">HOT</p>
                                <p class="br">TRỰC TIẾP</p>
                                <p class="br">KINH DOANH</p>
                            </div>
                            <div class="address-info">
                                <p><i class="fa-regular fa-clock"></i><?= date('d-m-Y H:i:s', $events['time_start']); ?>
                                </p>
                                <p><i class="fa-solid fa-location-dot"></i><?=$events['address']?></p>
                                <p><i class="fa-solid fa-user"></i>Liên đoàn Điền kinh Việt Nam, Liên đoàn Điền kinh Lào, Liên đoàn Điền kinh Campuchia tổ chức; Tập đoàn Công nghiệp - Viễn thông Quân đội</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center">
                        <div class="log-in">
                            <div class="block">
                                <div class="date-time">
                                    <p class="number" id="days">19</p>
                                    <p class="date">Ngày</p>
                                </div>
                                <div class="date-time">
                                    <p class="number" id="hours">20</p>
                                    <p class="date">Giờ</p>
                                </div>
                                <div class="date-time">
                                    <p class="number" id="minutes">55</p>
                                    <p class="date">Phút</p>
                                </div>
                                <div class="date-time">
                                    <p class="number" id="seconds">20</p>
                                    <p class="date">Giây</p>
                                </div>
                            </div>
                        </div>
                
                        <div class="btn-loginn">
                            <?php if (!empty($info)): ?>
                                <?php if ($isRegistered): ?>
                                    <a>Bạn đã đăng ký sự kiện này.</a>
                                <?php else: ?>
                                    <a href="/participate?id=<?= $events['id'] ?>">Đăng ký tham gia</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="/participate?id=<?= $events['id'] ?>">Đăng ký tham gia</a>
                            <?php endif; ?>
                        </div>


                        
                        <div class="link">
                            <div class="copy-link d-flex align-items-center">
                                <a href=""><i class="fa-solid fa-link"></i></a>
                                <p>Sao chép liên kết</p>
                            </div>
                            <div class="social">
                                <img class="mess" src="<?php echo $urlThemeActive;?>/asset/image/fb.png" alt="">
                                <img class="fb" src="<?php echo $urlThemeActive;?>/asset/image/mess.jpg" alt="">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="text-info">
                    <h4>Thông tin sự kiện</h4>
                    <p><?=$events['info']?></p>
                </div>
                <div class="calendar">
                    <h4>Lịch trình sự kiện</h4>
                    <p><?=$events['plan']?></p>
                </div>
                <div class="regulations">
                    <h4>Quy định tham dự</h4>
                    <p><?=$events['rule']?></p>
                </div>
                <div class="committee">
                    <h4>Ban tổ chức</h4>
                </div>
            </div>
        </div>

        <section class="news__event">
            <div class="event pt-5 ">
                <div class="container">
                    <div class="row">
                        <p>Sự Kiện Liên Quan<span class="red-dot">•</span></p>
                        <div class="news">
                            <div class="row">
                                <?php foreach ($listDataevent as $event):?>
                                    <div class="col-lg-4">
                                        <a href="/detailevent/<?php echo @$event->slug ?>.html">
                                            <div class="card-news">
                                                <div class="overlay"></div> <!-- Lớp overlay -->
                                                <img src="<?=$event->banner?>" alt="">
                                                <div class="text top-text">
                                                    <p class="name">Khởi nghiệp</p>
                                                    <p class="logo"><i class="fas fa-arrow-right"></i></p>
                                                </div>
                                                <div class="text under-text">
                                                    <p class="date-time"><?php echo date('d/m/Y', $event->time_start);?></p>
                                                    <h4><?=$event->name?></h4>
                                                    <p class="date-time"><?=$event->address?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>  
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="takeall">
                            <a href="/allevent">Xem tất cả</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>

    const timeStart = <?= json_encode($events['time_start'] ?? 0) ?> * 1000; 
    const now = new Date().getTime(); 
    if (timeStart > now) {
     
        const countdownInterval = setInterval(() => {
            const now = new Date().getTime();
            const distance = timeStart - now;

            if (distance < 0) {
                clearInterval(countdownInterval);
                document.querySelector('.log-in').innerHTML = '<p>Sự kiện đã bắt đầu!</p>';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').innerText = days;
            document.getElementById('hours').innerText = hours;
            document.getElementById('minutes').innerText = minutes;
            document.getElementById('seconds').innerText = seconds;
        }, 1000);
    } else {
        document.querySelector('.log-in').innerHTML = '<p>Thời gian đã kết thúc!</p>';
    }
</script>
    <?php getFooter();?>