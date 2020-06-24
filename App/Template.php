<?php

namespace App;


class Template
{

    /**
     * Get all templates
     * 
     * @return mixed An array with all the templates or null if none exist
     */
    public static function getAll()
    {
        $templates = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/templates'), array('..', '.'));
        sort($templates);

        return $templates;
    }
}