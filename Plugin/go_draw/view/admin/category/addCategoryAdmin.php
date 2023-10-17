<div class="col-xl">
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin</h5>
        </div>
        <div class="card-body">
            <?= $this->Form->create(); ?>
            <input type="hidden" name="idCategoryEdit" id="idCategoryEdit" value="" />
            <div class="mb-3">
                <label class="form-label" for="basic-default-phone">Tên chủ đề</label>
                <input
                    type="text"
                    class="form-control phone-mask"
                    name="name"
                    id="name"
                    value=""
                />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Hình minh họa</label>
                <?php showUploadFile('image','image','',0);?>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Từ khóa</label>
                <input type="text" class="form-control" placeholder="" name="keyword" id="keyword" value="" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Mô tả</label>
                <input type="text" class="form-control" placeholder="" name="description" id="description" value="" />
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>