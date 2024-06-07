<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
      <a href="/list<?php echo $slug ?>"><?php echo $title ?></a> / <a href="/list<?php echo $slug ?>info?id_document=<?php echo $info->id; ?>"><?php echo $info->title ?></a> / Thông tin <?php echo $title ?>
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <p><?php echo @$mess;?></p>
          <?= $this->Form->create(); ?>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6">
                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Tiêu đề *</label>
                  <input type="text" class="form-control" name="title" value="<?php echo @$data->title;?>" required />
                </div>
                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label"><?php echo $title ?> *</label>
                  <?php showUploadFile('file','file',@$data->file,0);?>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-message">Mô tả ngắn</label>
                  <textarea class="form-control" name="description" rows="5"><?php echo @$data->description;?></textarea>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include(__DIR__.'/../footer.php'); ?>