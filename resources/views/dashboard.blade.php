@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <h1 class="mb-4"></h1>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">📅 ปฏิทินกิจกรรม</h3>
        </div>
        <div class="card-body">
            <div id="calendar" style="max-width: 1500px; margin: auto;"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'th',
            events: []
        });
        calendar.render();
    });
</script>
@endpush
