<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/feedback-view-admin-listFeedbackAdmin">Feedback</a> /</span>
    <?php 
     if(!empty($_GET['id'])){
        echo "Sửa thông tin";

    }else{
       echo "Thêm mới";
    }

     ?>
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Liên kêt</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;
        ?></p>
            <?= $this->Form->create(); ?>
             <div class="row" >
            
            <div class="mb-3 form-group col-sm-6">
                <i>Họ tên<span class="required">*</span></i>
                <input type="text" maxlength="100" name="full_name" id="full_name" value="<?php echo @$data['full_name'] ?>" class="form-control" required="">
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Link liên kết</i>
                <input type="text" maxlength="100" name="link" id="link" value="<?php echo @$data['link'] ?>" class="form-control" >
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Ảnh đại diện<span class="required">*</span></i>
                <br>
                <?php
                if (!empty($data['avatar'])) {
                    $avatar = $data['avatar'];
                } else {
                    $avatar = '';
                }

                showUploadFile('avatar', 'avatar', $avatar);
                ?>
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Chức danh</i>
                <input type="text" maxlength="100" name="position" id="position" value="<?php echo @$data['position'] ?>" class="form-control" >
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Nội dung phản hồi</i>
                <textarea name="content" id="content" onkeyup="" class="form-control" rows="5"><?php echo @$data['content'] ?></textarea>                                                                  
            </div>
        </div>
            <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>