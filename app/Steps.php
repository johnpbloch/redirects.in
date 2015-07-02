<?php

namespace App;

use ArrayObject;

class Steps extends ArrayObject
{

    public function getAllSteps()
    {
        $steps    = array_values( $this->getArrayCopy() );
        $allSteps = [
            'start' => null,
            'end'   => null,
            'steps' => $steps,
        ];
        if ($count = count( $steps )) {
            $allSteps['start'] = $steps[0];
            $allSteps['end']   = $steps[$count - 1];
        }

        return $allSteps;
    }

    /**
     * Find an item in the Steps collection
     *
     * @param mixed $needle
     *
     * @return bool|int|string
     */
    public function find( $needle )
    {
        return array_search( $needle, $this->getArrayCopy() );
    }

}
