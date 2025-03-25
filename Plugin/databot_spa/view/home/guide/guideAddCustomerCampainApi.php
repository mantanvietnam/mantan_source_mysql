<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Hướng dẫn tích hợp API lưu thông tin khách hàng theo chiến dịch</h4>

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">API lưu thông tin khách hàng</h5>
    <div class="card-body row">
      <div class="col-12">
        Link API: <?php global $urlHomes;echo $urlHomes.'apis/addCustomerCampainApi';?><br/>
        <b>Tham số gửi lên dạng POST</b><br/><br/>
        <b>BẮT BUỘC GỬI</b><br/>
        <b>name</b> : Họ tên khách hàng<br/>
        <b>phone</b> : Số điện thoại khách hàng<br/>
        <b>id_campain</b> : ID chiến dịch<br/>
        <b>id_spa</b> : ID spa chăm sóc khách hàng (ID của bạn là <?php echo $session->read('id_spa');?>)<br/>
        <b>email</b> : Email khách hàng<br/>
        <b>id_group</b> : ID nhóm khách hàng<br/>
        <b>id_member</b> : ID tài khoản của bạn (ID của bạn là <?php echo $session->read('infoUser')->id_member;?>)<br/><br/>

        <b>KHÔNG BẮT BUỘC GỬI</b><br/>
        <b>address</b> : Địa chỉ khách hàng<br/>
        <b>sex</b> : Giới tính khách hàng, 1 là nam, 0 là nữ<br/>
        <b>avatar</b> : Link ảnh đại diện của khách hàng<br/>
        <b>birthday</b> : Ngày sinh nhật của khách hàng, dạng ngày/tháng/năm, ví dụ 17/09/1989<br/>
        <b>cmnd</b> : Số chứng minh thư hoặc căn cước công dân của khách hàng<br/>
        <b>link_facebook</b> : Link facebook của khách hàng<br/>
        <b>source</b> : ID nguồn khách hàng<br/>
        <b>id_service</b> : ID dịch vụ khách hàng sử dụng<br/>
        <b>id_product</b> : ID sản phẩm khách sử dụng<br/>
        <b>medical_history</b> : Tiền sử bệnh lý của khách hàng<br/>
        <b>drug_allergy_history</b> : Tiền sử mang thai, dị ứng thuốc<br/>
        <b>request_current</b> : Nhu cầu hiện tại của khách hàng<br/>
        <b>advisory</b> : Khả năng tư vấn hướng dẫn<br/>
        <b>advise_towards</b> : Khả năng tư vấn hướng tới<br/>
        <b>job</b> : Nghề nghiệp, công việc của khách hàng<br/>
        <b>referral_code</b> : Số điện thoại người giới thiệu<br/>
        <b>hiddenMessages</b> : Ẩn nội dung thông báo trả về, 1 là ẩn, 0 là hiện<br/>
      </div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>
<?php include(__DIR__.'/../footer.php'); ?>