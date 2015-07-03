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
        $urlObject  = app( 'League\Url\Url', [ $urlString ] );
        $hostString = $urlObject->getHost()->get();
        if (
            in_array( $hostString, $this->getBlacklist() ) ||
            $this->isLocalIpAddress( $hostString )
        ) {
            return redirect( url() )->with( 'blacklist', sprintf( '%s is a blacklisted host!', $hostString ) );
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

    private function isLocalIpAddress( $hostString )
    {
        if ( ! filter_var( $hostString, FILTER_VALIDATE_IP ) || '127.0.0.1' === $hostString) {
            return false;
        }
        $addressParts = array_map( 'intval', explode( '.', $hostString ) );

        return (
            10 === $addressParts[0] ||
            ( 172 === $addressParts[0] && ( 15 < $addressParts[1] || 32 > $addressParts[1] ) ) ||
            ( 192 === $addressParts[0] && 168 === $addressParts[1] )
        );
    }

}
