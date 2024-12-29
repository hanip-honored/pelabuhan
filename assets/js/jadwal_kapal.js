document.querySelectorAll('.hapusButton').forEach(button => {
  button.addEventListener('click', function (e) {
      e.preventDefault(); // Mencegah default action
      const href = this.getAttribute('data-href');
      Swal.fire({
          title: 'Yakin ingin menghapus data ini?',
          text: "Data yang dihapus tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = href;
          }
      });
  });
});