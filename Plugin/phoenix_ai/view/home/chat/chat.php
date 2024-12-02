<?php getheader();?>
 <div class="chat-main container">
                    <div class="chat-header">
                        <p>
                            <img src="./img/robot.svg" alt="">Welcome to <span>Aiva</span></p>
                    </div>
                    <div class="search-box d-flex align-items-center justify-content-center">
                        <input type="text" class="form-control search-input" placeholder="Tìm kiếm trợ lý Aiva">
                        <button class="btn search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="container-fluid mt-3">
                        <div class="d-flex align-items-center gap-3 category-nav">
                            <a href="#" class="category-link">Viết lách</a>
                            <a href="#" class="category-link">Marketing</a>
                            <a href="#" class="category-link">Bán hàng</a>
                            <a href="#" class="category-link">Kinh doanh</a>
                            <a href="#" class="category-link">Phát triển bản thân</a>
                            <a href="#" class="category-link">Tiện ích</a>
                            <a href="#" class="category-link">Học tập</a>
                            <a href="#" class="category-link">HR</a>
                            <a href="#" class="category-link">Giáo dục</a>
                        </div>
                    </div>
                    <!-- Chat Box -->
                    <div class="chat-box">
                        <div class="align-items-center mb-3">
                            <div class="">
                               
                                <?php
                                $conversation_id = '';
                                $i = 0;
                                 if(!empty($data)){

                                        foreach($data as $key => $item){
                                             $i ++;
                                            $conversation_id = $item['conversation_id']; 
                                            echo '<div class="MuiBox-root " id="question'.$i.'">
                                <div class="">
                                    <img alt="avatar" src="/assets/images/6ba464e421af640a904eefa26a0b3524-avatarDefault.png" class="MuiAvatar-img">
                                </div>
                                <div class="">
                                    <div class="">
                                        <p class="MuiTypography-root jss1624 MuiTypography-body1">'.@$item['question'].'.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="MuiBox-root " id="result'.$i.'">
                                <div class="">
                                    <img alt="avatar"  style="width: 50px;" src="/themes/aiva/asset/img/ai1.jpg">
                                </div>
                                <div class="">
                                    <div class="">
                                        <p class="MuiTypography-root jss1624 MuiTypography-body1">'.@$item['result'].'</p>
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
                        <div class="input-group">
                            <input type="text" class="form-control" id="question" name="question" value="" placeholder="Chat với Aiva">
                            <input type="hidden" class="form-control" id="number_people" name="number_people" value="" placeholder="Chat với Aiva">
                            <input type="hidden" class="form-control" id="conversation_id" name="conversation_id" value="<?php echo $conversation_id ?>" placeholder="Chat với Aiva">
                            <label for="file-upload" class="input-group-text file-label">
                                <i class="fa-solid fa-paperclip"></i>
                            </label>
                            <input type="file" id="file-upload" class="d-none">
                            <button class="btn btn-outline-primary" onclick="sendquestion()">
                                Gửi đi
                            </button>
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
        console.log(question);
        console.log(conversation_id);
        console.log(number);
    
         

      $('#listchat div:first').append('\
           <div class="MuiBox-root " id="question'+row+'">\
               <div class="">\
                   <img alt="avatar" src="/assets/images/6ba464e421af640a904eefa26a0b3524-avatarDefault.png" class="MuiAvatar-img">\
                </div>\
               <div class="">\
                   <div class="">\
                       <p class="MuiTypography-root jss1624 MuiTypography-body1">'+question+'.</p>\
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
            // /console.log(id_product);
            // var obj = jQuery.parseJSON(msg);
             console.log(msg);
            if(msg.code==1){
            
                     $('#listchat div:first').append('\
                       <div class="MuiBox-root " id="result'+row+'">\
                           <div class="">\
                               <img alt="avatar" style="width: 50px;" src="/themes/aiva/asset/img/ai1.jpg">\
                            </div>\
                           <div class="">\
                               <div class="">\
                                   <p class="MuiTypography-root jss1624 MuiTypography-body1">'+msg.data.result+'.</p>\
                               </div>\
                           </div>\
                       </div>');
                document.getElementById("conversation_id").value = msg.data.conversation_id;
            }
        })

    }

 
</script>
<?php getFooter();?>

