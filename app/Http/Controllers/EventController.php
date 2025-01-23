<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    // カレンダー表示
    public function show(){
        return view("calendars/calendar");
    }
}
