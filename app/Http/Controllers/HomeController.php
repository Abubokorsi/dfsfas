<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Item;
use App\Models\Slider;
use App\Models\Welcome;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home() {

        $sliders =Slider::all();
        $welcomes=Welcome::all();
        $categories=Category::all();
        $items=Item::all();
        return view('home', compact('sliders', 'welcomes', 'categories', 'items'));
    }
    public function booking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
            'person' => 'required',
        ]);

        $booking=new Booking();

        $booking->name=$request->name;
        $booking->email=$request->email;
        $booking->phone=$request->phone;
        $booking->date=$request->date;
        $booking->time=$request->time;
        $booking->person=$request->person;
        $booking->message=$request->message;
        $booking->status=false;
        $booking->save();
        
        return redirect()->back();
    }
}
