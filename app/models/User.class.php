<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUserByEmail($email) 
    {
        $this->db->query("SELECT * FROM users WHERE Email = :email");
        $this->db->bind(":email", $email);
        $this->db->execute();
        if($this->db->rowCount()) return true;
        else
            return false;
    }
    public function register($name, $email, $password)
    {
        $this->db->query('INSERT INTO users(userName,Email,Password) VALUES (:name,:email,:password)');
        $this->db->bind(':name',$name);
        $this->db->bind(':email',$email);
        $this->db->bind(':password',$password);
        if ($this->db->execute())
            return true;
        else
            return false;
    }
    public function login($email,$password)
    {
        $this->db->query("SELECT * FROM users WHERE Email = :email");
        $this->db->bind(':email',$email);
        $row = $this->db->fetch();
        $hashed_password = $row->Password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
        
    }
}