<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?= BASE_URL ?>/transactions">Data Transaksi</a></li>
		<li class="breadcrumb-item active" aria-current="page">Form Transaksi</li>
	</ol>
</nav>

    <div class="mt-3">
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
                                        <input type="date" class="form-control" id="transactionDate" max="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                                        <select class="form-select" id="agencyId" onchange="getCustomersByAgency(this.value)" required>
                                            <option value="">Transaksi Pribadi</option>
                                            <?php 
                                                foreach($agencies as $agency) {
                                                    echo "<option value=\"{$agency['Id']}\">{$agency['Name']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                                        <select class="select2bs4 form-control w-100" id="customerId" onchange="getSizeCustomer(this.value)" required>
                                            <option value="">Pilih Pelanggan</option>
                                            <?php 
                                                foreach($customers as $customer) {
                                                    echo "<option value=\"{$customer['Id']}\">{$customer['Name']} - {$customer['PhoneNumber']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Pengambilan <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="completionDate" min="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Catatan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="note-richtext" rows="3" placeholder="Catatan tambahan..." required></textarea>
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
                            <!-- Add Item Form (Initially Hidden) -->
                            <div id="addItemForm" class="border rounded p-3 mb-3" style="display: none;">
                                <h6 class="mb-3">Add New Item</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Pakaian <span class="text-danger">*</span></label>
                                        <select class="select2bs4 form-select" id="itemId" required onchange="getAndSetPrice('itemId', 'price', 'customerPrice')">
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
                                        <select class="select2bs4 form-control w-100" id="itemSizeCustomerId">
                                            <option value="">Pilih Ukuran</option>
                                            
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
                            <div id="itemsList">
                                <!-- Items will be added here -->
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
                                            <option value="">Select Payment Type</option>
                                            <?php 
                                                foreach($paymentMethods as $payment) {
                                                    echo "<option value=\"{$payment['Id']}\">{$payment['Name']}</option>";
                                                }
                                            ?>
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
    </div>