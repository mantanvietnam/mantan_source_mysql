<?php
getHeader();
global $urlThemeActive;
?>

    <section id="bg-booking-online">
        <div class="box-image-booking"
            style="background: url(<?= $urlThemeActive ?>img/thaianhimg/bgbooking.jpg) 50%; background-size: cover; background-repeat: no-repeat;">
        </div>
    </section>

    <div id="booking-tabs"
        style="background: url(<?= $urlThemeActive ?>img/thaianhimg/bg-booking-tab.png) 50%; background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: -37px">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Đặt tour</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Đặt
                                phòng</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">Đặt bàn</button>
                        </li>
                    </ul>

                    <div class="box-search relative">
                        <label for="">
                            <div class="box-icon absolute">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <input type="search" placeholder="Tìm kiếm">
                        </label>
                    </div>

                    <div class="tab-content tab-content-booking mb-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table width="100%">
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên tour</th>
                                    <th>Ngày đặt</th>
                                    <th>Ngày đi </th>
                                    <th>Đến ngày</th>
                                    <th>Số người</th>
                                    <th>Số tiền</th>
                                </tr>
                                <?php
                                 foreach($databookTour as $key => $value){
                                    if(!empty($value)){
                                        $tour = getTour($value->id);
                                 ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $tour->name ?></td>
                                    <td><?php echo date('d/m/Y', $value->created) ?></td>
                                    <td><?php echo date('d/m/Y', $tour->datestart) ?></td>
                                    <td><?php echo date('d/m/Y', $tour->dateend) ?></td>
                                    <td><?php echo $value->numberpeople ?></td>
                                    <td><?php echo number_format($tour->price*$value->numberpeople) ?></td>
                                </tr>
                               <?php }} ?>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table width="100%">
                                <tr>
                                    <th>Mã</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đặt</th>
                                    <th>Ngày nhận</th>
                                    <th>Ngày trả</th>
                                    <th>Số tiền</th>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <table width="100%">
                                <tr>
                                    <th>Mã</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đặt</th>
                                    <th>Ngày nhận</th>
                                    <th>Ngày trả</th>
                                    <th>Số tiền</th>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr>
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                                <tr style="background: #97C4BD;">
                                    <td>11211</td>
                                    <td>Khách sạn Westlake Tây Hồ, Hà Nội </td>
                                    <td>2023-01-01 07:30</td>
                                    <td>2023-01-01 07:35</td>
                                    <td>2023-01-02 07:35</td>
                                    <td>500.000</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
getFooter();?>