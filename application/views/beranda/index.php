<!-- Index Beranda dapat dihapus
  Mulai Main Content -->

<div class="container-fluid">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb shadow mb-4">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->

  <!-- Mulai welcome area digunakan jika ingin menampilkan informasi  -->

  <div class="row gutters-sm">
    <div class="col-md-12 mb-3">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Informasi Terbaru Koperasi</h6>
        </div>

        <div class="card-body">
         <?php 
         $no = 1;
         foreach($berkas->result() as $row)
         {
          ?>
          <div class="main-box-body clearfix">
            <div class="form-group row col-sm-12">
              <label class="col-sm-9 col-form-label">
                <i class="fa fa-fw fa-file"></i>
                <b>Keterangan :</b> <?php echo $row->keterangan; ?> 
              </label>
              <label class="col-sm-3 col-form-label">
                <i class="fa fa-fw fa-archive"></i> 
                <b>Tanggal :</b> <?php echo $row->tanggal; ?> 
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 d-flex left-content-end">
                &nbsp; &nbsp;<a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/index'); ?>"><i class="fas fa-fw fa-upload"></i> Upload File</a>
                &nbsp; &nbsp;<a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>assets/informasi/<?php echo $row->berkas; ?>">Edit File</a>

                &nbsp; &nbsp;<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus">Hapus</a>
              </label>
            </div>
            
            <hr>
            <object>
              <embed class="col-sm" type="application/pdf" src="<?php echo base_url(); ?>assets/informasi/<?php echo $row->berkas; ?>" width="100%" height="350"  >
              </embed> 
            </object>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
<!--END -->

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modaHapuslabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalHapuslabel">Anda yakin hapus anggota?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">Tekan hapus untuk menghapus anggota.</div>
      <div class="modal-footer">
        <form action="<?= base_url('upload/delete');?>" method="post">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <input type="hidden" name="id_berkas" value="<?= $row->id_berkas;?>" >
          <button class="btn btn-danger" >Hapus</button>
        </form>
      </div>
    </div>
  </div>

  <!-- End Modal-->

</div>









