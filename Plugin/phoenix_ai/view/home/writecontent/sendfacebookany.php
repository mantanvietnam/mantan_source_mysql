<?php include(__DIR__.'/../header.php'); ?>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
<div class="aiva-writecontent container-fluid container-set">
<div id="myElement" style=" display: none; align-items: center;" ><div style="display: flex; flex-direction: column; justify-content: left;"><p class="MuiTypography-root MuiTypography-body1" style="font-size: 14px; color: rgb(80, 210, 62);"><i class='bx bx-check-circle'></i>Cập nhật văn bản thành công</p></div></div>

  <div class="row">
    <div class="col-md-4 ">
      <div class="set-height-writecontent">
        <div class="container">                          
          <div class="header-title-flex">
            <div class="icon-title">
              <img src="/plugins/phoenix_ai/view/home/assets/img/96cb94e74cb6a1cf50d8c2aa74763389.svg" alt="">
            </div>
            <div class="name-title-page-writecontent">
              <a href="/dashboard">Danh sách trợ lý > <span>Trợ lý > </span> <span><a href="" class="name-lili"><?php echo @$bostAi['name']; ?></a></span></a>
            </div>
          </div>
          <div class="div-detail-title d-flex">
            <div class="icon-left-title">
              <svg xmlns="http://www.w3.org/2000/svg" width="33" height="21" viewBox="0 0 33 21" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M32.071 0.325489C32.4105 0.325081 32.7202 0.516734 32.8746 0.818595C33.0284 1.12152 32.9994 1.4836 32.7997 1.75924L19.5645 19.9489C19.4073 20.1639 19.1612 20.3 18.894 20.3178C18.7271 20.3283 18.5626 20.2925 18.4176 20.2168C18.3302 20.1711 18.2506 20.1105 18.1819 20.0393L9.00245 10.3812L26.9078 2.88354L6.36366 7.60618L0.886527 1.84327C0.63887 1.58225 0.569315 1.19852 0.711884 0.865902C0.854962 0.534911 1.1805 0.319605 1.54148 0.31958L32.071 0.325489ZM4.63878 16.0709L7.22195 11.1267L10.7833 14.8737L5.83487 17.2983C5.5722 17.4271 5.27002 17.4185 5.02057 17.2881C4.93742 17.2447 4.85989 17.1879 4.79173 17.1184C4.52021 16.8381 4.45832 16.4163 4.63878 16.0709Z" fill="#5242F3"/>
              </svg>
            </div>
            <div class="content-right-name">
              <p><?php echo @$bostAi['title']; ?></p>
            </div>
          </div>
          <div class="scroll-container">
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="parent-button-div d-flex">
                      <div class="left-content">
                        <p class="number-count">0</p>
                      </div>
                      <div class="right-content-writetitle d-flex">
                        <div class="icon-writecontent">
                          <p class="set-width-imagedocument"><img src="<?php echo @$bostAi['avatar']; ?>" alt=""></p>
                        </div>
                        <div class="out-like-blogpro">
                          <div class="write-outline">
                            <h3><?php echo @$bostAi['title']; ?></h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form action="" method="post">
                      <!-- <div class="title-write">
                        <h3>GPT Model</h3>
                      </div>
                      <div class="select-gpt-model">
                        <select class="form-select" aria-label="Default select example">
                          <option value="">GPT-4o-Mini</option>
                          <option value="">GPT-4o</option>
                          <option value="">Aiva image</option>
                          <option value="">Gemini</option>
                        </select>
                      </div> -->
                      <!-- <div class="form-check form-switch mt-2 mb-2">
                        <input class="form-check-input" type="checkbox" id="toggleSwitch">
                        <label class="form-check-label" for="toggleSwitch">Giọng điệu thương hiệu</label>
                      </div> -->
                     
                      <div>
                        <div class="mb-3">
                          <label for="text" class="form-label">Nhập nội dung tạo bài viết facebook của bạn</label>
                          <textarea type="text" placeholder="VD:người vô gia cư..." class="form-control" id="topic" name="topic" rows="2" cols="30"></textarea>

                        <input class="form-check-input"  type="hidden" id="conversation_id" value="<?php echo @$data['conversation_id'] ?>">
                        </div>
                      </div>
                      <button type="button" class="button-arcordian" onclick="sendquestion()" id="showAiThinking">Tạo nội dung</button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                    <div class="parent-button-div d-flex">
                      <div class="left-content">
                        <p class="number-count">1</p>
                      </div>
                      <div class="right-content-writetitle d-flex">
                        <div class="icon-writecontent">
                          <p class="set-width-imagedocument"><img src="/plugins/phoenix_ai/view/home/assets/img/edit-tools-50x50.png" alt=""></p>
                        </div>
                        <div class="out-like-blogpro">
                          <div class="write-outline">
                            <h3>Nội dung tiếp theo</h3>
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                </h2>
                <div id="collapseTwo1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form action="" method="post">
                  
                     
                      <button type="button" class="button-arcordian" onclick="sendquestionNet(1)" id="showAiThinking">Tạo nội dung</button>
                    </form>
                  </div>
                </div>
              </div> -->


             
             

              
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="col-md-8 ">
      <div class="set-height-writecontent">
        <div class="right-form-wirte-content">
          <form action="" method="post">
            <div class="header-form d-flex">
              <div class="title-input-header-left">
                <input type="text" id="title" name="title"  placeholder="Tiêu đề" value="<?php echo @$dataContent->title ?>">
              </div>
              <div class="left-button-title">s
                <button type="button" onclick="saveContentimageBlog()" class="save-writecontent">Lưu</button>
              </div>
              
            </div>
            <div class="tag-input-header">
              <input type="text" name="" placeholder="tag" id="target" name="target" value="<?php echo @$dataContent->customer_target ?>">
            </div>
            <div class="show-input-editor">
                <?php $result =  htmlspecialchars(nl2br(@$data['result']));
               showEditorInput('result', 'result', @$result);?>
            </div>
            <div class="ai-thinking d-none" id="aiThinking">
              <div class="content-thinking" style=" display: flex;align-items: center;position: absolute;right: 27%;transform: translate(-50%, -50%); border-radius: 10px; background-color: #ffffff; ">
                  <div style="width: 50px; height:50px;">      
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                      <g>
                          <circle cx="60" cy="50" r="4" fill="#e15b64">
                              <animate attributeName="cx" repeatCount="indefinite" dur="1s" values="95;35" keyTimes="0;1" begin="-0.67s"/>
                              <animate attributeName="fill-opacity" repeatCount="indefinite" dur="1s" values="0;1;1" keyTimes="0;0.2;1" begin="-0.67s"/>
                          </circle>
                          <circle cx="60" cy="50" r="4" fill="#e15b64">
                              <animate attributeName="cx" repeatCount="indefinite" dur="1s" values="95;35" keyTimes="0;1" begin="-0.33s"/>
                              <animate attributeName="fill-opacity" repeatCount="indefinite" dur="1s" values="0;1;1" keyTimes="0;0.2;1" begin="-0.33s"/>
                          </circle>
                          <circle cx="60" cy="50" r="4" fill="#e15b64">
                              <animate attributeName="cx" repeatCount="indefinite" dur="1s" values="95;35" keyTimes="0;1" begin="0s"/>
                              <animate attributeName="fill-opacity" repeatCount="indefinite" dur="1s" values="0;1;1" keyTimes="0;0.2;1" begin="0s"/>
                          </circle>
                      </g><g transform="translate(-15 0)">
                      <path d="M50 50L20 50A30 30 0 0 0 80 50Z" fill="#f8b26a" transform="rotate(90 50 50)"/>
                      <path d="M50 50L20 50A30 30 0 0 0 80 50Z" fill="#f8b26a">
                          <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;45 50 50;0 50 50" keyTimes="0;0.5;1"/>
                      </path>
                      <path d="M50 50L20 50A30 30 0 0 1 80 50Z" fill="#f8b26a">
                          <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;-45 50 50;0 50 50" keyTimes="0;0.5;1"/>
                      </path>
                    </g>
                  </svg>
                  </div>
                  <div style="font-size: 13px;font-weight: 600;">PHOENIX AI đang suy nghĩ ...</div>
              </div>
            </div>
            <div class="last-inputcontent">
              <div class="d-flex justify-content-between">
                <input class="input-chat-aiva" type="text" name="question" id="question" placeholder="Chat với Phoenix">
                <div class="button-chat-with-aiva d-flex justify-content-center align-items-center" >
                  <button onclick="chatquestion()" type="button">Gửi đi</button>
                </div>
              </div>
              <!-- <div class="container row">
                <div class="form-check form-switch mt-2 mb-2 col-md-3 bottom-setting-one">
                  <label class="form-check-label" for="toggleSwitch"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                    <path d="M8.81327 0.31958C8.64277 0.31958 8.47926 0.387309 8.3587 0.507869C8.23814 0.628428 8.17041 0.791941 8.17041 0.962437V17.6767C8.17041 17.8472 8.23814 18.0107 8.3587 18.1313C8.47926 18.2519 8.64277 18.3196 8.81327 18.3196C8.98376 18.3196 9.14728 18.2519 9.26784 18.1313C9.3884 18.0107 9.45612 17.8472 9.45612 17.6767V0.962437C9.45612 0.791941 9.3884 0.628428 9.26784 0.507869C9.14728 0.387309 8.98376 0.31958 8.81327 0.31958Z" fill="#5242F3"/>
                    <path d="M11.3841 4.81958C11.2136 4.81958 11.0501 4.88731 10.9295 5.00787C10.8089 5.12843 10.7412 5.29194 10.7412 5.46244V13.8196C10.7412 13.9901 10.8089 14.1536 10.9295 14.2741C11.0501 14.3947 11.2136 14.4624 11.3841 14.4624C11.5546 14.4624 11.7181 14.3947 11.8386 14.2741C11.9592 14.1536 12.0269 13.9901 12.0269 13.8196V5.46244C12.0269 5.29194 11.9592 5.12843 11.8386 5.00787C11.7181 4.88731 11.5546 4.81958 11.3841 4.81958Z" fill="#5242F3"/>
                    <path d="M13.9558 2.89105C13.7853 2.89105 13.6218 2.95878 13.5013 3.07934C13.3807 3.1999 13.313 3.36341 13.313 3.53391V15.7482C13.313 15.9187 13.3807 16.0822 13.5013 16.2028C13.6218 16.3233 13.7853 16.3911 13.9558 16.3911C14.1263 16.3911 14.2899 16.3233 14.4104 16.2028C14.531 16.0822 14.5987 15.9187 14.5987 15.7482V3.53391C14.5987 3.36341 14.531 3.1999 14.4104 3.07934C14.2899 2.95878 14.1263 2.89105 13.9558 2.89105Z" fill="#5242F3"/>
                    <path d="M16.5271 6.74811C16.3566 6.74811 16.1931 6.81584 16.0726 6.9364C15.952 7.05696 15.8843 7.22047 15.8843 7.39096V11.891C15.8843 12.0615 15.952 12.225 16.0726 12.3455C16.1931 12.4661 16.3566 12.5338 16.5271 12.5338C16.6976 12.5338 16.8611 12.4661 16.9817 12.3455C17.1023 12.225 17.17 12.0615 17.17 11.891V7.39096C17.17 7.22047 17.1023 7.05696 16.9817 6.9364C16.8611 6.81584 16.6976 6.74811 16.5271 6.74811Z" fill="#5242F3"/>
                    <path d="M6.24198 4.81958C6.07148 4.81958 5.90797 4.88731 5.78741 5.00787C5.66685 5.12843 5.59912 5.29194 5.59912 5.46244V13.8196C5.59912 13.9901 5.66685 14.1536 5.78741 14.2741C5.90797 14.3947 6.07148 14.4624 6.24198 14.4624C6.41247 14.4624 6.57599 14.3947 6.69655 14.2741C6.81711 14.1536 6.88484 13.9901 6.88484 13.8196V5.46244C6.88484 5.29194 6.81711 5.12843 6.69655 5.00787C6.57599 4.88731 6.41247 4.81958 6.24198 4.81958Z" fill="#5242F3"/>
                    <path d="M3.6702 2.89105C3.4997 2.89105 3.33619 2.95878 3.21563 3.07934C3.09507 3.1999 3.02734 3.36341 3.02734 3.53391V15.7482C3.02734 15.9187 3.09507 16.0822 3.21563 16.2028C3.33619 16.3233 3.4997 16.3911 3.6702 16.3911C3.8407 16.3911 4.00421 16.3233 4.12477 16.2028C4.24533 16.0822 4.31306 15.9187 4.31306 15.7482V3.53391C4.31306 3.36341 4.24533 3.1999 4.12477 3.07934C4.00421 2.95878 3.8407 2.89105 3.6702 2.89105Z" fill="#5242F3"/>
                    <path d="M1.09891 6.74811C0.928416 6.74811 0.764902 6.81584 0.644343 6.9364C0.523784 7.05696 0.456055 7.22047 0.456055 7.39096V11.891C0.456055 12.0615 0.523784 12.225 0.644343 12.3455C0.764902 12.4661 0.928416 12.5338 1.09891 12.5338C1.26941 12.5338 1.43292 12.4661 1.55348 12.3455C1.67404 12.225 1.74177 12.0615 1.74177 11.891V7.39096C1.74177 7.22047 1.67404 7.05696 1.55348 6.9364C1.43292 6.81584 1.26941 6.74811 1.09891 6.74811Z" fill="#5242F3"/>
                  </svg><span style="margin-left: 5px;">Giọng điệu thương hiệu</span></label>
                  <input class="form-check-input" type="checkbox" id="toggleSwitch">
                </div>
                <div class="col-md-3 mt-2 mb-3">
                  <div class="select-gpt-model">
                    <select class="form-select" aria-label="Default select example" style="width: 90% !important;">
                      <option value="">GPT-4o-Mini</option>
                      <option value="">GPT-4o</option>
                      <option value="">Aiva image</option>
                      <option value="">Gemini</option>
                    </select>
                  </div>
                </div>
              </div> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
const aiThinking = document.getElementById('aiThinking');
const showAiThinking = document.getElementById('showAiThinking');


/*showAiThinking.addEventListener('click', () => {
  aiThinking.classList.remove('d-none'); 
  setTimeout(() => {
    aiThinking.classList.add('d-none'); 
  }, 15000); 
});*/
</script>
<script type="text/javascript">

    function sendquestion(){
      aiThinking.classList.remove('d-none');
        var topic = $('#topic').val();
        console.log(topic);
        $.ajax({
          method: "POST",
          url: "/apis/createcontentfacebookanyAPI",
          data: {topic: topic, 
        }
    }).done(function( msg ) {
      aiThinking.classList.add('d-none'); 
           console.log(msg);
            if(msg.code==1){

                document.getElementById("conversation_id").value = msg.data.conversation_id;
                document.getElementById("result").value = msg.data.result;
                CKEDITOR.instances['result'].setData(msg.data.result.replace(/\n/g, '<br>'));
                saveContentimageBlog();
            }
        })

    }

 
</script>


<script type="text/javascript">

    function sendquestionNet(i){
        var conversation_id = $('#conversation_id').val();
        var result = $('#result').val();
      
        
      
      if(conversation_id != '' && conversation_id!='0'){
        aiThinking.classList.remove('d-none');
             $.ajax({
          method: "POST",
          url: "/apis/chatcontentfacebookanyAPI",
          data: {question: '',
            conversation_id: conversation_id, 
            number_question: i, 
          }
        }).done(function( msg ) {
          aiThinking.classList.add('d-none'); 
                if(msg.code==1){
                  result += msg.data.result
                    document.getElementById("conversation_id").value = msg.data.conversation_id;
                    document.getElementById("result").value = result;
                    CKEDITOR.instances['result'].setData(result.replace(/\n/g, '<br>')); 
                }
            })
        }
       

    }

    function chatquestion(){
       var question = $('#question').val();
      $.ajax({
          method: "POST",
          url: "/apis/chatAPI",
          data: {question: question,
            number: 0,
            conversation_id: '', 
        }
    }).done(function( msg ) {
            location.href = "/chat";
        });
    }


     function saveContentimageBlog(){
        var conversation_id = $('#conversation_id').val();
        var title = $('#title').val();
        var result = $('#result').val();
        var target = $('#target').val();
      
         document.getElementById("question").value = '';
      if(conversation_id != '' && question!=''){
             $.ajax({
          method: "POST",
          url: "/apis/savecontentfacebookanyAPI",
          data: { conversation_id :conversation_id,
            title :title,
            result :result,
            target :target,
          }
        }).done(function( msg ) {
                console.log(msg);
                if(msg.code==1){
                    document.getElementById("conversation_id").value = msg.data.conversation_id;
                    document.getElementById("result").value =  msg.data.content_ai;
                    document.getElementById("title").value =  msg.data.title;
                    document.getElementById("target").value =  msg.data.customer_target;

                    document.getElementById("myElement").style.display = 'block';

                var myElement = document.getElementById('myElement');

                // Hàm thay đổi CSS
                function changeCSS() {
                    myElement.style.display = 'none';
                }

                // Đặt hẹn giờ để id="showAiThinking" Tạo nội dung thay đổi sau 10 giây
                setTimeout(changeCSS, 10000);
                }
            })
        }
       

    }
 
</script>

<?php include(__DIR__.'/../footer.php'); ?>