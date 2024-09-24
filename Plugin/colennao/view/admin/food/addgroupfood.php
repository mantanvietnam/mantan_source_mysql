<!-- Helpers -->
<?php

$months = [
  1  => 'January',
  2  => 'February',
  3  => 'March',
  4  => 'April',
  5  => 'May',
  6  => 'June',
  7  => 'July',
  8  => 'August',
  9  => 'September',
  10 => 'October',
  11 => 'November',
  12 => 'December'
];
$selectedMonth = @$data->month;
?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-food-listgroupfood">danh sách food</a> /</span>
    Thông tin food
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin food</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên food (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Month</label>
                      <select class="form-control" name="month" id="month" required>
                          <option value="" disabled selected>Please select a month</option>
                          <?php foreach ($months as $number => $name): ?>
                              <option value="<?= $number ?>" <?= ($number == $selectedMonth) ? 'selected' : '' ?>>
                                  <?= $name ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Ảnh minh họa</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>

                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>