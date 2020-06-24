<?php

namespace App;


class Component
{

    /**
     * Get all components
     * 
     * @return mixed An array with all the components or null if none exist
     */
    public static function getAll()
    {
        $components = array_diff(scandir('../App/Views/components'), array('..', '.'));
        sort($components);

        return $components;
    }
}