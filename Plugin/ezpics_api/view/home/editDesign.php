<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />

	<title>
		<?php echo (!empty($product->name))?$product->name:'Chỉnh sửa mẫu thiết kế'; ?>
	</title>

	<link rel="stylesheet" href="https://apis.ezpics.vn/plugins/ezpics_api/view/css/style.css?time=<?php echo time();?>" />
	<link rel="stylesheet" href="https://apis.ezpics.vn/plugins/ezpics_api/view/css/style-long.css?time=<?php echo time();?>" />

	<!-- chặn Google tìm kiếm -->
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">

	<!-- thêm thư viện jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- thêm thư viện bootstrap -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- thêm thư viện font-awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- thêm thư viện slick-carousel -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- thêm thư viện animate -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- thêm thư viện interact để di chuyển các layer -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.17/interact.min.js" integrity="sha512-XcVj3UAxYb1bcxemjAU6ncOu6lhnuRz98icTuL+jrJE+2SCWFMZFc+5FaFsNikLKujDfL71c4LK5OBz1lsAKag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- thêm thư viện html2canvas để chụp ảnh màn hình -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- thêm thư viện toast jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- thêm thư viện coloris -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>
	<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>

	<!-- thêm thư viện wow -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- thêm thư viện gradientPicker -->
	<link rel="stylesheet" href="/plugins/ezpics_api/view/css/jquery.gradientPicker.css" type="text/css" />
	<link rel="stylesheet" href="/plugins/ezpics_api/view/css/colorpicker.css" type="text/css" />

	<script src="/plugins/ezpics_api/view/js/jqueryUI-custom.js"></script>
	<script src="/plugins/ezpics_api/view/js/colorpicker/colorpicker.js"></script>
	<script src="/plugins/ezpics_api/view/js/jquery.gradientPicker.js"></script>

	<!-- thêm thư viện zoom 
	<script src="/plugins/ezpics_api/view/js/content-zoom-slider.js"></script>
	-->
	<!-- thêm font chữ cài từ admin -->
	<style type="text/css">
		<?php 
		if(!empty($fonts)){
			foreach ($fonts as $key => $value) {
				$src = [];
				if(!empty($value->font_woff2)){
					$src[] = 'url("'.$value->font_woff2.'") format("woff2")';
				}

				if(!empty($value->font)){
					$src[] = 'url("'.$value->font.'") format("woff")';
				}

				if(!empty($value->font_ttf)){
					$src[] = 'url("'.$value->font_ttf.'") format("truetype")';
				}

				if(!empty($value->font_otf)){
					$src[] = 'url("'.$value->font_otf.'") format("opentype")';
				}

				echo '	@font-face {
							font-family: "'.$value->name.'";
							src: '.implode(',', $src).';
				         	font-weight: '.$value->weight.';
						    font-style: '.$value->style.';
						    font-display: swap;
						}';
			}
		}
		?>
	</style>
</head>
<body>
<?php 
	if(!empty($product) && !empty($layers)){ ?>
		<section class="box-detail-edit box-detail-edit-user-create active">
		    <div class="teop">
		        <div class="">
		        	<div class="showView">
			            <div class="thumb-checklayer list-layout-move-create" id="widgetCapEdit"></div>
			        </div>
			        <!--
		            <div class="zoom-tool-bar"></div>
		        	-->
		        </div>
		        <div class="text-center loadingProcess d-none">
		            <img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/ajax-loader-green.gif" class="img-fluid text-center loadimg" width="50">
		        </div>
		        <div id="success-notification">Lưu dữ liệu thành công</div>
		    </div>

		    <div class="container" style="padding-bottom: 100px;">
	            <div class="active-layer-edit">
	                <div class="action-edit-theme" id="actionEditTheme">
	                    <div class="list-action">
	                        <div class="item-action clc-action-edit saveproduct" onclick="saveproduct(1)">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/save.png" class="img-fluid" alt=""></div>
	                            <div class="info">Lưu</div>
	                        </div>
	                        <div class="item-action clc-action-edit thongtin" data-tab="thongtin">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/info.png" class="img-fluid" alt=""></div>
	                            <div class="info">Thông tin</div>
	                        </div>
	                        <div class="item-action clc-action-edit thaotac" data-tab="thaotac">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/add.png" class="img-fluid" alt=""></div>
	                            <div class="info">Thêm layer</div>
	                        </div>
	                        <div class="item-action clc-action-edit layerclass" data-tab="layer">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/list.png" class="img-fluid" alt=""></div>
	                            <div class="info">Layer</div>
	                        </div>
	                        <div class="item-action clc-action-edit thaotacanh image-select d-none" data-tab="thaotacanh">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/more.png" class="img-fluid" alt=""></div>
	                            <div class="info">Sửa ảnh</div>
	                        </div>
	                        <div class="item-action clc-action-edit thaotacchu text-select d-none" data-tab="thaotacchu">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/more.png" class="img-fluid" alt=""></div>
	                            <div class="info">Sửa chữ</div>
	                        </div>
	                        <div class="item-action clc-action-edit" data-tab="movelayer">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/sort.png" class="img-fluid" alt=""></div>
	                            <div class="info">Vị trí</div>
	                        </div>
	                        <div class="item-action clc-action-edit" data-tab="move">
	                            <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/move.png" class="img-fluid" alt=""></div>
	                            <div class="info">Di chuyển</div>
	                        </div>
	                    </div>
	                    <div class="list-content-action">
	                        <div class="content-action" id="layer"> 
	                            <div class="t-action-popup text-center">
	                                <span>Danh sách Layer</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <ul class="list-group list-layer w-100">
	                                    
	                                </ul>
	                            </div>
	                        </div>
	                        <div class="content-action" id="color"> 
	                            <div class="t-action-popup text-center">
	                                <span>Gradient</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <input type="color" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#fff" class="w-100 color">
	                            </div>
	                        </div>
	                        <div class="content-action" id="gradient"> 
	                            <div class="t-action-popup text-center">
	                                <span>Hiệu ứng màu Gradient</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            
	                            <p class="text-center mb-2">
	                            	<input type="checkbox" id="addClassGradient" value="1" onclick="addClassGradient()"> Áp dụng hiệu ứng Gradient
	                            </p>

	                            <div class="grad_ex" id="toolbar_gradient"></div>

	                            
	                            <!--
	                            <div class="list-chang-replace">
	                                <div class="item-replace float-left" onclick="addGradient()" style="padding: 18px;">
	                                    <img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/addcolor.png" alt="" width="25">
	                                </div>
	                                <div class="item-replace float-left" onclick="plusGradient()" style="padding: 18px;">
	                                    <img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/pluscolor.png" alt="" width="25">
	                                </div>
	                                <div class="item-replace" onclick="addClassGradient()" style="padding: 18px;">
	                                    <label>Hiển thị</label>
	                                    <input type="checkbox" id="addClassGradient" value="1">
	                                </div>
	                                <div class="item-replace" style="flex: auto;">
	                                    <div class="form-group">
	                                        <label>Vị trí:</label>
	                                        <select name="gradient_postion" class="form-select color-dropdown" id="gradient_postion">
	                                            <?php
	                                            $position = getLinearposition();
	                                            foreach($position as $k => $value){
	                                                echo '<option value="'.$k.'">'.$value.'</option>';
	                                            }
	                                            ?>
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="list-chang-replace count-gradient gra1">
	                                <div class="item-replace text-center" style="flex: auto;">
	                                    <input type="text" data-coloris id="coler1" name="coler1" class="w-100 gradientcolor" >
	                                </div>
	                                <div class="item-replace text-center" style="flex: inherit;">
	                                    <input type="text" name="postion_color1"  value="0" class="w-100 fieldcolor">
	                                </div>
	                            </div>
	                            <div class="list-chang-replace count-gradient d-none gra3">
	                                <div class="item-replace text-center" style="flex: auto;">
	                                    <input type="text" data-coloris id="coler2"  name="coler2"  class="w-100 gradientcolor" >
	                                </div>
	                                <div class="item-replace text-center" style="flex: inherit;">
	                                    <input type="text" name="postion_color3"  value="<?=  rand(5, 24); ?>" class="w-100 fieldcolor">
	                                </div>
	                            </div>
	                            <div class="list-chang-replace count-gradient d-none gra4">
	                                <div class="item-replace text-center" style="flex: auto;">
	                                    <input type="text" data-coloris id="coler3" name="coler3" value="#c27d06" class="w-100 gradientcolor" >
	                                </div>
	                                <div class="item-replace text-center" style="flex: inherit;">
	                                    <input type="text" name="postion_color4"  value="<?=  rand(25, 45); ?>" class="w-100 fieldcolor">
	                                </div>
	                            </div>
	                            <div class="list-chang-replace count-gradient d-none gra5">
	                                <div class="item-replace text-center" style="flex: auto;">
	                                    <input type="text" data-coloris id="coler4" name="coler4" value="#a206c2" class="w-100 gradientcolor" >
	                                </div>
	                                <div class="item-replace text-center" style="flex: inherit;">
	                                    <input type="text" name="postion_color5"  value="<?=  rand(55, 74); ?>" class="w-100 fieldcolor">
	                                </div>
	                            </div>
	                            <div class="list-chang-replace count-gradient d-none gra6">
	                                <div class="item-replace text-center" style="flex: auto;">
	                                    <input type="text" data-coloris id="coler5" name="coler5" value="#d56062" class="w-100 gradientcolor" >
	                                </div>
	                                <div class="item-replace text-center" style="flex: inherit;">
	                                    <input type="text" name="postion_color6"  value="<?=  rand(76, 95); ?>" class="w-100 fieldcolor">
	                                </div>
	                            </div>
	                            <div class="list-chang-replace count-gradient gra2">
	                                <div class="item-replace text-center" style="flex: auto;">
	                                    <input type="text" data-coloris id="coler6" name="coler6" value="#80e377" class="w-100 gradientcolor" >
	                                </div>
	                                <div class="item-replace text-center" style="flex: inherit;">
	                                    <input type="text" name="postion_color2"  value="100" class="w-100 fieldcolor">
	                                </div>
	                            </div>
	                        	-->
	                        </div>
	                        <div class="content-action" id="dinhdang"> 
	                            <div class="t-action-popup text-center">
	                                <span>Định dạng</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="item-replace text-center active-history weight" onclick="ddang('weight')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/weight.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center active-history italic" onclick="ddang('italic')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/inherit.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center active-history under" onclick="ddang('under')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/under.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center active-history uppercase" onclick="ddang('uppercase')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/uppercase.png" class="img-fluid" alt=""></div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="canchinh"> 
	                            <div class="t-action-popup text-center">
	                                <span>Căn chỉnh</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="item-replace text-center active-history left cchinh" onclick="canchinh('left')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/text_align_left.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center active-history center cchinh" onclick="canchinh('center')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/text_align_center.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center active-history right cchinh" onclick="canchinh('right')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/text_align_right.png" class="img-fluid" alt=""></div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="giancach"> 
	                            <div class="t-action-popup text-center">
	                                <span>Giãn cách</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="action-ranger">
	                                <div class="quant-range">
	                                    <div class="txt">Giãn cách chữ</div>
	                                </div>
	                                <div class="range-slider">
	                                    <input class="range-slider__range gianchu" value="0" type="range" min="0" max="100">
	                                    <span class="range-slider__value gianchuz">0</span>
	                                </div>
	                            </div>
	                             <div class="action-ranger">
	                                <div class="quant-range">
	                                    <div class="txt">Giãn cách dòng</div>
	                                </div>
	                                <div class="range-slider">
	                                    <input class="range-slider__range giandong" value="0" type="range" min="0" max="100">
	                                    <span class="range-slider__value giandongz">0</span>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="opacity"> 
	                            <div class="t-action-popup text-center">
	                                <span>Kéo để chỉnh sửa</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="action-ranger">
	                                <div class="quant-range">
	                                    <div class="txt">Độ trong</div>
	                                </div>
	                                <div class="range-slider">
	                                    <input class="range-slider__range opacity" value="100" type="range" min="1" max="100">
	                                    <span class="range-slider__value opacityz">100</span>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="border"> 
	                            <div class="t-action-popup text-center">
	                                <span>Kéo để chỉnh sửa</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="action-ranger">
	                                <div class="quant-range">
	                                    <div class="txt">Bo góc</div>
	                                </div>
	                                <div class="range-slider">
	                                    <input class="range-slider__range border" value="0" type="range" min="0" max="100">
	                                    <span class="range-slider__value borderz">0</span>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="rotate"> 
	                            <div class="t-action-popup text-center">
	                                <span>Kéo để chỉnh sửa</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="action-ranger">
	                                <div class="quant-range">
	                                    <div class="txt">Xoay góc</div>
	                                </div>
	                                <div class="range-slider">
	                                    <input class="range-slider__range rotate" value="0" type="range" min="0" max="360">
	                                    <span class="range-slider__value rotatez">0</span>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="editimage"> 
	                            <div class="t-action-popup text-center">
	                                <span>Kéo để chỉnh sửa</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="action-ranger">
	                                <div class="quant-range">
	                                    <div class="txt">Kéo chỉnh thước ảnh</div>
	                                </div>
	                                <div class="range-slider">
	                                    <input class="range-slider__range sizeimg" value="16" type="range" min="1" max="100" data-class="sizeimgz">
	                                    <span class="range-slider__value sizeimgz">16</span>
	                                </div>
	                                <span>hoặc</span>
	                                <div class="form-group w-100">
	                                    <label class="txt">Nhập thước ảnh:</label>
	                                    <input type="text" class="sizeimgz form-control"/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="cochu"> 
	                            <div class="t-action-popup text-center">
	                                <span>Kéo để chỉnh sửa</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="action-ranger">
	                                <div class="quant-range">
	                                    <div class="txt">Cỡ chữ</div>
	                                </div>
	                                <div class="range-slider">
	                                    <input class="range-slider__range font" value="16" type="range" min="1" max="100" data-class="fontz">
	                                    <span class="range-slider__value fontz">16</span>
	                                </div>
	                                <span>hoặc</span>
	                                <div class="form-group w-100">
	                                    <label class="txt">Nhập kích thước chữ:</label>
	                                    <input type="text" class="fontz form-control"/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="thongtin"> 
	                            <div class="t-action-popup text-center">
	                                <span>Thông tin</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="form-group w-100">
	                                    <label>Tên mẫu thiết kế:</label>
	                                    <input type="text" name="nameProduct" class="thongtininput form-control nameProduct" data-field="name"/>
	                                </div>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="form-group w-100">
	                                    <label>Giá thị trường:</label>
	                                    <input type="text" name="priceProduct" class="thongtininput form-control priceProduct currency" data-field="price"/>
	                                </div>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="form-group w-100">
	                                    <label>Giá bán:</label>
	                                    <input type="text" class="thongtininput form-control sale_priceProduct currency" name="sale_priceProduct" data-field="sale_price"/>
	                                </div>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="form-group w-100">
	                                    <label>Chuyên mục:</label>
	                                    <select name="categor_pro " class="form-select color-dropdown" id="categor_pro">
	                                    	<?php 
	                                    	if(!empty($categories)){
	                                    		foreach ($categories as $cat) {
	                                    			echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';
	                                    		}
	                                    	}
	                                    	?>
	                                    </select>
	                                </div>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="form-group w-100">
	                                    <label>Trạng thái:</label>
	                                    <select name="status_pro" class="form-select color-dropdown" id="status_pro">
	                                        <option value="1">Đề nghị bán</option>
	                                        <option value="0">Ẩn chưa bán</option>
	                                    </select>
	                                </div>
	                            </div>
	                            <div class="list-chang-replace">
	                            	<div class="item w-100 mb-2">
	                            		<label>Ảnh minh họa:</label>
	                                    <div class="i-flx">
	                                        <div class="flex-upload">
	                                            <input type="file" class="upimgThumbnail" id="thumbnail"/>
	                                            <label for="thumbnail"></label> 
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="phongchu"> 
	                            <div class="t-action-popup text-center">
	                                <span>Phông chữ</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="form-group w-100">
	                                    <select name="font-family " class="form-select color-dropdown" id="font-family" >
	                                    	<option value="">Chọn font chữ</option>
	                                    	<option value="Arial">Arial</option>
	                                    	<option value="Times New Roman">Times New Roman</option>
	                                    	<option value="Verdana">Verdana</option>
	                                    	<option value="Tahoma">Tahoma</option>
	                                    	<option value="Helvetica">Helvetica</option>
	                                    	<option value="Calibri">Calibri</option>
	                                    	<option value="Cambria">Cambria</option>
	                                    	<option value="Georgia">Georgia</option>
	                                    	<option value="Trebuchet MS">Trebuchet MS</option>
	                                    	<?php 
	                                    	if(!empty($fonts)){
	                                    		foreach ($fonts as $f) {
	                                    			echo '<option value="'.$f->name.'">'.$f->name.'</option>';
	                                    		}
	                                    	}
	                                    	?>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="edittext"> 
	                            <div class="t-action-popup text-center">
	                                <span>Sửa nội dung</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="form-group w-100">
	                                    <textarea class="form-control" id="textProduct" rows="3"></textarea>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="thaotac"> 
	                            <div class="t-action-popup text-center">
	                                <span>Thêm mới layer</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <!-- <div class="item-replace text-center" onclick="duplicate()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/duplicate.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Sao chép</div>
	                                </div> -->
	                                <div class="item-replace text-center" onclick="add()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/add.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Thêm chữ</div>
	                                </div>
	                                <!-- <div class="item-replace text-center" onclick="deleted()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/remove.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Xóa</div>
	                                </div> -->
	                                <div class="item-replace text-center imgupload" data-tab="listanh">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/image-upload.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Thêm ảnh</div>
	                                </div>

	                                <div class="item-replace text-center d-none imgupload" id="addVariableTextButton" data-tab="addVariableText">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/add.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Thêm biến chữ</div>
	                                </div>

	                                <div class="item-replace text-center d-none imgupload" id="addVariableImageButton" data-tab="addVariableImage">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/image-upload.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Thêm biến ảnh</div>
	                                </div>
	                                <!--
	                                <div class="item-replace text-center undo active-history" onclick="undo()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/back.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Undo</div>
	                                </div>
	                                <div class="item-replace text-center redo active-history" onclick="redo()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/next.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Redo</div>
	                                </div>

	                            	-->
	                                
	                                <!-- <div class="item-replace text-center  clc-action-edit thaotac" data-tab="movelayer">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/sort.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Vị trí</div>
	                                </div>
	                                
	                                <div class="item-replace text-center  clc-action-edit thaotac" data-tab="move">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/move.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Di chuyển</div>
	                                </div> -->
	                            </div>
	                        </div>
	                        <div class="content-action" id="thaotacanh"> 
	                            <div class="t-action-popup text-center">
	                                <span>Thao tác ảnh</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="item-replace text-center clc-action-edit image" data-tab="editimage">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/sizeimage.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Kích thước</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit image" data-tab="thayanh">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/4074990.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Thay ảnh</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit image" data-tab="opacity">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/opacity.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Độ trong</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit image" onclick="confirmModal('Sử dụng chức năng này bạn sẽ phải mất phí là 10.000đ. Bạn có đồng ý không?', 'removeBackground')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/remove-background.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Xóa nền</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit image" data-tab="border">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/border.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Bo góc</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit image" data-tab="rotate">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/rotate.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Xoay góc</div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="thaotacchu"> 
	                            <div class="t-action-popup text-center">
	                                <span>Thao tác chữ</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="item-replace text-center clc-action-edit text" data-tab="edittext">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/edit.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Sửa</div>
	                                </div>
	                                <div class="item-replace text-center" onclick="duplicate()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/duplicate.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Sao chép</div>
	                                </div>
	                                <div class="item-replace text-center" onclick="confirmModal('Bạn có chắc chắn muốn xóa layer này không? Đây là thao tác không thể đảo ngược', 'deleted')">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/remove.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Xóa</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="phongchu">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/text.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Phông chữ</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="cochu">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/size.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Cỡ chữ</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="editimage">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/sizeimage.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Kích thước</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="color">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/color.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Màu</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="gradient">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/gradient.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Gradient</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="dinhdang">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/effect.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Định dạng</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="canchinh">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/text_align_center.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Căn chỉnh</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="giancach">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/distance.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Giãn cách</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="opacity">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/opacity.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Độ trong</div>
	                                </div>
	                                <div class="item-replace text-center clc-action-edit text" data-tab="rotate">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/rotate.png" class="img-fluid" alt=""></div>
	                                    <div class="info">Xoay góc</div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="content-action" id="addVariableText"> 
	                            <div class="t-action-popup text-center">
	                                <span>Biến chữ</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
									<div class="form-group w-100">
										<p>Tên trường dữ liệu (*):</p>
										<input type="text" value="" name="showVariableText" id="showVariableText" class="form-control" >

										<p>Tên biến (*):</p>
										<input type="text" value="" name="nameVariableText" id="nameVariableText" class="form-control" onchange="changeNameVariableText();" >

										<p>Nội dung chữ:</p>
										<input type="text" value="" name="variableText" id="variableText" class="form-control mb-3" >


										<button type="button" class="btn btn-warning" onclick="createLayerVariableText();">Tạo biến chữ</button>
									</div>
								</div>
	                        </div>

	                        <div class="content-action" id="addVariableImage"> 
	                            <div class="t-action-popup text-center">
	                                <span>Biến ảnh</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
									<div class="form-group w-100">
										<p>Tên trường dữ liệu (*):</p>
										<input type="text" value="" name="showVariableImage" id="showVariableImage" class="form-control" >

										<p>Tên biến (*):</p>
										<input type="text" value="" name="nameVariableImage" id="nameVariableImage" onchange="changeNameVariableImage();" class="form-control mb-3" >


										<button type="button" class="btn btn-warning" onclick="createLayerVariableImage();">Tạo biến ảnh</button>
									</div>
								</div>
	                        </div>

	                        <div class="content-action" id="listanh"> 
	                            <div class="t-action-popup text-center">
	                                <span>Chọn ảnh</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div>
	                                <div class="item w-100 mb-2">
	                                    <div class="i-flx">
	                                        <div class="flex-upload">
	                                            <input type="file" class="upimg" id="22"/>
	                                            <label for="22"></label> 
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="list-img w-100">
	                                    
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="thayanh"> 
	                            <div class="t-action-popup text-center">
	                                <span>Chọn ảnh</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div>
	                                 <div class="item w-100 mb-2">
	                                    <div class="i-flx">
	                                        <div class="flex-upload">
	                                            <input type="file" class="replace" id="33"/>
	                                            <label for="33"></label> 
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="list-img w-100">
	                                    
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="movelayer"> 
	                            <div class="t-action-popup text-center">
	                                <span>Đổi vị trí</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="item-replace text-center" onclick="sort(1)">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/moveup.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center" onclick="sort(2)">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/movedown.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center" onclick="sort(3)">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/5302607.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center" onclick="sort(4)">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/5302608.png" class="img-fluid" alt=""></div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="content-action" id="move"> 
	                            <div class="t-action-popup text-center">
	                                <span>Di chuyển</span>
	                                <a href="javascript:void(0)" class="clc-close-action">&times;</a>
	                            </div>
	                            <div class="list-chang-replace">
	                                <div class="item-replace text-center" onclick="leftmove()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/left.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center" onclick="topmove()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/up.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center" onclick="bottommove()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/down.png" class="img-fluid" alt=""></div>
	                                </div>
	                                <div class="item-replace text-center" onclick="rightmove()">
	                                    <div class="icon"><img src="https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/right.png" class="img-fluid" alt=""></div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	    	</div>
		</section>

		<div class="modal fade" id="validate-error" style="z-index: 99999999999999999;">
		    <div class="modal-dialog dialog-pay">
		        <div class="modal-content">
		            <div class="modal-body">
		                <div class="content-popup text-center">
		                    <ul class="list-error list-unstyled pb-3"> </ul>
		                    <a href="javascript:void(0)" data-bs-dismiss="modal">Thử lại</a>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="confirmModal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Xác nhận yêu cầu</h5>
		        
		        <span aria-hidden="true" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</span>
		        
		      </div>
		      <div class="modal-body">
		        
		      </div>
		      <div class="modal-footer">
		        <button type="button" id="buttonActionConfirm" data-bs-dismiss="modal" class="btn btn-primary">Xác nhận</button>
		      </div>
		    </div>
		  </div>
		</div>

		<script type="text/javascript" src="https://apis.ezpics.vn/plugins/ezpics_api/view/js/edit_design.js?time=<?php echo time();?>"></script>

		<script type="text/javascript">
			editThemeUser(<?php echo $product->id;?>);
		</script>
	<?php }else{
		echo '<center>Bạn không có quyền chỉnh sửa mẫu thiết kế này</center>';
	}
?>

<!-- thêm thư viện local -->
<script src="/plugins/ezpics_api/view/js/private.js"></script>

</body>
</html>

