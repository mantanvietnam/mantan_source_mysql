<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/2top_crm_compete-view-admin-report-listReportCRM.php">Báo cáo thi đua</a> /</span>
    Thông tin báo cáo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin báo cáo</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Thời gian báo cáo (*)</label>
                    <input required type="text" class="form-control datetimepicker" placeholder="" name="time_report" id="time_report" value="<?php if(!empty($data->time_report)) echo date('H:i d/m/Y', $data->time_report);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Chiến dịch thi đua (*)</label>
                    <select required class="form-select" name="id_compete" id="id_compete" onchange="showTarget();">
                        <option value="">Chọn chiến dịch</option>
                        <?php 
                        if(!empty($listCompete)){
                          foreach ($listCompete as $key => $item) {
                            if(empty($data->id_compete) || $data->id_compete!=$item->id){
                              echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                            }else{
                              echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mục tiêu thi đua (*)</label>
                    <select required class="form-select" name="id_target" id="id_target" onchange="chooseTarget();">
                        <option value="">Chọn mục tiêu</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Điểm thưởng (*)</label>
                    <input type="text" class="form-control" placeholder="" name="point" id="point" value="<?php echo @$data->point;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Người báo cáo (*)</label>
                    <select required class="form-select" name="id_customer" id="id_customer">
                      <option value="">Chọn người báo cáo</option>
                      <?php 
                      if(!empty($listCustomer)){
                        foreach ($listCustomer as $key => $item) {
                          if(empty($data->id_customer) || $data->id_customer!=$item->id){
                            echo '<option value="'.$item->id.'">'.$item->full_name.' ('.$item->phone.')</option>';
                          }else{
                            echo '<option selected value="'.$item->id.'">'.$item->full_name.' ('.$item->phone.')</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Hình ảnh báo cáo</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ghi chú</label>
                    <textarea class="form-control" placeholder="" name="note" id="note" rows="5"><?php echo @$data->note;?></textarea>
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

<script type="">
  var listCompete = [];

  <?php 
    if(!empty($listCompete)){
      foreach ($listCompete as $key => $item) {
        echo 'listCompete['.$item->id.'] = {};';

        if(!empty($item->targets)){
          foreach($item->targets as $target){
            echo 'listCompete['.$item->id.']['.$target->id.'] = [];';
            echo 'listCompete['.$item->id.']['.$target->id.'][0] = "'.$target->title.'";';
            echo 'listCompete['.$item->id.']['.$target->id.'][1] = "'.$target->point.'";';
          }
        }
      }
    }
  ?>

  function showTarget()
  {
    var idCompete = $('#id_compete').val();
    var chuoi = "<option value=''>Chọn mục tiêu</option>";

    if(idCompete!=''){
      var listTarget = listCompete[idCompete];

      Object.keys(listTarget).forEach(function(key) {
        chuoi += "<option data-point='"+listTarget[key][1]+"' value='" + key + "'>" + listTarget[key][0] + "</option>";
      });
    }

    $('#id_target').html(chuoi);
    $("#id_target").trigger("chosen:updated");
  }

  function chooseTarget()
  {
    var id_target = $('#id_target').val();
    var point = $('#id_target').find(':selected').data('point');
    $('#point').val(point);
  }

  var idCompeteOld = '<?php echo @$data->id_compete;?>';
  var idTargetOld = '<?php echo @$data->id_target;?>';

  if(idCompeteOld != ''){
    showTarget();
    $('#id_target').val(idTargetOld);
  }
</script>