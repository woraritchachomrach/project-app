<?php

namespace App\Http\Controllers;

use App\Models\CarRequest;
use App\Notifications\CarRequestReviewed;
use App\Notifications\CarRequestSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CarRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //public function approve(CarRequest $carRequest)
    //{
    //    $carRequest->update(['status'=>'approve']);
    //    return back()->with('success','อนุมัติเรียบร้อย');
    //}

    //public function reject(CarRequest $carRequest)
    //{
    //    $carRequest->update(['status'=>'rejected']);
    //    return back()->with('error','ไม่อนุมัติ');
    //}


    public function index()
    {
        $requests = CarRequest::where('user_id', auth::id())->latest()->get();
        return view('car_requests.list', compact('requests'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car_requests.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_image' => 'required|string',
            'name' => 'required|string',
            'position' => 'required|string',
            'department' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'destination' => 'required|string',
            'reason' => 'nullable|string',
        ]);
        $validated['user_id'] = Auth::id();

        // สร้างคำขอใหม่และเก็บผลลัพธ์ในตัวแปร $carRequest
        $carRequest = CarRequest::create($validated);

        $chief = User::where('role', 'chief' )->first();
        $chief->notify(new CarRequestSubmitted($carRequest));
        $carRequest->user->notify(new CarRequestReviewed($carRequest));

        return redirect()->route('car-requests.create')->with('success', 'ส่งคำขอเรียบร้อย');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = CarRequest::where('id', $id)
            ->where('user_id', auth::id()) // ป้องกันดูของคนอื่น
            ->firstOrFail();

        return view('car_requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
