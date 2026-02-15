<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item" aria-current="page"><a href="<?= BASE_URL ?>/customers">Data Pelanggan</a></li>
		<li class="breadcrumb-item active" aria-current="page">Form Data Pelanggan</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-user"></i> Form Data Pelanggan
		</h3>
	</div>
	<form action="<?= BASE_URL ?><?php if (isset($customer['Id'])) { echo '/customer/update'; } else { echo '/customer/store'; } ?>" method="post">
		<div class="card-body">
			<input type="text" class="form-control" id="Id" name="Id" value="<?= $customer['Id'] ?? '' ?>" hidden>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pelanggan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_pelanggan" name="Nama_pelanggan" placeholder="Nama pelanggan" required value="<?= $customer['Name'] ?? '' ?>">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nomor Telp</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nomor_telp" name="Nomor_telp" placeholder="Nomor Telp" required value="<?= $customer['PhoneNumber'] ?? '' ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-4">
					<select name="Gender" id="gender" class="form-control" required>
					<option value="">Pilih Jenis Kelamin</option>
					<option value="Laki-laki" <?php if (($customer['Gender'] ?? '') == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
					<option value="Perempuan" <?php if (($customer['Gender'] ?? '') == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
					</select>
				</div>
			</div>
			
		</div>
		<div class="card-footer">
			<a href="<?= BASE_URL ?>/customers" title="Kembali" class="btn btn-secondary float-right">Batal</a>
			<?php 
				if (!isset($customer['Id'])) {
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