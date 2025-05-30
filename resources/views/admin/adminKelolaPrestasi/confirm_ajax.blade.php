@empty($prestasi)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white font-weight-bold">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Kesalahan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-ban fa-2x mr-3"></i>
                        <div>
                            <h5 class="mb-1">Data Tidak Ditemukan</h5>
                            <p class="mb-0">Maaf, data prestasi yang Anda cari tidak ada dalam database.</p>
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
    <form action="{{ route('admin.adminKelolaPrestasi.destroyAjax', $prestasi->id) }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white font-weight-bold">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Data Prestasi
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-warning">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                            <div>
                                <h5 class="mb-1">Konfirmasi Penghapusan</h5>
                                <p class="mb-0">Apakah Anda yakin ingin menghapus data prestasi berikut?</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-primary">Nama Penghargaan:</p>
                                        <h5>{{ $prestasi->penghargaan_judul }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-warning">Tempat:</p>
                                        <h5>{{ $prestasi->penghargaan_tempat }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-success">Url:</p>
                                        <h5>{{ $prestasi->penghargaan_url }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-info">Tanggal Mulai:</p>
                                        <h6>{{ date('d F Y', strtotime(datetime: $prestasi->penghargaan_tanggal_mulai)) }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-info">Tanggal Selesai:</p>
                                        <h6>{{ date('d F Y', strtotime($prestasi->penghargaan_tanggal_selesai)) }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-primary">Jumlah Peserta:</p>
                                        <h5>{{ $prestasi->penghargaan_jumlah_peserta }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-primary">Jumlah Instansi:</p>
                                        <h5>{{ $prestasi->penghargaan_jumlah_instansi }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-secondary">No Surat Tugas:</p>
                                        <a href="{{ $prestasi->penghargaan_no_surat_tugas }}" target="_blank"
                                            class="text-truncate d-block">
                                            {{ $prestasi->penghargaan_no_surat_tugas }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-info">Tanggal Surat Tugas:</p>
                                        <h6>{{ date('d F Y', strtotime(datetime: $prestasi->penghargaan_tanggal_surat_tugas)) }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-secondary">File Surat Tugas:</p>
                                        <a href="{{ $prestasi->penghargaan_file_surat_tugas }}" target="_blank"
                                            class="text-truncate d-block">
                                            {{ $prestasi->penghargaan_file_surat_tugas }}
                                        </a>
                                    </div>
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-secondary">File Sertifikat:</p>
                                        <a href="{{ $prestasi->penghargaan_file_sertifikat }}" target="_blank"
                                            class="text-truncate d-block">
                                            {{ $prestasi->penghargaan_file_sertifikat }}
                                        </a>
                                    </div>
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-secondary">File Poster:</p>
                                        <a href="{{ $prestasi->penghargaan_file_poster }}" target="_blank"
                                            class="text-truncate d-block">
                                            {{ $prestasi->penghargaan_file_poster }}
                                        </a>
                                    </div>
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-secondary">Foto Kegiatan:</p>
                                        <a href="{{ $prestasi->penghargaan_photo_kegiatan }}" target="_blank"
                                            class="text-truncate d-block">
                                            {{ $prestasi->penghargaan_photo_kegiatan }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-primary">Score:</p>
                                        <h5>{{ $prestasi->penghargaan_score }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="border-bottom pb-2 mb-2">
                                        <p class="mb-1 font-weight-bold text-warning">Visible:</p>
                                        <h5>{{ $prestasi->penghargaan_visible }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i> Menghapus data prestasi ini mungkin akan mempengaruhi
                        data lainnya yang terkait.
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
        $(document).ready(function () {
            $('.card').css({ 'opacity': 0, 'transform': 'translateY(20px)' });
            setTimeout(function () {
                $('.card').css({
                    'opacity': 1,
                    'transform': 'translateY(0)',
                    'transition': 'all 0.3s ease-out'
                });
            }, 300);

            $('#form-delete').on('submit', function (e) {
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.action,
                            type: 'POST',
                            data: $(form).serialize(),
                            success: function (response) {
                                if (response.status) {
                                    $('#myModal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                    if (typeof dataPrestasi !== 'undefined') {
                                        dataPrestasi.ajax.reload();
                                    }
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: response.message
                                    });
                                }
                            }
                        });
                    }
                });
                return false;
            });
        });
    </script>
@endempty