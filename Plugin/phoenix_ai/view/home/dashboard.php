<?php include(__DIR__.'/header.php'); ?>
          
    <div class="aiva-home container-fluid">
        <div class="home-banner">
            <img src="/plugins/phoenix_ai/view/home/assets/img/bgr-home.jpg" alt="">
            <div class="text-home-banner">
                <p>Hôm nay tôi có thể giúp gì cho bạn ?</p>
                <div class="search-container">
                    <div class="search-wrapper">
                        <form id="searchForm" class="search-form">
                            <div class="input-wrapper">
                                <input type="text" class="search-input" placeholder="Bạn cần phoenix AI hỗ trợ vấn đề gì ?"id="searchInput" onchange="getbos();" >
                                <div class="search-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <!--   <nav class="navbar navbar-expand-lg navbar-light bg-white py-3" style="    margin-top: 15px;    border-radius: 20px;">
            <div class="container-fluid">
                <!- Tab links s->
                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="assistant-tab"  data-bs-toggle="tab" data-bs-target="#assistant" type="button">Trợ lý Phoenix </button>
                    </li>
                </ul>
            </div>
        </nav>
     -->
        <!-- Tab contents -->
        <div class="tab-content" id="myTabContent">
            <!-- Trợ lý Aiva content -->
            <div class="tab-pane fade show active" id="assistant" role="tabpanel">
                <!-- Category navigation -->
              <!--   <div class="container-fluid mt-3">
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
                </div> -->

                <div class="container-fluid mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="heading">Trợ lý Phoenix</h1>
                        <!-- <button class="btn btn-light rounded-pill view-all">Xem tất cả</button> -->
                    </div>
                    <div class="card-ai row justify-content-evenly">
                    <div class="card-ai row " id='bost_ai'>
                        <?php 
                            foreach(listBostAi() as $key => $item){
                                echo ' <div class="col-lg-6 banner-ui">
                                <a class="play" href="/'.$item['url'].'" style="text-decoration:none">
                                <div class="card d-flex" style="max-height:180px">
                                    <div class="info">
                                        <img src="'.$item['avatar'].'" alt="Profile Picture">
                                        <p>'.$item['name'].'</p>
                                        <span>'.$item['boot'].'</span>
                                    </div>
                                    <div class="card-content mx-2">
                                        <h3>'.$item['title'].'</h3>
                                        <p>'.$item['district'].'</p>
                                        <div class="buttons">
                                            <button class="like"><i class="fa-regular fa-thumbs-up"></i>&nbsp;7</button>
                                            <div class="d-flex">
                                                <div><i class="fa-solid fa-play playmasion" style="color: #5242f3;"></i>&nbsp;</div>
                                                <div>&nbsp;Thực hiện</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>';
                    } ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<script type="text/javascript">
    function getbos(){
        var question = $('#searchInput').val();
       /* $.ajax({
              method: "POST",
              url: "/apis/getbosAPI",
              
            }).done(function( msg ) {
                var html = '';
                let item = Object.values(msg).filter(item => item.title.toLowerCase().includes(searchInput));
                for (let i = 0; i < item.length; i++) {
                  html +='<div class="col-lg-6">\
                                <a class="play" href="/'+item[i].url+'" style="text-decoration:none">\
                                <div class="card d-flex">\
                                    <div class="info">\
                                        <img src="'+item[i].avatar+'" alt="Profile Picture">\
                                        <p>'+item[i].name+'</p>\
                                        <span>'+item[i].boot+'</span>\
                                    </div>\
                                    <div class="card-content mx-2">\
                                        <h3>'+item[i].title+'</h3>\
                                        <p>'+item[i].district+'</p>\
                                        <div class="buttons">\
                                            <button class="like"><i class="fa-regular fa-thumbs-up"></i> 7</button>\
                                            <div class="d-flex">\
                                                <div><i class="fa-solid fa-play playmasion" style="color: #5242f3;"></i></div>\
                                                <div>Thực hiện</div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </a>\
                        </div>';
                }
                    
             $('#bost_ai').html(html);
                   
            });*/

         // var question = $('#question').val();
      $.ajax({
          method: "POST",
          url: "/apis/chatAPI",
          data: {question: question,
            number: 0,
            conversation_id: '', 
        }
    })
        .done(function( msg ) {
            location.href = "/chat";
        });
    }

    
</script>
<?php include(__DIR__.'/footer.php'); ?>