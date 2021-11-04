    </main>
    <footer id="footer" class="section-bg">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Chilin</strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">Nguyen Thi Hoai</a>
            </div>
        </div>
    </footer><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- JavaScript Libraries -->
    <!-- <script src="{$url}dist/templates/public/libs/jquery/jquery.min.js"></script> -->
    <!-- <script src="{$url}dist/templates/public/libs/jquery/jquery-migrate.min.js"></script> -->
    <!-- <script src="{$url}dist/templates/public/libs/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{$url}dist/templates/public/libs/easing/easing.min.js"></script>
    <script src="{$url}dist/templates/public/libs/mobile-nav/mobile-nav.js"></script>
    <script src="{$url}dist/templates/public/libs/wow/wow.min.js"></script>
    <script src="{$url}dist/templates/public/libs/waypoints/waypoints.min.js"></script>
    <script src="{$url}dist/templates/public/libs/counterup/counterup.min.js"></script>
    <script src="{$url}dist/templates/public/libs/owlcarousel/owl.carousel.min.js"></script>
    <script src="{$url}dist/templates/public/libs/isotope/isotope.pkgd.min.js"></script>
    <script src="{$url}dist/templates/public/libs/lightbox/js/lightbox.min.js"></script>
    <script src="{$url}dist/templates/public/libs/toast-master/js/jquery.toast.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="{$url}dist/templates/public/contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="{$url}dist/templates/public/js/main.js"></script>

    <!-- Custom Main Javascript File -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{$url}dist/custom/public/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{$url}dist/custom/public/js/main.js"></script>
    <script src="{$url}dist/custom/public/js/login.js"></script>
    {if !empty($message)}
    <script type="text/javascript">
        $(document).ready(function() {
            showMessage('{$message.type}', '{$message.msg}');
        });
    </script>
    {/if}
</body>
</html>