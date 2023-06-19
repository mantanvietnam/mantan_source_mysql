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

				<link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />
			</head>
			<body>
				<img src="data:image/png;base64,'.$dataImage.'" width="100%" />
			</body>
			</html>';
}
?>