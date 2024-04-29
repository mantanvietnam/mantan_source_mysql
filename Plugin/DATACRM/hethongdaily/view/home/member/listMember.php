<?php include(__DIR__.'/../header.php'); ?>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.16/jstree.min.js" integrity="sha512-ekwRoEshEqHU64D4luhOv/WNmhml94P8X5LnZd9FNOiOfSKgkY12cDFz3ZC6Ws+7wjMPQ4bPf94d+zZ3cOjlig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.16/themes/default/style.min.css" integrity="sha512-A5OJVuNqxRragmJeYTW19bnw9M2WyxoshScX/rGTgZYj5hRXuqwZ+1AVn2d6wYTZPzPXxDeAGlae0XwTQdXjQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Hệ thống tuyến dưới</h4>

  <?php 
  if($session->read('infoUser')->create_agency == 'active'){
    echo '<p><a href="/addMember" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>';
  }
  ?>

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách hệ thống tuyến dưới</h5>
    
    <div class="card-body row">
      <form id="" action="" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12 agency-list">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                <div class="input-group">
                                    <input type="text" name="search_input" class="form-control search-input" id="agency_search_input" style="border: solid 1px;" value="" placeholder="Tìm kiếm ...">
                                    <span class="input-group-btn">
                                        <button type="button" id="agency_search_btn" class="btn btn-primary" style="color: white;">
                                            <i class='bx bx-search-alt-2'></i>

                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        
                        <div class="dai_ly">
                            <div class="" id="treeview_json"></div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-7 col-sm-12 col-xs-12 agency-info">
                <div class="x_panel form-horizontal" id="agency_info">

                    <div class="x_content" id="infoAgency"><?php echo $mess;?></div>
                </div>
            </div>
        </div>
    </form>
      
    </div>
  </div>
  <!--/ Responsive Table -->
</div>

<div class="modal fade" id="popupPayFees"  name="popupPayFees">         
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Đóng phí duy trì tài khoản</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
     
      <div class="modal-body mb-3">
        <input type="hidden" value="" name="idMember" id="idMember">

        <div class="row">
            <div class="col-md-12 mt-3 mb-3 text-center">
                <input value="199000" type="radio" name="money" checked> 1 năm - 199k &nbsp;&nbsp;
                <input value="299000" type="radio" name="money" > 2 năm - 299k &nbsp;&nbsp;
                <input value="499000" type="radio" name="money" > 5 năm - 499k &nbsp;&nbsp;
            </div>

            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary" onclick="showQRCode();">Đóng phí</button>
            </div>
        </div>
      </div>
     
      
    </div>
  </div>
</div>

<div class="modal fade" id="popupQRCode"  name="popupQRCode">         
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Quét mã QR để thanh toán</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
     
      <div class="modal-body mb-3">
        <div class="row">
            <div class="col-md-12 mt-3 mb-3 text-center">
                <img src="/plugins/hethongdaily/view/home/assets/img/loading.gif" id="qrCode" width="250" />
            </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="popupVerify"  name="popupVerify">         
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Nhập mã xác thực</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
        
      <form action="/verifyMember" method="post">
          <div class="modal-body mb-3">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3 text-center">
                    <p>Mã xác thực được gửi về Zalo của thành viên</p>
                    <input required type="number" name="otp" class="form-control" placeholder="Nhập mã xác thực vào đây" />
                    
                    <input type="hidden" value="" name="idMemberVerify" id="idMemberVerify">
                    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />

                    <p><a href="javascript:void(0);" onclick="resendOTP();">Gửi lại mã xác thực</a></p>
                </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Kích hoạt</button>
          </div>
      </form>
    </div>
  </div>
</div>

<style type="text/css" media="screen">

</style>

<script type="text/javascript">
    var dataAgency;
    var infoAgency;
    
    function loadAgency(idAgency)
    {
        $('#infoAgency').html('');

        $.ajax({
            method: "POST",
            url: "/apis/getInfoMemberAPI",
            data: { id: idAgency }
        })
        .done(function( msg ) {
            dataAgency = msg.data;

            var dateCreate = new Date(dataAgency.created_at*1000).toLocaleString();
            var dateDealine = new Date(dataAgency.deadline*1000).toLocaleString();
            var status, payFees, verify, edit;
            var linkProfile = '<?php global $urlHomes; echo $urlHomes;?>info/?id=';
            var create_agency = '<?php echo $session->read('infoUser')->create_agency;?>';
            var create_order_agency = '<?php echo $session->read('infoUser')->create_order_agency;?>';

            edit = '';

            if(create_agency == 'active'){
                edit += ' <a href="/addMember/?id='+dataAgency.id+'" class="btn btn-danger mb-3">Sửa thông tin</a>';

                edit += ' <a href="/addMember/?id_father='+dataAgency.id+'" class="btn btn-primary  mb-3">Thêm tuyến dưới</a> ';
            }

            if(create_order_agency == '1'){
                edit += ' <a href="/addOrderAgency/?id_member_buy='+dataAgency.id+'" class="btn btn-primary  mb-3">Tạo đơn hàng</a> ';

                edit += ' <a href="/viewWarehouseProductAgency/?id_member='+dataAgency.id+'" class="btn btn-warning  mb-3">Xem tồn kho</a> ';
            }

            if(dataAgency.status == 'active'){
                status = '<div style="margin-top: 10px;margin-bottom: 10px;" class=""><a href="/updateStatusMember?id='+dataAgency.id+'&status=lock" class="btn btn-danger width-100  mb-3"><i class="fa fa-trash-o"></i>Khóa tài khoản</a> '+edit+'</div>';
            }else{
                payFees = '<button type="button" class="btn btn-danger" onclick="popupPayFees('+dataAgency.id+')">Đóng phí</button>';
                payFees = '';

                status = '<div style="margin-top: 10px;margin-bottom: 10px;" class=""><a href="/updateStatusMember?id='+dataAgency.id+'&status=active" class="btn btn-primary width-100  mb-3"><i class="fa fa-trash-o"></i>Kích hoạt tài khoản</a> '+payFees+' '+edit+'</div>';
            }

            if(dataAgency.verify == 'lock'){
                status = '<div style="margin-top: 10px;margin-bottom: 10px;" class=""><button type="button" class="btn btn-danger" onclick="popupVerify('+dataAgency.id+')">Xác thực tài khoản</button> '+edit+'</div>';

                verify = '<span class="text-danger">Chưa xác thực</span>';
            }else{
                verify = '<span class="text-success">Đã xác thực</span>';
            }

            var facebook = '';
            if(dataAgency.facebook != ''){
                facebook = ' <a target="_blank" href="'+dataAgency.facebook+'"><i class="bx bxl-facebook-circle"></i></a>';
            }

            var youtube = '';
            if(dataAgency.youtube != ''){
                youtube = ' <a target="_blank" href="'+dataAgency.youtube+'"><i class="bx bxl-youtube" ></i></a>';
            }

            var twitter = '';
            if(dataAgency.twitter != ''){
                twitter = ' <a target="_blank" href="'+dataAgency.twitter+'"><i class="bx bxl-twitter" ></i></a>';
            }

            var tiktok = '';
            if(dataAgency.tiktok != ''){
                tiktok = ' <a target="_blank" href="'+dataAgency.tiktok+'"><i class="bx bxl-tiktok" ></i></a>';
            }

            var web = '';
            if(dataAgency.web != ''){
                web = ' <a target="_blank" href="'+dataAgency.web+'"><i class="bx bxl-wordpress" ></i></a>';
            }

            var instagram = '';
            if(dataAgency.instagram != ''){
                instagram = ' <a target="_blank" href="'+dataAgency.instagram+'"><i class="bx bxl-instagram" ></i></a>';
            }

            var linkedin = '';
            if(dataAgency.linkedin != ''){
                linkedin = ' <a target="_blank" href="'+dataAgency.linkedin+'"><i class="bx bxl-linkedin-square" ></i></a>';
            }

            var zalo = '';
            if(dataAgency.zalo != ''){
                zalo = ' <a target="_blank" href="'+dataAgency.zalo+'"><i class="bx bx-alarm-snooze"></i></a>';
            }

            infoAgency= '<div id="infoManagerDown showDesktop" style="margin-top: 10px;margin-bottom: 10px;">\
                            <h2 class="text-center">Thông tin tài khoản</h2>\
                        </div>\
                        <div class="row">\
                            <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                <img src="'+dataAgency.avatar+'" class="img-fluid" />\
                            </div>\
                            <div class="text-right col-md-9 col-sm-9 col-xs-12">\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>ID:</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dataAgency.id+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Họ tên:</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dataAgency.name+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Chức danh:</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dataAgency.name_position+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12"><b>Điện thoại:</b></div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dataAgency.phone+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12"><b>Email:</b></div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dataAgency.email+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12"><b>Địa chỉ:</b></div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dataAgency.address+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12"><b>Ngày tạo:</b></div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dateCreate+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Xác thực:</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+verify+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Ngày sinh:</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+dataAgency.birthday+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="mb-3 col-md-12 col-sm-12 col-xs-12">'+facebook+youtube+twitter+tiktok+web+instagram+linkedin+zalo+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-12 col-sm-12 col-xs-12">\
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='+linkProfile+dataAgency.id+'" width="100"/>\
                                    </div>\
                                </div>\
                                '+status+'\
                            </div>\
                        </div>';
            
            $('#infoAgency').html(infoAgency);

        });
}
</script>

<script>
    var jsonTreeData = [
    <?php
    function showTreeSub($listSub)
    {
        if(!empty($listSub)){
            foreach($listSub as $data){
                echo '{  
                    "id":"'.$data->id.'",
                    "name":"'.$data->name.' - '.$data->phone.'",
                    "text":"'.$data->name.' - '.$data->phone.'",
                    "parent_id":"'.$data->id_father.'",
                    "children":[';
                    if(!empty($data->agentSystem)) showTreeSub($data->agentSystem);
                    echo    '],
                    "data":{  

                    },
                    "a_attr":{  
                        "href":"#",
                        "onclick":"loadAgency(\''.$data->id.'\')"
                    },
                    ';
                    if($data->status=='lock'){
                        echo '"li_attr":{  
                                    "class":"text-danger"
                                }';
                    }else{
                        if($data->verify=='lock'){
                            echo '"li_attr":{  
                                        "class":"text-warning"
                                    }';
                        }
                    }

                echo '},';
            }
        }
    }

    showTreeSub($listData);

    ?>
    ];
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#treeview_json').jstree({
            'core' : {
                'data' : jsonTreeData
            },
            "search": {
                "case_insensitive": false,
                "show_only_matches" : true
            },
            plugins: ["search"]
        }).bind("select_node.jstree", function (e, data) {
            var href = data.node.a_attr.href;
            var parentId = data.node.a_attr.parent_id;
            if(href == '#')
                return '';

            window.open(href);

        });
        $('#treeview_json').slimScroll({
            height: '400px'
        });
        $('#search').keyup(function(){
            $('#treeview_json').jstree('search', $(this).val());
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".search-input").keyup(function () {
            var searchString = $(this).val();
            $('#treeview_json').jstree('search', searchString);
        });
    });
</script>

<script type="text/javascript">
    function popupPayFees(idMember)
    {
        $('#idMember').val(idMember);
        $('#popupPayFees').modal('show');
    }

    function showQRCode()
    {
        var idMember = $('#idMember').val();
        var money = $('input[name="money"]:checked').val();

        $('#qrCode').attr("src","https://img.vietqr.io/image/TPB-06931228686-compact2.png?amount="+money+"&addInfo=UYTIN "+idMember+"&accountName=Tran Ngoc Manh");

        $('#popupPayFees').modal('hide');
        $('#popupQRCode').modal('show');
    }

    function popupVerify(idMember)
    {
        $('#idMemberVerify').val(idMember);
        $('#popupVerify').modal('show');
    }

    function resendOTP()
    {
        var idMember = $('#idMemberVerify').val();

        if(idMember!=''){
            $.ajax({
                method: "POST",
                url: "/apis/resendOTPAPI",
                data: { id: idMember }
            })
            .done(function( msg ) {
                console.log(msg);

                alert('Đã gửi lại mã xác thực');
            });
        }
    }
</script>

<?php include(__DIR__.'/../footer.php'); ?>