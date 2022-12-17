<div class="container">
  <!-- Atur lebar kolom register -->
  <div class="card o-hidden border-0 shadow-sm my-5 col-sm-5 col-md-7 col-lg-8 mx-auto">
    <div class="card-body p-3">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <!-- Mulai kolom register -->
        <div class="col-sm col-lg col-md col-xs">
          <div class="p-3">
            <!-- Judul halaman pada form register -->
            <div class="text-center">
              <!-- Disini nama koperasi dan gambar -->
              <img class="img-fluid px-2 px-sm-2 mt-1 mb-3" width="200px" alt="Logo Koperasi Syariah Bundo Saiyo Padang" src="<?= base_url('assets/'); ?>img/logo-auth.png" width="auto">
              <hr>
              <small>Silahkan melakukan registrasi.</small>
              <br>
              <!-- Disini akhir nama koperasi dan gambar -->
            </div>
            <br>
            <!-- Disini Letak Form Pendaftaran -->
            <form class="user" method="post" accept-charset="utf-8" action="<?= base_url('auth/registration');?>">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <!-- set value untuk mempopulasi ulang jika terjadi kesalahan -->
                  <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap Anda" value="<?= set_value('name'); ?>">
                  <!-- Untuk menampilkan form error -->
                  <?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <!-- set value untuk mempopulasi ulang jika terjadi kesalahan -->
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email " value="<?= set_value('email'); ?>"> 
                  <!-- Untuk menampilkan form error -->
                  <?= form_error('email','<small class="text-danger pl-3">','</small>'); ?>
                </div>
              </div>

              <!-- Disni Form Password -->
              <div class="form-group row">
                <!-- kolom untuk password1 -->              
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                  <?= form_error('password1','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <!-- kolom untuk password2 -->
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                </div>
              </div>

              <!-- validsari umur -->
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="date" class="small">&nbsp; &nbsp; Tanggal Lahir</label>
                  <!-- set value untuk mempopulasi ulang jika terjadi kesalahan -->
                  <input type="date" class="form-control form-control-user" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>"> 
                <?= form_error('tgl_lahir','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="nik" class="small">&nbsp; &nbsp; Nomor NIK KTP</label>
                  <!-- set value untuk mempopulasi ulang jika terjadi kesalahan -->
                  <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="Cth. 1371XXX" value="<?= set_value('nik'); ?>"> 
                  <?= form_error('nik','<small class="text-danger pl-3">','</small>'); ?>
                </div>
              </div>
              <!-- end -->

              <!-- Tombol Register -->
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Buat Akun Koperasi
              </button>
            </form>
            <hr>
            <!-- <div class="text-center">
              <a class="small" href="#">Lupa password?</a> 
            </div> -->
            <div class="text-center">
              <small>Sudah punya akun?</small> <a class="small" href="<?= base_url('auth'); ?>"> masuk disini!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



