
$(window).scroll(function() {    
  var scroll = $(window).scrollTop();

  if (scroll >= 120) {
    $('.header-fix').addClass("scroll-on");
  } else {
    $('.header-fix').removeClass("scroll-on");
  }
});

// giỏ hàng
$('.box-icon-cart').click(function(){
  $('.wr-cart').css('right','0');
})
$('.colse-cart-mobile').click(function(){
  $('.wr-cart').css('right','-510px');
})

$('.thanhToan').click(function(){
  $('.wr-thanh-toan').css('right','0px');
})

$('.colse-cart-mobile').click(function(){
  $('.wr-thanh-toan').css('right','-510px');
})

// menu mobile
$('.icon-menu-mobile').click(function(){
  $('.menu-mobile').css('left','0');
  $('.mask-mobile').css({'visibility':'visible','opacity':'1'})
})

$('.colse-menu-mobile').click(function(){
  $('.menu-mobile').css('left','-300px');
  $('.mask-mobile').css({'visibility':'hidden','opacity':'0'})
})



function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function increaseCount(a, b) {
  var input = b.previousElementSibling;
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;
}

function decreaseCount(a, b) {
  var input = b.nextElementSibling;
  var value = parseInt(input.value, 10);
  if (value > 1) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
  }
}

function showAlertAdd(event) {
  $(event).children('.messAdd').css({'visibility':'visible','opacity':'1'}); 
  setTimeout(function(){
  $(event).children('.messAdd').css({'visibility':'hidden','opacity':'0'})
  },1000);


  // var ramdom = Math.floor(Math.random() * 1000);
  // $('.box-alert-add').append('<p class="id'+ramdom+'">Đã thêm vào giỏ hàng.</p>');
  // $('.wr-alert-add').css({'opacity':'1','visibility':'visible','transform':'translateY(0)'});
  // var idTime = setTimeout(function(){
  //   $('.wr-alert-add').css({'opacity':'0','visibility':'hidden','transform':'translateY(-25px)'});
  // },3000);
  // setTimeout(function(){
  //   $('.id'+ramdom).remove();
  // },3000);
  // if($('.box-alert-add').children().length > 0) {
  //   clearTimeout(idTime);
  //    var idTime = setTimeout(function(){
  //     $('.wr-alert-add').css({'opacity':'0','visibility':'hidden','transform':'translateY(-25px)'});
  //   },3000);
  // }
}

function addToCart(event,id,numberOrder=1) {
  if(numberOrder!=1) {
    var numberOrder = $('#numberOrder').val();
  }
  $.ajax({
    type: "POST",
    url: "/saveOrderProduct_addProduct_ajax",
    data: {id:id,numberOrder:numberOrder}
  }).done(function( msg ) {
    var msg = JSON.parse(msg);
    $('.box-item-cart').append(msg.text);
    $('.total-price').text(new Intl.NumberFormat('de-DE').format(msg.total));
    countItem(msg.count);
    if(msg.updateKey != -1) {
      $('.numberUpdate'+msg.updateKey).text(msg.updateNumber);
      $('.numberUpdateInput'+msg.updateKey).val(msg.updateNumber);
      showAlertAdd(event);
    }
  });
}

function XoaItem(b) {
  $(b).parents('.item-cart').css({'transform':'translateX(510px)','max-height':'0','padding':'0'});
  setTimeout(function(){
    $(b).parents('.item-cart').remove();
  },500)
}
function countItem(b) {
  if(b==0) {
    $('.wr-cart-footer button').attr('disabled','disabled');
  }else {
    $('.wr-cart-footer button').removeAttr('disabled');
  }
  $('.count-number-order').text(b);
}

function deleteItem(key, b) {
  $.ajax({
    type: "POST",
    url: "/saveOrderProduct_deleteProductCart_ajax",
    data: {key:key}
  }).done(function( msg ) {
    var msg = JSON.parse(msg);
    console.log(msg);
    XoaItem(b);
    countItem(msg.count);
    $('.total-price').text(new Intl.NumberFormat('de-DE').format(msg.total));
  });
}

function decreaseUpdateOrder(a, b, key) {
  var input = b.nextElementSibling;
  var value = parseInt(input.value, 10);
  if (value > 1) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
  }
  $.ajax({
    type: "POST",
    url: "/updateOrder_ajax",
    data: {key:key,value:value}
  }).done(function( msg ) {
    var msg = JSON.parse(msg);
    $('.numberUpdate'+msg.updateKey).text(msg.updateNumber);
    $('.total-price').text(msg.total);
    console.log(msg);
  });
}

function increaseUpdateOrder(a, b, key) {
  var input = b.previousElementSibling;
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;
  $.ajax({
    type: "POST",
    url: "/updateOrder_ajax",
    data: {key:key,value:value}
  }).done(function( msg ) {
    var msg = JSON.parse(msg);
    $('.numberUpdate'+msg.updateKey).text(msg.updateNumber);
    $('.total-price').text(msg.total);
    console.log(msg);
  });
}

function updateOrderDow(b, key) {
  var input = b.nextElementSibling;
  var value = parseInt(input.value, 10);
  if (value > 1) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
  }
  $.ajax({
    type: "POST",
    url: "/updateOrder_ajax",
    data: {key:key,value:value}
  }).done(function( msg ) {
    var msg = JSON.parse(msg);
    $('.numberUpdate'+key).text(value);
    $('.total-price').text(new Intl.NumberFormat('de-DE').format(msg.total));
    console.log(msg);
  });
}

function updateOrderUp(b, key) {
  var input = b.previousElementSibling;
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;
  $.ajax({
    type: "POST",
    url: "/updateOrder_ajax",
    data: {key:key,value:value}
  }).done(function( msg ) {
    var msg = JSON.parse(msg);
    $('.numberUpdate'+key).text(value);
    $('.total-price').text(new Intl.NumberFormat('de-DE').format(msg.total));
    console.log(msg);
  });
}

function updateOrder(b, key) {
  var value = $('.numberUpdateInput'+key).val();
  if(value=='') {
    value = 1;
    $('.numberUpdateInput'+key).val(value);
  }
  $.ajax({
    type: "POST",
    url: "/updateOrder_ajax",
    data: {key:key,value:value}
  }).done(function( msg ) {
    var msg = JSON.parse(msg);
    $('.numberUpdate'+key).text(value);
    $('.total-price').text(new Intl.NumberFormat('de-DE').format(msg.total));
    console.log(msg);
  });
}

function thanhToan(e) {
  var hoten = $('#hoten').val();
  var sdt = $('#sdt').val();
  var email = $('#email').val();
  var diachi = $('#diachi').val();
  var ghichu = $('#ghichu').val();
  checkEmail = true;
  $(e).text('Xin chờ...');
  $('.wr-cart-footer button').attr('disabled','disabled');
  if(email != '') {
    var checkEmail = validateEmail(email);
  }
  if(checkEmail==true && sdt !='') {
    $.ajax({
    type: "POST",
    url: "/saveOrderProduct_addOrder_ajax",
    data: {fullname:hoten,phone:sdt,email:email,address:diachi,note:ghichu}
    }).done(function( msg ) {
    var msg = JSON.parse(msg);
    alert(msg.mess);
    $('.wr-thanh-toan').css('right','-510px');
    $('.wr-cart').css('right','-510px');
    $('.total-price').text(0);
    $('.box-item-cart').html('');
    $('.count-number-order').text('0');
    $('.wr-cart-footer button').attr('disabled','disabled');
    $(e).text('Xác nhận');
    });
  }else {
    alert('Email hoặc số điện thoại không hợp lệ.');
  }
}

//set order to
function setOrder() {
  var fullName = $('#fullName').val();
  var phone = $('#phone').val();
  var dateSet = $('#dateSet').val();
  var note = $('#note').val();
  if(dateSet=='' || fullName=='' || phone=='') {
    alert('Bạn cần nhập Họ tên, Số điện thoại và Ngày hẹn');
  }else {
    $.ajax({
      type: "POST",
      url: "/setOrder_ajax",
      data: {fullName:fullName,phone:phone,dateSet:dateSet,note:note}
    }).done(function( msg ) {
      alert(msg);
      $('#modalSetOrder').modal('hide');
    });
  }
}


