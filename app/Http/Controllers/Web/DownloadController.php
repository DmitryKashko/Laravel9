<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloads(Request $request)
    {

        $path = $request->server->all();
        /*dd($path['QUERY_STRING']);*/

        return response()->download($path['QUERY_STRING']);
    }

}
