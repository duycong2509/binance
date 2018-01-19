<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Binance\API; 
use Config;

class VolumeController extends Controller
{
    public function index()
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
    	$prices = $api->prices();
    	return view('home', compact('prices'));
    }

    public function priceAll()
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
    	$prices = $api->prices();
    	return response()->json(['prices' => $prices]);
    }

    public function getAllVolumeSymbol($symbol)
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
    	$ticks = $api->candlesticks($symbol, "1m");
    	return view('volume', compact(['ticks', 'symbol']));
    }

    public function getVolumeSymbol(Request $request)
    {
    	$api = new API(Config::get('constants.API_KEY'), Config::get('constants.SECRET'));
    	$ticks = $api->candlesticks($request->symbol, "1m");
    	$data = [];
    	$time = \Carbon\Carbon::parse(now())->format('d-m-Y H:i');
    	$time = strtotime($time)*1000;
		$data[$request->symbol] = $ticks[$time]['volume'];
    	return response()->json(['volume' => $data]);
    }
}
