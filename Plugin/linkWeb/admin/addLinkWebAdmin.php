<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/linkWeb-admin-listLinkWebAdmin.php">Liên kêt</a> /</span>
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
                <i>Nhóm liên kết<span class="required">*</span>:</i>
                <select id="idward" class="form-select" required="" name="idCategory" >
                <?php foreach(@$listLinkwebcategory as $item) { 
                    if(@$data['idCategory']==@$item->id){
                    ?>
                     <option selected="" value="<?php echo @$item->id; ?>"><?php echo @$item->name; ?></option>     
                     <?php }else{ ?>  

                     <option value="<?php echo @$item->id; ?>"><?php echo @$item->name; ?></option>     
                     <?php }}?>     
                </select>
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Tiêu đề liên kết<span class="required">*</span>:</i>
                <input type="text" maxlength="100" name="name" id="name" value="<?php echo @$data['name'] ?>" class="form-control" required="">
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Link liên kết<span class="required">*</span>:</i>
                <input type="text" maxlength="100" name="link" id="name" value="<?php echo @$data['link'] ?>" class="form-control" required="">
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Ảnh đại diện</i>
                <br>
                <?php
                if (!empty($data['image'])) {
                    $image = $data['image'];
                } else {
                    $image = '';
                }

                showUploadFile('image', 'image', $image);
                ?>
            </div>
        </div>
            <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>