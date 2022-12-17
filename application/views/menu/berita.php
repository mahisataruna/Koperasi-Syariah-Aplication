<!-- Mulai Main Content -->
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
			<!-- Pesan error validation-->
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardFormPinjam" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Tambah Berita Website Koperasi</h6>
				</a>
				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardFormPinjam">
					<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>menu/proses_berita">
						<div class="col-sm-12 mx-auto">
							<div class="card-body">
								<div class="box_form kiri" style="width: auto;">
									<div class="row">
										<div class="col">
											<div class="form-group row">
												<label for="name_berkas" class="col-sm-2 col-form-label">Judul Berita</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="judul" name="judul">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group row">
												<label for="image" class="col-sm-2 col-form-label">Upload Foto</label>
												<div class="col-sm-4">
													<div class="custom-file">
														<input type="file" name="berkas" id="berkas" class="btn-sm">
													</div>
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
												<label for="tag" class="col-sm-2 col-form-label">Tag Berita</label>
												<div class="col-sm-4">
													<input  type="text" class="form-control" rows="3" name="tag" id="tag" placeholder="Cth. Koperasi"></textarea>
												</div>      
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group row">
												<label for="author" class="col-sm-2 col-form-label">Author</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="author" name="author" placeholder="Cth. Admin">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group row">
												<label for="name_berkas" class="col-sm-2 col-form-label">Tulis Artikel</label>
												<div class="col-sm-10">
													<textarea class="ckeditor" name="tulis_artikel" id="tulis_artikel" placeholder="Tuliskan Artikel.."></textarea>
												</div>
											</div>
										</div>
									</div>


								</div>
							</div>
							<div class="card-footer bg-white">
								<div class="col d-flex justify-content-end">
									<label>
										<a href="<?= base_url('admin'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-sm fa-reply"></i> Kembali</a>
										<button type="submit" class="btn btn-sm btn-primary">Posting</button>
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
					<h6 class="m-0 font-weight-bold text-primary">Daftar Berita Website Koperasi</h6>
				</a>
				<div class="collapse show" id="collapseCardDfBerita">
					<div class="col-sm-12 mx-auto">
						<div class="card-body">
							<div class="table-responsive table-sm" style="height: 250px;overflow: auto;">
								<table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th scope="col-sm" style="text-align: center;">#</th>
											<th style="text-align: center;">Judul</th>
											<th style="text-align: center;">Tanggal</th>
											<th style="text-align: center;">Author</th>
											<th style="text-align: center;">Tag</th>
											<th style="text-align: center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach($berita as $row)
										:
										?>
										<tr id="example1_filter">
											<th scope="row" width="3%" style="text-align: center;"><?= $no++; ?></th>
											<td width="20%"><?php echo $row->judul; ?></td>
											<td width="5%" style="text-align: center;"><?php echo $row->tanggal; ?></td>
											<td width="10%" style="text-align: center;"><?php echo $row->author; ?></td>
											<td width="10%" style="text-align: center;"><?php echo $row->tag; ?></td>
											<td width="7%" style="text-align: center;">
												<a href="http://localhost/koperasi-bundosaiyo/blog_berita.php" class="btn btn-sm btn-info"><i class="fas fa-fw fa-eye fa-sm text-white-50"></i></a>
												<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditBerita<?php echo $row->id; ?>"><i class="fas fa-edit fa-sm"></i></a>
												<a href="<?php echo base_url('menu/delete_berita/'). $row->id;?>" onclick="return confirm('Apakah anda yakin ingin menghapus berita ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
											</td>
										</tr>
									<?php endforeach;?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>	
				</div>	
			</div>	
		</div>	
	</div>	

</div>
</div>

<?php $i = 0;
foreach($berita as $row) : $i++;
	?>
	<div class="modal fade" id="modalEditBerita<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modaEditlabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-white">
					<h5 class="modal-title" id="modalEditMenulabel">Edit Berita Website Koperasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('menu/edit_berita');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>">
					<div class="form-group row">
						<label for="name_berkas" class="col-sm-3 col-form-label">Judul Berita</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row->judul; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="name_berkas" class="col-sm-3 col-form-label">Ganti Foto</label>
						<div class="col-sm-9">
							<input type="file" name="berkas" id="berkas" class="btn-sm" value="<?php echo $row->berkas; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="name_berkas" class="col-sm-3 col-form-label">Tanggal</label>
						<div class="col-sm-4">
							<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $row->tanggal; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="name_berkas" class="col-sm-3 col-form-label">Author</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="author" name="author" value="<?php echo $row->author; ?>">
						</div>
						<label for="name_berkas" class="col-sm-1 col-form-label">Tag</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="tag" name="tag" value="<?php echo $row->tag; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="name_berkas" class="col-sm-3 col-form-label">Edit Artikel</label>
						<div class="col-sm-9">
							<textarea class="ckeditor" name="tulis_artikel" id="tulis_artikel"><?php echo $row->tulis_artikel; ?></textarea>
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


