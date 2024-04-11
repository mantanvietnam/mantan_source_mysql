<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomerAgency">Khách hàng</a> /</span>
    Hướng dẫn tích hợp API
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Lưu thông tin khách hàng qua API</h5>
          </div>
          <div class="card-body">
            <p><b>Link API:</b> <a href="<?php echo $urlHomes.'apis/saveInfoCustomerAPI';?>"><?php echo $urlHomes.'apis/saveInfoCustomerAPI';?></a></p>
            <p><b>Kiểu gửi:</b> POST</p>
            <br/>

            <p><b>Tham số truyền đi:</b></p>
            <p>id_member: ID đại lý quản lý khách hàng (ID của bạn là <?php echo $session->read('infoUser')->id;?>)</p>
            <p>full_name: họ tên khách hàng</p>
            <p>phone: số điện thoại khách hàng</p>
            <p>email: email khách hàng (không bắt buộc)</p>
            <p>avatar: link ảnh đại diện của khách hàng</p>
            <p>id_messenger: ID messenger (không bắt buộc)</p>
            <p>id_group: ID nhóm khách hàng (không bắt buộc)</p>
            <p>sex: giới tính, 1 là nam, 0 là nữ (không bắt buộc)</p>
            <p>facebook: link facebook khách hàng (không bắt buộc)</p>
            <p>birthday_date: ngày sinh (không bắt buộc)</p>
            <p>birthday_month: tháng sinh (không bắt buộc)</p>
            <p>birthday_year: năm sinh (không bắt buộc)</p>
            <p>address: địa chỉ khách hàng (không bắt buộc)</p>
            <br/>

            <p><b>Gửi theo dạng raw khi dùng chatbot Zalo</b></p>
            {<br/>
                "id_member": "<?php echo $session->read('infoUser')->id;?>",<br/>
                "full_name": "Trần Mạnh",<br/>
                "phone": "0816560000",<br/>
                "email": "tranmanhbk179@gmail.com",<br/>
                "id_messenger": "1232836292",<br/>
                "avatar": "https://s3.smax.in/pages/fb100405719654447/fb23940862368832418.jpg",<br/>
                "id_group": "1",<br/>
                "birthday": "17/9/1989",<br/>
                "address": "18 Thanh Bình, HN",<br/>
                "chatbot": "zalo"<br/>
            }
            <br/><br/>

            <p><b>Tham số nhận về:</b></p>
            <p>code: mã xác nhận lưu dữ liệu và tạo mã dự thưởng, 1 là thành công, 0 là thất bại</p>
            <p>messages: thông báo của hệ thống</p>
            <p>id_customer: mã ID của khách hàng</p><br/><br/>
            
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>