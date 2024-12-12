
    <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->
    <?php
    $currentYear = date("Y");
    $lastYear = $currentYear - 1;
    ?>
    <?php if(empty($this->uri->segments[1]) || ($this->uri->segments[1]=='chome' && (empty($this->uri->segments[2]) || $this->uri->segments[2] == 'user_login' || $this->uri->segments[2] == 'search'))): ?>
    <footer class="bg-black text-center" style="position: absolute; bottom: 0; width: 100%; padding: 1rem;">
    <div>
        <p style="margin-bottom: 0;font-size: 1.5rem;">© <?= $lastYear ?>-<?= $currentYear ?> All Rights Reserved Al Barkaat</p>
    </div>
    </footer>
    <?php endif;?>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo assets('plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo assets('bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo assets('plugins/fastclick/fastclick.min.js')?>'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo assets('dist/js/app.min.js')?>" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo assets('plugins/sparkline/jquery.sparkline.min.js')?>" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo assets('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo assets('plugins/slimScroll/jquery.slimscroll.min.js')?>" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo assets('plugins/chartjs/Chart.min.js')?>" type="text/javascript"></script>

    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo assets('plugins/daterangepicker/daterangepicker.js')?>" type="text/javascript"></script>

    <!-- Jquery dateformat -->
    <script src="<?php echo assets('plugins/dateformat/dateformat.js')?>" type="text/javascript"></script>

    <!-- dataTables -->
    <script src="<?php echo assets('plugins/datatables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets('plugins/datatables/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets('bootstrap/bootstrap_datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <script src="<?php echo assets('js/barcode/JsBarcode.all.min.js')?>"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    
    <script type="text/javascript">
        $("#loader").hide();
    </script>
    <!-- User JS Files -->
    <script src="<?php echo assets('js/common.js?v=4')?>" type="text/javascript"></script>

    <script src="<?php echo assets('js/master.js?v=1')?>" type="text/javascript"></script>
    <script src="<?php echo assets('js/login.js?v=1')?>"></script>


  </body>
</html>