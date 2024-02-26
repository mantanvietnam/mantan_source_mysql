 <!-- ====FOOTER==== -->
<?php $setting = setting(); ?>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Kết Nối Với
                        <span class="sign">
                           <?php echo @$setting['fullName']; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7"></path>
                            </svg>
                        </span>
                    </h3>

                </div>
                <div class="col-md-12">
                    <div class="list-contact">
                        <a href="<?php echo @$setting['facebook']; ?>" target="_blank" class="facebook"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo @$setting['youtube']; ?>"  target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                        <a href="<?php echo @$setting['instagram']; ?>"  target="_blank" class="phone"><i class="fas fa-phone-square-alt"></i></a>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <center style="color: #fff;">Website được xây dựng bởi <a href="http://manmoweb.com/" title="Công cụ tạo web tự động">Mần Mò Web</a></center>
                </div>
            </div>
        </div>
         <?php echo @$setting['messenger'];?>
    </footer>

    <script>
        $(document).ready(function() {
            $('.list-feeling').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.list-feedback').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        });
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
</body>

</html>