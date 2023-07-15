<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    //
    public function index(){
        return view('admin.homesliders');
    }

    // Add New Slider
    public function create (){
        return view('admin.add-homeslider');
    }

    // Store Slide
    public function store(Request $request){
        $HomeSlider = new HomeSlider();
        $HomeSlider ->slide_heading = $request->slide_title;
        $HomeSlider ->sub_heading = $request->sub_heading;
        $HomeSlider ->button_link = $request->slide_btn_link;
        $HomeSlider ->status = $request->status;
        $HomeSlider ->slide_img = 'null';
        $HomeSlider ->highlighted_heading = $request->highlighted_heading;

        // Save data to db
        $HomeSlider->save();

        return back()->with('msg','Slide Added');
    }
}
