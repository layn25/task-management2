
<script>
    
    $(document).ready(function() {
        const success = $(".berhasil").data("berhasil");
        if (success) {
            swal.fire({
                title: "Berhasil!",
                text: success,
                icon: "success",
            });
        }
    });


    $(document).ready(function() {
        const warning = $(".warning").data("warning");
        if (warning) {
            swal.fire({
                title: "Peringatan!",
                text: warning,
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Tutup",
                        value: true,
                        visible: true,
                        className: "btn btn-success",
                        closeModal: true
                    }
                },
            });
        }
    });

    $(document).ready(function() {
        const gagal = $(".gagal").data("gagal");
        if (gagal) {
            swal.fire({
                title: "Gagal!",
                text: gagal,
                icon: "error",
            });
        }
    });

    const alertGagal = (gagal) => {
        swal.fire({
            title: "Gagal!",
            text: gagal,
            icon: "error",
        });
    }

    const alertSuccess = (success) => {
        swal.fire({
            title: "Berhasil!",
            text: success,
            icon: "success",
        });
    }

    const alertConfirm = (button) => {
        const id = $(button).data('id');
        swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data akan terhapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus Data",
                cancelButtonText: "Batal",
            }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-' + id).submit();
                } else {
                    swal.fire("Data Aman", "Data Yang Dipilih Batal Dihapus", "success");
                }
            });
    }

    const confirmTerima = (button) => {
        const id = $(button).data('id');
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Izin ini akan DITERIMA!",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Terima",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $('#terima-' + id).submit();
            } else {
                Swal.fire("Dibatalkan", "Izin tidak jadi diterima", "success");
            }
        });
    };

    const confirmTolak = (button) => {
        const id = $(button).data('id');
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Izin ini akan DITOLAK!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $('#tolak-' + id).submit();
            } else {
                Swal.fire("Dibatalkan", "Izin tidak jadi ditolak", "success");
            }
        });
    };
</script>
