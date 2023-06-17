/*
Coloris({
    el: '.coloris',
    selectInput: false,
    defaultColor: '#264653',
    swatches: [
        '#264653',
        '#2a9d8f',
        '#e9c46a',
        '#f4a261',
        '#e76f51',
        '#d62828',
        '#023e8a',
        '#0077b6',
        '#0096c7',
        '#00b4d8',
        '#48cae4'
    ]
});
*/

// Coloris.setInstance('#coler1', { theme: 'polaroid' });

$('.clc-action-edit.text').click(function() {
    $('.thaotacchu, #thaotacchu').removeClass('active');
});

$('.clc-action-edit.image').click(function() {
    $('.thaotacanh, #thaotacanh').removeClass('active');
});

$('.clc-action-edit.thaotac').click(function() {
    $('.thaotac, #thaotac').removeClass('active');
});

var full_width = $('#widgetCapEdit').width();
var full_height = $('#widgetCapEdit').height();
var left, top;
var checkEditLayer = false;

function editThemeUser(id) 
{
    $('.loadingProcess').removeClass('d-none');

    $.ajax({
        url: 'https://apis.ezpics.vn/apis/dataEditThemeUser',
        type: "POST",
        data: {
            id: id,
            action: 'edit',
            width: $('#widgetCapEdit').width(),
            height: $(window).height()/2,
        }, 
        success:function(data){
            $('.loadingProcess').addClass('d-none');
            
            if($.isEmptyObject(data.error)){
                //xóa data cũ
                clearDataOld(data);

                $('.list-layer').val('');

                localStorage.setItem("id",data.data.id);
                
                $('.italic').addClass('active-history');
                $('.under').addClass('active-history');
                $('.uppercase').addClass('active-history');
                $('.weight').addClass('active-history');
            }else{
                printErrorMsg(data.error);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

// update thông tin sản phẩm input
function update_input_info(id) {
    $('.box-detail-edit-user-create .thongtininput').keyup(function(event) {
        var idnew = $('.drag-drop').data('idproduct');
        var goc = $('.priceProduct').val();
        var sale = $('.sale_priceProduct').val();
        if (parseInt(goc.replaceAll(',','')) < parseInt(sale.replaceAll(',',''))) {
            printErrorMsg(['Giá giảm không được lớn hơn giá gốc']);
        }else{
            $.ajax({
                url: 'https://apis.ezpics.vn/apis/updateInfoProduct',
                data: {
                    id: idnew,
                    field: $(this).data('field'),
                    value: this.value,
                },
                type: "POST",
                success:function(data){
                    if($.isEmptyObject(data.error)){

                    }else{
                        printErrorMsg(data.error);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });    
        }
    });
}

// check chọn layer chưa
function check_pick_layer() {
    $('.clc-action-edit:not(.redo,.undo,.thongtin,.saveproduct,.thaotac,.add,.layerclass), .movedown, .moveup').click(function () {
        if($('div').hasClass('active-hover')){
           
        }else{
            $(".content-action").removeClass("active");
            $(".clc-action-edit").removeClass("active");
            printErrorMsg(['Chọn layer để thao tác']);
        }
    });
}

// hover chon
function hover() {
    $('.box-detail-edit-user-create .drag-drop').click(function () {
        $('.drag-drop').removeClass('active-hover');
        $(".content-action").removeClass("active");
        $(".clc-action-edit").removeClass("active");
    
        var type = $(this).data('type');
        if (type == 'text') {
            $('.image-select').addClass('d-none');
            $('.text-select').removeClass('d-none');

            //$('.thaotacchu, #thaotacchu').addClass('active');
            $('.thaotacanh, #thaotacanh').removeClass('active');
        }
        if (type == 'image') {
            $('.text-select').addClass('d-none');
            $('.image-select').removeClass('d-none');

            $('.thaotacchu, #thaotacchu').removeClass('active');
            //$('.thaotacanh, #thaotacanh').addClass('active');
        }
      
        // $('.box-detail-edit-user-create .drag-drop').removeClass('active-hover');
        $(this).addClass('active-hover');
        $('.list-selection-choose').addClass('d-none');
        $('.drag-drop.active-hover').find('.list-selection-choose').removeClass('d-none');

        removeInfoLayer(); // xóa data trước khi lấy data mới
        getInfoLayer(); // gọi data
        ajaxInfoLayer(); // cập nhật ngược data lên
    });

    onclickBody();
}

// update thông tin sản phẩm select
function update_select_info() {
    $('.box-detail-edit-user-create #status_pro').change(function(event) {
        $.ajax({
            url: 'https://apis.ezpics.vn/apis/updateInfoProduct',
            data: {
                id: localStorage.getItem("id"),
                field: 'status',
                value: this.value,
            },
            type: "POST",
            success:function(data){
                if($.isEmptyObject(data.error)){
                   
                }else{
                    printErrorMsg(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });    
    });

    $('.box-detail-edit-user-create #categor_pro').change(function(event) {
        $.ajax({
            url: 'https://apis.ezpics.vn/apis/updateInfoProduct',
            data: {
                id: localStorage.getItem("id"),
                field: 'category_id',
                value: this.value,
            },
            type: "POST",
            success:function(data){
                if($.isEmptyObject(data.error)){
                   
                }else{
                    printErrorMsg(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });    
    });

    $('.box-detail-edit-user-create .nameProduct').change(function(event) {
        $.ajax({
            url: 'https://apis.ezpics.vn/apis/updateInfoProduct',
            data: {
                id: localStorage.getItem("id"),
                field: 'name',
                value: this.value,
            },
            type: "POST",
            success:function(data){
                if($.isEmptyObject(data.error)){
                 
                }else{
                    printErrorMsg(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });    
    });
}

// cap screen 
function capEdit(id) {
    
    var element = document.getElementById('widgetCapEdit');

    html2canvas(element, {
      allowTaint: true,  // Cho phép chuyển đổi các phần tử "tainted" (như ảnh tải từ một domain khác)
      backgroundColor: '#ffffff',  // Màu nền của hình ảnh chuyển đổi
      scale: 2,  // Tỷ lệ zoom của hình ảnh chuyển đổi
      width: $('#widgetCapEdit').width(),  // Chiều rộng của hình ảnh chuyển đổi
      height: $('#widgetCapEdit').height(),  // Chiều cao của hình ảnh chuyển đổi
      useCORS: true,  // Sử dụng CORS để lấy dữ liệu
      quality: 1, // chất lượng hình ảnh
      logging: true,  // Hiển thị thông tin log trong console
      scrollX: 0, 
      scrollY: 0,
      taintTest: false,
      imageTimeout:0
    }).then(canvas => {
        const imgData = canvas.toDataURL("image/png");

        $.ajax({
            url: 'https://apis.ezpics.vn/apis/capImg',
            type: 'post',
            dataType: 'text',
            data: {
                base64data: imgData,
                id: id
            },
            success:function(data){
                if($.isEmptyObject(data.error)){
                    $('.loadingProcess').addClass('d-none');

                    // Hiển thị thông báo
                    $("#success-notification").show();

                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(function() {
                        $("#success-notification").hide();
                    }, 3000);
                    return 1;
                }else{
                    printErrorMsg(data.error);
                    return 0;
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                return 0;
            }
        });
    });
}

// xóa thông tin input
function removeInfoLayer() {
    $('#textProduct').val(''); // chữ
}

// lấy thông tin xuống input
function getInfoLayer() {
    $('#textProduct').val($('.active-hover span').html().replace(/<br *\/?>/gi, '\n')); // chữ
    
    var font = $('.active-hover').data('size');
    font = font.replace('px','');
    font = font.replace('vw','');

    var font_family = $('.active-hover span').css('font-family');
    
    var gianchu = $('.active-hover span').css('letter-spacing');
    gianchu = gianchu.replace('px','');
    gianchu = gianchu.replace('vw','');
    if(gianchu=='normal') gianchu= '0';
    
    var giandong = $('.active-hover span').css('line-height');
    giandong = giandong.replace('px','');
    giandong = giandong.replace('vw','');
    if(giandong=='normal') giandong= '0';

    var fontweight = $('.active-hover span').css('font-weight');
    var decoration = $('.active-hover span').css('text-decoration');
    var texttransform = $('.active-hover span').css('text-transform');
    var fontstyle = $('.active-hover span').css('font-style');
    
    var border = $('.active-hover').data('border');

    var imgsize = $('.active-hover').data('width');

    var rotate = $('.active-hover').data('rotate');

    imgsize = imgsize.replace('px','');
    imgsize = imgsize.replace('vw','');

    rotate = rotate.replace('deg','');
    
    var textalign = $('.active-hover').css('text-align');

    var gradient = $('.active-hover span').css('background');

    $('.fontz').text(font); 
    $('.fontz').val(font); 
    $('.font').val(font); 

    if($("#font-family option[value='"+font_family+"']").length > 0){
        $('#font-family').val(font_family); 
    }else{
        $('#font-family').val(''); 
    }
    
    
    $('.opacityz').text($('.active-hover span').css('opacity') * 100); 
    $('.opacityz').val($('.active-hover span').css('opacity') * 100); 
    $('.opacity').val($('.active-hover span').css('opacity') * 100); 

    $('.borderz').text(border); 
    $('.borderz').val(border); 
    $('.border').val(border); 
    
    $('.sizeimgz').text(imgsize); 
    $('.sizeimgz').val(imgsize); 
    $('.sizeimg').val(imgsize); 

    $('.rotatez').text(rotate); 
    $('.rotatez').val(rotate); 
    $('.rotate').val(rotate); 

    $('.gianchuz').text(gianchu); 
    $('.gianchu').val(gianchu); 

    $('.giandongz').text(giandong); 
    $('.giandong').val(giandong); 

    $('.cchinh').addClass('active-history');
    $('.cchinh.'+textalign).removeClass('active-history');
    if (fontweight == '700') {
        $('.weight').removeClass('active-history');
    }
    if(decoration.indexOf('underline') != -1){
        $('.under').removeClass('active-history');
    }
    if (fontstyle == 'italic') {
        $('.italic').removeClass('active-history');
    }
    if (texttransform == 'uppercase') {
        $(".uppercase").removeClass('active-history');
    }

    $('.gra1 .gradientcolor').closest('.clr-field').css("color", $('.active-hover').data('gradient_color1'));
    $('.gra2 .gradientcolor').closest('.clr-field').css("color", $('.active-hover').data('gradient_color2'));

    $('.gra1 .gradientcolor').val($('.active-hover').data('gradient_color1'));
    $('.gra1 .fieldcolor').val($('.active-hover').data('postion_color1'));
    $('.gra2 .gradientcolor').val($('.active-hover').data('gradient_color2'));
    $('.gra2 .fieldcolor').val($('.active-hover').data('postion_color2'));

    if($('.active-hover').data('gradient_color3')){
        $('.gra3 .gradientcolor').val($('.active-hover').data('gradient_color3'));
        $('.gra3 .fieldcolor').val($('.active-hover').data('postion_color3'));
        $('.gra3').removeClass('d-none');
        $('.gra3 .gradientcolor').closest('.clr-field').css("color", $('.active-hover').data('gradient_color3'));
    }else{
        $('.gra3').addClass('d-none');
    }

    if($('.active-hover').data('gradient_color4')){
        $('.gra4 .gradientcolor').val($('.active-hover').data('gradient_color4'));
        $('.gra4 .fieldcolor').val($('.active-hover').data('postion_color4'));
        $('.gra4').removeClass('d-none');
        $('.gra4 .gradientcolor').closest('.clr-field').css("color", $('.active-hover').data('gradient_color4'));
    }else{
        $('.gra4').addClass('d-none');
    }

    if($('.active-hover').data('gradient_color5')){
        $('.gra5 .gradientcolor').val($('.active-hover').data('gradient_color5'));
        $('.gra5 .fieldcolor').val($('.active-hover').data('postion_color5'));
        $('.gra5').removeClass('d-none');
        $('.gra5 .gradientcolor').closest('.clr-field').css("color", $('.active-hover').data('gradient_color5'));
    }else{
        $('.gra5').addClass('d-none');
    }

    if($('.active-hover').data('gradient_color6')){
        $('.gra6 .gradientcolor').val($('.active-hover').data('gradient_color6'));
        $('.gra6 .fieldcolor').val($('.active-hover').data('postion_color6'));
        $('.gra6 .gradientcolor').closest('.clr-field').css("color", $('.active-hover').data('gradient_color6'));
        $('.gra6').removeClass('d-none');
    }else{
        $('.gra6').addClass('d-none');
    }

    if($('.active-hover').data('gradient')){
        $('#addClassGradient').prop('checked', true);
    }else{
        $('#addClassGradient').prop('checked', false);
    }

    $("#gradient_postion").val($('.active-hover').data('pos_gradient'));

    setGradientColorLayer();
}

//gradient

function gradient() {
    /*
    var layer_selected = $('.active-hover').data('layer');
    var id = $('.active-hover').data('idproduct');
    var postion = $('#gradient_postion').find(":selected").val();
    var color1 = $('.gra1 .gradientcolor').val();
    var color2 = $('.gra2 .gradientcolor').val();

    var pos1 = $('.gra1 .fieldcolor').val();
    var pos2 = $('.gra2 .fieldcolor').val();
    if ($('#addClassGradient').is(":checked")) {

        // lstorage('gradient_color3', id, layer_selected, null);
        // lstorage('gradient_color4', id, layer_selected, null);
        // lstorage('gradient_color5', id, layer_selected, null);
        // lstorage('gradient_color6', id, layer_selected, null);
        var countnow = $('.count-gradient:not(.d-none)').length;
        var color3 = $('.gra3 .gradientcolor').val();
        var pos3 = $('.gra3 .fieldcolor').val();
        var color5 = $('.gra5 .gradientcolor').val();
        var pos5 = $('.gra5 .fieldcolor').val();

        var color4 = $('.gra4 .gradientcolor').val();
        var pos4 = $('.gra4 .fieldcolor').val();
        var color6 = $('.gra6 .gradientcolor').val();
        var pos6 = $('.gra6 .fieldcolor').val();

        if(countnow == 4) {
            $('.active-hover span').css({background: "linear-gradient( "+postion+", "+color1+" "+pos1+"%, "+color3+" "+pos3+"%, "+color4+" "+pos4+"%, "+color2+" "+pos2+"%)"});
            lstorage('gradient_color3', id, layer_selected, color3);
            lstorage('gradient_color4', id, layer_selected, color4);
            lstorage('gradient_color5', id, layer_selected, null);
            lstorage('gradient_color6', id, layer_selected, null);
        }
        if(countnow == 3) {
            $('.active-hover span').css({background: "linear-gradient( "+postion+", "+color1+" "+pos1+"%, "+color3+" "+pos3+"%, "+color2+" "+pos2+"%)"});
            lstorage('gradient_color3', id, layer_selected, color3);
            lstorage('gradient_color4', id, layer_selected, null);
            lstorage('gradient_color5', id, layer_selected, null);
            lstorage('gradient_color6', id, layer_selected, null);
        }
           
        if(countnow == 5) {
            $('.active-hover span').css({background: "linear-gradient( "+postion+", "+color1+" "+pos1+"%, "+color3+" "+pos3+"%, "+color4+" "+pos4+"%, "+color5+" "+pos5+"%, "+color2+" "+pos2+"%)"});
            lstorage('gradient_color3', id, layer_selected, color3);
            lstorage('gradient_color4', id, layer_selected, color4);
            lstorage('gradient_color5', id, layer_selected, color5);
            lstorage('gradient_color6', id, layer_selected, null);
        }

        if(countnow == 6) {
            $('.active-hover span').css({background: "linear-gradient( "+postion+", "+color1+" "+pos1+"%, "+color3+" "+pos3+"%, "+color4+" "+pos4+"%, "+color5+" "+pos5+"%, "+color6+" "+pos6+"%, "+color2+" "+pos2+"%)"});
            lstorage('gradient_color3', id, layer_selected, color3);
            lstorage('gradient_color4', id, layer_selected, color4);
            lstorage('gradient_color5', id, layer_selected, color5);
            lstorage('gradient_color6', id, layer_selected, color6);
        }

        if(countnow == 2) {
            $('.active-hover span').css({background: "linear-gradient( "+postion+", "+color1+" "+pos1+"%, "+color2+" "+pos2+"%)"});
        }
        lstorage('linear_position', id, layer_selected, postion);

        lstorage('gradient_color1', id, layer_selected, color1);
        lstorage('gradient_color2', id, layer_selected, color2);

        lstorage('postion_color1', id, layer_selected, pos1);
        lstorage('postion_color2', id, layer_selected, pos2);
        lstorage('postion_color3', id, layer_selected, pos3);
        lstorage('postion_color4', id, layer_selected, pos4);
        lstorage('postion_color5', id, layer_selected, pos5);
        lstorage('postion_color6', id, layer_selected, pos6);

        lstorage('gradient', id, layer_selected, 1);
    }else{
        $('.active-hover span').removeClass('gradient').css('background', 'transparent');

        lstorage('linear_position', id, layer_selected, 'to top left');

        lstorage('gradient_color1', id, layer_selected, color1);
        lstorage('gradient_color2', id, layer_selected, color2);
        lstorage('gradient_color3', id, layer_selected, null);
        lstorage('gradient_color4', id, layer_selected, null);
        lstorage('gradient_color5', id, layer_selected, null);
        lstorage('gradient_color6', id, layer_selected, null);

       
        lstorage('postion_color1', id, layer_selected, "0");
        lstorage('postion_color2', id, layer_selected, "100");
        lstorage('postion_color3', id, layer_selected, "20");
        lstorage('postion_color4', id, layer_selected, "40");
        lstorage('postion_color5', id, layer_selected, "60");
        lstorage('postion_color6', id, layer_selected, "80");
        lstorage('gradient', id, layer_selected, 0);    
    }
    */
}

//add thêm gradient
function addClassGradient() {
    if ($('#addClassGradient').is(":checked")) {
        $('.drag-drop.active-hover').data('gradient','1');
    }else{
        $('.drag-drop.active-hover').data('gradient','0');

        $('.active-hover span').css('background-image', '');
        $('.active-hover span').css('-webkit-background-clip', '');
        $('.active-hover span').css('-webkit-text-fill-color', '');
    }

    setGradientColorLayer();
}


// hiển thị layer trên giao diện khi có thay đổi
function ajaxInfoLayer() {
    $('.gradientcolor').on("input",function(event) {
        gradient();
    });

    $('#gradient_postion, #addClassGradient').change(function(event) {
        gradient();
    });

    $('.fieldcolor').keyup(function(event) {
        gradient();
    });

    $('#textProduct').keyup(function(event) {
        var dtext =  $(this).val();
        
        dtext = dtext.replace("'", "’");
        dtext = dtext.replace('"', "’’");

        $('.active-hover span').html(dtext.replace(/\n\r?/g, '<br />'));
        $('.setlayer[data-layer="'+$('.active-hover').data('layer')+'"] span').text($(this).val());
    });

    $('#textProduct').change(function(event) {
        var dtext =  $(this).val();

        dtext = dtext.replace("'", "’");
        dtext = dtext.replace('"', "’’");
        
        lstorage('text', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), dtext.replace(/\n\r?/g, '<br />'));
    });

    $('.color').on("input",function(event) {
        $('.active-hover span').css('color',$(this).val());
    });

    $('.color').on("change",function(event) {
        lstorage('color', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), $(this).val());
    });

    $('.font').on("change mousemove", function() {
        var sizeEdit = $(this).val();
        if(sizeEdit>100) sizeEdit=100;
        if(sizeEdit<0) sizeEdit=0;
        $(this).val(sizeEdit);

        $('.active-hover span').css('font-size', sizeEdit+'vw');
        $('.active-hover').data('size',sizeEdit+'vw');

        lstorage('size', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), sizeEdit+'vw');
    });

    $('.fontz').on("keyup", function() {
        var sizeEdit = $(this).val();
        if(sizeEdit>100) sizeEdit=100;
        if(sizeEdit<0) sizeEdit=0;
        $(this).val(sizeEdit);

        $('.fontz').text(sizeEdit);
        $('.font').val(sizeEdit);
        $('.active-hover span').css('font-size', sizeEdit+'vw');
        $('.active-hover').data('size',sizeEdit+'vw');

        lstorage('size', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), sizeEdit+'vw');
    });

    $('.opacity').on("change mousemove", function() {
        $('.active-hover span').css('opacity', $(this).val() / 100 );
        $('.active-hover img').css('opacity', $(this).val() / 100 );
        lstorage('opacity', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), $(this).val() / 100);
    });
   
    $('.box-detail-edit-user-create #font-family').change(function() {
        $('.active-hover span').css('font-family', $(this).val());
        lstorage('font', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), $(this).val());
    });

    $('.gianchu').on("change mousemove", function() {
        var sizeEdit = $(this).val();
        if(sizeEdit>100) sizeEdit=100;
        if(sizeEdit<0) sizeEdit=0;
        $(this).val(sizeEdit);

        if(sizeEdit==0){
            sizeEdit = 'normal';
        }else{
            sizeEdit = sizeEdit+'vw';
        }

        $('.active-hover span').css('letter-spacing', sizeEdit);
        lstorage('gianchu', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), sizeEdit);
    });

    $('.giandong').on("change mousemove", function() {
        var sizeEdit = $(this).val();
        if(sizeEdit>100) sizeEdit=100;
        if(sizeEdit<0) sizeEdit=0;
        $(this).val(sizeEdit);

        if(sizeEdit==0){
            sizeEdit = 'normal';
        }else{
            sizeEdit = sizeEdit+'vh';
        }

        $('.active-hover span').css('line-height', sizeEdit);
        lstorage('giandong', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), sizeEdit);
    });

    // xử lý thay đổi kích cỡ ảnh hoặc chữ
    $('.sizeimg').on("change mousemove", function() {
        var sizeEdit = $(this).val();
        if(sizeEdit>100) sizeEdit=100;
        if(sizeEdit<0) sizeEdit=0;
        $(this).val(sizeEdit);
        
        $('.active-hover img').css('max-width', '100vw');
        $('.active-hover img').css('width', sizeEdit+'vw');

        $('.active-hover span').css('max-width', '100vw');
        $('.active-hover span').css('width', sizeEdit+'vw');

        $('.active-hover').data('width', sizeEdit+'vw');

        $('.sizeimg').val(sizeEdit);
        $('.sizeimgz').text(sizeEdit);

        lstorage('width', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), sizeEdit+'vw');
    });

    $('.sizeimgz').on("keyup", function() {
        var sizeEdit = $(this).val();
        if(sizeEdit>100) sizeEdit=100;
        if(sizeEdit<0) sizeEdit=0;
        
        $(this).val(sizeEdit);

        $('.active-hover img').css('max-width', '100vw');
        $('.active-hover img').css('width', sizeEdit+'vw');

        $('.active-hover span').css('max-width', '100vw');
        $('.active-hover span').css('width', sizeEdit+'vw');
        
        $('.active-hover').data('width', sizeEdit+'vw');

        $('.sizeimg').val(sizeEdit);
        $('.sizeimgz').text(sizeEdit);

        lstorage('width', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), sizeEdit+'vw');
    });

    // xử lý thay đổi xoay góc
    $('.rotate').on("change mousemove", function() {
        var rotateEdit = $(this).val();
        if(rotateEdit>360) rotateEdit=360;
        if(rotateEdit<0) rotateEdit=0;
        $(this).val(rotateEdit);
        
        $('.active-hover').css('transform', 'translate(0px) rotate('+rotateEdit+'deg)');

        $('.active-hover').data('rotate', rotateEdit+'deg');

        $('.rotate').val(rotateEdit);
        $('.rotatez').text(rotateEdit);

        lstorage('rotate', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), rotateEdit+'deg');
    });

    $('.rotatez').on("keyup", function() {
        var rotateEdit = $(this).val();
        if(rotateEdit>360) rotateEdit=360;
        if(rotateEdit<0) rotateEdit=0;
        $(this).val(rotateEdit);
        
        $('.active-hover').css('transform', 'translate(0px) rotate('+rotateEdit+'deg)');

        $('.active-hover').data('rotate', rotateEdit+'deg');

        $('.rotate').val(rotateEdit);
        $('.rotatez').text(rotateEdit);

        lstorage('rotate', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), rotateEdit+'deg');
    });

    // xử lý thay đổi boder ảnh hoặc chữ
    $('.border').on("change mousemove", function() {
        var borderEdit = $(this).val();
        if(borderEdit>100) borderEdit=100;
        if(borderEdit<0) borderEdit=0;
        $(this).val(borderEdit);
        
        $('.active-hover img').css('border-radius', borderEdit+'px');

        $('.active-hover').data('border', borderEdit);

        $('.border').val(borderEdit);
        $('.borderz').text(borderEdit);

        lstorage('border', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), borderEdit);
    });

    $('.borderz').on("keyup", function() {
        var borderEdit = $(this).val();
        if(borderEdit>100) borderEdit=100;
        if(borderEdit<0) borderEdit=0;
        
        $(this).val(borderEdit);

        $('.active-hover img').css('border-radius', borderEdit+'px');

        $('.active-hover').data('border', borderEdit);

        $('.border').val(borderEdit);
        $('.borderz').text(borderEdit);

        lstorage('border', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), borderEdit);
    });
}

function canchinh(type) {
    $('.active-hover').css('text-align', type);
    $('.cchinh').addClass('active-history');
    $('.cchinh.'+type).removeClass('active-history');
    lstorage('text_align', $('.active-hover').data('idproduct'), $('.active-hover').data('layer'), type);
}

function ddang(type) {
    var layer_selected = $('.active-hover').data('layer');
    var id = $('.active-hover').data('idproduct');
    if (type == 'weight') {
        if($('.weight').hasClass('active-history')){
            $('.active-hover span').css('font-weight', 'bolder');
            $('.weight').removeClass('active-history');
            lstorage('indam', id, layer_selected, 'bolder');
        }else{
            $('.active-hover span').css('font-weight', 'normal');
            $('.weight').addClass('active-history');
            lstorage('indam', id, layer_selected, 'normal');
        } 
    }
    if (type == 'under') {
        if($('.under').hasClass('active-history')){
            $('.active-hover span').css('text-decoration', 'underline');
            $('.under').removeClass('active-history');
            lstorage('gachchan', id, layer_selected, 'underline');
        }else{
            $('.active-hover span').css('text-decoration', 'none');
            $('.under').addClass('active-history');
            lstorage('gachchan', id, layer_selected, 'none');
        } 
    }
    if (type == 'uppercase') {
        if($('.uppercase').hasClass('active-history')){
            $('.active-hover span').css('text-transform', 'uppercase');
            $('.uppercase').removeClass('active-history');
            lstorage('uppercase', id, layer_selected, 'uppercase');
        }else{
            $('.active-hover span').css('text-transform', 'none');
            $('.uppercase').addClass('active-history');
            lstorage('uppercase', id, layer_selected, 'none');
        } 
    }
    if (type == 'italic') {
        if($('.italic').hasClass('active-history')){
            $('.active-hover span').css('font-style', 'italic');
            $('.italic').removeClass('active-history');
            lstorage('innghieng', id, layer_selected, 'italic');
        }else{
            $('.active-hover span').css('font-style', 'normal');
            $('.italic').addClass('active-history');
            lstorage('innghieng', id, layer_selected, 'normal');
        } 
    }
}

// xử lý lstorage
function lstorage(field, id, layer, value) {
    // console.log(1024 * 1024 * 5 - unescape(encodeURIComponent(JSON.stringify(localStorage))).length);
    
    // cập nhật layer
    updatelayerClient(layer,field,id,value);
    // end cập nhật layer
    
    productstep(layer,field,id,value);
    // undo
}

function undo() {
    let id = $('.drag-drop').data('idproduct');
    if ($(".undo").hasClass("active-history")) {

    }else{
        if (localStorage.getItem("activiti_"+id) === null) {
            if (localStorage.getItem("product_step_"+id) === null) {

            }else{
                var get_step_local = localStorage.getItem("product_step_"+id);
                var json_step = JSON.parse(get_step_local);
                localStorage.setItem("activiti_"+id, json_step.length - 2); // trừ 1 là vì quay lại bước trước trừ thêm 1 vì bắt đầu bằng 0
                ajax_history(json_step.length - 2,id,2);
            }
        }else{
            var step_now = localStorage.getItem("activiti_"+id);
            if (step_now - 1 >= 0) {
                localStorage.setItem("activiti_"+id, step_now - 1);
                ajax_history(step_now - 1,id,2);
            }else{
                $(".undo").addClass("active-history");
            }
        }
        $(".redo").removeClass("active-history");
    }
}

function redo() {
    let id = $('.drag-drop').data('idproduct');
    if ($(".redo").hasClass("active-history")) {

    }else{
        if (localStorage.getItem("product_step_"+id) === null) {

        }else{
            var get_step_local = localStorage.getItem("product_step_"+id);
            var json_step = JSON.parse(get_step_local);
            var step_now = localStorage.getItem("activiti_"+id);
            if (Number(step_now) + 1 < json_step.length) {
                localStorage.setItem("activiti_"+id, Number(step_now) + 1);
                ajax_history(Number(step_now) + 1,id,1);
            }else{
                $(".redo").addClass("active-history");
            }
            $(".undo").removeClass("active-history");
        }
    }
}

// xử lý các undo redo
function ajax_history(step,id,typed) {
    /*
    if (localStorage.getItem("product_step_"+id) === null) {
        printErrorMsg(['Sản phẩm chưa chỉnh sửa']);
    }else{
        var get_step_local = localStorage.getItem("product_step_"+id);
        var json_step = JSON.parse(get_step_local);

        var total = json_step.length;
        var layer = Object.keys(json_step[step])[0];
        var field = Object.keys(json_step[step][layer])[0];
        var value = json_step[step][layer][field];
        updatelayerClient(layer,field,id,value);
        if (field == 'text') {
            $('.drag-drop[data-layer="'+layer+'"] span').text(value);
        }

        if (field == 'postion') {
            var postion = value.split(',');
            $('.drag-drop[data-layer="'+layer+'"]').css('transform', 'translate('+postion[0]+'px, '+postion[1]+'px)');
            $('.drag-drop[data-layer="'+layer+'"]').data('x', postion[0]);
            $('.drag-drop[data-layer="'+layer+'"]').data('y', postion[1]);
        }

        if (field == 'color') {
            $('.drag-drop[data-layer="'+layer+'"] span').css('color', value);
        }

        if (field == 'size') {
            $('.drag-drop[data-layer="'+layer+'"] span').css('font-size', value+'px');
        }

        if (field == 'opacity') {
            $('.drag-drop[data-layer="'+layer+'"] span').css('opacity', value);
        }

        if (field == 'giandong') {
            $('.drag-drop[data-layer="'+layer+'"] span').css('line-height', value);
        }

        if (field == 'gianchu') {
            $('.drag-drop[data-layer="'+layer+'"] span').css('letter-spacing', value);
        }

        if (field == 'font') {
            $('.drag-drop[data-layer="'+layer+'"] span').css('font-family', value);
        }

        if(typed == 1){
            if (field == 'innghieng') {
                if (value == 'italic') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-style', 'italic');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-style', 'normal');
                }
            }
            if (field == 'uppercase') {
                if (value == 'uppercase') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-transform', 'uppercase');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-transform', 'none');
                }
            }

            if (field == 'indam') {
                if (value == 'bolder') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-weight', 'bolder');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-weight', 'normal');
                }
            }

            if (field == 'gachchan') {
                if (value == 'underline') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-decoration', 'underline');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-decoration', 'none');
                }
            }
        }else{
            if (field == 'innghieng') {
                if (value == 'italic') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-style', 'normal');
                    updatelayerClient(layer,field,id,'normal');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-style', 'italic');
                }
            }

            if (field == 'uppercase') {
                if (value == 'uppercase') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-transform', 'none');
                    updatelayerClient(layer,field,id,'none');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-transform', 'uppercase');
                }
            }

            if (field == 'indam') {
                if (value == 'bolder') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-weight', 'normal');
                    updatelayerClient(layer,field,id,'normal');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('font-weight', 'bolder');
                }
            }
            if (field == 'gachchan') {
                if (value == 'underline') {
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-decoration', 'none');
                    updatelayerClient(layer,field,id,'none');
                }else{
                    $('.drag-drop[data-layer="'+layer+'"] span').css('text-decoration', 'underline');
                }
            }
        }
        getInfoLayer();
    }
    */
}

// cập nhật layer client
function updatelayerClient(layer,field,id,value) {
    if(id!=undefined){
        var get_update_local = localStorage.getItem("product_update_"+id);

        if(get_update_local!=undefined){
            var json_update = JSON.parse(get_update_local);
            var topmove, leftmove;

            full_width = $('#widgetCapEdit').width();
            full_height = $('#widgetCapEdit').height();

            if(field == 'postion') {
                var postion = value.split(',');
                
                leftmove = postion[0]*100/full_width;
                topmove = postion[1]*100/full_height;

                json_update[layer]['postion_left'] = leftmove;
                json_update[layer]['postion_top'] = topmove;
            }else{
                json_update[layer][field] = value;
            }

            var get_update_local = localStorage.setItem("product_update_"+id, JSON.stringify(json_update));

            checkEditLayer = true;
        }else{
            printErrorMsg(['Chọn layer để thao tác']);
        }
    }else{
        printErrorMsg(['Chọn layer để thao tác']);
    }
}
// end cập nhật layer

// lưu
function saveproduct(removeActiveClass) {
    // người dùng bấm nút Lưu
    if(removeActiveClass==1){
        $('.image, .text').removeClass('d-none');
        $('.list-selection-choose').addClass('d-none');
        $('.box-detail-edit-user-create .drag-drop').removeClass('active-hover');
    }

    if(removeActiveClass==1 || checkEditLayer){

        let id = $('.drag-drop').data('idproduct'); // id sản phẩm
        //$('.drag-drop').removeClass('active-hover');
        $('.loadingProcess').removeClass('d-none');
        
        // tạo ảnh thumbnail
        createThumbnail(id);

        checkEditLayer = false;
        
        if (localStorage.getItem("product_update_"+id) === null) {
            $('.loadingProcess').addClass('d-none');
        }else{
            var getupdate = localStorage.getItem("product_update_"+id);

            //console.log(getupdate);

            // var json_update = JSON.parse(getupdate);
            
            $.ajax({
                url: 'https://apis.ezpics.vn/apis/savelayer',
                dataType: 'json',
                type: "POST",
                data: {
                    id: id ,  // id sản phẩm
                    layer : getupdate, // list các layer của 1 sản phẩm
                }, 
                success:function(data){
                    if($.isEmptyObject(data.error)){
                        console.log('Lưu mẫu thiết kế thành công');
                    }else{
                        printErrorMsg(data.error);
                    }

                    if(removeActiveClass==0){
                        $('.loadingProcess').addClass('d-none');

                        // Hiển thị thông báo
                        $("#success-notification").show();

                        // Tự động ẩn thông báo sau 3 giây
                        setTimeout(function() {
                            $("#success-notification").hide();
                        }, 3000);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    console.log(thrownError);
                    console.log(ajaxOptions);
                }
            });
        
        }
    }
    
}

function duplicate() {
    let idproduct = $('.active-hover').data('idproduct');
    let id = $('.active-hover').data('id');
    if($('div').hasClass('active-hover')){
        var getupdate = localStorage.getItem("product_update_"+idproduct);
        if ($('.drag-drop').hasClass('active-hover')) {
            // var json_update = JSON.parse(getupdate);
            $.ajax({
                url: 'https://apis.ezpics.vn/apis/savelayer',
                dataType: 'json',
                type: "POST",
                data: {
                    layer : getupdate,
                    id: idproduct   
                }, 
                success:function(d){
                    if($.isEmptyObject(d.error)){
                       $.ajax({
                            url: 'https://apis.ezpics.vn/apis/copyLayer',
                            type: "POST",
                            dataType: 'json',
                            data: {
                                id: id, // id layer
                            }, 
                            success:function(data){
                                if($.isEmptyObject(data.error)){
                                    //xóa data cũ
                                    clearDataOld(data);
                                }else{
                                    printErrorMsg(data.error);
                                }
                            }
                        });
                    }else{
                        printErrorMsg(d.error);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
            
        }else{
            printErrorMsg(['Chọn layer để thao tác']);
        }
    }else{
        $(".content-action").removeClass("active");
        $(".clc-action-edit").removeClass("active");
        printErrorMsg(['Chọn layer để thao tác']);
    }
}

function confirmModal(text, functionAction)
{
    $('#confirmModal .modal-body').html(text);
    
    $("#confirmModal #buttonActionConfirm").attr("onclick",functionAction+'();');

    $('#confirmModal').modal('show');
}

function deleted() {
    let idproduct = $('.active-hover').data('idproduct');
    let id = $('.active-hover').data('id');
    if ($('.drag-drop').hasClass('active-hover')) {
        var getupdate = localStorage.getItem("product_update_"+idproduct);
        // var json_update = JSON.parse(getupdate);
        $.ajax({
            url: 'https://apis.ezpics.vn/apis/savelayer',
            dataType: 'json',
            type: "POST",
            data: {
                layer : getupdate,
                id: idproduct   
            }, 
            success:function(d){
                if($.isEmptyObject(d.error)){
                    $.ajax({
                        url: 'https://apis.ezpics.vn/apis/deleteLayer',
                        type: "POST",
                        data: {
                            id: id, // id layer cần xóa
                            idproduct: idproduct,
                        }, 
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                //xóa data cũ
                                clearDataOld(data);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }else{
                    printErrorMsg(d.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });

        
    }else{
        printErrorMsg(['Chọn layer để thao tác']);
    }
}

function deletedinlayer(idproduct,id) {
    var getupdate = localStorage.getItem("product_update_"+idproduct);
    //var json_update = JSON.parse(getupdate);
    $('.loadingProcess').removeClass('d-none');

    $.ajax({
        url: 'https://apis.ezpics.vn/apis/savelayer',
        dataType: 'json',
        type: "POST",
        data: {
            id: idproduct,
            layer : getupdate
        }, 
        success:function(d){
            if($.isEmptyObject(d.error)){
                $.ajax({
                    url: 'https://apis.ezpics.vn/apis/deleteLayer',
                    type: "POST",
                    data: {
                        id: id,
                        idproduct: idproduct,
                    }, 
                    success:function(data){
                        $('.loadingProcess').addClass('d-none');

                        if($.isEmptyObject(data.error)){
                            //xóa data cũ
                            clearDataOld(data);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
            }else{
                printErrorMsg(d.error);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

// thêm layer text
function add() {
    let idproduct = $('.drag-drop').data('idproduct');
    var getupdate = localStorage.getItem("product_update_"+idproduct);
    // var json_update = JSON.parse(getupdate);
    $('.loadingProcess').removeClass('d-none');

    $.ajax({
        url: 'https://apis.ezpics.vn/apis/savelayer',
        dataType: 'json',
        type: "POST",
        data: {
            layer : getupdate,
            id: idproduct   
        }, 
        success:function(d){
            $('.loadingProcess').addClass('d-none');

            if($.isEmptyObject(d.error)){
                $.ajax({
                    url: 'https://apis.ezpics.vn/apis/addLayer',
                    type: "POST",
                    data: {
                        idproduct: idproduct,
                        width: 80,
                        height: 30,
                        type: 'text'
                    }, 
                    success:function(data){
                        if($.isEmptyObject(data.error)){
                            //xóa data cũ
                            clearDataOld(data);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
            }else{
                printErrorMsg(d.error);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

function addImage(linkImage) {
    let idproduct = $('.drag-drop').data('idproduct');
    var getupdate = localStorage.getItem("product_update_"+idproduct);
    // var json_update = JSON.parse(getupdate);
    $('.loadingProcess').removeClass('d-none');

    $.ajax({
        url: 'https://apis.ezpics.vn/apis/savelayer',
        dataType: 'json',
        type: "POST",
        data: {
            layer : getupdate,
            id: idproduct   
        }, 
        success:function(d){
            $('.loadingProcess').addClass('d-none');

            if($.isEmptyObject(d.error)){
                $.ajax({
                    url: 'https://apis.ezpics.vn/apis/addLayer',
                    type: "POST",
                    data: {
                        idproduct: idproduct,
                        width: 30,
                        height: 30,
                        type: 'image',
                        banner: linkImage
                    }, 
                    success:function(data){

                        if($.isEmptyObject(data.error)){
                            //xóa data cũ
                            clearDataOld(data);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
            }else{
                printErrorMsg(d.error);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

function changeImage(linkImage) {
    let idproduct = $('.drag-drop').data('idproduct');
    let id = $('.active-hover').data('id');
    var getupdate = localStorage.getItem("product_update_"+idproduct);
    // var json_update = JSON.parse(getupdate);

    $('.loadingProcess').removeClass('d-none');

    $.ajax({
        url: 'https://apis.ezpics.vn/apis/savelayer',
        dataType: 'json',
        type: "POST",
        data: {
            layer : getupdate,
            id: idproduct   
        }, 
        success:function(d){
            $('.loadingProcess').addClass('d-none');

            if($.isEmptyObject(d.error)){
                $.ajax({
                    url: 'https://apis.ezpics.vn/apis/updateLayer',
                    type: "POST",
                    data: {
                        idproduct: idproduct,
                        id: id,
                        field: 'banner',
                        value: linkImage
                    }, 
                    success:function(data){

                        if($.isEmptyObject(data.error)){
                            //xóa data cũ
                            clearDataOld(data);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
            }else{
                printErrorMsg(d.error);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

function sort(type) {
    let idproduct = $('.active-hover').data('idproduct');
    var getupdate = localStorage.getItem("product_update_"+idproduct);
    // var json_update = JSON.parse(getupdate);
    $('.loadingProcess').removeClass('d-none');

    $.ajax({
        url: 'https://apis.ezpics.vn/apis/savelayer',
        dataType: 'json',
        type: "POST",
        data: {
            layer : getupdate,
            id: idproduct   
        }, 
        success:function(d){
            $('.loadingProcess').addClass('d-none');

            if($.isEmptyObject(d.error)){
                $.ajax({
                    url: 'https://apis.ezpics.vn/apis/sortLayer',
                    type: "POST",
                    data: {
                        id: idproduct,
                        layerid: $('.active-hover').data('id'),
                        sort: type,
                    }, 
                    success:function(data){

                        if($.isEmptyObject(data.error)){
                            //xóa data cũ
                            clearDataOld(data);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });    
            }else{
                printErrorMsg(d.error);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

function leftmove() {
    if($('div').hasClass('active-hover')){
        let idproduct = $('.active-hover').data('idproduct');
        let id = $('.active-hover').data('id');
        let layer = $('.active-hover').data('layer');
        var x = parseFloat($('.active-hover').css('left').replace('px',''));
        var rotate = $('.active-hover').data('rotate');
        
        var value = x - 1;
        var leftmove;

        full_width = $('#widgetCapEdit').width();

        leftmove = value*100/full_width;
        
        $('.active-hover').css('transform', 'translate(0px, 0px) rotate('+rotate+')');
        $('.active-hover').css('left', leftmove+'%');
        
        $('.active-hover').data('left', leftmove);
        
        updatelayerClient(layer,'postion_left',idproduct,leftmove);
    }else{
        $(".content-action").removeClass("active");
        $(".clc-action-edit").removeClass("active");
        printErrorMsg(['Chọn layer để thao tác']);
    }
}

function rightmove() {
    if($('div').hasClass('active-hover')){
        let idproduct = $('.active-hover').data('idproduct');
        let id = $('.active-hover').data('id');
        let layer = $('.active-hover').data('layer');
        var x = parseFloat($('.active-hover').css('left').replace('px',''));
        var rotate = $('.active-hover').data('rotate');
        
        var value = x + 1;
        var leftmove;

        full_width = $('#widgetCapEdit').width();

        leftmove = value*100/full_width;
        
        $('.active-hover').css('transform', 'translate(0px, 0px) rotate('+rotate+')');
        $('.active-hover').css('left', leftmove+'%');
        
        $('.active-hover').data('left', leftmove);
        
        updatelayerClient(layer,'postion_left',idproduct,leftmove);
    }else{
        $(".content-action").removeClass("active");
        $(".clc-action-edit").removeClass("active");
        printErrorMsg(['Chọn layer để thao tác']);
    }
}

function topmove() {
    if($('div').hasClass('active-hover')){
        let idproduct = $('.active-hover').data('idproduct');
        let id = $('.active-hover').data('id');
        let layer = $('.active-hover').data('layer');
        var y = parseFloat($('.active-hover').css('top').replace('px',''));
        var rotate = $('.active-hover').data('rotate');
        
        var value = y - 1;
        var topmove;
        
        full_height = $('#widgetCapEdit').height();
       
        topmove = value*100/full_height;

        $('.active-hover').css('transform', 'translate(0px, 0px) rotate('+rotate+')');
       
        $('.active-hover').css('top', topmove+'%');
     
        $('.active-hover').data('top', topmove);

        updatelayerClient(layer,'postion_top',idproduct,topmove);
    }else{
        $(".content-action").removeClass("active");
        $(".clc-action-edit").removeClass("active");
        printErrorMsg(['Chọn layer để thao tác']);
    }
}

function bottommove() {
    if($('div').hasClass('active-hover')){
        let idproduct = $('.active-hover').data('idproduct');
        let id = $('.active-hover').data('id');
        let layer = $('.active-hover').data('layer');
        var y = parseFloat($('.active-hover').css('top').replace('px',''));
        var rotate = $('.active-hover').data('rotate');
        
        var value = y + 1;
        var topmove;
        
        full_height = $('#widgetCapEdit').height();
       
        topmove = value*100/full_height;

        $('.active-hover').css('transform', 'translate(0px, 0px) rotate('+rotate+')');
       
        $('.active-hover').css('top', topmove+'%');
     
        $('.active-hover').data('top', topmove);

        updatelayerClient(layer,'postion_top',idproduct,topmove);
    }else{
        $(".content-action").removeClass("active");
        $(".clc-action-edit").removeClass("active");
        printErrorMsg(['Chọn layer để thao tác']);
    }
}

// get set data step
function productstep(layer,field,id,value) {
    var field_update = {};
    field_update[field] = value;

    // lưu history
    var d = {[layer] : field_update}
    if (localStorage.getItem("product_step_"+id) === null) {
        localStorage.setItem("product_step_"+id, JSON.stringify([d]));
    }else{
        var get_step_local = localStorage.getItem("product_step_"+id);
        var json_step = JSON.parse(get_step_local);
        if (field == 'text') {
            if(json_step[json_step.length-1][layer][field] == value) { 
               
            }else{
                json_step.push(d);
                localStorage.setItem("product_step_"+id, JSON.stringify(json_step));
            }
        }else{
            json_step.push(d);
            localStorage.setItem("product_step_"+id, JSON.stringify(json_step));
        }
        if (localStorage.getItem("activiti_"+id) === null) {
            let total_history = json_step.length;
            if (total_history > 0) {
                $('.undo').removeClass('active-history');
            }
        }else{
            localStorage.setItem("activiti_"+id, json_step.length - 1); 
            $('.undo').removeClass('active-history');
            $('.redo').addClass('active-history');
        }
    }
    // end lưu history
}

// js
$(document).ready(function () {
    function rangeSlider() {
        let slider = document.querySelectorAll(".range-slider");
        let range = document.querySelectorAll(".range-slider__range");
        let value = document.querySelectorAll(".range-slider__value");

        slider.forEach((activeSlider) => {
            value.forEach((activeValue) => {
                let val = activeValue.previousElementSibling.getAttribute("value");
                activeValue.innerText = val;
            });

            range.forEach((elem) => {
                elem.addEventListener("input", (eventArgs) => {
                    elem.nextElementSibling.innerText = eventArgs.target.value;
                });
            });
        });
    }
    rangeSlider();

    $(".clc-close-action").click(function () {
        $(".clc-action-edit, .imgupload").removeClass("active");
        $(".content-action").removeClass("active");
    });

    $(".clc-action-edit, .imgupload").click(function () {
        var tab_id = $(this).attr("data-tab");
        var typeUploadImage= '';

        $(this).addClass("active");
        $("#" + tab_id).addClass("active");

        if (tab_id == "listanh") {
            typeUploadImage = 'addNewImage';
        }else if (tab_id == "thayanh") {
            typeUploadImage = 'changeImage';
        }

        $("#thaotac").removeClass("active");
        
        $.ajax({
            url: 'https://apis.ezpics.vn/apis/imagelist',
            dataType: 'json',
            type: "POST",
            data: {
                type: typeUploadImage
            }, 
            success:function(data){

                if($.isEmptyObject(data.error)){
                    $('.list-img div').remove();
                    $('.list-img').append(data.success);
                }else{
                    printErrorMsg(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
});

// di chuyển layer
interact(".drag-drop")
.draggable({
    listeners: { 
        start (event) {
            checkPositionLayer();

            var target = event.target;
            var selector = target.getAttribute('class');
            $('.drag-drop').removeClass('active-hover');
            $('.image, .text').removeClass('d-none');
            
            target.setAttribute("class", 'active-hover ' + selector);
            removeInfoLayer(); // xóa data trước khi lấy data mới
            getInfoLayer(); // gọi data
            ajaxInfoLayer(); // cập nhật ngược data lên
            onclickBody();
            

            var type = $('.drag-drop.active-hover').data('type');
            if (type == 'text') {
                $('.image-select').addClass('d-none');
                $('.text-select').removeClass('d-none');

                //$('.thaotacchu, #thaotacchu').addClass('active');
                $('.thaotacanh, #thaotacanh').removeClass('active');
            }
            if (type == 'image') {
                $('.text-select').addClass('d-none');
                $('.image-select').removeClass('d-none');

                $('.thaotacchu, #thaotacchu').removeClass('active');
                //$('.thaotacanh, #thaotacanh').addClass('active');
            }
        },
        move: dragMoveListener,
        end (event) {
            var target = event.target,
            x = (parseFloat($('.active-hover').css('left').replace('px','')) || 0) + event.dx,
            y = (parseFloat($('.active-hover').css('top').replace('px','')) || 0) + event.dy;

            /*
            if(x>$('#widgetCapEdit').width()){
                x = $('#widgetCapEdit').width()-$('#active-hover').width();
            }

            if(x<0){
                x= 0;
            }

            if(y>$('#widgetCapEdit').height()){
                y = $('#widgetCapEdit').height()-$('#active-hover').height();
            }

            if(y<0){
                y= 0;
            }
            */

            var idproduct = target.getAttribute("data-idproduct");
            var layer = target.getAttribute("data-layer");

            updatelayerClient(layer,'postion',idproduct,x+','+y);

            productstep(layer,'postion',idproduct,x+','+y);
        } 
    },
});

function dragMoveListener(event) {
    var leftmove, topmove, maxtop, maxleft;
    var target = event.target;
    var xSelect = $('.active-hover').width();
    var ySelect = $('.active-hover').height();
    
    x = (parseFloat($('.active-hover').css('left').replace('px','')) || 0) + event.dx;
    y = (parseFloat($('.active-hover').css('top').replace('px','')) || 0) + event.dy;
    
    var selector = target.getAttribute('class');
    var getClass = selector.replace("drag-drop ", "");
    var rotate = $('.active-hover').data('rotate');


    full_width = $('#widgetCapEdit').width();
    full_height = $('#widgetCapEdit').height();
    
    leftmove = x*100/full_width;
    topmove = y*100/full_height;
    maxtop = 0-ySelect*100/full_height
    maxleft = 0-xSelect*100/full_width

    if(leftmove>=100){
        leftmove = 99;
    }

    if(topmove>=100){
        topmove = 99;
    }

    if(topmove<=maxtop){
        topmove = maxtop+1;
    }

    if(leftmove<=maxleft){
        leftmove = maxleft+1;
    }


    $('.active-hover').css('transform', 'translate(0px, 0px) rotate('+rotate+')');
    $('.active-hover').css('left', leftmove+'%');
    $('.active-hover').css('top', topmove+'%');

    target.setAttribute("data-left", leftmove);
    target.setAttribute("data-top", topmove);
}


$(".upimg[type='file']").on('change', function() { 
    let idproduct = $('.drag-drop').data('idproduct');
    if($(this).prop('files').length > 0)
    {
        let id = $('.drag-drop').data('idproduct');
        var getupdate = localStorage.getItem("product_update_"+id);
        // var json_update = JSON.parse(getupdate);

        $('.loadingProcess').removeClass('d-none');

        $.ajax({
            url: 'https://apis.ezpics.vn/apis/savelayer',
            dataType: 'json',
            type: "POST",
            data: {
                layer : getupdate,
                id: id   
            }, 
            success:function(d){
                $('.loadingProcess').addClass('d-none');

                if($.isEmptyObject(d.error)){
                    formdata = new FormData();
                    file = $(".upimg[type='file']").prop('files')[0];
                    formdata.append("file", file);
                    formdata.append("idproduct", idproduct);
                    formdata.append("width", $('#widgetCapEdit').width());
                    formdata.append("height", $('#widgetCapEdit').height());
                    $.ajax({
                        url: 'https://apis.ezpics.vn/apis/upImage',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formdata, 
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                $('.nameProduct').val('');
                                $('.priceProduct').val('');
                                $('.sale_priceProduct').val('');
                                localStorage.removeItem("product_"+data.data.id);
                                localStorage.removeItem("product_update_"+data.data.id);
                                localStorage.removeItem("product_step_"+data.data.id);
                                localStorage.removeItem("activiti_"+data.data.id);
                                $('.undo').addClass('active-history');
                                $('.redo').addClass('active-history');
                                $(".content-action").removeClass("active");
                                $(".clc-action-edit").removeClass("active");


                                // lấy data mới
                                $('.nameProduct').val(data.data.name);
                                $('.priceProduct').val(parseFloat(data.data.price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('.sale_priceProduct').val(parseFloat(data.data.sale_price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                                // hiện thanh công cụ
                                $('.active-layer-edit').removeClass('d-none');
                                if (data.type == 'user_create') {
                                    // lấy chuyên mục đã chọn 
                                    $('.box-detail-edit-user-create #categor_pro option[value='+data.category.id+']').attr("selected",true);

                                    // lấy trạng thái đã chọn
                                    $('.box-detail-edit-user-create #status_pro option[value='+data.data.status+']').attr("selected",true);
                                }
                                // update thông tin cơ bản khi nhập
                                if (data.type == 'user_create') {
                                    update_input_info(data.data.id);
                                    update_select_info();
                                    $('.thongtin').removeClass('d-none');
                                }else{
                                    $('.thongtin').addClass('d-none');
                                }
                                // lấy danh sách user
                                $('.list-layer').html(data.list_layer_check);

                                // select layer
                                $('.setlayer').click(function () {
                                    var layer = $(this).data('layer');
                                    activeLayerSelect(layer);
                                })

                                $('.list-layout-move-create').html(data.movelayer);
                                hover();
                                check_pick_layer();
                                
                                // localStorage.setItem('layer_data', JSON.stringify(data.layer));
                                if (localStorage.getItem("product_"+data.data.id) === null) {
                                    localStorage.setItem("product_"+data.data.id, JSON.stringify(data.layer));
                                }
                                if (localStorage.getItem("product_update_"+data.data.id) === null) {
                                    localStorage.setItem("product_update_"+data.data.id, JSON.stringify(data.layer));
                                }
                                
                                if (localStorage.getItem("product_step_"+data.data.id) === null) {
                                }else{
                                    var get_step_local = localStorage.getItem("product_step_"+id);
                                    var json_step = JSON.parse(get_step_local);
                                    if(localStorage.getItem("activiti_"+data.data.id) === null) { 
                                       
                                    }else{
                                        let total_history = json_step.length;
                                        var get_step_now = localStorage.getItem("activiti_"+id);
                                        if (get_step_now > 0 && get_step_now < total_history) {
                                            $('.undo').removeClass('active-history');
                                            $('.redo').removeClass('active-history');
                                        }
                                        if (get_step_now == 0) {
                                            $('.undo').removeClass('active-history');
                                            $('.redo').addClass('active-history');
                                        }
                                        if (get_step_now == total_history) {
                                            $('.redo').removeClass('active-history');
                                            $('.undo').addClass('active-history');
                                        }
                                    }

                                }

                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }else{
                    printErrorMsg(d.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
});

$(".upimgThumbnail[type='file']").on('change', function() { 
    let idproduct = $('.drag-drop').data('idproduct');
    if($(this).prop('files').length > 0)
    {
        let id = $('.drag-drop').data('idproduct');
        var getupdate = localStorage.getItem("product_update_"+id);
        // var json_update = JSON.parse(getupdate);

        $('.loadingProcess').removeClass('d-none');

        $.ajax({
            url: 'https://apis.ezpics.vn/apis/savelayer',
            dataType: 'json',
            type: "POST",
            data: {
                layer : getupdate,
                id: id   
            }, 
            success:function(d){
                $('.loadingProcess').addClass('d-none');

                if($.isEmptyObject(d.error)){
                    formdata = new FormData();
                    file = $(".upimgThumbnail[type='file']").prop('files')[0];
                    formdata.append("file", file);
                    formdata.append("idproduct", idproduct);
                    $.ajax({
                        url: 'https://apis.ezpics.vn/apis/upImageThumbnail',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formdata, 
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                $('.nameProduct').val('');
                                $('.priceProduct').val('');
                                $('.sale_priceProduct').val('');
                                localStorage.removeItem("product_"+data.data.id);
                                localStorage.removeItem("product_update_"+data.data.id);
                                localStorage.removeItem("product_step_"+data.data.id);
                                localStorage.removeItem("activiti_"+data.data.id);
                                $('.undo').addClass('active-history');
                                $('.redo').addClass('active-history');
                                $(".content-action").removeClass("active");
                                $(".clc-action-edit").removeClass("active");


                                // lấy data mới
                                $('.nameProduct').val(data.data.name);
                                $('.priceProduct').val(parseFloat(data.data.price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('.sale_priceProduct').val(parseFloat(data.data.sale_price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                                // hiện thanh công cụ
                                $('.active-layer-edit').removeClass('d-none');
                                if (data.type == 'user_create') {
                                    // lấy chuyên mục đã chọn 
                                    $('.box-detail-edit-user-create #categor_pro option[value='+data.category.id+']').attr("selected",true);

                                    // lấy trạng thái đã chọn
                                    $('.box-detail-edit-user-create #status_pro option[value='+data.data.status+']').attr("selected",true);
                                }
                                // update thông tin cơ bản khi nhập
                                if (data.type == 'user_create') {
                                    update_input_info(data.data.id);
                                    update_select_info();
                                    $('.thongtin').removeClass('d-none');
                                }else{
                                    $('.thongtin').addClass('d-none');
                                }
                                // lấy danh sách user
                                $('.list-layer').html(data.list_layer_check);

                                // select layer
                                $('.setlayer').click(function () {
                                    var layer = $(this).data('layer');
                                    activeLayerSelect(layer);
                                })

                                $('.list-layout-move-create').html(data.movelayer);
                                hover();
                                check_pick_layer();
                                
                                // localStorage.setItem('layer_data', JSON.stringify(data.layer));
                                if (localStorage.getItem("product_"+data.data.id) === null) {
                                    localStorage.setItem("product_"+data.data.id, JSON.stringify(data.layer));
                                }
                                if (localStorage.getItem("product_update_"+data.data.id) === null) {
                                    localStorage.setItem("product_update_"+data.data.id, JSON.stringify(data.layer));
                                }
                                
                                if (localStorage.getItem("product_step_"+data.data.id) === null) {
                                }else{
                                    var get_step_local = localStorage.getItem("product_step_"+id);
                                    var json_step = JSON.parse(get_step_local);
                                    if(localStorage.getItem("activiti_"+data.data.id) === null) { 
                                       
                                    }else{
                                        let total_history = json_step.length;
                                        var get_step_now = localStorage.getItem("activiti_"+id);
                                        if (get_step_now > 0 && get_step_now < total_history) {
                                            $('.undo').removeClass('active-history');
                                            $('.redo').removeClass('active-history');
                                        }
                                        if (get_step_now == 0) {
                                            $('.undo').removeClass('active-history');
                                            $('.redo').addClass('active-history');
                                        }
                                        if (get_step_now == total_history) {
                                            $('.redo').removeClass('active-history');
                                            $('.undo').addClass('active-history');
                                        }
                                    }

                                }

                                // Hiển thị thông báo
                                $("#success-notification").show();

                                // Tự động ẩn thông báo sau 3 giây
                                setTimeout(function() {
                                    $("#success-notification").hide();
                                }, 3000);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }else{
                    printErrorMsg(d.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
});


$(".replace[type='file']").on('change', function() { 
    if($(this).prop('files').length > 0)
    {
        let idproduct = $('.drag-drop').data('idproduct');
        var getupdate = localStorage.getItem("product_update_"+idproduct);
        // var json_update = JSON.parse(getupdate);
        let id = $('.active-hover').data('id');

        $('.loadingProcess').removeClass('d-none');

        $.ajax({
            url: 'https://apis.ezpics.vn/apis/savelayer',
            dataType: 'json',
            type: "POST",
            data: {
                layer : getupdate,
                id: idproduct   
            }, 
            success:function(d){
                $('.loadingProcess').addClass('d-none');

                if($.isEmptyObject(d.error)){
                    formdata = new FormData();
                    file = $(".replace[type='file']").prop('files')[0];
                    formdata.append("file", file);
                    formdata.append("id", id);
                    formdata.append("idproduct", idproduct);
                    formdata.append("width", $('#widgetCapEdit').width());
                    formdata.append("height", $('#widgetCapEdit').height());
                    $.ajax({
                        url: 'https://apis.ezpics.vn/apis/replace',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formdata, 
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                $('.nameProduct').val('');
                                $('.priceProduct').val('');
                                $('.sale_priceProduct').val('');
                                localStorage.removeItem("product_"+data.data.id);
                                localStorage.removeItem("product_update_"+data.data.id);
                                localStorage.removeItem("product_step_"+data.data.id);
                                localStorage.removeItem("activiti_"+data.data.id);
                                $('.undo').addClass('active-history');
                                $('.redo').addClass('active-history');
                                $(".content-action").removeClass("active");
                                $(".clc-action-edit").removeClass("active");


                                // lấy data mới
                                $('.nameProduct').val(data.data.name);
                                $('.priceProduct').val(parseFloat(data.data.price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                $('.sale_priceProduct').val(parseFloat(data.data.sale_price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                                // hiện thanh công cụ
                                $('.active-layer-edit').removeClass('d-none');
                                if (data.type == 'user_create') {
                                    // lấy chuyên mục đã chọn 
                                    $('.box-detail-edit-user-create #categor_pro option[value='+data.category.id+']').attr("selected",true);

                                    // lấy trạng thái đã chọn
                                    $('.box-detail-edit-user-create #status_pro option[value='+data.data.status+']').attr("selected",true);
                                }
                                // update thông tin cơ bản khi nhập
                                if (data.type == 'user_create') {
                                    update_input_info(data.data.id);
                                    update_select_info();
                                    $('.thongtin').removeClass('d-none');
                                }else{
                                    $('.thongtin').addClass('d-none');
                                }
                                // lấy danh sách user
                                $('.list-layer').html(data.list_layer_check);

                                // select layer
                                $('.setlayer').click(function () {
                                    var layer = $(this).data('layer');
                                    activeLayerSelect(layer);
                                })

                                $('.list-layout-move-create').html(data.movelayer);
                                hover();
                                check_pick_layer();
                                
                                // localStorage.setItem('layer_data', JSON.stringify(data.layer));
                                if (localStorage.getItem("product_"+data.data.id) === null) {
                                    localStorage.setItem("product_"+data.data.id, JSON.stringify(data.layer));
                                }
                                if (localStorage.getItem("product_update_"+data.data.id) === null) {
                                    localStorage.setItem("product_update_"+data.data.id, JSON.stringify(data.layer));
                                }
                                
                                if (localStorage.getItem("product_step_"+data.data.id) === null) {
                                }else{
                                    var get_step_local = localStorage.getItem("product_step_"+id);
                                    var json_step = JSON.parse(get_step_local);
                                    if(localStorage.getItem("activiti_"+data.data.id) === null) { 
                                       
                                    }else{
                                        let total_history = json_step.length;
                                        var get_step_now = localStorage.getItem("activiti_"+id);
                                        if (get_step_now > 0 && get_step_now < total_history) {
                                            $('.undo').removeClass('active-history');
                                            $('.redo').removeClass('active-history');
                                        }
                                        if (get_step_now == 0) {
                                            $('.undo').removeClass('active-history');
                                            $('.redo').addClass('active-history');
                                        }
                                        if (get_step_now == total_history) {
                                            $('.redo').removeClass('active-history');
                                            $('.undo').addClass('active-history');
                                        }
                                    }

                                }

                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }else{
                    printErrorMsg(d.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
});

function printErrorMsg (msg) 
{
    $('.loadingProcess').addClass('d-none');
    $('.list-error li').remove();
    $.each( msg, function( key, value ) {
        $(".list-error").append('<li>'+value+'</li>');
    });
    $('#validate-error').modal('show');
}

// bắt sự kiện bấm phím mũi tên
document.addEventListener('keydown', function(event) {
    if (event.code === 'ArrowDown') {
        // Xử lý khi người dùng bấm phím xuống
        bottommove();
    } else if (event.code === 'ArrowLeft') {
        // Xử lý khi người dùng bấm phím trái
        leftmove();
    } else if (event.code === 'ArrowRight') {
        // Xử lý khi người dùng bấm phím phải
        rightmove();
    } else if (event.code === 'ArrowUp') {
        // Xử lý khi người dùng bấm phím lên
        topmove();
    } else if (event.key === '+' || event.key === '=') {
      // Xử lý khi người dùng bấm phím +
      console.log('Bạn vừa bấm phím +');
      $('.zoom-in').click();
    } else if (event.key === '-') {
      // Xử lý khi người dùng bấm phím -
      console.log('Bạn vừa bấm phím -');
      $('.zoom-out').click();
    }
});

// tắt chức năng bắt sự kiện bấm phím lên xuống
window.addEventListener("keydown", function(e) {
    // Ngăn chặn sự kiện scroll khi bấm phím mũi tên lên/xuống
    if([38, 40].indexOf(e.keyCode) > -1) {
        e.preventDefault();
    }
}, false);

// xóa ảnh nền
function removeBackground()
{
    let idproduct = $('.active-hover').data('idproduct');
    let id = $('.active-hover').data('id');
    if ($('.drag-drop').hasClass('active-hover')) {
        var getupdate = localStorage.getItem("product_update_"+idproduct);
        // var json_update = JSON.parse(getupdate);
        $('.loadingProcess').removeClass('d-none');

        $.ajax({
            url: 'https://apis.ezpics.vn/apis/savelayer',
            dataType: 'json',
            type: "POST",
            data: {
                layer : getupdate,
                id: idproduct   
            }, 
            success:function(d){
                $('.loadingProcess').addClass('d-none');
                
                if($.isEmptyObject(d.error)){
                    $.ajax({
                        url: 'https://apis.ezpics.vn/apis/removeBackgroundLayer',
                        type: "POST",
                        data: {
                            id: id, // id layer cần xóa
                            idproduct: idproduct,
                        }, 
                        success:function(data){
                            console.log(data);
                            
                            if($.isEmptyObject(data.error)){
                                //xóa data cũ
                                clearDataOld(data);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }else{
                    printErrorMsg(d.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });

        
    }else{
        printErrorMsg(['Chọn layer để thao tác']);
    }
}

/*
$("#widgetCapEdit").contentZoomSlider({
  toolContainer: ".zoom-tool-bar",
  step: 5,
  max: 500,
  min: 5,
  zoom: 100
});
*/

function showFormEditText(idLayer)
{   
    $(".content-action").removeClass("active");
    $('#edittext').addClass('active');
}

function activeLayerSelect(idLayer)
{     
    $('.drag-drop').removeClass('active-hover');
    $(".content-action").removeClass("active");
    $(".clc-action-edit").removeClass("active");
    $('.drag-drop[data-id="'+idLayer+'"]').addClass('active-hover');

    checkPositionLayer();
    
    var type = $('.drag-drop.active-hover').data('type');
    

    if (type == 'text') {
        $('.image-select').addClass('d-none');
        $('.text-select').removeClass('d-none');

        //$('.thaotacchu, #thaotacchu').addClass('active');
        $('.thaotacanh, #thaotacanh').removeClass('active');
    }
    if (type == 'image') {
        $('.text-select').addClass('d-none');
        $('.image-select').removeClass('d-none');

        $('.thaotacchu, #thaotacchu').removeClass('active');
        //$('.thaotacanh, #thaotacanh').addClass('active');
    }

    $('.list-selection-choose').addClass('d-none');
    $('.drag-drop.active-hover').find('.list-selection-choose').removeClass('d-none');

    getInfoLayer();
}

function onclickBody()
{
    $("body").on("click",function(e) {
        var checkColorpicker = true;

        // nếu bấm chuột ngoài khung hiển thị xem trước
        var widgetCapEdit = document.getElementById("widgetCapEdit");
        var actionEditTheme = document.getElementById("actionEditTheme");
        var colorpicker = document.getElementsByClassName("colorpicker");

        if(colorpicker.length>0){
            var number_colorpicker = colorpicker.length - 1;
            colorpicker = colorpicker[number_colorpicker];
        }else{
            checkColorpicker = false;
        }

        if(!widgetCapEdit.contains(e.target) && !actionEditTheme.contains(e.target) && (!checkColorpicker || !colorpicker.contains(e.target))){
            $('.image, .text').removeClass('d-none');
            $('.list-selection-choose').addClass('d-none');
            $('.box-detail-edit-user-create .drag-drop').removeClass('active-hover');
        }
    });
}

function setGradientColorLayer()
{
    
    var color = $('.drag-drop.active-hover').data('color');
    var gradient = $('.drag-drop.active-hover').data('gradient');
    $("#toolbar_gradient").html('');
    let idproduct = $('.drag-drop').data('idproduct'); // id sản phẩm
    let layer = $('.active-hover').data('layer');

    updatelayerClient(layer,'gradient',idproduct,gradient);

    if(gradient=='1'){
        $('#addClassGradient').attr( 'checked', true );

        // lấy dữ liệu mã màu
        var controlPointsGradient = [];

        

        var getupdate = localStorage.getItem("product_update_"+idproduct);
        var json_update = JSON.parse(getupdate);
        var gradient_color = json_update[layer]['gradient_color'];
        let position;
      
        if(gradient_color!=undefined && gradient_color.length>0){
            
            for (let i = 0; i < gradient_color.length; i++) {
                position = gradient_color[i].position * 100;
                controlPointsGradient.push(gradient_color[i].color+" "+position+"%");
            }
            
        }

        if(controlPointsGradient.length == 0){
            controlPointsGradient = [color+" 0%",color+" 100%"];
        }

        $("#toolbar_gradient").gradientPicker({
            change: function(points, styles) {
                var textEdit = $(".active-hover span");
                let layer = $('.active-hover').data('layer');
                let idproduct = $('.active-hover').data('idproduct');
                let field = 'gradient_color';

                textEdit.css("-webkit-background-clip", 'text');
                textEdit.css("-webkit-text-fill-color", 'transparent');

                updatelayerClient(layer,field,idproduct,points);
                updatelayerClient(layer,'linear_position',idproduct,'to right');

                for (i = 0; i < styles.length; ++i) {
                    textEdit.css("background-image", styles[i]);
                }
            },

            controlPoints: controlPointsGradient
        });


    }else{
        $('#addClassGradient').attr( 'checked', false );
    }
    
}

function exportThumb()
{
    var idproduct = $('.drag-drop').data('idproduct');

    $.ajax({
            url: 'https://apis.ezpics.vn/apis/createThumb/?id='+idproduct,
            type: "GET",
            data: {}, 
            success:function(d){
                console.log(d);
                $('.loadingProcess').addClass('d-none');

                // Hiển thị thông báo
                $("#success-notification").show();

                // Tự động ẩn thông báo sau 3 giây
                setTimeout(function() {
                    $("#success-notification").hide();
                }, 3000);
                return 1;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                return 0;
            }
        });
}

function createLayerVariableText()
{
    var nameVariable = $('#nameVariableText').val();
    var variableText = $('#variableText').val();
    var variableLabel = $('#showVariableText').val();
    
    if(nameVariable != '' && variableLabel!=''){
        let idproduct = $('.drag-drop').data('idproduct');
        var getupdate = localStorage.getItem("product_update_"+idproduct);
        // var json_update = JSON.parse(getupdate);
        $('.loadingProcess').removeClass('d-none');

        $.ajax({
            url: 'https://apis.ezpics.vn/apis/savelayer',
            dataType: 'json',
            type: "POST",
            data: {
                layer : getupdate,
                id: idproduct   
            }, 
            success:function(d){
                $('.loadingProcess').addClass('d-none');
                
                if($.isEmptyObject(d.error)){
                    $.ajax({
                        url: 'https://apis.ezpics.vn/apis/createLayerVariable',
                        type: "POST",
                        data: {
                            idproduct: idproduct,
                            width: 80,
                            height: 0,
                            nameVariable: nameVariable,
                            type: 'text',
                            text: variableText,
                            variableLabel: variableLabel
                        }, 
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                //xóa data cũ
                                clearDataOld(data);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }else{
                    printErrorMsg(d.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }else{
        printErrorMsg(['Bạn không được để trống tên trường và tên biến']);
    }
}

function createLayerVariableImage()
{
    var variableLabel = $('#showVariableImage').val();
    var nameVariable = $('#nameVariableImage').val();
    
    if(nameVariable != '' && variableLabel!=''){
        let idproduct = $('.drag-drop').data('idproduct');
        var getupdate = localStorage.getItem("product_update_"+idproduct);
        // var json_update = JSON.parse(getupdate);
        $('.loadingProcess').removeClass('d-none');

        $.ajax({
            url: 'https://apis.ezpics.vn/apis/savelayer',
            dataType: 'json',
            type: "POST",
            data: {
                layer : getupdate,
                id: idproduct   
            }, 
            success:function(d){
                $('.loadingProcess').addClass('d-none');

                if($.isEmptyObject(d.error)){
                    $.ajax({
                        url: 'https://apis.ezpics.vn/apis/createLayerVariable',
                        type: "POST",
                        data: {
                            idproduct: idproduct,
                            width: 50,
                            height: 50,
                            nameVariable: nameVariable,
                            type: 'image',
                            variableLabel: variableLabel
                        }, 
                        success:function(data){
                            if($.isEmptyObject(data.error)){
                                //xóa data cũ
                                clearDataOld(data);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }else{
                    printErrorMsg(d.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }else{
        printErrorMsg(['Bạn không được để trống tên trường và tên biến']);
    }
}

function changeNameVariableText()
{
    var nameVariableText = $('#nameVariableText').val();
    
    if(nameVariableText!=''){
        nameVariableText = removeVietnameseTones(nameVariableText);
        nameVariableText = nameVariableText.replace(/[ .,:-]/g, '_');
        $('#nameVariableText').val(nameVariableText);

        nameVariableText = '%'+nameVariableText+'%';
    }

    $('#variableText').val(nameVariableText);
}

function changeNameVariableImage()
{
    var nameVariableImage = $('#nameVariableImage').val();
    
    if(nameVariableImage!=''){
        nameVariableImage = removeVietnameseTones(nameVariableImage);
        nameVariableImage = nameVariableImage.replace(/[ .,:-]/g, '_');
        $('#nameVariableImage').val(nameVariableImage);
    }
}

function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    return str;
}

function clearDataOld(data)
{
    $('.loadingProcess').addClass('d-none');

    //xóa data cũ
    $('.nameProduct').val('');
    $('.priceProduct').val('');
    $('.sale_priceProduct').val('');
    localStorage.removeItem("product_"+data.data.id);
    localStorage.removeItem("product_update_"+data.data.id);
    localStorage.removeItem("product_step_"+data.data.id);
    localStorage.removeItem("activiti_"+data.data.id);
    $('.undo').addClass('active-history');
    $('.redo').addClass('active-history');
    $(".content-action").removeClass("active");
    $(".clc-action-edit").removeClass("active");

    // lấy data mới
    $('.nameProduct').val(data.data.name);
    $('.priceProduct').val(parseFloat(data.data.price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $('.sale_priceProduct').val(parseFloat(data.data.sale_price, 10).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    // hiện thanh công cụ
    $('.active-layer-edit').removeClass('d-none');
    if (data.type == 'user_create' || data.type == 'user_series') {
        // lấy chuyên mục đã chọn 
        $('.box-detail-edit-user-create #categor_pro option[value='+data.category.id+']').attr("selected",true);

        // lấy trạng thái đã chọn
        $('.box-detail-edit-user-create #status_pro option[value='+data.data.status+']').attr("selected",true);
    }

    // update thông tin cơ bản khi nhập
    if (data.type == 'user_create' || data.type == 'user_series') {
        update_input_info(data.data.id);
        update_select_info();
        $('.thongtin').removeClass('d-none');

        if (data.type == 'user_series') {
            $('#addVariableImageButton').removeClass('d-none');
            $('#addVariableTextButton').removeClass('d-none');
        }
    }else{
        $('.thongtin').addClass('d-none');
    }

    // lấy danh sách layer
    $('.list-layer').html(data.list_layer_check);

    // select layer
    $('.setlayer').click(function () {
        var layer = $(this).data('layer');
        activeLayerSelect(layer);
    })

    $('.list-layout-move-create').html(data.movelayer);
    hover();
    check_pick_layer();

    if (localStorage.getItem("product_"+data.data.id) === null) {
        localStorage.setItem("product_"+data.data.id, JSON.stringify(data.layer));
    }
    
    if (localStorage.getItem("product_update_"+data.data.id) === null) {
        localStorage.setItem("product_update_"+data.data.id, JSON.stringify(data.layer));
    }

    if (localStorage.getItem("product_step_"+data.data.id) === null) {

    }else{
        var get_step_local = localStorage.getItem("product_step_"+id);
        var json_step = JSON.parse(get_step_local);
        if(localStorage.getItem("activiti_"+data.data.id) === null) { 
           
        }else{
            let total_history = json_step.length;
            var get_step_now = localStorage.getItem("activiti_"+id);
            if (get_step_now > 0 && get_step_now < total_history) {
                $('.undo').removeClass('active-history');
                $('.redo').removeClass('active-history');
            }
            if (get_step_now == 0) {
                $('.undo').removeClass('active-history');
                $('.redo').addClass('active-history');
            }
            if (get_step_now == total_history) {
                $('.redo').removeClass('active-history');
                $('.undo').addClass('active-history');
            }
        }

    }
}


function createThumbnail(id) {
    $.ajax({
        url: 'https://apis.ezpics.vn/apis/checkToolExportImage',
        dataType: 'json',
        type: "POST", 
        success:function(d){
            if(d.code == 1){
                console.log('Xuất ảnh bằng tool');
                return exportThumb();
            }else{
                console.log('Xuất ảnh bằng chụp');
                return capEdit(id);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('Xuất ảnh bằng chụp');
            return capEdit(id);
        }
    });
}

function checkPositionLayer()
{
    var maxtop, maxleft;
    var target = $('.active-hover');
    var rotate = target.data('rotate');

    if(target.length!=0){
        var xSelect = target.width();
        var ySelect = target.height();
        var leftSelect = target.data('left');
        var topSelect = target.data('top');

        full_width = $('#widgetCapEdit').width();
        full_height = $('#widgetCapEdit').height();
        
        maxtop = 0-ySelect*100/full_height
        maxleft = 0-xSelect*100/full_width

        if(leftSelect>=100){
            leftSelect = 99;
        }

        if(topSelect>=100){
            topSelect = 99;
        }

        if(topSelect<=maxtop){
            topSelect = maxtop+1;
        }

        if(leftSelect<=maxleft){
            leftSelect = maxleft+1;
        }

        target.css('transform', 'translate(0px, 0px) rotate('+rotate+')');
        target.css('left', leftSelect+'%');
        target.css('top', topSelect+'%');

        target.data("left", leftSelect);
        target.data("top", topSelect);
    }
}

setTimeout(saveproduct, 60000, 0);

