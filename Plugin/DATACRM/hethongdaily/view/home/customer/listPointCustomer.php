<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomerAgency">Khách hàng</a> /</span>
    Danh sách điểm xếp hạng khách hàng
  </h4>

  <!-- <p><a href="/editCustomerAgency" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a>  <a href="/addDataCustomerAgency" class="btn btn-danger" ><i class='bx bx-plus'></i> Thêm mới bằng Excel</a></p> -->

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="customer_buy" id="customer_buy" value="<?php if(!empty($_GET['customer_buy'])) echo $_GET['customer_buy'];?>">
            <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>

          

          <div class="col-md-2">
            <label class="form-label">Xếp Hạnh</label>
            <select name="id_rating" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($rating)){
                foreach ($rating as $key => $value) {
                  if(empty($_GET['id_rating']) || $_GET['id_rating']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <!-- <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách điểm xếp hạng khách hàng - <span class="text-danger"><?php echo number_format($totalData);?> khách hàng</span></h5>
    <?php echo @$mess; ?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Hình đại diện</th>
              <th>Thông tin khách </th>
              <th>Điểm</th>
              <th>Xếp Hạng</th>
              <th>Đổi quà</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                // /debug($item);               

                $infoCustomer = @$item->customer->full_name.'<br/>'.@$item->customer->phone;
                if(!empty(@$item->customer->address)) $infoCustomer .= '<br/>'.@$item->customer->address;
                if(!empty(@$item->customer->email)) $infoCustomer .= '<br/>'.@$item->customer->email;
                $infoCustomer .= '<br/>';
                if(!empty(@$item->customer->facebook)) $infoCustomer .= '<br/><a href="'.@@$item->customer->facebook.'" target="_blank"><i class="bx bxl-facebook-circle"></i></a>';
                
                echo '<tr>
                <td>'.@$item->id.'</td>
                <td><img class="img_avatar" src="'.@$item->customer->avatar.'" width="80" height="80" /></td>
                <td>'.$infoCustomer.'</td>
                <td>'.@$item->point.'</td>
                <td>'.@$item->rating->name.'</td>
                <td align="center">
                  <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                    <i class="bx bx-gift me-1"></i>
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
    </div>
    <div id="mobile_view">
      <?php 
         if(!empty($listData)){
              foreach ($listData as $item) {
                
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <center><img class="img_avatar" src="'.@$item->customer->avatar.'" style=" width:50%" /></center><br/>
                        <p><strong> Khách hàng: </strong>: '.@$item->customer->full_name.' </p>
                        <p><strong> Điện thoại: </strong>: '.@$item->customer->phone.'</p>
                        <p><strong> Địa chỉ: </strong>: '.@$item->customer->address.'</p>
                        <p><strong> Đểm: </strong>'.@$item->point.'</p>
                        <p><strong> Xếp hạng: '.@$item->rating->name.'</p>
                          <p align="center"><a class="btn btn-primary mb-3" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                    <i class="bx bx-gift me-1"></i> 
                            </a></p>
                        </div>';
          }
         
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
                </div>';
        }
      ?>
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

    <?php  if(!empty($listData)){
              foreach ($listData as $item) {
                 


               ?>
                        <div class="modal fade" id="basicModal<?php echo $item->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document" style=" max-width: 45rem;">
                            <div class="modal-content">
                              <div class="modal-header form-label border-bottom">
                                <h5 class="modal-title" id="exampleModalLabel1">Thông tin đổi quà tặng </h5>
                                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $item->id; ?>"  name="id">
                                <div class="card-body">
                                  <label class="form-label"> <strong>Thông tin khách hàng </strong></label>
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-6">
                                      
                                        <center><img src="<?php echo  @$item->customer->avatar ?>" style=" width:100%" /></center>
                                    </div>
                                     <div class="col-md-6">
                                        <p><label class="form-label">Khách hàng: </label> <?php echo $item->customer->full_name; ?> </p>
                                        <p><label class="form-label">Điện thoại: </label> <?php echo $item->customer->phone; ?></p>
                                        <p><label class="form-label">Địa chỉ: </label> <?php echo $item->customer->address; ?></p>
                                        <p><label class="form-label">Đểm: </label> <?php echo $item->point; ?></p>
                                        <p><label class="form-label">Xếp hạng: </label> <?php echo $item->rating->name; ?></p>
                                      </div>
                                </div>
                              </div>
                               </div>
                               <div class="row mb-3 card-body">
                                <label class="form-label"> <strong>Quà tặng </strong></label>
                            <?php
                              if(!empty($item->gift)){
                                foreach($item->gift as $key => $value){
                                  

                          
                                  echo '<div class="col-md-4">
                                          <div class="border">
                                        <img src="'.$value->image.'" style=" width:100%; height: 200px" />
                                        <p  class="text-center">'.@$value->name.'</p>
                                        <p  class="text-center">Điểm quy đổi: '.number_format(@$value->point).'đ</p>
                                         <p align="center"> <a class="btn btn-primary mb-3" href="/giveGiftCustomer?id_gift='.$value->id.'&id_customer='.$item->id_customer.'"  onclick="return confirm(\'Bạn có chắc chắn muốn tặng quà '.@$value->name.' cho khách không ?\');">Đổi quà </a></p>
                                    </div>
                                    </div>';
                                }
                              }
                             ?>
                              </div>
                          </div>
                        </div>
                      </div>
                      <?php }} ?>

<script type="text/javascript">
  $(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }

    function extractLast( term ) {
      return split( term ).pop();
    }

    $( "#customer_buy" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
          if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
          }
        })
        .autocomplete({
          source: function( request, response ) {
            $.getJSON( "/apis/searchCustomerAPI", {
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
                
                $( "#customer_buy" ).val(ui.item.full_name);
                $( "#id_customer" ).val(ui.item.id);

                return false;
              }
            });
      });
</script>

<?php include(__DIR__.'/../footer.php'); ?>