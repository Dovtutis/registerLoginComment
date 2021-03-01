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

    /**
     * Register function which creates SQL query, binds params and executes the query.
     *
     * @param $data
     * @return bool
     */
    public function register($data)
    {
        $this->db->query("INSERT INTO users (`name`, `surname`, `email`, `password`, `phone`, `address`)
            VALUES (:name, :surname, :email, :password, :phone, :address)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);

        if ($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }
}