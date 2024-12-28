// Function to set data for editing
function searchUser() {
    const keywordInput = document.getElementById('keywordInput');
    if (keywordInput.value.trim() === '') {
        window.location.href = 'manajemen_user';
    }
}

function setEditData(user) {
    document.querySelector('#editModal input[name="id_user"]').value = user.id_user;
    document.querySelector('#editModal input[name="nama_user"]').value = user.nama_user;
    document.querySelector('#editModal select[name="level"]').value = user.level;
    document.querySelector('#editModal input[name="username"]').value = user.username;
    document.querySelector('#editModal input[name="password"]').value = user.password;
}

// Event listener to confirm deletion
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
});

// Event listener to handle form submission for edit
document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan diperbarui.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Perbarui!'
            }).then((result) => {
                if (result.isConfirmed) {
                    editForm.submit();
                }
            });
        });
    }
});
