<?php


namespace app\model;

use app\core\Application;

/**
 * This model will handle SQL query's for registration and login
 *
 * Class UserModel
 * @package app\model
 */
class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }
}