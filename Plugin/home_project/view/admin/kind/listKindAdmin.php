<style>
  a{
    text-decoration: none !important;
  }
  #treeview .list-group-item {
        color: blue;
        font-weight: 400;
        cursor: pointer;
        text-decoration: none !important;
    }

    /* Khi hover vào, đổi màu xanh đậm */
    #treeview .list-group-item:hover {
        color: #0056b3;
        text-decoration: underline;
    }
</style>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Phân cấp dự án <i class='bx bx-message-square-add' onclick="popupNew();"></i></h4>
    <!-- Basic Layout -->
      <div class="row">
        <div class="col-lg">
              <div class="card mb-6">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Chủ đề</h5>
                  </div>
                  <div id="treeview"></div>
              </div>
          </div>

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
                  <label class="form-label" for="parent">Chuyên mục cha</label>
                  <select class="form-control" name="parent" id="parent">
                      <option value="0">Chuyên mục gốc</option>
                      <?php
                      function showCategoryOptions($categories, $parent = 0, $prefix = '', $selectedId = 0) {
                          foreach ($categories as $category) {
                              if ($category->parent == $parent) {
                                  $selected = ($category->id == $selectedId) ? 'selected' : '';
                                  echo '<option value="'.$category->id.'" '.$selected.'>'.$prefix.$category->name.'</option>';
                                  showCategoryOptions($categories, $category->id, $prefix . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $selectedId);
                              }
                          }
                      }

                      if (!empty($listData)) {
                          showCategoryOptions($listData, 0, '', $infoCategory->parent ?? 0);
                      }
                      ?>
                  </select>
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

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-danger" id="btnDelete" onclick="deleteCurrentCategory();">Xóa</button>
                    <button type="button" class="btn btn-primary" onclick="updateCategory();">Cập Nhật</button>
                    <button type="button" class="btn btn-success" onclick="addCategory();">Thêm Mới</button>
                </div>

              <?= $this->Form->end() ?>
            </div>
          </div>
        </div>

      </div>
    
  </div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
        var treeData = <?= json_encode(buildTree($listData)) ?>;

        $('#treeview').treeview({
            data: treeData,
            showBorder: false,
            expandIcon: "bx bx-chevron-right",
            collapseIcon: "bx bx-chevron-down",
            onNodeSelected: function(event, node) {
                editData(node.id, node.text, node.image, node.keyword, node.description, node.parent);
            }
        });

        $('#parent').select2();
    });

    function popupNew() {
        $('#idCategoryEdit').val('');
        $('#name').val('');
        $('#image').val('');
        $('#keyword').val('');
        $('#description').val('');
        $('#parent').val('0').trigger('change');
    }

    function editData(id, name, image, keyword, description, parent){
      $('#idCategoryEdit').val(id);
      $('#name').val(name);
      $('#image').val(image);
      $('#keyword').val(keyword);
      $('#description').val(description);
      $('#parent').val(parent).trigger('change');
      
    }


    function addCategory() {
    var name = $('#name').val();
    var image = $('#image').val();
    var keyword = $('#keyword').val();
    var description = $('#description').val();
    var parent = $('#parent').val();

    if (name === '') {
        alert('Tên chuyên mục không được để trống!');
        $('#name').focus();
        return;
    }

    var data = {
        name: name,
        image: image,
        keyword: keyword,
        description: description,
        parent: parent
    };

    $.ajax({
        method: "POST",
        url: "/apis/saveKindAPI",
        data: data,
        success: function(response) {

            if (response.success === true) {
                alert('Chuyên mục mới đã được thêm thành công!');
                window.location.reload();
            } else {
                console.warn("Server responded with an error:", response.message);
                alert('Lỗi: ' + response.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Request Error:", {
                textStatus: textStatus,
                errorThrown: errorThrown,
                responseText: jqXHR.responseText
            });

            alert('Có lỗi xảy ra. Vui lòng thử lại.');
        }
    });
}

function updateCategory() {
    var id = $('#idCategoryEdit').val();

    if (!id) {
        alert("Vui lòng chọn một chuyên mục để cập nhật!");
        return;
    }

    var formData = {
        idCategoryEdit: id,
        name: $('#name').val(),
        image: $('#image').val(),
        keyword: $('#keyword').val(),
        description: $('#description').val(),
        parent: $('#parent').val()
    };

    var url = "/apis/saveKindAPI";

    $.ajax({
    method: "POST",
    url: url,
    data: formData
})
.done(function(response) {

    if (response && response.success) {
        alert("Cập nhật chuyên mục thành công!");
        window.location.reload();
    } else {
        alert("❌ Lỗi từ server: " + (response.message || "Không rõ nguyên nhân!"));
    }
})
.fail(function(xhr, status, error) {
    console.error("❌ Lỗi cập nhật:", status, error);
    console.error("❌ Phản hồi từ server:", xhr.responseText);
    alert("Cập nhật thất bại, vui lòng thử lại!");
});
};

    function deleteCurrentCategory() {
        var id = $('#idCategoryEdit').val();

        if (!id) {
            alert("Vui lòng chọn một chuyên mục để xóa!");
            return;
        }

        var check = confirm("Bạn có chắc chắn muốn xóa không?");
        if (check) {
            $.ajax({
                method: "GET",
                url: "/categories/delete/?id=" + id,
                data: {}
            })
            .done(function(msg) {
                window.location.reload();
            })
            .fail(function() {
                alert("Xóa thất bại, vui lòng thử lại!");
            });
        }
    }

  </script>