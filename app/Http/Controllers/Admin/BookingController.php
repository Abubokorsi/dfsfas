<?php

namespace App\Http\Controllers\Admin;

use App\Events\bookingProcessed;
use App\Http\Controllers\Controller;
use App\Mail\BookingMail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings=Booking::all();
        return view('admin.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::find($id)->delete();
        return redirect()->route('booking.index');
    }

    public function confirm($id){
        $booking=Booking::find($id);
        $booking->status=true;
        $booking->save();


        //__ event calling bookingprocessed__//
        $edata=['name' =>$booking->name, 'date' =>$booking->date, 'time' =>$booking->time, 'phone' =>$booking->phone, 'person' =>$booking->person, 'email' =>$booking->email];
        // event(new bookingProcessed($edata));
        Mail::to($booking->email)->send(new BookingMail($edata));
        return redirect()->route('booking.index');

    }
    public function completed($id){
        $booking=Booking::find($id);
        $booking->status=2;
        $booking->save();
        
        return redirect()->route('booking.index');

    }
}
