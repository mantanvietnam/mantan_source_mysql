<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt Payos</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="card mb-4">
    <div class="card-body row">
        <div class="mb-3 col-md-6">
          <label class="form-label">Client ID(*)</label>
          <input type="text" class="form-control phone-mask" name="client_id" id="client_id" value="<?php echo @$setting['client_id'];?>"/>
        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label">Api Key</label>
          <input type="text" class="form-control phone-mask" name="api_key" id="api_key" value="<?php echo @$setting['api_key'];?>"/>
        </div>

       <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-phones">Checksum Key</label>
        <input type="text" class="form-control phone-mask" name="checksum_key" id="checksum_key" value="<?php echo @$setting['checksum_key'];?>"/>
      </div>
       <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-phones">Ngân hàng </label>
        <select class="form-select" name="code_bank" id="code_bank">
          <option value="">Chọn ngân hàng</option>
          <?php
          foreach($listBank as $key => $item){
            $selected = '';
            if(@$setting['code_bank']==$item['code']){ 
              $selected = 'selected';
            }
            echo'<option value="'.$item['code'].'" '.$selected.' >'.$item['name'].' ('.$item['code'].')</option>';
          } ?>
        </select>
      </div>
      
      <div class="mb-3 col-md-12">
         <p onclick="copyToClipboard('contentPay','mess')">link webhook: <b id="contentPay"><?php echo $setting['linkwebhok'] ?></b> <i class='bx bx-copy' ></i><span id="mess" style="color: red;"></span></p>
          
      </div>
    <div class="mb-3 col-md-12">
      <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
    </div>
  </div>



</div>
<?= $this->Form->end() ?>
</div>
<script type="text/javascript">
  function copyToClipboard(idCopy,messId) {
    var textCopy = $('#'+idCopy).html();
    textCopy = textCopy.replace(/(<([^>]+)>)/ig,"");
    // Create a "hidden" input
    var aux = document.createElement("input");

    // Assign it the value of the specified element
    aux.setAttribute("value", textCopy);

    // Append it to the body
    document.body.appendChild(aux);

    // Highlight its content
    aux.select();

    // Copy the highlighted text
    document.execCommand("copy");

    // Remove it from the body
    document.body.removeChild(aux);

    // show mess
    $('#'+messId).html('Đã sao chép');

    setInterval(emptyMess, 3000,messId);

}
</script>
