<style type="text/css">
/* (A) LIST STYLES */
.slist {
  list-style: none;
  padding: 0;
  margin: 0;
}
.slist li {
  margin: 10px;
  padding: 15px;
  border: 1px solid #dfdfdf;
  background: #f5f5f5;
}

/* (B) DRAG-AND-DROP HINT */
.slist li.hint {
  border: 1px solid #ffc49a;
  background: #feffb4;
}
.slist li.active {
  border: 1px solid #ffa5a5;
  background: #ffe7e7;
}
</style>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt trình đơn</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <div class="row mb-3">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex">
      <select name="id" id="idMenuSelect" class="form-select" style="max-width: 200px;margin-right: 15px;" onchange="changeMenu();">
        <option value="">Chọn trình đơn</option>
        <?php 
        if(!empty($menus)){
          foreach($menus as $item){
            if(empty($_GET['id']) || $_GET['id']!=$item->id){
              echo '<option value="'.$item->id.'">'.$item->value.'</option>';
            }else{
              echo '<option selected value="'.$item->id.'">'.$item->value.'</option>';
            }
          }
        }
        ?>
      </select>
      <button onclick="addNewMenu();" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewMenuModal">Thêm mới</button>
    </div>
  </div>
  <?= $this->Form->create(); ?>
    <div class="row">
      <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Trình đơn hệ thống <i class='bx bx-message-square-add' onclick="popupNew('','','','');"></i></h5>
          </div>
          <div class="card-body">
              <div class="mb-3">
                <table width="100%">
                  <thead>
                    <tr>
                      <td></td>
                      <td width="120"></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Trang chủ</td>
                      <td><button type="button" class="btn btn-outline-dark" onclick="popupNew('Trang chủ','/','','');">Sử dụng</button></td>
                    </tr>
                    <tr>
                      <td>Album ảnh</td>
                      <td><button type="button" class="btn btn-outline-dark" onclick="popupNew('Album ảnh','/albums','','');">Sử dụng</button></td>
                    </tr>
                    <tr>
                      <td>Video</td>
                      <td><button type="button" class="btn btn-outline-dark" onclick="popupNew('Video','/videos','','');">Sử dụng</button></td>
                    </tr>
                    <tr>
                      <td>Bài viết</td>
                      <td><button type="button" class="btn btn-outline-dark" onclick="popupNew('Bài viết','/posts','','');">Sử dụng</button></td>
                    </tr>
                    <tr>
                      <td>Tìm kiếm</td>
                      <td><button type="button" class="btn btn-outline-dark" onclick="popupNew('Tìm kiếm','/search','','');">Sử dụng</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p><b>Chuyên mục tin tức</b></p>
              <div class="mb-3">
                <table width="100%">
                  <thead>
                    <tr>
                      <td></td>
                      <td width="120"></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($category_post)){
                      foreach ($category_post as $key => $value) {
                        echo '<tr>
                                <td>'.$value->name.'</td>
                                <td><button type="button" class="btn btn-outline-dark" onclick="popupNew(\''.$value->name.'\',\'/'.$value->slug.'.html\',\'\',\'\');">Sử dụng</button></td>
                              </tr>';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <p><b>Chuyên mục hình ảnh</b></p>
              <div class="mb-3">
                <table width="100%">
                  <thead>
                    <tr>
                      <td></td>
                      <td width="120"></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($category_album)){
                      foreach ($category_album as $key => $value) {
                        echo '<tr>
                                <td>'.$value->name.'</td>
                                <td><button type="button" class="btn btn-outline-dark" onclick="popupNew(\''.$value->name.'\',\'/'.$value->slug.'.html\',\'\',\'\');">Sử dụng</button></td>
                              </tr>';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <p><b>Chuyên mục video</b></p>
              <div class="mb-3">
                <table width="100%">
                  <thead>
                    <tr>
                      <td></td>
                      <td width="120"></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($category_video)){
                      foreach ($category_video as $key => $value) {
                        echo '<tr>
                                <td>'.$value->name.'</td>
                                <td><button type="button" class="btn btn-outline-dark" onclick="popupNew(\''.$value->name.'\',\'/'.$value->slug.'.html\',\'\',\'\');">Sử dụng</button></td>
                              </tr>';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <p><b>Trang tĩnh</b></p>
              <div class="mb-3">
                <table width="100%">
                  <thead>
                    <tr>
                      <td></td>
                      <td width="120"></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($pages)){
                      foreach ($pages as $key => $value) {
                        echo '<tr>
                                <td>'.$value->title.'</td>
                                <td><button type="button" class="btn btn-outline-dark" onclick="popupNew(\''.$value->title.'\',\'/'.$value->slug.'.html\',\'\',\'\');">Sử dụng</button></td>
                              </tr>';
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <?php 
              global $hookMenusAppearanceMantan;
              
              if(!empty($hookMenusAppearanceMantan)){
                foreach ($hookMenusAppearanceMantan as $components) {
                  echo '<p><b>'.$components['title'].'</b></p>
                          <div class="mb-3">
                            <table width="100%">
                              <thead>
                                <tr>
                                  <td></td>
                                  <td width="120"></td>
                                </tr>
                              </thead>
                              <tbody>';
                                if(!empty($components['sub'])){
                                  foreach ($components['sub'] as $value) {
                                    echo '<tr>
                                            <td>'.$value['name'].'</td>
                                            <td><button type="button" class="btn btn-outline-dark" onclick="popupNew(\''.$value['name'].'\',\''.@$value['url'].'\',\''.@$value['description'].'\',\'\');">Sử dụng</button></td>
                                          </tr>';
                                  }
                                }
                  echo        '</tbody>
                            </table>
                          </div>';
                }
              }
              ?>
          </div>
        </div>
      </div>

      <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0" id="menuUserTitle">Trình đơn người dùng</h5>
          </div>
          <div class="card-body">
              <div class="mb-3">
                <ul id="sortlist">
                  <?php 
                  if(!empty($links)){
                    foreach ($links as $link) {
                      echo '<li data-id="'.$link->id.'" data-idparent="'.$link->id_parent.'"><i class="bx bx-edit" onclick="editLink('.$link->id.',\''.$link->name.'\',\''.$link->link.'\',\''.$link->description.'\',\''.$link->id_parent.'\',\''.$link->weighty.'\');"></i> <a target="_blank" href="'.$link->link.'">'.$link->name.'</a></li>';

                      if(!empty($link->sub)){
                        foreach ($link->sub as $sub) {
                          echo '<li data-id="'.$sub->id.'" data-idparent="'.$sub->id_parent.'">&nbsp;&nbsp;&nbsp;&nbsp;<i class="bx bx-edit" onclick="editLink('.$sub->id.',\''.$sub->name.'\',\''.$sub->link.'\',\''.$sub->description.'\',\''.$sub->id_parent.'\',\''.$sub->weighty.'\');"></i> <a target="_blank" href="'.$sub->link.'">'.$sub->name.'</a></li>';

                          if(!empty($sub->sub)){
                            foreach ($sub->sub as $itemsub) {
                              echo '<li data-id="'.$itemsub->id.'" data-idparent="'.$itemsub->id_parent.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bx bx-edit" onclick="editLink('.$itemsub->id.',\''.$itemsub->name.'\',\''.$itemsub->link.'\',\''.$itemsub->description.'\',\''.$itemsub->id_parent.'\',\''.$itemsub->weighty.'\');"></i> <a target="_blank" href="'.$itemsub->link.'">'.$itemsub->name.'</a></li>';
                            
                              if(!empty($itemsub->sub)){
                                foreach ($itemsub->sub as $item2sub) {
                                  echo '<li data-id="'.$item2sub->id.'" data-idparent="'.$item2sub->id_parent.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bx bx-edit" onclick="editLink('.$item2sub->id.',\''.$item2sub->name.'\',\''.$item2sub->link.'\',\''.$item2sub->description.'\',\''.$item2sub->id_parent.'\',\''.$item2sub->weighty.'\');"></i> <a target="_blank" href="'.$item2sub->link.'">'.$item2sub->name.'</a></li>';
                                
                                  if(!empty($item2sub->sub)){
                                    foreach ($item2sub->sub as $item3sub) {
                                      echo '<li data-id="'.$item3sub->id.'" data-idparent="'.$item3sub->id_parent.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bx bx-edit" onclick="editLink('.$item3sub->id.',\''.$item3sub->name.'\',\''.$item3sub->link.'\',\''.$item3sub->description.'\',\''.$item3sub->id_parent.'\',\''.$item3sub->weighty.'\');"></i> <a target="_blank" href="'.$item3sub->link.'">'.$item3sub->name.'</a></li>';
                                    
                                      if(!empty($item3sub->sub)){
                                        foreach ($item3sub->sub as $item4sub) {
                                          echo '<li data-id="'.$item4sub->id.'" data-idparent="'.$item4sub->id_parent.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bx bx-edit" onclick="editLink('.$item4sub->id.',\''.$item4sub->name.'\',\''.$item4sub->link.'\',\''.$item4sub->description.'\',\''.$item4sub->id_parent.'\',\''.$item4sub->weighty.'\');"></i> <a target="_blank" href="'.$item4sub->link.'">'.$item4sub->name.'</a></li>';
                                        

                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                  ?>
                </ul>
              </div>
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
  var idLinkSelect;
  var idLinkEnd;
  var idparent;

function slist (target) {
  // (A) SET CSS + GET ALL LIST ITEMS
  target.classList.add("slist");
  let items = target.getElementsByTagName("li"), current = null;

  // (B) MAKE ITEMS DRAGGABLE + SORTABLE
  for (let i of items) {
    // (B1) ATTACH DRAGGABLE
    i.draggable = true;

    // (B2) DRAG START - YELLOW HIGHLIGHT DROPZONES (chọn 1 mục)
    i.ondragstart = e => {
      current = i;
      idparent = $(i).data('idparent');
      
      for (let it of items) {
        if (it != current && idparent==$(it).data('idparent')) { 
          it.classList.add("hint"); 
        }else{
          idLinkSelect = $(it).data('id');
          console.log(idLinkSelect);
        }
      }
    };

    // (B3) DRAG ENTER - RED HIGHLIGHT DROPZONE (di chuyển vào 1 mục)
    i.ondragenter = e => {
      if (i != current && idparent==$(i).data('idparent')) { 
        i.classList.add("active"); 
        idLinkEnd = $(i).data('id');
        console.log(idLinkEnd);
      }
    };

    // (B4) DRAG LEAVE - REMOVE RED HIGHLIGHT (di chuyển ra khỏi 1 mục khác)
    i.ondragleave = e => {
      i.classList.remove("active");
      idLinkEnd = '';
      console.log(idLinkEnd);
    };

    // (B5) DRAG END - REMOVE ALL HIGHLIGHTS (thả tay)
    i.ondragend = () => { 
      for (let it of items) {
        it.classList.remove("hint");
        it.classList.remove("active");
      }
    };

    // (B6) DRAG OVER - PREVENT THE DEFAULT "DROP", SO WE CAN DO OUR OWN
    i.ondragover = e => e.preventDefault();

    // (B7) ON DROP - DO SOMETHING
    i.ondrop = e => {
      e.preventDefault();
      if (i != current && idparent==$(i).data('idparent')) {
        /*
        let currentpos = 0, droppedpos = 0;
        
        for (let it=0; it<items.length; it++) {
          if (current == items[it]) { currentpos = it; }
          if (i == items[it]) { droppedpos = it; }
        }
        
        if (currentpos < droppedpos) {
          i.parentNode.insertBefore(current, i.nextSibling);
        } else {
          i.parentNode.insertBefore(current, i);
        }
        */

        console.log('đã thả tay');
        if(idLinkSelect != idLinkEnd){
          $.ajax({
            method: "POST",
            url: "/apis/updateLinkMenu",
            data: { idLinkSelect:idLinkSelect, idLinkEnd:idLinkEnd }
          })
          .done(function( msg ) {
            console.log('lưu dữ liệu thành công');
            location.reload();
          });
        }
      }
    };
  }
}
</script>

<script>
  slist(document.getElementById("sortlist"));
</script>

<!-- Modal -->
<div class="modal fade" id="addNewMenuModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Thông tin trình đơn</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <?= $this->Form->create(); ?>
        <input type="hidden" name="idEdit" id="idEdit" value="">
        <input type="hidden" name="action" id="" value="createMenu">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="name" class="form-label">Tên trình đơn</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="" value="" />
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <input type="checkbox" value="1" id="menuDefault" name="menuDefault"> Chọn làm mặc định
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="addLinkMenuModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Liên kết trình đơn</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <?= $this->Form->create(); ?>
        <input type="hidden" name="idMenu" id="idMenu" value="<?php echo @$menu->id;?>">
        <input type="hidden" name="idLink" id="idLink" value="">
        <input type="hidden" name="action" id="" value="addLink">
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-md-12 mb-3">
              <label for="name" class="form-label">Liên kết cha</label>
              <select name="idParent" id="idParent" class="form-select">
                <option value="0">Chuyên mục gốc</option>
                <?php 
                $weightyMax = 0;
                if(!empty($links)){
                  foreach ($links as $link) {
                    if($link->weighty > $weightyMax) $weightyMax = $link->weighty;
                    echo '<option value="'.$link->id.'">'.$link->name.'</option>';

                    if(!empty($link->sub)){
                      foreach ($link->sub as $sub) {
                        if($sub->weighty > $weightyMax) $weightyMax = $sub->weighty;
                        echo '<option value="'.$sub->id.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$sub->name.'</option>';

                        if(!empty($sub->sub)){
                          foreach ($sub->sub as $itemsub) {
                            if($itemsub->weighty > $weightyMax) $weightyMax = $itemsub->weighty;
                            echo '<option value="'.$itemsub->id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$itemsub->name.'</option>';

                            if(!empty($itemsub->sub)){
                              foreach ($itemsub->sub as $item1sub) {
                                if($item1sub->weighty > $weightyMax) $weightyMax = $item1sub->weighty;
                                echo '<option value="'.$item1sub->id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item1sub->name.'</option>';

                                if(!empty($item1sub->sub)){
                                  foreach ($item1sub->sub as $item2sub) {
                                    if($item2sub->weighty > $weightyMax) $weightyMax = $item2sub->weighty;
                                    echo '<option value="'.$item2sub->id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item2sub->name.'</option>';

                                    if(!empty($item2sub->sub)){
                                      foreach ($item2sub->sub as $item3sub) {
                                        if($item3sub->weighty > $weightyMax) $weightyMax = $item3sub->weighty;
                                        echo '<option value="'.$item3sub->id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item3sub->name.'</option>';

                                        if(!empty($item3sub->sub)){
                                          foreach ($item3sub->sub as $item4sub) {
                                            if($item4sub->weighty > $weightyMax) $weightyMax = $item4sub->weighty;
                                            echo '<option value="'.$item4sub->id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item4sub->name.'</option>';
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
                ?>
              </select>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-12 mb-3">
              <label for="name" class="form-label">Tên liên kết</label>
              <input type="text" id="nameLink" name="nameLink" class="form-control" placeholder="" value="" />
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-12 mb-3">
              <label for="name" class="form-label">Link liên kết</label>
              <input type="text" id="link" name="link" class="form-control" placeholder="" value="" />
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-12 mb-3">
              <label for="name" class="form-label">Mô tả liên kết</label>
              <input type="text" id="desLink" name="desLink" class="form-control" placeholder="" value="" />
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-12 mb-3">
              <label for="name" class="form-label">Độ nặng</label>
              <input type="text" id="weighty" name="weighty" class="form-control" placeholder="" value="" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="" style="width: 100%;">
            <a onclick="return confirm('Bạn có chắc chắn muốn xóa liên kết này không?');" href="" id="linkDelete" class="btn btn-danger" style="float: right;">Xóa</a>
            <button type="submit" class="btn btn-primary" style="float: left;">Lưu</button>
          </div>
        </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  var idMenuEdit = '<?php echo @$menu->id;?>';
  var nameMenuEdit = '<?php echo @$menu->value;?>';
  var weightyMax = <?php echo (int) @$weightyMax+1;?>;
  var menuDefault = <?php echo (int) @$menuDefault;?>;
  
  function addNewMenu()
  {
    $('#idEdit').val('');
    $('#name').val('');
  }

  function editMenu()
  {
    $('#idEdit').val(idMenuEdit);
    $('#name').val(nameMenuEdit);
    $('#menuDefault').val(idMenuEdit);

    if(menuDefault == idMenuEdit){
      $('#menuDefault').attr( 'checked', true );
    }else{
      $('#menuDefault').attr( 'checked', false );
    }

    $('#addNewMenuModal').modal('show');
  }

  function popupNew(name, link, des, idLink)
  {
    if(idMenuEdit!=''){
      $('#nameLink').val(name);
      $('#link').val(link);
      $('#desLink').val(des);
      $('#idParent').val(0);
      $('#idLink').val(idLink);
      $('#weighty').val(weightyMax);

      $('#linkDelete').attr('href','');
      $('#linkDelete').hide();

      $('#addLinkMenuModal').modal('show');
    }else{
      alert('Bạn cần Thêm mới trình đơn trước khi thêm liên kết');
    }
  }

  function editLink(id, name, link, description, id_parent, weighty)
  {
    $('#nameLink').val(name);
    $('#link').val(link);
    $('#desLink').val(description);
    $('#idParent').val(id_parent);
    $('#idLink').val(id);
    $('#weighty').val(weighty);
    
    $('#linkDelete').attr('href','/menus/delete/?id='+id);
    $('#linkDelete').show();

    $('#addLinkMenuModal').modal('show');
  }

  function changeMenu()
  {
    var idMenuSelect = $('#idMenuSelect').val();

    if(idMenuSelect!=''){
      window.location = '/options/menus/?id='+idMenuSelect;
    }
  }

  if(nameMenuEdit!=''){
    $('#menuUserTitle').html('Trình đơn người dùng: <b>'+nameMenuEdit+'</b> <i class="bx bx-edit" onclick="editMenu();"></i>');
  }
</script>