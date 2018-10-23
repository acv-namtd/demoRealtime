<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class demoRealtimeController extends Controller
{
    public function index()
    {
    	return view("demoRealtime.index");
    }
    public function send()
    {
    	return view("demoRealtime.send");
    }
    public function sendMessage(Request $request)
    {
    	$data = new \stdClass();
    	$data->title = $request->title;
    	$data->message = $request->message;
    	$options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('demoRealtime', 'demoRealtime', $data);
        return redirect()->route('send');
    }
}
