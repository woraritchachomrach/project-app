@extends('layouts.app')

@section('content')
<div class="container">
    <h3>รายละเอียดคำขอ</h3>
    <div class="row mb-3">
        <div class="col-md-4">
            <img src="{{ asset('storage/images/' . $request->car_image) }}" class="img-fluid">
        </div>
        <div class="col-md-8">
            <p><strong>ชื่อ:</strong> {{ $request->name }}</p>
            <p><strong>ตำแหน่ง:</strong> {{ $request->position }}</p>
            <p><strong>กลุ่ม:</strong> {{ $request->department }}</p>
            <p><strong>ช่วงเวลา:</strong> {{ \Carbon\Carbon::parse($request->start_time)->format('d/m/Y H:i') }} ถึง {{ \Carbon\Carbon::parse($request->end_time)->format('d/m/Y H:i') }}</p>
            <p><strong>สถานที่:</strong> {{ $request->destination }}</p>
            <p><strong>เหตุผล:</strong> {{ $request->reason ?? '-' }}</p>
            <p><strong>สถานะ:</strong>
                @if ($request->status == 'pending')
                    <span class="badge bg-warning">รออนุมัติ</span>
                @elseif ($request->status == 'approved')
                    <span class="badge bg-success">อนุมัติแล้ว</span>
                @else
                    <span class="badge bg-danger">ไม่อนุมัติ</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
