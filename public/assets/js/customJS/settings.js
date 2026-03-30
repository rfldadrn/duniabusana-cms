function ImportData(inputId, target) {
    const fileInput = document.getElementById(inputId);
    const file = fileInput.files[0];
    if (!file) {
        showMessage('Pilih file terlebih dahulu', 'warning');
        return;
    }
    if (target == null || target == '') {
        showMessage('Target tidak valid', 'error');
        return;
    }
    if (!['customers'].includes(target)) {
        showMessage('Feature under construction', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('file', file);
    formData.append('agencyId', '');

    Swal.fire({
        title: 'Sedang Mengimpor...',
        text: 'Mohon tunggu sebentar, data sedang diproses.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: BASE_URL + '/api/importEmployee',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showMessage('Data imported successfully!', 'success');
            }else{
                // console.error("Message : ", response.message);
                // console.error("Error : ", response.errors);
                showMessage(response.errors == null ? response.message : response.errors, 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error("XHR Response:", xhr.responseText); 
        },
        complete: function() {
            // Swal.close();
        }
    });
    $('#' + inputId).val('');
}