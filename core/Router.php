<?php


namespace app\core;

/**
 * Class Router
 *
 * Router will call controllers and methods
 *
 * @package app\core
 */
class Router
{
    /**
     * This class will hold all routes.
     *
     * routes [
     *      ['get' => [
     *          ['/' => function return,],
     *          ['/about' => function return,],
     *      ],
     *      ['post' => [
     *          ['/' => function return,],
     *          ['/about' => function return,],
     *      ],
     * ]
     * @var array
     *
     */

    protected array $routes = [];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Adds GET route and callback function to routes array
     *
     * @param $path
     * @param $callback
     */

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Adds POST route and callback function to routes array
     *
     * @param $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

}