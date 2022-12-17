<!DOCTYPE html>
<html>
<head>
  <title><?= $title; ?></title>
    <style type="text/css">
    h1 {
      font-weight: bold;
      font-size: 14pt;
      text-align: center;  
    }
    p {
      font-size: 11pt;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
    table th {
        font-size: 11pt;
        padding: 3px 3px;
        background-color: #ddd;
    }
  
    table td {
        font-size: 11pt;
        padding: 3px 3px;
        border:1px solid #000000;
    }
  </style>
</head>
<body>
  <img src="<?= base_url('/assets/img/');?>logokoperasi.png" style="position: absolute; width: 80px; height: 80px;">
  <table style="width: 100%; border-style: 0%;">
    <tr>
      <td align="center">
        <h1 style="line-height: 1.6; font-weight: bold;">
          Laporan Data Anggota <br>
          Koperasi Syariah Bundo Saiyo Padang
        </h1>
      </td>
    </tr>
  </table>
  <small><center><i>Jl. SMA 13 Tanjung Aur, Balai Gadang, Koto Tangah, Kota Padang, Sumatera Barat &nbsp; &nbsp; HP : 081363455700</i></center></small>
  <hr>
  <br>
  <p>&nbsp; Periode : <?= date('F Y'); ?></p> 
  <div id="outtable">
   <table class="table table-bordered table-hover table-sm" border="1" cellspacing="0" width="100%">
    <thead class="thead-light">
     <tr>
      <th>No</th>
      <th>Nama Anggota</th>
      <th >NIK. KTP</th>
      <th>No. Telepon</th>
      <th>Alamat</th>
    </tr>
  </thead>
  <tbody>
   <?php $i = 1; ?>
   <?php foreach($data as $row) : ?>
     <tr>
      <td width="4%" scope="row" style="text-align: center;"><?= $i; ?></td>
      <td width="15%"><?php echo $row->name ?></td>
      <td width="15%" style="text-align: center;"><?php echo $row->nik ?></td>
      <td width="13%" style="text-align: center;"><?php echo $row->no_hp ?></td>
      <td width="25%"><?php echo $row->alamat ?></td>
    </tr>
    <?php $i++;?>
  <?php endforeach; ?>
</tbody>
</table>
</div>

<div class="col-md-3 col-md-offset-5">
  <br>
  <p style="text-align: right;">Padang, <?php $tgl=date('d M Y'); echo $tgl; ?> &nbsp; &nbsp; &nbsp;  
    <br>
    <p style="text-align: right;">Pimpinan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
    <p><br></p><br>
    <p style="text-align: right;"><b><u>Nofyelni, S.Pd</u></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
  </div>
</body>
</html>