@empty($mahasiswa)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white font-weight-bold">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Kesalahan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-ban fa-2x mr-3"></i>
                        <div>
                            <h5 class="mb-1">Data Tidak Ditemukan</h5>
                            <p class="mb-0">Maaf, data Mahasiswa yang Anda cari tidak ada dalam database.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
            </div>
        </div>
    </div>
@else
    <form action="{{ route('admin.mahasiswaManagement.destroyAjax', $mahasiswa->id) }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white font-weight-bold">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Mahasiswa
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-warning">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                            <div>
                                <h5 class="mb-1">Konfirmasi Penghapusan</h5>
                                <p class="mb-0">Apakah Anda yakin ingin menghapus mahasiswa berikut?</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 font-weight-bold text-primary">Nama Mahasiswa:</p>
                                    <h5>{{ $mahasiswa->mahasiswa_nama }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 font-weight-bold text-info">Username:</p>
                                    <h5>{{ $mahasiswa->user->username }}</h5>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <p class="mb-1 font-weight-bold text-success">NIM:</p>
                                    <h5>{{ $mahasiswa->mahasiswa_nim }}</h5>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <p class="mb-1 font-weight-bold text-success">Program Studi:</p>
                                    <h5>{{ $mahasiswa->prodi ? $mahasiswa->prodi->prodi_nama : '-' }}</h5>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <p class="mb-1 font-weight-bold text-success">Jenis Kelamin:</p>
                                    <h5>{{ $mahasiswa->mahasiswa_gender == 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}</h5>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <p class="mb-1 font-weight-bold text-warning">Nomor Telepon:</p>
                                    <h5>{{ $mahasiswa->mahasiswa_nomor_telepon }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i> Menghapus mahasiswa ini akan menonaktifkan akun pengguna
                        terkait. Data tidak akan benar-benar dihapus dari database.
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary">
                        <i class="fas fa-times mr-2"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash-alt mr-2"></i> Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            // Add animation to elements when modal loads
            $('.card').css({
                'opacity': 0,
                'transform': 'translateY(20px)'
            });

            setTimeout(function() {
                $('.card').css({
                    'opacity': 1,
                    'transform': 'translateY(0)',
                    'transition': 'all 0.3s ease-out'
                });
            }, 300);

            $("#form-delete").validate({
                submitHandler: function(form) {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus akan ditandai sebagai non-aktif dan tidak dapat digunakan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, non-aktifkan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: form.action,
                                type: form.method,
                                data: $(form).serialize(),
                                success: function(response) {
                                    if (response.status) {
                                        $('#myModal').modal('hide');

                                        // Check if we're on the show/detail page
                                        const isShowPage = $(
                                            '.card-header:contains("Detail Mahasiswa")'
                                        ).length > 0;

                                        if (isShowPage) {
                                            // Show success message and redirect
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: response.message,
                                                timer: 1500,
                                                showConfirmButton: false,
                                                willClose: () => {
                                                    // Redirect to index page
                                                    window.location
                                                        .href =
                                                        "{{ route('admin.mahasiswaManagement.index') }}";
                                                }
                                            });
                                        } else {
                                            // Just show success message and reload DataTable
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: response.message,
                                                timer: 1500,
                                                showConfirmButton: false
                                            });

                                            // Reload DataTable if we're on the index page
                                            if (typeof dataMahasiswa !== 'undefined') {
                                                dataMahasiswa.ajax.reload();
                                            }
                                        }
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Terjadi Kesalahan',
                                            text: response.message
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Terjadi kesalahan pada server'
                                    });
                                }
                            });
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endempty
