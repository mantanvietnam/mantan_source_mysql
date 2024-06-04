<?php include(__DIR__.'/../header.php'); ?>

<style type="text/css">
  #clock_countdown{
    color: red;
    font-weight: bold;
    font-size: 20px;
  }
  img{
    max-width: 100%;
    height: auto !important;
  }
  .question{
    align-items: self-start;
      line-height: 1;
  }
  .number_question{
    min-width: 100px;
    float: left;
  }
  input[type="radio"] {
    height:15px !important; 
    width:15px !important;
  }
</style>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/courses">Khóa học</a> /</span>
    Bài thi / <?php echo @$data->title;?>
  </h4>
  <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
              <div class="card-body">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                  <!--
                  <img src="<?php //echo $setting_value['logo'];?>" style="max-width: 200px;" />
                  -->
                  <h1 class="text-center"><?php echo $data->title;?></h1>
                  <p class="text-center">
                    Thời gian thi: 
                    <span id="clock_countdown">
                      <?php 
                        $minute = $data->time_test%60;
                              $hour = ($data->time_test - $minute)/60;

                              $time_test = '';
                              if($hour>0){
                                $time_test .= $hour.':';
                              }

                              if($minute>0){
                                $time_test .= $minute.':';
                              }

                              $time_test .= '00';

                        echo $time_test;
                      ?>  
                    </span>
                  </p>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <form id='form_answer' method="post" action="" >
                  <input type="hidden" name="time_start" value="<?php echo time();?>" />
                  <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                  <?php 
                    if($data->status == 'active' && $data->time_start<=time() && $data->time_end>=time()){
                      echo '<div class="row mb-3">
                          <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">'.$data->description.'</div>
                        </div>';

                      if(!empty($questions)){
                        if(!$submit){
                          $number = 0;
                          foreach ($questions as $key => $item) {
                            $number++;
                            if($number<10){
                              $numberShow = '00'.$number;
                            }elseif($number<100){
                              $numberShow = '0'.$number;
                            }else{
                              $numberShow = $number;
                            }

                            echo '  <div class="row mb-3">
                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <b class="number_question">Câu hỏi '.$numberShow.':</b> '.$item->question.'
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question">
                                    <input type="radio" name="answer['.$item->id.']" id="answer-a-'.$item->id.'" value="a" style="margin-right: 5px;"> A.
                                          <label for="answer-a-'.$item->id.'">'.$item->option_a.'</label>
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question">
                                    <input type="radio" name="answer['.$item->id.']" id="answer-b-'.$item->id.'" value="b" style="margin-right: 5px;"> B.
                                          <label for="answer-b-'.$item->id.'">'.$item->option_b.'</label>
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question">
                                    <input type="radio" name="answer['.$item->id.']" id="answer-c-'.$item->id.'" value="c" style="margin-right: 5px;"> C.
                                          <label for="answer-c-'.$item->id.'">'.$item->option_c.'</label>
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question">
                                    <input type="radio" name="answer['.$item->id.']" id="answer-d-'.$item->id.'" value="d" style="margin-right: 5px;"> D.
                                          <label for="answer-d-'.$item->id.'">'.$item->option_d.'</label>
                                  </div>
                                </div>';
                          }

                          echo '<p><button id="buttonSend" onclick="process_exam();" type="button" class="btn btn-primary"><i class="fa-regular fa-paper-plane"></i> NỘP BÀI</button></p>';
                        }else{
                          echo '<p class="text-center">Bạn đã trả lời đúng <b>'.$total_true.'</b> trên tổng số <b>'.$number_question.'</b> câu hỏi. Đạt <b class="text-danger">'.$point.'</b> điểm</p>';

                          echo '<p class="text-center mb-5"><button onclick="$(\'#return_test\').show();" type="button" class="btn btn-primary"><i class="fa-regular fa-eye"></i> XEM KẾT QUẢ</button> <a class="btn btn-danger" href="/courses"><i class="fa-solid fa-right-from-bracket"></i> QUAY LẠI</a></p>';

                          echo '<div id="return_test" style="display: none;">';
                          $number = 0;
                          foreach ($questions as $key => $item) {
                            $number++;
                            if($number<10){
                              $numberShow = '00'.$number;
                            }elseif($number<100){
                              $numberShow = '0'.$number;
                            }else{
                              $numberShow = $number;
                            }

                            $tick_a = '<input type="radio" name="answer['.$item->id.']" value="" style="margin-right: 5px;">';
                            $tick_b = '<input type="radio" name="answer['.$item->id.']" value="" style="margin-right: 5px;">';
                            $tick_c = '<input type="radio" name="answer['.$item->id.']" value="" style="margin-right: 5px;">';
                            $tick_d = '<input type="radio" name="answer['.$item->id.']" value="" style="margin-right: 5px;">';

                            $color_a = '';
                            $color_b = '';
                            $color_c = '';
                            $color_d = '';
                            
                            if(!empty($answer[$item->id])){
                              if($answer[$item->id]=='a'){
                                if($answer_true[$item->id]=='a'){
                                  $tick_a = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_a = 'text-success';
                                }else{
                                  $tick_a = '<i class="fa-solid fa-xmark" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_a = 'text-danger';
                                }
                              }elseif($answer[$item->id]=='b'){
                                if($answer_true[$item->id]=='b'){
                                  $tick_b = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_b = 'text-success';
                                }else{
                                  $tick_b = '<i class="fa-solid fa-xmark" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_b = 'text-danger';
                                }
                              }elseif($answer[$item->id]=='c'){
                                if($answer_true[$item->id]=='c'){
                                  $tick_c = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_c = 'text-success';
                                }else{
                                  $tick_c = '<i class="fa-solid fa-xmark" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_c = 'text-danger';
                                }
                              }elseif($answer[$item->id]=='d'){
                                if($answer_true[$item->id]=='d'){
                                  $tick_d = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_d = 'text-success';
                                }else{
                                  $tick_d = '<i class="fa-solid fa-xmark" style="margin-right: 5px;margin-top: 5px;"></i>';
                                  $color_d = 'text-danger';
                                }
                              }

                              switch ($answer_true[$item->id]) {
                                case 'a': $tick_a = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                      $color_a = 'text-success';
                                      break;
                                case 'b': $tick_b = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                      $color_b = 'text-success';
                                      break;
                                case 'c': $tick_c = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                      $color_c = 'text-success';
                                      break;
                                case 'd': $tick_d = '<i class="fa-regular fa-circle-check" style="margin-right: 5px;margin-top: 5px;"></i>';
                                      $color_d = 'text-success';
                                      break;
                              }
                            }


                            echo '  <div class="row mb-3">
                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <b class="number_question">Câu hỏi '.$numberShow.':</b> '.$item->question.'
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question '.$color_a.'">
                                    '.$tick_a.' A.<label for="answer-a-'.$item->id.'">'.$item->option_a.'</label>
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question '.$color_b.'">
                                    '.$tick_b.' B.<label for="answer-b-'.$item->id.'">'.$item->option_b.'</label>
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question '.$color_c.'">
                                    '.$tick_c.' C.<label for="answer-c-'.$item->id.'">'.$item->option_c.'</label>
                                  </div>

                                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 d-inline-flex question '.$color_d.'">
                                    '.$tick_d.' D.<label for="answer-d-'.$item->id.'">'.$item->option_d.'</label>
                                  </div>
                                </div>';
                          }
                          echo '</div>';
                        }
                      }
                    }else{
                      echo '<p class="text-center">Bài thi chưa bắt đầu hoặc đã kết thúc</p>';
                    }
                  ?>
                      </form>
                </div>
                
              </div>
            </div>
        </div>


    </div>
</div>

<script type="text/javascript">
  var time_start = <?php echo $data->time_start;?>;
  var time_end = <?php echo $data->time_end;?>;
  var time_now = <?php echo time();?>;

  var second_total = <?php echo $data->time_test*60;?>;
  var status_test = '<?php echo $data->status;?>';
  var submit = <?php echo (int) $submit;?>;

  if((time_end-time_now)<second_total){
    second_total = time_end-time_now;
  }

  function countdown()
  {
    second_total--;
    if(second_total>=0){
      second = second_total%60;
      hour = (second_total-second)/60;
      text_time = hour+":"+second;
      $('#clock_countdown').html(text_time);
    }else{
      process_exam();
    }
  }

  function process_exam()
  {
    clearInterval(refreshIntervalId);
    $('#buttonSend').html('ĐANG NỘP BÀI ...');
    $('#buttonSend').prop('disabled', true);
    $( "#form_answer" ).submit();
  }

  // đếm ngược thời gian làm bài thi
  if(status_test=='active' && submit==0 && time_now>=time_start && time_now<=time_end){
    var refreshIntervalId = setInterval(countdown, 1000);
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>