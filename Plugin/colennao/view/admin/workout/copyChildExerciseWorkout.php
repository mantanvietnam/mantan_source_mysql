<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-workout-listWorkout">Bài luyện tập </a> / <a href="/plugins/admin/colennao-view-admin-workout-listExerciseWorkout/?id_workout=<?php echo @$_GET['id_workout'] ?>"><?php echo $dataWorkout->title; ?></a> / <a href="/plugins/admin/colennao-view-admin-workout-listChildExerciseWorkout/?id_workout=<?php echo @$_GET['id_workout'] ?>&id_exercise=<?php echo @$_GET['id_exercise']?>"><?php echo $dataExercise->title; ?></a> /</span>
    Thêm động tác đã có sẵn
  </h4>

  <!-- Basic Layout nav-align-top-->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-body">
            <p><?php echo @$mess; ?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tiêu đề tiếng Việt</label>
                    <input required type="hidden" class="form-control phone-mask" placeholder="Tiêu đề tiếng Việt" name="id_child" id="id_child" value="<?php echo @$data->title;?>" />
                    <input required type="text" class="form-control phone-mask" placeholder="Tim kiếm tiêu đề động tác " name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">sắp xếp theo thứ tự</label>
                    <input type="number" required class="form-control phone-mask" name="sort_order" id="sort_order" value="<?php echo @$data->sort_order;?>"/>
                  </div>
                   <div class="mb-3">
                    <label class="form-label">Nhóm tập(*)</label>
                    <select class="form-select" required name="id_group" id="id_group" >
                      <option value="">Chọn khu vực</option>
                      <?php 
                        if(!empty($dataExercise->group_exercise)){
                          foreach ($dataExercise->group_exercise as $key => $item) {
                            if(empty($data->id_group) || $data->id_group!=$item['id']){
                              echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                            }else{
                              echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
                            }
                          }
                        }?>
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="mb-3" id='new_img'>

                   </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
    // tìm sản phẩm
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#title" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchChildExerciseWorkoutAPI", {
                    term: extractLast( request.term )
                }, response );
            },
            search: function() {
                // custom minLength
                var term = extractLast( this.value );

                if ( term.length < 2 ) {
                    return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                
                $( "#title" ).val(ui.item.label);
                $( "#id_child" ).val(ui.item.id);
                //$( "#promotion" ).val(ui.item.discount);
                
                $("#new_img").html('<img src="'+ui.item.image+'" width="100" style="width:60%" />');
                return false;
            }
        });
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
