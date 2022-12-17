<!-- Tambaj indformasi dapat dihapus -->
<div class="container-fluid">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb shadow mb-4">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->

 <!-- Mulai welcome area digunakan jika ingin menampilkan Informasi  -->
<div class="row gutters-sm">
  <div class="col-md-12 mb-3">
    <div class="card bg-light shadow mb-4">
      <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Tambahkan Informasi</h6>
      </div>
      <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>upload/proses">
          <div class="form-group row">
            <label for="name_berkas" class="col-sm-2 col-form-label">Nama berkas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name_berkas" name="name_berkas">
            </div>
          </div>
          <div class="form-group row">
            <label for="name_berkas" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="5" name="keterangan" id="keterangan"></textarea>
            </div>          
          </div>

          <div class="form-group row">
            <input type="file" name="berkas" id="berkas">
          </div>
          
          <div class="form-group row">
            <input type="submit" value="Simpan"/>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End welcome area -->



</div>	
</div>