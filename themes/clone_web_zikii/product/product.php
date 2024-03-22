<?php
    getHeader();
    global $urlThemeActive;
    global $session;
    global $settingThemes;

?>
 <main>
        <section id="section-produce">
            <div class="container">
                <p class="bgr"><a href="/">Trang chủ</a> / <a href="/allProduct">Sản phẩm</a> / <?php echo $product->title; ?></p>

                <div class="row">
                    <div class="col-lg-9 col-12">
                        <div class="produce-content">
                            <div class="product-short">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-12">
                                        <div class="produce-img-nav">
                                            <div class="img-nav">
                                                 <img src="<?php echo $product->image; ?>" alt="">
                                            </div>
                                            
                                            <?php if(!empty($product->images)){
                                              foreach($product->images as $item) {
                                                  if(!empty($item)){
                                                    echo '<div class="img-nav">
                                                <img src="'.$item.'" alt="">
                                            </div>';
                                                    }}}
                                                ?>

                                        </div>
                                        <div class="produce-img-for">
                                            <div class="img-for">
                                                 <img src="<?php echo $product->image; ?>" alt="">
                                            </div>
                                          
                                           <?php if(!empty($product->images)){
                                              foreach($product->images as $item) {
                                                  if(!empty($item)){
                                                   echo '<div class="img-for">
                                                <img src="'.$item.'" alt="">
                                            </div>';

                                                    }}}
                                                ?>

                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 col-12">
                                        <div class="produce-info">
                                            <div class="produce-name">
                                                <h3><?php echo $product->title; ?></h3>
                                                <h4> <?php echo number_format($product->price); ?> ₫</h4>
                                            </div>
                                            <div class="quantity-input">
                                                <button class="quantity-btn" onclick="minusQuantity()">-</button>
                                                <input type="text" id="quantity_buy" class="product-qty" type="text" name="quantity_buy"  value="1" readonly>
                                                <button class="quantity-btn" onclick="plusQuantity()">+</button>
                                            </div>
                                            <div class="produce-btn">
                                                <button  onclick="addProductCart(<?php echo $product->id;?>,'true')">Thêm vào giỏ hàng</button>
                                            </div>
                                            <div class="produce-contact">
                                               <ul>
                                                <li>
                                                    <a target="_blank" href="mailto:info@godraw.vn?subject=<?php echo $product->title;?>&body=Link trang: <?php echo $product->slug;?>" class="text-white">
                                                        <i class="fa-regular fa-envelope"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode('https://kyiova.vn/'.$product->slug.'.html');?>" class="text-white">
                                                        <i class="fa-brands fa-pinterest"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode('https://kyiova.vn/'.$product->slug.'.html');?>" class="text-white">
                                                        <i class="fa-brands fa-linkedin"></i>
                                                    </a>
                                                </li>
                                                
                                                
                                                <li>
                                                    <a target="_blank" class="text-white" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://kyiova.vn/'.$product->slug.'.html');?>" target="_blank" rel="noopener">
                                                        <i class="fa-brands fa-facebook"></i>
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <a target="_blank"  class="text-white" href="http://twitter.com/share?url=<?php echo urlencode('https://kyiova.vn/'.$product->slug.'.html');?>" target="_blank">
                                                        <i class="fa-brands fa-twitter"></i>
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <a  target="_blank" class="text-white" href="https://telegram.me/share/url?url=<?php echo urlencode('https://kyiova.vn/'.$product->slug.'.html');?>" target="_blank">
                                                        <i class="fa-brands fa-telegram"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a target="_blank"  class="text-white" href="https://tumblr.com/widgets/share/tool?canonicalUrl=<?php echo urlencode('https://kyiova.vn/'.$product->slug.'.html');?>" target="_blank">
                                                        <i class="fa-brands fa-tumblr"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                                  <!--   <li><a href=""><i class="fa-brands fa-facebook-f face"></i></a></li>
                                                    <li><a href=""><i class="fa-brands fa-x-twitter twit"></i></a></li>
                                                    <li><a href=""><i class="fa-brands fa-pinterest-p pint"></i></a></li>
                                                    <li><a href=""><i class="fa-regular fa-envelope mail"></i></a></li>
                                                    <li><a href=""><i class="fa-brands fa-linkedin-in link"></i></a></li>
                                                </ul> -->
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="produce-text">
                                            <h4>Mô tả sản phẩm</h4>
                                            <div class="produce-description">
                                               <?php echo @$product->info; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="produce-other">
                                            <h4>Các sản phẩm khác</h4>
                                            <div class="list-produce-other">
                                               <?php if(!empty($other_product)) { 
                                                foreach($other_product as $item) {
                                                    $link = '/san-pham/'.$item->slug.'.html';
                                                   

                                                        echo '<div class="item-produce-other">
                                                            <div class="produce-other-img">
                                                                <a href="'.$link.'"><img src="'. $item->image.'" alt=""></a>
                                                            </div>
                                                            <div class="produce-other-detail">
                                                                <div class="produce-other-name">
                                                                    <a href="'.$link.'">'. $item->title.'</a>
                                                                </div>
                                                                <p>1.300.000 ₫</p>
                                                                <button><a href="'.$link.'">Thêm vào giỏ hàng</a></button>
                                                            </div>
                                                        </div>';
                                                    }
                                                }?>

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 sidebar">
                        <div class="page-blog-sidebar">
                            <div class="sidebar-heading">
                                <div class="sidebar-title">
                                    <span>Bài viết nổi bật</span>
                                </div>
                            </div>

                            <div class="sidebar-listpost">
                                <?php  if(!empty(getPostPin())){
                                    foreach(getPostPin() as $key => $item){
                                        echo '<div class="sidebar-post-item">
                                    <div class="row">
                                        <div class="col-5 col-post-image">
                                            <div class="sidebar-post-image">
                                                <img src="'.@$item->image.'" alt="">
                                            </div>
                                        </div>

                                        <div class="col-7 col-post-title">
                                            <div class="sidebar-post-title">
                                                <a href="/'.@$item->slug.'.html">'.@$item->title.'</a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                    }
                                } ?>  
                            </div>
                        </div>

                        <div class="category-product-sidebar">
                            <div class="sidebar-heading">
                                <div class="sidebar-title">
                                    <span>Chuyên mục sản phẩm</span>
                                </div>
                            </div>

                            <div class="sidebar-listcate">
                                <ul>
                                     <?php $category = getCategorieProduct();
                                        if(!empty($category)){
                                            foreach($category as $key => $item){
                                                echo '<li><a href="/category/'.$item->slug.'.html">'.$item->name.'</a></li>';
                                            }
                                        }
                                     ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<script type="text/javascript">
     function addProductCart(idProduct, status){
        let quantity = parseInt($('#quantity_buy').val());
        // console.log(quantity);
        // console.log(idProduct);
        // console.log(status);

        $.ajax({
            method: "GET",
            url: "/apis/addProductToCart/?id_product="+idProduct+"&quantity="+quantity+"&status=true"
        })
        .done(function( msg ) {
            console.log(msg);

            // document.getElementById("count").innerHTML = msg.count;
             if(status=='true'){
                 window.location = '/gio-hang';
             }else{
               /* document.getElementById("myElement").style.display = 'block';

                var myElement = document.getElementById('myElement');

                // Hàm thay đổi CSS
                function changeCSS() {
                    myElement.style.display = 'none';
                }

                // Đặt hẹn giờ để thực hiện thay đổi sau 10 giây
                setTimeout(changeCSS, 3000);*/
             }
        });
    }
    function plusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity++;
        $('#quantity_buy').val(quantity);
    }

    function minusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity--;
        if(quantity<1) quantity=1;
        $('#quantity_buy').val(quantity);
    }
</script>

<?php getFooter();?>