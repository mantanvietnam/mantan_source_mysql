<?php 
if(!empty($_GET['id'])){ 
	// Giải mã dữ liệu base64
	$imageData = base64_decode($dataImage);

	// Kiểm tra nếu dữ liệu ảnh hợp lệ
	if ($imageData !== false) {
	    // Thiết lập header phù hợp với định dạng ảnh
	    header("Content-type: image/png");

	    // Hiển thị ảnh
	    echo $imageData;
	} else {
	    // Hiển thị thông báo lỗi nếu dữ liệu ảnh không hợp lệ
	    echo "Invalid image data";
	}
}else{
	echo '	<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Hình ảnh Ezpics</title>

				<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

				<link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />
			</head>
			<body>
				<p class="text-center">
					<button type="button" class="btn btn-warning mb-2 mt-3" onclick="downloadImage();">
					  Tải ảnh
					</button>
				</p>
				<img id="imageId" src="data:image/png;base64,'.$dataImage.'" width="100%" />

				<script type="text/javascript">
					var slug= "'.$slug.'";

					function downloadImage()
					{
						// Truy cập đến phần tử hình ảnh
						var imageElement = document.getElementById("imageId");

						// Lấy đường dẫn (URL) của hình ảnh
						var imageURL = imageElement.src;

						// Tạo đối tượng anchor
						var a = document.createElement("a");
						a.href = imageURL;

						// Thiết lập thuộc tính download cho anchor
						a.download = slug+".jpg";

						// Gắn anchor vào phần tử body
						document.body.appendChild(a);

						// Simulate click để tải xuống
						a.click();

						// Xóa anchor sau khi tải xuống
						document.body.removeChild(a);
					}
				</script>
			</body>
			</html>';
}
?>