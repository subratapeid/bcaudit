<!-- Main Cointainer responsive div end -->
</div>

<footer class="footer closed">
  <div class="copyright_item">
    <span id="footerText"></span>
  </div>
</footer>

<!-- Popper.js cdn -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- jquerry -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->

<!-- bootstrap script cdn-->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>

<!-- Sweet allert CDN script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- signature  pad cdn -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

<!-- JS pdf and html2Canvas cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- Required CDN For Datepicker -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <!-- custom JavaScript -->
  <script src="js/script.js"></script>
  <script src="js/time_update.js"></script>
  <script src="js/formScrollToBlank.js"></script>

<script>
  var logoutBtn = document.getElementById('logout_button');
    if(logoutBtn){
      logoutBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action of the link
          if (confirm('Are you sure you want to logout?')) {
              // If user clicks OK, execute the logout code
              window.location.href = 'logout.php';
          }
      });
    }

  // console audit number in allpages if it is setted
  let auditNumberPrint;
  <?php if (isset($auditNumber)) { ?>
      auditNumberPrint = "<?php echo($auditNumber); ?>";
      <?php } else { ?>
        auditNumberPrint = 'not set';
        <?php } ?>
      console.log('audit number: ', auditNumberPrint);
</script>

</body>
</html>
