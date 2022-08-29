<?php 
	global $urlThemeActive;
?>

<div class="row text-white">
	<div class="col-12 col-sm-12 col-md-12">
		Tên mẫu thiết kế <input type="text" name="name" id="nameTemplate" value=""> 
		<input type="button" name="" value="Lưu" onclick="saveTemplate();">
		<input type="hidden" name="idTemplate" id="idTemplate" value="">
	</div>

	<div class="col-12 col-sm-12 col-md-12">
		<input type="button" name="" value="Thêm text" onclick="addTextTemplate();">
		<input type="button" name="" value="Thêm ảnh">
	</div>
</div>

<div class="row text-white" id="formAddTextTemplate" style="display: none;">
	<div class="col-12 col-sm-12 col-md-12">
		Nội dung <input type="text" name="value" id="text_value" value="">
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		Font chữ <select name="font" id="text_font"><option value="arial">Arial</option></select>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		Màu chữ <input type="text" name="color" id="text_color" value="">
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		Cỡ chữ <input type="number" name="size" id="text_size" value="">
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<input type="button" name="" value="Lưu">
	</div>
</div>