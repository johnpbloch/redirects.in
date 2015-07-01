<?php

namespace App;

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
        return $this->steps->getAllSteps();
    }

}
