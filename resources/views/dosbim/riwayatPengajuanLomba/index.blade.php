@extends('layouts.template')

@section('title', 'Riwayat Pengajuan Lomba | STARS')

@section('page-title', 'Riwayat Pengajuan Lomba')

@section('breadcrumb')
@endsection

@section('content')
    <div class="card shadow-sm rounded-lg overflow-hidden">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-history mr-2"></i>Riwayat Pengajuan Lomba Anda
            </h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card stat-pending">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h4 id="stat-pending-count">0</h4>
                            <p>Menunggu</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-approved">
                        <div class="stat-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="stat-content">
                            <h4 id="stat-approved-count">0</h4>
                            <p>Diterima</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-rejected">
                        <div class="stat-icon">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="stat-content">
                            <h4 id="stat-rejected-count">0</h4>
                            <p>Ditolak</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-total">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-content">
                            <h4 id="stat-total-count">0</h4>
                            <p>Total Pengajuan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="filter-section">
                        <div class="filter-header">
                            <div class="filter-title">
                                <i class="fas fa-filter mr-2"></i>
                                <span>Filter & Pencarian</span>
                            </div>
                            <div class="filter-toggle" id="filterToggle">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="filter-content" id="filterContent">
                            <div class="row align-items-end">
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <label class="filter-label">Status Pengajuan</label>
                                    <div class="filter-input-group">
                                        <div class="filter-input-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <select class="form-control filter-select" id="statusFilter">
                                            <option value="">Semua Status</option>
                                            <option value="Menunggu">Menunggu Verifikasi</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <label class="filter-label">Pencarian</label>
                                    <div class="filter-input-group">
                                        <div class="filter-input-icon">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <input type="text" class="form-control filter-search" id="searchBox"
                                            placeholder="Cari lomba atau penyelenggara...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped" id="table_riwayat">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th width="25%">Nama Lomba</th>
                            <th width="18%">Penyelenggara</th>
                            <th width="15%">Kategori</th>
                            <th width="12%">Status</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTables akan mengisi ini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <style>
        :root {
            --primary-color: #102044;
            --secondary-color: #1a2a4d;
            --accent-color: #fa9d1c;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-bg: #f8f9fc;
            --light-text: #6c757d;
            --border-color: #e3e6f0;
        }

        .card-header {
            background: linear-gradient(-45deg, #102044, #1a2a4d, #293c5d, #1a2a4d);
            background-size: 400% 400%;
            height: 70px;
            overflow: hidden;
            display: flex;
            align-items: center;
            position: relative;
        }

        .filter-control {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .filter-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(250, 157, 28, 0.25);
            background-color: #fff;
        }

        .has-search .form-control {
            padding-left: 2.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .has-search .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(250, 157, 28, 0.25);
            background-color: #fff;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.8rem;
            height: 2.8rem;
            line-height: 2.8rem;
            text-align: center;
            pointer-events: none;
            color: var(--light-text);
            transition: color 0.3s ease;
        }

        .has-search {
            position: relative;
            max-width: 300px;
            margin-left: auto;
        }

        .has-filter {
            position: relative;
        }

        .has-filter .form-control {
            padding-left: 2.8rem;
            border-radius: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            padding-right: 2.5rem;
        }

        .has-filter .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.8rem;
            height: 2.8rem;
            line-height: 2.8rem;
            text-align: center;
            pointer-events: none;
            color: var(--light-text);
            transition: color 0.3s ease;
            left: 0;
            top: 0;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-left: 4px solid;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            align-items: center;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .stat-pending {
            border-left-color: var(--warning-color);
        }

        .stat-approved {
            border-left-color: var(--success-color);
        }

        .stat-rejected {
            border-left-color: var(--danger-color);
        }

        .stat-total {
            border-left-color: var(--primary-color);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .stat-pending .stat-icon {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .stat-approved .stat-icon {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .stat-rejected .stat-icon {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .stat-total .stat-icon {
            background: rgba(16, 32, 68, 0.1);
            color: var(--primary-color);
        }

        .stat-content h4 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-content p {
            margin: 0;
            color: var(--light-text);
            font-size: 0.9rem;
        }

        .badge {
            font-size: 0.8em;
            padding: 0.5em 0.8em;
            border-radius: 15px;
        }

        /* Modern Filter Section */
        .filter-section {
            background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .filter-section:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .filter-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-header:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        }

        .filter-title {
            color: white;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        .filter-toggle {
            color: white;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .filter-toggle.active {
            transform: rotate(180deg);
        }

        .filter-content {
            padding: 1.5rem;
            background: white;
            transition: all 0.3s ease;
            max-height: 200px;
            overflow: hidden;
        }

        .filter-content.collapsed {
            max-height: 0;
            padding: 0 1.5rem;
        }

        .filter-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .filter-input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .filter-input-icon {
            position: absolute;
            left: 1rem;
            z-index: 3;
            color: var(--light-text);
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .filter-select,
        .filter-search {
            padding-left: 2.5rem;
            padding-right: 1rem;
            height: 45px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background: rgba(248, 250, 252, 0.8);
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .filter-select:focus,
        .filter-search:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(250, 157, 28, 0.25);
            background: white;
        }

        .filter-select:focus+.filter-input-icon,
        .filter-search:focus+.filter-input-icon {
            color: var(--accent-color);
        }

        .filter-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            padding-right: 2.5rem;
        }

        .filter-actions {
            display: flex;
            gap: 0.5rem;
            height: 100%;
            align-items: end;
        }

        .btn-modern {
            border-radius: 12px;
            padding: 0.65rem 1.25rem;
            font-weight: 600;
            font-size: 0.875rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-modern.btn-primary {
            background: linear-gradient(135deg, var(--accent-color), #e67e22);
            color: white;
            border-color: var(--accent-color);
        }

        .btn-modern.btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(250, 157, 28, 0.4);
            background: linear-gradient(135deg, #e67e22, var(--accent-color));
        }

        .btn-modern.btn-outline-secondary {
            background: transparent;
            color: var(--light-text);
            border-color: rgba(0, 0, 0, 0.2);
        }

        .btn-modern.btn-outline-secondary:hover {
            background: var(--light-text);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        /* Responsive Design for Filter */
        @media (max-width: 768px) {
            .filter-content {
                padding: 1rem;
            }

            .filter-header {
                padding: 0.8rem 1rem;
            }

            .filter-title {
                font-size: 0.9rem;
            }

            .filter-actions {
                justify-content: stretch;
            }

            .btn-modern {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .filter-select,
            .filter-search {
                height: 40px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .filter-section {
                border-radius: 12px;
            }

            .filter-content {
                padding: 0.8rem;
            }

            .filter-header {
                padding: 0.7rem 0.8rem;
            }

            .btn-modern {
                height: 40px;
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .filter-select,
            .filter-search {
                height: 38px;
                padding-left: 2.2rem;
            }

            .filter-input-icon {
                left: 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>
@endpush

@push('js')
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var dataRiwayat;

        $(document).ready(function() {
            // Initialize filter toggle
            initializeFilterToggle();

            dataRiwayat = $('#table_riwayat').DataTable({
                scrollX: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('dosen.riwayatPengajuanLomba.list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(d) {
                        d.status = $('#statusFilter').val();
                    }
                },
                columns: [{
                        data: "id",
                        className: "text-center",
                        width: "8%",
                        orderable: true
                    },
                    {
                        data: "lomba_nama",
                        width: "25%",
                        orderable: true
                    },
                    {
                        data: "lomba_penyelenggara",
                        width: "18%",
                        orderable: true
                    },
                    {
                        data: "lomba_kategori",
                        width: "15%",
                        orderable: true
                    },

                    {
                        data: "pendaftaran_status",
                        width: "12%",
                        orderable: true
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        width: "10%",
                        orderable: false,
                        searchable: false
                    }
                ],
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                order: [
                    [0, "desc"]
                ],
                language: {
                    processing: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
                    search: "",
                    searchPlaceholder: "Cari...",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "<div class='empty-state'><i class='fas fa-inbox empty-icon'></i><h5 class='empty-title'>Belum ada pengajuan lomba</h5><p class='empty-text'>Anda belum pernah mengajukan lomba. Mulai ajukan lomba sekarang!</p></div>",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "<i class='fas fa-chevron-right'></i>",
                        previous: "<i class='fas fa-chevron-left'></i>"
                    }
                },
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                drawCallback: function(settings) {
                    updateStatistics(settings.json);
                }
            });

            // Filter functionality

            $('#searchBox').on('keyup', function() {
                dataRiwayat.search(this.value).draw();
            });

            $('#statusFilter').on('change', function() {
                dataRiwayat.ajax.reload();
            });

            $('.dataTables_filter').hide();
        });

        function initializeFilterToggle() {
            const filterToggle = $('#filterToggle');
            const filterContent = $('#filterContent');

            // Initially collapsed on mobile
            if ($(window).width() < 768) {
                filterContent.addClass('collapsed');
                filterToggle.removeClass('active');
            }

            filterToggle.on('click', function() {
                filterContent.toggleClass('collapsed');
                $(this).toggleClass('active');
            });
        }

        function updateStatistics(data) {
            if (data && data.statistics) {
                $('#stat-pending-count').text(data.statistics.pending || 0);
                $('#stat-approved-count').text(data.statistics.approved || 0);
                $('#stat-rejected-count').text(data.statistics.rejected || 0);
                $('#stat-total-count').text(data.statistics.total || 0);
            }
        }
    </script>
@endpush
