@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4 text-center text-primary">📋 รายการคำขอใช้รถราชการ</h3>

            @if($requests->isEmpty())
                <div class="alert alert-warning text-center">ยังไม่มีคำขอ</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>รูป</th>
                                <th>สถานที่</th>
                                <th>ช่วงเวลา</th>
                                <th>สถานะ</th>
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $req)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('storage/images/' . $req->car_image) }}" class="rounded shadow-sm" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $req->destination }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($req->start_time)->format('d/m/Y H:i') }}
                                    <br>
                                    <strong>ถึง</strong>
                                    <br>
                                    {{ \Carbon\Carbon::parse($req->end_time)->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-center">
                                    @if ($req->status == 'pending')
                                        <span class="badge bg-warning text-dark"><i class="bi bi-clock-history"></i> รออนุมัติ</span>
                                    @elseif ($req->status == 'approved')
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> อนุมัติแล้ว</span>
                                    @else
                                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> ไม่อนุมัติ</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('car-requests.show', $req->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        👁️ ดู
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
