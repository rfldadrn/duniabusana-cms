function importEmployees(){
    let fileInput = document.getElementById('importEmployee').files[0];
    if (!fileInput) {
        alert('Please select a file to import.');
        return;
    }
    let agencyId = document.getElementById('Id').value;
    let formData = new FormData();
    formData.append('file', fileInput);
    formData.append('agencyId', agencyId);

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
                loadEmployees(agencyId);
                showMessage('Employees imported successfully!', 'success');
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
    $('#importEmployee').val('');
}

function loadEmployees(agencyId){
    $.ajax({
        url: BASE_URL + '/api/fetchEmployees', // File yang berisi kode HTML tabel yang kamu kirim tadi
        data: { id: agencyId }, // Kirim ID agen sebagai parameter
        type: 'GET',
        success: function(html) { // Debug: Lihat HTML yang diterima
            $('.data-content').html(html); // Clear existing content
            // Re-inisialisasi
        $('#example1').DataTable({
            // Tambahkan setting DataTable kamu di sini jika ada
            "responsive": true
        });
        }
    });
}