<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">User Profile</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-user-cog"></i> Ubah Data User
		</h3>
	</div>
	<form action="<?= BASE_URL ?>/user/profile/update" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data_cek['Id']; ?>" readonly />
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pengguna</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="Nama_pengguna" name="Nama_pengguna" value="<?php echo $data_cek['Nama_pengguna']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="Username" name="Username" value="<?php echo $data_cek['Username']; ?>" readonly />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="Password" name="Password" />
					<label for="" class="text-danger" style="font-size: 13px;"><i>*Kosongkan jika tidak ada perubahan</i></label>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<a href="<?= BASE_URL ?>/dashboard" title="Kembali" class="btn btn-secondary float-right">Batal</a>
			<input type="submit" name="Update" value="Update" class="btn btn-warning float-right mr-2">
		</div>
	</form>
</div>
