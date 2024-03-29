<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'required',
        ]);
        $image =$request->file('image');
        $slug =str_slug($request->title);
        if(isset($image)){
            $currentDate =Carbon::now()->toDateString();
            $imagename =$slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/slider')){
                mkdir('uploads/slider', 007, true);
            }
            $image->move('uploads/slider', $imagename);

        }else{
            $imagename='default.png';
        }
        $slider =new Slider();
        $slider->title =$request->title;
        $slider->details =$request->details;
        $slider->image =$imagename;
        $slider->save();
        return redirect()->route('slider.index');
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
        $slider =Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
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
        $validated = $request->validate([
            'title' => 'required',
            'details' => 'required'
        ]);
        $image =$request->file('image');
        $slug =str_slug($request->title);

        $slider =Slider::find($id);

        if(isset($image)){
            $currentDate =Carbon::now()->toDateString();
            $imagename =$slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/slider')){
                mkdir('uploads/slider', 007, true);
            }
            $image->move('uploads/slider', $imagename);

        }else{
            $imagename=$slider->image;
        }
        
        $slider->title =$request->title;
        $slider->details =$request->details;
        $slider->image =$imagename;
        $slider->save();
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider=slider::find($id);
        if(file_exists('uploads/slider/'.$slider->image)){
            unlink('uploads/slider/'.$slider->image);
        }
        $slider->delete();
        return redirect()->route('slider.index');
    }
}
