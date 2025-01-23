<?php include(__DIR__.'/../header.php'); ?>
<?php 
global $session;
$info = $session->read('infoUser');
?>
                <div class="chat-main container">
                    <div class="chat-header">
                        <p><img src="plugins/phoenix_ai/view/home/assets/img/96cb94e74cb6a1cf50d8c2aa74763389.svg" alt="">Welcome to <span>Phoenix</span></p>
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
                                        <div class=" left-quetion mt-3 mb-3">
                                            
                                            <div class=" d-flex css-resultitem">
                                                <img alt="avatar"  style="width: 50px; height:50px" src="plugins/phoenix_ai/view/home/assets/img/96cb94e74cb6a1cf50d8c2aa74763389.svg">
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
                            
                            <button 
                                class="btn btn-primary" 
                                style="padding: 12px 16px; background-color: #f2f1ff; color: #000; border: none; transition: color 0.3s ease;" 
                                onmouseover="this.style.color='#714ef3';" 
                                onmouseout="this.style.color='#000';" 
                                onclick="sendquestion()">
                                Gửi đi
                            </button>
                            <!-- <label for="file-upload" style="cursor: pointer;">
                                <i class="fa-solid fa-paperclip"></i>
                            </label> -->
                            
                            <button class="btn btn-primary" style="padding: 12px 16px;background-color: #f2f1ff;" onclick="sendquestion()">Gửi đi</button>
                        </div>
                    </div>
                </div>
<script src="path/to/local/jquery.min.js"></script>                

<script type="text/javascript">

    document.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        sendquestion();
    }
});
    var row=<?php echo @$i; ?>;
    function sendquestion(){
        var question = $('#question').val();
        if(question != ''){      
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
                                   <div class="mt-3 mb-3 left-quetion">\
                                       <div class="d-flex css-resultitem">\
                                           <img alt="avatar" style="width: 50px; height:50px" src="plugins/phoenix_ai/view/home/assets/img/96cb94e74cb6a1cf50d8c2aa74763389.svg">\
                                           <p class="result-answer MuiTypography-root jss1624 MuiTypography-body1">'+msg.data.result+'</p>\
                                       </div>\
                                   </div>\
                               </div>');
                        document.getElementById("conversation_id").value = msg.data.conversation_id;
                    }
                })
            }
    }

 
</script>
<?php include(__DIR__.'/../footer.php'); ?>
