<?php include(__DIR__.'/../headerPublic.php') ; ?>

<style>
    #countdown {
        font-size: 30px;
        font-weight: bold;
        color: red;
    }
</style>

<main>
		<p class="text-center text-create-img" id="buttonAction" style="display: none;">
			<a href="" id="buttonDownload" class="btn btn-warning mb-2 mt-3" download="<?php echo $slug.'-'.time().'.png';?>">
				<i class="fa-solid fa-cloud-arrow-down"></i> Tải ảnh
			</a>

			 <a style="width: auto" href="/detail-series/<?php echo @$slug.'-'.@$id; ?>.html" class="btn btn-warning mb-2 mt-3" >
				<i class="fa-solid fa-pen-to-square"></i> Nhập lại thông tin
			</a> 
		</p>

		<p class="text-center text-create-img" id="countdown">60</p>
		<img id="imageId" src="/plugins/ezpics_designer/view/home/assets/img/loading-ezpics.gif" width="100%" />
</main>

<script type="text/javascript">
var imageUrl = '<?php echo $linkImageRender;?>';
var loadImage = false;

function checkImageExists(url, callback) {
    const img = new Image();
    
    img.onload = function() {
        callback(true);
    };
    
    img.onerror = function() {
        callback(false);
    };

    img.src = url;
}

function loadImageRender()
{
	if(!loadImage && imageUrl!=''){
		console.log('start load');
		checkImageExists(imageUrl, function(exists) {
		    if (exists) {
		        loadImage = true;
		        clearInterval(myInterval);

		        $('#imageId').attr("src",imageUrl);
		        $('#buttonDownload').attr("href",imageUrl);

		        $('#countdown').hide();
		        $('#buttonAction').show();

		        console.log('load thành công');
		    } else {
		        loadImage = false;
		        console.log('chưa load được');
		    }
		});
	}
}

var myInterval = setInterval(loadImageRender, 2000);

</script>

<script>
    // Thời gian đếm ngược ban đầu
    let countdownTime = 60;

    // Lấy phần tử HTML để hiển thị đếm ngược
    const countdownElement = document.getElementById('countdown');

    // Hàm cập nhật thời gian đếm ngược
    function updateCountdown() {
        // Giảm thời gian đếm ngược đi 1 giây
        countdownTime--;

        // Hiển thị thời gian đếm ngược
        countdownElement.textContent = countdownTime;

        // Nếu thời gian đếm ngược vẫn còn, tiếp tục đếm ngược
        if (countdownTime > 0) {
            setTimeout(updateCountdown, 1000);
        } else {
            countdownElement.textContent = "Bạn đợi chút hệ thống đang tạo ảnh cho bạn";
        }
    }

    // Bắt đầu đếm ngược
    setTimeout(updateCountdown, 1000);
</script>

<?php include(__DIR__.'/../footerPublic.php') ; ?>