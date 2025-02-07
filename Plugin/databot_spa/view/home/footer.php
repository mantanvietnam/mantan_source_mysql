            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://ezpics.vn" target="_blank" class="footer-link fw-bolder">DATA SPA</a>
                </div>
                <div>
                  <a href="https://www.facebook.com/ezpicsvn" class="footer-link me-4" target="_blank">Facebook</a>
                  
                  <a href="https://www.youtube.com/channel/UCHk4WJSIfxCKXrlN1FjnUBQ" target="_blank" class="footer-link me-4">Youtube</a>

                  <a
                    href="https://www.tiktok.com/@ezpicsvn"
                    target="_blank"
                    class="footer-link me-4"
                    >Tiktok</a
                  >

                  <a
                    href="https://www.instagram.com/ezpicsvn/"
                    target="_blank"
                    class="footer-link me-4"
                    >Instagram</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <script src="/plugins/databot_spa/view/home/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/plugins/databot_spa/view/home/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/plugins/databot_spa/view/home/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/plugins/databot_spa/view/home/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <script>
      $( function() {
        $( ".datepicker" ).datepicker({
          dateFormat: "dd/mm/yy "
        });
      } );
    </script> 

    <script type="text/javascript">
      $(function () {
        $('.datetimepicker').datetimepicker({
          dateFormat: "dd/mm/yy H:i"
        });
      });
    </script>

    <script type="text/javascript">
      function closemenu(){
        document.getElementById("layout-menu").classList.add("closemenu");
        document.getElementById("layout-menu-close").classList.add("showmenu");
        document.getElementById("layout-menu-close").classList.remove("showmenufix");
        document.getElementById("logoutpage").classList.add("logoutpage");

      }
      function showemenu(){
        document.getElementById("layout-menu").classList.remove("closemenu");
        document.getElementById("layout-menu-close").classList.remove("showmenu");
        document.getElementById("layout-menu-close").classList.add("showmenufix");
        document.getElementById("logoutpage").classList.remove("logoutpage");

      }
    </script>
  </body>
</html>