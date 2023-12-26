<?php
class Home
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUsers()
    {
        $this->db->query("SELECT * FROM user");
        $this->db->execute();
        $users = $this->db->fetchAll();
        if($users)
            return $users;
        else
            return false;
    }
    public function insert($name)
    {
        $this->db->query("INSERT INTO `user`(`name`) VALUES (:name)");
        $this->db->bind(":name", $name);
        $this->db->execute();
    }
}