<?php getHeader();?>

    <main>
        <section id="product" class="">
            <div class="banner-product max-h-70vh max-h-80vh maxheight-480 overflow-hiden">
                <img src="http://bobdecor.com.vn/upload/admin/files/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                <div class="absolute bottom-0 w-100 linear-background--banner" >
                    <div class="container">
                        <div class="title-banner-product">
                            <h1>Sản phẩm</h1>
                        </div>                    
                    </div>
                </div>

            </div>

        </section>

        <section class="duong-dan-product mg-top-24">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-gray-400 list-duong-dan">
                      <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
                      <li class="breadcrumb-item active font-semibold" aria-current="page">Sản phẩm</li>
                    </ol>
                  </nav>
            </div>
        </section>

        <section class="mg-top-40 intro-product">
            <div class="container">
                <div class="setting-product">
                    <div class="col-span-3 product-select-laptop">
                        <div class="nav-list-product">
                            <div class="title-nav-list">Danh mục</div>

                            <?php 
                                global $modelCategories;

                                $conditions = array('type' => 'category_product');
                                $listDataCategory = $modelCategories->find()->where($conditions)->all()->toList();

                                if(!empty($listDataCategory)){
                                    echo '  <div class="accordion" id="nav-list">
                                                <div class="accordion-item">
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">';
                                                            foreach ($listDataCategory as $key => $value) {
                                                                echo '  <div class="list-nav-product setting-list-nav">
                                                                            <a href="/category/'.$value->slug.'.html">'.$value->name.'</a>
                                                                        </div>';
                                                            }
                                    echo                '</div>
                                                    </div>
                                                </div>
                                            </div>';
                                    
                                }
                            ?>
                            
                          
                        </div>


                    </div>

                    <div class="col-span-9 list-product-all mb-5">
                        <div class="list-san-pham">
                            <?php 
                                if(!empty($list_product)){
                                    foreach($list_product as $product){
                                        $link = '/product/'.$product->slug.'.html';
                                        echo '
                                        <div class="group-product">
                                            <div class="img-product relative">
                                                <img src="'.$product->image.'" alt="">
                                                <div class="opacity-0 group-hover-opacity-50 bg-gray-800 duration-500 absolute h-full w-full top-0"></div>
                                                <div class="click-product absolute group-hover-opacity-100 opacity-0 duration-500 w-100 h-100 top-0 setting-click ">
                                                    <a href="'.$link.'" class="duration-500 w-full text-white border border-white setting-button-click button-click-hover hover-border-gray-800 hover-text-gray-800 hover-bg-white">Xem chi tiết</a>
                                                    
                                                    <a onclick="addProductToCart('.$product->id.')" href="javascript:void(0);"  class="duration-500 w-full text-black setting-button-click border-black bg-white hover-border-white hover-text-white hover-bg-black">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                            <div class="content-product">
                                                <p>'.$product->code.'</p>
                                                <h5>'.$product->title.'</h5>
                                            </div>
                                        </div>';
                                    }
                                }
                            ?>
                      

                        </div>

                        <nav aria-label="Page navigation example" class="mg-top-64"> 
                            <ul class="pagination justify-center gap-10">
                                <?php
                                if($totalPage>0){
                                    if ($page > 5) {
                                        $startPage = $page - 5;
                                    } else {
                                        $startPage = 1;
                                    }

                                    if ($totalPage > $page + 5) {
                                        $endPage = $page + 5;
                                    } else {
                                        $endPage = $totalPage;
                                    }
                                    
                                    echo '<li class="page-item first">
                                            <a class="page-link" href="'.$urlPage.'1"
                                                ><i class="fa-solid fa-chevron-left"></i></a>
                                            </li>';
                                    
                                    for ($i = $startPage; $i <= $endPage; $i++) {
                                        $active= ($page==$i)?'active':'';

                                        echo '<li class="page-item '.$active.'">
                                                <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                                </li>';
                                    }

                                    echo '<li class="page-item last">
                                            <a class="page-link" href="'.$urlPage.$totalPage.'"
                                                ><i class="fa-solid fa-chevron-right"></i></a>
                                            </li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>  
                </div>
            </div>

        </section>
    </main>

<?php getFooter();?>