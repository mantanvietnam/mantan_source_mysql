<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">
      <a href="/listCampain">Chiến dịch</a> /
    </span>
    Thông tin chiến dịch
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin chiến dịch</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Cài đặt chung
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-spin" aria-controls="navs-top-spin" aria-selected="false">
                          Quay số
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-ticket" aria-controls="navs-top-ticket" aria-selected="false">
                          Vé tham dự
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-address" aria-controls="navs-top-address" aria-selected="false">
                          Địa điểm
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-status" aria-controls="navs-top-status" aria-selected="false">
                          Trạng thái chăm sóc
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-checkin" aria-controls="navs-top-checkin" aria-selected="false">
                          Checkin
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tên chiến dịch (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Tự động gửi SMS khi đăng ký sự kiện</label>
                              <br/>
                              <input type="radio" class="" name="sendSMS" value="0" <?php if(empty($data->sendSMS)) echo 'checked';?> /> Không gửi
                              &nbsp;&nbsp;&nbsp;
                              <input type="radio" class="" name="sendSMS" value="1" <?php if(!empty($data->sendSMS) && $data->sendSMS==1) echo 'checked';?> /> Có gửi
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Tin nhắn gửi khi đăng ký</label>
                              <input type="text" class="form-control phone-mask" name="smsRegister" id="smsRegister" value="<?php echo @$data->smsRegister;?>" />
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Mô tả chiến dịch</label>
                              <textarea rows="5" class="form-control" name="note" id="note"><?php echo @$data->note;?></textarea>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="mb-3">
                              <b>Chú ý:</b>
                              <p>- Chỉ nhắn tin chăm sóc khách hàng, không nhắn tin spam, vi phạm sẽ bị khóa tài khoản vĩnh viễn. Hệ thống chỉ cho phép gửi tin nhắn tiếng việt không dấu.</p>
                              <p>- Mỗi tin nhắn dài tối đa 160 ký tự.</p>
                              <p>- Không dùng các ký tự nháy đơn, nháy kép, và (&). Có thể sử dụng các ký tự sau để thay thế cho thông tin của từng người dùng:</p>

                              <ul>
                                <li>%name% : họ tên khách hàng</li>
                                <li>%campaign% : tên chiến dịch khách đăng ký</li>
                                <li>%user_code% : mã đăng ký của người dùng</li>
                                <li>%rand% : mã ngẫu nhiên hệ thống tự tạo ra để giảm tỷ lệ spam</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-spin" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Mã bảo mật quay thưởng</label>
                              <input type="text" class="form-control phone-mask" name="codeSecurity" id="codeSecurity" value="<?php echo @$data->codeSecurity;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Người trúng thưởng là</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="typeUserWin" id="typeUserWin">
                                  <option value="">Người đăng ký tham gia</option>
                                  <option value="checkin" <?php if(!empty($data->typeUserWin) && $data->typeUserWin=='checkin') echo 'selected'; ?> >Người checkin tại sự kiện</option>
                                </select>
                              </div>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Số người trúng thưởng 1 lần quay</label>
                              <input type="text" class="form-control phone-mask" name="numberPersonWinSpin" id="numberPersonWinSpin" value="<?php echo @$data->numberPersonWinSpin;?>" />
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Ảnh nền chiến dịch</label>
                              <?php showUploadFile('backgroundSpin','backgroundSpin',@$data->backgroundSpin,0);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Ảnh logo chiến dịch</label>
                              <?php showUploadFile('logoSpin','logoSpin',@$data->logoSpin,1);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Màu chữ</label>
                              <input type="text" class="form-control phone-mask" name="colorTextSpin" id="colorTextSpin" value="<?php echo @$data->colorTextSpin;?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-ticket" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">ID bot</label>
                              <input type="text" class="form-control phone-mask" name="idBotBanking" id="idBotBanking" value="<?php echo @$data->idBotBanking;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Token bot</label>
                              <input type="text" class="form-control phone-mask" name="tokenBotBanking" id="tokenBotBanking" value="<?php echo @$data->tokenBotBanking;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">ID block báo giao dịch thành công</label>
                              <input type="text" class="form-control phone-mask" name="idBlockSuccessfulTransaction" id="idBlockSuccessfulTransaction" value="<?php echo @$data->idBlockSuccessfulTransaction;?>" />
                            </div>
                          </div>

                          
                          <?php
                          for ($i=1; $i <= 10; $i++) { 
                            echo '<div class="mb-3 col-md-6">
                                      <label class="col-sm-3 control-label">Loại vé '.$i.':</label>
                                      <div class="row">
                                        <div class="col-sm-8">
                                            <input name="nameTicket['.$i.']" class="form-control" placeholder="Tên loại vé" value="'.@$data->nameTicket[$i].'">
                                        </div>
                                        <div class="col-sm-4">
                                            <input name="priceTicket['.$i.']" class="form-control" placeholder="Giá vé" value="'.@$data->priceTicket[$i].'">
                                        </div>
                                      </div>
                                  </div>';
                          }
                          ?> 
                          
                        </div>
                      </div>
                      
                      <div class="tab-pane fade" id="navs-top-address" role="tabpanel">
                        <div class="row">
                          <?php
                          for ($i=1; $i <= 10; $i++) { 
                            echo '<div class="col-md-6 mb-3">
                                      <label class="form-label">Khu vực '.$i.'</label>
                                      <input type="text" class="form-control phone-mask" name="nameLocation['.$i.']" value="'.@$data->nameLocation[$i].'" />
                                  </div>';
                          }
                          ?> 
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-status" role="tabpanel">
                        <div class="row">
                          <?php
                          for ($i=1; $i <= 10; $i++) { 
                            echo '<div class="col-md-6 mb-3">
                                      <label class="form-label">Trạng thái '.$i.'</label>
                                      <input type="text" class="form-control phone-mask" name="status['.$i.']" value="'.@$data->status[$i].'" />
                                  </div>';
                          }
                          ?> 
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-checkin" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Nội dung hiển thị khi checkin</label>
                              <textarea rows="5" class="form-control" name="noteCheckin" id="noteCheckin"><?php echo @$data->noteCheckin;?></textarea>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="mb-3">
                              <b>Mã thay thế:</b>
                              <br/>
                              %fullName% : Họ tên
                              <br/>
                              %email% : Email
                              <br/>
                              %phone% : Số điện thoại
                              <br/>
                              %job% : Công việc
                              <br/>
                              %note% : Ghi chú
                              <br/>
                              %avatar% : Link ảnh đại diện
                              <br/>
                              %status% : Trạng thái
                              <br/>
                              %campain% : Tên chiến dịch
                              <br/>
                              %codeQT% : Mã đăng ký
                              <br/>
                              %nameTicket% : Loại vé
                              <br/>
                              %priceTicket% : Giá vé
                              <br/>
                              %statusBanking% : Trạng thái mua vé
                              <br/>
                              %affiliate% : Người giới thiệu

                            </div>
                          </div>
                        </div>
                      </div>
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

<?php include(__DIR__.'/../footer.php'); ?>