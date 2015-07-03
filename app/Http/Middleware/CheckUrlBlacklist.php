<?php

namespace App\Http\Middleware;

use Closure;

class CheckUrlBlacklist
{

    private $domain_blacklist;

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
        if ( ! is_array( $this->domain_blacklist )) {
            $this->domain_blacklist = array_merge( [
                'localhost',
                '127.0.0.1',
            ], config( 'app.host_blacklist', [ ] ) );
        }

        return $this->domain_blacklist;
    }

}
