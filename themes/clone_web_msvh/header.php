<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php 
        mantan_header();
        global $settingThemes;
     
    ?>
    <title>Document</title>

</head>
<body>
   
    <header>
        <section class="section-header-page">
            <div class="container">
                <div class="row justify-content-beetween">
                    <div class="header-title col-lg-6 col-md-6 col-12 d-flex ">
                        <h2 class="buy-title"><a href=""><?php echo @$settingThemes['leftheader1']; ?> <span style="text-decoration-line: line-through;"><?php echo @$settingThemes['leftheader2']; ?></span></a></h2>
                        <h2 class="free-title"><a href=""><?php echo @$settingThemes['leftheader3']; ?></a></h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 d-flex time-down-and-resgister">
                       <div class="clock-container">
                        <div id="clockdiv">
                                <div>
                                    <span class="hours" data-unit="hours" data-initial-value="<?php echo @$settingThemes['hour']; ?>">00</span>
                                    <div class="smalltext">Hours</div>
                                </div>
                                <div>
                                    <span class="minutes" data-unit="minutes" data-initial-value="<?php echo @$settingThemes['minutes']; ?>">00</span>
                                    <div class="smalltext">Minutes</div>
                                </div>
                                <div>
                                    <span class="seconds" data-unit="seconds" data-initial-value="<?php echo @$settingThemes['seconds']; ?>">00</span>
                                    <div class="smalltext">Seconds</div>
                                </div>
                            </div>
                       </div>
                        <!-- <div class="d-flex time-down">
                            <p class="time-down-detail" data-unit="hours" data-initial-value="<?php echo @$settingThemes['hour']; ?>">00</p>
                            <p class="time-down-detail" data-unit="minutes" data-initial-value="<?php echo @$settingThemes['minutes']; ?>">00</p>
                            <p class="time-down-detail" data-unit="seconds" data-initial-value="<?php echo @$settingThemes['seconds']; ?>">00</p>
                        </div> -->
                        <div class="button-register">
                             <a href=""><p><?php echo @$settingThemes['button1']; ?></p></a>   
                        </div>
                    </div>
                 
                </div>
            </div>
        </section>
    </header>