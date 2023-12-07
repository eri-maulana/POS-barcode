</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
   <strong>&copy;Copyright</strong> 2023 <a href="https://instagram.com/erimaulana.69/" target="_blank" class="text-primary">
      Eri Maulana</a>.

   <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
   </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap -->
<script src="<?= $main_url; ?>asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= $main_url; ?>asset/AdminLTE/dist/js/adminlte.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/jszip/jszip.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= $main_url; ?>asset/AdminLTE//plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="<?= $main_url; ?>asset/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $main_url; ?>asset/AdminLTE/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $main_url; ?>asset/AdminLTE/dist/js/pages/dashboard3.js"></script>



<script>
   $(function() {
      let tema = sessionStorage.getItem('tema');
      if (tema) {
         $('body').addClass(tema);
         $('#cekDark').prop('checked', true);
      }

      $(document).on('click', "#cekDark", function() {
         if ($('#cekDark').is(':checked')) {
            $('body').addClass('dark-mode');
            sessionStorage.setItem('tema', 'dark-mode');
         } else {
            $('body').removeClass('dark-mode');
            sessionStorage.removeItem('tema');
         }
      })

      $('#tblData').DataTable();
   });
</script>
</body>

</html>