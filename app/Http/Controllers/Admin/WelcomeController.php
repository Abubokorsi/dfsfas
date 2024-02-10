<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Welcome;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $welcomes=Welcome::all();
        return view('admin.welcome.index', compact('welcomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.welcome.create');
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
            'sub_title' => 'required',
            'point1' => 'required',
            'point2' => 'required',
            'point3' => 'required',
            'details' => 'required',
        ]);
        $image=$request->file('image');
        $slug=str_slug($request->title);

        if (isset($image)) {
            $crrentDate =Carbon::now()->toDateString();
            $imagename =$slug.'-'.$crrentDate.'.'.$image->getClientOriginalExtension();

            if(!file_exists('uploads/welcome')){
                mkdir('uploads/welcome', 077, true);
            }
            $image->move('uploads/welcome',$imagename);
        }
        else{
            $imagename='defult.png';
        }
        $welcome=new Welcome();
        $welcome->title=$request->title;
        $welcome->sub_title=$request->sub_title;
        $welcome->point1=$request->point1;
        $welcome->point2=$request->point2;
        $welcome->point3=$request->point3;
        $welcome->details=$request->details;
        $welcome->image=$imagename;
        $welcome->video=$request->video;
        $welcome->save();

        return redirect()->route('welcome.index');
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
        $welcome=Welcome::find($id);
        return view('admin.welcome.edit', compact('welcome'));
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
            'sub_title' => 'required',
            'point1' => 'required',
            'point2' => 'required',
            'point3' => 'required',
            'details' => 'required',
        ]);
        $image=$request->file('image');
        $slug=str_slug($request->title);
        $welcome=Welcome::find($id);

        if (isset($image)) {
            $crrentDate =Carbon::now()->toDateString();
            $imagename =$slug.'-'.$crrentDate.'.'.$image->getClientOriginalExtension();

            if(!file_exists('uploads/welcome')){
                mkdir('uploads/welcome', 077, true);
            }
            $image->move('uploads/welcome',$imagename);
        }
        else{
            $imagename=$welcome->image;
        }

        $welcome->title=$request->title;
        $welcome->sub_title=$request->sub_title;
        $welcome->point1=$request->point1;
        $welcome->point2=$request->point2;
        $welcome->point3=$request->point3;
        $welcome->details=$request->details;
        $welcome->image=$imagename;
        $welcome->video=$request->video;
        $welcome->save();

        return redirect()->route('welcome.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $welcome=Welcome::find($id);
        $welcome->delete();
        return redirect()->route('welcome.index');
    }
}
