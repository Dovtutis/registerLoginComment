<?php


namespace app\core;

/**
 * Class Application
 *
 * This is main application
 *
 * @package app\core
 */
class Application
{
    /**
     * Instance of Router class
     * We will need routing in all our application. So we will have it as a property;
     * @var Router
     */
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public static Application $app;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        echo $this->router->resolve();
    }


}