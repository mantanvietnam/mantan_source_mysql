<?php 
   
        global $settingThemes;
     
    ?>
<footer class="footer-element">
        <div class="container">
            <div class="image-logo">
                <img src="<?php echo @$settingThemes['footerlogo'];?>" alt="">
            </div>
            <div class="title-contact">
                <h2><?php echo @$settingThemes['titlefooter'];?></h2>
                <h3><i class="fa-solid fa-location-dot"></i>Address:<span class="span-icon-information"><?php echo @$settingThemes['address'];?></span></h3>
                <h3><i class="fa-solid fa-phone"></i>Hotline:<span class="span-icon-information"><?php echo @$settingThemes['sdt'];?></span></h3>
                <h3><i class="fa-solid fa-envelope"></i>Email:<span class="span-icon-information"><?php echo @$settingThemes['email'];?></span></h3>
            </div>
        </div>
    </footer>
    <script src="<?= $urlThemeActive?>/asset/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>