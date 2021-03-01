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
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
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

            if (!isset($urlParam['value'])) :
                $this->response->setResponseCode(404);
                // We will render the view
            endif;

        endif;

        if (is_string($callback)) :
            // We will render the view
        endif;

        // if our callback is array we handle it with class instance
        if (is_array($callback)) :
            $instance = new $callback[0];
            Application::$app->controller = $instance;
            $callback[0] = Application::$app->controller;

            // Check if we have url arguments in callback array
            if (isset($callback['urlParamName'])) :
                $urlParam['name'] = $callback['urlParamName'];
                array_splice($callback, 2, 1);
            endif;
        endif;

        echo call_user_func($callback, $this->request, $urlParam ?? null);
    }

    /**
     * Renders the page and applies the layout
     *
     * @param string $view
     * @return string|string[]
     */

    public function renderView(string $view, array $params = [])
    {
        $layout = $this->layoutContent();;
        $page = $this->pageContent($view, $params);

        // take layout and replace the {{content}} with the $page content
        return str_replace('{{content}}', $page, $layout);
    }

    /**
     * Returns the layout HTML content
     *
     * @return false|string
     */

    protected function layoutContent()
    {
        if (isset(Application::$app->controller)):
            $layout = Application::$app->controller->layout;
        else:
            $layout = 'main';
        endif;
        // start buffering
        ob_start();
        include_once Application::$ROOT_DIR."/view/layout/$layout.php";
        // stop and return buffering
        return ob_get_clean();
    }

    /**
     * Returns only the given page HTML content
     *
     * @param $view
     * @return false|string
     */

    protected function pageContent($view, $params)
    {
        foreach ($params as $key => $value):
            $$key = $value;
        endforeach;

        ob_start();
        include_once Application::$ROOT_DIR."/view/$view.php";
        return ob_get_clean();
    }

}