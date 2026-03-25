$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,	
        "autoWidth": false,
    });
});

$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});

document.addEventListener('DOMContentLoaded', function() {
    var notif = document.querySelectorAll('.toast-notif');
    notif.forEach(function(el) {
        setTimeout(function() {
            el.style.opacity = '0';
            setTimeout(function() {
                el.style.display = 'none';
            }, 500);
        }, 3500);
    });
});

function getStatusColor(status) {
    const colors = {
        'Pending': 'info',
        'In Progress': 'warning',
        'Completed': 'success',
        'Cancelled': 'danger'
    };
    return colors[status] || 'secondary';
}

function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function getAndSetPrice(reffId, reffAttr, reffTarget) {
    const val = document.getElementById(reffId).selectedOptions[0].getAttribute(reffAttr);
    document.getElementById(reffTarget).value = val;
}

function confirmDelete(url, title = 'Data') {
	event.preventDefault();
    Swal.fire({
        title: 'Hapus Data?',
        text: `Apakah Anda yakin ingin menghapus ${title} ini?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times"></i> Batal',
        reverseButtons: true,
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Redirect to delete URL
            window.location.href = url;
        }
    });
    
    return false;
}