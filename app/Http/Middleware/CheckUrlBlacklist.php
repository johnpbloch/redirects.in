<?php

namespace App\Http\Middleware;

use Closure;

class CheckUrlBlacklist
{

    private $domain_blacklist = [ ];

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
        $urlString = ltrim( $request->getRequestUri(), '/' );
        /** @var \League\Url\Url $urlObject */
        $urlObject = app( 'League\Url\Url', [ $urlString ] );
        if (in_array( $urlObject->getHost()->get(), $this->getBlacklist() )) {
            return redirect( url() )->withErrors( 'That host is blacklisted!' );
        }

        return $next( $request );
    }

    private function getBlacklist()
    {
        return $this->domain_blacklist;
    }

}
