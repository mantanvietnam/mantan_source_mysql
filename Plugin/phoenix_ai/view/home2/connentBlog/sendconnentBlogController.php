<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    AI Clip
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">AI Viết 10 bài viết đăng Facebook</h5>
          </div>

          <div class="card-body">
            <p>Viết 10 bài viết đăng Facebook</p>
              <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">chủ đề viết nội dung sản phẩm</label>
                    <input type="text" name="topic" value="<?php echo @$dataSend['topic']; ?>"  class="form-control" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Đối tượng khách hàng của tôi là</label>
                    <input type="text" name="customer_target" value="<?php echo @$dataSend['customer_target']; ?>"  class="form-control">
                    <input type="hidden" name="conversation_id" value="<?php echo @$reply_ai['conversation_id']; ?>"  class="form-control">
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Cảm xúc</label>
                    <input type="text" name="feeling" value="<?php echo @$dataSend['feeling']; ?>"  class="form-control" >
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">nhấn mạnh những lợi ích của sản phẩm dịch vụ</label>
                    <input type="text" name="benefit" value="<?php echo @$dataSend['benefit']; ?>"  class="form-control" >
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label"> Kết thúc với một </label>
                    <input type="text" name="end" value="<?php echo @$dataSend['end']; ?>"  class="form-control" >
                  </div>
                </div>  
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">chát </label>
                    <input type="text" name="chat" value="<?php echo @$dataSend['chat']; ?>"  class="form-control" >
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Thực hiện</button>
            </form>
            <?php if(!empty($reply_ai['result'])){
              echo '<div> <p>AI trả lời</p>
                  <p>'.nl2br($reply_ai['result']).'</p>
              </div>';
            } ?>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>