<?php

namespace App;

use App;
use Guzzle;
use Psr\Http\Message\ResponseInterface;
use League\Url\Url;

class Resolver
{

    /** @var Steps */
    protected $steps;

    function __construct( Steps $steps )
    {
        $this->steps = $steps;
    }

    /**
     * Resolve the redirections in a given URL
     *
     * @param string $url
     *
     * @return array
     */
    public function resolve( $url )
    {
        try {
            $urlObject     = $this->getUrlObject( $url );
            $this->steps[] = (string) $urlObject;
            while ($urlObject = $this->getRedirectLocation( $urlObject )) {
                $urlString = (string) $urlObject;
                if (false !== $this->steps->find( $urlString )) {
                    $this->steps[] = $urlString;
                    $this->steps[] = 'Infinite redirect';
                    break;
                }
                $this->steps[] = $urlString;
            }
        } catch ( \Exception $e ) {
            // Move along
        }

        return $this->steps->getAllSteps();
    }

    /**
     * @param $url
     *
     * @return \League\Url\Url
     */
    protected function getUrlObject( $url )
    {
        /** @var \League\Url\Url $urlObject */
        $urlObject = App::make( 'League\Url\Url', [ $url ] );
        if ( ! $urlObject->getScheme()->get()) {
            $urlObject->setScheme( 'http' );
        }

        return $urlObject;
    }

    /**
     * Get the location of a redirect or false if none
     *
     * @param Url $url
     *
     * @return Url|false
     */
    protected function getRedirectLocation( Url $url )
    {
        /** @var ResponseInterface $response */
        $response = Guzzle::get( (string) $url, [
            'allow_redirects' => false,
            'verify'          => env( 'REDIRECTS_VERIFY_SSL', true ),
        ] );
        if (
            ! env( 'ALLOW_INSANE_STATUS_CODES', false ) &&
            ( $response->getStatusCode() > 399 || $response->getStatusCode() < 300 )
        ) {
            return false;
        }
        $rawLocation = $response->getHeader( 'location' );
        if ( ! $rawLocation) {
            return false;
        }
        $rawLocation = $rawLocation[0];
        $newUrl      = $this->getUrlObject( $rawLocation );
        if ( ! $newUrl->getHost()->get()) {
            $newUrl->setHost( $url->getHost()->get() );
            if ('/' !== $rawLocation[0]) {
                $newUrl->setPath(
                    rtrim( $url->getPath()->get(), '/' ) . '/' . ltrim( $newUrl->getPath()->get(), '/' )
                );
            }
        }

        return $newUrl;
    }

}
