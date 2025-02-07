<?php include(__DIR__.'/../header.php'); ?>
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="content-header">
                <h1>Cài đặt tài khoản</h1>
                <?php include(__DIR__.'/../infoUser.php'); ?>
            </div>

            <!-- Account Settings Card -->
            <div class="settings-card">
                <div class="card-header">
                    <h2>Thông tin tài khoản của bạn</h2>
                    <p>Những thông tin dưới đây sẽ hiển thị trên trang của bạn</p>
                </div>
                 <form class="settings-form"  method="post" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="functions.submitForgot(); return false;">

                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                <div class="profile-photo m_bg_img">
                    <img id="anhaa" src="<?php echo $user->avatar ?>" alt="Profile photo" class="profile-img">
                    <div class="photo-actions">
                        <input type="file" name="avatar" onchange="readURL1(this);" />
                           <span class="btn btn-outline"><i class="fa-solid fa-camera"></i>
                            Tải ảnh mới </span>
                        
                       <!--   <button class="btn btn-outline">
                            <i class="fa-regular fa-trash-can"></i>
                            Xóa ảnh
                        </button>  -->
                    </div>
                </div>
                <!-- Form -->
               
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Họ và tên </label>
                            <input type="text" class="form-control"  name="full_name"  value="<?php echo $user->full_name ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Gới  tính </label>
                              <select class="form-select form-control" name="sex" id="sex">                        
                                <option value="2" <?php if(isset($data->sex) && $user->sex=='2') echo 'selected'; ?> >Nữ</option>
                                <option value="1" <?php if(!empty($data->sex) && $user->sex=='1') echo 'selected'; ?> >Nam</option>
                              </select>
                        </div>
                    </div>

                    <!--< div class="mb-3">
                        <label>Tên tài khoản</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="@penguinday224">
                            <button class="btn btn-outline" type="button">Thay đổi</button>
                        </div>
                    </div> -->

                    <div class="mb-3">
                        <label>Địa chỉ Email</label>
                        <input type="email" class="form-control"  name="email"  value="<?php echo $user->email ?>">
                    </div>

                    <div class="mb-4">
                        <label>địa chỉ </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="address" value="<?php echo $user->address ?>">
                            <button class="btn btn-outline" type="subimt">Thay đổi</button>
                        </div>
                    </div>

                    <!-- Delete Account Section -->
                    <div class="delete-account">
                        <h3>Vô hiệu hóa tài khoản</h3>
                        <p>Xóa vĩnh viễn tài khoản của bạn và tất cả dữ liệu liên quan. Hành động này không thể hoàn tác
                        </p>
                        <button type="button" class="btn btn-danger">Xóa tài khoản của tôi</button>
                    </div>
                </form>
            </div>
        </div>
 <script>
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#anhaa').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
             console.log(reader);
        }
    }
</script>
<style>

    input[type=file] {
      /* display: block; */
    filter: alpha(opacity = 0);
    /* height: 100%; */
    width: 111px;
    opacity: 0;
    position: absolute;
    /* right: 0; */
    /* text-align: right; */
    /* top: 0; */
    /* cursor: pointer; */
    /* z-index: 5; */
}
    }
</style> 

<?php include(__DIR__.'/../footer.php'); ?>