<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">2TOP CRM - ĐÀO TẠO</h4>
  
  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Hướng dẫn tích hợp API</h5>
    <div class="row table-responsive">
      <div class="col-12">
        <div class="card-body">
          <p class="text-danger">API lưu khách hàng</p>
          <p>Link api: https://domain/apis/saveCustomerAPI</p>
          
          <p class="text-danger">Dữ liệu gửi đi</p>
          <p><b>phone</b>: Số điện thoại</p>
          <p><b>sex</b>: Giới tính (1 hoặc 0, male hoặc female)</p>
          <p><b>id_city</b>: ID thành phố</p>
          <p><b>status</b>: Trạng thái (active hoặc lock)</p>
          <p><b>pass</b>: Mật khẩu, mặc định là số điện thoại</p>
          <p><b>id_parent</b>: ID tài khoản cha (cấp trên)</p>
          <p><b>id_level</b>: ID hạng tài khoản</p>
          <p><b>full_name</b>: Họ tên</p>
          <p><b>birthday</b>: Ngày sinh (dạng ngày/tháng/năm, ví dụ: 17/09/1989)</p>
          <p><b>email</b>: Địa chỉ email</p>
          <p><b>address</b>: Địa chỉ</p>
          <p><b>id_messenger</b>: ID messenger</p>
          <p><b>avatar</b>: Link ảnh đại diện</p>

          <p class="text-danger">Dữ liệu nhận về</p>
          <p><b>id_customer</b>: ID khách hàng</p>

          <p class="text-danger">API làm bài thi trắc nghiệm</p>
          <p>Link api: https://domain/test/?id={{id_test}}&idMessenger={{messenger user id}}&id_customer={{id_customer}}</p>

          <p class="text-danger">Dữ liệu gửi đi</p>
          <p><b>id_test</b>: ID bài kiểm tra</p>
          <p><b>idMessenger</b>: ID messenger của người thi</p>
          <p><b>id_customer</b>: ID của người thi trong hệ thống CRM</p>
          <p><b>Chú ý: </b> vào <a href="/plugins/admin/2top_crm_training-view-admin-setting-settingTrainingCRM.php">đây</a> để cài đặt bot trước</p>

          <p class="text-danger">Dữ liệu nhận về</p>
          <p><b>point_true</b>: số câu trả lời đúng</p>
          <p><b>point_total</b>: tổng số câu hỏi</p>
          <p><b>point</b>: điểm đạt được</p>

        </div>
      </div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>