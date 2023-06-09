<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PerformaController extends Controller
{
    public function getData(Request $request)
    {
        if ($request->ajax()){
            $qryKehadiran = '';
        }
        return Response::HTTP_METHOD_NOT_ALLOWED;
    }

}
