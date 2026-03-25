<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?= BASE_URL ?>/transactions">Data Transaksi</a></li>
		<li class="breadcrumb-item active" aria-current="page">Form Transaksi</li>
	</ol>
</nav>

    <div class="mt-4">
        <!-- View Mode Selector -->
        <div class="mb-3">
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="viewMode" id="createView" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="createView" onclick="showView('create')">
                    <i class="bi bi-plus-circle"></i> Create
                </label>

                <input type="radio" class="btn-check" name="viewMode" id="editView" autocomplete="off">
                <label class="btn btn-outline-primary" for="editView" onclick="showView('edit')">
                    <i class="bi bi-pencil-square"></i> Edit
                </label>

                <input type="radio" class="btn-check" name="viewMode" id="detailView" autocomplete="off">
                <label class="btn btn-outline-primary" for="detailView" onclick="showView('detail')">
                    <i class="bi bi-eye"></i> Detail
                </label>
            </div>
        </div>

        <!-- CREATE/EDIT VIEW -->
        <div id="formView" class="view-container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Transaction Information -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-receipt"></i> Transaction Information
                        </div>
                        <div class="card-body">
                            <form id="transactionForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">ID Transaksi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="transactionId" value="<?= $transactionCode ?>" readonly required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Transaksi <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="transactionDate" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                                        <select class="form-select" id="customerId" required>
                                            <option value="">Pilih Pelanggan</option>
                                            <?php 
                                                foreach($customers as $customer) {
                                                    echo "<option value=\"{$customer['Id']}\">{$customer['Name']} - {$customer['PhoneNumber']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                                        <select class="form-select" id="agencyId">
                                            <option value="">Transaksi Pribadi</option>
                                            <?php 
                                                foreach($agencies as $agency) {
                                                    echo "<option value=\"{$agency['Id']}\">{$agency['Name']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Pengambilan <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="completionDate">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control" id="transactionNote" rows="3" placeholder="Catatan tambahan..."></textarea>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Transaction Items -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="col-md-6">
                                <span><i class="bi bi-bag"></i> Order Items</span>
                            </div>    
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-sm float-end" onclick="addNewItem()">
                                    <i class="bi bi-plus-circle"></i> Add Item
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="itemsList">
                                <!-- Items will be added here -->
                            </div>

                            <!-- Add Item Form (Initially Hidden) -->
                            <div id="addItemForm" class="border rounded p-3 mb-3" style="display: none;">
                                <h6 class="mb-3">Add New Item</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Pakaian <span class="text-danger">*</span></label>
                                        <select class="form-select" id="itemId" required onchange="getAndSetPrice('itemId', 'price', 'customerPrice')">
                                            <option value="">Pilih Jenis Pakaian</option>
                                            <?php 
                                                foreach($items as $item) {
                                                    echo "<option value=\"{$item['Id']}\" price=\"{$item['CustomerPrice']}\">{$item['Name']} - Rp." . number_format($item['CustomerPrice'], 0, ',', '.') . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Customer Size</label>
                                        <select class="form-select" id="itemSizeCustomerId">
                                            <option value="">Select Size</option>
                                            <option value="1">S</option>
                                            <option value="2">M</option>
                                            <option value="3">L</option>
                                            <option value="4">XL</option>
                                            <option value="5">XXL</option>
                                            <option value="6">Custom</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Price (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="customerPrice" placeholder="0" disabled required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" id="statusTransactionId">
                                            <option value="1">Pending</option>
                                            <option value="2">In Progress</option>
                                            <option value="3">Completed</option>
                                            <option value="4">Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Item Note</label>
                                    <textarea class="form-control" id="itemNote" rows="2" placeholder="Special instructions, measurements, fabric details..."></textarea>
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-success" onclick="saveItem()">
                                        <i class="bi bi-check-circle"></i> Tambah Item
                                    </button>
                                    <button class="btn btn-secondary" onclick="cancelAddItem()">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Summary -->
                    <div class="card summary-card">
                        <div class="card-header">
                            <i class="bi bi-bag"></i> Transaction Summary
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Items:</span>
                                <strong id="totalItems">0</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Amount:</span>
                                <strong id="summaryAmount">Rp 0</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Paid Amount:</span>
                                <strong id="summaryPaid">Rp 0</strong>
                            </div>
                            <hr class="bg-white">
                            <div class="d-flex justify-content-between">
                                <h6>Balance Due:</h6>
                                <h5 id="summaryBalance">Rp 0</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-cash-coin"></i> Payment Details
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                        <label class="form-label">Payment Type</label>
                                        <select class="form-select" id="paymentTypeId">
                                            <option value="1">Cash</option>
                                            <option value="2">Bank Transfer</option>
                                            <option value="3">Credit Card</option>
                                        </select>
                                    </div>
                            <div class="mb-3">
                                <label class="form-label">Paid Amount (Rp)</label>
                                <input type="number" class="form-control" id="paidAmount" placeholder="0" onchange="calculateBalance()">
                            </div>
                            <div class="alert alert-info mb-0">
                                <small><i class="bi bi-info-circle"></i> Balance will be calculated automatically</small>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary w-100 mb-2" onclick="saveTransaction()">
                                <i class="bi bi-save"></i> Save Transaction
                            </button>
                            <button class="btn btn-outline-secondary w-100" onclick="resetForm()">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DETAIL VIEW -->
        <div id="detailViewContainer" class="view-container" style="display: none;">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Transaction Details -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-receipt"></i> Transaction Details</span>
                            <div>
                                <button class="btn btn-sm btn-primary" onclick="showView('edit')">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="text-muted small">Transaction ID</label>
                                    <p class="mb-0 fw-bold">TRX-2024-001</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Transaction Date</label>
                                    <p class="mb-0">February 16, 2024</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="text-muted small">Customer</label>
                                    <p class="mb-0">John Doe</p>
                                    <small class="text-muted">081234567890</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Agency</label>
                                    <p class="mb-0">Direct Customer</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="text-muted small">Completion Date</label>
                                    <p class="mb-0">February 25, 2024</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Payment Type</label>
                                    <p class="mb-0">Cash</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="text-muted small">Note</label>
                                    <p class="mb-0">Customer requested rush order for wedding event.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="text-muted small">Created By</label>
                                    <p class="mb-0">Admin User</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="text-muted small">Status</label>
                                    <p class="mb-0"><span class="badge bg-success badge-status">Active</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items Detail -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-bag"></i> Order Items
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Item</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Shirt (Kemeja)</td>
                                            <td>M</td>
                                            <td>Rp 250,000</td>
                                            <td><span class="badge bg-warning">In Progress</span></td>
                                            <td>White cotton, slim fit</td>
                                        </tr>
                                        <tr>
                                            <td>Pants (Celana)</td>
                                            <td>L</td>
                                            <td>Rp 300,000</td>
                                            <td><span class="badge bg-info">Pending</span></td>
                                            <td>Black formal, regular fit</td>
                                        </tr>
                                        <tr>
                                            <td>Suit (Jas)</td>
                                            <td>Custom</td>
                                            <td>Rp 1,500,000</td>
                                            <td><span class="badge bg-warning">In Progress</span></td>
                                            <td>Navy blue, 3-piece suit</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Payment Summary -->
                    <div class="card summary-card">
						<div class="card-header">
                            <i class="bi bi-bag"></i> Payment Summary
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Items:</span>
                                <strong>3 items</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Amount:</span>
                                <strong>Rp 2,050,000</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Paid Amount:</span>
                                <strong>Rp 1,000,000</strong>
                            </div>
                            <hr class="bg-white">
                            <div class="d-flex justify-content-between">
                                <h6>Balance Due:</h6>
                                <h5>Rp 1,050,000</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-clock-history"></i> Activity Timeline
                        </div>
                        <div class="card-body">
                            <div class="timeline" style="max-height: 300px; overflow-y: auto;">
                                <div class="mb-3">
                                    <small class="text-muted">Feb 16, 2026 10:30 AM</small>
                                    <p class="mb-0"><i class="bi bi-plus-circle text-success"></i> Transaction created</p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Feb 16, 2026 10:35 AM</small>
                                    <p class="mb-0"><i class="bi bi-cash text-primary"></i> Payment received: Rp 1,000,000</p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Feb 18, 2026 09:00 AM</small>
                                    <p class="mb-0"><i class="bi bi-gear text-warning"></i> Items in progress</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-success w-100 mb-2">
                                <i class="bi bi-cash"></i> Add Payment
                            </button>
                            <button class="btn btn-info w-100 mb-2 text-white">
                                <i class="bi bi-printer"></i> Print Invoice
                            </button>
                            <button class="btn btn-warning w-100 text-white">
                                <i class="bi bi-whatsapp"></i> Send to Customer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>