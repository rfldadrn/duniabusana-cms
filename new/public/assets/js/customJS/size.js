//JS for Size

let sizeCounter = 0;
function addNewSize() {
    document.getElementById('addSizeForm').style.display = 'block';
    document.getElementById('itemId').value = ''; // Reset item select
    document.getElementById('HeaderSizeCustomerId').value = ''; // Reset HeaderSizeCustomerId
    document.getElementById('btn-save-form-size').style.display = 'inline-block';
    document.getElementById('btn-update-form-size').style.display = 'none';
    clearSizeForm();
}
function editSize(HeaderSizeCustomerId, CustomerId, ItemId) 
{
    // AJAX request to get size details 
    $.ajax({
        url: `${BASE_URL}/api/get-size-details`,
        type: 'GET',
        data: { headerSizeCustomerId: HeaderSizeCustomerId, customerId : CustomerId, itemId: ItemId },
        dataType: 'json',
        beforeSend: function() {
            // Optional: Show loading indicator
            $('#sizeProperties').html('<div class="col-12 text-center m-5"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
        },
        success: function(response) {
            if (response.success && response.data && response.data.length > 0) {
                const sizeData = response.data;
                addNewSize(); // Show the form
                document.getElementById('itemId').value = sizeData[0].ItemId.toString(); // Set the itemId in the select
                document.getElementById('HeaderSizeCustomerId').value = sizeData[0].HeaderSizeCustomerId.toString(); // Set the HeaderSizeCustomerId
                document.getElementById('label-form-size').textContent = 'Edit Size'; // Change form title to Edit
                showSizePropertiesById(sizeData); // Load properties and fill in the values
                document.getElementById('addSizeForm').style.display = 'block';
                document.getElementById('btn-save-form-size').style.display = 'none';
                document.getElementById('btn-update-form-size').style.display = 'inline-block';
            } else {
                $('#sizeProperties').html('<div class="col-12 text-muted">No properties found</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching size details:', error, BASE_URL);
            $('#sizeProperties').html('<div class="col-12 text-danger">Failed to load size details</div>');
        }
    });
}
function cancelAddSize() {
    document.getElementById('addSizeForm').style.display = 'none';
    document.getElementById('itemId').value = ''; // Reset item select
    document.getElementById('HeaderSizeCustomerId').value = ''; // Reset HeaderSizeCustomerId
    clearSizeForm();
}
function clearSizeForm() {
    document.getElementById('sizeProperties').innerHTML = '';
}
function showSizePropertiesById(data){
    if (!data) {
        return;
    }
    const sizePropertiesDiv = document.getElementById('sizeProperties');
    sizePropertiesDiv.innerHTML = ''; // Clear existing content
    data.forEach(function(prop) {
        // Create column div
        const colDiv = document.createElement('div');
        colDiv.className = 'col-md-3 mb-3';
        
        // Create label
        const label = document.createElement('label');
        // label.className = (prop.IsMandatory == "1" ? 'form-label required-label' : 'form-label');
        label.className = 'form-label required-label';
        label.textContent = prop.sizeName || prop.SizeName || 'Property';
        
        // Create input
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.id = 'prop_' + (prop.ItemSizeId || prop.itemsizeid);
        input.name = 'prop_' + (prop.ItemSizeId || prop.itemsizeid);
        prop.IsMandatory ? input.setAttribute('required', 'required') : '';
        input.placeholder = 'Enter ' + (prop.sizeName || prop.SizeName);
        const sizeValue = prop.size || prop.Size || '';
        input.value = sizeValue ? parseFloat(sizeValue) : '';
        
        // Append label and input to column
        colDiv.appendChild(label);
        colDiv.appendChild(input);
        
        // Append column to sizeProperties div
        sizePropertiesDiv.appendChild(colDiv);
    });
    const noteDiv = document.createElement('div');
    noteDiv.className = 'col-12 mb-3';

    const noteLabel = document.createElement('label');
    noteLabel.className = 'form-label fw-semibold';
    noteLabel.textContent = 'Note';

    const noteTextarea = document.createElement('textarea');
    noteTextarea.className = 'form-control';
    noteTextarea.name = 'note';
    noteTextarea.rows = 3;
    noteTextarea.placeholder = 'Tambahkan catatan...';
    noteTextarea.value = data[0].note || data[0].Note || '';

    noteDiv.appendChild(noteLabel);
    noteDiv.appendChild(noteTextarea);

    sizePropertiesDiv.appendChild(noteDiv);
}
function showSizeProperties(){
    const itemSelect = document.getElementById('itemId');
    const selectedOption = itemSelect.selectedOptions[0];
    const itemId = selectedOption.value;
    
    if (!itemId) {
        return;
    }

    // AJAX request to get size properties
    $.ajax({
        url: `${BASE_URL}/api/get-size-properties`,
        type: 'GET',
        data: { itemId: itemId },
        dataType: 'json',
        beforeSend: function() {
            // Optional: Show loading indicator
            $('#sizeProperties').html('<div class="col-12 text-center m-5"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
        },
        success: function(response) {
            if (response.success && response.data) {
                const sizePropertiesDiv = document.getElementById('sizeProperties');
                sizePropertiesDiv.innerHTML = ''; // Clear existing content
                
                // Loop through each property and create input elements
                response.data.forEach(function(prop) {
                    // Create column div
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-md-3 mb-3';
                    
                    // Create label
                    const label = document.createElement('label');
                    // label.className = (prop.IsMandatory == "1" ? 'form-label required-label' : 'form-label');
                    label.className = 'form-label required-label';
                    label.textContent = prop.name || prop.Name || 'Property';
                    
                    // Create input
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.className = 'form-control';
                    input.id = 'prop_' + (prop.id || prop.Id);
                    input.name = 'prop_' + (prop.id || prop.Id);
                    prop.IsMandatory ? input.setAttribute('required', 'required') : '';
                    input.placeholder = 'Enter ' + (prop.name || prop.Name);
                    
                    // Append label and input to column
                    colDiv.appendChild(label);
                    colDiv.appendChild(input);
                    
                    // Append column to sizeProperties div
                    sizePropertiesDiv.appendChild(colDiv);
                });
                const noteDiv = document.createElement('div');
                noteDiv.className = 'col-12 mb-3';

                const noteLabel = document.createElement('label');
                noteLabel.className = 'form-label fw-semibold';
                noteLabel.textContent = 'Note';

                const noteTextarea = document.createElement('textarea');
                noteTextarea.className = 'form-control';
                noteTextarea.name = 'note';
                noteTextarea.rows = 3;
                noteTextarea.placeholder = 'Tambahkan catatan...';

                noteDiv.appendChild(noteLabel);
                noteDiv.appendChild(noteTextarea);

                sizePropertiesDiv.appendChild(noteDiv);
            } else {
                $('#sizeProperties').html('<div class="col-12 text-muted">No properties found</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching size properties:', error, BASE_URL);
            $('#sizeProperties').html('<div class="col-12 text-danger">Failed to load size properties</div>');
        }
    });
}
function deleteSize(url, note) {
    confirmDelete(url, note);
}
