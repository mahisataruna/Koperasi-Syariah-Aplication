<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai card menu-->
	<!-- Mulai Content -->
	<div class="row">
		<div class="col-lg col-md col-sm">
			<!-- Pesan error validation-->
			<?php if(validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?>

			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardFormGallery" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Tambah Gallery Website Koperasi</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardFormGallery">
					<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>menu/proses_gallery">
						<div class="col-sm-12 mx-auto">
							<div class="card-body">
								<div class="box_form kiri" style="width: auto;">
									<div class="row">
										<div class="col">
											<div class="form-group row">
												<label for="name_foto" class="col-sm-2 col-form-label">Nama Gambar</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="name_foto" name="name_foto">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm">
											<div class="form-group row">
												<label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
												<div class="col-sm-4">
													<input  type="date" class="form-control" rows="3" name="tanggal" id="tanggal"></textarea>
												</div>    
												<label for="tag" class="col-sm-2 col-form-label">Tag Gambar</label>
												<div class="col-sm-4">
													<input  type="text" class="form-control" rows="3" name="tag" id="tag" placeholder="Cth. Koperasi">
												</div>      
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group row">
												<label for="name_foto" class="col-sm-2 col-form-label">Author</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="author" name="author" placeholder="Cth. Admin">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group row">
												<label for="name_berkas" class="col-sm-2 col-form-label">Upload Gambar</label>
												<div class="col-sm-4">
													<div class="custom-file">
														<input type="file" name="berkas" id="berkas" class="btn-sm">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
							<br>
							<div class="card-footer bg-white">
								<div class="col d-flex justify-content-end">
									<label>
										<a href="<?= base_url('admin'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-sm fa-reply"></i> Kembali</a>
										<button type="submit" class="btn btn-sm btn-primary">Tambah</button>
									</label>
								</div>
							</div>
						</div>
					</form>	
				</div>		
			</div>				
		</div>					
	</div>	
	<!-- End Content -->

	<div class="row">
		<div class="col-lg col-md col-sm">
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardDfBerita" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Daftar Gallery Website Koperasi</h6>
				</a>
				<div class="collapse show" id="collapseCardDfBerita">
					<div class="col-sm-12 mx-auto">
						<div class="card-body" style="height: 300px">
							<div class="table-responsive table-sm" style="height: 250px;overflow: auto;">
								<table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th scope="col-sm" style="text-align: center;">#</th>
											<th style="text-align: center;">Nama Foto</th>
											<th style="text-align: center;">Tanggal</th>
											<th style="text-align: center;">Author</th>
											<th style="text-align: center;">Berkas</th>
											<th style="text-align: center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php

										include 'koneksi.php';

										if(isset($_GET['cari'])){
											$cari = $_GET['cari'];
											$data = mysqli_query($koneksi, "SELECT * FROM gallery WHERE name_foto LIKE '%".$cari."%'");	
										}else{
											$data = mysqli_query($koneksi, "SELECT * FROM gallery");
										}
										$i = 1;
										while($gr = mysqli_fetch_array($data)){
											?>
											<tr id="example1_filter">
												<th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>
												<td width="10%" style="text-align: center;"><?= $gr['name_foto']; ?></td>
												<td width="5%" style="text-align: center;"><?= $gr['tanggal']; ?></td>
												<td width="5%" style="text-align: center;"><?= $gr['author']; ?></td>
												<td width="5%" style="text-align: center;"><?= $gr['berkas']; ?></td>
												<td width="10%" style="text-align: center;">
													<a href="" class="btn btn-sm btn-info" data-toggle="modal"><i class="fas fa-fw fa-eye fa-sm text-white-50"></i></a>
													<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditGallery<?= $gr['id_gallery']; ?>"><i class="fas fa-fw fa-edit fa-sm text-white-50"></i></a>
													<a href="<?= base_url('menu/delete_gallery/'). $gr['id_gallery'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus berita ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
												</td>
											</tr>
											<?php $i++;?>
										<?php } ?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>	
				</div>	
			</div>	
		</div>	
	</div>	
	<!-- End -->
</div>

</div>

<!-- Modal Edit Gallery -->
<?php 
$i = 0;
foreach($data as $gr) : $i++;
	?>
	<div class="modal fade" id="modalEditGallery<?= $gr['id_gallery'];?>" tabindex="-1" role="dialog" aria-labelledby="modalEditGallerylabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-white">
					<h5 class="modal-title" id="modalEditGallerylabel">Edit Gallery Website Koperasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('menu/edit_gallery');?>
				<div class="modal-body bg-white">
					<div class="form-group row">
						<input type="hidden" name="id_gallery" id="id_gallery" value="<?= $gr['id_gallery'];?>">
						<label for="name_foto" class="col-sm-4 col-form-label">Nama Gambar</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name_foto" name="name_foto" value="<?= $gr['name_foto']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
						<div class="col-sm-8">
							<input  type="date" class="form-control" rows="3" name="tanggal" id="tanggal" value="<?= $gr['tanggal']; ?>">
						</div>
					</div>
					<div class="form-group row">	    
						<label for="tag" class="col-sm-4 col-form-label">Tag Gambar</label>
						<div class="col-sm-8">
							<input  type="text" class="form-control" rows="3" name="tag" id="tag" value="<?= $gr['tag']; ?>">
						</div>  	    
					</div>
					<div class="form-group row">
						<label for="name_foto" class="col-sm-4 col-form-label">Author</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="author" name="author" value="<?= $gr['author']; ?>">
						</div>
					</div>	
					<div class="form-group row">	
						<label for="name_berkas" class="col-sm-4 col-form-label">Upload Gambar</label>
						<div class="col-sm-8">
							<div class="custom-file">
								<input type="file" name="berkas" id="berkas" class="btn-sm" value="<?= $gr['berkas']; ?>">
							</div>
						</div>
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
