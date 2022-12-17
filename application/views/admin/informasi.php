<div class="container-fluid">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb shadow mb-4 bg-white">
      <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
  </nav>
  <!-- /Breadcrumb -->

  <!-- Mulai welcome area digunakan jika ingin menampilkan Informasi  -->
  <div class="row gutters-sm" id="CardInformasi">
    <div class="col-md-12 mb-3">
      <!-- Pesan error validation-->
      <?php if(validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>

      <?= $this->session->flashdata('message'); ?>
      <!-- Pesan error validation-->
      <div class="card bg-white shadow mb-4">
        <a href="#collapseCardInformasi" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <!-- Judul Konten -->
          <h6 class="m-0 font-weight-bold text-primary">Tambahkan/Upload Berkas Informasi</h6>
        </a>
        <div class="collapse show" id="collapseCardInformasi">
          <div class="card-body" style="height: 450px;overflow: auto;">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/proses">
              <div class="form-group row">
                <label for="name_berkas" class="col-sm-2 col-form-label">Nama berkas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name_berkas" name="name_berkas">
                </div>
              </div>
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control datepicker col-sm-4" rows="3" name="tanggal" id="tanggal"></textarea>
                </div>          
              </div>
              <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                  <textarea class="ckeditor" name="keterangan" id="keterangan" placeholder="Tuliskan keterangan.."></textarea>
                </div>          
              </div>
              <div class="card-footer bg-white table-responsive">
                <div class="col-sm d-flex justify-content-end">
                  <input type="file" name="berkas" id="berkas" class="btn-sm"> &nbsp;
                  <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End welcome area --> 

  <!-- Mulai welcome area digunakan jika ingin menampilkan informasi  -->
  <div class="row gutters-sm">
    <div class="col-md-12 mb-3">
      <div class="card shadow mb-4 bg-white">
        <div class="card-header py-3 bg-white">
          <h6 class="m-0 font-weight-bold text-primary">Informasi Terbaru Koperasi</h6>
        </div>
        <div class="card-body">
          <?php 
          $no = 1;
          foreach($berkas as $row)
          :
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
                &nbsp; &nbsp;<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEdit<?php echo $row->id_berkas;?>"><i class="fa fa-fw fa-edit"></i> Edit</a>
                &nbsp; &nbsp;<a href="<?= base_url('admin/delete_informasi/') . $row->id_berkas;?>" onclick="return confirm('Apakah anda yakin ingin menghapus informasi ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i> Hapus</a>
              </label>
            </div>
            
            <hr>
            <object>
              <embed class="col-sm" type="application/pdf" src="<?php echo base_url('assets/informasi/'). $row->berkas; ?>" width="100%" height="400"  >
              </embed> 
            </object>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End -->

</div>
</div>

<!-- Modal Edit Informasi -->
<?php $no = 0;
foreach($berkas as $row) : $no++;
  ?> 
  <div class="modal fade" id="modalEdit<?php echo $row->id_berkas;?>" tabindex="-1" role="dialog" aria-labelledby="modalEditlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-white">
          <h5 class="modal-title" id="modalEditlabel">Edit Berkas Informasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?= form_open_multipart('admin/edit_informasi');?>
          <div class="modal-body bg-white">
          <input type="hidden" name="id_berkas" value="<?php echo $row->id_berkas;?>">  
          <div class="form-group row">
            <label for="name_berkas" class="col-sm-3 col-form-label">Nama berkas</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name_berkas" name="name_berkas" value="<?php echo $row->name_berkas; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
            <div class="col-sm-9">
              <input  type="date" class="form-control col-sm" rows="3" name="tanggal" id="tanggal" value="<?php echo $row->tanggal; ?>"></textarea>
            </div>          
          </div>
          <div class="form-group row">
            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-9">
              <textarea class="ckeditor" name="keterangan" id="keterangan"><?php echo $row->keterangan; ?></textarea>
            </div>          
          </div>
          <div class="form-group row">
            <label for="berkas" class="col-sm-3 col-form-label">Pilih berkas</label>
            <input type="file" name="berkas" id="berkas" class="btn-sm"><?php echo $row->berkas; ?> &nbsp;
          </div>  
          </div>
          <div class="modal-footer bg-white">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
          <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
          </div>
        </form>
      </div>
    </div>  
  </div>  
<?php endforeach; ?>
<!-- End -->












