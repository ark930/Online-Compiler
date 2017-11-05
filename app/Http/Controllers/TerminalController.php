<?php

namespace App\Http\Controllers;

use App\Libraries\APi\Api;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    public function create(Request $request)
    {
        $api = new Api();
        $pid = $api->createTerminal();
        $request->session()->put('pid', $pid);

        return response()->json([
            'pid' =>$pid
        ]);
    }
}
