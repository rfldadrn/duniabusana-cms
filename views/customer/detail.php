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
				<label class="col-sm-2 col-form-label required-label">Nama Pelanggan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_pelanggan" name="Nama_pelanggan" placeholder="Nama pelanggan" required value="<?= $customer['Name'] ?? '' ?>">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label required-label">Nomor Telp</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nomor_telp" name="Nomor_telp" placeholder="Nomor Telp" required value="<?= $customer['PhoneNumber'] ?? '' ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label required-label">Jenis Kelamin</label>
				<div class="col-sm-4">
					<select name="Gender" id="gender" class="form-control" required>
					<option value="">Pilih Jenis Kelamin</option>
					<option value="Laki-laki" <?php if (($customer['Gender'] ?? '') == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
					<option value="Perempuan" <?php if (($customer['Gender'] ?? '') == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
					</select>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Instansi</label>
				<div class="col-sm-4">
					<select name="Instansi" id="instansi" class="select2bs4 w-100 form-control">
					<option value="">Pilih Instansi</option>
					<?php 
						if($customer['AgencyId'] == null && $customer['Id'] != null) {
							echo "<option value='' selected>Pribadi</option>";
						}
						foreach($agencies as $item) {
							$selected = ($customer['AgencyId'] ?? '') == $item['Id'] ? 'selected' : '';
							echo "<option value=\"{$item['Id']}\" $selected>{$item['Name']}</option>";
						}
					?>
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
<div id="formView" class="view-container" <?php if (!isset($customer['Id'])) echo 'style="display:none;"'; ?>>
	<div class="row">
		<div class="">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<div class="col-md-6">
						<span><i class="bi bi-bag"></i> List Ukuran</span>
					</div>    
					<div class="col-md-6">
						<button class="btn btn-primary btn-sm float-end" onclick="addNewSize()">
							<i class="bi bi-plus-circle"></i> Add Size
						</button>
					</div>
				</div>
				<div class="card-body">
					<!-- Add Size Form (Initially Hidden) -->
					<div id="addSizeForm" class="border rounded p-3 mb-3" style="display: none;">
							<form action="<?= BASE_URL ?>/customer/addSize" method="post">
							<h6 class="mb-3" id="label-form-size">Add New Size</h6>
							<div class="row">
								<input type="hidden" name="HeaderSizeCustomerId" id="HeaderSizeCustomerId" value="">
								<input type="hidden" name="customerId" id="customerId" value="<?= $customer['Id'] ?? '' ?>">
								<div class="col-md-6 mb-3">
									<label class="form-label">Jenis Pakaian <span class="text-danger">*</span></label>
									<select class="form-select" id="itemId" name="itemId" required onchange="showSizeProperties()">
										<option value="">Pilih Jenis Pakaian</option>
										<?php 
											foreach($items as $item) {
												echo "<option value=\"{$item['Id']}\">{$item['Name']}</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div id="sizeProperties" class="row">
							</div>
							<div class="d-flex gap-2">
								<button class="btn btn-success" id="btn-save-form-size">
									<i class="bi bi-check-circle"></i> Tambah
								</button>
								<button class="btn btn-warning" id="btn-update-form-size" style="display:none;">
									<i class="bi bi-check-circle"></i> Update
								</button>
								<button type="button" class="btn btn-secondary" onclick="cancelAddSize()">
									<i class="bi bi-x-circle"></i> Batal
								</button>
							</div>
						</form>
					</div>
					<div id="sizesList" class="mt-3 overflow-auto" style="max-height: 400px;">

						<?php if (empty($sizeCustomer)) : ?>

							<div class="card shadow-sm border-0">
								<div class="card-body text-center py-5 text-muted">
									<i class="bi bi-inbox display-4"></i>
									<p class="mt-3 mb-0">No items added yet</p>
								</div>
							</div>

						<?php else : ?>
							<?php foreach ($sizeCustomer as $row) : ?>
								<div class="card shadow-sm border-0 mb-4">
									<div class="card-body">

										<!-- Header -->
										<div class="d-flex justify-content-between align-items-center mb-3">
											<h6 class="fw-semibold mb-0">
												<?= $row['itemName'] . ' - ' . $row['note'] ?>
											</h6>

											<div class="d-flex gap-2">
												<button 
													class="btn btn-sm btn-light border" 
													onclick="editSize(<?= $row['id'] ?>, <?= $customer['Id'] ?>, <?= $row['itemId'] ?>)"
													title="Edit">
													<i class="bi bi-pencil text-primary"></i>
												</button>

												<button 
													class="btn btn-sm btn-light border" 
													onclick="deleteSize('<?= BASE_URL ?>/customer/deleteSize/<?= $row['id'] ?>/<?= $customer['Id'] ?>', '<?= $row['note'] ?>')"
													title="Delete">
													<i class="bi bi-trash text-danger"></i>
												</button>
											</div>
										</div>

										<!-- Size Grid -->
										<div class="row g-3">
											<?php foreach ($row['details'] as $detail) : ?>
												<div class="col-6 col-md-4 col-lg-2">
													<div class="border rounded-3 p-3 h-100 bg-light-subtle">
														<small class="text-muted d-block">
															<?= $detail['sizeName'] ?>
														</small>
														<span class="fw-semibold">
															<?= rtrim(rtrim(number_format($detail['size'], 2, '.', ''), '0'), '.') ?> cm
														</span>
													</div>
												</div>
											<?php endforeach; ?>
										</div>

									</div>
								</div>

							<?php endforeach; ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
