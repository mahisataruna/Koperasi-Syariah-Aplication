<!-- Mulai Main Content -->
<div class="container-fluid">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb shadow mb-4 bg-white">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->

  <!-- Mulai Card 1 -->
  <div class="row gutters-sm">
    <div class="col-lg col-md col-sm">
      <?= $this->session->flashdata('message'); ?>
      <div class="card bg-white shadow mb-4">
        <a href="#collapseCardAnggota" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <!-- Judul Konten -->
          <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Transaksi</h6>
        </a>

        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardAnggota">
          <div class="card-body">
            <div class="table-responsive table-sm" style="height: 360px;overflow: auto;">
              <table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
                <thead class="thead-light">
                  <tr>
                    <th scope="col-sm" style="text-align: center;">#</th>
                    <th scope="col-sm" style="text-align: center;">Nomor Transaksi</th>
                    <th scope="col-sm" style="text-align: center;">Nama Anggota</th>
                    <th scope="col-sm" style="text-align: center;">Jenis Pengajuan</th>
                    <th scope="col-sm" style="text-align: center;">Tanggal Pengajuan</th>
                    <th scope="col-sm" style="text-align: center;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  <?php foreach ($ambilPeng as $ap) : {
                   ?>
                   <tr id="example1_filter">
                    <th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>

                    <td width="8%" scope="col-sm" style="text-align: center;"><?= $ap['id_transaksi']; ?></td>
                    <td width="8%" scope="col-sm" style="text-align: center;"><?= $ap['name'];?></td>
                    <td width="20%" style="text-align: center;"><?= $ap['jenis_transaksi']; ?></td>
                    <td width="13%" style="text-align: center;"><?= $ap['tanggal']; ?></td>
                    <td width="8%" style="text-align: center;">

                      <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalValidasi<?= $ap['id_transaksi']; ?>"><i class="fas fa-fw fa-check fa-sm"></i></a>
                      <!--<a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalTolak<?php //echo $ap['id_transaksi'];?>"><i class="fas fa-fw fa-times fa-sm"></i></a>-->
                      <a href="<?= base_url('transaksi/delete_pengajuan/'). $ap['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus menolak pengajuan ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times fa-sm"></i></a>
                    </td>
                  </tr>
                  <?php $i++;?>
                <?php } ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
<!-- End data anggota Koperasi -->
</div>
</div>
<!-- End Card -->

<!-- Modal Validasi -->
<?php foreach ($ambilPeng as $ap) : 
?>
    <div class="modal fade col-sm" id="modalValidasi<?= $ap['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalSubMenulabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalSubMenulabel">Validasi Pengajuan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?= form_open_multipart('transaksi/validasi');?>
          <div class="modal-body">
            <span>Apakah anda akan melakukan validasi transaksi?</span>
            <input type="hidden" name="id_transaksi" id="id" value="<?= $ap['id_transaksi']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-primary"><span class="spinner-border spinner-border-sm"></span>  Validasi</button>
          </div>
        </form>
      </div>
      <!-- End -->
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal Tolak Transaksi -->
<?php 
  foreach($ambilPeng as $ap) : 
  ?>
    <div class="modal fade col-sm" id="modalTolak<?php echo $ap['id_transaksi'];?>" tabindex="-1" role="dialog" aria-labelledby="modalSubMenulabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalSubMenulabel">Tolak Pengajuan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?= form_open_multipart('transaksi/tolak_pengajuan');?>
          <div class="modal-body">
            <span>Apakah anda akan menolak pengajuan ini?</span>
            <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?= $ap['id_transaksi']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-primary"><span class="spinner-border spinner-border-sm"></span>  Tolak</button>
          </div>
        </form>
      </div>
      <!-- End -->
    </div>
    </div>
  <?php endforeach; ?>
<!-- End -->







