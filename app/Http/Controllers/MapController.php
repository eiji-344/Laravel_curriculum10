<?php

namespace App\Http\Controllers;

class MapController extends Controller
{
    public function index()
    {
        $addresses = [
            '神奈川県横浜市中区新港1-1-1',
            '東京都港区芝公園４丁目２−８',
            '愛知県名古屋市中区本丸１−１'
        ];
        return view('map.index')->with(['addresses' => $addresses]);
    }
}
?>