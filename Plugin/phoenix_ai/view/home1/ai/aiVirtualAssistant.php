<?php include(__DIR__.'/../header.php'); ?>

<style>
    .code-container {
        position: relative;
        padding: 16px;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: monospace;
        overflow-x: auto;
    }
    .copy-button {
        position: absolute;
        top: 8px;
        right: 8px;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 6px 10px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 14px;
    }
    .copy-button:active {
        background-color: #0056b3;
    }
</style>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    AI trợ lý ảo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Dữ liệu cung cấp cho AI</h5>
          </div>

          <div class="card-body">
            <p><?php echo $mess;?></p>
            <div id="data_ai" style="display: none;">
              <form enctype="multipart/form-data" method="post" action="">
                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-personal" aria-controls="navs-top-personal" aria-selected="true">
                       Chủ hệ thống
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-company" aria-controls="navs-top-company" aria-selected="false">
                      Công ty
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-product" aria-controls="navs-top-product" aria-selected="false">
                      Sản phẩm
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-agency" aria-controls="navs-top-agency" aria-selected="false">
                      Tuyển sỉ
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-sell" aria-controls="navs-top-sell" aria-selected="false">
                      Bán hàng
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-business" aria-controls="navs-top-business" aria-selected="false">
                      Chiến lược
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-newperson" aria-controls="navs-top-newperson" aria-selected="false">
                      Người mới
                    </button>
                  </li>

                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-training" aria-controls="navs-top-training" aria-selected="false">
                      Đào tạo
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-competitor" aria-controls="navs-top-competitor" aria-selected="false">
                      Đối thủ
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-control" aria-controls="navs-top-control" aria-selected="false">
                      Quản trị
                    </button>
                  </li>
                </ul>
                      
                <div class="tab-content">
                  <div class="tab-pane fade active show" id="navs-top-personal" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Câu chuyện bản thân</label>
                          <textarea rows="5" class="form-control" name="personal_story"><?php echo @$data['personal_story'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Thành tựu đạt được</label>
                          <textarea rows="5" class="form-control" name="personal_achievements"><?php echo @$data['personal_achievements'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-company" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Tên công ty</label>
                          <input type="text" name="company_name" class="form-control" value="<?php echo @$data['company_name'];?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Địa chỉ công ty</label>
                          <input type="text" name="company_address" class="form-control" value="<?php echo @$data['company_address'];?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Số điện thoại công ty</label>
                          <input type="text" name="company_phone" class="form-control" value="<?php echo @$data['company_phone'];?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Mã số thuế công ty</label>
                          <input type="text" name="company_tax_code" class="form-control" value="<?php echo @$data['company_tax_code'];?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Tầm nhìn</label>
                          <textarea rows="5" class="form-control" name="company_vision"><?php echo @$data['company_vision'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Sứ mệnh</label>
                          <textarea rows="5" class="form-control" name="company_mission"><?php echo @$data['company_mission'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Giá trị cốt lõi</label>
                          <textarea rows="5" class="form-control" name="company_core_value"><?php echo @$data['company_core_value'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Văn hóa doanh nghiệp</label>
                          <textarea rows="5" class="form-control" name="company_culture"><?php echo @$data['company_culture'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Nội quy công ty</label>
                          <textarea rows="5" class="form-control" name="company_rule"><?php echo @$data['company_rule'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-product" role="tabpanel">
                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover mb-none text-center mb-3" style="min-width: 1000px;">
                            <thead>
                              <tr>
                                <th>Tên sản phẩm</th>
                                <th>Thành phần</th>
                                <th>Công dụng</th>
                                <th>Cách sử dụng</th>
                                <th>Thông tin khác</th>
                                <th>Xóa</th>
                              </tr>
                            </thead>
                            <tbody id="tbodylink">  
                            <?php
                            $i= 0;
                            if(!empty($data['product'])){
                              foreach($data['product'] as $key => $value){
                                $i++;
                                
                                echo '<tr class="gradeX" id="trProduct-'.$i.'">
                                        <td>
                                          <input type="text" class="form-control" name="product['.$i.'][name]"  value="'.@$value['name'].'"/>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][component]">'.@$value['component'].'</textarea>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][effect]">'.@$value['effect'].'</textarea>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][how_to_use]">'.@$value['how_to_use'].'</textarea>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][other]">'.@$value['other'].'</textarea>
                                        </td>
                                        <td align="center" class="actions">
                                          <a onclick="deleteTr('.$i.')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                        </td>
                                      </tr>';
                              }
                            }else{
                              $i = 1;

                              echo '<tr class="gradeX" id="trProduct-'.$i.'">
                                        <td>
                                          <input type="text" class="form-control" name="product['.$i.'][name]"  value=""/>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][component]"></textarea>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][effect]"></textarea>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][how_to_use]"></textarea>
                                        </td>
                                        <td>
                                          <textarea rows="5" class="form-control" name="product['.$i.'][other]"></textarea>
                                        </td>
                                        <td align="center" class="actions"></td>
                                      </tr>';
                            } ?>
                            </tbody>
                          </table> 
                        </div>

                        <div class="form-group mb-3 col-md-12">
                          <button type="button" class="btn btn-danger" onclick="return addRowProduct();"><i class="bx bx-plus" aria-hidden="true"></i> Thêm sản phẩm</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-agency" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Kịch bản tuyển sỉ</label>
                          <textarea rows="5" class="form-control" name="agency_script"><?php echo @$data['agency_script'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Xử lý từ chối tuyển sỉ</label>
                          <textarea rows="5" class="form-control" name="agency_reject"><?php echo @$data['agency_reject'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Câu chuyện hệ thống</label>
                          <textarea rows="5" class="form-control" name="agency_story"><?php echo @$data['agency_story'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Kế hoạch content tuyển sỉ</label>
                          <textarea rows="5" class="form-control" name="agency_plan_content"><?php echo @$data['agency_plan_content'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-sell" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Kịch bản bán hàng</label>
                          <textarea rows="5" class="form-control" name="sell_script"><?php echo @$data['sell_script'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Xử lý từ chối bán hàng</label>
                          <textarea rows="5" class="form-control" name="sell_reject"><?php echo @$data['sell_reject'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Chăm sóc khách hàng</label>
                          <textarea rows="5" class="form-control" name="sell_care_customer"><?php echo @$data['sell_care_customer'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Mẫu content đăng bài bán hàng</label>
                          <textarea rows="5" class="form-control" name="sell_content"><?php echo @$data['sell_content'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-business" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Chiến lược thu hút khách hàng tiềm năng</label>
                          <textarea rows="5" class="form-control" name="business_potential_customers"><?php echo @$data['business_potential_customers'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Chiến lược tăng doanh số</label>
                          <textarea rows="5" class="form-control" name="business_increase_sales"><?php echo @$data['business_increase_sales'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Chiến lược khách hàng quay lại</label>
                          <textarea rows="5" class="form-control" name="business_returning_customers"><?php echo @$data['business_returning_customers'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-newperson" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quy trình các bước dành cho người mới</label>
                          <textarea rows="5" class="form-control" name="newperson_plan"><?php echo @$data['newperson_plan'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Chiến lược ra đơn trong 10 ngày</label>
                          <textarea rows="5" class="form-control" name="newperson_order"><?php echo @$data['newperson_order'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Lộ trình học tập, phát triển</label>
                          <textarea rows="5" class="form-control" name="newperson_training"><?php echo @$data['newperson_training'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-training" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Đào tạo bán hàng</label>
                          <textarea rows="5" class="form-control" name="training_sell"><?php echo @$data['training_sell'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Đào tạo văn hóa</label>
                          <textarea rows="5" class="form-control" name="training_culture"><?php echo @$data['training_culture'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Đào tạo tuyển sỉ</label>
                          <textarea rows="5" class="form-control" name="training_agency"><?php echo @$data['training_agency'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Đào tạo thương hiệu cá nhân</label>
                          <textarea rows="5" class="form-control" name="training_brand"><?php echo @$data['training_brand'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Đào tạo về mục tiêu và kế hoạch kinh doanh</label>
                          <textarea rows="5" class="form-control" name="training_plan"><?php echo @$data['training_plan'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Đào tạo chiến lược kinh doanh</label>
                          <textarea rows="5" class="form-control" name="training_business"><?php echo @$data['training_business'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-competitor" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quy trình nghiên cứu đối thủ</label>
                          <textarea rows="5" class="form-control" name="competitor_research"><?php echo @$data['competitor_research'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">So sánh với đối thủ</label>
                          <textarea rows="5" class="form-control" name="competitor_compare"><?php echo @$data['competitor_compare'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-control" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản trị điều hành</label>
                          <textarea rows="5" class="form-control" name="control_executive"><?php echo @$data['control_executive'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản trị marketing</label>
                          <textarea rows="5" class="form-control" name="control_mkt"><?php echo @$data['control_mkt'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản trị bán hàng</label>
                          <textarea rows="5" class="form-control" name="control_sales"><?php echo @$data['control_sales'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản trị kinh doanh</label>
                          <textarea rows="5" class="form-control" name="control_business"><?php echo @$data['control_business'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản trị tài chính</label>
                          <textarea rows="5" class="form-control" name="control_finance"><?php echo @$data['control_finance'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản trị nội bộ, hành chính</label>
                          <textarea rows="5" class="form-control" name="control_administration"><?php echo @$data['control_administration'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản lý chi nhánh</label>
                          <textarea rows="5" class="form-control" name="control_branch"><?php echo @$data['control_branch'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản trị nhân sự</label>
                          <textarea rows="5" class="form-control" name="control_person"><?php echo @$data['control_person'];?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Quản lý công cụ, thiết bị lao động</label>
                          <textarea rows="5" class="form-control" name="control_device"><?php echo @$data['control_device'];?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>  

                <button type="submit" class="btn btn-primary">Lưu</button> 
              </form>
            </div>
            
            <div id="info_ai" style="display: none;">
              <p>Link truy cập trợ lý ảo: <a href="<?php echo @$data_ai->link_ai;?>" target="_blank"><?php echo @$data_ai->link_ai;?></a></p>
              <p>Mã nhúng trợ lý ảo vào website:</p>
              <div class="code-container" id="code-container">
                <code class="mb-3" id="embed_code_ai"><?php if(!empty($data_ai->embed_code_ai)) echo trim(nl2br(htmlspecialchars($data_ai->embed_code_ai)));?></code>
                <button class="copy-button" onclick="copyCode()">Sao chép</button>
              </div>
              <p style="margin-top: 15px;"><button type="button" class="btn btn-danger" onclick="updateData();">Cập nhập dữ liệu</button></p>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  var row = <?php echo $i ;?>;
  var create_ai = '<?php echo @$data_ai->create_ai;?>';

  if(create_ai == 'done'){
    $('#data_ai').hide();
    $('#info_ai').show();
  }else{
    $('#data_ai').show();
    $('#info_ai').hide();
  }

  function updateData()
  {
    $('#data_ai').show();
    $('#info_ai').hide();
  }

  function addRowProduct()
  {
    row++;
    var tr = '<tr class="gradeX" id="trProduct-'+row+'">\
                <td>\
                  <input type="text" class="form-control" name="product['+row+'][name]"  value=""/>\
                </td>\
                <td>\
                  <textarea rows="5" class="form-control" name="product['+row+'][component]"></textarea>\
                </td>\
                <td>\
                  <textarea rows="5" class="form-control" name="product['+row+'][effect]"></textarea>\
                </td>\
                <td>\
                  <textarea rows="5" class="form-control" name="product['+row+'][how_to_use]"></textarea>\
                </td>\
                <td>\
                  <textarea rows="5" class="form-control" name="product['+row+'][other]"></textarea>\
                </td>\
                <td align="center" class="actions">\
                  <a onclick="deleteTr('+row+')" href="javascript:void(0);"><i class="bx bx-trash"></i></a>\
                </td>\
              </tr>';


    $('#tbodylink tr:last').after(tr);
  }

  function deleteTr(i)
  {
      row--;
      $('#trProduct-'+i).remove();
  }
</script>

<script>
    function copyCode() {
        const codeContainer = document.getElementById('embed_code_ai').innerText;
        navigator.clipboard.writeText(codeContainer).then(() => {
            alert('Đoạn code đã được sao chép!');
        }).catch(err => {
            console.error('Sao chép thất bại: ', err);
        });
    }
</script>

<?php include(__DIR__.'/../footer.php'); ?>