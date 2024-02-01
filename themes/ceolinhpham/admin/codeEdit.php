<script type="text/javascript">
	function editThemeText(content, nameItem)
	{
		$('#editTextContent').val(content);
		$('#nameItem').val(nameItem);
		$('#showEditText').modal('show');
	}

	function editThemeTextarea(content, nameItem)
	{
		$('#contentTextarea').val(content);
		$('#nameItemTextarea').val(nameItem);
		$('#showEditTextarea').modal('show');
	}

	function editThemeMedia(content, nameItem)
	{
		$('#contentMedia').val(content);
		$('#nameItemMeida').val(nameItem);
		$('#showEditUpload').modal('show');
	}

	function editThemeEditer(content, nameItem)
	{
		CKEDITOR.instances['contentEditer'].setData(content);
		$('#nameItemEditer').val(nameItem);
		$('#showEditer').modal('show');
	}
</script>

<div id="showEditText" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
      			<div class="modal-header">
      				<h4 class="modal-title">Thay đổi nội dung</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
    			</div>
    			<div class="modal-body">
    				<input type="text" name="content" value="" id="editTextContent" class="form-control" placeholder="Nhập nội dung mới vào đây">
        			<input type="hidden" name="nameItem" value="" id="nameItem">
    			</div>
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    			</div>
			</form>
		</div>
	</div>
</div>

<div id="showEditTextarea" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
      			<div class="modal-header">
      				<h4 class="modal-title">Thay đổi nội dung</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
    			</div>
    			<div class="modal-body">
        			<textarea name="contentTextarea" value="" id="contentTextarea" class="form-control" placeholder="Nhập nội dung mới vào đây" rows="5"></textarea>
        			<input type="hidden" name="nameItemTextarea" value="" id="nameItemTextarea">
    			</div>
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    			</div>
			</form>
		</div>
	</div>
</div>

<div id="showEditUpload" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
      			<div class="modal-header">
      				<h4 class="modal-title">Thay đổi hình ảnh/video</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
    			</div>
    			<div class="modal-body">
    				<?php                    
					    showUploadFile('contentMedia','contentMedia','',0);
					?>
        			<input type="hidden" name="nameItemMeida" value="" id="nameItemMeida">
    			</div>
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    			</div>
			</form>
		</div>
	</div>
</div>

<div id="showEditer" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="" method="post">
      			<div class="modal-header">
      				<h4 class="modal-title">Thay đổi nội dung</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
    			</div>
    			<div class="modal-body">
    				<?php     
    					showEditorInput('contentEditer','contentEditer','',1);    
					?>
        			<input type="hidden" name="nameItemEditer" value="" id="nameItemEditer">
    			</div>
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    			</div>
			</form>
		</div>
	</div>
</div>

 <a id="myBtn" title="Go to admin" href="/admins">Back</a> 

 <style type="text/css">
 #myBtn {
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: red; /* Set a background color */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 15px; /* Some padding */
  border-radius: 10px; /* Rounded corners */
  font-size: 18px; /* Increase font size */
}

#myBtn:hover {
  background-color: #555; /* Add a dark-grey background on hover */
}
 </style>