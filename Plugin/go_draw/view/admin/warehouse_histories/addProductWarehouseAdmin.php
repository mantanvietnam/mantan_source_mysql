<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-warehouse_histories-historyProductWarehouseAdmin">Lịch sử nhập kho</a> /</span>
        Phiếu nhập kho
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Phiếu nhập kho</h5>
                </div>
                <div class="card-body">
                    <p><?php echo $mess;?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sản phẩm nhập kho (*)</label>
                                    <select required class="form-select color-dropdown" name="product_id">
                                        <option value="">Chọn sản phẩm</option>

                                        <?php 
                                        if(!empty($list_product)){
                                            foreach ($list_product as $key => $value) {
                                                if(empty($_GET['product_id']) || $_GET['product_id']!=$value->id){
                                                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                                                }else{
                                                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Số lượng nhập kho (*)</label>
                                    <input type="text" class="form-control phone-mask" name="amount" id="amount" value="<?php echo @$data->amount;?>" required />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tổng tiền nhập (*)</label>
                                    <input type="text" class="form-control phone-mask" name="total_price" id="total_price" value="<?php echo @$data->total_price;?>" required />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ghi chú nhập hàng</label>
                                    <textarea class="form-control phone-mask" name="note"><?php echo @$data->note;?></textarea>
                                </div>
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