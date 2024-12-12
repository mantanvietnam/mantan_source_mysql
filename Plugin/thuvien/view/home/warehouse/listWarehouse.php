<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWarehouse">Kho</a> /</span>
    Danh sách kho
  </h4>

  <p><a href="/addWarehouse" class="btn btn-primary"><i class="bx bx-plus"></i> Nhập sách vào kho </a></p>

</p>

<!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <!-- <div class="col-md-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div> -->

          <div class="col-md-3">
            <label class="form-label">Tên tòa nhà</label>
            <select class="form-select" name="id_building" id="id_building" onclick="getfloor()">
              <option value="" >Chọn tòa nhà</option>
              <?php if(!empty($dataBuilding)){
              foreach ($dataBuilding as $key => $item){
                $selected = '';
                if(!empty($_GET['id_building']) && $_GET['id_building']==$item->id){
                  $selected = 'selected';
                }

                echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
              }
              } ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Tên tầng</label>
            <select class="form-select" name="id_floor" id="id_floor" onclick="getRoom()">
              <option value="" >Chọn tầng</option>
              <?php if(!empty($dataFloor)){
              foreach ($dataFloor as $key => $item){
                $selected = '';
                if(!empty($_GET['id_floor']) && $_GET['id_floor']==$item->id){
                  $selected = 'selected';
                }

                echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
              } 
              } ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Tên phòng</label>
            <select class="form-select" name="id_room" id="id_room" onclick="getShelf()">
              <option value="" >Chọn phòng</option>
              <?php if(!empty($dataRoom)){
              foreach ($dataRoom as $key => $item){
                $selected = '';
                if(!empty($_GET['id_room']) && $_GET['id_room']==$item->id){
                  $selected = 'selected';
                }

                echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
              } 
              } ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Tên kệ</label>
            <select class="form-select" name="id_shelf" id="id_shelf" >
              <option value="" >Chọn kệ</option>
              <?php if(!empty($dataShelf)){
              foreach ($dataShelf as $key => $item){
                $selected = '';
                if(!empty($_GET['id_shelf']) && $_GET['id_shelf']==$item->id){
                  $selected = 'selected';
                }

                echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
              } 
              } ?>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">tên sách</label>
            <input type="text" class="form-control" name="name_book" id="name_book" value="<?php if(!empty($_GET['name_book'])) echo $_GET['name_book'];?>">
            <input type="hidden" class="form-control" name="id_book" id="id_book" value="<?php if(!empty($_GET['id_book'])) echo $_GET['id_book'];?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>

           <!--  <div class="col-md-1">
              <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
            </div> -->
          </div>
        </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách tòa nhà </h5>  <!-- - <span class="text-danger"><?php echo number_format(@$totalData);?> tòa nhà</span>-->
    <?php echo @$mess;?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Sách</th>
            <th>vị trí </th>
            <th>Tổng số lượng</th>
            <th>Số lượng đang cho mượn</th>
            <th>số lượng trong kho</th>
            <th>Sửa</th>
            <th>Xoá</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              echo '<tr>
              <td>'.$item->id.'</td>
              <td>'.$item->book->name.'</td>
              <td>Tòa nhà: '.$item->building->name.'</br>
              Tầng: '.$item->floor->name.'</br>
              Phòng: '.$item->room->name.'</br>
              kệ: '.$item->shelf->name.'</td>
              <td>'.$item->quantity.'</td>
              <td>'.$item->quantity_borrow.'</td>
              <td>'.$item->quantity_warehous.'</td>
              <td width="5%" align="center">
              <a class="dropdown-item" href="/addWarehouse/?id='.$item->id.'">
              <i class="bx bx-edit-alt me-1"></i>
              </a>
              </td>

              <td align="center">
              <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteBuilding/?id='.$item->id.'">
              <i class="bx bx-trash me-1"></i>
              </a>
              </td>
              </tr>';
            }
          }else{
            echo '<tr>
            <td colspan="10" align="center">Chưa có dữ liệu</td>
            </tr>';
          }
          ?>
        </tbody>
      </table>
    </div>


    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
          if($totalPage>0){
            if ($page > 5) {
              $startPage = $page - 5;
            } else {
              $startPage = 1;
            }

            if ($totalPage > $page + 5) {
              $endPage = $page + 5;
            } else {
              $endPage = $totalPage;
            }

            echo '<li class="page-item first">
            <a class="page-link" href="'.$urlPage.'1"
            ><i class="tf-icon bx bx-chevrons-left"></i
            ></a>
            </li>';

            for ($i = $startPage; $i <= $endPage; $i++) {
              $active= ($page==$i)?'active':'';

              echo '<li class="page-item '.$active.'">
              <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
              </li>';
            }

            echo '<li class="page-item last">
            <a class="page-link" href="'.$urlPage.$totalPage.'"
            ><i class="tf-icon bx bx-chevrons-right"></i
            ></a>
            </li>';
          }
          ?>
        </ul>
      </nav>
    </div>
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>

<script type="text/javascript">
  function getfloor(){
      var id_building = document.getElementById('id_building').value;
      if(id_building!=''){
           $.ajax({
              method: "POST",
              url: "/apis/searcFloorAPI",
              data: { 
                id_building: id_building,
            }
            }).done(function( msg ) {
                var html = '<option value="" >Chọn tầng</option>';
                for (let i = 0; i < msg.length; i++) {
                    
                  html += '<option value="'+msg[i].id+'" >'+msg[i].name+'</option>';
                }
                $('#id_floor').html(html);
                $('#id_shelf').html('<option value="" >Chọn kệ</option>');
                $('#id_room').html('<option value="" >Chọn phòng</option>');
                   
            });
      }else{
        $('#id_floor').html('<option value="" >Chọn tầng</option>');
        $('#id_shelf').html('<option value="" >Chọn kệ</option>');
        $('#id_room').html('<option value="" >Chọn phòng</option>');
      }
    }

    function getRoom(){
      var id_floor = document.getElementById('id_floor').value;
      if(id_floor!=''){
           $.ajax({
              method: "POST",
              url: "/apis/searcRoomAPI",
              data: { 
                id_floor: id_floor,
            }
            }).done(function( msg ) {
                var html = '<option value="" >Chọn phòng</option>';
                for (let i = 0; i < msg.length; i++) {
                    
                  html += '<option value="'+msg[i].id+'" >'+msg[i].name+'</option>';
                }
                $('#id_room').html(html);

                $('#id_shelf').html('<option value="" >Chọn kệ</option>');
                   
            });
      }else{
        $('#id_shelf').html('<option value="" >Chọn kệ</option>');
        $('#id_room').html('<option value="" >Chọn phòng</option>');
      }
    }

    function getShelf(){
      var id_room = document.getElementById('id_room').value;
      if(id_room!=''){
           $.ajax({
              method: "POST",
              url: "/apis/searcShelfAPI",
              data: { 
                id_room: id_room,
            }
            }).done(function( msg ) {
                var html = '<option value="" >Chọn kệ</option>';
                for (let i = 0; i < msg.length; i++) {
                    
                  html += '<option value="'+msg[i].id+'" >'+msg[i].name+'</option>';
                }
                $('#id_shelf').html(html);
                   
            });
      }else{
        $('#id_shelf').html('<option value="" >Chọn kệ</option>');
      }
    }

</script>


<script type="text/javascript">
    // tìm sản phẩm
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        

        $( "#name_book" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchBookAPI", {
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
                
                $( "#name_book" ).val(ui.item.label);
                $( "#id_book" ).val(ui.item.id);
                //$( "#promotion" ).val(ui.item.discount);
                

                return false;
            }
        });
    });
</script>

<?php include(__DIR__.'/../footer.php'); ?>