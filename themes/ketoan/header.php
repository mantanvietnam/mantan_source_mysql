<?php global $settingThemes;?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $urlThemeActive;?>/asset/css/style.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/font/SanFranciscoDisplay-Regular.otf">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
</head>
<body>
    <header id="nav-bar-logo">
        <div class="container">
            <div class="row">
                <div class="col-3 logo-header">
                    <a href="">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/logo.png">
                    </a>
                </div>
                <div class="col-9 nav-logo-header">
                    <nav class="nav-header">
                        <ul class="list-header">
                            <li class="nav-header-item">
                                <a href="" class="icon-text-nav-logo">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                                            <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                                          </svg>
                                          
                                    </span>
                                    <p>Trang chủ</p>
                                </a>
                            </li>
                            <li class="nav-header-item">
                                <a href="">
                                    <p>Tin tức</p>
                                </a>
                            </li>
                            <li class="nav-header-item">
                                <a href="">
                                    <p>Dịch vụ</p>
                                </a>
                            </li>
                            <li class="nav-header-item">
                                <a href="">
                                    <p>Về chúng tôi</p>
                                </a>
                            </li>
                            <li class="nav-header-item">
                                <a href="">
                                    <p>Liên hệ</p>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="nav-header-mobile">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                              </svg>
                              
                          </button>
                          
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <!-- <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> -->
                                <div class="modal-body">
                                    <ul class="list-header">
                                        <li class="nav-header-item">
                                            <a href="" class="icon-text-nav-logo">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                                                        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                                                      </svg>
                                                      
                                                </span>
                                                <p>Trang chủ</p>
                                            </a>
                                        </li>
                                        <li class="nav-header-item">
                                            <a href="">
                                                <p>Tin tức</p>
                                            </a>
                                        </li>
                                        <li class="nav-header-item">
                                            <a href="">
                                                <p>Dịch vụ</p>
                                            </a>
                                        </li>
                                        <li class="nav-header-item">
                                            <a href="">
                                                <p>Về chúng tôi</p>
                                            </a>
                                        </li>
                                        <li class="nav-header-item">
                                            <a href="">
                                                <p>Liên hệ</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
