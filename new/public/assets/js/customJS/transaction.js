        // Sample data
        let items = [];
        let itemCounter = 0;
        let customerSizes = [];
        // Initialize date
        let transactionDate = document.getElementById('transactionDate');
        if(transactionDate) {
            transactionDate.valueAsDate = new Date();
        }

        function showView(view) {
            document.getElementById('formView').style.display = 'none';
            document.getElementById('detailViewContainer').style.display = 'none';

            if (view === 'create' || view === 'edit') {
                document.getElementById('formView').style.display = 'block';
                if (view === 'create') {
                    resetForm();
                }
            } else if (view === 'detail') {
                document.getElementById('detailViewContainer').style.display = 'block';
            }
        }

        function addNewItem() {
            document.getElementById('addItemForm').style.display = 'block';
            document.getElementById('customerPrice').removeAttribute('disabled');
            // let elementSizeCustomerId = document.getElementById('itemSizeCustomerId');
            // elementSizeCustomerId.innerHTML = '<option value="">Pilih Ukuran</option>';
            // customerSizes.forEach(size => {
            //     const option = document.createElement('option');
            //     option.value = size.Id;
            //     option.textContent = size.ItemName + ' - ' + size.Note;
            //     elementSizeCustomerId.appendChild(option);
            // });
        }

        function cancelAddItem() {
            document.getElementById('addItemForm').style.display = 'none';
            clearItemForm();
        }

        function clearItemForm() {
            document.getElementById('itemId').value = '';
            document.getElementById('itemSizeCustomerId').value = '';
            document.getElementById('customerPrice').value = '';
            document.getElementById('statusTransactionId').value = '1';
            document.getElementById('itemNote').value = '';
        }

        function saveItem() {
            const itemId = document.getElementById('itemId').value;
            const itemText = document.getElementById('itemId').selectedOptions[0].text;
            const size = document.getElementById('itemSizeCustomerId').selectedOptions[0].text;
            const price = document.getElementById('customerPrice').value;
            const status = document.getElementById('statusTransactionId').selectedOptions[0].text;
            const note = document.getElementById('itemNote').value;

            if (!itemId || !price) {
                alert('Please fill in required fields (Item and Price)');
                return;
            }

            const item = {
                id: ++itemCounter,
                itemId: itemId,
                itemName: itemText,
                size: size,
                price: parseFloat(price),
                status: status,
                note: note
            };

            items.push(item);
            renderItems();
            cancelAddItem();
            updateSummary();
        }

        function renderItems() {
            const itemsList = document.getElementById('itemsList');
            if (items.length === 0) {
                itemsList.innerHTML = '<div class="text-center text-muted py-4"><i class="bi bi-inbox" style="font-size: 3rem;"></i><p class="mt-2">No items added yet</p></div>';
                return;
            }

            itemsList.innerHTML = items.map(item => `
                <div class="item-row">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <strong>${item.itemName}</strong>
                            <br><small class="text-muted">Size: ${item.size}</small>
                        </div>
                        <div class="col-md-2">
                            <span class="badge bg-${getStatusColor(item.status)}">${item.status}</span>
                        </div>
                        <div class="col-md-3">
                            <strong class="text-primary">Rp ${formatNumber(item.price)}</strong>
                        </div>
                        <div class="col-md-2">
                            <small class="text-muted">${item.note || '-'}</small>
                        </div>
                        <div class="col-md-2 text-end">
                            <button class="btn btn-sm btn-outline-primary btn-action" onclick="editItem(${item.id})" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger btn-action" onclick="deleteItem(${item.id})" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function deleteItem(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                items = items.filter(item => item.id !== id);
                renderItems();
                updateSummary();
            }
        }

        function editItem(id) {
            alert('Edit functionality would open a modal or form with item details');
        }

        function updateSummary() {
            const totalAmount = items.reduce((sum, item) => sum + item.price, 0);
            const paidAmount = parseFloat(document.getElementById('paidAmount').value) || 0;
            const balanceDue = totalAmount - paidAmount;

            document.getElementById('totalItems').textContent = items.length;
            document.getElementById('summaryAmount').textContent = 'Rp ' + formatNumber(totalAmount);
            document.getElementById('summaryPaid').textContent = 'Rp ' + formatNumber(paidAmount);
            document.getElementById('summaryBalance').textContent = 'Rp ' + formatNumber(balanceDue);
        }

        function calculateBalance() {
            updateSummary();
        }

        function saveTransaction() {
            const customerId = document.getElementById('customerId').value;
            const transactionDate = document.getElementById('transactionDate').value;

            if (!customerId || !transactionDate) {
                alert('Please fill in required fields (Customer and Transaction Date)');
                return;
            }

            if (items.length === 0) {
                alert('Please add at least one item to the transaction');
                return;
            }

            alert('Transaction saved successfully!\n\nThis would typically send data to your backend API.');
            console.log('Transaction data:', {
                customerId: customerId,
                transactionDate: transactionDate,
                items: items,
                paidAmount: document.getElementById('paidAmount').value
            });
        }

        function resetForm() {
            document.getElementById('transactionForm').reset();
            document.getElementById('transactionDate').valueAsDate = new Date();
            document.getElementById('paidAmount').value = '';
            items = [];
            itemCounter = 0;
            renderItems();
            updateSummary();
        }
        
        function getSizeCustomer(customerId, headerSizeId = 0, itemId = 0) {
            if (!customerId) {
                document.getElementById('itemSizeCustomerId').innerHTML = '<option value="">Select Size</option>';
                return;
            }
            fetch(`${BASE_URL}/api/get-customerSizeByCustomerId/${customerId}/${headerSizeId}/${itemId}`)
                .then(response => response.json())
                .then(result => {
                    if (result.data[0] && result.data[0].length > 0) {
                        customerSizes = Object.values(groupByHeader(result.data[0]));
                        let elementSizeCustomerId = document.getElementById('itemSizeCustomerId');
                        elementSizeCustomerId.innerHTML = '<option value="">Pilih Ukuran</option>';
                        customerSizes.forEach(size => {
                            const option = document.createElement('option');
                            option.value = size.Id;
                            option.textContent = size.ItemName + ' - ' + size.Note;
                            // option.setAttribute('data-note', size.Note);
                            // option.setAttribute('data-item', size.ItemName);
                            // option.setAttribute('data-detail', size.Sizes.map(s => `${s.SizeName} (${s.Size})${s.isMandatory ? ' *' : ''}`).join(', '));

                            elementSizeCustomerId.appendChild(option);
                        });
                    }else{
                        console.log('No size data found for customerId:', customerId);
                        let elementSizeCustomerId = document.getElementById('itemSizeCustomerId');
                        elementSizeCustomerId.innerHTML = '<option value="">Pilih Ukuran</option>';
                        customerSizes = [];
                    }
                });
        }

        function groupByHeader(data) {
            return data.reduce((acc, item) => {
                const headerId = item.HeaderSizeCustomerId;
                if (!acc[headerId]) {
                    acc[headerId] = {
                        HeaderSizeCustomerId: headerId,
                        Note: item.Note,
                        ItemId: item.ItemId,
                        ItemName: item.ItemName,
                        Sizes: []
                    };
                }

                acc[headerId].Sizes.push({
                    ItemSizeId: item.ItemSizeId,
                    SizeName: item.SizeName,
                    Size: item.Size,
                    isMandatory: item.isMandatory
                });

                return acc;
            }, {});
        }
        // Initial render
        renderItems();
        updateSummary();


       