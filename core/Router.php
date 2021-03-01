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

    public function resolve(){
        $path = $this->request->getPath();
        $method = $this->request->method();

        // Trying to run a route from router array
        $callback = $this->routes[$method][$path] ?? false;

        // If there is no such route added, we say not exist
        if ($callback === false) :

            $pathArr = explode('/', ltrim($path, '/'));

            if (count($pathArr) === 2) :
                $path = '/'.$pathArr[0];
                $urlParam['value'] = $pathArr[1];
            endif;

            if (count($pathArr) === 3) :
                $path = '/'. $pathArr[0] . '/'. $pathArr[1];
                $urlParam['value'] = $pathArr[2];
            endif;

            $callback = $this->routes[$method][$path] ?? false;

        endif;

        if (is_string($callback)) :
            // We will render the view
        endif;

        echo call_user_func($callback, $this->request, $urlParam ?? null);
    }

}