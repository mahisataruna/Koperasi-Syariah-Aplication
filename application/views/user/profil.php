<div class="container-fluid">

<!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb shadow mb-4 bg-white">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->

  <!-- Ini yang baru -->
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
      <?= $this->session->flashdata('message'); ?>
        <div class="card bg-white shadow mb-4 p-3" style="height: 450px;overflow: auto;">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="<?= base_url('assets/img/profile/').$user['image']; ?>" alt="Admin" class="rounded-circle" width="120">
              <div class="mt-4">
                <h4><?= $user['name']; ?></h4>
                <small class="text-muted font-size-sm"><?= date('d F Y', $user['date_created']); ?></small>
                <hr>
                <p>
                <a href="<?= base_url('user/edit'); ?>" class="btn btn-sm btn-primary"> Pengaturan</a>
              </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card bg-white shadow mb-4" style="height: 450px;overflow: auto;">
          <div class="card-body">
            <div class="row gutters-sm">
              <div class="col-sm-3">
                <small class="mb-0">No. KTP</small>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= $user['nik']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <small class="mb-0">Nama Lengkap</small>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= $user['name']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <small class="mb-0">Tanggal Lahir</small>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= $user['tgl_lahir']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <small class="mb-0">Email</small>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= $user['email']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <small class="mb-0">Telp/HP</small>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= $user['no_hp']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <small class="mb-0">Alamat</small>
              </div>
              <div class="col-sm-9 text-secondary">
                <?= $user['alamat']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- ini yang baru akhir -->




</div>

</div>