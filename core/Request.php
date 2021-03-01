<?php


namespace app\core;

/**
 * Class Request which will handle our requests, request methods and redirects.
 * @package app\core
 */

class Request
{
    /**
     * Gets user requested page in string format from $_SERVER URI
     *
     * [REQUEST_URI] => /final/item?id=1
     * extracts /item
     *
     * @return string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        $questionPosition = strpos($path, '?');
        if ($questionPosition !== false) :
            $path = substr($path, 0, $questionPosition);
        endif;

        if (strlen($path) > 1) :
            $path = rtrim($path, '/');
        endif;

        return $path;
    }


}