<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item" aria-current="page"><a href="<?= BASE_URL ?>/users">Data Users</a></li>
		<li class="breadcrumb-item active" aria-current="page">Form Data User</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-user"></i> Form Data User
		</h3>
	</div>
	<form action="<?= BASE_URL ?><?php if (isset($user['Id'])) { echo '/user/update'; } else { echo '/user/store'; } ?>" method="post">
		<div class="card-body">
			<input type="text" class="form-control" id="Id" name="Id" value="<?= $user['Id'] ?? '' ?>" hidden>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama User</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_pengguna" name="Nama_pengguna" placeholder="Nama user" required value="<?= $user['Nama_pengguna'] ?>">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="username" name="Username" placeholder="Username" required value="<?= $user['Username'] ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Role User</label>
				<div class="col-sm-4">
					<select name="RolesId" id="level" class="form-control" required>
					<option value="">Pilih Role</option>
					<?php 
						foreach ($roles as $role) {
					?>
						<option value="<?php echo $role['Id']; ?>" <?php if ($user['RolesId'] == $role['Id']) echo 'selected'; ?>><?php echo $role['RoleName']; ?></option>
					<?php
						}
					?>
					</select>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<a href="<?= BASE_URL ?>/users" title="Kembali" class="btn btn-secondary float-right">Batal</a>
			<?php 
				if (!isset($user['Id'])) {
			?>	
					<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary float-right mr-2">
			<?php
				} else {
			?>
					<input type="submit" name="Update" value="Update" class="btn btn-warning float-right mr-2">
			<?php
				}
			?>
		</div>
	</form>
</div>