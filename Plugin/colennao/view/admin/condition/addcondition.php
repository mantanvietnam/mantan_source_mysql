<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-condition-listcondition">Điều kiện</a> /</span>
    Nội dung câu hỏi thiết lập điều kiện
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <!-- <h5 class="mb-0">Nội dung câu hỏi</h5> -->
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-align-top mb-4">
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-question" aria-controls="navs-top-question" aria-selected="true">
                            Câu hỏi
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">Danh mục bài tập</label>
                                  <div class="input-group input-group-merge">
                                        <select class="form-select" name="type" id="type" onclick="orderReturnquestion()" <?php echo $disabled ?>>
                                              <option value="">-- Chọn danh mục bài tập --</option>
                                          <?php foreach ($listcategoryexercise as $category): ?>
                                              <option value="<?= $category->id ?>" 
                                                  <?php if (!empty($data->type) && $data->type == $category->id) echo 'selected'; ?>>
                                                  <?= $category->name ?>
                                              </option>
                                          <?php endforeach; ?>
                                        </select>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên nhóm bài tập</label>
                                    <select class="form-control" name="id_groupfile" id="id_groupfile" required>
                                        <option value="">Chọn Nhóm bài tập</option>
                                        <?php foreach ($dataWorkout as $item): ?>
                                            <option value="<?php echo $item['id']; ?>" 
                                                <?php echo isset($data->id) && $data->id == $item['id'] ? 'selected' : ''; ?>>
                                                <?php echo $item['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                          </div>
                          <div class="row mb-4">
                              <div class="col-md-6">
                                  <div class="mb-2">
                                      <label class="form-label">đây là bài tập mặc định</label>
                                      
                                  </div>
                                  <select class="form-control" name="status" required>
                                      <option value="">Chọn trạng thái</option>
                                      <option value="active" <?php echo (isset($data->status) && $data->status == 'active') ? 'selected' : ''; ?>>mặc định</option>
                                      <option value="inactive" <?php echo (isset($data->status) && $data->status == 'inactive') ? 'selected' : ''; ?>>Không phải mặc định</option>
                                  </select>
                              </div>
                          </div>
                          <div id="orderReturnBook">
                              <div class="modal-body">
                                  <!-- Nội dung sẽ được gắn vào đây -->
                              </div>
                          </div>

                          <!-- <?php if (!empty($dataquestion) && is_array($dataquestion)): ?>
                            <?php foreach ($dataquestion as $questionData): ?>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Câu hỏi: <?php echo $questionData['name']; ?></label>
                                            <input type="hidden" name="id_question[]" value="<?php echo $questionData['id']; ?>" />
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <?php 
                                            $hasAnswer = false; 
                                            for ($i = 1; $i <= 8; $i++): 
                                                $answerKey = 'answer' . $i; 
                                                if (isset($questionData[$answerKey]) && $questionData[$answerKey] !== null && $questionData[$answerKey] !== ''): 
                                                    $hasAnswer = true; 
                                  
                                                    $valueMap = ['a', 'b', 'c', 'd','e','f','g','h']; 
                                            ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="answer[<?php echo $questionData['id']; ?>][]" value="<?php echo $valueMap[$i - 1]; ?>" id="<?php echo $answerKey . '-' . $questionData['id']; ?>">
                                                  
                                                    <label class="form-check-label" for="<?php echo $answerKey . '-' . $questionData['id']; ?>">
                                                        <?php 
                                                        $data = $questionData[$answerKey];
                                                        $decodedData = json_decode($data, true);
                                                        echo isset($decodedData['vi']) ? $decodedData['vi'] : $data; 
                                                        ?>
                                                    </label>
                                                </div>
                                            <?php 
                                                endif; 
                                            endfor; 
                                            if (!$hasAnswer): 
                                            ?>
                                                <p>Không có câu trả lời.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có dữ liệu câu hỏi.</p>
                          <?php endif; ?> -->
                        </div>
                        <div class="tab-pane fade  show" id="navs-top-2" role="tabpanel">
                        
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

<script>

function orderReturnquestion() {
    var type = document.getElementById('type').value;
    if (type != '') {
        $.ajax({
            url: `/apis/listquestionexercise`,
            method: 'POST',
            data: { type: type },
            beforeSend: function () {},
            success: function (response) {
                console.log(response);
                if (response.listData.length > 0) {
                    let dataquestion = response.listData;

                    let detailsHtml = '';
                    if (dataquestion && Array.isArray(dataquestion)) {
                        dataquestion.forEach(questionData => {
                            detailsHtml += `
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <label class="form-label">Câu hỏi: ${questionData.name}</label>
                                        <input type="hidden" name="id_question[]" value="${questionData.id}" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        ${(() => {
                                            let hasAnswer = false;
                                            let answerHtml = '';
                                            const valueMap = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
                                            for (let i = 1; i <= 8; i++) {
                                                const answerKey = `answer${i}`;
                                                if (
                                                    questionData[answerKey] !== null &&
                                                    questionData[answerKey] !== ''
                                                ) {
                                                    hasAnswer = true;
                                                    const data = questionData[answerKey];
                                                    const decodedData = JSON.parse(data || '{}');
                                                    const answerText = decodedData.vi || data;

                                                    answerHtml += `
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="answer[${questionData.id}][]" value="${valueMap[i - 1]}" id="${answerKey}-${questionData.id}">
                                                            <label class="form-check-label" for="${answerKey}-${questionData.id}">
                                                                ${answerText}
                                                            </label>
                                                        </div>`;
                                                }
                                            }
                                            return hasAnswer ? answerHtml : '<p>Không có câu trả lời.</p>';
                                        })()}
                                    </div>
                                </div>
                            </div>`;
                        });
                    } else {
                        detailsHtml = '<p>Không có dữ liệu câu hỏi.</p>';
                    }

                    // Gắn HTML đã tạo vào modal-body
                    $('#orderReturnBook .modal-body').html(detailsHtml);
                } else {
                    alert('Không tìm thấy dữ liệu câu hỏi.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error occurred:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText
                });
                alert('Đã xảy ra lỗi khi gọi API.');
            },
            complete: function () {}
        });
    }
}


</script>

<script type="text/javascript">
  var question = {};
  <?php 
  // mang chua cau hoi
       if(!empty($dataquestion)){
        foreach ($dataquestion as $key=>$item){
            echo '  question['.$item->id.'] = {};
                    question['.$item->id.']["id"] = '.$item->id.';
                    question['.$item->id.']["name"] = "'.$item->name.'";
                    question['.$item->id.']["answer1"] = "'.$item->answer1.'";
                    question['.$item->id.']["answer2"] = "'.$item->answer2.'";
                    question['.$item->id.']["answer3"] = "'.$item->answer3.'";
                    question['.$item->id.']["answer4"] = "'.$item->answer4.'";
                    question['.$item->id.']["answer5"] = "'.$item->answer5.'";
                    question['.$item->id.']["answer6"] = "'.$item->answer6.'";
                    question['.$item->id.']["answer7"] = "'.$item->answer7.'";
                    question['.$item->id.']["answer8"] = "'.$item->answer8.'";
                    question['.$item->id.']["type"] = "'.$item->type.'";
                ';
        }
      // mang chua danh muc cau hoi
        if(!empty($listcategoryexercise)){
          foreach ($listcategoryexercise as $key => $value) {
              echo '  question['.$value->id.']["exercise"]['.$value->id.'] = {};
                      question['.$value->id.']["exercise"]['.$value->id.']["id"] = '.$value->id.';
                      question['.$value->id.']["exercise"]['.$value->id.']["name"] = "'.$value->name.'";
              ';
          }
        }}

  ?>



</script>




