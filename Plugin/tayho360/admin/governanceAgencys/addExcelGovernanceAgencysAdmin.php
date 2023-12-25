<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin">Cơ quan hành chính</a> /</span>
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
            <h5 class="mb-0">Thông tin cơ quan hành chính</h5>
          </div>
          <div class="card-body">
            <?php echo @$mess;?>
            <p>Link tải file excel mẫu: <a href="https://tayho360.vn/plugins/tayho360/admin/governanceAgencys/Governance_Agencys.xlsx">https://tayho360.vn/plugins/tayho360/admin/governanceAgencys/Governance_Agencys.xlsx</a> </p>
            <?= $this->Form->create(); ?>
            <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control" name="content" rows="15"></textarea>
                </div>
                <button style=" margin: 10px; width: 80px;" type="submit" class="btn btn-primary">Lưu</button>
            </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>