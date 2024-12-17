<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWarehouse">Kho sách</a> /</span>
       <?php echo $type ?>
  </h4>
  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-12">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Thông tin <?php echo $to ?> sách</h5>
        </div>
        <div class="card-body">
          <p><?php echo @$mess;?></p>
          <form enctype="multipart/form-data" method="post" action="">
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
            <div class="row">
              <div class="col-md-3 mb-4">
              <label class="form-label">Tên tòa nhà</label>
              <select class="form-select" name="id_building" id="id_building" onclick="getfloor()" <?php echo $disabled ?>>
                <?php if(!empty($dataBuilding)){
                  foreach ($dataBuilding as $key => $item){
                    $selected = '';
                    if(!empty($data->id_building) && $data->id_building==$item->id){
                      $selected = 'selected';
                    }

                    echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                  }
                } ?>
              </select>
            </div>
            <div class="col-md-3 mb-4">
              <label class="form-label">Tên tầng</label>
              <select class="form-select" name="id_floor" id="id_floor" onclick="getRoom()"  <?php echo $disabled ?>>
                <option value="" >Chọn tầng</option>
                <?php if(!empty($dataFloor)){
                  foreach ($dataFloor as $key => $item){
                    $selected = '';
                    if(!empty($data->id_floor) && $data->id_floor==$item->id){
                      $selected = 'selected';
                    }

                    echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                  } 
                } ?>
              </select>
            </div>
            <div class="col-md-3 mb-4">
              <label class="form-label">Tên phòng</label>
              <select class="form-select" name="id_room" id="id_room" onclick="getShelf()"  <?php echo $disabled ?>>
                <option value="" >Chọn phòng</option>
                <?php if(!empty($dataRoom)){
                  foreach ($dataRoom as $key => $item){
                    $selected = '';
                    if(!empty($data->id_room) && $data->id_room==$item->id){
                      $selected = 'selected';
                    }

                    echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                  } 
                } ?>
              </select>
            </div>
            <div class="col-md-3 mb-4">
              <label class="form-label">Tên kệ</label>
              <select class="form-select" name="id_shelf" id="id_shelf"  <?php echo $disabled ?> >
                <option value="" >Chọn kệ</option>
                <?php if(!empty($dataShelf)){
                  foreach ($dataShelf as $key => $item){
                    $selected = '';
                    if(!empty($data->id_shelf) && $data->id_shelf==$item->id){
                      $selected = 'selected';
                    }

                    echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                  } 
                } ?>
              </select>
            </div>

            <div class="col-md-6 mb-4">
              <label class="form-label">tên sách</label>
              <input type="text" class="form-control book-search" name="name_book" id="name_book" value="<?php if(!empty($data->book->name)) echo $data->book->name;?>"  <?php echo @$disabled ?>>
              <input type="hidden" class="form-control" name="id_book" id="id_book" value="<?php if(!empty($data->id_book)) echo $data->id_book;?>">
               <div id="customer-search-results" class="search-results" 
                                style="position: absolute; z-index: 1000; width: 37%; background: white; border: 1px solid #ddd; max-height: 200px; overflow-y: auto; display: none;">
                                </div>
            </div>
            <?php if(!empty($_GET['id'])){ ?>
            <div class="col-md-3 mb-4">
              <label class="form-label">Tổng số lượng</label>
              <input type="number" class="form-control" name="" id="" value="<?php echo @$data->quantity;?>" disabled="">
            </div>
            <div class="col-md-3 mb-4">
              <label class="form-label">Số lượng đang cho mượn</label>
              <input type="number" class="form-control" name="quantity_borrow" id="quantity_borrow" value="<?php echo @$data->quantity_borrow;?>" disabled="">
            </div>
            <div class="col-md-3 mb-4">
              <label class="form-label">Số lượng còn trong kho</label>
              <input type="number" class="form-control" name="quantity_warehous" id="quantity_warehous" value="<?php echo @$data->quantity_warehous;?>" disabled="">
            </div>
          <?php } ?>
            <div class="col-md-3 mb-4">
              <label class="form-label">Số lượng <?php echo $type ?></label>
              <input type="number" class="form-control" name="quantity" id="quantity" value="0" required="">
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
    // $(function() {
    //     function split( val ) {
    //       return val.split( /,\s*/ );
    //     }

    //     function extractLast( term ) {
    //       return split( term ).pop();
    //     }

        

    //     $( "#name_book" )
    //     // don't navigate away from the field on tab when selecting an item
    //     .bind( "keydown", function( event ) {
    //         if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
    //             event.preventDefault();
    //         }
    //     })
    //     .autocomplete({
    //         source: function( request, response ) {
    //             $.getJSON( "/apis/searchBookAPI", {
    //                 term: extractLast( request.term )
    //             }, response );
    //         },
    //         search: function() {
    //             // custom minLength
    //             var term = extractLast( this.value );

    //             if ( term.length < 2 ) {
    //                 return false;
    //             }
    //         },
    //         focus: function() {
    //             // prevent value inserted on focus
    //             return false;
    //         },
    //         select: function( event, ui ) {
    //             var terms = split( this.value );
    //             // remove the current input
    //             terms.pop();
    //             // add the selected item
    //             terms.push( ui.item.label );
                
    //             $( "#name_book" ).val(ui.item.label);
    //             $( "#id_book" ).val(ui.item.id);
    //             //$( "#promotion" ).val(ui.item.discount);
                

    //             return false;
    //         }
    //     });
    // });

     $(document).on("input", ".book-search", function () {
            let searchInput = $(this);
            let searchQuery = searchInput.val();
            let resultBox = searchInput.siblings(".search-results");
            let id_building = $("#id_building").val();

            if (!id_building) {
                alert("Vui lòng chọn tòa nhà trước khi tìm sách.");
                return;
            }

            if (searchQuery.length >= 2) {
                $.ajax({
                    url: "/apis/searchBookAPI",
                    method: "GET",
                    data: { term: searchQuery, id_building: id_building },
                    success: function (response) {
                      console.log(response);
                        let resultHTML = "";
                        if (response && response.length > 0) {
                            response.forEach(function (book) {
                               if(book.id_shelf ==0){
                                  resultHTML += `
                                      <div class="search-item book-item" 
                                          data-id="${book.id}" 
                                          data-name="${book.name}">
                                          ${book.label}
                                      </div>`;
                                  }
                            });
                        } else {
                            resultHTML = '<div class="search-item disabled">Không tìm thấy sách</div>';
                        }
                        resultBox.html(resultHTML).show();
                    },
                    error: function () {
                        resultBox.html('<div class="search-item disabled">Lỗi khi tìm kiếm</div>').show();
                    },
                });
            } else {
                resultBox.hide();
            }
        });

     $(document).on("click", ".book-item:not(.disabled)", function () {
            $( "#name_book" ).val($(this).data("name"));
            $( "#id_book" ).val($(this).data("id"));
            document.getElementById("customer-search-results").style.display = "none";
        });
</script>


<?php include(__DIR__.'/../footer.php'); ?>