<?php getHeader();?>

    <main>
        <section id="product" class="">
            <div class="banner-product max-h-70vh max-h-80vh maxheight-480 overflow-hiden">
                <img src="<?php echo $category->image ?>" alt="">
                <div class="absolute bottom-0 w-100 linear-background--banner" >
                    <div class="container">
                        <div class="title-banner-product">
                            <h1><?php echo $category->name ?></h1>
                            <!-- <p><?php echo $category->description ?></p> -->
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
                      <li class="breadcrumb-item active font-semibold" aria-current="page"><?php echo $category->name ?></li>
                    </ol>
                  </nav>
            </div>
        </section>

        <?php debug($category);?>

        <section class="mg-top-40 intro-product">
            <div class="container">
                <div class="setting-product">
                    <div class="col-span-3 product-select-laptop">
                        <div class="nav-list-product">
                            <div class="title-nav-list">Danh mục</div>
                            <div class="accordion" id="nav-list">
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Yen Lam Melamine
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    <div class="list-nav-product setting-list-nav">
                                        <a href="#">Tabu Vaneer</a>
                                    </div>
                                    <div class="list-nav-product setting-list-nav">
                                        <a href="#">Tabu Vaneer</a>
                                    </div>
                                    <div class="list-nav-product setting-list-nav">
                                        <a href="#">Tabu Vaneer</a>
                                    </div>
                                    <div class="list-nav-product setting-list-nav">
                                        <a href="#">Tabu Vaneer</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Wood Vaneer
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                                </div>
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        High Pressure Laminate (HPL)
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Sản phẩm hỗ trợ
                                    </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>

                        <div class="nav-list-product-two">
                            <div class="accordion" id="nav-list">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-phanloai">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsephanloai" aria-expanded="true" aria-controls="collapsephanloai">
                                        Phân loại
                                        </button>
                                    </h2>
                                    <div id="collapsephanloai" class="accordion-collapse collapse" aria-labelledby="collapsephanloai" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pd-16 ds-flex">
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Phân loại
                                                    </label>
                                                </div>
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Chưa hoàn thiện
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingfive">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                                        Loại gỗ
                                        </button>
                                    </h2>
                                    <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pd-16 ds-flex">
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Chưa hoàn thiện
                                                    </label>
                                                </div>
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Chưa hoàn thiện
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingsix">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                                        Bề mặt
                                        </button>
                                    </h2>
                                    <div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="collapsesix" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pd-16 ds-flex">
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Chưa hoàn thiện
                                                    </label>
                                                </div>
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Chưa hoàn thiện
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingseven">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="true" aria-controls="collapseseven">
                                        Loại vân
                                        </button>
                                    </h2>
                                    <div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="collapseseven" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pd-16 ds-flex">
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Chưa hoàn thiện
                                                    </label>
                                                </div>
                                                <div class="form-check-fillter">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Chưa hoàn thiện
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingage">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseage" aria-expanded="true" aria-controls="collapseage">
                                        Màu sắc
                                        </button>
                                    </h2>
                                    <div id="collapseage" class="accordion-collapse collapse" aria-labelledby="collapseage" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="grid grid-coloum-3 gap-16 pd-right-20">
                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Beige">
                                                        <div class="relative">
                                                            <div class="v-poppy">
                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/beige.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Black">
                                                        <div class="relative">
                                                            <div class="v-poppy">
                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/Black.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Brown">
                                                        <div class="relative">
                                                            <div class="v-poppy">
                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/Dark_Brown.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Grey">
                                                        <div class="relative">
                                                            <div class="v-poppy">
                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/dark_grey.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Light">
                                                        <div class="relative">
                                                            <div class="v-poppy">
                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/drak_light.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Light Green">
                                                        <div class="relative">
                                                            <div class="v-poppy">
                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/light_green.jpg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>   
                        </div>


                    </div>
                    <div class="hidden product-select-mobile">
                        <button type="button" class="btn btn-primary bg-button-select" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            LỌC SẢN PHẨM
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">lọc sản phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="nav-list-product">
                                            <div class="title-nav-list">Danh mục</div>
                                            <div class="accordion" id="nav-list">
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Yen Lam Melamine
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                    <div class="list-nav-product setting-list-nav">
                                                        <a href="#">Tabu Vaneer</a>
                                                    </div>
                                                    <div class="list-nav-product setting-list-nav">
                                                        <a href="#">Tabu Vaneer</a>
                                                    </div>
                                                    <div class="list-nav-product setting-list-nav">
                                                        <a href="#">Tabu Vaneer</a>
                                                    </div>
                                                    <div class="list-nav-product setting-list-nav">
                                                        <a href="#">Tabu Vaneer</a>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Wood Vaneer
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        High Pressure Laminate (HPL)
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingfor">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefor" aria-expanded="false" aria-controls="collapsefor">
                                                        Sản phẩm hỗ trợ
                                                    </button>
                                                    </h2>
                                                    <div id="collapsefor" class="accordion-collapse collapse" aria-labelledby="collapsefor" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="nav-list-product-two">
                                            <div class="accordion" id="nav-list">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading-phanloai">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsephanloai" aria-expanded="true" aria-controls="collapsephanloai">
                                                        Phân loại
                                                        </button>
                                                    </h2>
                                                    <div id="collapsephanloai" class="accordion-collapse collapse" aria-labelledby="collapsephanloai" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body pd-16 ds-flex">
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Phân loại
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Chưa hoàn thiện
                                                                    </label>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingfive">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                                                        Loại gỗ
                                                        </button>
                                                    </h2>
                                                    <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body pd-16 ds-flex">
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Chưa hoàn thiện
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Chưa hoàn thiện
                                                                    </label>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingsix">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                                                        Bề mặt
                                                        </button>
                                                    </h2>
                                                    <div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="collapsesix" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body pd-16 ds-flex">
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Chưa hoàn thiện
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Chưa hoàn thiện
                                                                    </label>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingseven">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="true" aria-controls="collapseseven">
                                                        Loại vân
                                                        </button>
                                                    </h2>
                                                    <div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="collapseseven" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body pd-16 ds-flex">
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Chưa hoàn thiện
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-fillter">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Chưa hoàn thiện
                                                                    </label>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingage">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseage" aria-expanded="true" aria-controls="collapseage">
                                                        Màu sắc
                                                        </button>
                                                    </h2>
                                                    <div id="collapseage" class="accordion-collapse collapse" aria-labelledby="collapseage" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="grid grid-coloum-3 gap-16 pd-right-20 setting-color-product">
                                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer mg-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Beige">
                                                                        <div class="relative">
                                                                            <div class="v-poppy">
                                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/beige.jpg" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer mg-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Black">
                                                                        <div class="relative">
                                                                            <div class="v-poppy">
                                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/Black.jpg" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer mg-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Brown">
                                                                        <div class="relative">
                                                                            <div class="v-poppy">
                                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/Dark_Brown.jpg" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer mg-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Grey">
                                                                        <div class="relative">
                                                                            <div class="v-poppy">
                                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/dark_grey.jpg" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer mg-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Light">
                                                                        <div class="relative">
                                                                            <div class="v-poppy">
                                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/drak_light.jpg" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div type="button" class="w-56 h-56 pd-5 hover-border-gray-300 rounded-full cursor-pointer mg-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Light Green">
                                                                        <div class="relative">
                                                                            <div class="v-poppy">
                                                                                <img class="w-46 h-46 rounded-full cursor-pointer" src="../asset/img/light_green.jpg" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                  
                    </div>
                    <div class="col-span-9 list-product-all">
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
                                                    <a href="#" class="duration-500 w-full text-black setting-button-click border-black bg-white hover-border-white hover-text-white hover-bg-black">Thêm vào giỏ hàng</a>
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