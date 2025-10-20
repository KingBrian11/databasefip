@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">
                    <i class="bi bi-funnel-fill text-primary"></i> Event Filters
                </div>
                <div class="card-body">
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="all" id="viewAll" checked>
                        <label class="form-check-label" for="viewAll">View All</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="Dalam Negeri" checked>
                        <label class="form-check-label">Dalam Negeri</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="Luar Negeri" checked>
                        <label class="form-check-label">Luar Negeri</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="Selesai" checked>
                        <label class="form-check-label">Selesai</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="Proses" checked>
                        <label class="form-check-label">Proses</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-calendar3 text-info fs-4"></i>
                    Kalender Periode Studi
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet"/>
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }
    .fc-event {
        font-size: 0.8rem;
        padding: 2px 4px;
        border-radius: 6px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var events = @json($events); // Data dari controller

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: events,
    });
    calendar.render();

    // === Filter Logic ===
    document.querySelectorAll('.filter-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            let checked = Array.from(document.querySelectorAll('.filter-checkbox:checked'))
                               .map(el => el.value);

            let filteredEvents = events.filter(e => {
                if (checked.includes("all")) return true;
                return checked.includes(e.category ?? '');
            });

            calendar.removeAllEvents();
            calendar.addEventSource(filteredEvents);
        });
    });
});
</script>
@endpush
