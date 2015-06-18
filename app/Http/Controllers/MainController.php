<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use League\Url\Url;

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
        $urlObject = $this->getUrlObject( $url );
        $stop      = false;
        do {
        } while ( ! $stop);

        return view( 'follow' );
    }

    /**
     * @param $url
     *
     * @return static
     */
    protected function getUrlObject( $url )
    {
        $urlObject = Url::createFromUrl( $url );
        if ( ! $urlObject->getScheme()->get()) {
            $urlObject->setScheme( 'http' );

            return $urlObject;
        }

        return $urlObject;
    }

}
