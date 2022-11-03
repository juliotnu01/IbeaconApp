<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\IbeaconEvent;

class IbeaconController extends Controller
{
    public function index(Request $request)
    {
        try {
            IbeaconEvent::dispatch($request->message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
