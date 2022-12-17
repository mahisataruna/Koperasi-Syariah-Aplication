<!-- Mulai Main Content -->

<div class="container-fluid">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb shadow mb-4 bg-white">
      <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->

  <!-- Mulai welcome area digunakan jika ingin menampilkan informasi  -->

  <div class="row gutters-sm">
    <div class="col-md-12 mb-3">
      <?= $this->session->flashdata('message'); ?>
      <div class="card shadow mb-4 bg-white">
        <div class="card-header py-3 bg-white">
          <h6 class="m-0 font-weight-bold text-primary">Informasi Terbaru Koperasi</h6>
        </div>

        <div class="card-body"> 
         <?php 
         $no = 1;
         foreach($berkas as $row)
         {
          ?>
          <div class="main-box-body clearfix">
            <div class="form-group row col-sm-12">
              <label class="col-sm-9 col-form-label">
                <i class="fa fa-fw fa-file fa-sm" aria-hidden="true"></i>
                <b>Keterangan :</b> <?php echo $row->keterangan; ?>
              </label>
              <label class="col-sm-3 col-form-label">
              <i class="fa fa-fw fa-calendar fa-sm" aria-hidden="true"></i> 
                <b>Tanggal :</b> <?php echo $row->tanggal; ?> 
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 d-flex left-content-end">
            &nbsp; &nbsp;<a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>assets/informasi/<?php echo $row->berkas; ?>" target="blank_page"><i class="fa fa-fw fa-download"></i> Download File</a>
              </label>
            </div>
            <object>
              <embed class="col-sm" type="application/pdf" src="<?php echo base_url(); ?>assets/informasi/<?php echo $row->berkas; ?>" width="100%" height="350"  >
              </embed> 
            </object>
            <br>
            <hr>
            <div></div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
<!--END -->
</div>





