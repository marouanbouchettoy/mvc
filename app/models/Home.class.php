<?php
class Home
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getProducts()
    {
        $this->db->query("SELECT * FROM product");
        $this->db->execute();
        $products = $this->db->fetchAll();
        if($products)
            return $products;
        else
            return false;
    }
}