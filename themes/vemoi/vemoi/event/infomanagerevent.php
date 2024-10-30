<?php 
    getHeader();
    global $settingThemes;

?>
 <div class="body">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">thông tin người tham gia</h4>
                    <?=$mess?>
                    <form method="POST" action="">
                        <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                        <div class="mb-3">

                            <label for="change-password" class="form-label">Tên</label>
                            <input style="background-color:red" type="text" name="name" class="form-control" id="name" placeholder="Tên" value="<?php echo @$data->name;?>" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="change-password" class="form-label">email</label>
                            <input style="background-color:red" type="text" name="email" class="form-control" id="email" placeholder="email" value="<?php echo @$data->email;?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="change-password" class="form-label">Giới tính</label>
                            <input style="background-color:red" type="text" name="sex" class="form-control" id="sex" placeholder="Giới tính" value="<?php echo @$data->sex;?>" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="change-password" class="form-label">date</label>
                            <input style="background-color:red" type="date-local" name="date" class="form-control" id="date" placeholder="date" value="<?php echo date('H:i d/m/Y', $data->date);?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="change-password" class="form-label">city</label>
                            <input style="background-color:red" type="text" name="city" class="form-control" id="city" placeholder="city" value="<?php echo @$data->city;?>" readonly>
                        </div>
               
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php getFooter();?>