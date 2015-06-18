<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index( Request $request )
    {
        if ($request->input( 'url', false )) {
            $url = rtrim( url(), '/' ) . '/' . $request->input( 'url' );

            return redirect( $url );
        }

        return view( 'index' );
    }

    public function follow( $url )
    {
    }

}
