<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listBuilding">Kho sách</a> /</span>
    nhập sánh vào kho 
  </h4>
  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-12">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Thông tin tòa nhà</h5>
        </div>
        <div class="card-body">
          <p><?php echo @$mess;?></p>
          <form enctype="multipart/form-data" method="post" action="">
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
            <div class="row">
              <div class="col-md-6 mb-4">
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
            <div class="col-md-6 mb-4">
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
            <div class="col-md-6 mb-4">
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
            <div class="col-md-6 mb-4">
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

            <div class="col-md-6 mb-4">
              <label class="form-label">tên sách</label>
              <input type="text" class="form-control" name="name_book" id="name_book" value="<?php if(!empty($_GET['name_book'])) echo $_GET['name_book'];?>">
              <input type="hidden" class="form-control" name="id_book" id="id_book" value="<?php if(!empty($_GET['id_book'])) echo $_GET['id_book'];?>">
            </div>
          </div>

          <button type="submit" class="btn btn-primary" style="width: 70px;">Lưu</button>
        </form>
      </div>
    </div>
  </div>

</div>
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