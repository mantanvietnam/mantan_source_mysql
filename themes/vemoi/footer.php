<?php 
    global $settingThemes;
    ?>
    <footer>
        <div class="footer-up">
            <div class="container">
                <div class="row">
                    <div id="logo" class="col-lg-6">
                        <img src="<?= @$settingThemes['logo'];?>" alt="">
                        <h5><?= @$settingThemes['descriptionfooter'];?></h5>
                        <h3><?= @$settingThemes['emailfooter'];?></h3>
                    </div>
                    <div id="addres" class="col-lg-6">
                        <div class="column">
                            <a class="bold" href="">company</a><br>
                            <a href="">About Us</a><br>
                            <a href="">Careers</a><br>
                            <a href="">How Book</a><br>
                            <a href="">Blog</a>
                        </div>
                        <div class="column">
                            <a class="bold" href="">Discover</a><br>
                            <a href="">Webinars</a><br>
                            <a href="">In Person</a><br>
                            <a href="">Categories</a><br>
                            <a href="">Countries</a>
                        </div>
                        <div class="column">
                            <a class="bold" href="">Social Media</a><br>
                            <a href="<?=$settingThemes['Instagram'] ?>">Instagram</a><br>
                            <a href="<?=$settingThemes['Facebook'] ?>">Facebook</a><br>
                            <a href="<?=$settingThemes['Twitter'] ?>">Twitter</a><br>
                            <a href="<?=$settingThemes['YouTube'] ?>">YouTube</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-down my-4">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-5">
                        <p>© Copyright VEMOI.NET 2024</p>
                    </div>

                    <div class="col-lg-7 faq">
                        <a href="">FAQ</a>
                        <a href="">Terms of Condition</a>
                        <a href="">Privacy Policy</a>
                        <a href="">Changelog</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.js"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- jQuery -->
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Slick Carousel JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>