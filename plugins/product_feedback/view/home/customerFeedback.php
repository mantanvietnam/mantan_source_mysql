<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $metaTitleMantan;?></title>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="container">
    <?= $this->Form->create(); ?>
      <input type="hidden" name="id_messenger" value="<?php echo @$_GET['id_messenger'];?>">
      <input type="hidden" name="avatar" value="<?php echo @$_GET['avatar'];?>">

  		<div class="row">
  			<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
  				<img src="<?php echo $infoSite['logo'];?>" style="max-width: 200px;" />
  				<h1 class="text-center">Đánh giá chất lượng dịch vụ</h1>
  			</div>
        <p><?php echo $mess;?></p>
      
		    
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
          <div class="mb-3">
            <label class="form-label">Tên khách hàng (*)</label>
            <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo (!empty($data->customer->full_name))?$data->customer->full_name:@$_GET['full_name'];?>" />
          </div>

          <div class="mb-3">
            <label class="form-label">Số điện thoại (*)</label>
            <input type="hidden" name="id_customer" id="id_customer" required value="<?php echo @$data->customer->id;?>">
            <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$_GET['phone'];?>" />
          </div>

          <div class="mb-3">
            <label class="form-label">Sản phẩm dịch vụ (*)</label>
            <input type="hidden" name="id_product" id="id_product" required value="<?php echo @$data->product->id;?>">
            <input required type="text" class="form-control phone-mask" name="name_product" id="name_product" value="<?php echo @$data->product->title;?>" />
          </div>

          <div class="mb-3">
            <label class="form-label">Ý kiến khách hàng</label>
            <textarea maxlength="160" rows="5" class="form-control" name="note" id="note"><?php echo @$data->note;?></textarea>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <?php 
          if(!empty($criteria)){
            foreach ($criteria as $key => $value) {
              /*
              echo '<div class="mb-3">
                      <label class="form-label">Số điểm đánh giá cho tiêu chí '.$value.' (*)</label>
                      <input required min="0" max="10" type="number" class="form-control phone-mask" name="point['.$key.']" id="" value="'.@$data->point_detail[$key].'" />
                    </div>';
              */
              $select1= '';
              $select2= '';
              $select3= '';
              $select4= '';
              $select5= '';

              if(!empty($data->point_detail[$key])){
                switch ($data->point_detail[$key]) {
                  case '1':$select1= 'selected';break;
                  case '2':$select2= 'selected';break;
                  case '3':$select3= 'selected';break;
                  case '4':$select4= 'selected';break;
                  case '5':$select5= 'selected';break;
                }
              }

              echo '<div class="mb-3">
                      <label class="form-label">Số điểm đánh giá cho tiêu chí '.$value.' (*)</label>
                      <input required min="0" max="10" type="hidden" class="form-control phone-mask" name="point['.$key.']" id="pointSelect'.$key.'" value="'.@$data->point_detail[$key].'" />
                      <ul class="ratings" id="point'.$key.'">
                        <li class="star '.$select5.'" data-criteria="'.$key.'" data-point="5"></li>
                        <li class="star '.$select4.'" data-criteria="'.$key.'" data-point="4"></li>
                        <li class="star '.$select3.'" data-criteria="'.$key.'" data-point="3"></li>
                        <li class="star '.$select2.'" data-criteria="'.$key.'" data-point="2"></li>
                        <li class="star '.$select1.'" data-criteria="'.$key.'" data-point="1"></li>
                      </ul>
                    </div>';
            }
          }
          ?>  
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
        </div>
      
	    </div>
    <?= $this->Form->end() ?>

    <style type="text/css">
      .ratings {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 100%;
        direction: rtl;
        text-align: left;
      }

      .star {
        position: relative;
        line-height: 40px;
        display: inline-block;
        transition: color 0.2s ease;
        color: #ebebeb;
      }

      .star:before {
        content: '\2605';
        width: 40px;
        height: 40px;
        font-size: 40px;
      }

      .star:hover,
      .star.selected,
      .star:hover ~ .star,
      .star.selected ~ .star{
        transition: color 0.8s ease;
        color: black;
      }
    </style>

    <script type="text/javascript">
      $(function (){
        var star = '.star',
            selected = '.selected';
        var criteria, point;

        $(star).on('click', function(){
          criteria = $(this).data('criteria');
          point = $(this).data('point');

          $('#point'+criteria+' '+selected).each(function(){
            $(this).removeClass('selected');
          });

          $(this).addClass('selected');

          $('#pointSelect'+criteria).val(point);
        });
       
      });
    </script>
</body>
</html>