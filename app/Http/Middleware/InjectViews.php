<?php

namespace App\Http\Middleware;

use Closure;
use Negotiation\FormatNegotiator;

class InjectViews
{

    protected $negotiator;

    function __construct( FormatNegotiator $negotiator )
    {
        $this->negotiator = $negotiator;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $data = $next( $request );

        $acceptHeader = $request->header( 'Accept' );
        $priorities   = [ 'html', 'json', '*/*' ];
        $format       = $this->negotiator->getBestFormat( $acceptHeader, $priorities );
        if ('json' !== $format) {
            return view( 'follow', [ 'redirects' => $data ] );
        }

        return $data;
    }

}
