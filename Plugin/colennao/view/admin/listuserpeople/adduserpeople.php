<!-- Helpers -->
<?php

$workoutExercisesGrouped = [];
foreach ($dataExerciseWorkouts as $exercise) {
    
    $workoutExercisesGrouped[$exercise->id_workout][] = $exercise;
}

?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-listuserpeople-listuserpeople">Danh sách bài tập luyện </a> /</span>
    Nội dung câu hỏi
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thêm bài luyện tập</h5>
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
                            Thông tin
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-unit" aria-selected="false">
                            Bài tập 
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Tên bài tập</label>
                                <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">Kế hoạch</label>
                                  <select class="form-control" name="id_consume" id="id_consume" required>
                                      <option value="">Chọn Nhóm </option>
                                   
                                      <?php foreach ($datamyplane as $item): ?>
                                          <option value="<?php echo $item['id']; ?>" 
                                              <?php echo isset($data->id_consume) && $data->id_consume == $item['id'] ? 'selected' : ''; ?>>
                                              <?php echo $item['name']; ?>
                                          </option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Ảnh minh họa</label>
                                <?php showUploadFile('image','image',@$data->image,0);?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">Danh mục bài tập</label>
                                  <div class="input-group input-group-merge">
                                      <select class="form-select" name="type" id="type">
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
                        </div>
                        <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">
                          <div class="container">
                              <h4 class="mb-4">Thêm bài tập</h4>
                              <table class="table table-bordered mb-3" id="exerciseTable">
                                  <thead>
                                      <tr>
                                          <th>Tên nhóm bài học</th>
                                          <th>Tên bài học</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                              </table>

                              <div class="form-group">
                                  <button type="button" class="btn btn-primary" id="addRowButton">Thêm Hàng</button>
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

<script type="text/javascript">
    var workouts = {};
    var row = 0;

    <?php
        // mảng chứa Tên nhóm bài học
        if(!empty($dataWorkouts)){
            foreach ($dataWorkouts as $key=>$item){
                echo '  workouts['.$item->id.'] = {};
                        workouts['.$item->id.']["id"] = '.$item->id.';
                        workouts['.$item->id.']["title"] = "'.$item->title.'";
                        workouts['.$item->id.']["exercise"] = {};
                    ';
            }
        }

        // mảng chứa Tên bài học
        if(!empty($dataExerciseWorkouts)){
            foreach ($dataExerciseWorkouts as $key => $value) {
                echo '  workouts['.$value->id_workout.']["exercise"]['.$value->id.'] = {};
                        workouts['.$value->id_workout.']["exercise"]['.$value->id.']["id"] = '.$value->id.';
                        workouts['.$value->id_workout.']["exercise"]['.$value->id.']["title"] = "'.$value->title.'";
                ';
            }
        }
    ?>

    //console.log(workouts);

    // hiển thị lựa chọn nhóm bài tập
    function showSelectWorkouts(id_select)
    {
        var selectText = '<select onchange="selectWorkout('+row+');" class="form-select" id="workout_'+row+'" name="workout_group[]"><option value="0">Chọn nhóm bài học</option>';
        var classSelect = '';

        $.each( workouts, function( key, value ) {
            classSelect = '';
            if(value.id == id_select){
                classSelect = 'selected';
            }

            selectText += '<option '+classSelect+' value="'+value.id+'">'+value.title+'</option>';
        });

        selectText += '</select>';

        return selectText;
    }

    // hiển thị lựa chọn bài tập
    function showSelectExercise(id_workout, id_select)
    {
        var selectText = '<select class="form-select" name="workout_title[]" id="exercise_'+row+'"><option value="0">Chọn bài học</option>';
        var classSelect = '';

        if(id_workout != 0){
            $.each( workouts[id_workout]['exercise'], function( key, value ) {
                classSelect = '';
                if(value.id == id_select){
                    classSelect = 'selected';
                }

                selectText += '<option '+classSelect+' value="'+value.id+'">'+value.title+'</option>';
            });
        }

        selectText += '</select>';

        return selectText;
    }

    // xử lý khi lựa chọn nhóm bài tập
    function selectWorkout(row_select)
    {
        var workout_select = $('#workout_'+row_select).val();
        var loadSelectExercise = showSelectExercise(workout_select, 0);

        $('#td2_'+row_select).html(loadSelectExercise);
    }

    // thêm hàng mới
    function addRowSelect(id_workout_select, id_exercise_select)
    {
        row ++;

        var table = document.getElementById('exerciseTable').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        
        var cell1 = newRow.insertCell(0);
        cell1.innerHTML = showSelectWorkouts(id_workout_select);
        cell1.id = 'td1_'+row;

        var cell2 = newRow.insertCell(1);
        cell2.innerHTML = showSelectExercise(id_workout_select, id_exercise_select);
        cell2.id = 'td2_'+row;
    }

    // chèn dữ liệu cũ
    <?php 
        if (!empty($data->id_lesson)){
            $idLessons = json_decode($data->id_lesson, true);
            if (!is_array($idLessons)) {
                $idLessons = [];
            }

            if (!empty($idLessons)){
                foreach ($idLessons as $lesson){
                    echo 'addRowSelect('.$lesson[0].', '.$lesson[1].');';
                }
            }else{
                echo 'addRowSelect(0, 0);';
            }
        }else{
            echo 'addRowSelect(0, 0);';
        }
    ?>
</script>

<!-- <select id="workoutGroup" onchange="loadExercises(this.value)">
    <option value="">Chọn nhóm bài tập</option>
 
</select>
<h3>Danh sách bài tập:</h3>
<ul id="exerciseList"></ul>

<script>
    const dataWorkouts = <?php echo json_encode($dataWorkouts); ?>;
    const dataExerciseWorkouts = <?php echo json_encode($dataExerciseWorkouts); ?>;
    const workoutGroup = document.getElementById('workoutGroup');
    dataWorkouts.forEach(group => {
        const option = document.createElement('option');
        option.value = group.id; 
        option.textContent = group.title; 
        workoutGroup.appendChild(option);
    });
    function loadExercises(groupId) {
        const exerciseList = document.getElementById('exerciseList');
        exerciseList.innerHTML = ''; 

        if (!groupId) {
            exerciseList.textContent = 'Vui lòng chọn nhóm bài tập.';
            return;
        }
        const filteredExercises = dataExerciseWorkouts.filter(exercise => exercise.id_workout == groupId);

        if (filteredExercises.length > 0) {
            filteredExercises.forEach(exercise => {
                const li = document.createElement('li');
                li.textContent = `ID: ${exercise.id}, Name: ${exercise.title}`; 
                exerciseList.appendChild(li);
            });
        } else {
            exerciseList.textContent = 'Không có bài tập nào trong nhóm này.';
        }
    }
</script> -->







<script>
    document.getElementById('addRowButton').addEventListener('click', function() {
        addRowSelect(0, 0);
    });
</script>