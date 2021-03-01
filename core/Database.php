<?php


namespace app\core;


class Database
{
    private \PDO $dbh;
    private \PDOStatement $stmt;
    private string $error;

    /**
     * Database constructor. Defines a lightweight interface for accessing database.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];

        $options = [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new \PDO($dsn, $user, $password, $options);
        } catch (PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Prepares statement with SQL query
     *
     * @param $sql
     */
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }


}