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
        $data = $rawData = $next( $request );
        if (isset( $data->original )) {
            $rawData = $data->original;
        }

        $acceptHeader = $request->header( 'Accept' );
        $priorities   = [ 'html', 'json', '*/*' ];
        $format       = $this->negotiator->getBestFormat( $acceptHeader, $priorities );
        if ('json' !== $format) {
            return view( 'follow', [ 'final' => $rawData['end'] ] + $rawData );
        }

        return $data;
    }

}
