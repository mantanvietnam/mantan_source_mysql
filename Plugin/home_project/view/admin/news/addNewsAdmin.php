<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/home_project-view-admin-news-listNewsAdmin">Bài viết</a> /</span>
        Thông tin bài viết
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <p><?php echo @$mess;?></p>
                    <?= $this->Form->create(); ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Tiêu đề *</label>
                                    <input type="text" class="form-control" name="title" value="<?php echo @$infoPost->title;?>" required />
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Tác giả</label>
                                    <input type="text" class="form-control" name="author" value="<?php echo @$infoPost->author;?>" />
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Ghim lên đầu</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="radio" name="pin" value="1" <?php if(!empty($infoPost->pin) && $infoPost->pin==1) echo 'checked';?> /> Có 
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="pin" value="0" <?php if(empty($infoPost->pin)) echo 'checked';?> /> Không 
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Thời gian đăng *</label>
                                    <input type="text" class="form-control datepicker" name="date" value="<?php if(empty($infoPost->time)) $infoPost->time = time();echo date('d/m/Y', $infoPost->time);?>" required />
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Hình minh họa *</label>
                                    <?php showUploadFile('image','image',@$infoPost->image,0);?>
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Từ khóa</label>
                                    <input type="text" class="form-control" name="keyword" value="<?php echo @$infoPost->keyword;?>" />
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Chuyên mục *</label>
                                    <ul class="list-unstyled" style="height: 255px;overflow-y: auto;">
                                        <?php 
                                        if(!empty($listCategory)){
                                            foreach ($listCategory as $key => $value) {
                                                $checked = '';
                                                if(!empty($infoPost->categories) && in_array($key, $infoPost->categories)){
                                                    $checked = 'checked';
                                                }

                                                echo '<li><input id="idCategory'.$key.'" type="checkbox" value="'.$key.'" name="idCategory[]" '.$checked.'> <label for="idCategory'.$key.'">'.$value['name'].'</label>';

                                                    if(!empty($value['sub'])){
                                                        echo '<ul class="ml-3 list_unstyle">';
                                                        
                                                        foreach ($value['sub'] as $key1 => $value1) {
                                                            $checked = '';
                                                            if(!empty($infoPost->categories) && in_array($key1, $infoPost->categories)){
                                                                $checked = 'checked';
                                                            }

                                                            echo '<li><input id="idCategory'.$key1.'" type="checkbox" value="'.$key1.'" name="idCategory[]" '.$checked.'> <label for="idCategory'.$key1.'">'.$value1['name'].'</label>';

                                                                if(!empty($value1['sub'])){
                                                                    echo '<ul class="ml-6 list_unstyle">';
                                                                    
                                                                    foreach ($value1['sub'] as $key2 => $value2) {
                                                                        $checked = '';
                                                                        if(!empty($infoPost->categories) && in_array($key2, $infoPost->categories)){
                                                                            $checked = 'checked';
                                                                        }

                                                                        echo '<li><input id="idCategory'.$key2.'" type="checkbox" value="'.$key2.'" name="idCategory[]" '.$checked.'> <label for="idCategory'.$key2.'">'.$value2['name'].'</label>';

                                                                            if(!empty($value2['sub'])){
                                                                                echo '<ul class="ml-9 list_unstyle">';
                                                                                
                                                                                foreach ($value2['sub'] as $key3 => $value3) {
                                                                                    $checked = '';
                                                                                    if(!empty($infoPost->categories) && in_array($key3, $infoPost->categories)){
                                                                                        $checked = 'checked';
                                                                                    }

                                                                                    echo '<li><input id="idCategory'.$key3.'" type="checkbox" value="'.$key3.'" name="idCategory[]" '.$checked.'> <label for="idCategory'.$key3.'">'.$value3['name'].'</label>';

                                                                                        if(!empty($value3['sub'])){
                                                                                            echo '<ul class="ml-9 list_unstyle">';
                                                                                            
                                                                                            foreach ($value3['sub'] as $key4 => $value4) {
                                                                                                $checked = '';
                                                                                                if(!empty($infoPost->categories) && in_array($key4, $infoPost->categories)){
                                                                                                    $checked = 'checked';
                                                                                                }

                                                                                                echo '<li><input id="idCategory'.$key4.'" type="checkbox" value="'.$key4.'" name="idCategory[]" '.$checked.'> <label for="idCategory'.$key4.'">'.$value4['name'].'</label>';

                                                                                                echo '</li>';
                                                                                            }

                                                                                            echo '</ul>';
                                                                                        }

                                                                                    echo '</li>';
                                                                                }

                                                                                echo '</ul>';
                                                                            }

                                                                        echo '</li>';
                                                                    }

                                                                    echo '</ul>';
                                                                }

                                                            echo '</li>';
                                                        }

                                                        echo '</ul>';
                                                    }
                                                
                                                echo '</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="mb-3 col-12 col-sm-12 col-md-12">
                                    <label class="form-label">Dự án</label>
                                    <select id="selectProject" class="form-control" name="id_product[]" multiple="multiple">
                                        <?php
                                        if (!empty($listProjects)) {
                                            foreach ($listProjects as $project) {
                                                $selected = in_array($project->id, $infoPost->id_product) ? 'selected' : '';
                                                echo '<option value="' . $project->id . '" ' . $selected . '>' . $project->name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Mô tả ngắn *</label>
                                    <textarea class="form-control" name="description" required rows="5"><?php echo @$infoPost->description;?></textarea>
                                </div>
                            </div>


                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Nội dung bải viết</label>
                                    <?php showEditorInput('content', 'content', @$infoPost->content);?>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu bài viết</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load jQuery & Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#selectProject").select2({
        placeholder: "Tìm và chọn dự án...",
        allowClear: true,
        ajax: {
            url: "/apis/searchProjectAPI",
            method: "GET",
            data: function(params) {
                return { term: params.term };
            },
            processResults: function(response) {
                let results = [];
                if (response && response.length > 0) {
                    results = response.map(project => ({
                        id: project.id,
                        text: project.label
                    }));
                } else {
                    results = [{ id: 0, text: "Không tìm thấy dự án" }];
                }

                return { results: results };
            },
            error: function() {
                console.error("Lỗi khi tải dữ liệu dự án");
            }
        }
    });
});


</script>


