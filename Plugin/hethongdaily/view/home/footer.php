            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://datacrm.asia" target="_blank" class="footer-link fw-bolder">PHOENIX TECH</a>
                </div>
                <div>
                  <a href="/" class="footer-link me-4" target="_blank">Facebook</a>
                  
                  <a href="/" target="_blank" class="footer-link me-4">Youtube</a>

                  <a href="/" target="_blank" class="footer-link me-4">Tiktok</a>

                  <a href="/" target="_blank" class="footer-link me-4">Instagram</a>
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

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    
    <script src="/plugins/hethongdaily/view/home/assets/vendor/libs/popper/popper.js"></script>

    <script src="/plugins/hethongdaily/view/home/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/plugins/hethongdaily/view/home/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/plugins/hethongdaily/view/home/assets/js/main.js"></script>
    <script src="/plugins/hethongdaily/view/home/assets/js/training.js"></script>

    <!-- Page JS -->
    <script src="/plugins/hethongdaily/view/home/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
    $(document).ready(function() {
      $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',  // Định dạng ngày tháng
        todayHighlight: true, // Đánh dấu ngày hiện tại
        autoclose: true       // Tự động đóng Datepicker sau khi chọn ngày
      });

      $('.datetimepicker').datetimepicker({
        format:'H:i d/m/Y'
      });
    });
    </script>
  </body>
</html>