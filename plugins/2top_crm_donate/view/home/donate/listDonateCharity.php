<!DOCTYPE html>
<html>
<head>
	<title>Danh sách đóng góp <?php echo $data->title;?></title>
	
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</head>
<style>
	body {
		position: relative;
		height: 100vh;
		width: 100vw;
		color: #000;
		background-color: #f7d425;
	}
	body:before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: url('<?php echo @$setting_value['background']; ?>');
		background-size: 100% 100%;
		background-repeat: no-repeat;
		-webkit-filter: blur(0px);
	    -o-filter: blur(0px);
	    -moz-filter: blur(0px);
	    filter: blur(0px);
	    z-index: -1;
	}

	.manmo_spiner img {
		max-height: 250px;
	}

	.wr_fowhidden {
		max-height: calc(100vh - 320px);
		overflow: auto;
	}


	.text-center > i {
		color: yellow;
		margin: 0 10px;
	}

	ol.wr_fowhidden {
		box-shadow: 0 0 20px yellow inset;
		border-radius: 4px;
		padding-left: 55px;
	}

	ol.wr_fowhidden li {
		font-weight: 500;
		margin: 10px 0!important;
		cursor: pointer;
	}

	ol.wr_fowhidden li:hover {
		font-weight: bold;
	}

	.wr_fowhidden::-webkit-scrollbar-track
	{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		border-radius: 10px;
		background-color: #F5F5F5;
	}

	.wr_fowhidden::-webkit-scrollbar
	{
		width: 12px;
		background-color: #F5F5F5;
	}

	.wr_fowhidden::-webkit-scrollbar-thumb
	{
		border-radius: 10px;
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #D62929;
	}

	@media only screen and (max-width: 1024px) {
		.wr_list_user_hist h3 {
			font-size: 16px;
		}

		.manmo_spiner img {
			max-height: 200px;
		}

		.wr_fowhidden {
			max-height: calc(100vh - 260px);
			overflow: auto;
		}
	}

	@media only screen and (max-width: 768px) {
		.manmo_spiner img {
			max-height: 150px;
		}

		.wr_fowhidden {
			max-height: calc(100vh - 365px);
			overflow: auto;
		}
	}


	@media only screen and (max-width: 576px) {
		.manmo_spiner img {
			max-height: 85px;
		}
	}


</style>
<body>
	<div class="container" style="margin: 0 auto;max-width: 100%;padding-top: 15px;">
		<center class="manmo_spiner">
			<img src="<?php echo @$setting_value['logo']; ?>">

			<h3 class="text-center" style="color: <?php echo @$setting_value['textColor']; ?>;">
				<i class="fa fa-star" aria-hidden="true"></i>
				<b>DANH SÁCH NGƯỜI ĐÓNG GÓP</b>
				<i class="fa fa-star" aria-hidden="true"></i>
			</h3>

			<p class="text-center" style="color: <?php echo @$setting_value['textColor']; ?>;">
				<b><?php echo $data->title;?></b>
			</p>
		</center>
  		<div class="row justify-content-center">
  			<div class="col-12 col-xs-12 col-sm-8 col-md-6 col-lg-6 col-xl-6">
  				<div class="wr_list_user_hist">
	      			<ol class="wr_fowhidden" style="color: <?php echo @$setting_value['textColor']; ?>;">
	      				<?php
	      				if(!empty($donates)){
	      					foreach($donates as $item){
	      						echo '<li>'.$item->full_name.' ('.$item->phone.')</li>';
	      					}
	      				}
	      				?>
	      			</ol>
	      		</div>
    		</div>
  		</div>
	</div>
	
</body>
</html>


