<?php


namespace app\model;

use app\core\Database;
use app\core\Application;

/**
 * This model will handle SQL query's for comments.
 *
 * Class CommentsModel
 * @package app\model
 */
class CommentsModel
{
    private $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    public function getComments()
    {
        $this->db->query('SELECT * FROM comments ORDER BY created_at DESC');
        $comments = $this->db->resultSet();

        if ($this->db->rowCount() > 0){
            return $comments;
        }
        return false;
    }
}