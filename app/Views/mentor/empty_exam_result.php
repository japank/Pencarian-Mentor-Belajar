<script>
    $(document).ready(function() {
        Swal.fire({
            icon: 'error',
            title: 'Tidak Ditemukan Data Ujian',
            text: 'Harap Ujian terlebih dahulu',
        })
        // window.location = '<?= base_url(); ?>/exam';
    })
</script>