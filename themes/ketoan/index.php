<?php 
    getHeader();
    global $settingThemes;

?>

<article>
    <div class="container-fluid">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                    if(!empty($slide_home)){
                        foreach($slide_home as $key => $value){
                            $active ="";
                            if($key = 0){
                                $active = "active";
                            }
                            echo'
                            <div class="carousel-item active">
                                <img src="'.$value->image.'" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block container">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>';
                        }
                    }
                ?>
          
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </div>

    <section id="my-service">
        <div class="container">
            <div class="row">
                <div class="col-11 mg-auto">
                    <div class="title-my-service">
                        <div class="setting-border">
                            <div class="border-bottom"></div>
                        </div>
                        <h3><?php echo @$settingThemes['title_section1'];?></h3>
                        <div class="setting-border">
                            <div class="border-bottom"></div>
                        </div>
                    </div>

                    <div class="intro-my-service">
                        <div class="row">
                            <div class="col-3 backgroud-intro-my-service relative">
                                <div class="setting-icon">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/svg1.svg" alt="">
                                </div>
                                    <div class="text-my-service">
                                        <p class="title-text-my-service "><?php echo $settingThemes['content_title_section1_1'];?></p>
                                        <P class="description-my-service"><?php echo @$settingThemes['content_detail_section1_1'];?></P>
                                    </div>
                            </div>
                            <div class="col-3 backgroud-intro-my-service relative">
                                <div class="text-my-service">
                                    <p class="title-text-my-service"><?php echo @$settingThemes['content_title_section1_2'];?></p>
                                    <P class="description-my-service"><?php echo @$settingThemes['content_detail_section1_2'];?></P>
                                </div>
                                <div class="setting-icon">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/svg1.svg" alt="">
                                </div>
                            </div>
                            <div class="col-3 backgroud-intro-my-service relative">
                                <div class="setting-icon">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/svg1.svg" alt="">
                                </div>
                                    <div class="text-my-service">
                                        <p class="title-text-my-service"><?php echo @$settingThemes['content_title_section1_3'];?></p>
                                        <P class="description-my-service"><?php echo @$settingThemes['content_detail_section1_3'];?></P>
                                    </div>
                            </div>
                            <div class="col-3 backgroud-intro-my-service relative">
                                <div class="setting-icon">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/svg1.svg" alt="">
                                </div>
                                    <div class="text-my-service">
                                        <p class="title-text-my-service"><?php echo @$settingThemes['content_title_section1_4'];?></p>
                                        <P class="description-my-service"><?php echo @$settingThemes['content_detail_section1_4'];?></P>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="why-my-service">
        <div class="container">
                <div class="row">
                    <div class="col-11 mg-auto">
                        <div class="title-my-service">
                            <div class="setting-border">
                                <div class="border-bottom"></div>
                            </div>
                            <h3><?php echo @$settingThemes['title_section2'];?></h3>
                            <div class="setting-border">
                                <div class="border-bottom"></div>
                            </div>
                        </div>

                        <div class="icon-why-my-service text-center">
                            <div class="row justify-center">
                                <div class="col-3 text-center">
                                    <div class="img-why-my">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="91.88px"
                                        height="94.98px" viewBox="0 0 91.88 94.98" style="enable-background:new 0 0 91.88 94.98;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#00C0EB;}
                                    </style>
                                    <defs>
                                    </defs>
                                    <path class="st0" d="M60.71,21.67c-8.11,0-14.65,6.54-14.65,14.65c0,8.11,6.54,14.65,14.65,14.65c8.11,0,14.65-6.54,14.65-14.65
                                        C75.37,28.22,68.82,21.67,60.71,21.67 M60.71,48.2c-6.57,0-11.87-5.3-11.87-11.87c0-6.57,5.3-11.87,11.87-11.87
                                        c6.57,0,11.87,5.3,11.87,11.87C72.58,42.9,67.29,48.2,60.71,48.2"/>
                                    <path class="st0" d="M90.22,57.8l-2.89-2.89c-0.54-0.54-1.42-0.54-1.97,0c-0.54,0.54-0.54,1.42,0,1.97l2.89,2.89
                                        c1.13,1.13,1.13,2.97,0,4.1c-1.13,1.13-2.96,1.13-4.1,0c-2.42-2.42-9.03-9.03-11.2-11.2c1.54-1.16,2.93-2.54,4.1-4.09l3.72,3.72
                                        c0.54,0.54,1.42,0.54,1.97,0c0.54-0.54,0.54-1.42,0-1.97l-4.14-4.14c1.65-2.98,2.53-6.35,2.53-9.85c0-4.12-1.21-8.05-3.47-11.39
                                        V12.5c0-2.4-1.96-4.36-4.36-4.36h-3.51V4.36c0-2.4-1.96-4.36-4.36-4.36H26.66c-0.77,0-1.39,0.62-1.39,1.39
                                        c0,0.77,0.62,1.39,1.39,1.39h38.78c0.87,0,1.58,0.71,1.58,1.58v3.78H12.23c-2.4,0-4.36,1.96-4.36,4.36v71.55H4.36
                                        c-0.87,0-1.58-0.71-1.58-1.58V4.36c0-0.87,0.71-1.58,1.58-1.58h15.8c0.77,0,1.39-0.62,1.39-1.39c0-0.77-0.62-1.39-1.39-1.39H4.36
                                        C1.96,0,0,1.96,0,4.36v78.12c0,2.4,1.96,4.36,4.36,4.36h3.51v3.78c0,2.4,1.96,4.36,4.36,4.36H73.3c2.4,0,4.36-1.96,4.36-4.36V61.31
                                        l4.52,4.52c2.22,2.22,5.81,2.22,8.03,0C92.44,63.61,92.44,60.02,90.22,57.8 M48.86,49.39c-3.79-3.45-5.78-8.2-5.78-13.06
                                        c0-9.75,7.88-17.63,17.62-17.63c9.74,0,17.63,7.87,17.63,17.63C78.35,51.38,60.25,59.74,48.86,49.39 M74.88,90.62
                                        c0,0.87-0.71,1.58-1.58,1.58H12.23c-0.87,0-1.58-0.71-1.58-1.58v-5.18V12.5c0-0.87,0.71-1.58,1.58-1.58H68.4h4.91
                                        c0.87,0,1.58,0.71,1.58,1.58v9.12c-3.73-3.6-8.72-5.72-14.17-5.72c-17.62,0-26.98,21-15.16,34.09c3.31,3.66,7.9,6.08,12.96,6.62
                                        c4,0.43,8.27-0.33,12.05-2.41l4.32,4.32V90.62z"/>
                                    <path class="st0" d="M17.67,22.34H34.9c0.77,0,1.39-0.62,1.39-1.39c0-0.77-0.62-1.39-1.39-1.39H17.67c-0.77,0-1.39,0.62-1.39,1.39
                                        C16.28,21.71,16.91,22.34,17.67,22.34"/>
                                    <path class="st0" d="M17.67,30.22H34.9c0.77,0,1.39-0.62,1.39-1.39c0-0.77-0.62-1.39-1.39-1.39H17.67c-0.77,0-1.39,0.62-1.39,1.39
                                        C16.28,29.6,16.91,30.22,17.67,30.22"/>
                                    <path class="st0" d="M17.67,38.11H34.9c0.77,0,1.39-0.62,1.39-1.39c0-0.77-0.62-1.39-1.39-1.39H17.67c-0.77,0-1.39,0.62-1.39,1.39
                                        C16.28,37.49,16.91,38.11,17.67,38.11"/>
                                    <path class="st0" d="M17.67,46.52H34.9c0.77,0,1.39-0.62,1.39-1.39c0-0.77-0.62-1.39-1.39-1.39H17.67c-0.77,0-1.39,0.62-1.39,1.39
                                        C16.28,45.9,16.91,46.52,17.67,46.52"/>
                                    <path class="st0" d="M59.29,85.47H44.62l-1.67-3.78c3.17-2.91,5.16-7.08,5.16-11.71c0-2.25-0.47-4.39-1.32-6.34h13.41
                                        c0.77,0,1.39-0.62,1.39-1.39c0-0.77-0.62-1.39-1.39-1.39H45.22c-2.88-4.1-7.64-6.79-13.03-6.79c-8.77,0-15.91,7.14-15.91,15.91
                                        c0,8.77,7.14,15.91,15.91,15.91c3.12,0,6.02-0.9,8.48-2.46l1.77,4c0.22,0.5,0.72,0.83,1.27,0.83h15.58c0.77,0,1.39-0.62,1.39-1.39
                                        C60.68,86.09,60.06,85.47,59.29,85.47 M30.8,69.98v13.05c-6.59-0.7-11.73-6.28-11.73-13.05c0-7.24,5.89-13.13,13.13-13.13
                                        c3.7,0,7.04,1.54,9.43,4.01h-2.17c-0.77,0-1.39,0.62-1.39,1.39c0,0.77,0.62,1.39,1.39,1.39h4.23c0.83,1.5,1.38,3.17,1.56,4.94H32.19
                                        C31.42,68.58,30.8,69.21,30.8,69.98 M33.58,83.03V71.37h11.66c-0.31,2.93-1.59,5.57-3.51,7.6l-1.02-2.3
                                        c-0.31-0.7-1.13-1.02-1.84-0.71c-0.7,0.31-1.02,1.13-0.71,1.84l1.35,3.05C37.8,82.03,35.77,82.8,33.58,83.03"/>
                                    <path class="st0" d="M69.06,68.58h-8.88c-0.77,0-1.39,0.62-1.39,1.39c0,0.77,0.62,1.39,1.39,1.39h8.88c0.77,0,1.39-0.62,1.39-1.39
                                        C70.45,69.21,69.83,68.58,69.06,68.58"/>
                                    <path class="st0" d="M69.06,75.42h-8.88c-0.77,0-1.39,0.62-1.39,1.39c0,0.77,0.62,1.39,1.39,1.39h8.88c0.77,0,1.39-0.62,1.39-1.39
                                        C70.45,76.04,69.83,75.42,69.06,75.42"/>
                                    <path class="st0" d="M65.52,30.98l-7.66,7.38l-1.67-3.37c-0.34-0.69-1.17-0.97-1.86-0.63c-0.69,0.34-0.97,1.18-0.63,1.86l2.51,5.07
                                        c0.42,0.84,1.53,1.04,2.21,0.39l9.03-8.69c0.55-0.53,0.57-1.41,0.04-1.97C66.95,30.46,66.07,30.45,65.52,30.98"/>
                                    </svg>
                                    
                                            
                                            
                                    </div>
                                    <p class="title-why-my font-san-bold"><?php echo @$settingThemes['content_title_section2_1'];?></p> 
                                    <p class="description-why-my"><?php echo @$settingThemes['content_detail_section2_1'];?></p>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="img-why-my">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            width="100.12px" height="109.3px" viewBox="0 0 100.12 109.3" style="enable-background:new 0 0 100.12 109.3;"
                                            xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#00C0EB;}
                                        </style>
                                        <defs>
                                        </defs>
                                        <g>
                                            <path class="st0" d="M2.15,69.78c1.19,0,2.15-0.97,2.15-2.16s-0.96-2.15-2.15-2.15C0.96,65.47,0,66.43,0,67.62v0.01
                                                C0,68.82,0.96,69.78,2.15,69.78z"/>
                                            <path class="st0" d="M96.8,75.36l-12.36-6.67V46.13c0-4.23-3-7.68-6.68-7.68H75.8v-4.86c0-8.94-3.5-17.37-9.86-23.73
                                                C59.58,3.5,51.15,0,42.22,0C33.28,0,24.86,3.5,18.5,9.87c-6.36,6.36-9.86,14.79-9.86,23.73v4.86H6.68C3,38.45,0,41.9,0,46.13v11.9
                                                c0,1.19,0.96,2.15,2.15,2.15s2.15-0.96,2.15-2.15v-11.9c0-1.8,1.11-3.38,2.38-3.38h71.08c1.27,0,2.38,1.58,2.38,3.38v22.55
                                                l-12.38,6.68c-2.03,1.1-3.28,1.93-3.3,5.13c-0.04,5.06,1.4,10.48,4.17,15.65c0.18,0.33,0.35,0.65,0.53,0.97H6.68
                                                c-1.27,0-2.38-1.58-2.38-3.38V77.2c0-1.19-0.96-2.15-2.15-2.15C0.96,75.05,0,76.02,0,77.2v16.53c0,4.23,3,7.68,6.68,7.68h65.29
                                                c2.22,2.95,4.69,5.25,7.37,6.85c1.16,0.69,2.05,1.04,2.95,1.04c0.9,0,1.79-0.35,2.95-1.04c4.12-2.47,7.72-6.54,10.71-12.12
                                                c2.78-5.17,4.22-10.59,4.17-15.65C100.09,77.29,98.84,76.46,96.8,75.36z M61.26,38.45H23.18v-4.86c0-10.51,8.54-19.05,19.04-19.05
                                                c10.5,0,19.05,8.55,19.05,19.05V38.45z M71.5,38.45h-5.94v-4.86c0-6.21-2.44-12.06-6.86-16.49c-4.43-4.43-10.28-6.86-16.48-6.86
                                                c-6.2,0-12.05,2.44-16.48,6.87c-4.42,4.43-6.86,10.28-6.86,16.49v4.86h-5.94v-4.86c0-16.15,13.13-29.29,29.28-29.29
                                                c16.15,0,29.28,13.14,29.28,29.29V38.45z M92.16,94.11c-2.58,4.81-5.73,8.43-9.13,10.46c-0.41,0.25-0.63,0.36-0.74,0.4
                                                c-0.11-0.05-0.33-0.15-0.74-0.4h0c-2.42-1.45-4.66-3.63-6.69-6.5c-0.01-0.02-0.02-0.03-0.04-0.05c-0.84-1.19-1.64-2.49-2.4-3.91
                                                c-2.44-4.54-3.7-9.24-3.66-13.58c0-0.48,0.04-0.71,0.06-0.81c0.17-0.13,0.6-0.36,0.99-0.57l12.49-6.74l12.42,6.7l0.06,0.03
                                                c0.39,0.21,0.82,0.44,1,0.57c0.02,0.1,0.05,0.33,0.06,0.81C95.86,84.88,94.59,89.57,92.16,94.11z"/>
                                            <path class="st0" d="M47.44,61.28h19.04c1.19,0,2.15-0.96,2.15-2.15c0-1.19-0.96-2.15-2.15-2.15H47.44c-1.19,0-2.15,0.96-2.15,2.15
                                                C45.29,60.32,46.25,61.28,47.44,61.28z"/>
                                            <path class="st0" d="M47.44,72.81h13.14c1.19,0,2.15-0.96,2.15-2.15s-0.96-2.15-2.15-2.15H47.44c-1.19,0-2.15,0.96-2.15,2.15
                                                S46.25,72.81,47.44,72.81z"/>
                                            <path class="st0" d="M11.29,83.8c0,3.03,2.46,5.49,5.49,5.49h20.38c3.03,0,5.49-2.46,5.49-5.49c0-3.99-1.77-7.99-4.84-10.97
                                                c-1.17-1.13-2.48-2.08-3.87-2.81c2.44-2.01,4-5.06,4-8.46c0-6.05-4.92-10.97-10.97-10.97c-6.04,0-10.96,4.92-10.96,10.97
                                                c0,3.4,1.56,6.45,3.99,8.46c-1.39,0.73-2.7,1.68-3.87,2.81C13.05,75.81,11.29,79.81,11.29,83.8z M26.97,54.88
                                                c3.68,0,6.67,2.99,6.67,6.67c0,3.68-2.99,6.67-6.67,6.67c-3.67,0-6.66-2.99-6.66-6.67C20.31,57.87,23.29,54.88,26.97,54.88z
                                                M26.97,72.52c5.85,0,11.38,5.48,11.38,11.28c0,0.64-0.55,1.19-1.19,1.19H16.78c-0.64,0-1.19-0.55-1.19-1.19
                                                C15.59,78,21.12,72.52,26.97,72.52z"/>
                                            <path class="st0" d="M86.93,83.15l-6.14,6.3l-2.13-2c-0.87-0.81-2.23-0.77-3.04,0.1c-0.81,0.87-0.77,2.23,0.1,3.04l3.67,3.44
                                                c0.41,0.39,0.94,0.58,1.47,0.58c0.56,0,1.12-0.22,1.54-0.65l7.61-7.81c0.83-0.85,0.81-2.21-0.04-3.04
                                                C89.12,82.28,87.76,82.3,86.93,83.15z"/>
                                        </g>
                                        </svg>

                                            
                                            
                                    </div>
                                    <p class="title-why-my font-san-bold"><?php echo @$settingThemes['content_title_section2_2'];?></p> 
                                    <p class="description-why-my"><?php echo @$settingThemes['content_detail_section2_2'];?></p>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="img-why-my">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="83.2px"
                                            height="81.3px" viewBox="0 0 83.2 81.3" style="enable-background:new 0 0 83.2 81.3;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#00C0EB;}
                                        </style>
                                        <defs>
                                        </defs>
                                        <path class="st0" d="M50.39,73.66c13.88,0,25.17-11.29,25.17-25.17c0-13.88-11.29-25.17-25.17-25.17
                                            c-13.88,0-25.17,11.29-25.17,25.17C25.22,62.37,36.51,73.66,50.39,73.66 M50.39,27.38c11.66,0,21.11,9.45,21.11,21.11
                                            S62.05,69.6,50.39,69.6c-11.66,0-21.11-9.45-21.11-21.11C29.3,36.84,38.74,27.39,50.39,27.38"/>
                                        <path class="st0" d="M58.99,16.83v-5.29c3.13-0.81,5.01-4.01,4.2-7.15C62.52,1.8,60.19,0,57.52,0H43.27c-3.24,0-5.86,2.62-5.86,5.86
                                            c0,2.67,1.8,5,4.39,5.67v5.27c-3.92,1.06-7.61,2.85-10.87,5.27H15.44c-1.12,0-2.03,0.91-2.03,2.03c0,1.12,0.91,2.03,2.03,2.03h15.6
                                            c0.07,0,0.14,0,0.22-0.01c0.56,0.09,1.12-0.05,1.57-0.4c5.02-3.9,11.21-6.01,17.57-5.99c15.85,0,28.75,12.9,28.75,28.75
                                            c0,15.85-12.9,28.75-28.75,28.75c-12.49,0.01-23.55-8.06-27.38-19.95c-0.29-0.9-1.16-1.48-2.1-1.4c-0.06,0-0.11-0.01-0.17-0.01
                                            h-9.69c-1.12,0-2.03,0.91-2.03,2.03c0,1.12,0.91,2.03,2.03,2.03h8.59c4.78,12.85,17.05,21.37,30.76,21.36
                                            c18.09,0,32.81-14.72,32.81-32.81C83.2,33.37,72.92,20.61,58.99,16.83 M43.27,4.06h14.25c0.99-0.01,1.81,0.79,1.82,1.78
                                            c0.01,0.99-0.79,1.81-1.78,1.82c-0.01,0-0.02,0-0.03,0H43.27c-0.99-0.01-1.79-0.82-1.78-1.82C41.49,4.86,42.29,4.07,43.27,4.06
                                            M45.86,15.99v-4.01h9.07V16c-1.5-0.21-3.02-0.31-4.54-0.32C48.87,15.68,47.36,15.78,45.86,15.99L45.86,15.99z"/>
                                        <path class="st0" d="M17.68,45.95c-0.09,1.12,0.75,2.1,1.87,2.18c0.05,0,0.1,0.01,0.16,0.01c1.06,0,1.94-0.82,2.02-1.88
                                            c0.38-4.97,2.05-9.75,4.85-13.87c0.63-0.93,0.39-2.19-0.54-2.82c-0.46-0.32-1.04-0.43-1.59-0.3H2.03C0.91,29.27,0,30.18,0,31.3
                                            c0,1.12,0.91,2.03,2.03,2.03H21.3c-0.74,1.41-1.37,2.87-1.89,4.38H4.88c-1.12,0-2.03,0.91-2.03,2.03c0,1.12,0.91,2.03,2.03,2.03
                                            h13.4C17.99,43.15,17.79,44.54,17.68,45.95"/>
                                        <path class="st0" d="M50.39,36.5c1.12,0,2.03-0.91,2.03-2.03v-2.91c0-1.12-0.91-2.03-2.03-2.03c-1.12,0-2.03,0.91-2.03,2.03v2.91
                                            C48.36,35.59,49.27,36.5,50.39,36.5"/>
                                        <path class="st0" d="M50.39,67.44c1.12,0,2.03-0.91,2.03-2.03v-2.91c0-1.12-0.91-2.03-2.03-2.03c-1.12,0-2.03,0.91-2.03,2.03v2.91
                                            C48.36,66.53,49.27,67.44,50.39,67.44"/>
                                        <path class="st0" d="M64.41,50.52h2.9c1.12,0,2.03-0.91,2.03-2.03c0-1.12-0.91-2.03-2.03-2.03h-2.9c-1.12,0-2.03,0.91-2.03,2.03
                                            C62.38,49.61,63.29,50.52,64.41,50.52"/>
                                        <path class="st0" d="M33.47,50.52h2.9c1.12,0,2.03-0.91,2.03-2.03c0-1.12-0.91-2.03-2.03-2.03h-2.9c-1.12,0-2.03,0.91-2.03,2.03
                                            C31.44,49.61,32.35,50.52,33.47,50.52"/>
                                        <path class="st0" d="M48.37,48.63c0,0.03,0,0.06,0.01,0.09c0,0.03,0.01,0.07,0.02,0.1c0.01,0.03,0.01,0.07,0.02,0.1
                                            c0.01,0.03,0.02,0.06,0.02,0.09c0.01,0.03,0.02,0.07,0.03,0.1c0.01,0.03,0.02,0.06,0.03,0.09c0.01,0.03,0.02,0.06,0.04,0.09
                                            c0.01,0.03,0.03,0.06,0.04,0.09c0.02,0.03,0.03,0.06,0.04,0.08c0.02,0.03,0.04,0.06,0.05,0.09c0.02,0.03,0.03,0.05,0.05,0.08
                                            c0.02,0.03,0.04,0.05,0.06,0.08c0.02,0.03,0.04,0.05,0.06,0.08c0.02,0.03,0.04,0.05,0.06,0.07c0.03,0.03,0.05,0.05,0.08,0.08
                                            c0.01,0.01,0.01,0.01,0.02,0.02l8.45,7.96c0.82,0.77,2.1,0.73,2.87-0.09c0.77-0.82,0.73-2.1-0.09-2.87l-7.81-7.36v-6.57
                                            c0-1.12-0.91-2.03-2.03-2.03c-1.12,0-2.03,0.91-2.03,2.03v7.45c0,0.01,0,0.02,0,0.03C48.36,48.56,48.36,48.59,48.37,48.63"/>
                                        </svg>

                                            
                                    </div>
                                    <p class="title-why-my font-san-bold"><?php echo @$settingThemes['content_title_section2_3'];?></p> 
                                    <p class="description-why-my"><?php echo @$settingThemes['content_detail_section2_3'];?></p>
                                </div>
                            </div>
                            <button class="button-why-my    "><a class="font-san-bold" href="">Nhận tư vấn miễn phí <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                                </span></a></button>

                        </div>


                    </div>
                </div>
        </div>
    </section>

    <section id="banner-dang-ki">
        <div class="container">
            <div class="row justify-center">
                <div class="col-11">
                    <div class="row">
                        <div class="col-7 text-center">
                            <h5 class="title-banner-dang-ki font-san-bold">Đăng ký nhận bản tin khuyến mãi của chúng tôi</h5>
                            <p class="dcreption-banner-dang-ki">Đăng kí ngay để nhận bản tin khuyến mãi của chúng tôi sớm nhất và nhanh nhất</p>
                        </div>
                        <div class="col-5 ds-flex align-center">
                            <form class="ds-flex align-center gap-30">
                                <div class="mb-3">
                                    <input class="border-radius-30 pd-8-16" type="email" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ Email *" aria-describedby="emailHelp" >
                                </div>
                                <button type="submit" class="btn btn-primary border-radius-30 pd-8-16 btn-dang-ki">Đăng kí ngay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="main-body-text">
        <div class="container">
            <div class="row">
                <div class="col-9 tab-intro-left">
                    <?php 
                        if(!empty($category_post)){
                            foreach($category_post as $key => $value){
                                echo '
                                <div class="mg-24">
                                    <div class="title-main-home">
                                        <h3 class="text-uppcase text-title-main-home">'.$value->name.'</h3>
                                        <div class="border-title-main-home"></div>
                                    </div>
                                    <div id="tax-accounting">
                                        <div class="row">';
                                        if(!empty($news_home)){
                                            foreach($news_home as $keyNewsHome => $valueNewsHome){
                                                foreach ($valueNewsHome as $keyNews => $valueNews){
                                                    if($valueNews->idCategory == $value->id){
                                                        if($keyNews == 0){
                                                            echo'    
                                                            <div class="col-6">
                                                                <a href="'.$valueNews->slug.'.html" class="link-news">
                                                                    <img src="'.$valueNews->image.'" alt="">
                                                                    <div class="author">
                                                                        <span>Đăng bởi:</span>
                                                                        <span class="name-author">'.$valueNews->author.'</span>
                                                                    </div>
                                                                    <p class="title-news">'.$valueNews->title.'</p>
                                                                    <p class="description-news">'.$valueNews->description.'</p>
                                                                    <p class="btn-news">Chi tiết <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                                    </svg>
                                                                    </span></p>
                                                                </a>
                                                            </div>
                                                            '; 
                                                        }
                                                        else{ 
                                                            echo'
                                                            <div class="col-6">
                                                                <div class="list-news-small">
                                                                    <div class="intro-news-small">
                                                                        <a href="'.$valueNews->slug.'.html" class="link-news">
                                                                            <img src="'.$valueNews->image.'" alt="">
                                                                            <div class="info-news-small">
                                                                                <div class="author">
                                                                                    <span>Đăng bởi:</span>
                                                                                    <span class="name-author">'.$valueNews->author.'</span>
                                                                                </div>
                                                                                <p class="title-news ellipsis block-ellipsis-title-news">'.$valueNews->title.'</p>
                                                                                <p class="description-news ellipsis block-ellipsis">'.$valueNews->description.'</p>
                                                                                <p class="btn-news">Chi tiết <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                                                </svg>
                                                                                </span></p>
                                                                            </div>
                                                                        </a>                                     
                                                                    </div>
                                                                </div>
                                                            </div>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        echo'
                                        </div>
                                    </div>
                                </div>
                                ';
     
                            }
                        }
                    ?>
                    
                </div>
                <?php getSidebar();?>
            
            </div>

        </div>
    </section>
</article>
<?php getFooter();?>
