<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cài đặt phí sàn</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <p><?php echo @$mess;?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="service-fee">Phí sàn</label>
                                <input class="form-control" required type="text" id="service-fee" name="service-fee" value="<?php echo $serviceFee ?? 0; ?> ">
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
