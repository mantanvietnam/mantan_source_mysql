<?php getHeader();?>

<main>
    <section id="section-post-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <div class="post-content">
                                <div class="post-breadcrumbs">
                                    <p><a href="">Home</a> <i class="fa-solid fa-caret-right"></i> <a href="">Tin tức</a> <i class="fa-solid fa-caret-right"></i> Thủ Tục Thành Lập Công Ty Bao Gồm Những Bước Nào?</p>
                                </div>

                                <div class="post-title">
                                    <h1><?php echo $post->title;?></h1>

                                    <p><i class="fa-regular fa-calendar-days"></i><?php echo date('d/m/Y', $post->time);?></p>
                                </div>

                                <div class="post-content-detail">
                                    <p>
                                        <a href="">Thủ tục thành lập công ty</a> hoặc doanh nghiệp gồm những bước nào? Việc thành lập một công ty là một quá trình phức tạp và cần tuân thủ một số thủ tục pháp lý để đảm bảo tính hợp pháp của công ty. Trong
                                        bài viết này, <span class="toptop-strong">TOP TOP</span> sẽ cung cấp cho bạn những thông tin quan trọng cũng như hướng dẫn những bước quan trọng để bạn có sự chuẩn bị tốt hơn khi đăng ký kinh doanh với cơ quan chức
                                        năng.
                                    </p>

                                    <h3>5 loại hình doanh nghiệp tại Việt Nam</h3>

                                    <p>
                                        <?php echo $post->description;?>

                                        <div class="post-content-detail-img">
                                            <img src="<?php echo $post->image;?>" alt="">
                                        </div>
                                    </p>

                                    <h4>
                                        1. Công ty trách nhiệm hữu hạn hai thành viên trở lên
                                    </h4>
                                    <p>Công ty trách nhiệm hữu hạn (viết tắt là TNHH) hai thành viên trở lên là doanh nghiệp có từ hai chủ sở hữu trở lên, không phân biệt chủ sở hữu là cá nhân hay tổ chức. Số lượng chủ sở hữu tối đa không được quá 50. Mỗi thành
                                        viên sẽ góp vốn vào doanh nghiệp và chịu trách nhiệm về các khoản nợ hoặc nghĩa vụ tài sản của doanh nghiệp trong phạm vi vốn góp.
                                        <br>Công ty TNHH 02 thành viên trở lên không được phép phát hành cổ phần nhưng được phép phát hành trái phiếu. Hội đồng thành viên là cơ quan có quyền quyết định cao nhất của công ty TNHH 02 thành viên trở lên. Hội
                                        đồng thành viên bao gồm tất cả các thành viên là cá nhân và người đại diện của thành viên là tổ chức.
                                    </p>

                                    <h4>
                                        2. Công ty cổ phần
                                    </h4>
                                    <p>Công ty cổ phần là doanh nghiệp mà trong đó vốn điều lệ được chia thành các phần bằng nhau gọi là cổ phần. Cổ đông là những người sở hữu cổ phiếu hoặc cổ phần của một công ty, họ có thể là cá nhân hoặc tổ chức. Công ty
                                        cổ phần cần có ít nhất 03 cổ đông và không hạn chế số lượng, mỗi cổ đông chịu trách nhiệm về các khoản nợ hoặc nghĩa cụ tài sản của công ty trong phạm vi vốn góp của mình.
                                        <br> Không chỉ được phép phát hành cổ phần, công ty cổ phần còn có thể phát hành trái phiếu và các loại chứng khoán khác của công ty. Hội đồng quản trị là cơ quan có toàn quyền nhân danh công ty để quyết định các hoạt
                                        động được quy định trong Luật doanh nghiệp điều 153, chương V. Hội đồng quản trị có từ 03 đến 11 thành viên, số lượng cụ thể được quy định trong điều lệ công ty và nhiệm kỳ mỗi thành viên không quá 05 năm.
                                    </p>

                                    <h3>Thủ tục thành lập công ty, đăng ký kinh doanh</h3>

                                    <p>
                                        Đối với những ai chưa hiểu rõ về thủ tục hoặc cách thành lập công ty, phần này sẽ cung cấp chi tiết những gì cần làm khi tiến hành đăng ký kinh doanh. Cách thành lập doanh nghiệp, công ty bao gồm:
                                        <div class="post-content-detail-img">
                                            <img src="<?=$urlThemeActive?>asset/image/toptop-notebook.jpg" alt="">
                                        </div>

                                        <ul>
                                            <li>Tên doanh nghiệp sử dụng các chữ cái trong bảng chữ cái tiếng Việt, các chữ F, J, Z, W, chữ số và ký hiệu.</li>
                                            <li>Không đặt tên trùng với tên của doanh nghiệp đã đăng ký.</li>
                                            <li>Không sử dụng từ ngữ, ký hiệu vi phạm truyền thống lịch sử, văn hóa hoặc thuần phong mỹ tục.</li>
                                        </ul>
                                    </p>

                                </div>
                            </div>

                    
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="outstanding-post">
                                <h3>
                                    Bài viết nổi bật
                                </h3>
                                <div class="list-outstanding-post">
                                    <div class="row">
                                    <?php if (!empty($otherPosts)): ?>
                                        <?php foreach ($otherPosts as $key => $value): ?>
                                        <div class="item-outstanding-post col-lg-12 no-padding">
                                            <div class="col-lg-5 no-padding outstanding-np">
                                                <div class="outstanding-post-img">
                                                    <a href=""><img src="<?php echo $post->image;?>" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="outstanding-post-info">
                                                    <a href=""><?php echo $post->title;?></a>
                                                    <p><i class="fa-regular fa-calendar-days"></i> <?php echo date('d/m/Y', $post->time);?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                   
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