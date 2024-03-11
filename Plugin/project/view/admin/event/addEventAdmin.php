<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/project-view-admin-event-listEventAdmin">Event</a> /</span>
    Thông tin Event
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Event</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Title Event(*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="title" value='<?php echo @$data->name;?>' />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Thời gian Event *</label>
                    <input type="text" class="form-control datepicker" name="time_create" value='<?php if(empty($data->time_create)) $data->time_create = time();echo date('d/m/Y', $data->time_create);?>' required />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">tháng (*)</label>
                    <input required type="number" class="form-control phone-mask" name="moth" id="moth" value='<?php echo @$data->moth;?>' />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">năm (*)</label>
                    <input required type="number" class="form-control phone-mask" name="year" id="year" value='<?php echo @$data->year;?>' />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="content" id="content"><?php echo @$data->content;?></textarea>
                  </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>
<script>
    $(function(){
      $( ".datepicker" ).datepicker({
        dateFormat: "dd/mm/yy"
      });
    } );
</script>