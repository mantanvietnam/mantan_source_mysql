<?php include(__DIR__.'/../header.php'); ?>

    
<div class="aiva-writecontent container-fluid container-set">
  <div class="row">
    <div class="col-md-4 ">
      <div class="set-height-writecontent">
        <div class="container">                          
          <div class="header-title-flex">
            <div class="icon-title">
              <img src="/plugins/phoenix_ai/view/home/assets/img/96cb94e74cb6a1cf50d8c2aa74763389.svg" alt="">
            </div>
            <div class="name-title-page-writecontent">
              <a href="">Danh sách trợ lý > <span>Trợ lý > </span> <span><a href="" class="name-lili"><?php echo @$bostAi['name']; ?></a></span></a>
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
                            <h3>Lên nội dung cho Tiktok, Youtube</h3>
                            <p>Lên kế hoạch 30 ngày cho kênh Tiktok, TÙY BIẾN LOẠI NỘI DUNG</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form action="" method="post">
                      <div class="title-write">
                        <h3>Loại nội dung bạn muốn làm? (tối đa 3)</h3>
                      </div>
                      <div class="select-gpt-model row">
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Education/Sharing">Giáo dục/Chia sẻ
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Guides">Hướng dẫn
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Product/Service Introductions">Giới thiệu sản phẩm/dịch vụ
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Vlogs">Vlog
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Reviews">Đánh giá
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Talk Shows">Talk Show
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Interviews">Phỏng vấn
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Podcasts">Podcast
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Challenges">Thử thách
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Reactions">Phản ứng
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Comedy">Hài kịch
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Unboxing/Hands-On">Mở hộp/Trên tay
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Related News & Events">Tin tức và Sự kiện liên quan
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Storytelling">Kể chuyện
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Behind the Scenes">Hậu trường
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="Inspirational/Motivation">Truyền cảm hứng/Động lực
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="" id="type[]" value="DIY">DIY
                        </div>
                      </div>
                       <div class="mb-3">
                         <label for="text" class="form-label">Đối tượng khách hàng của bạn, độ tuổi, giới tính, sở thích v.v</label>
                         <textarea type="text" placeholder="VD:8 tuổi,Nam,xem phim..." class="form-control" id="customer_target" name="customer_target" rows="2" cols="30"></textarea>
                       </div>
                     
                        <div>
                          <div class="mb-3">
                            <label for="text" class="form-label">chủ đề hoặc sản phẩm/dịch vụ của bạn</label>
                            <textarea type="text" placeholder="VD: Kem đánh răng" class="form-control" id="topic" name="topic" rows="2" cols="30"></textarea>

                          <input class="form-check-input"  type="hidden" id="conversation_id" value="<?php echo @$data['conversation_id'] ?>">
                        </div>
                      </div>
                      <button type="button" class="button-arcordian" onclick="sendquestion()" id="showAiThinking">Tạo nội dung</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
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
                            <h3>Kế hoạt nội dung Facebook</h3>
                            <!-- <p>BlogPro - lên outline cho Blog dựa vào nội dung</p> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                </h2>
                <div id="collapseTwo1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form action="" method="post">
                      <!-- <div class="title-write">
                        <h3>GPT Model</h3>
                      </div> -->
                     
                      <button type="button" class="button-arcordian" onclick="sendquestionNet('facebook')" id="showAiThinking">Tạo nội dung</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                    <div class="parent-button-div d-flex">
                      <div class="left-content">
                        <p class="number-count">2</p>
                      </div>
                      <div class="right-content-writetitle d-flex">
                        <div class="icon-writecontent">
                          <p class="set-width-imagedocument"><img src="/plugins/phoenix_ai/view/home/assets/img/edit-tools-50x50.png" alt=""></p>
                        </div>
                        <div class="out-like-blogpro">
                          <div class="write-outline">
                            <h3>Kế hoạch nội dung Blog</h3>
                            <!-- <p>BlogPro - lên outline cho Blog dựa vào nội dung</p> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                </h2>
                <div id="collapseTwo2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form action="" method="post">
                      <!-- <div class="title-write">
                        <h3>GPT Model</h3>
                      </div> -->
                     
                      <button type="button" class="button-arcordian" onclick="sendquestionNet('blog')" id="showAiThinking">Tạo nội dung</button>
                    </form>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="col-md-8 ">
      <div id="myElement" style=" display: none; align-items: center;" ><div style="display: flex; flex-direction: column; justify-content: left;"><p class="MuiTypography-root MuiTypography-body1" style="font-size: 14px; color: rgb(80, 210, 62);"><i class='bx bx-check-circle'></i>Cập nhật văn bản thành công</p></div></div>
      <div class="set-height-writecontent">
        <div class="right-form-wirte-content">
          <form action="" method="post">
            <div class="header-form d-flex">
              <div class="title-input-header-left">
                <input type="text" id="title" name="title"  placeholder="Tiêu đề" value="<?php echo @$dataContent->title ?>">
              </div>
              <div class="left-button-title">
                <a type="submit" href="/" class="comback-writecontent">Quay lại</a>
                <button type="button" onclick="saveContentBlog()" class="save-writecontent">Lưu</button>
              </div>
              
            </div>
            <div class="tag-input-header">
              <input type="text" name="" placeholder="tag" id="target" name="target" value="<?php echo @$dataContent->customer_target ?>">
            </div>
            <div class="show-input-editor">
               <?php $result =  nl2br(@$data['result']);
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
                <input class="input-chat-aiva" type="text" name="question" id="question" placeholder="Chat với Aiva">
                <div class="button-chat-with-aiva d-flex justify-content-center align-items-center" >
                  <button onclick="chatquestion()" type="button">Gửi đi</button>
                </div>
              </div>
            
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


showAiThinking.addEventListener('click', () => {
  aiThinking.classList.remove('d-none'); 
  setTimeout(() => {
    aiThinking.classList.add('d-none'); 
  }, 15000); 
});
</script>
<script type="text/javascript">

    function sendquestion(){
        var topic = $('#topic').val();
        var customer_target = $('#customer_target').val();
       
        const checkboxes = document.querySelectorAll('input[id="type[]"]:checked');
    
        // Thu thập các giá trị từ các checkbox đã chọn
        const type = Array.from(checkboxes).map(checkbox => checkbox.value);
        console.log(type);

        $.ajax({
          method: "POST",
          url: "/apis/sendContenttTiktokAPI",
          data: {topic: topic, 
                  type: type, 
                  customer_target: customer_target, 
        }
    }).done(function( msg ) {
          console.log(msg);
            if(msg.code==1){
              document.getElementById("conversation_id").value = msg.data.conversation_id;
              document.getElementById("result").value = msg.data.result.replace(/\n/g, '<br>');
              CKEDITOR.instances['result'].setData(msg.data.result.replace(/\n/g, '<br>'));
            }
        })
      
    }

 
</script>



<script type="text/javascript">

    function sendquestionNet(i){
        var conversation_id = $('#conversation_id').val();
        var result = $('#result').val();
      
        
           console.log(i);
           console.log(result);
      
      if(conversation_id != '' && conversation_id!='0'){
             $.ajax({
          method: "POST",
          url: "/apis/chatConteTiktokAPI",
          data: {question: '',
            conversation_id: conversation_id, 
            type: i, 
          }
        }).done(function( msg ) {
           console.log(msg);
                if(msg.code==1){
                  result += '/\n/g'+msg.data.result;
                  document.getElementById("conversation_id").value = msg.data.conversation_id;
                  document.getElementById("result").value = result.replace(/\n/g, '<br>');
                  CKEDITOR.instances['result'].setData(result.replace(/\n/g, '<br>'));
                }
            })
        }
       

    }

    function chatquestion(){
        var conversation_id = $('#conversation_id').val();
        var result = $('#result').val();
      
        var question = $('#question').val();
      
         document.getElementById("question").value = '';
      if(conversation_id != '' && question!=''){
             $.ajax({
          method: "POST",
          url: "/apis/chatContentVideoAPI",
          data: {question: question,
            conversation_id: conversation_id,
            type: 0,
          }
        }).done(function( msg ) {
                if(msg.code==1){
                  result += '/\n/g'+msg.data.result;
                  document.getElementById("conversation_id").value = msg.data.conversation_id;
                  document.getElementById("result").value = result(/\n/g, '<br>');
                  CKEDITOR.instances['result'].setData(result.replace(/\n/g, '<br>'));
                }
            })
        }
       

    }


     function saveContentBlog(){
        var conversation_id = $('#conversation_id').val();
        var title = $('#title').val();
        var result = $('#result').val();
        var target = $('#target').val();
      
         document.getElementById("question").value = '';
      if(conversation_id != '' && question!=''){
             $.ajax({
          method: "POST",
          url: "/apis/saveConteTiktokAPI",
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