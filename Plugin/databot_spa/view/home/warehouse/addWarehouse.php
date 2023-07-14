<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProduct">Kho </a> /</span>
    Thông tin kho 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin kho</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên kho (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>"/>
                  </div>
                  
                  <div class="mb-3 " style="height: 68px;">
                    <label class="form-label">Trạng thái:</label><br/>
                      <input type="radio" name="credit" class="" id="credit" value="1" <?php if(@ $data['credit']==1) echo 'checked="checked"';   ?> > cho bán âm&ensp;
                      <input type="radio" name="credit" class="" id="credit" value="0" <?php if(@ $data['credit']==0) echo 'checked="checked"';   ?> > không cho bán âm
                  </div>
                </div>
                <div class="col-md-6">
                
                  <div class="mb-3">
                    <label class="form-label">Mô tả </label>
                    <textarea class="form-control phone-mask" rows="5" name="description"><?php echo @$data->description;?></textarea>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>