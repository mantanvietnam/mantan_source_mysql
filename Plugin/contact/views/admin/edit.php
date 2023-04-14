<?php
if (!isset($data)) $data = [];
if (!isset($routesPlugin)) $routesPlugin = [];
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit sinh viên</h4>

    <div class="card">
        <div class="card-body">
            <p></p>
            <form method="post" accept-charset="utf-8" action="<?= $routesPlugin["student"]['update'] ?>">
                <div style="display:none;">
                    <input type="hidden" name="_csrfToken" autocomplete="off"
                           value="SWobuAJgIGtzkaHqGnfZeLzr0FfmpGQYfGQwGsnOAlx1Y5bKHDT9r9x+pt3nLfXbCY18fHj9S5t5bLkJ0hGoyaOD0ksPATdv393kM9acXSFNUVR7/qtmZUEAo6stAZifuByS6IEfx+kw6R4eSM1/ow==">
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="id" value="<?= $data->id ?>">
                        <div class="mb-3 col-12 col-sm-12 col-md-12">
                            <label class="form-label">Tên</label>
                            <input type="text" class="form-control" name="name" value="<?= $data->name ?>" required="">
                        </div>
                        <div class="mb-3 col-12 col-sm-12 col-md-12">
                            <label class="form-label">Tuổi</label>
                            <input type="number" class="form-control" name="age" value="<?= $data->age ?>">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update thông tin</button>
            </form>
        </div>
    </div>

</div>
