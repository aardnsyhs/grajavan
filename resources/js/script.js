import Swal from "sweetalert2";

const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
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

removeAlertAfterTimeout('success-alert', 2500);

document.getElementById('search').addEventListener('input', function(e) {
    const query = e.target.value.trim().toLowerCase();

    const rows = document.querySelectorAll('#book-list tr');
    let hasResults = false;

    rows.forEach(function(row) {
        const [title, category, author, description, year, rating] = [
            row.querySelector('td:nth-child(2)').textContent.toLowerCase(),
            row.querySelector('td:nth-child(3)').textContent.toLowerCase(),
            row.querySelector('td:nth-child(4)').textContent.toLowerCase(),
            row.querySelector('td:nth-child(5)').textContent.toLowerCase(),
            row.querySelector('td:nth-child(6)').textContent.toLowerCase(),
            row.querySelector('td:nth-child(7)').textContent.toLowerCase()
        ];

        const isVisible = title.includes(query) || category.includes(query) || 
                          author.includes(query) || description.includes(query) || 
                          year.includes(query) || rating.includes(query);
        
        row.style.display = isVisible ? '' : 'none';
        hasResults = hasResults || isVisible;
    });

    toggleSearchResults(hasResults);
});

document.getElementById('search').addEventListener('input', function(e) {
    const query = e.target.value.trim().toLowerCase();

    const rows = document.querySelectorAll('#category-list tr');
    let hasResults = false;

    rows.forEach(function(row) {
        const category = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Nama kategori

        const isVisible = category.includes(query);
        row.style.display = isVisible ? '' : 'none';
        hasResults = hasResults || isVisible;
    });

    toggleSearchResults(hasResults);
});

function toggleSearchResults(found) {
    const noResultsText = document.getElementById('no-results');
    const tableWrapper = document.getElementById('table-wrapper');
    const pagination = document.getElementById('pagination');
    const tableHead = document.getElementById('table-head');

    if (found) {
        noResultsText.classList.add('hidden');
        tableWrapper.classList.remove('hidden');
        pagination.classList.remove('hidden');
        tableHead.classList.remove('hidden');
    } else {
        noResultsText.classList.remove('hidden');
        tableWrapper.classList.add('hidden');
        pagination.classList.add('hidden');
        tableHead.classList.add('hidden');
    }
}
