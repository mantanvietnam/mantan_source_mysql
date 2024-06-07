
<?php 
    getheader();

?>
<main>
        <section id="section-recruitment-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="recruitment-content">
                            <div class="recruitment-breadcrumbs">
                                <p><a href="">Home</a> <i class="fa-solid fa-caret-right" aria-hidden="true"></i> <a href="">Tuyển dụng</a> <i class="fa-solid fa-caret-right" aria-hidden="true"></i> SEO EXECUTIVE</p>
                            </div>
                            <div class="recruitment-banner">
                                <img src="<?=$urlThemeActive?>asset/image/toptop-car.jpg" alt="">
                            </div>
                        
                            <?php if(!empty($list_requeriment)){
                                        foreach($list_requeriment as $key => $item){
                                            
                                            if(!empty($item->evaluate)){
                                     ?>
                                    
                            <div class="recruitment-title">
                                <a href="/detailrequeid?id_requeriment=<?php echo $item->id ?>">
                                    <h1><?= $item->title?></h1>
                                    <p><i class="fa-regular fa-calendar-days" aria-hidden="true"></i> 21/02/2024</p>
                                </a>
                            </div>
                            <?php }}} ?>
                            <div class="recruitment-content-detail">
                                <p>Chuyên viên SEO sẽ có vai trò vô cùng quan trọng trong công việc phát triển và xây dựng các chiến lược SEO dài hạn cho công ty và khách hàng. Khi trở thành chuyên viên SEO tại Top Top, bạn sẽ có cơ hội được làm việc với
                                    các “chiến binh” nhiều kinh nghiệm và vô cùng năng động.</p>
                                <p>Tham khảo ngay mô tả công việc, yêu cầu, quyền lợi và cách thức ứng tuyển SEO EXECUTIVE dưới đây nếu bạn muốn trở thành một thành viên của đại gia đình Top Top.</p>

                                <h3>Mô tả công việc chuyên viên SEO</h3>
                                <ul>
                                    <li>Thực hiện tối ưu hóa các website của công ty và đơn vị hợp tác với các công cụ tìm kiếm chủ yếu là Google</li>
                                    <li>Phát triển các kế hoạch và xây dựng chiến lược SEO dài hạn cho các website của công ty và đơn vị</li>
                                    <li>Đo lường, đọc và phân tích dữ liệu thống kê hành vi khách hàng trên website, check thứ hạng website (Google – Analytic, Google Webmaster Tools, Ahrefs…).</li>
                                    <li>Nghiên cứu hành vi, tâm lý khách hàng để đưa ra định hướng phát triển nội dung cho các website</li>
                                    <li>Lập kế hoạch phân tích đánh giá từ khóa, đánh giá thị trường thông qua mức độ tìm kiếm từ khóa</li>
                                    <li>Báo cáo công việc, vị trí từ khóa, lượng truy cập website hàng tuần/ tháng</li>
                                    <li>Xây dựng các backlink chất lượng (social Entity, Forum, Guest Post) và phát triển các website vệ tinh (PBN) để cải thiện thứ hạng từ khóa.</li>
                                    <li>Xây dựng website vệ tinh (PBN) về lĩnh vực công nghệ, phần mềm hoặc theo yêu cầu</li>
                                    <li>Phân tích, lựa chọn từ khóa SEO dựa trên thông tin về sản phẩm và dịch vụ của doanh nghiệp.</li>
                                    <li>Thực hiện các công việc tối ưu hóa trên trang (SEO onpage)</li>
                                    <li>Tối ưu hóa nội dung cho website và kiểm soát bài viết với Team Content</li>
                                    <li>Thực hiện các công việc tối ưu hóa Backlink (SEO offpage) giao cho thực tập sinh triển khai</li>
                                    <li>Lập kế hoạch thực hiện SEO theo sự phân công của trưởng nhóm</li>
                                </ul>

                                <h3>Yêu cầu ứng viên</h3>
                                <ul>
                                    <li>Có kiến thức và kinh nghiệm về kỹ thuật SEO ít nhất 1 năm</li>
                                    <li>Có ý thức kỷ luật cao, sự kiên nhẫn, cẩn thận, ham mê học hỏi.</li>
                                    <li>Có kỹ năng Quản lý thời gian và công việc</li>
                                    <li>Có tinh thần trách nhiệm cao.</li>
                                    <li>Có khả năng làm việc độc lập hoặc theo nhóm.</li>
                                    <li>Kiến thức về Content “chuẩn SEO”</li>
                                    <li>Kiến thức về Content “chuẩn SEO”</li>
                                    <li>Có khả năng viết tốt, đam mê trong lĩnh vực quảng cáo, thương hiệu.</li>
                                    <li>Có kiến thức Marketing căn bản và phân tích thị trường.</li>
                                </ul>

                                <h3>Quyền lợi</h3>
                                <ul>
                                    <li>Mức lương từ 7-12 triệu </li>
                                    <li>Được tiếp xúc làm nhiều và nhận dự án SEO</li>
                                    <li>Tham gia BHXH, BHYT, BHTN theo quy định nhà nước </li>
                                    <li>Môi trường làm việc năng động, chuyên nghiệp </li>
                                    <li>Tham gia các hoạt động happy day, team building, du lịch… cùng công t</li>
                                    <li>Lương tháng 13</li>
                                </ul>

                                <h3>Cách thức ứng tuyển:</h3>
                                <p>Gửi CV theo form bên dưới hoặc về địa chỉ <span>tuyendung@toptop.vn</span></p>
                            </div>

                            <div class="recruitment-registration-form" id="recruitment-form">

                                <h3>CHÚNG TÔI LUÔN CHÀO ĐÓN BẠN GIA NHẬP TOP TOP</h3>

                                <div class="registration-form-content">
                                    <form action="">
                                        <select name="position" id="position" required="">
                                                        <option value="position-1">Chọn chức vụ</option>
                                                        <option value="position-2">Trưởng phòng IT</option>
                                                        <option value="position-3">Trưởng phòng Marketing</option>
                                                        <option value="position-4">Thực tập sinh IT</option>
                                                    </select>

                                        <input type="text" placeholder="Họ và tên *" required="">

                                        <input type="text" placeholder="Số điện thoại *" required="">

                                        <input type="text" placeholder="Email *" required="">

                                        <input type="file" required="">

                                        <div>
                                            <button class="custom-btn" type="submit">Gửi</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="recruitment-right-site">
                            <div class="recruitment-job-info">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="td-strong">Nơi làm việc:</td>
                                            <td>Toà Phoenix Building, số 18 đường Thanh Bình, Mộ Lao, Hà Đông, Hà Nội</td>
                                        </tr>
                                        <tr>
                                            <td class="td-strong">Cấp bậc:</td>
                                            <td>Nhân Viên</td>
                                        </tr>
                                        <tr>
                                            <td class="td-strong">Bằng cấp:</td>
                                            <td>Cao Đẳng, Đại Học</td>
                                        </tr>
                                        <tr>
                                            <td class="td-strong">Kinh nghiệm:</td>
                                            <td> >1 năm</td>
                                        </tr>
                                        <tr>
                                            <td class="td-strong">Mức lương:</td>
                                            <td>8 - 15 triệu </td>
                                        </tr>
                                        <tr>
                                            <td class="td-strong">Số lượng tuyển:</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td class="td-strong">Hạn nộp hồ sơ:</td>
                                            <td>30/04/2023</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div>
                                    <a href="#recruitment-form">Ứng tuyển ngay</a>
                                </div>

                            </div>

                            <div class="recruitment-other-jobs">
                                <h3>
                                    Các vị trí tuyển dụng khác
                                </h3>

                                <div class="list-recruitment-other-jobs">
                                    <div class="item-recruitment-other-jobs">
                                        <div class="other-jobs-date">
                                            <p>25/02/2024</p>
                                        </div>

                                        <div class="other-jobs-name">
                                            <a href="">SENIOR DIGITAL MARKETING</a>
                                        </div>

                                        <div class="other-jobs-description">
                                            Mô tả công việc – Lên kế hoạch quảng cáo cho các dự án của công ty qua từng giai đoạn với KPI cụ thể– Quản lý hiệu quả và tối ưu chi phí các kênh quảng cáo digital của công ty: Google/ Youtube/ Facebook / Tiktok– Phối hợp với team content, design để sáng
                                        </div>

                                        <div class="other-jobs-btn">
                                            <a href="">Xem chi tiết <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="item-recruitment-other-jobs">
                                        <div class="other-jobs-date">
                                            <p>25/02/2024</p>
                                        </div>

                                        <div class="other-jobs-name">
                                            <a href="">SENIOR DIGITAL MARKETING</a>
                                        </div>

                                        <div class="other-jobs-description">
                                            Mô tả công việc – Lên kế hoạch quảng cáo cho các dự án của công ty qua từng giai đoạn với KPI cụ thể– Quản lý hiệu quả và tối ưu chi phí các kênh quảng cáo digital của công ty: Google/ Youtube/ Facebook / Tiktok– Phối hợp với team content, design để sáng
                                        </div>

                                        <div class="other-jobs-btn">
                                            <a href="">Xem chi tiết <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="item-recruitment-other-jobs">
                                        <div class="other-jobs-date">
                                            <p>25/02/2024</p>
                                        </div>

                                        <div class="other-jobs-name">
                                            <a href="">SENIOR DIGITAL MARKETING</a>
                                        </div>

                                        <div class="other-jobs-description">
                                            Mô tả công việc – Lên kế hoạch quảng cáo cho các dự án của công ty qua từng giai đoạn với KPI cụ thể– Quản lý hiệu quả và tối ưu chi phí các kênh quảng cáo digital của công ty: Google/ Youtube/ Facebook / Tiktok– Phối hợp với team content, design để sáng
                                        </div>

                                        <div class="other-jobs-btn">
                                            <a href="">Xem chi tiết <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="item-recruitment-other-jobs">
                                        <div class="other-jobs-date">
                                            <p>25/02/2024</p>
                                        </div>

                                        <div class="other-jobs-name">
                                            <a href="">SENIOR DIGITAL MARKETING</a>
                                        </div>

                                        <div class="other-jobs-description">
                                            Mô tả công việc – Lên kế hoạch quảng cáo cho các dự án của công ty qua từng giai đoạn với KPI cụ thể– Quản lý hiệu quả và tối ưu chi phí các kênh quảng cáo digital của công ty: Google/ Youtube/ Facebook / Tiktok– Phối hợp với team content, design để sáng
                                        </div>

                                        <div class="other-jobs-btn">
                                            <a href="">Xem chi tiết <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="item-recruitment-other-jobs">
                                        <div class="other-jobs-date">
                                            <p>25/02/2024</p>
                                        </div>

                                        <div class="other-jobs-name">
                                            <a href="">SENIOR DIGITAL MARKETING</a>
                                        </div>

                                        <div class="other-jobs-description">
                                            Mô tả công việc – Lên kế hoạch quảng cáo cho các dự án của công ty qua từng giai đoạn với KPI cụ thể– Quản lý hiệu quả và tối ưu chi phí các kênh quảng cáo digital của công ty: Google/ Youtube/ Facebook / Tiktok– Phối hợp với team content, design để sáng
                                        </div>

                                        <div class="other-jobs-btn">
                                            <a href="">Xem chi tiết <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php 
    getFooter();
?>
