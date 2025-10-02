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
            <h5 class="mb-0">Dashboard</h5>
        </div>
    </div>
    <div class="card-body">
        <!-- Main Content Area with Banner Image -->
        <div class="dashboard-main-content">
            <img src="{{ asset('images/banner.jpg') }}" alt="Banner" class="banner-image">
        </div>
        <div class="row g-4">
            <!-- Left Column: Main Content -->
            <div class="col-lg-8">
                <!-- Time and Date Section -->
                <div class="time-date-container">
                    <div class="time-pill" id="currentTime">
                        9:41 AM
                    </div>
                    <div class="date-pill" id="currentDate">
                        Apr 1, 2025
                    </div>
                </div>
            </div>
            <!-- Right Column: Calendar -->
            <div class="col-lg-4">
                <div class="card border-2 calendar-widget">
                    <div class="card-body p-3">
                        <div id="calendar-display" class="calendar-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
