<?php include(__DIR__.'/../header.php'); ?>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.16/jstree.min.js" integrity="sha512-ekwRoEshEqHU64D4luhOv/WNmhml94P8X5LnZd9FNOiOfSKgkY12cDFz3ZC6Ws+7wjMPQ4bPf94d+zZ3cOjlig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.16/themes/default/style.min.css" integrity="sha512-A5OJVuNqxRragmJeYTW19bnw9M2WyxoshScX/rGTgZYj5hRXuqwZ+1AVn2d6wYTZPzPXxDeAGlae0XwTQdXjQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cộng tác viên</h4>
 <p><a href="/addAffiliaterAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->

  <div class="card">
    <h5 class="card-header">Danh sách cộng tác viên</h5>
    <?php echo @$mess;?>
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
                                        <button type="button" id="agency_search_btn" class="btn btn-primary" style="color: white;z-index: 1;">
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

                    <div class="x_content" id="infoAgency"></div>
                </div>
            </div>
        </div>
    </form>
      
    </div>
  </div>
  <!--/ Responsive Table -->
</div>


<script type="text/javascript">
    var dataAgency;
    var infoAgency;
    
    function loadAgency(idAgency,percent,level)
    {
        $('#infoAgency').html('');
         console.log(level);
            console.log(percent);

        $.ajax({
            method: "POST",
            url: "/apis/getAffiliaterAPI",
            data: { id: idAgency }
        })
        .done(function( msg ) {
            dataAgency = msg.data;

           

            var number_order = dataAgency.number_order;
            var money_back = formatNumberWithCommas(dataAgency.money_back);

             console.log(dataAgency);

            var aff = '';
            if(dataAgency.aff != null){
                aff =   dataAgency.aff.name+' '+dataAgency.aff.phone;
            }
           
            // var dateCreate = new Date(dataAgency.created_at*1000).toLocaleString();
             var link_aff = '<?php echo $urlHomes ?>/book-online/?aff='+dataAgency.phone;

            infoAgency= '<div id="infoManagerDown showDesktop" style="margin-top: 10px;margin-bottom: 10px;">\
                            <h2 class="text-center">Thông tin cộng tác viên</h2>\
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
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Người gới tiệu  :</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+aff+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Đơn hàng :</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12"> <a href="/orderCustomerAgency/?id_aff='+dataAgency.id+'">Đã bán được '+number_order+' đơn hàng</a></div>\
                                </div>\
                                 <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Công nợ :</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12"> <a href="/listTransactionAffiliaterAgency?id_affiliater='+dataAgency.id+'">'+money_back+'đ</a></div>\
                                </div>\
                                 <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Cấp đội:</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+level+'</div>\
                                </div>\
                                <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Hoa hồng chiết khấu :</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12">'+percent+'%</div>\
                                </div>\
                                 <div class="row">\
                                    <div class="text-right col-md-3 col-sm-3 col-xs-12">\
                                        <b>Link chia sẻ :</b>\
                                    </div>\
                                    <div class="col-md-9 col-sm-9 col-xs-12"><a target="_blank" href="'+link_aff+'">'+link_aff+'</a></div>\
                                </div>\
                                 <div class="row">\
                                    <div class="text-right col-md-12 col-sm-12 col-xs-12">\
                                      <a class="btn btn-primary  mb-3" href="/addAffiliaterAgency?id='+dataAgency.id+'">Sửa</a>\
                                       <a class="btn btn-danger mb-3" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="deleteAffiliaterAgency/?id='+dataAgency.id+'">Xóa</a>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>';
            $('#infoAgency').html(infoAgency);

        });
}



 function formatNumberWithCommas(number) {
                // Sử dụng toLocaleString để thực hiện định dạng số với dấu phẩy
                return number.toLocaleString('en-US');
            }
</script>
<script>
    var jsonTreeData = [
    <?php
    function showAffiliaterSub($listSub)
    {
        if(!empty($listSub)){
            foreach($listSub as $data){
                echo '{  
                    "id":"'.$data->id.'",
                    "name":"'.$data->name.' - '.$data->phone.'",
                    "text":"'.$data->name.' - '.$data->phone.'",
                    "parent_id":"'.$data->id_father.'",
                    "children":[';
                    if(!empty($data->Affiliater)) showAffiliaterSub($data->Affiliater);
                    echo    '],
                    "data":{  

                    },
                    "a_attr":{  
                        "href":"#",
                        "onclick":"loadAgency(\''.$data->id.'\',\''.$data->percent.'\',\''.$data->level.'\')",
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

    showAffiliaterSub($listData);

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