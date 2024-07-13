<style type="text/css">
  
.filter-color .checkbox-list li {
  margin: 0 14px 15px 0;
  line-height: normal;
  float: left;
  padding: 0; }

.filter-color .checkbox-list li label {
  border: 1px solid #eaeaea;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  float: left;
  position: relative;
  font-size: 0;
  margin-left: 0;
  margin-bottom: 0; }

  .filter-color .checkbox-list{
    list-style-type: none;
  }

.filter-color .checkbox-list input[type="radio"] {
  display: none; }

.filter-color .checkbox-list input[type="radio"]:checked + label:before {
  content: '';
  position: absolute;a
  top: 10px;
  left: 8px;
  height: 6px;
  width: 12px;
  z-index: 99;
  border: 2px solid #dead35;
  border-top-style: none;
  border-right-style: none;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg); }

.filter-color .checkbox-list input[type="radio"]:checked + label {
  box-shadow: 0 0 0 3px #ffffff, 0 0 0 4px var(--shop-color-border); }

</style>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin">Mẫu thiết kế</a> /</span>
    Tặng mẫu thiết kế 
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin mẫu thiết kế</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên mẫu thiết kế: </label>  <?php echo @$data->name; ?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Số điện thoại được tặng: </label>  
                     <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="" />
                  </div>
                  <div class="mb-3">
                   <button type="submit" class="btn btn-primary">Tặng</button>

                 </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Hình minh họa</label>

                    <img src="<?php echo @$data->thumn; ?>" style="width:100%;height: auto;"> 
                  </div>

                  

                <!-- <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Bài đăng mẫu kèm hình ảnh </label><br>
                    <?php
                        //showEditorInput('content','content',@$data['content'],0);
                    ?>                      
                    <textarea class="form-control" name="content" rows="5"><?php echo @$data->content; ?></textarea>
                  </div>
                </div> -->
              </div>

             
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

