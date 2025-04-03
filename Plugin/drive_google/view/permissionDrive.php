<div class="container-xxl flex-grow-1 container-p-y">
  	<h4 class="fw-bold py-3 mb-4">Cài đặt cấp quyền </h4>

  	<!-- Responsive Table -->
  	<div class="card row">
    	<div class="col-12">
    		<div class="card-body">
    			<h5 class="card-header">Thông tin token</h5>
            	<p><?php echo @$mess;?></p>
            	<?php
					if(!empty($token['access_token'])){
						$deadline = $token['created']+$token['expires_in'];
					}

					if(!empty($data['clientIdDrive']) && !empty($data['clientSecretDrive'])){
						echo '<div class="text-center mt-5 mb-5 row">'.showButtonPermissionDrive().'</div>';
					}
				?>
            	<?= $this->Form->create(); ?>
             		<div class="row" >
			            <div class="mb-3 form-group col-sm-6">
			                <i>Token</i>
			                <input disabled type="text" name="access_token" id="access_token" value="<?php echo @$token['access_token']; ?>" class="form-control" />
			            </div>

			            <div class="mb-3 form-group col-sm-6">
			                <i>Hết hạn lúc</i>
			                <input disabled type="text" name="deadline" id="deadline" value="<?php echo @date('H:i:s d/m/Y', $deadline) ?>" class="form-control" >
			            </div>

			            <div class="mb-3 form-group col-sm-6">
			                <i>Client ID Drive (*)</i>
			                <input required type="text" name="clientIdDrive" id="clientIdDrive" value="<?php echo @$data['clientIdDrive']; ?>" class="form-control"  >
			            </div>
			            <div class="mb-3 form-group col-sm-6">
			                <i>Client Secret Drive (*)</i>
			                <input required type="text" name="clientSecretDrive" id="clientSecretDrive" value="<?php echo @$data['clientSecretDrive']; ?>" class="form-control" >
			            </div>
			            <div class="mb-3 form-group col-sm-6">
			                <i>ID Excel lưu đơn hàng</i>
			                <input type="text" name="spreadsheetIdOrder" id="spreadsheetIdOrder" value="<?php echo @$data['spreadsheetIdOrder']; ?>" class="form-control" >
			            </div>
        			</div>
            		<button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
            	<?= $this->Form->end() ?>
          	</div>
		</div>
  	</div>
</div>