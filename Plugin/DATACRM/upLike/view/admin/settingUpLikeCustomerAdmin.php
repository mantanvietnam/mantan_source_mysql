<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/upLike-view-admin-settingUpLikeAdmin">Tăng tương tác khách hàng </a> /</span>
    Cài đặt
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                  <label class="form-label" for="basic-default-phone">chọn kênk like page </label>
                   <select name="chanel" id="chanel" class="form-select color-dropdown" required >
                <option data-price='' value="">Chọn kênh</option>
                <?php
                  if(!empty($listPrice['data']['facebook']['buff']['likepage'])){
                    foreach ($listPrice['data']['facebook']['buff']['likepage'] as $key => $value) {
                      $selected = '';
                      $price = ceil($value['rate']);
                      if($key==@$data['chanel']){
                        $selected = 'selected';
                      }
                      echo '<option data-price="'.$price.'" value="'.$key.'" title="'.$value['detail'].'" '.$selected.' >Kênh '.$key.' giá '.$price.'đ/like</option>';
                    }
                  }
                ?>
              </select>
                </div>

               <div class="col-md-6 mb-3">
                <label class="form-label">Bân tắt chương trình  like page</label>
                <select name="function_customerUpLikePage" class="form-select"  id="function_customerUpLikePage">
                  <option value="on" <?php if(@$data['function_customerUpLikePage']=='on') echo 'selected';?> >Bật</option>
                  <option value="off" <?php if(@$data['function_customerUpLikePage']=='off') echo 'selected';?> >Tắt</option>
                </select>
            </div>
              
            </div>

              
            <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>