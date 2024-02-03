<?php
getHeader();
global $urlThemeActive;
global $session;
$setting = setting();

$slide_home= slide_home($setting['id_slide']);
global $session;
$infoUser = $session->read('infoUser');
   	
?>
 <main>
    <form action="" method="post">
        <section id="section-payment">
            <div class="container">
                <h3>Thanh toán</h3>
                <div class="row">
                    <div class="col-lg-7 col-12">

                        <div class="info-customer">
                            <h4>
                                Thông tin thanh toán
                            </h4>
                            <div class="form">
                                <label for="">Họ và tên *
                                    <input type="text" name="full_name" required>
                                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                </label>
                                <div>
                                    <label for="">Số điện thoại *
                                        <input type="tel" name="phone"  required>
                                    </label>
                                    <label for="">Địa chỉ email *
                                        <input type="email" name="email" required>
                                    </label>
                                </div>
                                <!-- <label for="">Tỉnh / thành phố *
                                    <select name="city" required>
                                        <option value="city1">Hà Nội</option>
                                        <option value="city2">TP. Hồ Chí Minh</option>
                                        <option value="city3">Đà Nẵng</option>
                                        <option value="city4">Hải Phòng</option>
                                    </select>
                                </label>
                                <div>
                                    <label for="">Quận / huyện *
                                        <select name="district" required>
                                            <option value="district1">Hà Nội</option>
                                            <option value="district2">TP. Hồ Chí Minh</option>
                                            <option value="district3">Đà Nẵng</option>
                                            <option value="district4">Hải Phòng</option>
                                        </select>
                                    </label>

                                    <label for="">Phường / xã *
                                        <select name="ward" required>
                                            <option value="ward1">Hà Nội</option>
                                            <option value="ward2">TP. Hồ Chí Minh</option>
                                            <option value="ward3">Đà Nẵng</option>
                                            <option value="ward4">Hải Phòng</option>
                                        </select>
                                    </label>
                                </div> -->
                                <label for="">Địa chỉ *
                                    <input type="text" name="address" required>
                                </label>
                                <label for="">Ghi chú đơn hàng (tuỳ chọn)
                                    <textarea name="note_user" id="" cols="30" rows="4" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn.">

                                    </textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="your-order">
                            <div class="money">
                                <h3>ĐƠN HÀNG CỦA BẠN</h3>
                                <div class="money-of-produce">
                                    <?php foreach($list_product as $item){
                                    if(@$item->statuscart=='true'){
                                 ?>
                                    <div class="item-produce">
                                        <div class="produce-name">
                                            <?php echo $item->title ?> <span><i class="fa-solid fa-xmark"></i><?php echo $item->numberOrder ?></span>
                                        </div>
                                        <div class="produce-price">
                                            <?php echo number_format($item->price*$item->numberOrder); ?> đ
                                        </div>
                                    </div>
                                    <?php }} ?>
                                    

                                    <div class="produce-total">
                                        <div class="total">
                                            <p>Tổng:</p><span><?php echo number_format($pay['total']); ?> đ</span>
                                        </div>
                                    </div>


                                    <div class="payment-methods">
                                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">

                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                        <input type="radio" name="payment" value="1" checked="checked" placeholder="Server" aria-label="Server">Chuyển khoản ngân hàng
                                                </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                                    <div class="accordion-body">
                                                        <p>Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng Mã đơn hàng của bạn trong phần Nội dung thanh toán. Đơn hàng sẽ đươc giao sau khi tiền đã chuyển.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                                       <input type="radio" name="payment" value="2" checked="checked" placeholder="Server" aria-label="Server">Trả tiền mặt khi nhận hàng
                                                </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <p>Trả tiền mặt khi giao hàng</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="produce-total">
                                        <button class="payment-btn">Tiến hành thanh toán</button>
                                        <p>Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, tăng trải nghiệm sử dụng website, và cho các mục đích cụ thể khác đã được mô tả trong chính sách riêng tư của chúng tôi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    </main>

     <script>
        // Sự kiện xảy ra khi người dùng nhấn nút "Back"
        window.addEventListener('popstate', function(event) {
            // Tải lại trang
            location.reload();
        });
    </script>


 <script>
        // Use the replaceState method to replace the current history entry
        history.replaceState(null, document.title, location.href);

        // Add a popstate event listener
        window.addEventListener('popstate', function(event) {
            // Restore the current state by pushing a new state
            history.pushState(null, document.title, location.href);
        });
    </script>
<script type="text/javascript">
    // tìm khách hàng 
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#address" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_customer').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchAddress", {
                    key: extractLast( request.term )
                }, response );
            },
            search: function() {
                // custom minLength
                var term = extractLast( this.value );
                if ( term.length < 2 ) {
                    return false;
                }
               
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );

                console.log(ui.item);
               
                $('#address').val(ui.item.label);
                $('#id_customer').val(ui.item.id);
          
                return false;

                tinhtien();

            }
        });
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>  
<?php
getFooter();?>