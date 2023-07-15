<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">ĐÁNH GIÁ SẢN PHẨM DỊCH VỤ</h4>
  
  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Hướng dẫn tích hợp API</h5>
    <div class="row table-responsive">
      <div class="col-12">
        <div class="card-body">
          <p class="text-danger">API lưu đánh giá của khách hàng</p>
          <p>Link api: https://domain/apis/saveFeedbackAPI</p>
          
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

          <p><b>id_product</b>: ID sản phẩm dịch vụ được đánh giá</p>
          <p><b>note</b>: Lời nhắn của khách hàng</p>
          <p><b>point</b>: Chuỗi json lưu kết quả đánh giá theo từng tiêu chí, cú pháp mẫu:</p>
          <p>[[1:6], [2:8]]</p>

          <p class="text-danger">Dữ liệu gửi đi</p>
          <p><b>id_customer</b>: ID khách hàng</p>
        </div>
      </div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>