<?php include(__DIR__.'/../header.php'); ?>
<?php 
global $session;
$info = $session->read('infoUser');
?>
                <div class="chat-main container">
                    <div class="chat-header">
                        <p><img src="/plugins/phoenix_ai/view/home/assets/img/aiphoenix.png" alt="">Welcome to <span>Phoenix</span></p>
                    </div>
                    <div class="search-box d-flex align-items-center justify-content-center">
                        <input type="text" class="form-control search-input search-chat" placeholder="Tìm kiếm trợ lý Phoenix">
                        <button class="btn search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="container-fluid mt-3 ml-5"style=" margin-left: 45px;" >
                        <div class="d-flex align-items-center gap-3 category-nav">
                            <a href="#" class="category-link category-text">Viết lách</a>
                            <a href="#" class="category-link category-text">Marketing</a>
                            <a href="#" class="category-link category-text">Bán hàng</a>
                            <a href="#" class="category-link category-text">Kinh doanh</a>
                            <a href="#" class="category-link category-text">Phát triển bản thân</a>
                            <a href="#" class="category-link category-text">Tiện ích</a>
                            <a href="#" class="category-link category-text">Học tập</a>
                            <a href="#" class="category-link category-text">HR</a>
                            <a href="#" class="category-link category-text">Giáo dục</a>
                        </div>
                    </div>
                    <!-- Chat Box -->
                     <div class="container-fluid content-chat-with-phoenix mt-3">
                        <div class="main-chat-phoenix mb-3">
                            <div class="">
                               
                               <?php
                               $conversation_id = '';
                               $i = 0;
                                if(!empty($data)){

                                    foreach($data as $key => $item){
                                            $i ++;
                                           $conversation_id = $item['conversation_id']; 
                                           echo '
                                    <div class="MuiBox-root " id="question'.$i.'">
                                        <div class="d-flex right-question">
                                            <div>
                                                <p class="question-answer MuiTypography-root jss1624 MuiTypography-body1">'.@$item['question'].'.</p>
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <div class="MuiBox-root " id="result'.$i.'">
                                        <div class="d-flex left-quetion">
                                            <img alt="avatar"  style="width: 50px;" src="/plugins/phoenix_ai/view/home/assets/img/robot.svg">
                                            <div>
                                                <p class="result-answer MuiTypography-root jss1624 MuiTypography-body1">'.@$item['result'].'</p>
                                                
                                            </div>
                                        </div>
                                    </div>';
                                       }
                               }else{
                               echo  '<div id="trFirst"></div>';
                               } 
                                ?>

                           </div>
                           
                        <div class="" id="listchat"><div id="trFirst"></div></div>
                          <!--   <div class="custom-toggle me-2">Giọng điệu thương hiệu</div>
                            <select class="form-select form-select-sm w-auto me-2">
                                <option>Giọng điệu</option>
                            </select>
                            <select class="form-select form-select-sm w-auto me-2">
                                <option>GPT-4</option>
                            </select>
                            <select class="form-select form-select-sm w-auto">
                                <option>Tiếng Việt</option>
                            </select> -->
                        </div>
                     </div>
                    <div class="chat-box container-fluid">
                        <div class="input-group chat-search-input">
                            <input type="text" class="set-border-input form-control" id="question" name="question" value="" placeholder="Chat với Phoenix" style="padding: 12px 16px; background-color: #f2f1ff;">
                            <input type="hidden" class="form-control" id="number_people" name="number_people" value="" placeholder="Chat với Phoenix">
                            <input type="hidden" class="form-control" id="conversation_id" name="conversation_id" value="<?php echo $conversation_id ?>" placeholder="Chat với Aiva">
                            <!-- <label for="file-upload" style="cursor: pointer;">
                                <i class="fa-solid fa-paperclip"></i>
                            </label> -->
                            <input type="file" id="file-upload" class="d-none">
                            <div class="input-group-text" style="padding: 20px 16px;background-color: #f2f1ff;">
                              <i class="fa-solid fa-microphone"></i>
                            </div>
                            <button class="btn btn-primary" style="padding: 12px 16px;background-color: #f2f1ff;" onclick="sendquestion()">Gửi đi</button>
                        </div>
                    </div>
                </div>
<script src="path/to/local/jquery.min.js"></script>                

<script type="text/javascript">
    var row=<?php echo @$i; ?>;
    function sendquestion(){
        var question = $('#question').val();
      
        var conversation_id = $('#conversation_id').val();
        row++;
         var number = row;
        
    
         

      $('#listchat div:first').append('<div class="MuiBox-root " id="question'+row+'">\
                <div class="d-flex right-question">\
                   <div class="">\
                       <p class="question-answer MuiTypography-root jss1624 MuiTypography-body1">'+question+'.</p>\
                   </div>\
               </div>\
           </div>');
       document.getElementById("question").value ='';
         $.ajax({
          method: "POST",
          url: "/apis/chatAPI",
          data: {question: question,
            number: number,
            conversation_id: conversation_id, 
        }
    })
        .done(function( msg ) {
            if(msg.code==1){
                     $('#listchat div:first').append('<div class="MuiBox-root " id="result'+row+'">\
                           <div class="d-flex left-quetion">\
                           <img alt="avatar" style="width: 50px;" src="/plugins/phoenix_ai/view/home/assets/img/robot.svg">\
                               <div class="">\
                                   <p class="result-answer MuiTypography-root jss1624 MuiTypography-body1">'+msg.data.result+'.</p>\
                               </div>\
                           </div>\
                       </div>');
                document.getElementById("conversation_id").value = msg.data.conversation_id;
            }
        })
    }

 
</script>
<?php include(__DIR__.'/../footer.php'); ?>
