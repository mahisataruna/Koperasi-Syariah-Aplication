<div class="container-fluid">
  <!-- Mulai Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb shadow mb-4 bg-white">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->

  <!-- card slider -->
  <div class="row gutters-sm md d-flex">
    <div class="col-lg col-md col-sm">
      <?= $this->session->flashdata('message'); ?>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <?php
                include 'koneksi.php';
                $data_informasi = mysqli_query($koneksi, "SELECT * FROM upload ORDER BY id_berkas");
                $jumlah_berkas = mysqli_num_rows($data_informasi);
                ?> 
                <div class="card bg-gradient-custom text-white shadow mb-4">
                  <div class="card-body">
                    <div class="text-white"><b>BERANDA INFORMASI</b> </div>
                    <h4 class="text font-weight-bold text-white mb-1 text-center"><?= $jumlah_berkas; ?></h4>
                    <hr>
                    <center><a href="<?= base_url('admin/informasi'); ?>" class="text-white small">Lihat selengkapnya <i class="fa fa-arrow-right" aria-hidden="true" ></i></a></center>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <?php
                include 'koneksi.php';
                $data_anggota = mysqli_query($koneksi, "SELECT * FROM user WHERE role_id=2 AND is_active=1");
                $jumlah_anggota = mysqli_num_rows($data_anggota);
                ?>
                <div class="card bg-gradient-mahisa text-white shadow mb-4">
                  <div class="card-body">
                    <div class="text-white"><b>DATA ANGGOTA</b> </div>
                    <h4 class="text font-weight-bold text-white mb-1 text-center"><?= $jumlah_anggota; ?></h4>
                    <hr>
                    <center><a href="<?= base_url('admin/data_anggota'); ?>" class="text-white small">Lihat selengkapnya <i class="fas fa-fw fa-arrow-right" aria-hidden="true" ></i></a></center>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 mb-4"> 
                <?php
                include 'koneksi.php';
                $data_peng = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE validasi='0' ORDER BY id_transaksi");
                $jumlah_peng = mysqli_num_rows($data_peng);
                ?>
                <div class="card bg-gradient-taruna text-white shadow mb-4">
                  <div class="card-body">
                    <div class="text-white"><b>PENGAJUAN TRANSAKSI</b></div>
                    <h4 class="text font-weight-bold text-white mb-1 text-center"><?= $jumlah_peng ?></h4>
                    <hr>
                    <center><a href="<?= base_url('transaksi');?>" class="text-white small">Lihat selengkapnya <i class="fas fa-fw fa-arrow-right" aria-hidden="true" ></i> </a></center>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <?php
                include 'koneksi.php';
                $i=0;
                $jml_bhu = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_bagi_hasil");
                while($data = mysqli_fetch_array($jml_bhu))
                {
                  ?>
                  <div class="card bg-gradient-terakir text-white shadow mb-4">
                    <div class="card-body">
                      <div class="text-white"><b>BAGI HASIL</b></div>
                      <h4 class="text font-weight-bold text-white mb-1 text-center">Rp. 
                        <?= number_format($data['SUM(nominal)']);?>
                      </h4>
                      <hr>
                      <center><a href="<?= base_url('transaksi/bagihasil');?>" class="text-white small">Lihat selengkapnya <i class="fas fa-fw fa-arrow-right" aria-hidden="true" ></i> </a></center>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>  

          <div class="carousel-item">
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <?php
                include 'koneksi.php';
                $i=0;
                $jml_sp = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_simpanan");
                while($data = mysqli_fetch_array($jml_sp))
                {
                  ?>
                  <div class="card bg-gradient-primary text-white shadow mb-4">
                    <div class="card-body">          
                      <div class="text-white"><b>SIMPANAN</b> </div>
                      <h4 class="text font-weight-bold text-white mb-1 text-center">Rp. 
                        <?= number_format($data['SUM(nominal)']);?>
                      </h4>
                      <hr>
                      <center><a href="<?= base_url('transaksi/simpan'); ?>" class="text-white small">Lihat selengkapnya <i class="fas fa-fw fa-arrow-right" aria-hidden="true" ></i> </a></center>
                    </div>
                  </div>
                <?php } ?>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">  
                <?php
                include 'koneksi.php';
                $i=0;
                $jml_pj = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_pinjaman");
                while($data = mysqli_fetch_array($jml_pj))
                {
                  ?>
                  <div class="card bg-gradient-info text-white shadow mb-4">
                    <div class="card-body">
                      <div class="text-white"><b>PINJAMAN</b> </div>
                      <h4 class="text font-weight-bold text-white mb-1 text-center">Rp.
                        <?= number_format($data['SUM(nominal)']);?>
                      </h4>
                      <hr>
                      <center><a href="<?= base_url('transaksi/pinjam'); ?>" class="text-white small">Lihat selengkapnya <i class="fas fa-fw fa-arrow-right" aria-hidden="true" ></i> </a></center>
                    </div>
                  </div>
                <?php } ?>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 mb-4"> 
                <?php
                include 'koneksi.php';
                $i=0;
                $jml_ag = mysqli_query($koneksi, "SELECT SUM(jumlah_angsuran) FROM tb_angsuran");
                while($data = mysqli_fetch_array($jml_ag))
                {
                  ?>
                  <div class="card bg-gradient-success text-white shadow mb-4">
                    <div class="card-body">
                      <div class="text-white"><b>ANGSURAN</b></div>
                      <h4 class="text font-weight-bold text-white mb-1 text-center">Rp. 
                        <?= number_format($data['SUM(jumlah_angsuran)']);?>
                      </h4>
                      <hr>
                      <center><a href="<?= base_url('transaksi/angsuran'); ?>" class="text-white small">Lihat selengkapnya <i class="fas fa-fw fa-arrow-right" aria-hidden="true" ></i> </a></center>
                    </div>
                  </div>
                <?php } ?>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 mb-4">  
                <?php
                include 'koneksi.php';
                $i=0;
                $jml_in = mysqli_query($koneksi, "SELECT SUM(nominal) FROM tb_infaq");
                while($data = mysqli_fetch_array($jml_in))
                {
                  ?>
                  <div class="card bg-gradient-dark text-white shadow mb-4">
                    <div class="card-body">
                      <div class="text-white"><b>INFAQ</b></div>
                      <h4 class="text font-weight-bold text-white mb-1 text-center">Rp. 
                        <?= number_format($data['SUM(nominal)']);?>
                      </h4>
                      <hr>
                      <center><a href="<?= base_url('transaksi/infaq'); ?>" class="text-white small">Lihat selengkapnya <i class="fas fa-fw fa-arrow-right" aria-hidden="true" ></i> </a></center>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>  
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div> 
  </div>  
  <!-- End -->

  <!-- Grafik Row -->
  <div class="row gutters-sm md d-flex">
    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card bg-white shadow mb-4">
        <!-- Card Header - Collapse -->
        <a href="#collapseCardPie" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardPie">
          <!-- Judul Konten -->
          <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Koperasi</h6>
        </a>
        <div class="collapse show" id="collapseCardPie">
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
              <canvas id="userPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
              <span class="mr-2">
                <i class="fas fa-circle text-primary"></i> Simp. Pokok
              </span>
              <span class="mr-2">
                <i class="fas fa-circle text-success"></i> Simp. Wajib
              </span>
              <span class="mr-2">
                <i class="fas fa-circle text-info"></i> Infaq
              </span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card bg-white shadow mb-4">
        <!-- Card Header - Dropdown -->
        <a href="#collapseCardOverview" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <!-- Judul Konten -->
          <h6 class="m-0 font-weight-bold text-primary">Grafik Simpanan Anggota</h6>
        </a>
        <div class="collapse show" id="collapseCardOverview">
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End -->

  <!-- Proses Persetujuan Calon Anggota -->
  <div class="row gutters-sm">
    <div class="col-sm">
      <!-- End Pesan -->
      <div class="card bg-white shadow mb-4">
        <a href="#collapseCardPengajuan" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <!-- Judul Konten -->
          <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Anggota Baru</h6>
        </a>
        <div class="collapse show" id="collapseCardPengajuan">
          <div class="col-sm-12 mx-auto">
            <div class="card-body">
              <!-- Mulai card tabel -->
              <div class="table-responsive table-sm">

                <!-- Mulai tabel -->
                <table class="table table-bordered table-hover table-sm" id="tabelanggota" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col-sm" style="text-align: center;">#</th>
                      <th>Nama Calon Anggota</th>
                      <th style="text-align: center;">Email</th>
                      <th style="text-align: center;">Tanggal Daftar</th>
                      <th style="text-align: center;">Umur</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                  //Koneksi database
                    include 'koneksi.php';

                    $data_calon_anggota = mysqli_query($koneksi, "SELECT * FROM user WHERE is_active=0 ORDER BY id DESC");

                    $jumlah_anggota = mysqli_num_rows($data_calon_anggota);

                    ?>
                    <?php $i = 1; ?>
                    <?php 
                    if (isset($data_calon_anggota)) {

                      foreach($data_calon_anggota as $dc) : 

                        ?>
                        <tr id="example1_filter">
                          <th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>
                          <td width="14%"><?= $dc['name']; ?></td>
                          <td width="20%" style="text-align: center;"><?= $dc['email']; ?></td>
                          <td width="10%" style="text-align: center;"><?= date('d F Y', $dc['date_created']); ?></td>
                          <td width="10%" style="text-align: center;">
                            <?php
                            $lahir = new DateTime($dc['tgl_lahir']);
                            $today = new DateTime();
                            $umur =$today->diff($lahir);
                            echo $umur->y; echo " Tahun";
                            ?>
                            <td width="5%" style="text-align: center;">
                              <a href="#modalActive<?php echo $dc['id'];?>" class="btn btn-sm btn-info center-block" data-toggle="modal">
                                <i class="fas fa-fw fa-check fa-sm text-white-50"></i></a>
                                <a href="<?= base_url('admin/delete_anggota/') . $dc['id'];?>" onclick="return confirm('Apakah anda yakin ingin menolak aktivasi anggota?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times fa-sm"></i></a> 
                              </td>
                            </tr>
                            <?php $i++;?>
                          <?php endforeach; ?>
                        <?php }?>
                      </tbody>
                    </table>
                    <!-- End -->
                  </div>  
                </div>  
              </div>
            </div>  
          </div>  
        </div>
      </div>
      <!-- End -->
    </div>
    <!-- End -->

  </div>
  <!-- End of Main Content -->

  <!-- Modal Aktivasi Anggota -->
  <?php 
  foreach($data_calon_anggota as $dc) : 
  ?>
    <div class="modal fade col-sm" id="modalActive<?php echo $dc['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modalSubMenulabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-white">
            <h5 class="modal-title" id="modalSubMenulabel">Aktivasi Anggota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?= form_open_multipart('user/active');?>
          <div class="modal-body bg-white">
            <span>Apakah anda akan mengaktifkan Anggota ini?</span>
            <input type="hidden" name="id" id="id" value="<?= $dc['id']; ?>">
          </div>
          <div class="modal-footer bg-white">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-primary"><span class="spinner-border spinner-border-sm"></span>  Aktifkan</button>
          </div>
        </form>
      </div>
      <!-- End -->
    </div>
    </div>
  <?php endforeach; ?>
  <!-- End Modal -->


