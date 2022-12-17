<!-- Login Page Koperasi Syariah Bundo Saiyo Padang 2020 -->

<div class="container">

  <!-- Outer Row disini -->
  <div class="row justify-content-center">

    <!-- disini untuk mengatur lebar kolom login page -->
    <div class="col-sm-5 col-md-7 col-lg-5 mx-auto">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-4">
          <!-- Nested Row within Card Body -->
          <div class="row">

            <!-- Atur pembungkus col-lg-5 disini jadi lg saja -->
            <div class="col-lg col-md col-sm col-xs">
              <div class="p-4">
                <div class="text-center">
                  <!-- Disini nama koperasi dan gambar -->
                  <img class="img-fluid px-2 px-sm-2 mt-1 mb-3" width="200px" alt="Logo Koperasi Syariah Bundo Saiyo Padang" src="<?= base_url('assets/'); ?>img/logo-auth.png" width="auto">
                  <br>
                  <small>Masukkan email dan password.</small>
                  <p></p>
                  <!-- Disini akhir nama koperasi dan gambar -->
                </div>
                <!-- Tampil jika berhasil dari register -->
                <?= $this->session->flashdata('message'); ?>
                <!-- Form Login -->
                <form class="user" accept-charset="utf-8" method="post" action="<?= base_url('auth'); ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                    <?= form_error('email','<small class="text-danger">','</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1','<small class="text-danger">','</small>'); ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Masuk
                  </button>
                </form>

                <hr>
                <!-- <div class="text-center">
                  <a class="small" href="#">Lupa password?</a>
                </div> -->
                <div class="text-center">
                  <small>Belum punya akun?</small> <a class="small" href="" data-toggle="modal" data-target="#modalKonfirmasi">daftar disini!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modaTambahSimpanlabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahSimpanlabel"><small><i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i> Konfirmasi Umur</small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda sudah berumur <u><b>20 tahun?</b></u></p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Belum</button>
        <a href="<?= base_url('auth/registration'); ?>" class="btn btn-sm btn-primary">Sudah</a>
      </div>
    </div>
  </div>
</div>
<!-- End -->

