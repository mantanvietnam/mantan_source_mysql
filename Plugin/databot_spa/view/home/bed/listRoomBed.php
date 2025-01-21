x`<?php include(__DIR__.'/../header.php'); ?>

<link href='https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Roboto+Slab:400,700|Inconsolata:400,700&subset=latin,cyrillic'
rel='stylesheet' type='text/css'>
<link href="/plugins/databot_spa/view/home/assets/css/jquery.contextMenu.css" rel="stylesheet" type="text/css" />
<script src="/plugins/databot_spa/view/home/assets/js/jquery.contextMenu.min.js" type="text/javascript"></script>
<script src="https://swisnl.github.io/jQuery-contextMenu/js/main.js" type="text/javascript"></script>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Sơ đồ giường</h4>
    <div class="card">
        <?php if(!empty($listData)){ 
                foreach($listData as $key =>$item){ ?>
                    <div class="row diagram">
                        <div style="background-color: #000; color: #fff;" class="col-xs-6 col-md-1 col-sm-2 floors context-menu-three" idRoom="<?php echo $item->id ?>"><?php echo $item->name ?></div>
                            <div class="col-md-11 col-sm-10">
                                <div class="row">
                                    <?php if(!empty($item->bed)){ 
                                            foreach($item->bed as $k =>$bed){ 
                                                $background = '';
                                                $context_menu = 'context-menu-two';
                                                if($bed->status==3){
                                                    $background = 'clear-room-wait';
                                                }elseif($bed->status==1){
                                                    $background = 'clear-room-anti';
                                                    
                                                }elseif($bed->status==2){
                                                    $background = 'clear-room-guests';
                                                    $context_menu = 'context-menu-one';
                                                } ?>
                                            <div class="col-xs-6 col-sm-4 col-md-2 clear-room <?php echo @$background.' '.$context_menu  ?> " idBed="<?php echo $bed->id ?>" nameBed="<?php echo $bed->name ?>">
                                                <div class="customer-name">
                                                    <span class="room-number"><?php echo $bed->name ?></span><br/>
                                                <?php if(!empty($bed->Userservice)){ ?>
                                                       <span class="full-name"><?php echo @$bed->Userservice->customer->name ?></span>
                                                <?php } ?>
                                                </div> 
                                            </div>               
                                  <?php }} ?>      
                                </div>
                            </div>
                    </div>
        <?php }} ?>
    </div>
</div>     

<div id="showCancelRoom" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titleRoomCancel">Hủy Giường</h4>
            </div>
            <div class="modal-body">
                <div class="showMess" id="">
                    <p>Lý do hủy Giường</p>
                    <input type="text" name="noteCancelRoom"  id="noteCancelRoom" value="" class="form-control">
                    <br/>
                    <input type="hidden" name="idBedCancel" value="" id="idBedCancel">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancelRoomProcess();">Xác nhận</button>
            </div>
        </div>
    </div>
</div>               

<style type="text/css">
    .card{
        padding: 30px;
    }
    .diagram {
        vertical-align: middle;
        margin-bottom: 10px;
        height: 100px;
    }
    .diagram .floors {
        font-weight: bold;
        background: #1d2127;
        color: white;
        margin: 1px 0;
        font-size: 18px;
        padding: 0 6px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .diagram .clear-room {
        
        color: white;
        height: 100px;
        margin: 1px;
    }
    .clear-room-guests{
        background: red;
    }
    .clear-room-anti{
        background: seagreen;
    }
    .clear-room-wait{
        background: #8d38aa;
    }
    .customer-name {
        text-align: center;
        margin-top: 3em;
    }

    @media screen and (max-width: 767px){
        .diagram{
            margin-bottom: 20px;
        }
        .diagram .floors{
            margin: 0;
            border: 1px solid white;
                z-index: 1;
        }
        .diagram .clear-room, .diagram .booked, .diagram .un-clear, .diagram .clear-room, .diagram .khachDoan, .diagram .waiting-room{
            margin: 0;
            border: 1px solid white;
        }
    }
    .full-name{
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 1;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
    .modal-header .close {
        position: absolute;
        right: 10px;
        top: 0;
        background-color: transparent;
        border: 0;
        font-size: 20px;
        -webkit-appearance: none;
    }
</style>   

<script type="text/javascript">
    <?php 
        global $urlHomes;
        global $urlCurrent;

        echo 'var urlCheckinBed = "'.$urlHomes.'orderService";';
        echo 'var urlEditBed = "'.$urlHomes.'listBed";';
        echo 'var urlDeleteBed = "'.$urlHomes.'deleteBed";';
        echo 'var listOrder = "'.$urlHomes.'listOrderService";';
        echo 'var urlViewroomdetail = "'.$urlHomes.'infoRoomBed";';
        echo 'var urlCancel = "'.$urlHomes.'apis/cancelBed";';
        echo 'var urlPaid = "'.$urlHomes.'checkoutBed";';
        echo 'var urlAddroom = "'.$urlHomes.'listBed";';
        echo 'var urlEditFloor = "'.$urlHomes.'listRoom";';
        echo 'var urllistOrderCombo = "'.$urlHomes.'listOrderCombo";';
    ?>


    $(function () {
        // lựa chọn giường đã có khách chuột phải
        $.contextMenu({
            selector: '.context-menu-one',
            callback: function (key, options) {
                switch (key) {
                    case 'paid':
                    url = urlPaid + '?idBed=' + options.$trigger.attr("idBed");
                    window.location = url;
                    break;
                    case 'cancel':
                    cancelData(options.$trigger.attr("idBed"),options.$trigger.attr("nameBed"));
                    break;
                    case 'changeroom':
                    changRoom(options.$trigger.attr("idBed"));
                    break;
                    case 'addservice':
                    url = urlAddservice + '?idBed=' + options.$trigger.attr("idBed");
                    window.location = url;
                    break;
                    case 'view':
                    url = urlViewroomdetail + '?idBed=' + options.$trigger.attr("idBed");
                    window.location = url;
                    break;
                    case 'listwaiting':
                    url = listOrder + '?idBed=' + options.$trigger.attr("idBed")+'&status=0';
                    window.location = url;
                    break;
                    case 'edit':
                    url = urlEdit + '?idBed=' + options.$trigger.attr("idBed");
                    window.location = url;
                    break;
                    case 'report':
                    url = urlReport + '?idBed=' + options.$trigger.attr("idBed");
                    window.location = url;
                    break;
                    case 'clear':
                    clearData(options.$trigger.attr("idBed"),options.$trigger.attr("nameroom"),options.$trigger.attr("clearroom"));
                    break;
                    case 'addPrepay':
                    showAddPrepay(options.$trigger.attr("idBed"),options.$trigger.attr("nameroom"));
                    break;
                }
            },
            items: {
                "paid": {name: "Check-out", icon: "quit"},
                "view": {name: "Xem thông tin giường", icon: "paste"},
                "cancel": {name: "Hủy check-in", icon: "delete"},
                "sep1": "---------",
                //"listwaiting": {name: "Danh sách khách chờ", icon: "paste"},
                "edit": {name: "Sửa cài đặt giường", icon: "edit"},
            }
        });
         

        // lựa chọn giường chưa có khách chuột phải
        $.contextMenu({
            selector: '.context-menu-two',
            callback: function (key, options) {
                switch (key) {
                    case 'checkinBed':
                        url = urlCheckinBed + '?idBed=' + options.$trigger.attr("idBed");
                        window.location = url;
                        break;
                    
                    case 'editBed':
                        url = urlEditBed + '?idBed=' + options.$trigger.attr("idBed");
                        window.location = url;
                        break;
                    case 'deleteBed':
                        var confirmDelete = confirm('Bạn có chắc chắn muốn xóa không?');
                        if (confirmDelete == true) {
                            url = urlDeleteBed + '?idBed=' + options.$trigger.attr("idBed");
                            window.location = url;
                        }
                        break;
                    case 'listOrder':
                        url = listOrder + '?idBed=' + options.$trigger.attr("idBed")+'&status=0';
                        window.location = url;
                        break;
                    case 'urllistOrderCombo':
                        url = urllistOrderCombo;
                        window.location = url;
                        break;
                }
            },
            items: {
                "checkinBed": {name: "Nhận khách mới", icon: "add"},
                "urllistOrderCombo": {name: "Danh sách đơn liệu trình", icon: "add"},
                "sep1": "---------",
                "editBed": {name: "Sửa cài đặt giường", icon: "edit"},
                "deleteBed": {name: "Xóa giường", icon: "delete"},
            }
        });


       
        // lựa chọn giường đã có khách chuột trái
        $.contextMenu({
            selector: '.context-menu-one',
            trigger: 'left',
            callback: function (key, options) {
                switch (key) {
                    case 'paid':
                    url = urlPaid + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'cancel':
                    cancelData(options.$trigger.attr("idBed"),options.$trigger.attr("idBed"));
                    break;
                    
                    case 'addservice':
                    url = urlAddservice + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'view':
                    url = urlViewroomdetail + '?idBed=' + options.$trigger.attr("idBed");
                    window.location = url;
                    break;
                    case 'listwaiting':
                    url = listOrder + '?idBed=' + options.$trigger.attr("idBed")+'&status=0';
                    window.location = url;
                    break;
                    case 'edit':
                    url = urlEdit + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'report':
                    url = urlReport + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'clear':
                    clearData(options.$trigger.attr("idroom"),options.$trigger.attr("nameroom"),options.$trigger.attr("clearroom"));
                    break;
                    case 'addPrepay':
                    showAddPrepay(options.$trigger.attr("idroom"),options.$trigger.attr("nameroom"));
                    break;
                }
            },
            items: {
                "paid": {name: "Check-out", icon: "quit"},
                "cancel": {name: "Hủy check-in", icon: "delete"},
                "view": {name: "Xem thông tin giường", icon: "view"},
                "sep1": "---------",
               // "listwaiting": {name: "Danh sách khách chờ", icon: "paste"},
                "edit": {name: "Sửa cài đặt giường", icon: "edit"},
            }
        });

       
        // lựa chọn giường chưa có khách chuột trái
        $.contextMenu({
            selector: '.context-menu-two',
            trigger: 'left',
            callback: function (key, options) {
                switch (key) {
                    case 'checkinBed':
                        url = urlCheckinBed + '?idBed=' + options.$trigger.attr("idBed");
                        window.location = url;
                        break;
                    
                    case 'editBed':
                        url = urlEditBed + '?idBed=' + options.$trigger.attr("idBed");
                        window.location = url;
                        break;
                    case 'deleteBed':
                        var confirmDelete = confirm('Bạn có chắc chắn muốn xóa không?');
                        if (confirmDelete == true) {
                            url = urlDeleteBed + '?idBed=' + options.$trigger.attr("idBed");
                            window.location = url;
                        }
                        break;
                    case 'listOrder':
                        url = listOrder + '?idBed=' + options.$trigger.attr("idBed")+'&status=0';
                        window.location = url;
                        break;
                }
            },
            items: {
                "checkinBed": {name: "Nhận khách mới", icon: "add"},
               // "listOrder": {name: "Danh sách khách chờ", icon: "paste"},
                "sep1": "---------",
                "editBed": {name: "Sửa cài đặt giường", icon: "edit"},
                "deleteBed": {name: "Xóa giường", icon: "delete"},
            }
        });

        // lựa chọn cài đặt phòng chuột phải
        $.contextMenu({
            selector: '.context-menu-three',
            callback: function (key, options) {

                switch (key) {
                    case 'addroom':
                    url = urlAddroom + '?idRoom=' + options.$trigger.attr("idRoom");
                    window.location = url;
                    break;
                    case 'editFloor':
                    url = urlEditFloor + '?idRoom=' + options.$trigger.attr("idRoom");
                    window.location = url;
                    break;
                }
            },
            items: {
                "addroom": {name: "Thêm giường", icon: "add"},
                "editFloor": {name: "Sửa tên phòng", icon: "edit"},
            }
        });

        // lựa chọn cài đặt phòng chuột trái
        $.contextMenu({
            selector: '.context-menu-three',
            trigger: 'left',
            callback: function (key, options) {

                switch (key) {
                    case 'addroom':
                    url = urlAddroom + '?idRoom=' + options.$trigger.attr("idRoom");
                    window.location = url;
                    break;
                    case 'editFloor':
                    url = urlEditFloor + '?idRoom=' + options.$trigger.attr("idRoom");
                    window.location = url;
                    break;
                }
            },
            items: {
                "addroom": {name: "Thêm giường", icon: "add"},
                "editFloor": {name: "Sửa tên phòng", icon: "edit"},
            }
        });
    });

    var fromRoom = "";
    var toRoom = "";
    function changRoom(idRoom)
    {
        fromRoom = idRoom;
        $('#dialog').modal('show');
    }

    function changRoomTo(idRoom)
    {
        toRoom = document.getElementById('selecTo').value;
        if (fromRoom == "")
        {
            $('#textAlert').html("Bạn cần chọn 1 phòng chuyển đi!");
            $('#showAlert').modal('show');
        } else
        {
            if (toRoom == 0 || toRoom == "")
            {
                $('#textAlert').html("Bạn cần chọn 1 phòng chuyển đến!");
                $('#showAlert').modal('show');
            }
        }
        if (fromRoom != "" && toRoom != 0 & toRoom != "")
        {
            $.ajax({
                type: "POST",
                url: urlChangeroom,
                data: {fromRoom: fromRoom, toRoom: toRoom}
            }).done(function (msg) {
                window.location = "<?php echo $urlHomes; ?>/managerHotelDiagram?status=changeRoomDone";
            })
            .fail(function () {
                window.location = "<?php echo $urlHomes; ?>/managerHotelDiagram?status=changeRoomFail";
            });
        }
    }

    function deleteData(idDelete)
    {
        var check = confirm('Bạn có chắc chắn muốn xóa!');
        if (check)
        {
            $.ajax({
                type: "POST",
                url: urlDelete,
                data: {idroom: idDelete}
            }).done(function (msg) {
                window.location = '/managerHotelDiagram?status=deleteRoomDone';
            })
            .fail(function () {
                window.location = '/managerHotelDiagram?status=deleteRoomFail';
            });
        }
    }
    function clearData(idClear,nameClear,clearRoom)
    {
        var request;
        $('#idRoomClear').val(idClear);
        if(clearRoom=='0'){
            $('#textRoomClear').html('Bạn có chắc chắn đã dọn phòng '+nameClear+' ?');
            request= true;
        }else{
            $('#textRoomClear').html('Bạn có chắc chắn phòng '+nameClear+' cần dọn ?');
            request= false;
        }
        $('#requestRoomClear').val(request);

        $('#showClearRoom').modal('show');
    }

    function showAddPrepay(idRoom,nameRoom)
    {
        $('#idRoomPrepay').val(idRoom);
        $('#titleRoomPrepay').html('Tạm ứng tiền phòng '+nameRoom);
        $('#numberPrepay').val('');
        $('#showTamUng').modal('show');
    }

    function showCheckinFast(idRoom,nameRoom,typeRoom)
    {
        $('#formCheckinFast').attr('action', '/managerCheckin?idroom='+idRoom);
        $('#idRoomCheckin').val(idRoom);
        $('#titleRoomCheckin').html('Nhận khách vào phòng '+nameRoom);
        $('#idTypeRoom').val(typeRoom);
        getPrice();
        $('#showCheckinFast').modal('show');
    }

    function addPrepay()
    {
        $('#showTamUng').modal('hide');
        
        var number = $('#numberPrepay').val();
        var idRoom = $('#idRoomPrepay').val();
        var typeCollectionBill = $('#typeCollectionBillPrepay').val();

        if (number != '') {
            var numberText= parseInt(number);
            if(numberText>1000){
                $.ajax({
                    type: "POST",
                    url: urlAddPrepay,
                    data: {idroom: idRoom, number: number, typeCollectionBill:typeCollectionBill}
                }).done(function (msg) {
                    window.location= '/managerHotelDiagram?status=addPrepayDone';
                })
                .fail(function () {
                    window.location= '/managerHotelDiagram?status=addPrepayFail';
                });
            }else{
                $('#textAlert').html('Số tiền tạm ứng cần phải lớn hơn 1.000đ');
                $('#showAlert').modal('show');
            }
        }
    }

    function cancelData(idBed,nameRoom)
    {
        $('#idBedCancel').val(idBed);
        $('#titleRoomCancel').html('Hủy giường '+nameRoom);
        $('#noteCancelRoom').val('');
        $('#showCancelRoom').modal('show');

    }

    function cancelRoomProcess()
    {
        var note = $('#noteCancelRoom').val();
        var idBed = $('#idBedCancel').val();

               

        if(note != ''){
            $.ajax({
                type: "POST",
                url: urlCancel,
                data: {idBed: idBed, note: note}
            }).done(function(msg){
                console.log(msg);
                location.reload();
                // window.location= '/listRoomBed?status=cancelRoomDone';
            })
            .fail(function (){


            });
        }else{
            $('#textAlert').html('Bạn cần nhập lý do hủy phòng');
            $('#showAlert').modal('show');
        }
    }

    function updateDeadlineCheckout(idRoom)
    {
        $('#idRoomGiaHan').val(idRoom);
        $('#showGiaHan').modal('show');
    }

    function notificationCheckout(idRoom){
        $('#idRoomNotificationCheckout').val(idRoom);
        $('#showNotificationCheckout').modal('show');
    }
</script>

<?php include(__DIR__.'/../footer.php'); ?>