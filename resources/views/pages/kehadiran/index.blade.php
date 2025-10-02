@extends('layouts.dashboard')

@section('content')
    @push('css')
        <!-- Include Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
    @push('js')
        <!-- Include Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize inline calendar
                flatpickr("#calendar-display", {
                    inline: true,
                    dateFormat: "Y-m-d",
                    defaultDate: new Date(),
                    showMonths: 1,
                    static: true, // Prevent calendar from repositioning
                    onChange: function (selectedDates, dateStr, instance) {
                        console.log("Selected date:", dateStr);
                    },
                    locale: {
                        firstDayOfWeek: 1,
                        weekdays: {
                            shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                            longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                        },
                        months: {
                            shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                            longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                        }
                    }
                });
            });
        </script>
    @endpush
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Kehadiran</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <!-- Left Column: Data Tables -->
            <div class="col-lg-7">
                <ul class="nav nav-tabs mb-3" id="attendanceTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="data-absen-tab" data-bs-toggle="tab"
                                data-bs-target="#data-absen" type="button" role="tab" aria-controls="data-absen"
                                aria-selected="true">Data Absen
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="data-izin-tab" data-bs-toggle="tab" data-bs-target="#data-izin"
                                type="button" role="tab" aria-controls="data-izin" aria-selected="false">Data Izin
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="attendanceTabContent">
                    <div class="tab-pane fade show active" id="data-absen" role="tabpanel"
                         aria-labelledby="data-absen-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;" class="text-center">No</th>
                                    <th>Nama User</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>User 1</td>
                                    <td>Keterangan 1</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>User 2</td>
                                    <td>Keterangan 2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>John Doe</td>
                                    <td><span class="badge bg-success">Hadir tepat waktu</span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Jane Smith</td>
                                    <td><span class="badge bg-warning">Terlambat 15 menit</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="data-izin" role="tabpanel" aria-labelledby="data-izin-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;" class="text-center">No</th>
                                    <th>Nama User</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>User A</td>
                                    <td><span class="badge bg-info">Sakit demam</span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>User B</td>
                                    <td><span class="badge bg-secondary">Urusan keluarga</span></td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Michael Johnson</td>
                                    <td><span class="badge bg-primary">Cuti tahunan</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Calendar & Permission Requests -->
            <div class="col-lg-5">
                <!-- Calendar Section -->
                <div class="card border-2 mb-4 calendar-widget">
                    <div class="card-body p-3">
                        <div id="calendar-display" class="calendar-container"></div>
                    </div>
                </div>

                <!-- Permission Requests Section -->
                <div class="card border-2 permission-requests">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h6 class="fw-bold mb-0 text-dark">Daftar Pengajuan Izin</h6>
                    </div>
                    <div class="card-body pt-2">
                        <div class="permission-list">
                            <div class="permission-item py-2">
                                <div class="text-muted small">Nama User 1</div>
                            </div>
                            <hr class="my-2 opacity-25">
                            <div class="permission-item py-2">
                                <div class="text-muted small">Nama User 2</div>
                            </div>
                            <hr class="my-2 opacity-25">
                            <div class="permission-item py-2">
                                <div class="text-muted small">Nama User 3</div>
                            </div>
                            <hr class="my-2 opacity-25">
                            <div class="permission-item py-2">
                                <div class="text-muted small">Robertson Budi</div>
                            </div>
                            <hr class="my-2 opacity-25">
                            <div class="permission-item py-2">
                                <div class="text-muted small">Richard Bambang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
