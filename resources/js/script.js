import Swal from "sweetalert2";

document.querySelectorAll('.delete-book-button').forEach(function(button) {
    button.addEventListener('click', function() {
        const form = this.closest('form');
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini tidak dapat dikembalikan setelah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

function removeAlertAfterTimeout(alertId, timeout) {
    const alertElement = document.getElementById(alertId);
    if (!alertElement) return;

    setTimeout(() => {
        fadeOut(alertElement);
    }, timeout);
}

function fadeOut(element) {
    element.style.transition = "opacity 1s ease, transform 1s ease";
    element.style.opacity = "0";
    element.style.transform = "translateY(-20px)";

    setTimeout(() => {
        element.remove();
    }, 1000);
}

// Panggil fungsi untuk menghilangkan alert setelah 2,5 detik
removeAlertAfterTimeout('success-alert', 2500);
