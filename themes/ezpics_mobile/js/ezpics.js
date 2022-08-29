	function startLoadWeb()
	{
		$('input').attr('autocomplete','off');
	}

	function loadDataUrl(url, idSectionShow)
	{
		console.log('Call: '+url);
		$.ajax({
      method: "GET",
      url: url,
      data: {}
    })
      .done(function( msg ) {
        $(idSectionShow).html(msg);
        $('.boxShow, body, html').removeClass('active');
        $(idSectionShow+', body, html').addClass('active');
        startLoadWeb();
      });
	}

	function addClassActive(idSectionShow)
	{
		$(idSectionShow).addClass('active');
	}

	function showMess(text){
		$('#messNotifcation').html(text);
		$('#myModal').modal('show');
	}

	function regUser()
	{
		var full_name = $('#reg_full_name').val();
		var email = $('#reg_email').val();
		var phone = $('#reg_phone').val();
		var pass = $('#reg_pass').val();
		var pass_again = $('#reg_pass_again').val();

		if(full_name=='' || email=='' || phone=='' || pass=='' || pass_again==''){
			showMess('Cần nhập đầy đủ tất cả các trường thông tin');
		}else{
			if(pass!=pass_again){
				showMess('Mật khẩu nhập lại chưa đúng');
			}else{
				console.log('Đăng ký tài khoản mới');
				$.ajax({
		      method: "POST",
		      url: '/apis/saveUserRegisterAPI',
		      headers: {'X-CSRF-Token': csrfToken},
		      data: {full_name:full_name,email:email,phone:phone,pass:pass}
		    })
		      .done(function( msg ) {
		      	if(msg.code == 0){
		      		showMess('Đăng ký thành công');
		      		setTimeout(function() {window.location = '/';}, 3000);
		      	}else if(msg.code == 1){
		      		showMess('Nhập thiếu dữ liệu');
		      	}else if(msg.code == 2){
		      		showMess('Số điện thoại đã tồn tại');
		      	}
		      });
			}
		}
	}

	function checkLogin()
	{
		var phone = $('#login_phone').val();
		var pass = $('#login_pass').val();

		if(phone=='' || pass==''){
			showMess('Cần nhập đầy đủ tất cả các trường thông tin');
		}else{
			console.log('Đăng nhập tài khoản '+phone);
			$.ajax({
	      method: "POST",
	      url: '/apis/checkLoginAPI',
	      headers: {'X-CSRF-Token': csrfToken},
	      data: {phone:phone,pass:pass}
	    })
	      .done(function( msg ) {
	      	if(msg.code == 0){
	      		window.location = '/';
	      	}else if(msg.code == 1){
	      		showMess('Nhập thiếu dữ liệu');
	      	}else if(msg.code == 2){
	      		showMess('Sai số điện thoại hoặc mật khẩu');
	      	}
	      });
			
		}
	}

	function addTextTemplate()
	{
		$('#text_value').val('');
		$('#text_font').val('arial');
		$('#text_color').val('#000');
		$('#text_size').val('12');

		$('#formAddTextTemplate').show();
	}

	function saveTemplate()
	{
		var idTemplate = $('#idTemplate').val();
		var nameTemplate = $('#nameTemplate').val();
		var priceTemplate= 0;
		var layouts= '[]';
		var idCategory= 0;

		if(nameTemplate!=''){
			$.ajax({
		      method: "POST",
		      url: '/apis/saveTemplateAPI',
		      headers: {'X-CSRF-Token': csrfToken},
		      data: {id:idTemplate,name:nameTemplate,price:priceTemplate,layouts:layouts,idCategory:idCategory}
		    })
		      .done(function( msg ) {
		      	console.log('Lưu template '+nameTemplate);
		      	console.log(msg);
		      	if(msg.code == 0){
		      		$('#idTemplate').val(msg.idTemplate);
		      		showMess('Lưu thành công');
		      	}else if(msg.code == 1){
		      		showMess('Lỗi kết nối');
		      	}
		      })
		      .fail(function( msg ) {
		      	showMess('Lỗi kết nối');
		      });
	  }else{
	  	showMess('Không được để trống tên mẫu giao diện');
	  }
	}

	startLoadWeb();