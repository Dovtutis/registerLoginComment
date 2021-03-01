<?php


namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    /**
     * This handles Home Page GET request
     * @return string|string[]
     */

    public function index()
    {
        $params = [
            'name' => "Sporto Klubas",
        ];
        return $this->render('index', $params);
    }

}