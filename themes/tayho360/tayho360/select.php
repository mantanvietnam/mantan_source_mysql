<?php 
	$destination = destination();
?>

<div class="mask-select" id="select_colse"></div>
 <div class="filter-option" style="margin-bottom: 10px">
	<div class="seclect">
		<div class="div_select" style="position: relative;">
			<input type="" name="" class="form-select-filter" id="select" placeholder="Danh mục điểm đến" >
		<!-- 	<i class="fas fa-angle-down" id="select"></i> -->
			<div class="pop_select">
				<ul>
					<?php
						if(!empty($destination)){
							foreach ($destination as $key => $value) { ?>
								<li><a href="<?php echo $value['urlSlug']?>"><?php echo $value['name']?></a></li>
					<?php	}
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#select').click(function(){
	$('.pop_select').css('display','block');
	$('.mask-select').css({'visibility':'visible','opacity':'1'})
});

$('#select_colse').click(function(){
	$('.pop_select').css('display','none');
  $('.mask-select').css({'visibility':'hidden','opacity':'0'})
});
</script>

