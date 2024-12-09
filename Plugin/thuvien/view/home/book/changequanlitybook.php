<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/historybook">Lịch sử nhập/hủy sách</a></span>
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Hủy và nhập sách</h5>
          </div>

          <div class="card-body">
            <p><?php echo @$mess;?></p> 
            <form enctype="multipart/form-data" method="post" action="">
                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
                <input type="hidden" name="action" id="action_field" value="" />
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                        Thông tin nhập sách
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group col-sm-6">
                                                <i>Tên sách</i>
                                                <select name="id_book" id="id_book" class="form-control">
                                                    <option value="">Chọn tên sách</option>
                                                    <?php if (!empty($listbook)): ?>
                                                        <?php foreach ($listbook as $key => $value): ?>
                                                            <option value="<?php echo $value->id; ?>">
                                                                <?php echo $value->name; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3 col-sm-6">
                                                <label class="form-label" for="basic-default-fullname">Số lượng</label>
                                                <input type="number" autocomplete="off" class="form-control" placeholder="" name="quantity" value="" />
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                   
                        <button type="submit" class="btn btn-primary" onclick="setAction('add')">Thêm sách</button>
                    </div>
                    <div class="col-md-2">
                   
                        <button type="submit" class="btn btn-danger" onclick="setAction('remove')">Hủy sách</button>
                    </div>
                </div>
            </form>



          </div>
        </div>
      </div>

    </div>
</div>
<script>
    function setAction(action) {
   
        document.getElementById('action_field').value = action;
    }
</script>


<?php include(__DIR__.'/../footer.php'); ?>