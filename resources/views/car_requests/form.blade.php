@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm bg-light">
        <div class="card-body">
            <h3 class="mb-4 text-center text-primary">แบบฟอร์มขอใช้รถราชการ</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('car-requests.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label d-block fw-bold">เลือกรถที่ต้องการใช้</label>
                    <div class="row">
                        @foreach (['7500_Moto3.jpg', 'images1.jpg', 'images2.jpg', 'images4.jpg'] as $car)
                            <div class="col-md-3 col-sm-6 mb-3 text-center">
                                <label class="d-block">
                                    <input type="radio" name="car_image" value="{{ $car }}" required class="form-check-input me-2">
                                    <img src="{{ asset('storage/images/' . $car) }}" class="img-thumbnail shadow-sm rounded" style="width: 90%; height: 150px; object-fit: cover;">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">ชื่อ</label>
                        <input type="text" name="name" class="form-control rounded" placeholder="ชื่อ" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">ตำแหน่ง</label>
                        <input type="text" name="position" class="form-control rounded" placeholder="ตำแหน่ง" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">กลุ่ม</label>
                        <input type="text" name="department" class="form-control rounded" placeholder="กลุ่ม" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">สถานที่</label>
                        <input type="text" name="destination" class="form-control rounded" placeholder="สถานที่" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">วันเวลาเริ่มต้น</label>
                        <input type="text" id="start_time" name="start_time" class="form-control rounded" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">วันเวลาสิ้นสุด</label>
                        <input type="text" id="end_time" name="end_time" class="form-control rounded" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">เหตุผล (ถ้ามี)</label>
                        <textarea name="reason" class="form-control rounded" rows="3" placeholder="เหตุผลในการขอใช้รถ (ถ้ามี)"></textarea>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-success px-5 py-2 rounded-pill shadow-sm">
                        🚗 ส่งคำขอ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

<script>
    function formatBuddhistDate(dateObj) {
        const buddhistYear = dateObj.getFullYear() + 543;
        const monthNames = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
        return `${dateObj.getDate()} ${monthNames[dateObj.getMonth()]} ${buddhistYear} ${dateObj.getHours().toString().padStart(2, '0')}:${dateObj.getMinutes().toString().padStart(2, '0')}`;
    }

    function initThaiDatepicker(id) {
        flatpickr(id, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            locale: "th",
            altInput: true,
            altFormat: "J M Y H:i",
            onReady: function(selectedDates, dateStr, instance) {
                if (selectedDates.length) {
                    instance._input.value = formatBuddhistDate(selectedDates[0]);
                }
            },
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length) {
                    instance._input.value = formatBuddhistDate(selectedDates[0]);
                }
            }
        });
    }

    initThaiDatepicker("#start_time");
    initThaiDatepicker("#end_time");
</script>
@endsection
