<?php
include 'koneksi.php';
?>
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <!------- Link back kalau copyrigth diganti atau dihapus --------->
      <div class="copyright-area">&#169; Koperasi Syariah Bundo Saiyo Padang
        <script type="text/javascript">
          var creditsyear = new Date();document.write(creditsyear.getFullYear());
        </script> 
        <a class="mycontent" href="https://id.linkedin.com/in/mahisataruna24/" id="mycontent" > </a>
      </div>
      <!------- Mahisa Taruna 161100008 - STMIK Indonesia Padang 2021 --------->
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-white">
        <h5 class="modal-title" id="exampleModalLabel">Anda ingin keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body bg-white">Tekan "Keluar" untuk mengakhiri sesi.</div>
      <div class="modal-footer bg-white">
        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-sm btn-danger" href="<?= base_url('auth/logout'); ?>">Keluar</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.js"></script>

<script src="<?= base_url('assets/') ?>js/data-web.js"></script>
<script src="<?= base_url('assets/') ?>js/dark-mode-switch.min.js"></script>

<script src="<?= base_url('assets/'); ?>ckeditor/ckeditor.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>


<!-- Script datatable -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>

<!-- Scrip jquery form input pada roleaccess-->
<script>

  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });

  
  $('.form-check-input').on('click', function() {

    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
      url: "<?= base_url('admin/changeaccess'); ?>", 
      type: 'post',
      data: {
        menuId: menuId,
        roleId: roleId
      },
      success: function() {
        document.location.href = "<?= base_url('admin/roleaccess/');?>" + roleId;
      }
    }); 

  });

</script>
<!-- Scrip jquery form input pada roleaccess-->

<!-- Skrip pendapatan -->
<script>
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
  prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
  sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
  dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
  s = '',
  toFixedFix = function(n, prec) {
    var k = Math.pow(10, prec);
    return '' + Math.round(n * k) / k;
  };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Pendapatan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '1'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>
      , 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '2'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '3'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '4'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '5'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '6'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '7'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '8'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '9'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '10'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '11'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE MONTH(tanggal) LIKE '12'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
</script>

<!-- Script Pie Chart User -->
<script>
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';
//  User Chart / Grafik
var ctx = document.getElementById("userPieChart");
var userPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Simpanan Pokok", "Simpanan Wajib", "Infaq"],
    datasets: [{
      data: [ 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE jenis_transaksi LIKE 'Simpanan Pokok'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan WHERE jenis_transaksi LIKE 'Simpanan Wajib'");
      while($data = mysqli_fetch_array($jml_sp)){
        echo $data['SUM(nominal)'];
      }
      ?>, 
      <?php
      include 'koneksi.php';
      $i=0;
      $jml_in = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_infaq");
      while($data = mysqli_fetch_array($jml_in))
      {
        echo $data['SUM(nominal)'];
      }
      ?>],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
</script>


</body>

</html>
