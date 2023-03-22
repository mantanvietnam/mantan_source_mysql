<?php 
	global $urlThemeActive;
?>

<div class="teop">
	<div class="container">
		<div class="avar-thumb">
			<div class="draggable drag-1"><span><img src="<?php echo $urlThemeActive;?>images/logo.png" class="img-fluid" alt=""></span></div>
			<div class="draggable drag-2"><span>Layer 2</span></div>
			<div class="draggable drag-3"><span><img src="<?php echo $urlThemeActive;?>images/menu-1.png" class="img-fluid" alt=""></span></div>
			<div class="draggable drag-4"><span>Layer 4</span></div>
			<div class="draggable drag-5"><span>Layer 5</span></div>
		</div>
		<div class="btn-method-layer">
			<ul>
				<li><a href="javascript:void(0)" class="clc_layer layer-1" onclick="showTab('#listLayerTemplate','#settingTemplate');">Cài đặt</a></li>
				<li><a href="javascript:void(0)" class="clc_layer layer-2" onclick="showTab('#settingTemplate','#listLayerTemplate');">Thông tin</a></li>
			</ul>
		</div>
		<div class="line"></div>
	</div>
</div>
<div class="container">
	<div class="active-event" id="listLayerTemplate">
		<div class="choose-top">
			<ul>
				<li><a href="javascript:void(0)" data-tab="tab-1" data-lock="lock-1" class="active"><span>Layer 1</span></a></li>
				<li><a href="javascript:void(0)" data-tab="tab-2" data-lock="lock-2" class=""><span>Text 2</span></a></li>
				<li><a href="javascript:void(0)" data-tab="tab-3" data-lock="lock-3" class=""><span>Layer 3</span></a></li>
				<li><a href="javascript:void(0)" data-tab="tab-4" data-lock="lock-4" class=""><span>Layer 4</span></a></li>
				<li><a href="javascript:void(0)" data-tab="tab-5" data-lock="lock-5" class=""><span>Layer 5</span></a></li>
			</ul>
			<div id="console" class="d-none"></div>
		</div>
		<div class="content-tab-choose active" id="tab-1">
			<div class="top">
				<div class="left">
					<div class="lock-layer">
						<a href="javascript:void(0)" id="lock-1"></a>
					</div>
				</div>
				<div class="right">
					<ul>
						<li><a href="javascript:void(0)" class="clc-copy"><img src="images/copy.png" class="img-fluid" alt=""></a></li>
						<li><a href="javascript:void(0)" class="clc-remove"><img src="images/remove.png" class="img-fluid" alt=""></a></li>
					</ul>
				</div>
			</div>
			<div class="frm-layer">
				<div class="item flex-1">
					<div class="i-flx">
						<span>Ảnh:</span>
						<input type="file" id="1001">
						<label for="1001"><img src="images/upload.png" class="img-fluid" alt=""></label>
					</div>
				</div>
				<div class="item flex-3">
					<div class="i-flx">
						<span>Kiểu:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>Viền:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>Màu viền:</span>
						<input type="text">
					</div>	
				</div>
				<div class="item flex-2">
					<div class="i-flx">
						<span>X:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>Y:</span>
						<input type="text">
					</div>	
				</div>
				<div class="item flex-2">
					<div class="i-flx">
						<span>W:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>H:</span>
						<input type="text">
					</div>	
				</div>
			</div>
		</div>
		<div class="content-tab-choose" id="tab-2">
			<div class="top">
				<div class="left">
					<div class="lock-layer">
						<a href="javascript:void(0)" id="lock-2"></a>
					</div>
				</div>
				<div class="right">
					<ul>
						<li><a href="javascript:void(0)" class="clc-copy"><img src="images/copy.png" class="img-fluid" alt=""></a></li>
						<li><a href="javascript:void(0)" class="clc-remove"><img src="images/remove.png" class="img-fluid" alt=""></a></li>
					</ul>
				</div>
			</div>
			<div class="frm-layer">
				<div class="item flex-2">
					<div class="i-flx">
						<span>Text:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>Font:</span>
						<input type="text">
					</div>	
				</div>
				<div class="item flex-3">
					<div class="i-flx">
						<span>Cỡ:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>Căn:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>Màu:</span>
						<input type="text">
					</div>	
				</div>
				<div class="item flex-2">
					<div class="i-flx">
						<span>X:</span>
						<input type="text">
					</div>	
					<div class="i-flx">
						<span>Y:</span>
						<input type="text">
					</div>	
				</div>
				<div class="item flex-2">
					<div class="i-flx">
						<span>W:</span>
						<input type="text">
					</div>	 
					<div class="i-flx">
						<span>H:</span>
						<input type="text">
					</div>	
				</div>
			</div>
		</div>
		<div class="content-tab-choose" id="tab-3">
			<div class="frm-layer frm-layer-kt">
				<div class="item flex-1">
					<div class="i-flx d-block">
						<span style="display: block">Chiều dài:</span>
						<input type="text" class="txt_fx">
					</div>		
				</div>
				<div class="item flex-1">
					<div class="i-flx d-block">
						<span style="display: block">Độ cao:</span>
						<input type="text" class="txt_fx">
					</div>		
				</div>
				<div class="item flex-1">
					<div class="i-flx d-block">
						<span style="display: block">Màu nền:</span>
						<input type="text" class="txt_fx">
					</div>		
				</div>
				<div class="item flex-1">
					<div class="i-flx d-block">
						<span>Demo ảnh:</span>
						<input type="file" id="1001">
						<label for="1001"><img src="images/upload.png" class="img-fluid" alt=""></label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="active-event" id="settingTemplate" style="display: block;">
		<div class="content-tab-choose active">
			<div class="frm-layer">
				<div class="item flex-1">
					<div class="i-flx">
						<span>Tên mẫu thiết kế</span>
						<input type="text" name="name" id="nameTemplate" value="">
						<input type="hidden" name="idTemplate" id="idTemplate" value="">
					</div>
				</div>

				<div class="item flex-1">
					<div class="i-flx">
						<span>Chuyên mục</span>
						<ul>
							<?php 
							if(!empty($category_ezpics)){
								foreach ($category_ezpics as $item) {
									echo '<li><input type="radio" value="'.$item->id.'" name="" /> '.$item->name.'</li>';
								}
							}
							?>
						</ul>
					</div>
				</div>

				<div class="btn-method-layer">
					<a href="javascript:void(0)" class="clc_layer layer-2" onclick="saveTemplate();" style="display: inline-flex;padding: 5px;">Lưu template</a>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row text-white">

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