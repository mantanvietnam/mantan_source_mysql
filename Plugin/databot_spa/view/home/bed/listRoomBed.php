<?php include(__DIR__.'/../header.php'); ?>

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
                                            foreach($item->bed as $k =>$bed){ ?>
                                            <div class="col-xs-6 col-sm-4 col-md-2 clear-room context-menu-two" idBed="<?php echo $bed->id ?>" nameBed="<?php echo $bed->name ?>">
                                            <div class="customer-name"><span class="room-number"><?php echo $bed->name ?></span></div>
                                            </div>                
                                  <?php }} ?>      
                                </div>
                            </div>
                    </div>
        <?php }} ?>
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
        background: seagreen;
        color: white;
        height: 100px;
        margin: 1px;
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
</style>   

<script type="text/javascript">
    <?php 
        global $urlHomes;
        global $urlCurrent;

        echo 'var urlCheckinBed = "'.$urlHomes.'/checkinBed";';
        echo 'var urlEditBed = "'.$urlHomes.'/listBed";';
        echo 'var urlDeleteBed = "'.$urlHomes.'/deleteBed";';
        echo 'var listOrder = "'.$urlHomes.'/listOrder";';
    ?>

    $(function () {
        // lựa chọn giường đã có khách chuột phải
        $.contextMenu({
            selector: '.context-menu-one',
            callback: function (key, options) {
                switch (key) {
                    case 'paid':
                    url = urlPaid + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'cancel':
                    cancelData(options.$trigger.attr("idroom"),options.$trigger.attr("nameroom"));
                    break;
                    case 'changeroom':
                    changRoom(options.$trigger.attr("idroom"));
                    break;
                    case 'addservice':
                    url = urlAddservice + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'view':
                    url = urlViewroomdetail + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'listwaiting':
                    url = urlListwaiting + '?idroom=' + options.$trigger.attr("idroom");
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
                "paid": {name: "Trả phòng", icon: "checkout"},
                "cancel": {name: "Hủy checkin", icon: "delete"},
                "changeroom": {name: "Chuyển phòng", icon: "change"},
                "addservice": {name: "Thêm Hàng hóa", icon: "add"},
                "addPrepay": {name: "Thêm tiền tạm ứng", icon: "add"},
                "view": {name: "Xem thông tin phòng", icon: "view"},
                "clear": {name: "Báo dọn phòng", icon: "edit"},
                "report": {name: "Báo hỏng", icon: "edit"},
                "sep1": "---------",
                "listwaiting": {name: "Danh sách khách chờ", icon: "list"},
                "edit": {name: "Sửa cài đặt phòng", icon: "edit"},
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
                        url = urlDeleteBed + '?idBed=' + options.$trigger.attr("idBed");
                        window.location = url;
                        break;
                    case 'listOrder':
                        url = listOrder + '?idBed=' + options.$trigger.attr("idBed");
                        window.location = url;
                        break;
                }
            },
            items: {
                "checkinBed": {name: "Nhận khách", icon: "received"},
                "sep1": "---------",
                "editBed": {name: "Sửa cài đặt giường", icon: "edit"},
                "listOrder": {name: "Danh sách khách chờ", icon: "list"},
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
                    cancelData(options.$trigger.attr("idroom"),options.$trigger.attr("nameroom"));
                    break;
                    case 'changeroom':
                    changRoom(options.$trigger.attr("idroom"));
                    break;
                    case 'addservice':
                    url = urlAddservice + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'view':
                    url = urlViewroomdetail + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'listwaiting':
                    url = urlListwaiting + '?idroom=' + options.$trigger.attr("idroom");
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
                "paid": {name: "Trả phòng", icon: "checkout"},
                "cancel": {name: "Hủy checkin", icon: "delete"},
                "changeroom": {name: "Chuyển phòng", icon: "change"},
                "addservice": {name: "Thêm Hàng hóa", icon: "add"},
                "addPrepay": {name: "Thêm tiền tạm ứng", icon: "add"},
                "view": {name: "Xem thông tin phòng", icon: "view"},
                "clear": {name: "Báo dọn phòng", icon: "edit"},
                "report": {name: "Báo hỏng", icon: "edit"},
                "sep1": "---------",
                "listwaiting": {name: "Danh sách khách chờ", icon: "list"},
                "edit": {name: "Sửa cài đặt phòng", icon: "edit"},
            }
        });

       
        // lựa chọn giường chưa có khách chuột trái
        $.contextMenu({
            selector: '.context-menu-two',
            trigger: 'left',
            callback: function (key, options) {
                switch (key) {
                    case 'received':
                    url = urlReceived + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'listwaiting':
                    url = urlListwaiting + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'edit':
                    url = urlEdit + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'delete':
                    deleteData(options.$trigger.attr("idroom"));
                    break;
                    case 'report':
                    url = urlReport + '?idroom=' + options.$trigger.attr("idroom");
                    window.location = url;
                    break;
                    case 'clear':
                    clearData(options.$trigger.attr("idroom"),options.$trigger.attr("nameroom"),options.$trigger.attr("clearroom"));
                    break;
                    case 'receivedFast':
                    showCheckinFast(options.$trigger.attr("idroom"),options.$trigger.attr("nameroom"),options.$trigger.attr("typeroom"));
                    break;
                }
            },
            items: {
               // "receivedFast": {name: "Nhận phòng nhanh", icon: "received"},
                "received": {name: "Nhận phòng", icon: "received"},
                "listwaiting": {name: "Danh sách khách chờ", icon: "list"},
                "clear": {name: "Báo dọn phòng", icon: "edit"},
                "report": {name: "Báo hỏng", icon: "edit"},
                "sep1": "---------",
                "edit": {name: "Sửa cài đặt phòng", icon: "edit"},
                "delete": {name: "Xóa phòng", icon: "delete"},
            }
        });

        // lựa chọn cài đặt phòng chuột phải
        $.contextMenu({
            selector: '.context-menu-three',
            callback: function (key, options) {

                switch (key) {
                    case 'addroom':
                    url = urlAddroom + '?idFloor=' + options.$trigger.attr("idFloor");
                    window.location = url;
                    break;
                    case 'editFloor':
                    url = urlEditFloor + '?idFloor=' + options.$trigger.attr("idFloor");
                    window.location = url;
                    break;
                }
            },
            items: {
                "addroom": {name: "Thêm phòng", icon: "add"},
                "editFloor": {name: "Sửa tên tầng", icon: "edit"},
            }
        });

        // lựa chọn cài đặt phòng chuột trái
        $.contextMenu({
            selector: '.context-menu-three',
            trigger: 'left',
            callback: function (key, options) {

                switch (key) {
                    case 'addroom':
                    url = urlAddroom + '?idFloor=' + options.$trigger.attr("idFloor");
                    window.location = url;
                    break;
                    case 'editFloor':
                    url = urlEditFloor + '?idFloor=' + options.$trigger.attr("idFloor");
                    window.location = url;
                    break;
                }
            },
            items: {
                "addroom": {name: "Thêm phòng", icon: "add"},
                "editFloor": {name: "Sửa tên tầng", icon: "edit"},
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

    function cancelData(idRoom,nameRoom)
    {
        $('#idRoomCancel').val(idRoom);
        $('#titleRoomCancel').html('Hủy phòng '+nameRoom);
        $('#noteCancelRoom').val('');
        $('#showCancelRoom').modal('show');

    }

    function cancelRoomProcess()
    {
        var note = $('#noteCancelRoom').val();
        var idRoom = $('#idRoomCancel').val();

        if (note != '') {
            $.ajax({
                type: "POST",
                url: urlCancel,
                data: {idroom: idRoom, note: note}
            }).done(function (msg) {
                window.location= '/managerHotelDiagram?status=cancelRoomDone';
            })
            .fail(function () {
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